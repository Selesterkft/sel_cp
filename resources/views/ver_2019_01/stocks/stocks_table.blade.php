    {{-- @includeIf('layouts.toolbars.toolbar_' . $table_name) --}}

    <table id="stocks_table"
           class="table table-striped table-bordered"
           data-toolbar="#toolbar"
           data-buttons-class="primary"
           data-url="{{ $url }}"
           data-toggle="table"

           data-query-params="queryParams"

           data-show-refresh="true"
           data-show-columns="true"
           data-show-export="true"
           data-striped="true"

           data-minimum-count-columns="2"
           data-side-pagination="server"
           data-pagination="true"
           data-page-size="{{ $paginate_number }}"
           data-page-list="[10, 25, 50, 100]"
           data-height="460"></table>

@section('stocks_js')

    <script>
        'use strict'

        var $stocks_table   = $('#stocks_table');
        var $locale         = '{{ $locale }}';
        var startDate       = moment()
                                .subtract({{ config('appConfig.date_filters.stocks_movement_look_back') }}, 'days')
                                .format('YYYY-MM-DD');
        var endDate         = moment()
                                .format('YYYY-MM-DD');
        var dateCell       = 'booking_date';

        function queryParams(params) {

            params.visibleColumns   = visibleColumns;
            params.hiddenColumns    = hiddenColumns;
            params.startDate        = startDate;
            params.endDate          = endDate;
            params.dateCell         = dateCell;

            return params;
        }

        $('#filter').on('click', function(ev){

            $stocks_table.bootstrapTable('refresh');

        });

        function initTable(){
            $stocks_table
                .bootstrapTable('destroy')
                .bootstrapTable({
                    onColumnSwitch: function (field, checked){
                        visibleColumns = JSON.stringify($stocks_table
                            .bootstrapTable('getVisibleColumns')
                            .map(function(it){
                                return it.field;
                            })
                        );
                        hiddenColumns = JSON.stringify($stocks_table
                            .bootstrapTable('getHiddenColumns')
                            .map(function(it){
                                return it.field;
                            })
                        );

                        $stocks_table.bootstrapTable('refresh');
                    },
                    exportTypes: ['excel'],
                    locale: $locale,
                    undefinedText: ' ',

                    columns: {!! $table_columns !!}
                });
        }

        function initdatetimePicker (){

            $('#startDate').val(startDate);
            $('#endDate').val(endDate);

            $('#datetimepicker2').datetimepicker({
                autoclose: true,
                language: '{{ $locale }}',
                format: 'yyyy-mm-dd hh:ii',
                startDate: startDate,
                endDate: endDate
            })
            .on('changeDate', function(ev){
                startDate = moment(ev.date).format('YYYY-MM-DD HH:mm:ss');
                $('#datetimepicker3').datetimepicker('setStartDate', startDate);
            });

            $('#datetimepicker3').datetimepicker({
                autoclose: true,
                language: '{{ $locale }}',
                format: 'yyyy-mm-dd hh:ii',
                startDate: startDate
                , endDate: endDate
            })
            .on('changeDate', function(ev){
                endDate = moment(ev.date).format('YYYY-MM-DD HH:mm:ss');
                $('#datetimepicker2').datetimepicker('setEndDate', endDate);
            });
        }

        function EventHandlers(){

            $('#date_cell').on('change', function(ev){
                dateCell = $(this).val();
            });
        }

        $(function(){

            initTable();

            initdatetimePicker();

            EventHandlers();
        });

    </script>
@endsection

</div>
