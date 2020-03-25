@extends('layouts.app')
@section('title', trans('users.user_title_show'))

@section('content')

    <section class="content-header">
        <h1>
            @lang('global.profile.title')
            <small>{{ trans('users.user_title_show') }}</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('/') }}">
                    <i class="fa fa-dashboard"></i>&nbsp;
                    {{ trans('app.dashboard') }}
                </a>
            </li>

            <li class="active">
                <i class="fa fa-user"></i>&nbsp;{{ trans('users.user_title_show') }}
            </li>

        </ol>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <form method="POST" class="form-horizontal"
                      action="{{ route('profile.update', [
                    'version' => $version, 'id' => $user->id
                    ]) }}">
                    <input type="hidden" name="_method" value="PUT"/>
                    @csrf
                    <input type="hidden" id="ID" name="ID" value="{{ $user->ID }}"/>

                    <div class="box box-default">

                        <div class="box-header with-border">
                            <h3 class="box-title">
                                {{ trans('users.user_title_show') }}
                            </h3>
                            <small>{{ trans('users.user_title_show') }}</small>
                        </div>

                        <div class="box-body">

                            <div class="form-group {{ ($errors->has('name')) ? 'has-error' : '' }}">
                                <label for="name" class="col-sm-2 control-label">{{ trans('app.name') }}:</label>
                                <div class="col-sm-10">
                                    <input id="name" name="name" class="form-control" type="text"
                                           value="{{ $user->Name }}"/>
                                    <span id="span_name" name="span_name" class="help-block">
                            {{ ($errors->has('name')) ? $errors->first('name') : '' }}
                        </span>
                                </div>
                            </div>

                            <div class="form-group {{ ($errors->has('email')) ? 'has-error' : '' }}">
                                <label for="name" class="col-sm-2 control-label">{{ trans('app.email') }}:</label>
                                <div class="col-sm-10">
                                    <input id="email" name="email" class="form-control" type="text"
                                           value="{{ $user->Email }}"/>
                                    <span id="span_name" name="span_name" class="help-block">
                                        {{ ($errors->has('email')) ? $errors->first('email') : '' }}
                                    </span>
                                </div>
                            </div>

                            <div class="form-group {{ ($errors->has('password')) ? 'has-error' : '' }}">
                                <label for="password" class="col-sm-2 control-label">{{ trans('users.password') }}:</label>
                                <div class="col-sm-10">
                                    <input id="password" name="password" class="form-control" type="password"/>
                                    <span id="span_password" name="span_password" class="help-block">
                                        {{ ($errors->has('password')) ? $errors->first('password') : '' }}
                                    </span>
                                </div>
                            </div>

                            <div class="form-group {{ ($errors->has('confirm-password')) ? 'has-error' : '' }}">
                                <label for="confirm-password" class="col-sm-2 control-label">{{ trans('users.password_confirm') }}:</label>
                                <div class="col-sm-10">
                                    <input id="confirm-password" name="confirm-password" class="form-control"
                                           type="password"/>
                                    <span id="span_confirm-password" name="span_confirm-password" class="help-block">
                                        {{ ($errors->has('confirm-password')) ? $errors->first('confirm-password') : '' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="box-footer">

                            <a href="{{ route('home') }}"
                               class="btn btn-default">
                                {{ trans('app.cancel') }}
                            </a>

                            <button type="submit" class="btn btn-info pull-right">
                                {{ trans('app.save') }}
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
