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
       data-page-list="[10, 25, 50, 100]">
    <thead>
    <tr>
        <th data-switchable="false" data-rowspan="2"></th>
        <th data-field="Inv_Num" data-rowspan="2">{{ trans('inv.inv_num') }}</th>
        <th data-field="Inv_SeqNum" data-rowspan="2" data-align="right">{{ trans('inv.inv_seqnum') }}</th>
        <th data-field="Partner_Name" data-rowspan="2">{{ trans('app.partner_name') }}</th>
        <th data-field="InvType" data-rowspan="2">{{ trans('app.type_of_invoice') }}</th>
        <th data-field="PaymentMethod" data-rowspan="2">{{ trans('app.payment_method') }}</th>

        <th data-field="PayStatus" data-rowspan="2">{{ trans('app.pay_status') }}</th>
        {{-- Bank & Tax --}}
        <th data-colspan="4">{{ trans('inv.bank_and_tax_num') }}</th>
        {{-- LC --}}
        <th data-colspan="5">{{ trans('app.lc') }}</th>
        {{-- DC --}}
        <th data-colspan="5">{{ trans('app.dc') }}</th>
        {{-- FC --}}
        <th data-colspan="5">{{ trans('app.fc') }}</th>
        {{-- Dátumok --}}
        <th data-colspan="5">{{ trans('app.dates') }}</th>
        {{-- Sub Service --}}
        <th data-field="Subcontracted_Services" data-rowspan="2">{{ trans('inv.subcontracted_services') }}</th>
        {{-- Pertner Address --}}
        <th data-colspan="15">{{ trans('app.partner_address') }}</th>
        {{-- Period --}}
        <th data-colspan="4">{{ trans('inv.ACCT_Period') }}</th>
        {{-- Cancellation --}}
        <th data-field="Cancellation_ReasonCode" data-rowspan="2">{{ trans('inv.cancellation_reasoncode')}}</th>
        {{-- Ref Inv --}}
        <th data-field="Ref_Inv" data-rowspan="2">{{ trans('inv.ref_inv') }}</th>
        {{-- Remarks --}}
        <th data-field="Remarks" data-rowspan="2">{{ trans('app.remarks') }}</th>
        {{-- Attachment --}}
        <th data-field="Attachments" data-rowspan="2">{{ trans('app.attachments') }}</th>
        {{-- Added user --}}
        <th data-field="Added_User_Name" data-rowspan="2">{{ trans('inv.added_user_name') }}</th>

    </tr>
    <tr>
        {{-- Bank & Tax --}}
        <th data-field="Partner_Bank_Account">{{ trans('inv.partner_bank_account') }}</th>
        <th data-field="Partner_Tax_Num">{{ trans('inv.partner_tax_num') }}</th>
        <th data-field="Partner_Tax_Num2">{{ trans('inv.partner_tax_num2') }}</th>
        <th data-field="Partner_IBAN">{{ trans('inv.partner_iban') }}</th>
        {{-- LC --}}
        <th data-field="Curr_LC">{{ trans('app.curr') }}</th>
        <th data-field="Net_LC" data-align="right">{{ trans('app.net') }}</th>
        <th data-field="Tax_LC" data-align="right">{{ trans('app.tax') }}</th>
        <th data-field="Gross_LC" data-align="right">{{ trans('app.gross') }}</th>
        <th data-field="PaidAmount_LC" data-align="right">{{ trans('app.paid_amount') }}</th>
        {{-- DC --}}
        <th data-field="Curr_DC">{{ trans('app.curr') }}</th>
        <th data-field="Net_DC" data-align="right">{{ trans('app.net') }}</th>
        <th data-field="Tax_DC" data-align="right">{{ trans('app.tax') }}</th>
        <th data-field="Gross_DC" data-align="right">{{ trans('app.gross') }}</th>
        <th data-field="PaidAmount_DC" data-align="right">{{ trans('app.paid_amount') }}</th>
        {{-- FC --}}
        <th data-field="Curr_FC">{{ trans('app.curr') }}</th>
        <th data-field="Net_FC" data-align="right">{{ trans('app.net') }}</th>
        <th data-field="Tax_FC" data-align="right">{{ trans('app.tax') }}</th>
        <th data-field="Gross_FC" data-align="right">{{ trans('app.gross') }}</th>
        <th data-field="PaidAmount_FC" data-align="right">{{ trans('app.paid_amount') }}</th>
        {{-- Dátumok --}}
        {{-- Kelte --}}
        <th data-field="InvDate">{{ trans('inv.inv_date') }}</th>
        {{-- Beérkezés --}}
        <th data-field="PostInDate">{{ trans('inv.post_in_date') }}</th>
        <th data-field="DeliveryDate">{{ trans('inv.delivery_date') }}</th>
        <th data-field="DueDate">{{ trans('inv.due_date') }}</th>
        <th data-field="Fully_paid_date">{{ trans('inv.fully_paid_date') }}</th>
        {{-- Sub Service --}}
        {{-- Perner Address --}}
        <th data-field="Partner_Full_Address">{{ trans('inv.partner_full_address') }}</th>
        <th data-field="Partner_Country_State_ZIP_City">{{ trans('inv.partner_country_state_zip_city') }}</th>
        <th data-field="Partner_Country">{{ trans('inv.partner_country') }}</th>
        <th data-field="Partner_State">{{ trans('inv.partner_state') }}</th>
        <th data-field="Partner_ZIP">{{ trans('inv.partner_zip') }}</th>
        <th data-field="Partner_City">{{ trans('inv.partner_city') }}</th>
        <th data-field="Partner_Addr_District">{{ trans('inv.partner_addr_district') }}</th>
        <th data-field="Partner_Addr">{{ trans('inv.partner_addr') }}</th>
        <th data-field="Partner_Addr_ps_type">{{ trans('inv.partner_addr_ps_type') }}</th>
        <th data-field="Partner_District_PsType_HouseNr">{{ trans('inv.partner_district_pstype_housenr') }}</th>
        <th data-field="Partner_Addr_housenr">{{ trans('inv.partner_addr_housenr') }}</th>
        <th data-field="Partner_Addr_building">{{ trans('inv.partner_addr_building') }}</th>
        <th data-field="Partner_Addr_stairway">{{ trans('inv.partner_addr_stairway') }}</th>
        <th data-field="Partner_Addr_floor">{{ trans('inv.partner_addr_floor') }}</th>
        <th data-field="Partner_Addr_door">{{ trans('inv.partner_addr_door') }}</th>
        {{-- Period --}}
        <th data-field="ACCT_Period">{{ trans('inv.ACCT_Period') }}</th>
        <th data-field="Period_From_To">{{ trans('inv.period_to_from') }}</th>
        <th data-field="Period_FROM">{{ trans('inv.period_from') }}</th>
        <th data-field="Period_TO">{{ trans('inv.period_to') }}</th>
        {{----}}
    </tr>
    </thead>
</table>

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
        $searchModal.on('show.bs.modal', function(event)
        {
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

        function initTable()
        {
            $table
                .bootstrapTable('destroy')
                .bootstrapTable({
                    exportTypes: ['excel'],
                    locale: $local,
                    undefinedText: ' ',
                    columns: [{
                        field: 'operate',
                        title: '{{ trans('app.operations') }}',
                        align: 'center',
                        clickToSelect: false,
                        sortable: false,
                        formatter: operateFormatter
                    }]
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
            $url = '{{ url('invoices.show') }}' + '/' + row.SELEXPED_INV_ID;

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
