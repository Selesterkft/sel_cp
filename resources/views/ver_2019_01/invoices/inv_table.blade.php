@includeIf('layouts.toolbars.search_toolbar', ['url' => url('invoices')])
<table id="inv_table" name="inv_table"
       class="table table-striped table-bordered"
       data-toolbar="#toolbar"
       data-buttons-class="primary"
       data-query-params="queryParams"
       data-url="{{ url('invoices') }}"
       data-toggle="table"

       data-cookie="true"
       data-cookie-id-table="inv_table"

       data-show-refresh="true"
       data-show-columns="true"
       data-show-export="true"
       data-striped="true"

       data-minimum-count-columns="2"
       data-side-pagination="server"
       data-pagination="true"
       data-page-size="10"
       data-page-list="[10, 25, 50, 100]"></table>

@section('inv_css')
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

@section('inv_script')
<script>
    var $table = $('#inv_table');
    var $local = '{{ app() ->getLocale() }}' + '-' + '{{ strtoupper(app()->getLocale()) }}';
    var $local_short = '{{ app() ->getLocale() }}';
    var $searchModal = $('#searchRekord');
    var $s_invNum    = $('#s_invNum');
    /*
    var $s_customer  = $('#s_customer');
    var $s_vendor    = $('#s_vendor');
    */
    var $s_partner    = $('#s_partner');

    var $s_delivery_date = $('#s_delivery_date');
    var $s_due_date = $('#s_due_date');
    var $s_type = $('#s_type');

    function queryParams(params){

        var urlParams = getAllUrlParams();

        params.s_invNum = $s_invNum.val();
        /*
        params.s_vendor = $s_vendor.val();
        params.s_customer = $s_customer.val();
        */
        params.s_partner = $s_partner.val();

        params.s_type = $s_type.val();

        if( urlParams.s_due_date != undefined && urlParams.s_due_date != '' )
        {
            params.s_due_date = urlParams.s_due_date.replace('+-+', ' - ');
        }
        if( urlParams.s_delivery_date != undefined && urlParams.s_delivery_date != '' )
        {
            params.s_delivery_date = urlParams.s_delivery_date.replace('+-+', ' - ');
        }
        return params;
    }
    /*
    * ================================
    * Search Modal Open
    * ================================
    */
    $searchModal.on('show.bs.modal', function(event){

        if( getAllUrlParams().s_due_date != undefined && getAllUrlParams().s_due_date != '' )
        {
            $s_due_date.val(getAllUrlParams().s_due_date.replace('+-+', ' - '));
            $datumok = getAllUrlParams().s_due_date.split('+-+');
            $s_due_date.data('daterangepicker').setStartDate($datumok[0]);
            $s_due_date.data('daterangepicker').setEndDate($datumok[1]);
        }

        if( getAllUrlParams().s_delivery_date != undefined && getAllUrlParams().s_delivery_date != '' )
        {
            $s_delivery_date.val(getAllUrlParams().s_delivery_date.replace('+-+', ' - '));
            $datumok = getAllUrlParams().s_delivery_date.split('+-+');
            $s_delivery_date.data('daterangepicker').setStartDate($datumok[0]);
            $s_delivery_date.data('daterangepicker').setEndDate($datumok[1]);
        }
    });

    /*
        * ================================
        * Search Modal Close
        * ================================
        */
    $searchModal.on('hide.bs.modal', function(event)
    {
        //lblSearch;
    });

    /*
        * ================================
        * Daterange Pickers Language settings
        * ================================
        */
    var hungarian_daterangepicker = {
        direction: "ltr",
        format: "{{ config('appConfig.dateFormats.' . app()->getLocale() . '.moment') }}",
        separator: " - ",
        cancelLabel: "{{ trans('app.cancel') }}",
        applyLabel: "{{ trans('app.apply') }}",
        fromLabel: "Da",
        toLabel: "A",
        //customRangeLabel: "Personalizzata",
        daysOfWeek: ['Vas', 'Hét', 'Ked', 'Sze', 'Csü', 'Pén', 'Szo'],
        monthNames: ['Január', 'Február', 'Március', 'Április', 'Május', 'Június', 'Július', 'Augusztus', 'Szeptember', 'Október', 'November', 'December'],
        firstDay: 1
    };

    /*
        * ================================
        * Daterange Pickers
        * ================================
        */
    $('#s_delivery_date, #s_due_date').daterangepicker({
        autoUpdateInput: false,
        showWeekNumbers: true,
        drops: 'up',
        @php
            if( app()->getLocale() == 'hu' )
            {
                echo('"locale" : hungarian_daterangepicker');
            }
        @endphp
    });

    //
    $('#s_delivery_date, #s_due_date').on('apply.daterangepicker', function(ev, picker)
    {

        $(this).val(picker.startDate.format('@php echo config("appConfig.dateFormats." . app()->getLocale() . ".moment") @endphp') +
            ' - ' +
            picker.endDate.format('@php echo config("appConfig.dateFormats." . app()->getLocale() . ".moment") @endphp'));
    });

    $('#s_delivery_date, #s_due_date').on('cancel.daterangepicker', function(ev, picker)
    {
        $(this).val('');
    });

    function dateFormatter(data)
    {
        return moment(data).locale($local_short).format('L');
    }

    function decimalFormatter(data)
    {
        return FormatNumber(data);
    }

    function initTable(){
        $table
            .bootstrapTable('destroy')
            .bootstrapTable({
                exportTypes: ['excel'],
                locale: $local,
                undefinedText: ' ',
                columns: {!! $table_columns !!}
            });
    }

    $(function()
    {
        initTable();
    });

    function queryParams(params)
    {
        var urlParams = getAllUrlParams();
        params.s_invNum = $s_invNum.val();
        /*
        params.s_vendor = $s_vendor.val();
        params.s_customer = $s_customer.val();
        */
        params.s_partner = $s_partner.val();

        params.s_type = $s_type.val();

        if( urlParams.s_due_date != undefined && urlParams.s_due_date != '' )
        {
            params.s_due_date = urlParams.s_due_date.replace('+-+', ' - ');
        }
        if( urlParams.s_delivery_date != undefined && urlParams.s_delivery_date != '' )
        {
            params.s_delivery_date = urlParams.s_delivery_date.replace('+-+', ' - ');
        }
        return params;
    }

    function operateFormatter(value, row, index) {

        //console.log(row);
        $url = '{{ url('invoices.show') }}' + '/' + row.ID;

        return [
            '<a href="' + $url + '" class="btn btn-success btn-sm view"><i class="fa fa-eye"></i></a>',
            '<a href="mailto:?from=from@email.hu&to=to@email.hu&subject=Kérdések a ' + row.Inv_Num + ' számlával kapcsolatban&body=Tisztelt ' + row.Cust_Name1 + ' !%0D%0AÜdvözlettel: ' + row.Vendor_Name1 + '" '+
            'class="btn btn-info btn-sm" style="margin-left: 10px;">'+
            '<i class="fa fa-envelope"></i>'+
            '</a>'
        ].join('')
    }
</script>
@endsection
