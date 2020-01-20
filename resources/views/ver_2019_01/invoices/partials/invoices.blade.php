<div class="box box-default">

    <div class="box-header">
        <h3 class="box-title">
            {{ __('global.invoices.title') }}
        </h3>
    </div>

    <div class="box box-body">

        <!--<div class="table-responsive mailbox-messages">-->
        <table id="table" name="table" class="table table-striped"
               data-buttons-class="primary"
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
                <th data-switchable="false" data-sortable="false" data-searchable="false"
                    data-exportable="false">{{ __('global.app_fields.operations') }}</th>
                <!--<th data-checkbox="true"></th>-->
            <!--<th data-halign="center" data-align="left" data-sortable="true" data-searchable="true" data-switchable="false" data-visible="true">{{ __('global.app_id') }}</th>-->
                <th data-halign="center" data-align="left" data-sortable="true" data-searchable="true"
                    data-switchable="true">{{ __('global.invoices.fields.inv_num') }}</th>
            <!--
                        <th data-halign="center" data-align="left" data-sortable="true" data-searchable="true" data-switchable="true">{{ __('global.invoices.fields.cancel_inv_id') }}</th>
                        -->
            <!--
                        <th data-halign="center" data-align="left" data-sortable="true" data-searchable="true" data-switchable="true">{{ __('global.invoices.fields.ref_inv_id') }}</th>
                        -->
            <!--
                        <th data-halign="center" data-align="left" data-sortable="true" data-searchable="true" data-switchable="true">{{ __('global.invoices.fields.cancel_date') }}</th>
                        -->
                @if( Auth::user()->Supervisor_ID == 0 )
                    <th data-halign="center" data-align="left" data-sortable="true" data-searchable="true"
                        data-switchable="true">{{ __('global.invoices.fields.vendor_name') }}</th>
                    <th data-halign="center" data-align="left" data-sortable="true" data-searchable="true"
                        data-switchable="true">{{ __('global.invoices.fields.cust_name') }}</th>
                @endif
            <!--
                        <th data-halign="center" data-align="left" data-sortable="true" data-searchable="true" data-switchable="true">{{ __('global.invoices.fields.period_from') }}</th>
                        <th data-halign="center" data-align="left" data-sortable="true" data-searchable="true" data-switchable="true">{{ __('global.invoices.fields.period_to') }}</th>
                        -->
                <th data-halign="center" data-align="left" data-sortable="true" data-searchable="true"
                    data-switchable="true" data-width=100">{{ __('global.invoices.fields.inv_date') }}</th>
                <th data-halign="center" data-align="left" data-sortable="true" data-searchable="true"
                    data-switchable="true" data-width=100">{{ __('global.invoices.fields.delivery_date') }}</th>
                <th data-halign="center" data-align="left" data-sortable="true" data-searchable="true"
                    data-switchable="true" data-width=100">{{ __('global.invoices.fields.due_date') }}</th>

                <th data-halign="center" data-align="left" data-sortable="true" data-searchable="true" data-switchable="true">{{ __('global.app_currency') }}</th>

                <th data-halign="center" data-align="left" data-sortable="true" data-searchable="true"
                    data-switchable="true">{{ __('global.invoices.fields.netto_lc') }}</th>
                <th data-halign="center" data-align="left" data-sortable="true" data-searchable="true"
                    data-switchable="true">{{ __('global.invoices.fields.tax_lc') }}</th>
                <th data-halign="center" data-align="left" data-sortable="true" data-searchable="true"
                    data-switchable="true">{{ __('global.invoices.fields.brutto_lc') }}</th>
            <!--<th data-halign="center" data-align="left" data-sortable="true" data-searchable="true" data-switchable="true">{{ __('global.invoices.fields.pay_status') }}</th>-->
                <th data-halign="center" data-align="left" data-sortable="true" data-searchable="true"
                    data-switchable="true">{{ __('global.invoices.fields.paid_amount_dc') }}</th>
<!--
                <th data-halign="center" data-align="left" data-sortable="true" data-searchable="true"
                    data-switchable="true">{{ __('global.invoices.fields.paid_amount_dc') }}</th>
                <th data-halign="center" data-align="left" data-sortable="true" data-searchable="true"
                    data-switchable="true">{{ __('global.invoices.fields.paid_amount_dc') }}</th>
                <th data-halign="center" data-align="left" data-sortable="true" data-searchable="true"
                    data-switchable="true">{{ __('global.invoices.fields.paid_amount_dc') }}</th>
