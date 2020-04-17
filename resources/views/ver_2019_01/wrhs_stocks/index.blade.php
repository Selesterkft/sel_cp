@extends(session()->get('design') . '.layouts.app')

@section('title', trans('stocks.title'))

@section('content-header')
    <section class='content-header'>
        <h1>
            {{ trans('stocks.title') }}
            <small>{{ trans('stocks.sub_title') }}</small>
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
                {{ trans('stocks.title') }}
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
                        <div class="table-responsive">

                            {{-- TÁBLÁZAT --}}
                            @includeIf(session()->get('version') . '.wrhs_stocks.wrhs_stock_table')

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
@endsection

@section('css')
    {{-- Bootstrap Table --}}
    <link href="{{ asset('assets/bower_components/bootstrap-table/1.15.5/bootstrap-table.css') }}" rel="stylesheet"/>

    @yield('wrhs_stocks_css')
@endsection

@section('js')
    {{-- Bootstrap Table --}}
    <script src="{{ asset('assets/bower_components/bootstrap-table/1.15.5/tableExport.min.js') }}"
            type="text/javascript"></script>

    <script src="{{ asset('assets/bower_components/bootstrap-table/1.15.5/bootstrap-table.min.js') }}"></script>
    <script
        src="{{ asset('assets/bower_components/bootstrap-table/1.15.5/locale/bootstrap-table-hu-HU.js') }}"></script>
    <script
        src="{{ asset('assets/bower_components/bootstrap-table/1.15.5/extensions/export/bootstrap-table-export.js') }}"></script>

    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/extensions/cookie/bootstrap-table-cookie.js"></script>

    @yield('wrhs_stocks_js')
@endsection
