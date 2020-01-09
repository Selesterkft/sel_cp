@extends($company . '.layouts.app')
@section('title', Lang::get('global.invoice.title'))

@section('content')

    <?php
    $format = (config('appConfig.dateFormats'))[config('app.locale')]['carbon'];
    $currency_template = config('appConfig.currencies.' . config('app.locale'));
    ?>

    <section class="content-header">
        <h1>
            @lang('global.invoice.title')
            <small>@lang('global.invoice.sub_title')</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('/') }}">
                    <i class="fa fa-dashboard"></i>&nbsp;
                    @lang('global.app_dashboard')
                </a>
            </li>
            <li>
                <a href="{{ route('invoices', ['company' => $company, 'version' => $version,]) }}">
                    <i class="fa fa-file-text-o"></i>&nbsp;
                    @lang('global.invoices.title')
                </a>
            </li>
            <li class="active">
                <i class="fa fa-file-text-o"></i>&nbsp;
                @lang('global.invoice.title')
            </li>
        </ol>
    </section>

    <section class="invoice">
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <i class="fa fa-globe"></i>&nbsp;@lang('global.invoice.title')
                    <?php
                    $datum = Carbon\Carbon::parse($invoice->Kelte)->format($format);
                    ?>
                    <small class="pull-right">@lang('global.app_date'): {{ $datum }}</small>
                </h2>
            </div>
        </div>

        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                @lang('global.app_from')
                <address>
                    <strong>{{ config('appConfig.company_name') }}</strong><br>
                    {{ config('appConfig.company_addr_1') }}<br>
                    {{ config('appConfig.company_addr_2') }}<br>
                    @lang('global.app_phone'): {{ config('appConfig.company_phone') }}<br>
                    @lang('global.app_email'): {{ config('appConfig.company_email') }}
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                @lang('global.app_to')
                <address>
                    <strong>{{ $invoice->SzallitoNev1 }}</strong><br>
                    {{ $invoice->SzallitoISZ }}, {{ $invoice->SzallitoVaros }}<br>
                    {{ $invoice->SzallitoUtca }} {{ $invoice->Vendor_Addr_ps_type }} {{ $invoice->Vendor_Addr_housenr }}<br>
                    @lang('global.app_phone'): XXX<br>
                    @lang('global.app_email'): XXX
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                <b>@lang('global.invoice.inv_id') {{ $invoice->ID }}</b><br>
                <br>
                <b>@lang('global.invoice.order_id'):</b>&nbsp;XXXXXX<br>
                <?php
                $datum = Carbon\Carbon::parse($invoice->Lejarat)->format($format);
                ?>
                <b>@lang('global.invoice.payment_due'):</b>&nbsp;{{ $datum }}<br>
                <b>@lang('global.invoice.account_number'):</b>&nbsp;{{ $invoice->VevoSzlaszam }}
            </div>
            <!-- /.col -->
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
                            <td>{{ $detail->Megnevezes }}</td>
                            <td class="text-right">{{ number_format($detail->Darab, 0) }}</td>
                            <td class="text-center">{{ $detail->ME }}</td>
                            <td class="text-right">{{ str_replace('%s', $detail->Egysegar, $currency_template) }}</td>
                            <td class="text-right">{{ str_replace('%s', $detail->Netto, $currency_template) }}</td>
                            <td class="text-right">{{ number_format($detail->AFAkulcs, 0) . ' %' }}</td>
                            <td class="text-right">{{ str_replace('%s', $detail->AFA, $currency_template) }}</td>
                            <td class="text-right">{{ str_replace('%s', $detail->Brutto, $currency_template) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th></th>
                        <th class="text-right">{{ count($details)." db" }}</th>
                        <th></th>
                        <th></th>
                        <th class="text-right">{{ str_replace('%s', $invoice->NettoOsszesen, $currency_template) }}</th>
                        <th></th>
                        <th class="text-right">{{ str_replace('%s', $invoice->AFAOsszesen, $currency_template) }}</th>
                        <th class="text-right">{{ str_replace('%s', $invoice->BruttoOsszesen, $currency_template) }}</th>
                    </tr>
                    </tfoot>
                </table>

            </div>
        </div>

        <div class="row">
            <a href="{{ route('invoices', ['company' => $company, 'version' => $version]) }}"
               class="btn btn-default">
                @lang('global.app_back_to_list')
            </a>
        </div>

    </section>

@endsection