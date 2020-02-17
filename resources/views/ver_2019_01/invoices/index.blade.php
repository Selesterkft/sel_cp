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

        <div class="box box-default">
            <div class="box-body">
                <div class="table-responsive">
                    <table id="table" name="table"
                           class="table table-striped table-bordered"
                           data-id-field="ID"
                           data-toolbar="#toolbar"

                           data-query-params="queryParams"
                           data-url="{{ url('invoices') }}"
                           data-buttons-class="primary"
                           data-toggle="table"
                           data-search="false"
                           data-show-search-button="false"
                           data-search-on-enter-key="false"
                           data-side-pagination="server"
                           data-virtual-scroll="true"

                           data-show-refresh="true"
                           data-show-toggle="false"
                           data-show-fullscreen="false"
                           data-show-columns="true"
                           data-show-columns-toggle-all="false"
                           data-show-export="true"
                           data-show-pagination-switch="false"

                           data-detail-formatter="detailFormatter"
                           data-minimum-count-columns="2"
                           data-striped="true"

                           data-cookie="true"
                           data-cookie-id-table="saveId"

                           data-pagination="true"
                           data-pagination-v-align="both"
                           data-page-size="10"
                           data-page-list="[10, 25, 50, 100]"

                           data-show-footer="true">
                        <thead>
                        <tr>
                            <th data-field="Inv_ID" data-visible="true" data-halign="left" data-align="right" data-sortable="true" data-switchable="true">
                                {{ trans('global.invoices2.fields.Inv_ID') }}</th>
                            <th data-field="SELEXPED_INV_ID" data-halign="left" data-align="right" data-sortable="true" data-switchable="true">
                                {{ trans('global.invoices2.fields.SELEXPED_INV_ID') }}</th>
                            <th data-field="Inv_Num" data-halign="left" data-align="right" data-sortable="true" data-switchable="true">
                                {{ trans('global.invoices2.fields.Inv_Num') }}</th>
                            <th data-field="Inv_SeqNum" data-halign="left" data-align="right" data-sortable="true" data-switchable="true">
                                {{ trans('global.invoices2.fields.Inv_SeqNum') }}</th>
                            <th data-field="ACCT_Period" data-halign="left" data-align="right" data-sortable="true" data-switchable="true">
                                {{ trans('global.invoices2.fields.ACCT_Period') }}</th>
                            <th data-field="INV_Type_ID" data-halign="left" data-align="right" data-sortable="true" data-switchable="true">
                                {{ trans('global.invoices2.fields.INV_Type_ID') }}</th>
                            <th data-field="INV_Type" data-halign="left" data-align="right" data-sortable="true" data-switchable="true">
                                {{ trans('global.invoices2.fields.INV_Type') }}</th>
                            <th data-field="Ref_Inv" data-halign="left" data-align="right" data-sortable="true" data-switchable="true">
                                {{ trans('global.invoices2.fields.Ref_Inv') }}</th>
                            <th data-field="Cancellation_ReasonCode" data-halign="left" data-align="right" data-sortable="true" data-switchable="true">
                                {{ trans('global.invoices2.fields.Cancellation_ReasonCode') }}</th>
                            <th data-field="Partner_Name" data-halign="left" data-align="right" data-sortable="true" data-switchable="true">
                                {{ trans('global.invoices2.fields.Partner_Name') }}</th>
                            <th data-field="Partner_Address" data-halign="left" data-align="right" data-sortable="true" data-switchable="true">
                                {{ trans('global.invoices2.fields.Partner_Address') }}</th>
                            <th data-field="Partner_Country_ZIP_City" data-halign="left" data-align="right" data-sortable="true" data-switchable="true">
                                {{ trans('global.invoices2.fields.Partner_Country_ZIP_City') }}</th>
                            <th data-field="Partner_Bank_Account" data-halign="left" data-align="right" data-sortable="true" data-switchable="true">
                                {{ trans('global.invoices2.fields.Partner_Bank_Account') }}</th>
                            <th data-field="Type_of_Invoice" data-halign="left" data-align="right" data-sortable="true" data-switchable="true">
                                {{ trans('global.invoices2.fields.Type_of_Invoice') }}</th>
                            <th data-field="Period_From_To" data-halign="left" data-align="right" data-sortable="true" data-switchable="true">
                                {{ trans('global.invoices2.fields.Period_From_To') }}
                            </th>

                            <th data-field="InvDate" data-halign="left" data-align="right" data-sortable="true"
                                data-switchable="true"
                                data-formatter="dateFormatter">
                                {{ trans('global.invoices2.fields.InvDate') }}
                            </th>

                            <th data-field="DeliveryDate" data-halign="left" data-align="right" data-sortable="true"
                                data-switchable="true" data-formatter="dateFormatter">
                                {{ trans('global.invoices2.fields.DeliveryDate') }}
                            </th>
                            <th data-field="PaymentMethod_ID" data-halign="left" data-align="right" data-sortable="true" data-switchable="true">
                                {{ trans('global.invoices2.fields.PaymentMethod_ID') }}</th>
                            <th data-field="PaymentMethod" data-halign="left" data-align="right" data-sortable="true" data-switchable="true">
                                {{ trans('global.invoices2.fields.PaymentMethod') }}</th>
                            <th data-field="DueDate" data-halign="left" data-align="right" data-sortable="true"
                                data-switchable="true" data-formatter="dateFormatter">
                                {{ trans('global.invoices2.fields.DueDate') }}
                            </th>
                            <th data-field="PostInDate" data-halign="left" data-align="right" data-sortable="true"
                                data-switchable="true" data-formatter="dateFormatter">
                                {{ trans('global.invoices2.fields.PostInDate') }}
                            </th>
                            <th data-field="Net_LC" data-halign="left" data-align="right" data-sortable="true" data-switchable="true">
                                {{ trans('global.invoices2.fields.Net_LC') }}
                            </th>
                            <th data-field="Tax_LC" data-halign="left" data-align="right" data-sortable="true" data-switchable="true">
                                {{ trans('global.invoices2.fields.Tax_LC') }}</th>
                            <th data-field="Gross_LC" data-halign="left" data-align="right" data-sortable="true" data-switchable="true">
                                {{ trans('global.invoices2.fields.Gross_LC') }}</th>
                            <th data-field="PayStatus_ID" data-halign="left" data-align="right" data-sortable="true" data-switchable="true">
                                {{ trans('global.invoices2.fields.PayStatus_ID') }}</th>
                            <th data-field="PayStatus" data-halign="left" data-align="right" data-sortable="true" data-switchable="true">
                                {{ trans('global.invoices2.fields.PayStatus') }}</th>
                            <th data-field="PaidAmount_DC" data-halign="left" data-align="right" data-sortable="true" data-switchable="true">
                                {{ trans('global.invoices2.fields.PaidAmount_DC') }}</th>
                            <th data-field="PaidAmount_FC" data-halign="left" data-align="right" data-sortable="true" data-switchable="true">
                                {{ trans('global.invoices2.fields.PaidAmount_FC') }}</th>
                            <th data-field="PaidAmount_LC" data-halign="left" data-align="right" data-sortable="true" data-switchable="true">
                                {{ trans('global.invoices2.fields.PaidAmount_LC') }}</th>
                            <th data-field="Net_DC" data-halign="left" data-align="right" data-sortable="true" data-switchable="true">
                                {{ trans('global.invoices2.fields.Net_DC') }}</th>
                            <th data-field="Tax_DC" data-halign="left" data-align="right" data-sortable="true" data-switchable="true">
                                {{ trans('global.invoices2.fields.Tax_DC') }}</th>
                            <th data-field="Gross_DC" data-halign="left" data-align="right" data-sortable="true" data-switchable="true">
                                {{ trans('global.invoices2.fields.Gross_DC') }}</th>
                            <th data-field="Curr_DC" data-halign="left" data-align="right" data-sortable="true" data-switchable="true">
                                {{ trans('global.invoices2.fields.Curr_DC') }}</th>
                            <th data-field="Net_FC" data-halign="left" data-align="right" data-sortable="true" data-switchable="true">
                                {{ trans('global.invoices2.fields.Net_FC') }}</th>
                            <th data-field="Tax_FC" data-halign="left" data-align="right" data-sortable="true" data-switchable="true">
                                {{ trans('global.invoices2.fields.Tax_FC') }}</th>
                            <th data-field="Gross_FC" data-halign="left" data-align="right" data-sortable="true" data-switchable="true">
                                {{ trans('global.invoices2.fields.Gross_FC') }}</th>
                            <th data-field="Remarks" data-halign="left" data-align="right" data-sortable="true" data-switchable="true">
                                {{ trans('global.invoices2.fields.Remarks') }}</th>
                            <th data-field="Attachments" data-halign="left" data-align="right" data-sortable="true" data-switchable="true">
                                {{ trans('global.invoices2.fields.Attachments') }}</th>
                            <th data-field="Added_User" data-halign="left" data-align="right" data-sortable="true" data-switchable="true">
                                {{ trans('global.invoices2.fields.Added_User') }}
                            </th>
                        </tr>
                        </thead>
                    </table>

                    <!-- SEARCH MODAL -->
                    @includeIf('modals.modal_search2', [
                        'fields' => 'ver_2019_01.invoices.partials.fields_search',
                        'title' => __('global.app_search_title'),
                        'url' => 'invoices',
                    ])

                </div>
            </div>
        </div>



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

    <style>
        table.table.table-striped.table-bordered td,
        table.table.table-striped.table-bordered td.text {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>

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
        var $table = $('#table');
        var $local = '{{ app() ->getLocale() }}' + '-' + '{{ strtoupper(app()->getLocale()) }}';
        var $local_short = '{{ app() ->getLocale() }}';
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

        function dateFormatter(data)
        {
            return moment().locale($local_short).format('L');
        }

        function decimalFormatter(data)
        {
            return FormatNumber(data);
        }

        function initTable()
        {
            $table
                .bootstrapTable('destroy')
                .bootstrapTable({
                    exportTypes: ['excel'],
                    locale: $local,
                    columns: [{
                        field: 'operate',
                        title: '{{ trans('global.app_fields.operations') }}',
                        align: 'center',
                        clickToSelect: false,
                        sortable: false,
                        events: window.operateEvents,
                        formatter: operateFormatter
                    }]
                });
        }

        $(function()
        {
            initTable();
        });

        function operateFormatter(value, row, index) {

            $url = '{{ url('invoices.show') }}' + '/' + row.SELEXPED_INV_ID;

            return [
                '<a href="' + $url + '" class="btn btn-success btn-sm view"><i class="fa fa-eye"></i></a>',
                '<a href="mailto:?from=from@email.hu&to=to@email.hu&subject=Kérdések a ' + row.Inv_Num + ' számlával kapcsolatban&body=Tisztelt ' + row.Cust_Name1 + ' !%0D%0AÜdvözlettel: ' + row.Vendor_Name1 + '" '+
                'class="btn btn-info btn-sm" style="margin-left: 10px;">'+
                '<i class="fa fa-envelope"></i>'+
                '</a>'
            ].join('')
        }

        function FormatNumber(number, numberOfDigits = 2)
        {
            try
            {
                retVal = new Intl.NumberFormat($local).format(parseFloat(number).toFixed(2));
            } catch (error) {
                retVal =  0;
            }

            console.log($local, number, retVal);

            return retVal;
        }

    </script>

@endsection
