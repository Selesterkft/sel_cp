@extends(session()->get('design') . '.layouts.app')

@section('title', trans('inv.title'))

@section('content-header')
    <section class='content-header'>
        <h1>
            {{ trans('inv.title') }}
            <small>{{ trans('inv.sub_title') }}</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('/') }}">
                    <i class="fa fa-dashboard"></i>&nbsp;
                    {{ trans('app.dashboard') }}
                </a>
            </li>

            <li class="active">
                <i class="fa fa-files-o"></i>&nbsp;
                {{ trans('inv.title') }}
            </li>

        </ol>

    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row">

            <div class="box box-default">
                <div class="box-body">
                    <div class="table-responsive">

                    {{-- TÁBLÁZAT --}}
                    @includeIf(session()->get('version') . '.invoices.inv_table')

                    <!-- SEARCH MODAL -->
                        @includeIf('modals.modal_search', [
                            'fields' => session()->get('version') . '.invoices.fields_search',
                            'title' => trans('app.search_title'),
                            'url' => 'invoices',
                        ])

                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@section('css')
    {{-- Bootstrap Table --}}
    <link href="{{ asset('assets/bower_components/bootstrap-table/1.15.5/bootstrap-table.css') }}" rel="stylesheet"/>

    {{-- Daterange Picker --}}
    <link href="{{ asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">

    {{--@php
        echo "<!-- MENU BACGROUND COLOR -->\n";
        echo "<style>.skin-blue .main-sidebar, .skin-blue .left-side {background-color: " . \App\Classes\ColorHelper::getMenuBgColor('invoices') . ";}</style>\n";

        echo "<!-- HEADER BG COLOR -->\n";
        $header_bg_color = \App\Classes\ColorHelper::getHeaderBgColor('invoices');
        echo "<style>.skin-blue .main-header .navbar {background-color: " . $header_bg_color . ";}</style>\n";
        echo "<style>.skin-blue .main-header .logo {background-color: " . $header_bg_color . ";}</style>\n";

        echo "<!-- PANEL AND TAB COLOR -->\n";
        echo "<style>.box.box-default {border-top-color: " . \App\Classes\ColorHelper::getPanelTabLineColor('invoices') . ";}</style>\n";
    @endphp--}}

    @yield('inv_css')

@endsection
@section('js')
    {{-- Bootstrap Table --}}
    <script src="{{ asset('assets/bower_components/bootstrap-table/1.15.5/tableExport.min.js') }}"
            type="text/javascript"></script>

    <script src="{{ asset('assets/bower_components/bootstrap-table/1.15.5/bootstrap-table.min.js') }}"></script>
    <script src="{{ asset('assets/bower_components/bootstrap-table/1.15.5/locale/bootstrap-table-hu-HU.js') }}"></script>
    <script src="{{ asset('assets/bower_components/bootstrap-table/1.15.5/extensions/export/bootstrap-table-export.js') }}"></script>

    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/extensions/cookie/bootstrap-table-cookie.js"></script>

    <!--
    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/extensions/toolbar/bootstrap-table-toolbar.min.js"></script>
    -->
    {{-- Moment --}}
    <script src="{{ asset('assets/bower_components/moment/moment.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/bower_components/moment/locale/hu.js') }}" type="text/javascript"></script>

    {{-- Daterange Picker --}}
    <script src="{{ asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}" type="text/javascript"></script>

    @yield('inv_script')

@endsection
