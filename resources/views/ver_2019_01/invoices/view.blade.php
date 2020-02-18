@extends('layouts.app')
@section('title', __('global.invoice.title'))

@section('content')
    @php
        $format = (config('appConfig.dateFormats'))[config('app.locale')]['carbon'];
        //$currency_template = config('appConfig.currencies.' . config('app.locale'));
        //echo '<pre>';
        //print_r($invoice);
        //echo '</pre>';
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
            <a href="{{ url()->previous() }}"
               class="btn btn-default">
                {{ __('global.app_back_to_list') }}
            </a>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <i class="fa fa-globe"></i>&nbsp;{{ __('global.invoice.title') }}
                    @php
                        /** @var stdClass $invoice */
                        /** @var string $format */
                        $datum = Carbon\Carbon::parse($invoice->InvDate)->format($format);
                    @endphp
                    <small class="pull-right"><b>{{ __('global.app_date') }}:</b> {{ $datum }}</small>
                </h2>
            </div>
        </div>

        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                {{ __('global.app_partner') }}
                <address>
                    <strong>{{ $invoice->Partner_Name }}</strong><br>
                    <br>
                    {{ $invoice->Partner_Country_ZIP_City }}
                </address>
            </div>

            <div class="col-sm-4 invoice-col">
                <b>@lang('global.invoice.account_number'):</b>&nbsp;{{ $invoice->Inv_Num }}<br/>
                <b>@lang('global.invoice.inv_seq_num'):</b>&nbsp;{{ $invoice->Inv_SeqNum }}<br/>
                @php
                    $datum = Carbon\Carbon::parse($invoice->DueDate)->format($format);
                @endphp
                <b>@lang('global.invoice.payment_due'):</b>&nbsp;{{ $datum }}<br>

                <b>{{ trans('global.app_pay_status') }}:&nbsp;{{ $invoice->PayStatus }}</b><br/>
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
                        {{--
                        <th data-field="ID" data-visible="false" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('ID') }}</th>
                        <th data-field="Inv_ID" data-visible="false" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('Inv_ID') }}</th>
                        <th data-field="SELEXPED_INV_L_ID" data-visible="false" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('SELEXPED_INV_L_ID') }}</th>
                        <th data-field="SELEXPED_INV_ID" data-visible="false" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('SELEXPED_INV_ID') }}</th>
                        <th data-field="ClientID" data-visible="false" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('ClientID') }}</th>
                        <th data-field="TransactID" data-visible="false" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('TransactID') }}</th>
                        <th data-field="SeqNum" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('SeqNum') }}</th>
                        <th data-field="Comp_Inv_ID" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('Comp_Inv_ID') }}</th>
                        <th data-field="Pos_ID" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('Pos_ID') }}</th>
                        <th data-field="Ord_Num" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('Ord_Num') }}</th>
                        <th data-field="PosInfo" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('PosInfo') }}</th>
                        <th data-field="Part_ID" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('Part_ID') }}</th>
                        <th data-field="Rates_ID" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('Rates_ID') }}</th>
                        --}}
                        {{--
                        <th data-field="Descr" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('global.invoice.fields.product') }}</th>

                        <th data-field="Pcs" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('global.invoice.fields.qty') }}</th>
                        <th data-field="Unit" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('global.invoice.fields.qty_unit') }}</th>
                        <th data-field="UnitPrice_DC" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('global.invoice.fields.unit_price') }}</th>
                        <th data-field="Net_DC" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('Net_DC') }}</th>
                        <th data-field="ACCT_TaxCodes_ID" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('ACCT_TaxCodes_ID') }}</th>
                        <th data-field="TaxRate" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('TaxRate') }}</th>
                        <th data-field="Tax_DC" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('Tax_DC') }}</th>
                        <th data-field="Gross_DC" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('Gross_DC') }}</th>
                        <th data-field="UnitPrice_FC2" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('UnitPrice_FC2') }}</th>
                        <th data-field="Net_FC2" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('Net_FC2') }}</th>
                        <th data-field="Tax_FC2" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('Tax_FC2') }}</th>
                        <th data-field="Gross_FC2" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('Gross_FC2') }}</th>
                        <th data-field="Curr_ID" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('Curr_ID') }}</th>
                        <th data-field="Curr_DC" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('Curr_DC') }}</th>
                        <th data-field="Rate_DC" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('Rate_DC') }}</th>
                        <th data-field="Rate_Unit_DC" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('Rate_Unit_DC') }}</th>
                        <th data-field="Rate_Date_DC" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('Rate_Date_DC') }}</th>
                        <th data-field="Rate_FC" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('Rate_FC') }}</th>
                        <th data-field="Rate_Unit_FC" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('Rate_Unit_FC') }}</th>
                        <th data-field="UnitPrice_FC" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('UnitPrice_FC') }}</th>
                        <th data-field="Net_FC" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('Net_FC') }}</th>
                        <th data-field="Tax_FC" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('Tax_FC') }}</th>
                        <th data-field="Gross_FC" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('Gross_FC') }}</th>
                        <th data-field="Rate_Date_FC" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('Rate_Date_FC') }}</th>
                        <th data-field="Ord_Calc_ID" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('Ord_Calc_ID') }}</th>
                        <th data-field="Rate_LC" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('Rate_LC') }}</th>
                        <th data-field="Rate_Unit_LC" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('Rate_Unit_LC') }}</th>
                        <th data-field="Rate_Date_LC" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('Rate_Date_LC') }}</th>
                        <th data-field="UnitPrice_LC" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('UnitPrice_LC') }}</th>
                        <th data-field="Net_LC" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('Net_LC') }}</th>
                        <th data-field="Tax_LC" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('Tax_LC') }}</th>
                        <th data-field="Gross_LC" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('Gross_LC') }}</th>
                        <th data-field="Period_FROM" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('Period_FROM') }}</th>
                        <th data-field="Period_TO" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('Period_TO') }}</th>
                        <th data-field="Subcontracted_Services" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('Subcontracted_Services') }}</th>
                        <th data-field="ConseqNum" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('ConseqNum') }}</th>
                        <th data-field="INV_Group_ConseqNum" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('INV_Group_ConseqNum') }}</th>
                        <th data-field="UserFld_int01" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('UserFld_int01') }}</th>
                        <th data-field="UserFld_int02" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('UserFld_int02') }}</th>
                        <th data-field="UserFld_int03" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('UserFld_int03') }}</th>
                        <th data-field="UserFld_float01" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('UserFld_float01') }}</th>
                        <th data-field="UserFld_float02" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('UserFld_float02') }}</th>
                        <th data-field="UserFld_float03" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('UserFld_float03') }}</th>
                        <th data-field="UserFld_nvarchar01" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('UserFld_nvarchar01') }}</th>
                        <th data-field="UserFld_nvarchar02" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('UserFld_nvarchar02') }}</th>
                        <th data-field="UserFld_nvarchar03" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('UserFld_nvarchar03') }}</th>
                        <th data-field="UserFld_date01" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('UserFld_date01') }}</th>
                        <th data-field="UserFld_date02" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('UserFld_date02') }}</th>
                        <th data-field="UserFld_date03" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('UserFld_date03') }}</th>

                        <th data-field="Note" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('Note') }}</th>
                        --}}
                        {{--
                        <th data-field="SeqNum" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('SeqNum') }}</th>
                        <th data-field="Inv_L_ID" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('Inv_L_ID') }}</th>
                        <th data-field="SELEXPED_INV_L_ID" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('SELEXPED_INV_L_ID') }}</th>
                        <th data-field="Inv_ID" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('Inv_ID') }}</th>
                        <th data-field="SELEXPED_INV_ID" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">{{ trans('SELEXPED_INV_ID') }}</th>
                        --}}
                        <th data-field="Descr" data-align="left" data-halign="center"
                            data-sortable="true" data-searchable="true"
                            data-switchable="true">
                            {{ trans('global.invoice.fields.descr') }}
                        </th>

                        <th data-field="Pcs"
                            data-align="right" data-halign="center"
                            data-sortable="true" data-searchable="true" data-switchable="true"
                            data-formatter="pcs_formatter">
                            {{ trans('global.invoice.fields.pcs') }}
                        </th>

                        <th data-field="Unit" data-align="left" data-halign="center"
                            data-sortable="true" data-searchable="true"
                            data-switchable="true">
                            {{ trans('global.invoice.fields.unit') }}
                        </th>

                        <th data-field="Curr_DC" data-align="left" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">
                            {{ trans('Curr_DC') }}
                        </th>

                        <th data-field="UnitPrice_LC" data-formatter="decimalFormatter"
                            data-align="right" data-halign="center"
                            data-sortable="true" data-searchable="true" data-switchable="true">
                            {{ trans('global.invoice.fields.unit_price_lc') }}
                        </th>
                        <th data-field="UnitPrice_DC" data-formatter="decimalFormatter"
                            data-align="right" data-halign="center"
                            data-sortable="true" data-searchable="true" data-switchable="true">
                            {{ trans('global.invoice.fields.unit_price_dc') }}
                        </th>
                        <th data-field="UnitPrice_FC" data-formatter="decimalFormatter"
                            data-align="right" data-halign="center"
                            data-sortable="true" data-searchable="true" data-switchable="true">
                            {{ trans('global.invoice.fields.unit_price_fc') }}
                        </th>
                        <th data-field="UnitPrice_FC2" data-formatter="decimalFormatter"
                            data-align="right" data-halign="center"
                            data-sortable="true" data-searchable="true" data-switchable="true">
                            {{ trans('global.invoice.fields.unit_price_fc2') }}
                        </th>
                        <th data-field="Net_LC" data-formatter="decimalFormatter"
                            data-align="right" data-halign="center"
                            data-sortable="true" data-searchable="true" data-switchable="true">
                            {{ trans('global.invoice.fields.net_lc') }}
                        </th>
                        <th data-field="Net_DC" data-formatter="decimalFormatter"
                            data-align="right" data-halign="center"
                            data-sortable="true" data-searchable="true" data-switchable="true">
                            {{ trans('global.invoice.fields.net_dc') }}
                        </th>
                        <th data-field="Net_FC" data-formatter="decimalFormatter"
                            data-align="right" data-halign="center"
                            data-sortable="true" data-searchable="true" data-switchable="true">
                            {{ trans('global.invoice.fields.net_fc') }}
                        </th>
                        <th data-field="Netto_FC2" data-formatter="decimalFormatter"
                            data-align="right" data-halign="center"
                            data-sortable="true" data-searchable="true" data-switchable="true">
                            {{ trans('global.invoice.fields.net_fc2') }}
                        </th>
                        <th data-field="TaxRate" data-formatter="percentFormatter"
                            data-align="right" data-halign="center"
                            data-sortable="true" data-searchable="true" data-switchable="true">
                            {{ trans('global.invoice.fields.tax_rate') }}
                        </th>
                        <th data-field="Tax_LC" data-formatter="decimalFormatter"
                            data-align="right" data-halign="center"
                            data-sortable="true" data-searchable="true" data-switchable="true">
                            {{ trans('global.invoice.fields.tax_lc') }}
                        </th>
                        <th data-field="Tax_DC" data-formatter="decimalFormatter"
                            data-align="right" data-halign="center"
                            data-sortable="true" data-searchable="true" data-switchable="true">
                            {{ trans('global.invoice.fields.tax_dc') }}
                        </th>
                        <th data-field="Tax_FC" data-formatter="decimalFormatter"
                            data-align="right" data-halign="center"
                            data-sortable="true" data-searchable="true" data-switchable="true">
                            {{ trans('global.app_tax_fc') }}
                        </th>
                        <th data-field="Tax_FC2" data-formatter="decimalFormatter"
                            data-align="right" data-halign="center"
                            data-sortable="true" data-searchable="true" data-switchable="true">
                            {{ trans('global.invoice.fields.tax_fc2') }}
                        </th>

                        <th data-field="GROSS_LC" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">
                            {{ trans('global.invoice.fields.gross_lc') }}
                        </th>
                        <th data-field="GROSS_DC" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">
                            {{ trans('global.invoice.fields.gross_dc') }}
                        </th>
                        <th data-field="GROSS_FC" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">
                            {{ trans('global.invoice.fields.gross_fc') }}
                        </th>
                        <th data-field="GROSS_FC2" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">
                            {{ trans('global.invoice.fields.gross_fc2') }}
                        </th>
{{--
                        <th data-field="Curr_LC" data-align="left" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">
                            {{ trans('Curr_LC') }}
                        </th>
                        <th data-field="Curr_FC" data-align="left" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">
                            {{ trans('Curr_FC') }}
                        </th>
                        <th data-field="Curr_FC2" data-align="left" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">
                            {{ trans('Curr_FC2') }}
                        </th>
--}}
                    </tr>
                    </thead>

                </table>
            </div>
        </div>

        <div class="row">

            <div class="col-xs-12">
                <p class="lead">@lang('global.invoice.payment_due'): {{ $datum }}</p>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th class="text-center">{{ $invoice->Curr_DC }}</th>
                            <th class="text-center">{{ trans('LC') }}</th>
                            <th class="text-center">{{ trans('DC') }}</th>
                            <th class="text-center">{{ trans('FC') }}</th>
                        </tr>
                        </thead>
                        <tr>
                            <th>{{ trans('global.invoice.fields.net') }}</th>
                            <td>
                                <div class="pull-right">
                                {{ number_format($invoice->Net_LC, 2) }}
                                </div>
                            </td>
                            <td>
                                <div class="pull-right">
                                {{ number_format($invoice->Net_DC, 2) }}
                                </div>
                            </td>
                            <td>
                                <div class="pull-right">
                                {{ number_format($invoice->Net_FC, 2) }}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>{{ trans('global.invoice.fields.vat') }}</th>
                            <td>
                                <div class="pull-right">
                                {{ number_format($invoice->Tax_LC, 2) }}
                                </div>
                            </td>
                            <td>
                                <div class="pull-right">
                                {{ number_format($invoice->Tax_DC, 2) }}
                                </div>
                            </td>
                            <td>
                                <div class="pull-right">
                                {{ number_format($invoice->Tax_FC, 2) }}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>{{ trans('global.invoice.fields.paid_so_far') }}</th>
                            <td class="text-right">
                                {{ number_format($invoice->PaidAmount_LC, 2) }}
                            </td>
                            <td class="text-right">
                                {{ number_format($invoice->PaidAmount_DC, 2) }}
                            </td>
                            <td class="text-right">
                                {{ number_format($invoice->PaidAmount_FC, 2) }}
                            </td>
                        </tr>
                        <tr>
                            <th>{{ trans('global.invoice.fields.gross') }}</th>
                            <td>
                                <div class="pull-right">
                                    {{ number_format($invoice->Gross_LC, 2) }}
                                </div>
                            </td>
                            <td>
                                <div class="pull-right">
                                {{ number_format($invoice->Gross_DC, 2) }}
                                </div>
                            </td>
                            <td>
                                <div class="pull-right">
                                {{ number_format($invoice->Gross_FC, 2) }}
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="row">
            <a href="{{ url()->previous() }}"
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
        use App\Classes\Helper;
        echo "<!-- MENU BACGROUND COLOR -->\n";
        echo "<style>.skin-blue .main-sidebar, .skin-blue .left-side {background-color: " . Helper::getMenuBgColor('invoices') . ";}</style>\n";
        echo "<!-- HEADER BG COLOR -->\n";
        $header_bg_color = Helper::getHeaderBgColor('users');
        echo "<style>.skin-blue .main-header .navbar {background-color: " . $header_bg_color . ";} .skin-blue .main-header .logo {background-color: " . $header_bg_color . ";}</style>\n";
        echo "<style>.skin-blue .main-header .logo {background-color: " . $header_bg_color . ";}</style>\n";

        echo "<!-- PANEL AND TAB COLOR -->\n";
        echo "<style>.box.box-default {border-top-color: " . Helper::getPanelTabLineColor('invoices') . ";}</style>\n";
    @endphp

    <style>
        table.table.table-striped.table-bordered td,
        table.table.table-striped.table-bordered {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>

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
        var $local = '{{ app() ->getLocale() }}' + '-' + '{{ strtoupper(app()->getLocale()) }}';
        var $local_short = '{{ app() ->getLocale() }}';

        function pcs_formatter(value)
        {
            return parseInt(value);
        }

        function percentFormatter(value)
        {
            return parseInt(value) + ' %';
        }

        function decimalFormatter(data)
        {
            if(data === undefined)
            {
                data = 0;
            }
            return FormatNumber(data);
        }

        /**
         * @return {string}
         */
        function FormatNumber(number, numberOfDigits = 2)
        {
            try {
                //retVal = new Intl.NumberFormat('hu-HU').format(parseFloat(number).toFixed(2));
                return parseFloat(number).toFixed(numberOfDigits);
            } catch (error) {
                console.log(error);
                return 0;
            }
        }

        function initTable()
        {
            $table
                .bootstrapTable('destroy')
                .bootstrapTable({
                    locale: $local
                });
        }

        $(function(){
            initTable();
        });

    </script>
@endsection
