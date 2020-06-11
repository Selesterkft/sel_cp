@extends(session()->get('design') . ".layouts.app")

@section('title', trans('users.title'))

@section('content-header')
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
@endsection
@section('content')
    <section class="content">
        <div class="row">

            <div class="col-sm-12">
                @if( session()->has('success') )
                    @includeIf('layouts.success', ['messages' => session()->get('success') ])
                @elseif( session()->has('errors') )
                    @includeIf('layouts.alert', ['messages' => session()->get('errors')] )
                @endif

                <div class="box box-default">

                    <div class="box-body">
                        {{-- TÁBLÁZAT --}}
                        @includeIf(session()->get('version') . '.users.users_table')

                        {{-- SEARCH MODAL --}}
                        @includeIf('modals.modal_search', [
                            'fields' => session()->get('version') . '.users.fields_search',
                            'title' => trans('app.search_title'),
                            'url' => 'users',
                        ])

                    </div>

                </div>

            </div>

        </div>
    </section>
@endsection

@section('css')

    <link href="{{ asset('assets/bower_components/bootstrap-table/1.15.5/dist/bootstrap-table.css') }}" rel="stylesheet"/>

    @yield('users_css')
@endsection

@section('js')

    {{-- Bootstrap Table --}}
    <script src="{{ asset('assets/bower_components/bootstrap-table/1.15.5/dist/tableExport.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/bower_components/bootstrap-table/1.15.5/dist/bootstrap-table.min.js') }}"></script>
    <script src="{{ asset('assets/bower_components/bootstrap-table/1.15.5/dist/locale/bootstrap-table-hu-HU.js') }}"></script>
    <script src="{{ asset('assets/bower_components/bootstrap-table/1.15.5/dist/extensions/export/bootstrap-table-export.js') }}"></script>

    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/extensions/cookie/bootstrap-table-cookie.js"></script>

    @yield('users_script')

@endsection
