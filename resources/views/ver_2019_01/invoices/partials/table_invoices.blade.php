<div class="box box-default">

    <div class="box-header">
        <h3 class="box-title">
            {{ __('global.invoices.title') }}
        </h3>
    </div>
<?php
    //data-url="{{ url('inv_new') }}"
    //data-ajax-options="ajaxOptions"
    //data-ajax="ajaxRequest"
    //data-query-params="queryParams"
?>
    <div class="box box-body">
        <div class="table-responsive mailbox-messages">

            <table id="table" name="table" class="table table-striped table-bordered"
                   data-id-field="ID"

                   data-toolbar="#toolbar"

                   data-query-params="queryParams"
                   data-url="{{ url('invoices') }}"

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

                   data-pagination="true"
                   data-page-size="10"
                   data-page-list="[10, 25, 50, 100]"

                   data-show-footer="true">
                <thead>
                <tr>
                    <!--
                    <th data-field="state" data-checkbox="true"></th>
                    -->
                    <th data-cell-style="cellStyle"></th>
                    <th data-field="Inv_Num"
                        data-sortable="true">{{ __('global.invoices.fields.inv_num') }}</th>
                    @if( Auth::user()->Supervisor_ID == 0 )
                        <th data-field="Vendor_Name1"
                            data-sortable="true">{{ __('global.invoices.fields.vendor_name') }}</th>
                        <th data-field="Cust_Name1"
                            data-sortable="true">{{ __('global.invoices.fields.cust_name') }}</th>
                    @endif
                    <th data-field="InvDate"
                        data-formatter="dateFormatter"
                        data-sortable="true"
                        data-cell-style="cellStyle">{{ __('global.invoices.fields.inv_date') }}</th>
                    <th data-field="DeliveryDate"
                        data-formatter="dateFormatter"
                        data-sortable="true">{{ __('global.invoices.fields.delivery_date') }}</th>
                    <th data-field="DueDate"
                        data-formatter="dateFormatter"
                        data-sortable="true">{{ __('global.invoices.fields.due_date') }}</th>

                    <th data-field="Curr_DC"
                        data-sortable="true">
                        {{ __('global.app_currency') }}
                    </th>
                    <th data-field="Netto_DC"
                        data-sortable="true"
                        data-formatter="priceFormatter"
                        data-halign="left" data-align="right">
                        {{ __('global.invoices.fields.netto_lc') }}
                    </th>
                    <th data-field="Tax_DC"
                        data-formatter="priceFormatter"
                        data-sortable="true"
                        data-halign="left" data-align="right">
                        {{ __('global.invoices.fields.tax_lc') }}
                    </th>
                    <th data-field="Brutto_DC"
                        data-formatter="priceFormatter"
                        data-sortable="true"
                        data-halign="left" data-align="right">
                        {{ __('global.invoices.fields.brutto_lc') }}
                    </th>
                    <th data-field="PaidAmount_DC"
                        data-formatter="priceFormatter"
                        data-sortable="true"
                        data-halign="left" data-align="right">
                        {{ __('global.invoices.fields.paid_amount_dc') }}
                    </th>
                </tr>
                </thead>
            </table>

        </div>
    </div>


</div>
