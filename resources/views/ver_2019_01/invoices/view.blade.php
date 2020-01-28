@extends('layouts.app')
@section('title', __('global.invoice.title'))

@section('content')

    @php
        $format = (config('appConfig.dateFormats'))[config('app.locale')]['carbon'];
        //$currency_template = config('appConfig.currencies.' . config('app.locale'));
    @endphp

    <section class="content-header">
        <h1>
            {{ __('global.invoice.title') }}
            <small>{{ __('global.invoice.sub_title') }}</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('/') }}">
                    <i class="fa fa-dashboard"></i>&nbsp;
                    {{ __('global.app_dashboard') }}
                </a>
            </li>
            <li>
                <a href="{{ url('invoices') }}">
                    <i class="fa fa-file-text-o"></i>&nbsp;
                    {{ __('global.invoices.title') }}
                </a>
            </li>
            <li class="active">
                <i class="fa fa-file-text-o"></i>&nbsp;
                {{ __('global.invoice.title') }}
            </li>
        </ol>
    </section>

    <section class="invoice">
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <i class="fa fa-globe"></i>&nbsp;{{ __('global.invoice.title') }}
                    @php
                        /** @var TYPE_NAME $invoice */
                        /** @var string $format */
                        $datum = Carbon\Carbon::parse($invoice->InvDate)->format($format);
                    @endphp
                    <small class="pull-right"><b>{{ __('global.app_date') }}:</b> {{ $datum }}</small>
                </h2>
            </div>
        </div>

        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                {{ __('global.app_from') }}
                <address>
                    <strong>{{ $invoice->Vendor_Name1 }}</strong><br>
                    @if( !empty($invoice->Vendor_ZIP) && !empty($invoice->Vendor_City) )
                        {{ $invoice->Vendor_ZIP }}, {{ $invoice->Vendor_City }}
                    @endif
                    <br>
                    {{ (!empty($invoice->Vendor_Addr)) ? $invoice->Vendor_Addr : '' }}&nbsp;
                    {{ (!empty($invoice->Vendor_Addr_ps_type)) ? $invoice->Vendor_Addr_ps_type : '' }}&nbsp;
                    {{ (!empty($invoice->Vendor_Addr_housenr)) ? $invoice->Vendor_Addr_housenr : '' }}
                    <br>
                    <b>@lang('global.app_phone'):</b>&nbsp;{{ $invoice->Vendor_Phone }}<br>
                    <b>@lang('global.app_email'):</b>&nbsp;{{ $invoice->Vendor_Email }}
                </address>

            </div>

            <div class="col-sm-4 invoice-col">
                @lang('global.app_to')
                <address>
                    <strong>{{ $invoice->Cust_Name1 }}</strong><br>
                    {{ $invoice->Cust_ZIP }}, {{ $invoice->Cust_City }}<br>
                    {{ $invoice->Cust_Addr }} {{ $invoice->Cust_Addr_ps_type }} {{ $invoice->Cust_Addr_housenr }}<br>
                    <b>@lang('global.app_phone'):</b>&nbsp;{{ $invoice->Customer_Phone }}<br>
                    <b>@lang('global.app_email'):</b>&nbsp;{{ $invoice->Customer_Email }}
                </address>
            </div>

            <div class="col-sm-4 invoice-col">
                <b>@lang('global.invoice.account_number'):</b>&nbsp;{{ $invoice->Inv_Num }}<br/>
                <b>@lang('global.invoice.inv_seq_num'):</b>&nbsp;{{ $invoice->Inv_SeqNum }}<br/>
                @php
                    $datum = Carbon\Carbon::parse($invoice->DueDate)->format($format);
                @endphp
                <b>@lang('global.invoice.payment_due'):</b>&nbsp;{{ $datum }}<br>
            <!--
                <b>@lang('global.invoice.account_number'):</b>&nbsp;{{-- $invoice->Cust_BankAcc --}}
                -->
            </div>

        </div>

        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table id="table" name="table" class="table table-striped table-bordered"
                       data-id-field="ID"

                       data-toolbar="#toolbar"

                       data-url="{{ url('invoices.show', $invoice->SELEXPED_INV_ID) }}"

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
                       data-show-columns="false"
                       data-show-columns-toggle-all="false"
                       data-show-export="false"
                       data-show-pagination-switch="false"

                       data-minimum-count-columns="2"
                       data-striped="true"

                       data-pagination="true"
                       data-page-size="10"
                       data-page-list="[10, 25, 50, 100]"

                       data-show-footer="true">
                    <thead>
                    <tr>
                        <th data-field="Descr"
                            data-footer-formatter="totalTextFormatter"
                            data-halign="center" data-align="left"
                            data-sortable="true" data-searchable="true" data-switchable="true">
                            {{ trans('global.invoice.fields.product') }}
                        </th>
                        <th data-field="Pcs" data-formatter="pcs_formatter"
                            data-footer-formatter="totalNameFormatter"
                            data-halign="center" data-align="right"
                            data-sortable="true" data-searchable="true" data-switchable="true">
                            {{ trans('global.invoice.fields.qty') }}
                        </th>
                        <th data-field="Unit"
                            data-halign="center" data-align="left"
                            data-sortable="true" data-searchable="true" data-switchable="true">
                            {{ trans('global.invoice.fields.qty_unit') }}
                        </th>
                        <th data-field="UnitPrice_DC"
                            data-formatter="priceFormatter"
                            data-halign="center" data-align="right"
                            data-sortable="true" data-searchable="true" data-switchable="true">
                            {{ trans('global.invoice.fields.unit_price') }}
                        </th>
                        <th data-field="Netto_DC"
                            data-formatter="priceFormatter"
                            data-footer-formatter="totalPriceFormatter"
                            data-halign="center" data-align="right"
                            data-sortable="true" data-searchable="true" data-switchable="true">
                            {{ trans('global.invoice.fields.net') }}
                        </th>
                        <th data-field="TaxRate"
                            data-formatter="percentFormatter"
                            data-halign="center" data-align="right"
                            data-sortable="true" data-searchable="true" data-switchable="true">
                            {{ trans('global.invoice.fields.vat') }}
                        </th>
                        <th data-field="Tax_DC"
                            data-footer-formatter="totalPriceFormatter"
                            data-formatter="priceFormatter"
                            data-halign="center" data-align="right"
                            data-sortable="true" data-searchable="true" data-switchable="true">
                            {{ trans('global.invoice.fields.vat_value') }}
                        </th>
                        <th data-field="Brutto_DC"
                            data-formatter="priceFormatter"
                            data-footer-formatter="totalPriceFormatter"
                            data-halign="center" data-align="right"
                            data-sortable="true" data-searchable="true" data-switchable="true">
                            {{ trans('global.invoice.fields.gross') }}
                        </th>
                    </tr>
                    </thead>

                </table>
            </div>
        </div>

        <div class="row">
            <a href="{{ url('invoices') }}"
               class="btn btn-default">
                {{ __('global.app_back_to_list') }}
            </a>
        </div>

    </section>


