@extends('layouts.app')
@section('title', __('global.role.title'))

@section('content')

    <section class="content-header">
        <h1>
            @lang('global.role.title')
            <small>@lang('global.role.sub_title')</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('/') }}">
                    <i class="fa fa-dashboard"></i>&nbsp;
                    @lang('global.app_dashboard')
                </a>
            </li>

            <li>
                <a href="{{ url('roles') }}">
                    <i class="fa fa-files-o"></i>&nbsp;
                    {{ __('global.roles.title') }}
                </a>
            </li>

            <li class="active">
                <i class="fa fa-file-text-o"></i>&nbsp;
                {{ __('global.role.title') }}
            </li>

        </ol>
    </section>

    <section class="content">

        <div class="box box-default">

            <div class="box-header with-border">
                <h3 class="box-title">{{ __('global.role.title') }}</h3>
                <small>{{ __('global.role.sub_title') }}</small>
            </div>

            <div class="box-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">
                            {{ __('global.app_name') }}:
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
                            {{ __('global.role.fields.permissions') }}:
                        </label>
                        <div class="col-sm-10">
                            @if(!empty($rolePermissions))
                                @foreach($rolePermissions as $value)
                                    <label>{{ $value->name }}</label>
                                    <br/>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </form>
            </div>

            <div class="box-footer">
                <a href="{{ url('roles') }}" class="btn btn-default">
                    {{ __('global.app_cancel') }}
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