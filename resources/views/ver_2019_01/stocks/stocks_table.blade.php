<div class="table-responsive">

    <div id="stocks_table">
        <bootstrap-table class="table table-bordered"
                         :columns="columns"
                         :options="options"></bootstrap-table>
    </div>

</div>
{{--<table id="stocks_table" name="stocks_table" class="table table-bordered"
       data-url="{{ url('stocks') }}"
       data-toggle="table"
       data-buttons-class="primary"
       data-cookie="true"
       data-cookie-id-table="stocks_table"
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
        --}}{{--<th data-switchable="false"></th>--}}{{--
        <th data-field="ProductName">{{ trans('app.descr') }}</th>
        <th data-field="Quantity">{{ trans('app.pcs') }}</th>
        <th data-field="Unit">{{ trans('app.unit') }}</th>
        <th data-field="UnitPrice">{{ trans('app.unit_price_dc') }}</th>
        <th data-field="Value">{{ trans('ertek') }}</th>
    </tr>
    </thead>

</table>--}}

@section('stocks_css')@endsection

@section('stocks_js')

    <script src="https://cdn.jsdelivr.net/npm/vue"></script>

    <script src="https://unpkg.com/tableexport.jquery.plugin/tableExport.min.js" type="text/javascript"></script>

    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/locale/bootstrap-table-hu-HU.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/extensions/export/bootstrap-table-export.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/extensions/cookie/bootstrap-table-cookie.min.js"></script>

    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table-vue.min.js"></script>

    <script>

        var $locale = '{{ app() ->getLocale() }}' + '-' + '{{ strtoupper(app()->getLocale()) }}';
        $url = '{{ url('stocks1') }}';

        $(function(){

            new Vue({
                el: '#stocks_table',
                components: {
                    'BootstrapTable': BootstrapTable
                },
                data: {
                    columns: [
                        {
                            title: '{{ trans('app.descr') }}',
                            field: 'ProductName',
                            sortable: false,
                            switchable: true,
                            events: {
                                'column-switch': (field, checked) => {
                                    console.log('field:', field);
                                }
                            }
                        },
                        {
                            title: '{{ trans('app.pcs') }}',
                            field: 'Quantity',
                            sortable: true,
                            switchable: true
                        },
                        {
                            title: '{{ trans('app.unit') }}',
                            field: 'Unit',
                            sortable: true,
                            switchable: true
                        },
                        {
                            title: '{{ trans('app.unit_price_dc') }}',
                            field: 'UnitPrice',
                            sortable: true,
                            switchable: true
                        },
                        {
                            title: '{{ trans("ertek") }}',
                            field: 'Value',
                            sortable: true,
                            switchable: true
                        }

                    ],
                    options: {
                        locale: $locale,
                        buttonClass: 'primary',
                        toggle: 'table',
                        striped: true,
                        search: false,
                        url: $url,
                        showColumns: false,
                        showRefresh: false,
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
/*
        var $table = $('#stocks_table');
        var $local = '{{-- app()->getLocale() }}' + '-' + '{{ strtoupper(app()->getLocale()) --}}';
        var $local_short = '{{-- app()->getLocale() --}}';
*/
        function initTable(){



            /*
            $table.bootstrapTable('destroy')
                .bootstrapTable({
                    exportTypes: ['excel'],
                    locale: $local,
                    undefinedText: '',
                    columns: [{
                        field: 'operate',
                        title: '',
                        align: 'center',
                        clickToSelect: false,
                        sortable: false,
                        formatter: operateFormatter
                    }]
                });
            */
        }

        $(function(){

            //initTable();
        });

        function operateFormatter(value, row, index){

            return null;
        }

    </script>
@endsection
