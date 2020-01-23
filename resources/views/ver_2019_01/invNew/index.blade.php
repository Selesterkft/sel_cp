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
                        onclick="window.location.href='{{ url('inv_new') }}'">
                    <i class="fa fa-search-minus"></i>&nbsp;
                    {{ __('global.app_delete_search') }}
                </button>
                <!-- /.KERESÉS TÖRLÉSE -->

            </div>
        </div>

        <!-- SEARCH PANEL -->
        {{-- @includeIf(session()->get('version') . '.panels.search_panel_01') --}}

        <!-- TÁBLÁZAT -->
        @includeIf(session()->get('version') . '.invNew.partials.table_invoices')

        <!-- SEARCH MODAL -->
        @includeIf('modals.modal_search2', [
            'fields' => session()->get('version') . '.invNew.partials.fields_search',
            'title' => __('global.app_search_title'),
            'url' => 'inv_new',
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

            console.log(urlParams);
            console.log(params);
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

        /*
         * Table beállítás
         */
        function initTable()
        {
            $table.bootstrapTable('destroy')
                .bootstrapTable({
                    exportTypes: ['csv', 'txt', 'excel', 'pdf'],
                    locale: '{{ app()->getLocale() . '-' . strtoupper(app()->getLocale()) }}'
                });
        }

        $(function()
        {
            initTable();
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



        function priceFormatter(data) {
            return formatMoney(data);
        }

        function dateFormatter(data) {
            return moment(data).format(dateFormat);
        }

        function formatMoney(number, decPlaces, decSep, thouSep) {
            decPlaces = isNaN(decPlaces = Math.abs(decPlaces)) ? 2 : decPlaces,
                decSep = typeof decSep === "undefined" ? "." : decSep;
            thouSep = typeof thouSep === "undefined" ? "," : thouSep;
            var sign = number < 0 ? "-" : "";
            var i = String(parseInt(number = Math.abs(Number(number) || 0).toFixed(decPlaces)));
            var j = (j = i.length) > 3 ? j % 3 : 0;

            return sign +
                (j ? i.substr(0, j) + thouSep : "") +
                i.substr(j).replace(/(\decSep{3})(?=\decSep)/g, "$1" + thouSep) +
                (decPlaces ? decSep + Math.abs(number - i).toFixed(decPlaces).slice(2) : "");
        }
    </script>

@endsection
