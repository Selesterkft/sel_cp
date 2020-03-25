@extends(session()->get('design').".layouts.app")

@section('title', trans('users.title'))

@section('content')

    <section class="content-header">
        <h1>
            {{ trans('users.title') }}
            <small>{{ trans('users.sub_title') }}</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('/') }}">
                    <i class="fa fa-dashboard"></i>&nbsp;
                    {{ trans('app.dashboard') }}
                </a>
            </li>

            <li class="active">
                <i class="fa fa-users"></i>&nbsp;{{ trans('users.title') }}
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

                <div class="box box-default">

                    <div class="box-header with-border">
                        <h3 class="box-title">
                            {{ trans('users.title') }}
                        </h3>

                        <div class="box-tools pull-right">
                            <a class="btn btn-success btn-xs"
                               style="margin-top: 5px;"
                               href="{{ url('users.create') }}">&nbsp;
                                {{ trans('app.add_new') }}
                            </a>
                        </div>

                    </div>

                    <div class="box-body">

                        <div class="table-responsive mailbox-messages">

                            <div id="toolbar" class="select">
                                <select class="form-control">
                                    <option value="all">{{ trans('app.export_all') }}</option>
                                    <option value="selected">{{ trans('app.export_selected') }}</option>
                                </select>
                            </div>

                            <table id="usersTable" name="usersTable"
                                   class="table table-bordered table-striped"
                                   data-id-field="ID"
                                   data-buttons-class="success"
                                   data-toggle="table"
                                   data-filter-control="true"

                                   data-toolbar="#toolbar"
                                   data-show-export="true"
                                   data-show-search-clear-button="true"
                                   data-show-columns="true"
                                   data-virtual-scroll="true"
                                   data-pagination="true"
                                   data-page-size="10"
                                   data-page-list="[10, 25, 50, 100]"

                                   {{--
                                   data-search="false"
                                   data-show-search-button="false"
                                   data-search-on-enter-key="false"

                                   data-side-pagination="server"

                                   data-show-refresh="false"
                                   data-show-toggle="false"
                                   data-show-fullscreen="false"

                                   data-show-pagination-switch="false"
                                   data-show-columns-toggle-all="true"

                                   data-minimum-count-columns="2"
                                   data-striped="true"

--}}
                                   data-show-footer="true">
                                <thead>
                                <tr>
                                    <th data-field="state" data-checkbox="true"></th>
                                    {{--<th data-field="ID" data-sortable="true">{{ __('global.app_fields.id') }}</th>--}}
                                    <th data-field="Name" data-sortable="true"
                                        data-filter-control="input">
                                        {{ trans('app.name') }}
                                    </th>
                                    <th data-field="Email" data-sortable="true" data-filter-control="input">
                                        {{ trans('app.email') }}
                                    </th>
                                    <th data-field="language" data-sortable="true" data-filter-control="select">
                                        {{ trans('app.language') }}
                                    </th>
<!--
                                    <th data-field="CompanyName" data-valign="top">
                                        {{-- __('global.user.fields.company') --}}
                                    </th>
