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
                           data-toolbar="#toolbar"
                           data-buttons-class="primary"
                           data-query-params="queryParams"
                           data-url="{{ url('invoices') }}"
                           data-toggle="table"

                           data-show-refresh="true"
                           data-show-columns="true"
                           data-show-export="true"
                           data-striped="true"

                           data-minimum-count-columns="2"
                           data-side-pagination="server"
                           data-pagination="true"
                           data-page-size="10"
                           data-page-list="[10, 25, 50, 100]">
                        <thead>
                        <tr>
                            <th  data-switchable="false"></th>
                            {{-- ID --}}
                            <th data-field="ID"
                                data-switchable="false"
                                data-visible="false">
                                ID
                            </th>
                            {{-- SELEXPED_INV_ID --}}
                            <th data-field="SELEXPED_INV_ID"
                                data-switchable="false" data-visible="false">
                                SELEXPED_INV_ID
                            </th>
                            {{-- Inv_Num --}}
                            <th data-field="Inv_Num" data-sortable="true"
                                data-align="left" data-halign="center">
                                {{ trans('global.invoices.fields.inv_num') }}
                            </th>
                            {{-- Inv_SeqNum --}}
                            <th data-field="Inv_SeqNum" data-sortable="true"
                                data-align="right" data-halign="center">
                                {{ trans('global.invoices.fields.seq_num') }}
                            </th>
                            {{-- ACCT_Period --}}
                            <th data-field="ACCT_Period" data-sortable="true"
                                data-align="left" data-halign="center">
                                {{ trans('global.invoices.fields.period') }}
                            </th>
                            {{-- INV_Type_ID --}}
                            {{--<th data-field="INV_Type_ID" data-sortable="true">
                                INV_Type_ID
                            </th>--}}
                            {{-- InvType --}}
                            <th data-field="InvType" data-sortable="true"
                                data-align="left" data-halign="center">
                                {{ trans('global.invoices.fields.type_of_document') }}
                            </th>
                            {{-- Ref_Inv --}}
                            <th data-field="Ref_Inv" data-sortable="true"
                                data-align="left" data-halign="center">
                                {{ trans('global.invoices.fields.num_ref_doc') }}
                            </th>
                            {{-- Cancellation_ReasonCode --}}
                            <th data-field="Cancellation_ReasonCode" data-sortable="true"
                                data-align="left" data-halign="center">
                                {{ trans('global.invoices.fields.cancellation_reason_code') }}
                            </th>
                            {{-- Partner_ID --}}
                            {{--<th data-field="Partner_ID" data-sortable="true">Partner_ID</th>--}}
                            {{-- Partner_Name --}}
                            <th data-field="Partner_Name" data-sortable="true"
                                data-align="left" data-halign="center">
                                {{ trans('global.invoices.fields.account_partner_name') }}
                            </th>
                            {{-- Partner_Addr --}}
                            <th data-field="Partner_Addr" data-sortable="true"
                                data-align="left" data-halign="center">
                                {{ trans('global.invoices.fields.Partner_Addr') }}
                            </th>
                            {{-- Partner_Addr_District --}}
                            <th data-field="Partner_Addr_District" data-sortable="true"
                                data-align="left" data-halign="center">
                                {{ trans('global.invoices.fields.partner_addr_district') }}
                            </th>
                            {{-- Partner_Addr_ps_type --}}
                            <th data-field="Partner_Addr_ps_type" data-sortable="true"
                                data-align="left" data-halign="center">
                                {{ trans('global.invoices.fields.partner_addr_ps_type') }}
                            </th>
                            {{-- Partner_Addr_housenr --}}
                            <th data-field="Partner_Addr_housenr" data-sortable="true"
                                data-align="left" data-halign="center">
                                {{ trans('global.invoices.fields.partner_addr_housenr') }}
                            </th>
                            {{-- Partner_Addr_building --}}
                            <th data-field="Partner_Addr_building" data-sortable="true"
                                data-align="left" data-halign="center">
                                {{ trans('global.invoices.fields.partner_addr_building') }}
                            </th>
                            {{-- Partner_Addr_stairway --}}
                            <th data-field="Partner_Addr_stairway" data-sortable="true"
                                data-align="left" data-halign="center">
                                {{ trans('global.invoices.fields.partner_addr_stairway') }}
                            </th>
                            {{-- Partner_Addr_floor --}}
                            <th data-field="Partner_Addr_floor" data-sortable="true"
                                data-align="left" data-halign="center">
                                {{ trans('global.invoices.fields.partner_addr_floor') }}
                            </th>
                            {{-- Partner_Addr_door --}}
                            <th data-field="Partner_Addr_door" data-sortable="true"
                                data-align="left" data-halign="center">
                                {{ trans('global.invoices.fields.partner_addr_door') }}
                            </th>
                            {{-- Partner_Country --}}
                            <th data-field="Partner_Country" data-sortable="true"
                                data-align="left" data-halign="center">
                                {{ trans('global.invoices.fields.partner_country') }}
                            </th>
                            {{-- Partner_ZIP --}}
                            <th data-field="Partner_ZIP" data-sortable="true"
                                data-align="left" data-halign="center">
                                {{ trans('global.invoices.fields.partner_zip') }}
                            </th>
                            {{-- Partner_City --}}
                            <th data-field="Partner_City" data-sortable="true"
                                data-align="left" data-halign="center">
                                {{ trans('global.invoices.fields.partner_city') }}
                            </th>

                            {{--<th data-field="Partner_Country_ZIP_City" data-sortable="true">
                                Partner_Country_ZIP_City
                            </th>--}}
                            <th data-field="Partner_Bank_Account" data-sortable="true"
                                data-align="left" data-halign="center">
                                {{ trans('global.invoices.fields.bank_code') }}
                            </th>
                            <th data-field="Period_From_To" data-sortable="true"
                                data-align="left" data-halign="center">
                                {{ trans('global.invoices.fields.period_to_from') }}
                            </th>
                            <th data-field="PayStatus" data-sortable="true"
                                data-align="left" data-halign="center">
                                {{ trans('global.invoices.fields.pay_status') }}
                            </th>

                            <th data-field="Subcontracted_Services" data-sortable="true"
                                data-align="left" data-halign="center">
                                {{ trans('global.invoices.fields.subcontracted_services') }}
                            </th>
                            <th data-field="InvDate" data-sortable="true"
                                data-align="left" data-halign="center">
                                {{ trans('global.invoices.fields.inv_date') }}
                            </th>
                            <th data-field="DeliveryDate" data-sortable="true"
                                data-align="left" data-halign="center">
                                {{ trans('global.invoices.fields.delivery_date') }}
                            </th>
                            {{--<th data-field="PaymentMethod_ID" data-sortable="true">
                                PaymentMethod_ID
                            </th>--}}
                            <th data-field="PaymentMethod" data-sortable="true"
                                data-align="left" data-halign="center">
                                {{ trans('global.invoices.fields.payment_method') }}
                            </th>

                            <th data-field="DueDate" data-sortable="true"
                                data-align="left" data-halign="center">
                                {{ trans('global.invoices.fields.due_date') }}
                            </th>
                            <th data-field="DeliveryDate" data-sortable="true"
                                data-align="left" data-halign="center">
                                {{ trans('global.invoices.fields.delivery_date') }}
                            </th>
                            {{--<th data-field="PaymentMethod_ID" data-sortable="true">
                                PaymentMethod_ID
                            </th>--}}
                            {{--<th data-field="PaymentMethod" data-sortable="true">
                                {{ trans('global.invoices.fields.payment_method') }}
                            </th>--}}

                            <th data-field="PostInDate" data-sortable="true"
                                data-align="left" data-halign="center">
                                {{ trans('global.invoices.fields.postin_date') }}
                            </th>
                            <th data-field="Fully_paid_date" data-sortable="true"
                                data-align="right" data-halign="center">
                                {{ trans('global.invoices.fields.fully_paid_date') }}
                            </th>

                            <th data-field="Net_LC" data-sortable="true"
                                data-align="right" data-halign="center">
                                {{ trans('global.invoices.fields.net_lc') }}
                            </th>
                            <th data-field="Tax_LC" data-sortable="true"
                                data-align="right" data-halign="center">
                                {{ trans('global.invoices.fields.tax_lc') }}
                            </th>
                            <th data-field="Gross_LC" data-sortable="true"
                                data-align="right" data-halign="center">
                                {{ trans('global.invoices.fields.gross_lc') }}
                            </th>


                            <th data-field="PaidAmount_LC" data-sortable="true"
                                data-align="right" data-halign="center">
                                {{ trans('global.invoices.fields.paid_amount_lc') }}
                            </th>
                            <th data-field="PaidAmount_DC" data-sortable="true"
                                data-align="right" data-halign="center">
                                {{ trans('global.invoices.fields.paid_amount_dc') }}
                            </th>
                            <th data-field="PaidAmount_FC" data-sortable="true"
                                data-align="right" data-halign="center">
                                {{ trans('global.invoices.fields.paid_amount_fc') }}
                            </th>

                            <th data-field="Net_DC" data-sortable="true"
                                data-align="right" data-halign="center">
                                {{ trans('global.invoices.fields.net_dc') }}
                            </th>
                            <th data-field="Tax_DC" data-sortable="true"
                                data-align="right" data-halign="center">
                                {{ trans('global.invoices.fields.tax_dc') }}
                            </th>
                            <th data-field="Gross_DC" data-sortable="true"
                                data-align="right" data-halign="center">
                                {{ trans('global.invoices.fields.gross_dc') }}
                            </th>
                            <th data-field="Curr_DC" data-sortable="true"
                                data-align="right" data-halign="center">
                                {{ trans('global.invoices.fields.curr_dc') }}
                            </th>

                            <th data-field="Net_FC" data-sortable="true"
                                data-align="right" data-halign="center">
                                {{ trans('global.invoices.fields.curr_fc') }}
                            </th>
                            <th data-field="Tax_FC" data-sortable="true"
                                data-align="right" data-halign="center">
                                {{ trans('global.invoices.fields.tax_fc') }}
                            </th>
                            <th data-field="Gross_FC" data-sortable="true"
                                data-align="right" data-halign="center">
                                {{ trans('global.invoices.fields.gross_fc') }}
                            </th>

                            <th data-field="Remarks" data-sortable="true"
                                data-align="left" data-halign="center">
                                {{ trans('global.invoices.fields.remarks') }}
                            </th>
                            <th data-field="Attachments" data-sortable="true"
                                data-align="left" data-halign="center">
                                {{ trans('global.invoices.fields.attachments') }}
                            </th>
                            {{--<th data-field="Added_User" data-sortable="true">Added_User</th>--}}
                            <th data-field="Added_User_Name" data-sortable="true"
                                data-align="left" data-halign="center">
                                {{ trans('global.invoices.fields.added_user_name') }}
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
        table.table.table-striped.table-bordered td{
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>

@endsection
@section('js')
    {{-- Bootstrap Table --}}
    <script src="{{ asset('assets/bower_components/bootstrap-table/1.15.5/tableExport.min.js') }}"
            type="text/javascript"></script>
    {{--
    <script src="{{ asset('assets/bower_components/bootstrap-table/1.15.5/libs/jspdf.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/bower_components/bootstrap-table/1.15.5/libs/jspdf.plugin.autotable.js') }}"
            type="text/javascript"></script>
    --}}

    {{--<script src="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/locale/bootstrap-table-hu-HU.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/extensions/export/bootstrap-table-export.js"></script>--}}
    <script src="{{ asset('assets/bower_components/bootstrap-table/1.15.5/bootstrap-table.min.js') }}"></script>
    <script src="{{ asset('assets/bower_components/bootstrap-table/1.15.5/locale/bootstrap-table-hu-HU.js') }}"></script>
    <script src="{{ asset('assets/bower_components/bootstrap-table/1.15.5/extensions/export/bootstrap-table-export.js') }}"></script>
    {{--
    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/extensions/cookie/bootstrap-table-cookie.js"></script>
    --}}
    <!--
    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/extensions/toolbar/bootstrap-table-toolbar.min.js"></script>
    -->
    {{-- Moment --}}
    <script src="{{ asset('assets/bower_components/moment/moment.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/bower_components/moment/locale/hu.js') }}" type="text/javascript"></script>

    {{-- Daterange Picker --}}
{{--    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>--}}
    <script src="{{ asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}" type="text/javascript"></script>

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
                        formatter: operateFormatter
                    }]
                });
        }

        $(function()
        {
            initTable();
        });

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

        function operateFormatter(value, row, index) {

            //console.log(row);
            $url = '{{ url('invoices.show') }}' + '/' + row.SELEXPED_INV_ID;

            return [
                '<a href="' + $url + '" class="btn btn-success btn-sm view"><i class="fa fa-eye"></i></a>',
                '<a href="mailto:?from=from@email.hu&to=to@email.hu&subject=Kérdések a ' + row.Inv_Num + ' számlával kapcsolatban&body=Tisztelt ' + row.Cust_Name1 + ' !%0D%0AÜdvözlettel: ' + row.Vendor_Name1 + '" '+
                'class="btn btn-info btn-sm" style="margin-left: 10px;">'+
                '<i class="fa fa-envelope"></i>'+
                '</a>'
            ].join('')
        }



        /*
        function FormatNumber(number, numberOfDigits = 2)
        {
            try
            {
                retVal = parseFloat(number).toFixed(2);
            } catch (error) {
                retVal =  0;
            }

            return retVal;
        }
        */

    </script>
@endsection