@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/bower_components/bootstrap-table/1.15.5/bootstrap-table.css') }}"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    @php
        echo "<!-- MENU BACGROUND COLOR -->\n";
        echo "<style>.skin-blue .main-sidebar, .skin-blue .left-side {background-color: " . \App\Classes\Helper::getMenuBgColor('invoices') . ";}</style>\n";
        echo "<!-- HEADER BG COLOR -->\n";
        $header_bg_color = \App\Classes\Helper::getHeaderBgColor('users');
        echo "<style>.skin-blue .main-header .navbar {background-color: " . $header_bg_color . ";} .skin-blue .main-header .logo {background-color: " . $header_bg_color . ";}</style>\n";
        echo "<style>.skin-blue .main-header .logo {background-color: " . $header_bg_color . ";}</style>\n";

        echo "<!-- PANEL AND TAB COLOR -->\n";
        echo "<style>.box.box-default {border-top-color: " . \App\Classes\Helper::getPanelTabLineColor('invoices') . ";}</style>\n";
    @endphp
@endsection
@section('js')
    {{-- Bootstrap Table --}}
    <!--
    <script src="{{-- asset('assets/bower_components/bootstrap-table/1.15.5/tableExport.min.js') --}}" type="text/javascript"></script>
    -->
    <!--
    <script src="{{-- asset('assets/bower_components/bootstrap-table/1.15.5/libs/jspdf.min.js') --}}" type="text/javascript"></script>
    <script src="{{-- asset('assets/bower_components/bootstrap-table/1.15.5/libs/jspdf.plugin.autotable.js') --}}" type="text/javascript"></script>
    -->
    <script src="{{ asset('assets/bower_components/bootstrap-table/1.15.5/bootstrap-table.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/bower_components/bootstrap-table/1.15.5/locale/bootstrap-table-hu-HU.js') }}" type="text/javascript"></script>
    <!--
    <script src="{{-- asset('assets/bower_components/bootstrap-table/1.15.5/extensions/export/bootstrap-table-export.js') --}}" type="text/javascript"></script>
    -->
    {{-- Moment --}}
    <!--<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>-->

    {{-- Daterange Picker --}}
    <!--<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>-->


    <script>
        var $table = $('#table');

        function pcs_formatter(value, row, index)
        {
            return parseInt(value);
        }

        function percentFormatter(value)
        {
            return parseInt(value) + ' %';
        }

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

        function totalPriceFormatter(data)
        {
            retVal = '0';

            if( data.length != 0 )
            {
                var field = this.field;

                switch (field) {
                    case 'Netto_DC':
                        retVal = '{{ $invoice->Netto_DC }}';
                        break;
                    case 'Tax_DC':
                        retVal = '{{ $invoice->Tax_DC }}';
                        break;
                    case 'Brutto_DC':
                        retVal = '{{ $invoice->Brutto_DC }}';
                        break;
                    default:
                        break;
                }

                retVal = new Intl.NumberFormat(
                    '{{ app()->getLocale() . '-' . strtoupper(app()->getLocale()) }}',
                    {
                        style: 'currency',
                        currency: '{{ $invoice->Curr_DC }}'
                    }).format(retVal);
            }
            return retVal;
        }

        function totalTextFormatter(data)
        {
            return 'Total';
        }

        function totalNameFormatter(data)
        {
            return data.length;
        }

        function initTable()
        {
            $table
                .bootstrapTable('destroy')
                .bootstrapTable({
                    locale: '{{ app()->getLocale() . '-' . strtoupper(app()->getLocale()) }}'
                });
        }

        $(function(){
            initTable();
        });
    </script>
@endsection
