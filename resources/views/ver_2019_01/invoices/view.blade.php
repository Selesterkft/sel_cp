@extends(session()->get('design') . '.layouts.app')

@section('title', trans('inv_l.title'))

@section('content-header')
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
@endsection

@section('content')
    <div class="row">
        <section class="invoice">

            <div class="row">
                <a href="{{ url()->previous() }}"
                   class="btn btn-success">
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
                    <b>{{ trans('app.partner') }}:</b>
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
                           <!--
                        <thead>
                        <tr>
                            <th data-field="Ord_Num">{{ trans('inv_l.ord_num') }}</th>
                            <th data-field="PosInfo">{{ trans('inv_l.pos_info') }}</th>
                            <th data-field="Rates_ID">{{ trans('inv_l.rates_id') }}</th>
                            <th data-field="Descr">{{ trans('app.descr') }}</th>
                            <th data-field="Note">{{ trans('inv_l.note') }}</th>
                            <th data-field="Pcs" data-align="right">{{ trans('app.pcs') }}</th>
                            <th data-field="Unit">{{ trans('app.unit') }}</th>
                            <th data-field="UnitPrice_DC" data-align="right">{{ trans('app.unit_price_dc') }}</th>
                            <th data-field="Netto_DC" data-align="right">{{ trans('app.net_dc') }}</th>
                            <th data-field="ACCT_TaxCodes_ID">{{ trans('inv_l.acct_tax_codes_id') }}</th>
                            <th data-field="TaxRate" data-align="right">{{ trans('inv_l.tax_rate') }}</th>
                            <th data-field="Tax_DC" data-align="right">{{ trans('inv_l.tax_dc') }}</th>
                            <th data-field="Gross_DC" data-align="right">{{ trans('inv_l.gross_dc') }}</th>
                            <th data-field="UnitPrice_FC2" data-align="right">{{ trans('inv_l.unit_price_fc2') }}</th>
                            <th data-field="Tax_FC2" data-align="right">{{ trans('inv_l.tax_fc2') }}</th>
                            <th data-field="Brutto_FC2" data-align="right">{{ trans('inv_l.gross_fc2') }}</th>
                            <th data-field="Curr_ID">{{ trans('inv_l.curr_id') }}</th>
                            <th data-field="Period_From_To">{{ trans('inv_l.period_from_to') }}</th>
                            <th data-field="Period_FROM">{{ trans('inv_l.period_from') }}</th>
                            <th data-field="Period_TO">{{ trans('inv_l.period_to') }}</th>
                        </tr>
                        </thead>
                        -->
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
                                <td><b>{{ trans('app.net') }}</b></td>
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
                                <td><b>{{ trans('app.tax') }}</b></td>
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
                                <td><b>{{ trans('app.paid_amount') }}</b></td>
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
                                <td><b>{{ trans('app.gross') }}</b></td>
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
                   class="btn btn-success">
                    {{ trans('app.back_to_list') }}
                </a>
            </div>

        </section>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/bower_components/bootstrap-table/1.15.5/bootstrap-table.css') }}"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    {{--
        @php
            use App\Classes\ColorHelper;

            echo "<!-- MENU BACGROUND COLOR -->\n";
            echo "<style>.skin-blue .main-sidebar, .skin-blue .left-side {background-color: " . ColorHelper::getMenuBgColor('invoices') . ";}</style>\n";
            echo "<!-- HEADER BG COLOR -->\n";
            $header_bg_color = ColorHelper::getHeaderBgColor('users');
            echo "<style>.skin-blue .main-header .navbar {background-color: " . $header_bg_color . ";} .skin-blue .main-header .logo {background-color: " . $header_bg_color . ";}</style>\n";
            echo "<style>.skin-blue .main-header .logo {background-color: " . $header_bg_color . ";}</style>\n";

            echo "<!-- PANEL AND TAB COLOR -->\n";
            echo "<style>.box.box-default {border-top-color: " . ColorHelper::getPanelTabLineColor('invoices') . ";}</style>\n";
        @endphp
--}}

    <style>
        table.table.table-striped.table-bordered td{
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        table.table-bordered{
            border:1px solid darkgray;
            margin-top:20px;
        }
        table.table-bordered > thead > tr > th{
            border:1px solid darkgray;
        }
        table.table-bordered > tbody > tr > td{
            border:1px solid darkgray;
        }

    </style>


@endsection

@section('js')

    <script src="{{ asset('assets/bower_components/bootstrap-table/1.15.5/bootstrap-table.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/bower_components/bootstrap-table/1.15.5/locale/bootstrap-table-hu-HU.js') }}" type="text/javascript"></script>

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
                    undefinedText: ' ',
                    locale: $local,
                    columns: [
                        {field: 'Ord_Num',          title: 'inv_l.ord_num'},
                        {field: 'PosInfo',          title: 'inv_l.pos_info'},
                        {field: 'Rates_ID',         title: 'inv_l.rates_id'},
                        {field: 'Descr',            title: 'app.descr'},
                        {field: 'Note',             title: 'inv_l.note'},
                        {field: 'Pcs',              title: 'app.pcs',               align: 'right'},
                        {field: 'Unit',             title: 'app.unit'},
                        {field: 'UnitPrice_DC',     title: 'app.unit_price_dc',     align: 'right'},
                        {field: 'Netto_DC',         title: 'app.net_dc',            align: 'right'},
                        {field: 'ACCT_TaxCodes_ID', title: 'inv_l.acct_tax_codes_id'},

                        {field: 'TaxRate',          title: 'inv_l.tax_rate',        align: 'right'},
                        {field: 'Tax_DC',           title: 'inv_l.tax_dc',          align: 'right'},
                        {field: 'Gross_DC',         title: 'inv_l.gross_dc',        align: 'right'},
                        {field: 'UnitPrice_FC2',    title: 'inv_l.unit_price_fc2',  align: 'right'},
                        {field: 'Tax_FC2',          title: 'inv_l.tax_fc2',         align: 'right'},
                        {field: 'Brutto_FC2',       title: 'inv_l.gross_fc2',       align: 'right'},
                        {field: 'Curr_ID',          title: 'inv_l.curr_id'},
                        {field: 'Period_From_To',   title: 'inv_l.period_from_to'},
                        {field: 'Period_FROM',      title: 'inv_l.period_from'},
                        {field: 'Period_TO',        title: 'inv_l.period_to'},
                    ]
                });
        }

        $(function(){
            initTable();
        });

    </script>

@endsection
