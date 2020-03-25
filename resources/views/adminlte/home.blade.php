@extends(session()->get('design') . ".layouts.app")

@section('title', trans('app.dashboard'))

@section('content-header')
    <section class="content-header">
        <h1>
            {{ trans('app.dashboard') }}
            <small>{{ trans('app.dashboard_title') }}</small>
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i>&nbsp;{{ trans('app.dashboard') }}
            </li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">

        <div class="row">

            @can('invoices-menu')
                @includeIf('adminlte.widgets.widget_invoices')
            @endcan

            @can('stocks-menu')
                {{--@includeIf('layouts.widgets.widget_stocks')--}}
            @endcan

            @can('transports-menu')
                {{--@includeIf('layouts.widgets.widget_transports')--}}
            @endcan

            @can('settings-menu')
                @if(Auth::user()->Supervisor_ID == 0)
                    @includeIf('layouts.widgets.widget_config')
                @endif
            @endcan
        </div>

        <div class="row">
            @includeIf('layouts.widgets.widget_invoices_sum')
        </div>

        <div class="row">
            @includeIf('layouts.widgets.widget_todo')
        </div>

    </section>
@endsection