-->
                {{--<th data-halign="center" data-align="left" data-sortable="true" data-searchable="true" data-switchable="true">{{ __('global.invoices.fields.paid_amount_fc') }}</th>--}}
                {{--<th data-halign="center" data-align="left" data-sortable="true" data-searchable="true" data-switchable="true">{{ __('global.invoices.fields.curr_id') }}</th>--}}
                {{--<th data-halign="center" data-align="left" data-sortable="true" data-searchable="true" data-switchable="true">{{ __('global.invoices.fields.netto_fc') }}</th>--}}
                {{--<th data-halign="center" data-align="left" data-sortable="true" data-searchable="true" data-switchable="true">{{ __('global.invoices.fields.tax_fc') }}</th>--}}
                {{--<th data-halign="center" data-align="left" data-sortable="true" data-searchable="true" data-switchable="true">{{ __('global.invoices.fields.brutto_fc') }}</th>--}}
            </tr>
            </thead>
            <tbody>
            @foreach ($invoices as $invoice)
                @php
                    $f = new \NumberFormatter(app()->getLocale(), \NumberFormatter::CURRENCY);
                    $f->setAttribute($f::FRACTION_DIGITS, 2);
                @endphp
                <tr>
                    <td>
                        <a href="{{ url('invoices.show', $invoice) }}"
                           class="btn btn-success btn-sm view">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="mailto:?subject=Kérdések a {{ $invoice->Inv_Num }} számlával kapcsolatban&body=Tisztelt {{ $invoice->Cust_Name1 }}!%0D%0AÜdvözlettel: {{ $invoice->Vendor_Name1 }}"
                           class="btn btn-info btn-sm">
                            <i class="fa fa-envelope"></i>
                        </a>
                    </td>
                    <!--<td></td>-->
                <!--<td>{{-- $invoice->ID --}}</td>-->
                    <td>{{ $invoice->Inv_Num }}</td>
                <!--<td>{{-- $invoice->CancelInv_Num --}}</td>-->
                <!--<td>{{-- $invoice->Ref_Inv_ID --}}</td>-->
                <!--<td>{{-- $invoice->CancelDate --}}</td>-->
                    @if( Auth::user()->Supervisor_ID == 0 )
                        <td>{{ $invoice->Vendor_Name1 }}</td>
                        <td>{{ $invoice->Cust_Name1 }}</td>
                    @endif
                <!--
                        <td>{{-- $invoice->Period_FROM --}}</td>
                        <td>{{-- $invoice->Period_TO --}}</td>
                        -->
                    <td>{{ \Carbon\Carbon::parse($invoice->InvDate)->format($dateFormat) }}</td>
                    <td>{{ \Carbon\Carbon::parse($invoice->DeliveryDate)->format($dateFormat) }}</td>
                    <td>{{ \Carbon\Carbon::parse($invoice->DueDate)->format($dateFormat) }}</td>


                        <td>
                            {{ $invoice->Curr_DC }}
                        </td>

                    <td>
                        <div class="pull-right">
                        {{ $f->formatCurrency($invoice->Netto_LC, $invoice->Curr_DC) }}
                        {{-- str_replace('%s', number_format($invoice->Netto_LC, 2), $priceFormat) --}}
                        </div>
                    </td>


                    <td>
                        <div class="pull-right">
                            {{-- number_format($invoice->Tax_LC, 2, ' ', ',') --}}
                            {{ $f->formatCurrency($invoice->Tax_LC, $invoice->Curr_DC) }}
                        </div>
                        {{-- str_replace('%s', number_format($invoice->Tax_LC, 2), $priceFormat) --}}
                    </td>

                    <td>
                        <div class="pull-right">
                            {{-- number_format($invoice->Brutto_LC, 2, ' ', ',') --}}
                            {{ $f->formatCurrency($invoice->Brutto_LC, $invoice->Curr_DC) }}
                        </div>
                        {{-- str_replace('%s', number_format($invoice->Brutto_LC, 2), $priceFormat) --}}
                    </td>

                <!--<td>{{-- $invoice->PayStatus --}}</td>-->

                    <td>
                        <div class="pull-right">
                            {{-- number_format($invoice->PaidAmount_DC, 2, ' ', ',') --}}
                            {{ $f->formatCurrency($invoice->PaidAmount_LC, $invoice->Curr_DC) }}
                        </div>
                        {{-- str_replace('%s', number_format($invoice->PaidAmount_DC, 2), $priceFormat) --}}
                    </td>
<!--
                    <td>{{ $f->formatCurrency($invoice->PaidAmount_LC, $invoice->Curr_DC) }}</td>
                    <td>{{ $f->formatCurrency($invoice->PaidAmount_LC, $invoice->Curr_DC) }}</td>
                    <td>{{ $f->formatCurrency($invoice->PaidAmount_LC, $invoice->Curr_DC) }}</td>
-->
                </tr>
            @endforeach
            </tbody>
        </table>
        <!--</div>-->

    </div>
    <div class="box box-footer">

        <div class="pull-right hidden-xs">
            @php
                $time = number_format((microtime(true) - LARAVEL_START), 2);
            @endphp
            {{ __('global.app_page_render_ime_01') }} <b>{{ $time }}</b> {{ __('global.app_page_render_ime_02') }}
        </div>

    </div>
</div>
