@extends('layouts.app')
@section('title', trans('inv_l.title'))

@section('content')
    @php
        $format = (config('appConfig.dateFormats'))[config('app.locale')]['carbon'];
    @endphp

    <section class="content-header">
        <h1>
            {{ trans('inv_l.title') }}
            <small>{{ trans('inv_l.sub_title') }}</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('/') }}">
                    <i class="fa fa-dashboard"></i>&nbsp;
                    {{ trans('app.dashboard') }}
                </a>
            </li>
            <li>
                <a href="{{ url('invoices') }}">
                    <i class="fa fa-file-text-o"></i>&nbsp;
                    {{ trans('inv.title') }}
                </a>
            </li>
            <li class="active">
                <i class="fa fa-file-text-o"></i>&nbsp;
                {{ trans('inv_l.title') }}
            </li>
        </ol>
    </section>

    <div class="row">
        <section class="invoice">

            <div class="row">
                <a href="{{ url()->previous() }}"
                   class="btn btn-default">
                    {{ trans('app.back_to_list') }}
                </a>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        <i class="fa fa-globe"></i>&nbsp;{{ trans('inv.title') }}
                        @php
                            /** @var stdClass $invoice */
                            /** @var string $format */
                            //$datum = Carbon\Carbon::parse($invoice->InvDate)->format($format);
                        @endphp
                        <small class="pull-right"><b>{{ trans('inv.inv_date') }}:</b> {{ $invoice->InvDate }}</small>
                    </h2>
                </div>
            </div>

            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    <b>{{ trans('global.app_partner') }}</b>
                    <address>
                        {{ $invoice->Partner_Name }}<br>
                        {{-- $invoice->Partner_Country_ZIP_City --}}
                        {{ $invoice->Partner_Country }} {{ $invoice->Partner_ZIP }} {{ $invoice->Partner_City }}
                    </address>
                </div>

                <div class="col-sm-4 invoice-col">
                    <b>{{ trans('inv.inv_num') }}:</b>&nbsp;{{ $invoice->Inv_Num }}<br/>
                    <b>@lang('global.invoice.inv_seq_num'):</b>&nbsp;{{ $invoice->Inv_SeqNum }}<br/>
                    @php
                        //$datum = Carbon\Carbon::parse($invoice->DueDate)->format($format);
                    @endphp
                    <b>@lang('inv.due_date'):</b>&nbsp;{{ $invoice->DueDate }}<br>

                    <b>{{ trans('app.pay_status') }}:</b>&nbsp;{{ $invoice->PayStatus }}<br/>
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
                            {{-- Pos_ID --}}
                            <th data-field="Pos_ID" data-align="left" data-halign="center"
                                data-sortable="true" data-searchable="true"
                                data-switchable="true">
                                {{ trans('inv_l.pos_id') }}
                            </th>
                            {{-- Descr --}}
                            <th data-field="Descr" data-align="left" data-halign="center"
                                data-sortable="true" data-searchable="true"
                                data-switchable="true">
                                {{ trans('inv_l.descr') }}
                            </th>
                            {{-- Pcs --}}
                            <th data-field="Pcs"
                                data-align="right" data-halign="center"
                                data-sortable="true" data-searchable="true"
                                data-switchable="true"
                                data-formatter="pcs_formatter">
                                {{ trans('inv_l.pcs') }}
                            </th>
                            {{-- Unit --}}
                            <th data-field="Unit" data-align="left" data-halign="center"
                                data-sortable="true" data-searchable="true"
                                data-switchable="true">
                                {{ trans('inv_l.unit') }}
                            </th>
                            {{-- DC --}}
                            {{-- Curr_DC --}}
                            <th data-field="Curr_DC"
                                data-align="left" data-halign="center"
                                data-sortable="true" data-searchable="true"
                                data-switchable="true">
                                {{ trans('inv_l.curr_dc') }}
                            </th>
                            <th data-field="UnitPrice_DC" data-formatter="decimalFormatter"
                                data-align="right" data-halign="center"
                                data-sortable="true" data-searchable="true" data-switchable="true">
                                {{ trans('inv_l.unit_price_dc') }}
                            </th>
                            <th data-field="Net_DC" data-formatter="decimalFormatter"
                                data-align="right" data-halign="center"
                                data-sortable="true" data-searchable="true"
                                data-switchable="true">
                                {{ trans('inv_l.net_dc') }}
                            </th>
                            <th data-field="Tax_DC" data-formatter="decimalFormatter"
                                data-align="right" data-halign="center"
                                data-sortable="true" data-searchable="true" data-switchable="true">
                                {{ trans('inv_l.tax_dc') }}
                            </th>
                            <th data-field="Gross_DC" data-formatter="decimalFormatter"
                                data-align="right" data-halign="center"
                                data-sortable="true" data-searchable="true"
                                data-switchable="true">
                                {{ trans('inv_l.gross_dc') }}
                            </th>
                            {{----}}
                            {{-- LC --}}
                            {{--
                                                    <th data-field="UnitPrice_LC" data-formatter="decimalFormatter"
                                                        data-align="right" data-halign="center"
                                                        data-sortable="true" data-searchable="true" data-switchable="true">
                                                        {{ trans('global.invoice.fields.unit_price_lc') }}
                                                    </th>
                                                    <th data-field="Net_LC" data-formatter="decimalFormatter"
                                                        data-align="right" data-halign="center"
                                                        data-sortable="true" data-searchable="true" data-switchable="true">
                                                        {{ trans('global.invoice.fields.net_lc') }}
                                                    </th>
                                                    <th data-field="Tax_LC" data-formatter="decimalFormatter"
                                                        data-align="right" data-halign="center"
                                                        data-sortable="true" data-searchable="true" data-switchable="true">
                                                        {{ trans('global.invoice.fields.tax_lc') }}
                                                    </th>
                                                    <th data-field="GROSS_LC"
                                                        data-align="right" data-halign="center"
                                                        data-sortable="true" data-searchable="true" data-switchable="true">
                                                        {{ trans('global.invoice.fields.gross_lc') }}
                                                    </th>
                            --}}
                            {{--
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


                                                    <th data-field="GROSS_FC" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">
                                                        {{ trans('global.invoice.fields.gross_fc') }}
                                                    </th>
                                                    <th data-field="GROSS_FC2" data-align="right" data-halign="center" data-sortable="true" data-searchable="true" data-switchable="true">
                                                        {{ trans('global.invoice.fields.gross_fc2') }}
                                                    </th>
                            --}}
                        </tr>
                        </thead>

                    </table>
                </div>
            </div>

            <div class="row">

                <div class="col-xs-12">
                    <p class="lead">
                        <b>{{ trans('inv.due_date') }}:</b>&nbsp;{{ $invoice->DueDate }}
                    </p>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">{{ $invoice->Curr_DC }}</th>
                                <th class="text-center">{{ trans('app.lc') }}</th>
                                <th class="text-center">{{ trans('app.dc') }}</th>
                                <th class="text-center">{{ trans('app.fc') }}</th>
                            </tr>
                            </thead>
                            <tr>
                                <th>{{ trans('app.net') }}</th>
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
                                <th>{{ trans('app.tax') }}</th>
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
                                <th>{{ trans('app.paid_amount') }}</th>
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
                                <th>{{ trans('app.gross') }}</th>
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
                    {{ trans('app.back_to_list') }}
                </a>
            </div>

        </section>
    </div>
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