-->
                                    <th data-field="" data-sortable="true"
                                        data-filter-control="input">
                                        {{ trans('roles.title') }}
                                    </th>
                                    <th data-valign="top" data-switchable="false">
                                        {{ trans('app.operations') }}
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td></td>
                                        {{--<td>{{ $user->ID }}</td>--}}
                                        <td>{{ $user->Name }}</td>

                                        <td>
                                            <a href="mailto:{{ $user->Email }}?subject=Visszajelzés&body=Kérjük, lépjen be az oldalra jelszó módosítás céljából."
                                               title="Mail to: {{ $user->Email }}">
                                                {{ $user->Email }}
                                            </a>
                                        </td>

                                        <td>{{ $user->language }}</td>

                                        {{--<td>
                                            @if($user->Supervisor_ID == 0)
                                                {{ $user->CompanyName }}
                                            @else
                                                {{ $user->Supervisor_Name }}
                                            @endif
                                        </td>--}}

                                        <td>
                                            <?php
                                            if( !empty($user->getRoleNames()) )
                                            {
                                                foreach( $user->getRoleNames() as $roleName )
                                                    {
                                                        $label = 'label-warning';
                                                        if($roleName == 'Admin')
                                                        {
                                                            $label = 'label-primary';
                                                        }
                                                        elseif($roleName == 'Super User')
                                                        {
                                                            $label = 'label-info';
                                                        }
                                                        ?>
                                                        <div class="label {{ $label }}" style="margin-left: 2px;">
                                                            {{-- $roleName --}}
                                                            {{ trans('roles.' . $roleName) }}
                                                        </div>
                                                        <?php
                                                    }
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            @if(Auth::user()->hasRole('Admin'))
                                            <a href="{{ url('users.show', ['id' => $user->ID]) }}"
                                               class="btn btn-info btn-xs" tooltip="sdsdf">
                                                <i class="fa fa-eye"></i>
                                            </a>

                                            <a href="{{ url('users.edit', ['id' => $user->ID]) }}"
                                               class="btn btn-success btn-xs" style="margin-left: 10px;">
                                                <i class="fa fa-pencil"></i>
                                            </a>

                                            @if($user->deleted_at)
                                                <form action="{{ url('users.restore', ['id' => $user->ID]) }}"
                                                      method="POST"
                                                      style="display:inline;">
                                                    @csrf
                                                    <button type="submit"
                                                            class="btn btn-info btn-xs"
                                                            style="margin-left: 10px;">
                                                        <i class="fa fa-recycle"></i>
                                                    </button>
                                                </form>
                                            @else
                                                @if( Auth::user()->ID != $user->ID )
                                                    <form method="POST"
                                                          action="{{ url('users.destroy', [
                                                                'id' => $user->ID
                                                            ]) }}"
                                                          style="display:inline;">
                                                        <input type="hidden" name="_method" value="DELETE"/>
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-xs"
                                                                style="margin-left: 10px;">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            @endif
                                            @else
                                            @if( Auth::user()->ID == $user->ID )

                                            <a href="{{ url('users.show', ['id' => $user->ID]) }}"
                                               class="btn btn-info btn-xs" tooltip="sdsdf">
                                                <i class="fa fa-eye"></i>
                                            </a>

                                            <a href="{{ url('users.edit', ['id' => $user->ID]) }}"
                                               class="btn btn-success btn-xs" style="margin-left: 10px;">
                                                <i class="fa fa-pencil"></i>
                                            </a>

                                            @if($user->deleted_at)
                                                <form action="{{ url('users.restore', ['id' => $user->ID]) }}"
                                                      method="POST"
                                                      style="display:inline;">
                                                    @csrf
                                                    <button type="submit"
                                                            class="btn btn-info btn-xs"
                                                            style="margin-left: 10px;">
                                                        <i class="fa fa-recycle"></i>
                                                    </button>
                                                </form>
                                            @else
                                                @if( Auth::user()->ID != $user->ID )
                                                    <form method="POST"
                                                          action="{{ url('users.destroy', [
                                                                'id' => $user->ID
                                                            ]) }}"
                                                          style="display:inline;">
                                                        <input type="hidden" name="_method" value="DELETE"/>
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-xs"
                                                                style="margin-left: 10px;">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            @endif

                                            @endif
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </section>

@endsection

@section('css')
@php
echo "<!-- BACGROUND COLOR -->\n";
echo "<style>.skin-blue .main-sidebar, .skin-blue .left-side {background-color: " . \App\Classes\Helper::getMenuBgColor('users') . ";}</style>\n";
echo "<!-- HEADER BG COLOR -->\n";
$header_bg_color = \App\Classes\Helper::getHeaderBgColor("users");
echo "<style>.skin-blue .main-header .navbar {background-color: " . $header_bg_color . ";}</style>\n";
echo "<style>.skin-blue .main-header .logo {background-color: " . $header_bg_color . ";}</style>\n";

echo "<!-- PANEL AND TAB COLOR -->\n";
echo "<style>.box.box-default {border-top-color: " . \App\Classes\Helper::getPanelTabLineColor('users') . ";}</style>\n";
@endphp
{{-- BOOTSTRAP TABLE --}}
<link href="{{ asset('assets/bower_components/bootstrap-table/1.15.4/dist/bootstrap-table.css') }}" rel="stylesheet"/>
<link href="https://unpkg.com/bootstrap-table@1.15.5/dist/extensions/filter-control/bootstrap-table-filter-control.css" rel="stylesheet"/>
@endsection

@section('js')
    {{-- Bootstrap Table --}}
    <script src="{{ asset('assets/bower_components/bootstrap-table/tableExport.min.js') }}" type="text/javascript"></script>
    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/locale/bootstrap-table-hu-HU.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/extensions/export/bootstrap-table-export.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/extensions/filter-control/bootstrap-table-filter-control.min.js"></script>

    <script src="{{ asset('assets/bower_components/moment/moment.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/bower_components/moment/locale/hu.js') }}" type="text/javascript"></script>

    <script>
        let $table = $('#usersTable');
        let $selection = [];

        $(function()
        {
            $('#toolbar').find('select').change(function ()
            {
                $table.bootstrapTable('destroy').bootstrapTable({
                    exportDataType: $(this).val(),
                    exportTypes: ['csv', 'txt', 'excel', 'pdf'],
                    locale: '{{ app()->getLocale() . '-' . strtoupper(app()->getLocale()) }}',
                    columns: [
                    {
                        field: 'state',
                        checkbox: true,
                        visible: $(this).val() === 'selected'
                    }
        ]
      })
    }).trigger('change');
  })

    </script>
@endsection
