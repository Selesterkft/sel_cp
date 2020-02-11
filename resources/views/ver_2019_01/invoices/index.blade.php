@extends('layouts.app')

@section('title', __('global.invoices.title'))

@section('content')

    <section class='content-header'>

        <h1>
            {{ __('global.invoices.title') }}
            <small>{{ __('global.invoices.sub_title') }}</small>
        </h1>

        <ol class="breadcrumb">
            <li>
                <a href="{{ url('/') }}">
                    <i class="fa fa-dashboard"></i>&nbsp;
                    {{ __('global.app_dashboard') }}
                </a>
            </li>

            <li class="active">
                <i class="fa fa-files-o"></i>&nbsp;
                {{ __('global.invoices.title') }}
            </li>

        </ol>

    </section>

    <section class="content">

        <div id="toolbar">
            <div class="btn-group">

                <!-- KERESÉS -->
                <button id="search" name="search"
                        type="button" title="{{ __('global.app_search') }}"
                        class="btn btn-success"
                        data-toggle="modal"
                        data-target="#searchRekord"
                        data-title="{{ __('global.app_search') }}"
                        data-message="{{ __('global.app_search_title') }}">
                    <i class="fa fa-search"></i>&nbsp;
                    {{ __('global.app_search') }}
                </button>
                <!-- /.KERESÉS -->
                <!-- KERESÉS TÖRLÉSE -->
                <button id="clear_search" name="clear_search"
                        type="button" title="{{ __('global.app_delete_search') }}"
                        class="btn btn-bitbucket"
                        onclick="window.location.href='{{ url('invoices') }}'">
                    <i class="fa fa-search-minus"></i>&nbsp;
                    {{ __('global.app_delete_search') }}
                </button>
                <!-- /.KERESÉS TÖRLÉSE -->

            </div>
        </div>

        <!-- SEARCH PANEL -->
        {{-- @includeIf(session()->get('version') . '.panels.search_panel_01') --}}

        <!-- TÁBLÁZAT -->
        @includeIf(session()->get('version') . '.invoices.partials.table_invoices')

        <!-- SEARCH MODAL -->
        @includeIf('modals.modal_search2', [
            'fields' => session()->get('version') . '.invoices.partials.fields_search',
            'title' => __('global.app_search_title'),
            'url' => 'invoices',
        ])
        <!-- /.SEARCH MODAL -->

    </section>
@endsection

