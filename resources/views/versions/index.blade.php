@extends(session()->get('design').'.layouts.app')

@section('title', trans('versions.title'))

@section('content-header')
    <section class="content-header">
        <h1>
            {{ trans('versions.title') }}
            <small>{{ trans('versions.sub_title') }}</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('/') }}">
                    <i class="fa fa-dashboard"></i>&nbsp;
                    {{ trans('app.dashboard') }}
                </a>
            </li>

            <li class="active">
                <i class="fa fa-users"></i>&nbsp;{{ trans('versions.title') }}
            </li>

        </ol>
    </section>
@endsection

@section('content')
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

            <div class="col-md-7">
                <div class="box box-default">

                    <div class="box-header with-border">
                        <h3 class="box-title">
                            {{ trans('company_version.title') }}
                        </h3>

                        <div class="box-tools pull-right">
                            <a class="btn btn-success btn-xs"
                               style="margin-top: 5px;"
                               href="{{ url('version_company.create') }}">&nbsp;{{ trans('app.add_new') }}
                            </a>
                        </div>

                    </div>

                    <div class="box-body">

                        @includeIf('versions.table_company_versions', ['version_companies' => $version_companies])

                    </div>
                    <div class="box box-footer"></div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="box box-default">

                    <div class="box-header with-border">
                        <h3 class="box-title">
                            {{ trans('versions.title') }}
                        </h3>

                        <div class="box-tools pull-right">
                            <a class="btn btn-success btn-xs"
                               style="margin-top: 5px;"
                               href="{{ url('versions.create') }}">&nbsp;
                                {{ trans('app.add_new') }}
                            </a>
                        </div>

                    </div>

                    <div class="box-body">

                        @includeIf('versions.table_versions', ['versions' => $versions])

                    </div>

                    <div class="box-footer"></div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="box box-default">

                    <div class="box-header with-border">
                        <h3 class="box-title">
                            {{ trans('company_subdomain.menu_title') }}
                        </h3>

                        <div class="box-tools pull-right">
                            <a class="btn btn-success btn-xs"
                               style="margin-top: 5px;"
                               href="{{ url('companysubdomain.create') }}">&nbsp;{{ trans('app.add_new') }}
                            </a>
                        </div>

                    </div>

                    <div class="box-body">

                        @includeIf('versions.table_company_subdomain', ['version_companies' => $version_companies])

                    </div>
                    <div class="box box-footer"></div>
                </div>
            </div>
        </div>

    </section>

@endsection

@section('css')
@php
use App\Classes\ColorHelper;

echo "<!-- BACGROUND COLOR -->\n";
echo "<style>.skin-blue .main-sidebar, .skin-blue .left-side {background-color: " . ColorHelper::getMenuBgColor() . ";}</style>\n";
echo "<!-- HEADER BG COLOR -->\n";
$header_bg_color = ColorHelper::getHeaderBgColor();
echo "<style>.skin-blue .main-header .navbar {background-color: " . $header_bg_color . ";}</style>\n";
echo "<style>.skin-blue .main-header .logo {background-color: " . $header_bg_color . ";}</style>\n";

echo "<!-- PANEL AND TAB COLOR -->\n";
echo "<style>.box.box-default {border-top-color: " . ColorHelper::getPanelTabLineColor() . ";}</style>\n";
@endphp
@endsection
