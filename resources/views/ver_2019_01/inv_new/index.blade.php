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

        <!-- TÁBLÁZAT -->
        <div class="table-responsive mailbox-messages">
            <table id="table" name="table" class="table table-striped table-bordered"
                   data-id-field="ID"
                   data-toolbar="#toolbar"
                   data-url="{{ url('inv_new') }}"
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
                    <!--SzlaSzam-->
                    <th data-field="SzlaSzam"
                        data-align="left" data-halign="left">
                        {{ trans('global.invoices.fields.inv_num') }}
                    </th>
                    <!--Iktatosorszam-->
                    <th data-field="Iktatosorszam"
                        data-align="left" data-halign="left"
                        data-sortable="true">
                        {{ trans('global.invoices.fields.reg_num') }}
                    </th>
                    <!--Period-->
                    <th data-field="Period" data-align="left" data-halign="left">
                        {{ trans('global.invoices.fields.period') }}
                    </th>
                    <!--TipusID-->
                    <th data-field="TipusID" data-align="left" data-halign="left">
                        {{ trans('global.invoices.fields.type_of_document') }}
                    </th>
                    <!--Ref_Szamlak_ID-->
                    <th data-field="Ref_Szamlak_ID" data-align="left" data-halign="left">
                        {{ trans('global.invoices.fields.num_ref_doc') }}
                    </th>
                    <!--Cancellation_ReasonCode-->
                    <th>
                        {{ trans('global.invoices.fields.account_repair_reason') }}
                    </th>
                    <!--Cust_Name-->
                    <th data-field="Cust_Name" data-align="left" data-halign="left">
                        {{ trans('global.invoices.fields.account_partner_name') }}
                    </th>
                    <!--Cust_Address-->
                    <th data-field="Cust_Address" data-align="left" data-halign="left">
                        {{ trans('global.invoices.fields.cust_address') }}
                    </th>
                    <!--Vendor_Address-->
                    <th data-field="Vendor_Address" data-align="left" data-halign="left">
                        {{ trans('global.invoices.fields.vendor_address') }}
                    </th>
                    <!--VevoPenzforgJelz-->
                    <th data-field="VevoPenzforgJelz" data-align="left" data-halign="left">
                        {{ trans('global.invoices.fields.cust_bank_code') }}
                    </th>
                    <!--Bank Code-->
                    <th data-field="BankCode" data-align="left" data-halign="left">
                        {{ trans('global.invoices.fields.bank_code') }}
                    </th>
                    <!-- Class ID -->
                    <th data-field="ClassID" data-align="left" data-halign="left">
                        {{ trans('global.invoices.fields.class_id') }}
                    </th>
                    <!-- Period -->
                    <th data-field="Period" data-align="left" data-halign="left">
                        {{ trans('global.invoices.fields.period') }}
                    </th>
                    <!--Kelte-->
                    <th data-field="Kelte" data-align="left" data-halign="left" data-formatter="dateFormatter">
                        {{ trans('global.invoices.fields.date') }}
                    </th>
                    <!--Teljesitve-->
                    <th data-field="Teljesitve" data-align="left" data-halign="left" data-formatter="dateFormatter">
                        {{ trans('global.invoices.fields.completed') }}
                    </th>
                    <!--FizMod-->
                    <th data-field="FizMod" data-align="left" data-halign="left">
                        {{ trans('global.invoices.fields.payment') }}
                    </th>
                    <!--Lejarat-->
                    <th data-field="Lejarat" data-align="left" data-halign="left" data-formatter="dateFormatter">
                        {{ trans('global.invoices.fields.expiry') }}
                    </th>
                    <!--BeerkezesDatum-->
                    <th data-field="BeerkezesDatum" data-align="left" data-halign="left" data-formatter="dateFormatter">
                        {{ trans('global.invoices.fields.date_of_arrival') }}
                    </th>
                    <!--NettoOsszesen-->
                    <th data-field="NettoOsszesen" data-align="left" data-halign="left" data-formatter="decimalFormatter">
                        {{ trans('global.invoices.fields.net_total') }}
                    </th>
                    <!--AFAOsszesen-->
                    <th data-field="AFAOsszesen" data-align="left" data-halign="left"
                        data-formatter="decimalFormatter">
                        {{ trans('global.invoices.fields.tax_total') }}
                    </th>
                    <!--BruttoOsszesen-->
                    <th data-field="BruttoOsszesen" data-align="left" data-halign="left"
                        data-formatter="decimalFormatter">
                        {{ trans('global.invoices.fields.brut_total') }}
                    </th>
                    <!--FizAllapot-->
                    <th data-field="FizAllapot" data-align="left" data-halign="left">
                        {{ trans('global.invoices.fields.pay_status') }}
                    </th>
                    <!--Fully_paid_date-->
                    <th data-field="Fully_paid_date" data-align="left" data-halign="left"
                        data-formatter="dateFormatter">
                        {{ trans('global.invoices.fields.fully_paid_date') }}
                    </th>
                    <!--EddigKifizetve-->
                    <th data-field="EddigKifizetve" data-align="left" data-halign="left" data-formatter="decimalFormatter">
                        {{ trans('global.invoices.fields.paid_so_far') }}
                    </th>
                    <!--EddigKifizetveEUR-->
                    <th data-field="EddigKifizetveEUR" data-align="left" data-halign="left" data-formatter="decimalFormatter">
                        {{ trans('global.invoices.fields.paid_so_far_eur') }}
                    </th>
                    <!--EddigKifizetveFIBU-->
                    <th data-field="EddigKifizetveFIBU" data-align="left" data-halign="left" data-formatter="decimalFormatter">
                        {{ trans('global.invoices.fields.paid_so_far_fibu') }}
                    </th>
                    <!--FWGesamtNetto-->
                    <th data-field="FWGesamtNetto" data-align="left" data-halign="left" data-formatter="decimalFormatter">
                        {{ trans('global.invoices.fields.netto_dc') }}
                    </th>
                    <!--FWGesamtMwSt-->
                    <th data-field="FWGesamtMwSt" data-align="left" data-halign="left">
                        {{ trans('global.invoices.fields.tax_dc') }}
                    </th>
                    <!--FWGesamtBrutto-->
                    <th data-field="FWGesamtBrutto" data-align="left" data-halign="left" data-formatter="decimalFormatter">
                        {{ trans('global.invoices.fields.brutto_dc') }}
                    </th>
                    <!--Wahrung-->
                    <th data-field="Wahrung" data-align="left" data-halign="left">
                        {{ trans('global.invoices.fields.curr_id') }}
                    </th>
                    <!--EURNetto-->
                    <th data-field="EURNetto" data-align="left" data-halign="left" data-formatter="decimalFormatter">
                        {{ trans('global.invoices.fields.netto_eur') }}
                    </th>
                    <!--EURMwSt-->
                    <th data-field="EURMwSt" data-align="left" data-halign="left" data-formatter="decimalFormatter">
                        {{ trans('global.invoices.fields.tax_fc') }}
                    </th>
                    <!--EURBrutto-->
                    <th data-field="EURBrutto" data-align="left" data-halign="left" data-formatter="decimalFormatter">
                        {{ trans('global.invoices.fields.brutto_eur') }}
                    </th>
                    <!--Bemerkung-->
                    <th data-field="Bemerkung" data-align="left" data-halign="left">
                        {{ trans('global.invoices.fields.bemerkung') }}
                    </th>
                    <!--Mellekletek-->
                    <th data-field="Mellekletek" data-align="left" data-halign="left">
                        {{ trans('global.invoices.fields.attachment') }}
                    </th>
                    <!--FelvUserID-->
                    <th data-field="FelvUserID" data-align="left" data-halign="left">
                        {{ trans('global.invoices.fields.iktatta') }}
                    </th>
                    <!--Subcontracted_Services-->
                    <th data-field="Subcontracted_Services" data-align="left" data-halign="left">
                        {{ trans('global.invoices.fields.subcontracted_services') }}
                    </th>
                </tr>
                </thead>
            </table>
        </div>
        <!-- /.TÁBLÁZAT -->

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

        var $table = $('#table');
        var dateFormat   = '{{ (config('appConfig.dateFormats'))[config('app.locale')]['moment'] }}';
        var priceFormat  = '{{ (config('appConfig.currencies.' . config('app.locale'))) }}';

        function initTable()
        {
            $table
                .bootstrapTable('destroy')
                .bootstrapTable({
                    exportTypes: ['excel'],
                    locale: '{{ app()->getLocale() . '' . strtoupper(app()->getLocale()) }}'
                });
        }

        $(function()
        {
            initTable();
        });

        function dateFormatter(data)
        {
            return moment(data).format(dateFormat);
        }

        function decimalFormatter(data)
        {
            //console.log( FormatNumber(data) );
            return FormatNumber(data);
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
