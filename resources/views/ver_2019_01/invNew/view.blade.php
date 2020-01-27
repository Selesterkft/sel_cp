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
                       data-buttons-class="primary"
                       data-toggle="table"
                       data-search="false"
                       data-show-search-button="true"
                       data-search-on-enter-key="true"

                       data-virtual-scroll="true"

                       data-show-refresh="false"
                       data-show-toggle="false"
                       data-show-fullscreen="false"
                       data-show-columns="false"
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
                        <th data-halign="center" data-align="left" data-sortable="true" data-searchable="true"
                            data-switchable="true">@lang('global.invoice.fields.product')</th>
                        <th data-halign="center" data-align="left" data-sortable="true" data-searchable="true"
                            data-switchable="true">@lang('global.invoice.fields.qty')</th>
                        <th data-halign="center" data-align="left" data-sortable="true" data-searchable="true"
                            data-switchable="true">@lang('global.invoice.fields.qty_unit')</th>
                        <th data-halign="center" data-align="left" data-sortable="true" data-searchable="true"
                            data-switchable="true">@lang('global.invoice.fields.unit_price')</th>
                        <th data-halign="center" data-align="left" data-sortable="true" data-searchable="true"
                            data-switchable="true">@lang('global.invoice.fields.net')</th>
                        <th data-halign="center" data-align="left" data-sortable="true" data-searchable="true"
                            data-switchable="true">@lang('global.invoice.fields.vat')</th>
                        <th data-halign="center" data-align="left" data-sortable="true" data-searchable="true"
                            data-switchable="true">@lang('global.invoice.fields.vat_value')</th>
                        <th data-halign="center" data-align="left" data-sortable="true" data-searchable="true"
                            data-switchable="true">@lang('global.invoice.fields.gross')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $f = new \NumberFormatter(app()->getLocale(), \NumberFormatter::CURRENCY);
                        $f->setAttribute($f::FRACTION_DIGITS, 2);
                    @endphp
                    @foreach($details as $detail)
                        <tr>
                            <td>
                                <div class="pull-left">
                                {{ $detail->Descr }}
                                </div>
                            </td>
                            <td>
                                <div class="pull-right">
                                {{ number_format($detail->Pcs, 0) }}
                                </div>
                            </td>
                            <td>
                                {{ $detail->Unit }}
                            </td>
                            <td>
                                <div class="pull-right">
                                {{ $f->formatCurrency($detail->UnitPrice_DC, $invoice->Curr_DC) }}
                                </div>
                            </td>
                            <td>
                                <div class="pull-right">
                                {{ $f->formatCurrency($detail->Netto_DC, $invoice->Curr_DC) }}
                                </div>
                            </td>
                            <td>
                                <div class="pull-right">
                                {{ number_format($detail->TaxRate, 0) . ' %' }}
                                </div>
                            </td>
                            <td>
                                <div class="pull-right">
                                {{ $f->formatCurrency($detail->Tax_LC, $invoice->Curr_DC) }}
                                </div>
                            </td>
                            <td>
                                <div class="pull-right">
                                {{ $f->formatCurrency($detail->Brutto_DC, $invoice->Curr_DC) }}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th></th>
                        <th>
                            <div class="pull-right">
                            {{-- count($details)." db" --}}
                            </div>
                        </th>
                        <th></th>
                        <th></th>
                        <th>
                            <div class="pull-right">
                                {{ $f->formatCurrency($invoice->Netto_LC, $invoice->Curr_DC) }}
                            </div>
                        </th>
                        <th></th>
                        <th>
                            <div class="pull-right">
                                {{ $f->formatCurrency($invoice->Tax_LC, $invoice->Curr_DC) }}
                            </div>
                        </th>
                        <th>
                            <div class="pull-right">
                                {{ $f->formatCurrency($invoice->Brutto_LC, $invoice->Curr_DC) }}
                            </div>
                        </th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="row">
            <a href="{{ url('inv_new') }}"
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
    <script src="{{ asset('assets/bower_components/bootstrap-table/1.15.5/tableExport.min.js') }}" type="text/javascript"></script>

    <script src="{{ asset('assets/bower_components/bootstrap-table/1.15.5/libs/jspdf.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/bower_components/bootstrap-table/1.15.5/libs/jspdf.plugin.autotable.js') }}" type="text/javascript"></script>

    <script src="{{ asset('assets/bower_components/bootstrap-table/1.15.5/bootstrap-table.js') }}" type="text/javascript"></script>--}}
    <script src="{{ asset('assets/bower_components/bootstrap-table/1.15.5/locale/bootstrap-table-hu-HU.js') }}" type="text/javascript"></script>--}}

    <script src="{{ asset('assets/bower_components/bootstrap-table/1.15.5/extensions/export/bootstrap-table-export.js') }}" type="text/javascript"></script>

    {{-- Moment --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

    {{-- Daterange Picker --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>


    <script>
        var $table = $('#table');

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
