@extends('layouts.app')
@section('title', Lang::get('global.user.title'))

@section('content')

    <section class="content-header">
        <h1>
            {{ trans('users.title') }}
            <small>{{ trans('users.user_title_show') }}</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('/') }}">
                    <i class="fa fa-dashboard"></i>&nbsp;
                    {{ trans('app.dashboard') }}
                </a>
            </li>

            <li>
                <a href="{{ url('users') }}">
                    <i class="fa fa-users"></i>&nbsp;
                    {{ trans('users.title') }}
                </a>
            </li>

            <li class="active">
                <i class="fa fa-user"></i>&nbsp;
                {{ trans('users.title') }}
            </li>

        </ol>
    </section>

    <section class="content">

        <div class="row">

            <div class="col-md-12">
                <form method="POST" action="#" class="form-horizontal">
                    {!! csrf_field() !!}

                    <div class="box box-default">

                        <div class="box-header with-border">
                            <h3 class="box-title">{{ trans('users.title') }}</h3>
                            <small>{{ trans('users.user_title_show') }}</small>
                        </div>

                        <div class="box-body">

                            <div class="form-group">
                                <label for="Name" class="col-sm-2 control-label">
                                    {{ trans('app.name') }}:
                                </label>
                                <div class="col-sm-10">
                                    <input id="Name" name="Name" class="form-control" type="text"
                                           value="{{ $user->Name }}" disabled/>
                                    <span id="span_name" name="span_name" class="help-block">
                                        {{-- ($errors->has('Name')) ? $errors->first('Name') : '' --}}
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="Email" class="col-sm-2 control-label">
                                    {{ trans('app.email') }}:
                                </label>
                                <div class="col-sm-10">
                                    <input id="Email" name="Email" class="form-control" type="text"
                                           value="{{ $user->Email }}" disabled/>
                                    <span id="span_name" name="span_name" class="help-block">
                                        {{-- ($errors->has("Email")) ? $errors->first("Email") : "" --}}
                                    </span>
                                </div>
                            </div>


                        <div class="form-group">
                            <label for="CompanyID" class="col-sm-2 control-label">
                                {{ trans('app.company') }}:
                            </label>
                            <div class="col-sm-10">
                                <input id="CompanyID" name="CompanyID" type="text" class="form-control"
                                       value="{{ $user->company->Nev1 }}" disabled/>
                                <span id="span_company_id" name="span_company_id" class="help-block">
                                    {{-- ($errors->has('CompanyID')) ? $errors->first('CompanyID') : '' --}}
                                </span>
                            </div>
                        </div>

                            <?php
                            $languages = config('appConfig.languages');
                            foreach ($languages as $key => $value)
                            {
                                $languages[$key] = Lang::get("global.languages." . $key);
                            }
                            ?>

                            <div class="form-group">
                                {{ Form::label('language',
                                    Lang::get('global.user.fields.language') . ':',
                                    ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">
                                    <input id="language" name="language" class="form-control"
                                           value="{{ $user->language }}" disabled/>
                                    <span id="span_company_id" name="span_company_id" class="help-block">
                                        {{-- ($errors->has('language')) ? $errors->first('language') : '' --}}
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password" class="col-sm-2 control-label">
                                    {{ trans('users.password') }}:
                                </label>
                                <div class="col-sm-10">
                                    <input id="password" name="password" class="form-control" type="password" disabled/>
                                    <span id="span_password" name="span_password" class="help-block">
                                        {{-- ($errors->has('password')) ? $errors->first('password') : '' --}}
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="confirm-password"
                                       class="col-sm-2 control-label">
                                    {{ trans('users.password_confirm') }}:
                                </label>
                                <div class="col-sm-10">
                                    <input id="confirm-password" name="confirm-password"
                                           class="form-control" type="password" disabled/>
                                    <span id="span_confirm-password" name="span_confirm-password" class="help-block">
                                        {{-- ($errors->has('confirm-password')) ? $errors->first('confirm-password') : '' --}}
                                    </span>
                                </div>
                            </div>

                            @if( Auth::user()->hasRole('Admin') )

                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">
                                        {{ trans('roles.title') }}
                                    </label>
                                    <div class="col-sm-10" style="margin-top: 10px;">

                                        @foreach($roles as $role)
                                            <label>
                                                <?php
                                                $t = false;
                                                foreach($userRoles as $v)
                                                {
                                                    if( $v == $role )
                                                    {
                                                        $t = true;
                                                        break;
                                                    }
                                                }
                                                ?>
                                                {{ Form::checkbox(
                                                    'roles[]',
                                                    $role,
                                                    $t,
                                                    [
                                                        'class' => 'name',
                                                        'style' => 'margin-left: 5px;',
                                                        'disabled'
                                                    ]) }}
                                                {{ trans('roles.' . $role) }}
                                            </label>
                                        @endforeach
                                    </div>
                                </div>

                            @else
                                <input id="roles[]" name="roles[]" type="hidden"
                                       value="{{ $userRoles }}" disabled/>
                            @endif

                        </div>

                        <div class="box-footer">
                            <a href="{{ url('users') }}"
                               class="btn btn-default">
                                @lang('global.app_cancel')
                            </a>
                            <a href="{{ url('users.edit', ['id' => $user->ID]) }}"
                               class="btn btn-info pull-right">
                                {{ trans('app.edit') }}
                            </a>
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
echo "<style>.skin-blue .main-sidebar, .skin-blue .left-side {background-color: " . \App\Classes\Helper::getMenuBgColor('users') . ";}</style>\n";
echo "<!-- HEADER BG COLOR -->\n";
$header_bg_color = \App\Classes\Helper::getHeaderBgColor("users");
echo "<style>.skin-blue .main-header .navbar {background-color: " . $header_bg_color . ";}</style>\n";
echo "<style>.skin-blue .main-header .logo {background-color: " . $header_bg_color . ";}</style>\n";

echo "<!-- PANEL AND TAB COLOR -->\n";
echo "<style>.box.box-default {border-top-color: " . \App\Classes\Helper::getPanelTabLineColor() . ";}</style>\n";
@endphp
@endsection
