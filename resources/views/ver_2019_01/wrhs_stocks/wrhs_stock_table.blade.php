<div class="table-responsive">

    <div id="wrhs_stocks_table">
        <bootstrap-table class="table table-bordered"
                         :columns="columns"
                         :options="options"></bootstrap-table>
    </div>

</div>

@section('wrhs_stocks_css')@endsection

@section('wrhs_stocks_js')
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>

    <script src="https://unpkg.com/tableexport.jquery.plugin/tableExport.min.js" type="text/javascript"></script>

    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/locale/bootstrap-table-hu-HU.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/extensions/export/bootstrap-table-export.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/extensions/cookie/bootstrap-table-cookie.min.js"></script>

    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table-vue.min.js"></script>

    <script>
        var $locale = '{{ app() ->getLocale() }}' + '-' + '{{ strtoupper(app()->getLocale()) }}';
        $url = '{{ url('wrhs_stocks') }}';

        $(function(){

            new Vue({
                el: '#wrhs_stocks_table',
                components: {
                    'BootstrapTable': BootstrapTable
                },
                data: {
                    columns: [
                        {
                            title:'ID',
                            field: 'ID',
                            sortable: true,
                            switchable: true,
                        },
                        {
                            title:'ClientID',
                            field: 'ClientID',
                            sortable: true,
                            switchable: true,
                        },
                        {
                            title:'Cust_ID',
                            field: 'Cust_ID',
                            sortable: true,
                            switchable: true,
                        },
                        {
                            title:'Stock_Date',
                            field: 'Stock_Date',
                            sortable: true,
                            switchable: true,
                        },
                        {
                            title:'Items_No',
                            field: 'Items_No',
                            sortable: true,
                            switchable: true,
                        },
                        {
                            title:'Items_Description_1',
                            field: 'Items_Description_1',
                            sortable: true,
                            switchable: true,
                        },
                        {
                            title:'Items_Description_2',
                            field: 'Items_Description_2',
                            sortable: true,
                            switchable: true,
                        },
                        {
                            title:'Expire_Date',
                            field: 'Expire_Date',
                            sortable: true,
                            switchable: true,
                        },
                        {
                            title:'Prod_Date',
                            field: 'Prod_Date',
                            sortable: true,
                            switchable: true,
                        },
                        {
                            title:'LOT_1',
                            field: 'LOT_1',
                            sortable: true,
                            switchable: true,
                        },
                        {
                            title:'LOT_2',
                            field: 'LOT_2',
                            sortable: true,
                            switchable: true,
                        },
                        {
                            title:'Warehouse',
                            field: 'Warehouse',
                            sortable: true,
                            switchable: true,
                        },
                        {
                            title:'Location',
                            field: 'Location',
                            sortable: true,
                            switchable: true,
                        },
                        {
                            title:'Status',
                            field: 'Status',
                            sortable: true,
                            switchable: true,
                        },
                        {
                            title:'Price_UnitPrice',
                            field: 'Price_UnitPrice',
                            sortable: true,
                            switchable: true,
                        },
                        {
                            title:'Price_Currency',
                            field: 'Price_Currency',
                            sortable: true,
                            switchable: true,
                        },
                        {
                            title:'Price_Unit',
                            field: 'Price_Unit',
                            sortable: true,
                            switchable: true,
                        },
                        {
                            title:'Weight_Net',
                            field: 'Weight_Net',
                            sortable: true,
                            switchable: true,
                        },
                        {
                            title:'Weight_Gross',
                            field: 'Weight_Gross',
                            sortable: true,
                            switchable: true,
                        },
                        {
                            title:'Stock_Available',
                            field: 'Stock_Available',
                            sortable: true,
                            switchable: true,
                        },
                        {
                            title:'Stock_Reserved',
                            field: 'Stock_Reserved',
                            sortable: true,
                            switchable: true,
                        },
                        {
                            title:'Stock_External_1',
                            field: 'Stock_External_1',
                            sortable: true,
                            switchable: true,
                        },
                        {
                            title:'Stock_External_2',
                            field: 'Stock_External_2',
                            sortable: true,
                            switchable: true,
                        },
                        {
                            title:'Stock_External_3',
                            field: 'Stock_External_3',
                            sortable: true,
                            switchable: true,
                        }
                    ],
                    options: {
                        locale: $locale,
                        buttonClass: 'primary',
                        toggle: 'table',
                        striped: true,
                        search: false,
                        url: $url,
                        showColumns: true,
                        showRefresh: true,
                        showExport: true,
                        exportTypes: ['excel'],

                        pageSize: 10,
                        pagination: true,
                        sidePagination: 'server',
                        pageList: [10, 25, 50, 100],

                        undefinedText: ' '
                    }
                }
            });

        });

    </script>
@endsection
