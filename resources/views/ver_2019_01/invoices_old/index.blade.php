@extends('layouts.app')

@section('title', __('global.invoices.title'))

@section('content')
    @php
        $dateFormat = (config('appConfig.dateFormats'))[config('app.locale')]['carbon'];
        $priceFormat = config('appConfig.currencies.' . config('app.locale'));
    @endphp
    <section class="content-header">
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
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">
                    {{ __('global.invoices.title') }}
                </h3>
            </div>
            <div class="box-body">
                <div class="table-responsive mailbox-messages">

                    <div id="toolbar">
                        <button id="search" name="search" class="btn btn-default"
                                data-toggle="modal"
                                data-target="#searchRekord"
                                data-title="{{ __('global.app_search') }}"
                                data-message="{{ __('global.app_search_title') }}">
                            <i class="fa fa-search"></i>&nbsp;
                            {{ __('global.app_search') }}
                        </button>
                        <button type="button" class="btn btn-warning" style="margin-left: 5px;"
                                onclick="event.preventDefault();document.getElementById('search-clear1').submit();">
                            <i class='fa fa-trash-o'></i>&nbsp;
                            {{ __('global.app_delete_search') }}
                        </button>
                        <form id="search-clear1" name="search-clear1"
                              action="{{ url('invoices') }}" method="get">
                        </form>
                    </div>

                    <table id="table" name="table" class="table table-striped"
                           data-buttons-class="primary"
                           data-toolbar="#toolbar"
                           data-toggle="table"
                           data-search="false"
                           data-show-search-button="true"
                           data-search-on-enter-key="true"

                           data-virtual-scroll="true"

                           data-show-refresh="false"
                           data-show-toggle="false"
                           data-show-fullscreen="false"
                           data-show-columns="true"
                           data-show-export="true"
                           data-show-pagination-switch="false"

                           data-detail-formatter="detailFormatter"
                           data-minimum-count-columns="2"
                           data-striped="true"

                           data-pagination="true"
                           data-page-size="10"
                           data-page-list="[10, 25, 50, 100]"

                           data-show-footer="true">
                        <thead>
                        <tr>
                            <th class="col-md-6">{{ __('global.app_fields.operations') }}</th>
                            <!--<th data-checkbox="true"></th>-->
                            <!--<th data-halign="center" data-align="left" data-sortable="true" data-searchable="true" data-switchable="false" data-visible="true">{{ __('global.app_id') }}</th>-->
                            <th data-halign="center" data-align="left" data-sortable="true" data-searchable="true" data-switchable="true">{{ __('global.invoices.fields.inv_num') }}</th>
                            <!--
                            <th data-halign="center" data-align="left" data-sortable="true" data-searchable="true" data-switchable="true">{{ __('global.invoices.fields.cancel_inv_id') }}</th>
                            -->
                            <!--
                            <th data-halign="center" data-align="left" data-sortable="true" data-searchable="true" data-switchable="true">{{ __('global.invoices.fields.ref_inv_id') }}</th>
                            -->
                            <!--
                            <th data-halign="center" data-align="left" data-sortable="true" data-searchable="true" data-switchable="true">{{ __('global.invoices.fields.cancel_date') }}</th>
                            -->
                            <th data-halign="center" data-align="left" data-sortable="true" data-searchable="true" data-switchable="true">{{ __('global.invoices.fields.vendor_name') }}</th>
                            <th data-halign="center" data-align="left" data-sortable="true" data-searchable="true" data-switchable="true">{{ __('global.invoices.fields.cust_name') }}</th>
                            <!--
                            <th data-halign="center" data-align="left" data-sortable="true" data-searchable="true" data-switchable="true">{{ __('global.invoices.fields.period_from') }}</th>
                            <th data-halign="center" data-align="left" data-sortable="true" data-searchable="true" data-switchable="true">{{ __('global.invoices.fields.period_to') }}</th>
                            -->
                            <th data-halign="center" data-align="left" data-sortable="true" data-searchable="true" data-switchable="true">{{ __('global.invoices.fields.inv_date') }}</th>
                            <th data-halign="center" data-align="left" data-sortable="true" data-searchable="true" data-switchable="true">{{ __('global.invoices.fields.delivery_date') }}</th>
                            <th data-halign="center" data-align="left" data-sortable="true" data-searchable="true" data-switchable="true">{{ __('global.invoices.fields.due_date') }}</th>
                            <th data-halign="center" data-align="left" data-sortable="true" data-searchable="true" data-switchable="true">{{ __('global.invoices.fields.netto_lc') }}</th>
                            <th data-halign="center" data-align="left" data-sortable="true" data-searchable="true" data-switchable="true">{{ __('global.invoices.fields.tax_lc') }}</th>
                            <th data-halign="center" data-align="left" data-sortable="true" data-searchable="true" data-switchable="true">{{ __('global.invoices.fields.brutto_lc') }}</th>
                            <!--<th data-halign="center" data-align="left" data-sortable="true" data-searchable="true" data-switchable="true">{{ __('global.invoices.fields.pay_status') }}</th>-->
                            <th data-halign="center" data-align="left" data-sortable="true" data-searchable="true" data-switchable="true">{{ __('global.invoices.fields.paid_amount_dc') }}</th>
                            <th data-halign="center" data-align="left" data-sortable="true" data-searchable="true" data-switchable="true">{{ __('global.invoices.fields.paid_amount_fc') }}</th>
                            <th data-halign="center" data-align="left" data-sortable="true" data-searchable="true" data-switchable="true">{{ __('global.invoices.fields.curr_id') }}</th>
                            <th data-halign="center" data-align="left" data-sortable="true" data-searchable="true" data-switchable="true">{{ __('global.invoices.fields.netto_fc') }}</th>
                            <th data-halign="center" data-align="left" data-sortable="true" data-searchable="true" data-switchable="true">{{ __('global.invoices.fields.tax_fc') }}</th>
                            <th data-halign="center" data-align="left" data-sortable="true" data-searchable="true" data-switchable="true">{{ __('global.invoices.fields.brutto_fc') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($invoices as $invoice)
                            <tr>
                                <td>
                                    <a href="{{ url('invoices.show', $invoice) }}"
                                       class="btn btn-success btn-xs view">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    
                                    <a href="mailto:info@selester.hu?subject=Kérdések a {{ $invoice->Inv_Num }} számlával kapcsolatban&body=Tisztelt {{ $invoice->Cust_Name1 }}!%0D%0AÜdvözlettel: {{ $invoice->Vendor_Name1 }}"
                                       class="btn btn-info btn-xs">
                                        <i class="fa fa-envelope"></i>
                                    </a>
                                    
                                </td>
                                <!--<td></td>-->
                                <!--<td>{{ $invoice->ID }}</td>-->
                                <td>{{ $invoice->Inv_Num }}</td>
                                <!--<td>{{ $invoice->CancelInv_Num }}</td>-->
                                <!--<td>{{ $invoice->Ref_Inv_ID }}</td>-->
                                <!--<td>{{ $invoice->CancelDate }}</td>-->
                                <td>{{ $invoice->Vendor_Name1 }}</td>
                                <td>{{ $invoice->Cust_Name1 }}</td>
                                <!--
                                <td>{{ $invoice->Period_FROM }}</td>
                                <td>{{ $invoice->Period_TO }}</td>
                                -->
                                <td>{{ \Carbon\Carbon::parse($invoice->InvDate)->format($dateFormat) }}</td>
                                <td>{{ \Carbon\Carbon::parse($invoice->DeliveryDate)->format($dateFormat) }}</td>
                                <td>{{ \Carbon\Carbon::parse($invoice->DueDate)->format($dateFormat) }}</td>
                                <td>{{ str_replace('%s', number_format($invoice->Netto_LC, 2), $priceFormat) }}</td>
                                <td>{{ str_replace('%s', number_format($invoice->Tax_LC, 2), $priceFormat) }}</td>
                                <td>{{ str_replace('%s', number_format($invoice->Brutto_LC, 2), $priceFormat) }}</td>
                                <!--<td>{{ $invoice->PayStatus }}</td>-->
                                <td>{{ str_replace('%s', number_format($invoice->PaidAmount_DC, 2), $priceFormat) }}</td>
                                <td>{{ str_replace('%s', number_format($invoice->PaidAmount_FC, 2), $priceFormat) }}</td>
                                <td>{{ $invoice->Curr_ID }}</td>
                                <td>{{ str_replace('%s', number_format($invoice->Netto_FC, 2), $priceFormat) }}</td>
                                <td>{{ str_replace('%s', number_format($invoice->Tax_FC, 2), $priceFormat) }}</td>
                                <td>{{ str_replace('%s', number_format($invoice->Brutto_FC, 2), $priceFormat) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="pull-right hidden-xs">
                    @php
                    $time = number_format((microtime(true) - LARAVEL_START), 2);
                    @endphp
                    {{ __('global.app_page_render_ime_01') }} <b>{{ $time }}</b> {{ __('global.app_page_render_ime_02') }}
                </div>
            </div>
        </div>
    </section>

    <!-- MODAL -->
    @include('modals.modal_search', [
        'fields' => "{$version}.invoices.partials.fields_search",
        'url' => 'invoices.search'
    ])

@endsection

@section('css')
    <link href="{{ asset('assets/bower_components/bootstrap-table/1.15.4/dist/bootstrap-table.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
@endsection

@section('js')
    <script src="{{ asset('assets/bower_components/bootstrap-table/tableExport.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/bower_components/bootstrap-table/1.15.4/dist/bootstrap-table.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/bower_components/bootstrap-table/1.15.4/dist/locale/bootstrap-table-hu-HU.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/bower_components/bootstrap-table/1.15.4/dist/extensions/export/bootstrap-table-export.js') }}" type="text/javascript"></script>

    <script src="{{ asset('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('assets/bower_components/bootstrap-datepicker/dist/locales/bootstrap-datepicker.hu.min.js') }}"></script>
    <script>
        var $table = $('#table');
        var frm = $('#frmSearch');

        $('#s_due_date, #s_delivery_date, #s_inv_date').datepicker({
            autoclose: true,
            language: 'hu'
        });

        function initTable()
        {
            $table.bootstrapTable('destroy')
                .bootstrapTable({
                    height: 400,
                    exportTypes: ['csv', 'txt', 'excel', 'pdf'],
                    locale: '{{ config('app.locale') . '-' . strtoupper(config('app.locale')) }}',
                }).trigger('change');
        }

        $(function()
        {
            initTable();
        });

        /**
         * -----------------------------------------------------------
         *  Modal megjelenése előtt
         * -----------------------------------------------------------
         */
        $('#searchRekord').on('show.bs.modal', function(e)
        {
            //console.log(e.relatedTarget);
            $(this).find('.modal-body p').text($(e.relatedTarget).attr('data-message'));
            $(this).find('.modal-title').text($(e.relatedTarget).attr('data-title'));
            //$(this).find('.modal-footer #confirm').val($(e.relatedTarget).attr('data-value'));

            $('.help-block').hide();
        });
        /**
         * -----------------------------------------------------------
         *  Modal megjelenése után
         * -----------------------------------------------------------
         */
        $('#searchRekord').on('hidden.bs.modal', function(e)
        {
            // Vevő combo alap helyzetbe állítása
            $('#s_vendor option:selected').prop('selected', false);
            // Szállító combo alap helyzetbe állítása
            $('#s_customer option:selected').prop('selected', false);
            // Számla kelte
            $('#s_inv_date_rel option:selected').prop('selected', false);
            $('#s_inv_date').datepicker('update', '');
            // Szállítás dátuma
            $('#s_delivery_date_rel option:selected').prop('selected', false);
            $('#s_delivery_date').datepicker('update', '');
            // Lejárat dátuma
            $('#s_due_date_rel option:selected').prop('selected', false);
            $('#s_due_date').datepicker('update', '');
        });
        /**
         * -----------------------------------------------------------
         *  Keresés
         * -----------------------------------------------------------
         */
        $('#kereses').on('click', function(e)
        {
            //console.log('kereses');
            frm.submit();
        });


         /*
        function operateFormatter(value, row, index) {
            return [
                '<a class="like" href="javascript:void(0)" title="Like">',
                '<i class="fa fa-heart"></i>',
                '</a>  ',
                '<a class="remove" href="javascript:void(0)" title="Remove">',
                '<i class="fa fa-trash"></i>',
                '</a>'
            ].join('')
        }

        window.operateEvent = {
            'click .like': function(e, value, row, index)
            {
                alert('You click like action, row: ' + JSON.stringify(row))
            },
            'click .remove': function(e, value, row, index){}
        }
        */
       /*
        function totalTextFormatter(data) {
            return 'Total'
        }

        function totalNameFormatter(data) {
            return data.length
        }

        function totalPriceFormatter(data)
        {
            var field = this.field
            return '$' + data.map(function (row) {
                return +row[field].substring(1)
            }).reduce(function (sum, i) {
                return sum + i
            }, 0)
        }
*/
    </script>
@endsection
