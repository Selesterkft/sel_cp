@extends(session()->get('design').'.layouts.app')

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
            @includeIf('yusen_design.widgets.widget_invoices')
            @endcan

            @can('settings-menu')
                @includeIf('yusen_design.widgets.widget_config')
            @endcan

        </div>

        <div class="row">

            @can('invoices-menu')
                @includeIf('yusen_design.widgets.widget_invoices_sum')
            @endcan

        </div>

        <div class="row">
            @includeIf('yusen_design.widgets.widget_todo')
        </div>

    </section>
@endsection

@section('css')

@endsection
