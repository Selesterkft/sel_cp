@extends('layouts.app')

@section('title', __('global.invoices.title'))

@section('content')

<section class='content-header'>

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
        
        <div class="box-header">
            <h3 class="box-title">
                {{ __('global.invoices.title') }}
            </h3>
        </div>
        
        <div class="box box-body">
            <div class="table-responsive mailbox-messages">
                
                <table id="table" name="table" class="table table-striped" 
                       data-id-field="ID"
                       data-url="{{ url('inv.data') }}"
                       data-buttons-class="primary"
                       data-toggle="table"
                       data-search="true"
                       data-show-search-button="false"
                       data-search-on-enter-key="false"
                       data-side-pagination="server"
                       data-virtual-scroll="true"

                       data-show-refresh="true"
                       data-show-toggle="false"
                       data-show-fullscreen="false"
                       data-show-columns="true"
                       data-show-export="true"
                       data-show-pagination-switch="false" 
                       data-show-columns-toggle-all="true"

                       data-detail-formatter="detailFormatter"
                       data-minimum-count-columns="2"
                       data-striped="true"

                       data-pagination="true"
                       data-page-size="10"
                       data-page-list="[10, 25, 50, 100]"

                       data-show-footer="true">
                    <thead>
                      <tr>
                          <th data-field="state" data-checkbox="true"></th>
                          <th data-field="Inv_Num" data-sortable="true">Inv_Num</th>
                          <th data-field="Vendor_Name1" data-sortable="true">Vendor_Name1</th>
                          <th data-field="Cust_Name1" data-sortable="true">Cust_Name1</th>
                          <th data-field="InvDate" 
                              data-formatter="dateFormatter" 
                              data-sortable="true">InvDate</th>
                          <th data-field="DeliveryDate" 
                              data-formatter="dateFormatter" 
                              data-sortable="true">DeliveryDate</th>
                          <th data-field="DueDate" 
                              data-formatter="dateFormatter"
                              data-sortable="true">DueDate</th>
                          <th data-field="PostInDate" 
                              data-formatter="dateFormatter"
                              data-sortable="true">PostInDate</th>
                          <th data-field="InvInDueDate" 
                              data-formatter="dateFormatter"
                              data-sortable="true">InvInDueDate</th>
                          <th data-field="Netto_LC" 
                              data-formatter="priceFormatter"
                              data-sortable="true">Netto_LC</th>
                          <th data-field="Tax_LC" 
                              data-formatter="priceFormatter"
                              data-sortable="true">Tax_LC</th>
                          <th data-field="Brutto_LC" data-sortable="true">Brutto_LC</th>
                          <th data-field="PaidAmount_DC" 
                              data-formatter="priceFormatter"
                              data-sortable="true">PaidAmount_DC</th>
                          <th data-field="PaidAmount_FC" 
                              data-formatter="priceFormatter"
                              data-sortable="true">PaidAmount_FC</th>
                          <th data-field="Curr_ID" 
                              data-formatter="priceFormatter"
                              data-sortable="true">Curr_ID</th>
                          <th data-field="Brutto_LC" 
                              data-formatter="priceFormatter"
                              data-sortable="true">Brutto_LC</th>
                          <th data-field="Tax_FC" 
                              data-formatter="priceFormatter"
                              data-sortable="true">Tax_FC</th>
                          <th data-field="Brutto_FC" 
                              data-formatter="priceFormatter"
                              data-sortable="true">Brutto_FC</th>
                          
                      </tr>
                    </thead>
                </table>
            </div>
        </div>
        
    </div>

</section>
@endsection

@section('css')
<link href="{{ asset('assets/bower_components/bootstrap-table/1.15.4/dist/bootstrap-table.css') }}" rel="stylesheet"/>
@endsection

@section('js')
{{-- Bootstrap Table --}}
<script src="{{ asset('assets/bower_components/bootstrap-table/tableExport.min.js') }}" type="text/javascript"></script>
<script src="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.15.5/dist/locale/bootstrap-table-hu-HU.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.15.5/dist/extensions/export/bootstrap-table-export.js"></script>

<script src="{{ asset('assets/bower_components/moment/moment.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/bower_components/moment/locale/hu.js') }}" type="text/javascript"></script>

<script>
    var $table = $('#table');
    var dateFormat = '{{ (config('appConfig.dateFormats'))[config('app.locale')]['moment'] }}';
    var priceFormat = '{{ (config('appConfig.currencies.' . config('app.locale'))) }}';
    var selections = [];

    function priceFormatter(data)
    {
        return formatMoney(data);
    }

    function dateFormatter(data)
    {
        return moment(data).format(dateFormat);
    }

    function formatMoney(number, decPlaces, decSep, thouSep) 
    {
        decPlaces = isNaN(decPlaces = Math.abs(decPlaces)) ? 2 : decPlaces,
        decSep = typeof decSep === "undefined" ? "." : decSep;
        thouSep = typeof thouSep === "undefined" ? "," : thouSep;
        var sign = number < 0 ? "-" : "";
        var i = String(parseInt(number = Math.abs(Number(number) || 0).toFixed(decPlaces)));
        var j = (j = i.length) > 3 ? j % 3 : 0;

        return sign + 
                (j ? i.substr(0, j) + thouSep : "") + 
                i.substr(j).replace(/(\decSep{3})(?=\decSep)/g, "$1" + thouSep) + 
                (decPlaces ? decSep + Math.abs(number - i).toFixed(decPlaces).slice(2) : "");
}
/*
document.getElementById("b").addEventListener("click", event => {
  document.getElementById("x").innerText = "Result was: " + formatMoney(document.getElementById("d").value);
});
*/
</script>

@endsection