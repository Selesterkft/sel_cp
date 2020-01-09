@extends('layouts.app')
@section('title', Lang::get('global.users.title'))

@section('search')

@endsection

@section('content')

    <section class="content-header">
        <h1>
            KERESÉS
            <small>EREDMÉNY</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('/') }}">
                    <i class="fa fa-dashboard"></i>&nbsp;
                    @lang('global.app_dashboard')
                </a>
            </li>

            <li>
                <a href="{{ route('users', ['version' => $version,]) }}">
                    <i class="fa fa-users"></i>&nbsp;@lang('global.users.title')
                </a>
            </li>

            <li class="active">
                <i class="fa fa-search"></i>&nbsp;KERESÉS
            </li>

        </ol>
    </section>

    <div class="content">
        <div class="row">

            <div class="col-md-12">

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            KERESÉS
                        </h3>

                        <div class="box-tools pull-right">
                            <!--
                            <a class="btn btn-success btn-xs"
                               href="{{-- route('users.create',
                                ['company' => $company, 'version' => $version]) --}}">&nbsp;@lang('global.app_add_new')
                            </a>
                            -->
                        </div>
                        <div class="box-body">

                            @foreach($searchResults->groupByType() as $type => $modelSearchResults)
                                <h2>{{ ucfirst($type) }}</h2>
                                @foreach($modelSearchResults as $searchResult)

                                    <ul>
                                        <li>
                                            <a href="{{ $searchResult->url }}">{{ $searchResult->title }} {{ $searchResult->searchable->Email }}</a>
                                        </li>
                                    </ul>
                                @endforeach
                            @endforeach
                        </div>
                        <div class="box-footer"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('css')
@php
echo "<!-- BACGROUND COLOR -->";
echo "<style>.skin-blue .main-sidebar, .skin-blue .left-side {background-color: " . \App\Classes\Helper::getMenuBgColor('users') . ";}</style>";
echo "<!-- HEADER BG COLOR -->";
$header_bg_color = \App\Classes\Helper::getHeaderBgColor("users");
echo "<style>.skin-blue .main-header .navbar {background-color: " . $header_bg_color . ";}</style>";
echo "<style>.skin-blue .main-header .logo {background-color: " . $header_bg_color . ";}</style>";

echo "<!-- PANEL AND TAB COLOR -->\n";
echo "<style>.box.box-default {border-top-color: " . \App\Classes\Helper::getPanelTabLineColor('users') . ";}</style>\n";
@endphp
@endsection