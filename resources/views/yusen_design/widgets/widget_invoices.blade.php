@php
use App\Models\ver_2019_01\InvoiceModel;
$countOfInvoices = InvoiceModel::getCountOfInvoices();
@endphp
<div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-red invoicesBox">
        <div class="inner invoicesBox">
            <h3 class="invoicesBox">{{ trans('inv.title') }}</h3>

            <p class="invoicesBox">
                {{ $countOfInvoices }}&nbsp;{{ trans('app.amount') }}
            </p>
        </div>
        <div class="icon invoicesBox">
            <i class="ion ion-ios-list-outline invoicesBox"></i>
        </div>
        <a href="{{ url('invoices') }}"
           class="small-box-footer invoicesBox">
            {{ trans('app.more_info') }}&nbsp;
            <i class="fa fa-arrow-circle-right invoicesBox"></i>
        </a>
    </div>
</div>

<script>
    let $invBox = $('.invoicesBox');

    $invBox.on('mouseleave', function()
    {
        $invBox.find('*').css('cursor', 'pointer');
    });

    $invBox.mouseover(function()
    {
        $invBox.find('*').css('cursor', 'hand');
    });

    $invBox.click(function()
    {
        window.location = '{{ url('invoices') }}';
    });
</script>
