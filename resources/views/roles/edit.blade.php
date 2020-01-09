@extends('layouts.app')
@section('title', __('global.role.title'))

@section('content')

<section class="content-header">
    <h1>
        {{ __('global.role.title') }}
        <small>{{ __('global.role.sub_titles.update') }}</small>
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ url('/') }}">
                <i class="fa fa-dashboard"></i>&nbsp;
                {{ __('global.app_dashboard') }}
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

    <div class="row">
        <div class="col-lg-12">

            <form id="frm" name="frm" method="POST" class="form-horizontal" 
                  action="{{ url('roles.update', $role) }}">
                <input type="hidden" name="_method" value="PUT">
                @csrf
                <div class="box box-default">
                    <div class="box-header">
                        <h3 class="box-title">{{ __('global.app_add_new') }}</h3>
                    </div>

                    <div class="box-body">

                        <div class="form-group {{ ($errors->has('name')) ? 'has-error' : '' }}">
                            <label for="name" class="col-sm-2 control-label">
                                {{ __('global.app_name') }}:
                            </label>
                            <div class="col-sm-10">
                                <input id="name" name="name" class="form-control"
                                       type="text" value="{{ $role->name }}"/>
                                <span id="span_name" name="span_name" class="help-block">
                                    {{ ($errors->has('name')) ? $errors->first('name') : '' }}
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">
                                {{ __('global.role.fields.permissions') }}:
                            </label>
                            <div class="col-sm-10">
                                @foreach($permissions as $value)
                                <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                    {{ $value->name }}</label>
                                <br/>
                                @endforeach
                            </div>
                        </div>

                    </div>
                    <div class="box-footer">
                        <a href="{{ url('roles') }}" class="btn btn-default">
                            {{ __('global.app_cancel') }}
                        </a>
                        <button type="submit" class="btn btn-info pull-right">
                            {{ __('global.app_save') }}
                        </button>
                    </div>
                </div>

            </form>

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