@extends('layouts.app')

@section('title', __('global.versions.title'))

@section('content')
    <section class="content-header">
        <h1>
            {{ __('global.versions.title') }}
            <small>{{ __('global.versions.sub_title') }}</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('/') }}">
                    <i class="fa fa-dashboard"></i>&nbsp;
                    {{ __('global.app_dashboard') }}
                </a>
            </li>

            <li class="active">
                <i class="fa fa-users"></i>&nbsp;{{ __('global.versions.title') }}
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

            <div class="col-md-5">
                <div class="box box-default">

                    <div class="box-header with-border">
                        <h3 class="box-title">
                            {{ __('global.versions.title') }}
                        </h3>

                        <div class="box-tools pull-right">
                            <a class="btn btn-success btn-xs"
                               style="margin-top: 5px;"
                               href="{{ url('versions.create') }}">&nbsp;
                                {{ __('global.app_add_new') }}
                            </a>
                        </div>

                    </div>

                    <div class="box-body">

                        @includeIf('versions.table_versions', ['versions' => $versions])

                    </div>

                    <div class="box-footer"></div>

                </div>
            </div>

            <div class="col-md-7">
                <div class="box box-default">

                    <div class="box-header with-border">
                        <h3 class="box-title">
                            {{ __('global.company_version.title') }}
                        </h3>

                        <div class="box-tools pull-right">
                            <a class="btn btn-success btn-xs"
                               style="margin-top: 5px;"
                               href="{{ url('version_company.create') }}">&nbsp;{{ __('global.app_add_new') }}
                            </a>
                        </div>

                    </div>

                    <div class="box-body">

                        @includeIf('versions.table_company_versions', ['version_companies' => $version_companies])

                    </div>
                    <div class="box box-footer"></div>
                </div>
            </div>

        </div>

    </section>

@endsection

@section('css')
@php
echo "<!-- BACGROUND COLOR -->\n";
echo "<style>.skin-blue .main-sidebar, .skin-blue .left-side {background-color: " . \App\Classes\Helper::getMenuBgColor() . ";}</style>\n";
echo "<!-- HEADER BG COLOR -->\n";
$header_bg_color = \App\Classes\Helper::getHeaderBgColor();
echo "<style>.skin-blue .main-header .navbar {background-color: " . $header_bg_color . ";}</style>\n";
echo "<style>.skin-blue .main-header .logo {background-color: " . $header_bg_color . ";}</style>\n";

echo "<!-- PANEL AND TAB COLOR -->\n";
echo "<style>.box.box-default {border-top-color: " . \App\Classes\Helper::getPanelTabLineColor() . ";}</style>\n";
@endphp
@endsection