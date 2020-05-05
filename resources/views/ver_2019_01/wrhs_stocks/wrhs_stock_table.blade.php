<div class="table-responsive">
    <table id="stocks_table"
           class="table table-striped table-bordered"
           data-toolbar="#toolbar"
           data-buttons-class="primary"
           data-url="{{ url('wrhs_stocks') }}"
           data-toggle="table"

           data-query-params="queryParams"

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
        {{--<tr>
            <th data-field="ID">ID</th>
            <th data-field="ClientID">ClientID</th>
            <th data-field="Cust_ID">Cust_ID</th>
            <th data-field="Stock_Date">Stock_Date</th>
            <th data-field="Items_No">Items_No</th>
            <th data-field="Items_Description_1">Items_Description_1</th>
            <th data-field="Items_Description_2">Items_Description_2</th>
            <th data-field="Expire_Date">Expire_Date</th>
            <th data-field="Prod_Date">Prod_Date</th>
            <th data-field="LOT_1">LOT_1</th>
            <th data-field="LOT_2">LOT_2</th>
            <th data-field="Location">Location</th>
            <th data-field="Status">Status</th>
            <th data-field="Price_UnitPrice">Price_UnitPrice</th>
            <th data-field="Price_Currency">Price_Currency</th>
            <th data-field="Price_Unit">Price_Unit</th>
            <th data-field="Weight_Net">Weight_Net</th>
            <th data-field="Weight_Gross">Weight_Gross</th>
            <th data-field="Stock_Available">Stock_Available</th>
            <th data-field="Stock_Reserved">Stock_Reserved</th>
            <th data-field="Stock_External_1">Stock_External_1</th>
            <th data-field="Stock_External_2">Stock_External_2</th>
            <th data-field="Stock_External_3">Stock_External_3</th>
        </tr>--}}
        </thead>
    </table>
</div>

@section('wrhs_stocks_css')@endsection

@section('wrhs_stocks_js')
<!--
    <script src="https://unpkg.com/tableexport.jquery.plugin/tableExport.min.js" type="text/javascript"></script>

    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/locale/bootstrap-table-hu-HU.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/extensions/export/bootstrap-table-export.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/extensions/cookie/bootstrap-table-cookie.min.js"></script>
-->
    <script>

        var $table = $('#stocks_table');
        var $local = '{{ app() ->getLocale() }}' + '-' + '{{ strtoupper(app()->getLocale()) }}';
        var $local_short = '{{ app() ->getLocale() }}';
        var $visibleColumns = null;
        var $hiddenColumns = null;

        var $columns = [
            {title: 'ID_1',field: 'ID'},
            {title:'ClientID',field:'ClientID'},
            {title:'Cust_ID',field:'Cust_ID'},
            {title:'Stock_Date',field:'Stock_Date'},
            {title:'Items_No',field:'Items_No'},

            {title:'Items_Description_1',field:'Items_Description_1'},
            {title:'Items_Description_2',field:'Items_Description_2'},
            {title:'Expire_Date',field:'Expire_Date'},
            {title:'Prod_Date',field:'Prod_Date'},
            {title:'LOT_1',field:'LOT_1'},

            {title:'LOT_2',field:'LOT_2'},
            {title:'Location',field:'Location'},
            {title:'Status',field:'Status'},
            {title:'Price_UnitPrice',field:'Price_UnitPrice'},
            {title:'Price_Currency',field:'Price_Currency'},

            {title:'Weight_Net',field:'Weight_Net'},
            {title:'Weight_Gross',field:'Weight_Gross'},
            {title:'Stock_Available',field:'Stock_Available'},
            {title:'Stock_Reserved',field:'Stock_Reserved'},
            {title:'Stock_External_1',field:'Stock_External_1'},

            {title:'Stock_External_2',field:'Stock_External_2'},
            {title:'Stock_External_3',field:'Stock_External_3'}
        ];

        function queryParams(params)
        {
/*
            $visibleColumns = JSON.stringify($table.bootstrapTable('getVisibleColumns').map(function (it) {
                return it.field
            }));

            $hiddenColumns = JSON.stringify($table.bootstrapTable('getHiddenColumns').map(function (it) {
                return it.field
            }));
*/
            params.visibleColumns = $visibleColumns;
            params.hiddenColumns = $hiddenColumns;

            //console.log('visibleColumns: ', $visibleColumns);
            //console.log('hiddenColumns: ', $hiddenColumns);
            //console.log('params: ', params);

            return params;
        }

        function initTable(){
            console.log({!! $table_columns !!});
            $table
                .bootstrapTable('destroy')
                .bootstrapTable({

                    onLoadSuccess: function (data, status, jqXHR) {

                        /*
                        $visibleColumns = JSON.stringify($table.bootstrapTable('getVisibleColumns').map(function (it) {
                            return it.field
                        }));

                        $hiddenColumns = JSON.stringify($table.bootstrapTable('getHiddenColumns').map(function (it) {
                            return it.field
                        }));

                        console.log('visibleColumns: ', $visibleColumns);
                        console.log('hiddenColumns: ', $hiddenColumns);
                        */
                    },

                    onColumnSwitch: function(field, checked){

                        $visibleColumns = JSON.stringify($table.bootstrapTable('getVisibleColumns').map(function (it) {
                            return it.field
                        }));

                        $hiddenColumns = JSON.stringify($table.bootstrapTable('getHiddenColumns').map(function (it) {
                            return it.field
                        }));

                        //console.log($visibleColumns);

                        $table.bootstrapTable('refresh')
                    },

                    exportTypes: ['excel'],
                    locale: $local,
                    undefinedText: ' ',

                    columns: {!! $table_columns !!}
/*
                    columns:
                        [
                            {title: 'ID_1',field: 'ID'},
                            {title:'ClientID',field:'ClientID'},
                            {title:'Cust_ID',field:'Cust_ID'},
                            {title:'Stock_Date',field:'Stock_Date'},
                            {title:'Items_No',field:'Items_No'},

                            {title:'Items_Description_1',field:'Items_Description_1'},
                            {title:'Items_Description_2',field:'Items_Description_2'},
                            {title:'Expire_Date',field:'Expire_Date'},
                            {title:'Prod_Date',field:'Prod_Date'},
                            {title:'LOT_1',field:'LOT_1'},

                            {title:'LOT_2',field:'LOT_2'},
                            {title:'Location',field:'Location'},
                            {title:'Status',field:'Status'},
                            {title:'Price_UnitPrice',field:'Price_UnitPrice'},
                            {title:'Price_Currency',field:'Price_Currency'},

                            {title:'Weight_Net',field:'Weight_Net'},
                            {title:'Weight_Gross',field:'Weight_Gross'},
                            {title:'Stock_Available',field:'Stock_Available'},
                            {title:'Stock_Reserved',field:'Stock_Reserved'},
                            {title:'Stock_External_1',field:'Stock_External_1'},

                            {title:'Stock_External_2',field:'Stock_External_2'},
                            {title:'Stock_External_3',field:'Stock_External_3'}
                        ]
*/
                });
        }



        $(function(){
            initTable();
        });

    </script>
@endsection