@section('css')
    <link href="{{ asset('assets/bower_components/bootstrap-table/1.15.5/bootstrap-table.css') }}" rel="stylesheet"/>
    {{--<link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.css">--}}

    {{--<link href="{{ asset('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">--}}
    {{-- <link id="bsdp-css" href="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker3.min.css" rel="stylesheet">--}}

    {{-- Daterange Picker --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
    {{--<link href="{{ asset('assets/bower_components/bootstrap-daterangepicker/datepicker.min.css') }}" rel="stylesheet">--}}

    @php
        echo "<!-- MENU BACGROUND COLOR -->\n";
        echo "<style>.skin-blue .main-sidebar, .skin-blue .left-side {background-color: " . \App\Classes\Helper::getMenuBgColor('invoices') . ";}</style>\n";

        echo "<!-- HEADER BG COLOR -->\n";
        $header_bg_color = \App\Classes\Helper::getHeaderBgColor('invoices');
        echo "<style>.skin-blue .main-header .navbar {background-color: " . $header_bg_color . ";}</style>\n";
        echo "<style>.skin-blue .main-header .logo {background-color: " . $header_bg_color . ";}</style>\n";

        echo "<!-- PANEL AND TAB COLOR -->\n";
        echo "<style>.box.box-default {border-top-color: " . \App\Classes\Helper::getPanelTabLineColor('invoices') . ";}</style>\n";
    @endphp

@endsection

@section('js')
    {{-- Bootstrap Table --}}
    <script src="{{ asset('assets/bower_components/bootstrap-table/tableExport.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/bower_components/bootstrap-table/1.15.5/libs/jspdf.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/bower_components/bootstrap-table/1.15.5/libs/jspdf.plugin.autotable.js') }}"
            type="text/javascript"></script>
    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/locale/bootstrap-table-hu-HU.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/extensions/export/bootstrap-table-export.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/extensions/cookie/bootstrap-table-cookie.js"></script>
    <!--
    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/extensions/toolbar/bootstrap-table-toolbar.min.js"></script>
    -->
    {{-- Moment --}}
    <script src="{{ asset('assets/bower_components/moment/moment.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/bower_components/moment/locale/hu.js') }}" type="text/javascript"></script>

    {{-- Daterange Picker --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script>
        var $table       = $('#table');
        var dateFormat   = '{{ (config('appConfig.dateFormats'))[config('app.locale')]['moment'] }}';
        var priceFormat  = '{{ (config('appConfig.currencies.' . config('app.locale'))) }}';
        var $searchModal = $('#searchRekord');
        var $s_invNum    = $('#s_invNum');
        var $s_customer  = $('#s_customer');
        var $s_vendor    = $('#s_vendor');
        var $s_delivery_date = $('#s_delivery_date');
        var $s_due_date = $('#s_due_date');
        var $s_type = $('#s_type');

        function queryParams(params)
        {
            var urlParams = getAllUrlParams();
            params.s_invNum = $s_invNum.val();
            params.s_vendor = $s_vendor.val();
            params.s_customer = $s_customer.val();
            params.s_type = $s_type.val();

            if( urlParams.s_due_date != undefined && urlParams.s_due_date != '' )
            {
                params.s_due_date = urlParams.s_due_date.replace('+-+', ' - ');
            }
            if( urlParams.s_delivery_date != undefined && urlParams.s_delivery_date != '' )
            {
                params.s_delivery_date = urlParams.s_delivery_date.replace('+-+', ' - ');
            }
            return params;
        }


        /*
         * ================================
         * Search Modal Open
         * ================================
         */
        $searchModal.on('show.bs.modal', function(event)
        {
            if( getAllUrlParams().s_due_date != undefined && getAllUrlParams().s_due_date != '' )
            {
                $s_due_date.val(getAllUrlParams().s_due_date.replace('+-+', ' - '));
                $datumok = getAllUrlParams().s_due_date.split('+-+');
                $s_due_date.data('daterangepicker').setStartDate($datumok[0]);
                $s_due_date.data('daterangepicker').setEndDate($datumok[1]);
            }

            if( getAllUrlParams().s_delivery_date != undefined && getAllUrlParams().s_delivery_date != '' )
            {
                $s_delivery_date.val(getAllUrlParams().s_delivery_date.replace('+-+', ' - '));
                $datumok = getAllUrlParams().s_delivery_date.split('+-+');
                $s_delivery_date.data('daterangepicker').setStartDate($datumok[0]);
                $s_delivery_date.data('daterangepicker').setEndDate($datumok[1]);
            }
        });

        /*
         * ================================
         * Search Modal Close
         * ================================
         */
        $searchModal.on('hide.bs.modal', function(event)
        {
            //lblSearch;
        });

        /*
         * ================================
         * Daterange Pickers Language settings
         * ================================
         */
        var hungarian_daterangepicker = {
            direction: "ltr",
            format: "{{ config('appConfig.dateFormats.' . app()->getLocale() . '.moment') }}",
            separator: " - ",
            cancelLabel: "{{ __('global.app_cancel') }}",
            applyLabel: "{{ __('global.app_apply') }}",
            fromLabel: "Da",
            toLabel: "A",
            //customRangeLabel: "Personalizzata",
            daysOfWeek: ['Vas', 'Hét', 'Ked', 'Sze', 'Csü', 'Pén', 'Szo'],
            monthNames: ['Január', 'Február', 'Március', 'Április', 'Május', 'Június', 'Július', 'Augusztus', 'Szeptember', 'Október', 'November', 'December'],
            firstDay: 1
        };

        /*
         * ================================
         * Daterange Pickers
         * ================================
         */
        $('#s_delivery_date, #s_due_date').daterangepicker({
            autoUpdateInput: false,
            showWeekNumbers: true,
            drops: 'up',
            @php
                if( app()->getLocale() == 'hu' )
                {
                    echo('"locale" : hungarian_daterangepicker');
                }
            @endphp
        });

        //
        $('#s_delivery_date, #s_due_date').on('apply.daterangepicker', function(ev, picker)
        {

            $(this).val(picker.startDate.format('@php echo config("appConfig.dateFormats." . app()->getLocale() . ".moment") @endphp') +
                ' - ' +
                picker.endDate.format('@php echo config("appConfig.dateFormats." . app()->getLocale() . ".moment") @endphp'));
        });

        $('#s_delivery_date, #s_due_date').on('cancel.daterangepicker', function(ev, picker)
        {
            $(this).val('');
        });

        function operateFormatter(value, row, index)
        {
            $url = '{{ url('invoices.show', 'xx') }}'.replace('xx', row.SELEXPED_INV_ID);

            $disabled = '';
            if( row.Inv_L_Num == '0' )
            {
                $disabled = 'disabled';
            }

            $b1 = '<a href="' + $url + '" class="btn btn-success btn-sm view" ' + $disabled + '>'+
                '<i class="fa fa-eye"></i>'+
                '</a>';
            $b2 = '<a href="mailto:?from=from@email.hu&to=to@email.hu&subject=Kérdések a ' + row.Inv_Num + ' számlával kapcsolatban&body=Tisztelt ' + row.Cust_Name1 + ' !%0D%0AÜdvözlettel: ' + row.Vendor_Name1 + '" '+
                'class="btn btn-info btn-sm" style="margin-left: 10px;">'+
                '<i class="fa fa-envelope"></i>'+
                '</a>';
//console.log($b1);
            return [$b1, $b2].join('');

        }

        window.operateEvents = {
            /*
            'click .like': function (e, value, row, index) {
                alert('You click like action, row: ' + JSON.stringify(row))
            },
            'click .remove': function (e, value, row, index) {
                $table.bootstrapTable('remove', {
                    field: 'id',
                    values: [row.id]
                })
            }
            */
        };

        /*
         * Table beállítás
         */
        function initTable()
        {
            $table.bootstrapTable('destroy')
                .bootstrapTable({
                    exportTypes: ['excel'],
                    locale: '{{ app()->getLocale() . '-' . strtoupper(app()->getLocale()) }}',
                    columns: [
                    {
                        field: 'operate',
                        title: '{{ __('global.app_fields.operations') }}',
                        align: 'center',
                        clickToSelect: false,
                        events: window.operateEvents,
                        switchable: false,
                        formatter: operateFormatter
                    }]
                });
        }

        $(function()
        {
            initTable();

            console.log($table.bootstrapTable('getOptions').pageNumber);
        });

        /*
     * https://www.sitepoint.com/get-url-parameters-with-javascript/
     */
        function getAllUrlParams(url)
        {
            // get query string from url (optional) or window
            var queryString = url ? url.split('?')[1] : window.location.search.slice(1);

            // we'll store the parameters here
            var obj = {};

            // if query string exists
            if (queryString)
            {
                // stuff after # is not part of query string, so get rid of it
                queryString = queryString.split('#')[0];

                // split our query string into its component parts
                var arr = queryString.split('&');

                for (var i = 0; i < arr.length; i++)
                {
                    // separate the keys and the values
                    var a = arr[i].split('=');

                    // set parameter name and value (use 'true' if empty)
                    var paramName = a[0];
                    var paramValue = typeof (a[1]) === 'undefined' ? true : a[1];

                    // (optional) keep case consistent
                    paramName = paramName.toLowerCase();
                    if (typeof paramValue === 'string') paramValue = paramValue.toLowerCase();

                    // if the paramName ends with square brackets, e.g. colors[] or colors[2]
                    if (paramName.match(/\[(\d+)?\]$/))
                    {

                        // create key if it doesn't exist
                        var key = paramName.replace(/\[(\d+)?\]/, '');
                        if (!obj[key]) obj[key] = [];

                        // if it's an indexed array e.g. colors[2]
                        if (paramName.match(/\[\d+\]$/))
                        {
                            // get the index value and add the entry at the appropriate position
                            var index = /\[(\d+)\]/.exec(paramName)[1];
                            obj[key][index] = paramValue;
                        }
                        else
                        {
                            // otherwise add the value to the end of the array
                            obj[key].push(paramValue);
                        }
                    }
                    else
                    {
                        // we're dealing with a string
                        if (!obj[paramName])
                        {
                            // if it doesn't exist, create property
                            obj[paramName] = paramValue;
                        }
                        else if (obj[paramName] && typeof obj[paramName] === 'string')
                        {
                            // if property does exist and it's a string, convert it to an array
                            obj[paramName] = [obj[paramName]];
                            obj[paramName].push(paramValue);
                        }
                        else
                        {
                            // otherwise add the property
                            obj[paramName].push(paramValue);
                        }
                    }
                }
            }
            return obj;
        }

        /*
        * https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/NumberFormat
        */
        function priceFormatter(data, row)
        {
            $aa = new Intl.NumberFormat(
                '{{ app()->getLocale() . '-' . strtoupper(app()->getLocale()) }}',
                {
                    style: 'currency',
                    currency: row.Curr_DC
                }).format(data);
            return $aa;
        }

        function decimalFormatter(data)
        {
            return FormatNumber(data);
        }

        function dateFormatter(data) {
            return moment(data).format(dateFormat);
        }

        function cellStyle(value, row, index)
        {
            return {
                css: {
                    'white-space': 'nowrap'
                }
            }
        }

        function FormatNumber(number, numberOfDigits = 2) {
            try {
                return new Intl.NumberFormat('en-US').format(parseFloat(number).toFixed(2));
            } catch (error) {
                return 0;
            }
        }
    </script>

@endsection
