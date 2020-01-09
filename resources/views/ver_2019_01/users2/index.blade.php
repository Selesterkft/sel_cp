@extends('layouts.app')
@section('title', Lang::get('global.users.title'))

@section('content')

    <section class="content-header">
        <h1>
            {{ __('global.users.title') }}
            <small>{{ __('global.users.sub_title') }}</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('/') }}">
                    <i class="fa fa-dashboard"></i>&nbsp;
                    {{ __('global.app_dashboard') }}
                </a>
            </li>

            <li class="active">
                <i class="fa fa-users"></i>&nbsp;{{ __('global.users.title') }}
            </li>

        </ol>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-md-12">
                @if( session()->has('success') )

                    @includeIf('layouts.success', ['messages' => session()->get('success') ])

                @elseif( session()->has('errors') )

                    @includeIf('layouts.alert', ['messages' => session()->get('errors')] )

                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">

                    <div class="box-header with-border">
                        <h3 class="box-title">
                            {{ __('global.users.title') }}
                        </h3>

                        <div class="box-tools pull-right">
                            <a class="btn btn-success btn-xs"
                               style="margin-top: 5px;"
                               href="{{ url('users.create') }}">&nbsp;
                                {{ __('global.app_add_new') }}
                            </a>
                        </div>

                    </div>

                    <div class="box-body">
                        <div class="table-responsive mailbox-messages">
                            <table id="usersTable" name="usersTable" class="table table-striped"
                                   data-id-field="ID"
                                   data-url="{{ url('users2')  }}"
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

                                   data-minimum-count-columns="2"
                                   data-striped="true"

                                   data-pagination="true"
                                   data-page-size="10"
                                   data-page-list="[10, 25, 50, 100]"

                                   data-show-footer="true">
                                <thead>
                                <tr>
                                    <th data-field="state" data-checkbox="true"></th>
                                    {{--<th data-field="ID" data-sortable="true">{{ __('global.app_fields.id') }}</th>--}}
                                    <th data-field="Name" data-sortable="true">{{ __('global.app_name') }}</th>
                                    <th data-field="Email" data-sortable="true">{{ __('global.user.fields.email') }}</th>
                                    <th data-field="language" data-sortable="true">{{ __('global.user.fields.language') }}</th>
                                    <th data-field="CompanyName"
                                        data-sortable="true">{{ __('global.user.fields.company') }}</th>
                                    <th data-sortable="true">{{ __('SUB_COMPANY') }}</th>
                                    <th data-field="" data-sortable="true">{{ __('global.user.fields.roles') }}</th>
                                    <th>{{ __('global.app_fields.operations') }}</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>

                    <div class="box-body"></div>

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
        let $table = $('#usersTable');
        let $selection = [];

        function companyFormatter(data, row)
        {
            return row.CompanyName;
        }

    </script>
@endsection