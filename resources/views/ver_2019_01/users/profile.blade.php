@extends('layouts.app')
@section('title', Lang::get('global.profile.title'))

@section('content')

    <section class="content-header">
        <h1>
            @lang('global.profile.title')
            <small>@lang('global.profile.sub_title')</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('/') }}">
                    <i class="fa fa-dashboard"></i>&nbsp;
                    @lang('global.app_dashboard')
                </a>
            </li>

            <li class="active">
                <i class="fa fa-user"></i>&nbsp;@lang('global.profile.title')
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
                            <h3 class="box-title">@lang('global.profile.title')</h3>
                            <small>@lang('global.profile.sub_title')</small>
                        </div>

                        <div class="box-body">

                            <div class="form-group {{ ($errors->has('name')) ? 'has-error' : '' }}">
                                <label for="name" class="col-sm-2 control-label">@lang('global.app_name')
                                    :</label>
                                <div class="col-sm-10">
                                    <input id="name" name="name" class="form-control" type="text"
                                           value="{{ $user->Name }}"/>
                                    <span id="span_name" name="span_name" class="help-block">
                            {{ ($errors->has('name')) ? $errors->first('name') : '' }}
                        </span>
                                </div>
                            </div>

                            <div class="form-group {{ ($errors->has('email')) ? 'has-error' : '' }}">
                                <label for="name" class="col-sm-2 control-label">@lang('global.user.fields.email')
                                    :</label>
                                <div class="col-sm-10">
                                    <input id="email" name="email" class="form-control" type="text"
                                           value="{{ $user->Email }}"/>
                                    <span id="span_name" name="span_name" class="help-block">
                            {{ ($errors->has('email')) ? $errors->first('email') : '' }}
                        </span>
                                </div>
                            </div>
                        <!--
                    <input type="hidden" id="company_id" name="company_id" value="{{-- $user->company_id --}}"/>
                    -->
                        <!--
                    <div class="form-group {{-- ($errors->has('company_id')) ? 'has-error' : '' --}}">
                        {{-- Form::label('company_id',
                            Lang::get('global.user.fields.company') . ':',
                            ['class' => 'col-sm-2 control-label']) }}
                        <div class="col-sm-10">
                            {!! Form::select('company_id', $companies,
                                $user->company_id,
                                ['class' => 'form-control', $disabled])
                            !!}
                            <span id="span_company_id" name="span_company_id" class="help-block">
                                {{ ($errors->has('company_id')) ? $errors->first('company_id') : '' --}}
                                </span>
                            </div>
                        </div>-->

                            <div class="form-group {{ ($errors->has('password')) ? 'has-error' : '' }}">
                                <label for="password"
                                       class="col-sm-2 control-label">@lang('global.user.fields.password'):</label>
                                <div class="col-sm-10">
                                    <input id="password" name="password" class="form-control" type="password"/>
                                    <span id="span_password" name="span_password" class="help-block">
                            {{ ($errors->has('password')) ? $errors->first('password') : '' }}
                        </span>
                                </div>
                            </div>

                            <div class="form-group {{ ($errors->has('confirm-password')) ? 'has-error' : '' }}">
                                <label for="confirm-password" class="col-sm-2 control-label">
                                    @lang('global.user.fields.password_confirm'):
                                </label>
                                <div class="col-sm-10">
                                    <input id="confirm-password" name="confirm-password" class="form-control"
                                           type="password"/>
                                    <span id="span_confirm-password" name="span_confirm-password" class="help-block">
                            {{ ($errors->has('confirm-password')) ? $errors->first('confirm-password') : '' }}
                        </span>
                                </div>
                            </div>

                        <!--
                    <input type="hidden" id="roles" name="roles" value="{{-- $user->getRoleNames() --}}"/>
                    -->
                        <!--
                    <div class="form-group">
                        <label for="roles" class="col-sm-2 control-label">
                            {{--@lang('global.user.fields.roles'):--}}
                                </label>
                                <div class="col-sm-10">
{{--
                            {!! Form::select(
                                'roles[]',
                                $roles,
                                $userRole,
                                [
                                    'class' => 'form-control', 'multiple', $disabled
                                ]) !!}
                                --}}
                                </div>
                            </div>
-->
                        </div>

                        <div class="box-footer">

                            <a href="{{ route('home') }}"
                               class="btn btn-default">
                                @lang('global.app_cancel')
                            </a>

                            <button type="submit" class="btn btn-info pull-right">
                                @lang('global.app_save')
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