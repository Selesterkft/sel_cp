@extends('layouts.app')

@section('title', trans('app.dashboard'))

@section('content')

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

<section class="content">

    <div class="row">

        @can('invoices-menu')
        @includeIf('layouts.widgets.widget_invoices')
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

        <section class="col-lg-12 connectedSortable">
            @includeIf('layouts.widgets.widget_todo')
        </section>

    </div>

</section>

@endsection

@section('css')

@php
echo "<!-- MENU BACGROUND COLOR -->\n";
echo "<style>.skin-blue .main-sidebar, .skin-blue .left-side {background-color: " . \App\Classes\Helper::getMenuBgColor('dashboard') . ";}</style>\n";
echo "<!-- HEADER BG COLOR -->\n";
$header_bg_color = \App\Classes\Helper::getHeaderBgColor('dashboard');
echo "<style>.skin-blue .main-header .navbar {background-color: " . $header_bg_color . ";}</style>\n";
echo "<style>.skin-blue .main-header .logo {background-color: " . $header_bg_color . ";}</style>\n";

echo "<!-- PANEL AND TAB COLOR -->\n";
echo "<style>.box.box-default {border-top-color: " . \App\Classes\Helper::getPanelTabLineColor('dashboard') . ";}</style>\n";
@endphp

@endsection
