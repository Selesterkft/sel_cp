@includeIf('layouts.toolbars.search_toolbar', ['url' => url('users')])

<div class="table-responsive mailbox-messages">

    {{--<div id="toolbar" class="select">
        <select class="form-control">
            <option value="all">{{ trans('app.export_all') }}</option>
            <option value="selected">{{ trans('app.export_selected') }}</option>
        </select>
    </div>--}}

    <table id="user_table" name="user_table"
           class="table table-bordered"

           data-url="{{ url('users') }}"
           data-buttons-class="primary"
           data-toggle="table"
           data-toolbar="#toolbar"

           data-cookie="true"
           data-cookie-id-table="saveId"

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
            <th></th>
            <th data-field="Name">{{ trans('app.name') }}</th>
            <th data-field="Email">{{ trans('app.email') }}</th>
            <th data-field="language">{{ trans('app.language') }}</th>
        </tr>
        </thead>
    </table>
</div>

@section('users_css')
@endsection

@section('users_script')

    <script>
        var $users_table = $('#user_table');
        var $local = '{{ app() ->getLocale() }}' + '-' + '{{ strtoupper(app()->getLocale()) }}';

        function operateFormatter(value, row, index)
        {
            $url = '{{ url('users.edit') }}' + '/' + row.ID;
            return [
                '<a href="' + $url + '" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i></a>'
            ].join();
        }

        function initTable()
        {
            $users_table
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

    </script>

@endsection
