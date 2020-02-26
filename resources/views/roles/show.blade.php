@extends('layouts.app')
@section('title', trans('roles.title'))

@section('content')

    <section class="content-header">
        <h1>
            {{ trans('roles.title') }}
            <small>{{ trans('roles.show_sub_title') }}</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('/') }}">
                    <i class="fa fa-dashboard"></i>&nbsp;
                    {{ trans('app.dashboard') }}
                </a>
            </li>

            <li>
                <a href="{{ url('roles') }}">
                    <i class="fa fa-files-o"></i>&nbsp;
                    {{ trans('roles.title') }}
                </a>
            </li>

            <li class="active">
                <i class="fa fa-file-text-o"></i>&nbsp;
                {{ trans('roles.show_sub_title') }}
            </li>

        </ol>
    </section>

    <section class="content">

        <div class="box box-default">

            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('roles.title') }}</h3>
                <small>{{ trans('roles.show_sub_title') }}</small>
            </div>

            <div class="box-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">
                            {{ trans('app.name') }}:
                        </label>
                        <div class="col-sm-10">
                            <input id="name" name="name" class="form-control"
                                   type="text"
                                   value="{{ $role->name }}"
                                   disabled/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">
                            {{ trans('permissions.title') }}:
                        </label>
                        <div class="col-sm-10">
                            @if(!empty($rolePermissions))
                                @foreach($rolePermissions as $value)
                                    <label>{{ trans('roles.' . $value->name) }}</label>
                                    <br/>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </form>
            </div>

            <div class="box-footer">
                <a href="{{ url('roles') }}" class="btn btn-default">
                    {{ trans('app.back_to_list') }}
                </a>
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
