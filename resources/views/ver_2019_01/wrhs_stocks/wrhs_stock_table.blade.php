<div class="table-responsive">

    <div id="toolbar">
        <?php
        $logged_user = auth()->user();
        if($logged_user->Name === 'Kovács Zoltán'){
        ?>
        <button id="cfg_db" name="" class="btn btn-default">config=>db</button>
        <button id="sess_tbl" name="" class="btn btn-default">session=>table</button>

        <button id="sess_db" name="" class="btn btn-default">session=>db</button>
        <button id="db_tbl" name="" class="btn btn-default">db=>table</button>
        <?php
        }
        ?>
    </div>

    <table id="stocks_table"
           class="table table-striped table-bordered"
           data-toolbar="#toolbar"
           data-buttons-class="primary"
           data-url="{{ url('wrhs_stocks?query_name=' . $query_name) }}"
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
           data-page-list="[10, 25, 50, 100]"></table>
</div>

@section('wrhs_stocks_css')@endsection

@section('wrhs_stocks_js')
{{--
    <script src="https://unpkg.com/tableexport.jquery.plugin/tableExport.min.js" type="text/javascript"></script>

    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/locale/bootstrap-table-hu-HU.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/extensions/export/bootstrap-table-export.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/extensions/cookie/bootstrap-table-cookie.min.js"></script>
--}}
    <script>

        var $table = $('#stocks_table');
        var $local = '{{ app() ->getLocale() }}' + '-' + '{{ strtoupper(app()->getLocale()) }}';
        var $local_short = '{{ app() ->getLocale() }}';
        var $visibleColumns = null;
        var $hiddenColumns = null;

        var $cfg_db = $('#cfg_db');
        var $sess_tbl = $('#sess_tbl');
        var $sess_db = $('#sess_db');
        var $db_tbl = $('#db_tbl');

        $cfg_db.on('click', function()
        {
            $.get('{{ url('cfg_db', 'cp_wrhs_stocks') }}', function(data)
            {
                console.log(data);
            });
        });

        $sess_tbl.on('click', function()
        {
            $.get('{{ url('sess_tbl', 'cp_wrhs_stocks') }}', function(data)
            {
                console.log('Session to Table', data);
            });
        });

        $sess_db.on('click', function()
        {
            $.get('{{ url('sess_db', 'cp_wrhs_stocks') }}', function(data)
            {
                console.log('Session to DB', data);
            });
        });

        $db_tbl.on('click', function()
        {
            $.get('{{ url('db_tbl', 'cp_wrhs_stocks') }}', function(data)
            {
                console.log('DB to Table', data);
            });
        });

        function queryParams(params)
        {
            params.visibleColumns = $visibleColumns;
            params.hiddenColumns = $hiddenColumns;

            //console.log('visibleColumns: ', $visibleColumns);
            //console.log('hiddenColumns: ', $hiddenColumns);
            //console.log('params: ', params);

            return params;
        }

        function initTable(){

            $table
                .bootstrapTable('destroy')
                .bootstrapTable({

                    onLoadSuccess: function (data, status, jqXHR) {},

                    onColumnSwitch: function(field, checked){

                        $visibleColumns = JSON.stringify($table.bootstrapTable('getVisibleColumns')
                            .map(function (it) {
                                return it.field
                            })
                        );

                        $hiddenColumns = JSON.stringify($table.bootstrapTable('getHiddenColumns').map(function (it) {
                            return it.field
                        }));

                        //console.log('Tablename: ' + $.session.get('table_name'));

                        $table.bootstrapTable('refresh');
                    },

                    exportTypes: ['excel'],
                    locale: $local,
                    undefinedText: ' ',

                    columns: {!! $table_columns !!}
                });
        }

        function dateFormatter(data)
        {
            return moment(data).locale($local_short).format('L');
        }

        function decimalFormatter(data)
        {
            return FormatNumber(data);
        }

        function FormatNumber(number, numberOfDigits = 2)
        {
            try {
                //retVal = new Intl.NumberFormat('hu-HU').format(parseFloat(number).toFixed(2));
                return parseFloat(number).toFixed(numberOfDigits);
            } catch (error) {
                console.log(error);
                return 0;
            }
        }

        $(function(){
            initTable();
        });

    </script>
@endsection
