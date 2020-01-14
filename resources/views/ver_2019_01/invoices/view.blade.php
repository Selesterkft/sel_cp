@extends('layouts.app')
@section('title', __('global.invoice.title'))

@section('content')

    @php
    $format = (config('appConfig.dateFormats'))[config('app.locale')]['carbon'];
    $currency_template = config('appConfig.currencies.' . config('app.locale'));
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
                <!--
                <address>
                    <strong>{{ config('appConfig.company_name') }}</strong><br>
                    {{ config('appConfig.company_addr_1') }}<br>
                    {{ config('appConfig.company_addr_2') }}<br>
                    @lang('global.app_phone'): {{ config('appConfig.company_phone') }}<br>
                    @lang('global.app_email'): {{ config('appConfig.company_email') }}
                </address>
                -->
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
                        @lang('global.app_phone'): <br>
                        @lang('global.app_email'):
                    </address>

            </div>

            <div class="col-sm-4 invoice-col">
                @lang('global.app_to')
                <address>
                    <strong>{{ $invoice->Cust_Name1 }}</strong><br>
                    {{ $invoice->Cust_ZIP }}, {{ $invoice->Cust_City }}<br>
                    {{ $invoice->Cust_Addr }} {{ $invoice->Cust_Addr_ps_type }} {{ $invoice->Cust_Addr_housenr }}<br>
                    @lang('global.app_phone'): <br>
                    @lang('global.app_email'):
                </address>
            </div>

            <div class="col-sm-4 invoice-col">
                <b>@lang('global.invoice.inv_id') {{ $invoice->ID }}</b><br>
                <br>
                {{--
                <b>@lang('global.invoice.order_id'):</b>&nbsp;XXXXXX<br>
                --}}
                @php
                $datum = Carbon\Carbon::parse($invoice->DueDate)->format($format);
                @endphp
                <b>@lang('global.invoice.payment_due'):</b>&nbsp;{{ $datum }}<br>
                <b>@lang('global.invoice.account_number'):</b>&nbsp;{{ $invoice->Cust_BankAcc }}
            </div>

        </div>

        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>@lang('global.invoice.fields.product')</th>
                        <th>@lang('global.invoice.fields.qty')</th>
                        <th>@lang('global.invoice.fields.qty_unit')</th>
                        <th>@lang('global.invoice.fields.unit_price')</th>
                        <th>@lang('global.invoice.fields.net')</th>
                        <th>@lang('global.invoice.fields.vat')</th>
                        <th>@lang('global.invoice.fields.vat_value')</th>
                        <th>@lang('global.invoice.fields.gross')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($details as $detail)
                        <tr>
                            <td>{{ $detail->Descr }}</td>
                            <td class="text-right">{{ number_format($detail->Pcs, 0) }}</td>
                            <td class="text-center">{{ $detail->Unit }}</td>
                            <td class="text-right">{{ str_replace('%s', $detail->UnitPrice_DC, $currency_template) }}</td>
                            <td class="text-right">{{ str_replace('%s', $detail->Netto_DC, $currency_template) }}</td>
                            <td class="text-right">{{ number_format($detail->TaxRate, 0) . ' %' }}</td>
                            <td class="text-right">{{ str_replace('%s', $detail->Tax_DC, $currency_template) }}</td>
                            <td class="text-right">{{ str_replace('%s', $detail->Brutto_DC, $currency_template) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th></th>
                        <th class="text-right">{{ count($details)." db" }}</th>
                        <th></th>
                        <th></th>
                        <th class="text-right">{{ str_replace('%s', $invoice->Netto_LC, $currency_template) }}</th>
                        <th></th>
                        <th class="text-right">{{ str_replace('%s', $invoice->Tax_LC, $currency_template) }}</th>
                        <th class="text-right">{{ str_replace('%s', $invoice->Brutto_LC, $currency_template) }}</th>
                    </tr>
                    </tfoot>
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
