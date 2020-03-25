@php
$invModel = app()->make('\App\Models\ver_2019_01\InvoiceModel');
$data = $invModel->getWidgetData();
@endphp
<section class="col-lg-12">
    <div class="box box-default">

        <div class="box-header with-border">
            <h3 class="box-title">
                {{ trans('inv.widget_title') }}
            </h3>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                    <!--
                        <th>{{-- trans('global.invoices_widget.currency') --}}</th>
                        <th>{{-- trans('global.invoices_widget.type') --}}</th>
                        <th>{{-- trans('global.invoices_widget.debts') --}}</th>
                        <th>{{-- trans('global.invoices_widget.overdue_debts') --}}</th>
                        <th>{{-- trans('global.invoices_widget.paid_so_far') --}}</th>
                        -->
                        <th class="text-center">{{ trans('inv.widget_type') }}</th>
                        <th class="text-center">{{ trans('app.curr') }}</th>
                        <th class="text-center">{{ trans('inv.widget_net_total') }}</th>
                        <th class="text-center">{{ trans('inv.widget_tax_total') }}</th>
                        <th class="text-center">{{ trans('inv.widget_gross_total') }}</th>
                        <th class="text-center">{{ trans('inv.widget_debit') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $f = new \NumberFormatter(app()->getLocale(), \NumberFormatter::DECIMAL);
                        $f->setAttribute($f::FRACTION_DIGITS, 2);
                    @endphp
                    @foreach($data as $sum)
                        <tr>
                            <td>
                                {{ trans('app.account_type_' . $sum->TypeID) }}
                            </td>
                            <td>{{ $sum->Penznem }}</td>
                            <td>
                                <div class="pull-right">
                                    {{ $f->format($sum->NettoOsszesen) }}
                                </div>
                            </td>
                            <td>
                                <div class="pull-right">
                                    {{ $f->format($sum->AFAOsszesen) }}
                                </div>
                            </td>
                            <td>
                                <div class="pull-right">
                                    {{ $f->format($sum->BruttoOsszesen) }}
                                </div>
                            </td>
                            <td>
                                <div class="pull-right">
                                    {{ $f->format($sum->EddigKifizetve) }}
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            <!--
            <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
            <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
            -->
        </div>
        <!-- /.box-footer -->
    </div>
</section>
