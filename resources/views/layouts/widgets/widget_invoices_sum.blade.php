@php
//$invModel = '\App\Models\ver_2019_01\InvoiceModel';
$invModel = app()->make('\App\Models\ver_2019_01\InvoiceModel');
$data = $invModel->getWidgetData();
@endphp
<section class="col-lg-12">
    <div class="box box-info">

        <div class="box-header with-border">
            <h3 class="box-title">Latest Orders</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                    <i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove">
                    <i class="fa fa-times"></i>
                </button>
            </div>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table class="table no-margin">
                    <thead>
                    <tr>
                        <th>{{ trans('global.invoices_widget.currency') }}</th>
                        <th>{{ trans('global.invoices_widget.type') }}</th>
                        <th>{{ trans('global.invoices_widget.debts') }}</th>
                        <th>{{ trans('global.invoices_widget.overdue_debts') }}</th>
                        <th>{{ trans('global.invoices_widget.open_invoices') }}</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($data as $sum)
                        <tr>
                            <td>{{ $sum->Curr_ID }}</td>
                            <td>{{ $sum->TypeID }}</td>
                            <td>{{ $sum->NettoOsszesen }}</td>
                            <td>{{ $sum->BruttoOsszesen }}</td>
                            <td>{{ $sum->EddigKifizetve }}</td>
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
