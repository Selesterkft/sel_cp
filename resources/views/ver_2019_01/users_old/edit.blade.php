@php
$loggedUser = Auth::user();
@endphp

@extends('layouts.app')
@section('title', trans('users.user_title'))

@section('content')

    <section class="content-header">
        <h1>
            {{ trans('users.user_title') }}
            <small>{{ trans('users.user_title_update') }}</small>
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
                {{ trans('users.user_title_update') }}
            </li>

        </ol>
    </section>

    <section class="content">

        <div class="row">

            <div class="col-md-12">
                <form id="frm" name="frm" method="POST" class="form-horizontal"
                      action="{{ url("users.update", ['id' => $user->ID]) }}">
                    <input type="hidden" name="_method" value="PUT"/>
                    @csrf
                    <input type="hidden" id="ID" name="ID" value="{{ $user->ID }}"/>

                <div class="box box-default">

                    <div class="box-header with-border">
                        <h3 class="box-title">
                            {{ trans('users.user_title') }}
                        </h3>
                        <small>
                            {{ trans('users.user_title_update') }}
                        </small>
                    </div>

                    <div class="box-body">

                        <div class="form-group {{ ($errors->has('Name')) ? 'has-error' : '' }}">
                            <label for="Name" class="col-sm-2 control-label">
                                {{ trans('app.name') }}:
                            </label>
                            <div class="col-sm-10">
                                <input id="Name" name="Name" class="form-control" type="text"
                                       value="{{ $user->Name }}"/>
                                <span id="span_name" name="span_name" class="help-block">
                                    {{ ($errors->has('Name')) ? $errors->first('Name') : '' }}
                                </span>
                            </div>
                        </div>

                        <div class="form-group {{ ($errors->has('Email')) ? 'has-error' : '' }}">
                            <label for="Email" class="col-sm-2 control-label">
                                {{ trans('app.email') }}:
                            </label>
                            <div class="col-sm-10">
                                <input id="Email" name="Email" class="form-control" type="text"
                                       value="{{ $user->Email }}"/>
                                <span id="span_name" name="span_name" class="help-block">
                            {{ ($errors->has('Email')) ? $errors->first('Email') : '' }}
                        </span>
                            </div>
                        </div>
<!--
                        @if( $loggedUser->hasRole('Admin') )
                            <div class="form-group {{-- ($errors->has('CompanyID')) ? 'has-error' : '' --}}">
                                {{-- Form::label('CompanyID',
                                    __('global.user.fields.company') . ':',
                                    ['class' => 'col-sm-2 control-label']) --}}
                                <div class="col-sm-10">
                                    {{-- Form::select('CompanyID', $companies,
                                        $user->CompanyID,
                                        ['class' => 'form-control'])
                                    --}}
                                    <span id="span_company_id" name="span_company_id" class="help-block">
                                        {{-- ($errors->has('CompanyID')) ? $errors->first('CompanyID') : '' --}}
                                    </span>
                                </div>
                            </div>
                        @else
                            <input id="CompanyID" name="CompanyID"
                                   value="{{-- $user->CompanyID --}}"
                                   type="hidden"/>
                        @endif-->
                        <input id="CompanyID" name="CompanyID"
                                   value="{{ $user->CompanyID }}"
                                   type="hidden"/>
                        <!-- NYELV -->
                        @php
                            $languages = config('appConfig.languages');
                            foreach ($languages as $key => $value)
                            {
                                $languages[$key] = Lang::get("global.languages." . $key);
                            }
                        @endphp

                        <div class="form-group {{ ($errors->has('language')) ? 'has-error' : '' }}">
                            {{ Form::label('language',
                                trans('app.language') . ':',
                                ['class' => 'col-sm-2 control-label']) }}
                            <div class="col-sm-10">
                                {!! Form::select('language',
                                    $languages,
                                    $user->language,
                                    ['class' => 'form-control'])
                                !!}
                                <span id="span_company_id" name="span_company_id"
                                      class="help-block">
                                    {{ ($errors->has('language')) ? $errors->first('language') : '' }}
                                </span>
                            </div>
                        </div>
                        <!-- NYELV VÉGE -->

                        <!-- JELSZÓ -->
                        {{--
                        <div class="form-group {{ ($errors->has('password')) ? 'has-error' : '' }}">
                            <label for="password" class="col-sm-2 control-label">
                                {{ __('global.user.fields.password') }}:
                            </label>
                            <div class="col-sm-10">
                                <input id="password" name="password" class="form-control" type="password"/>
                                <span id="span_password" name="span_password" class="help-block">
                                    {{ ($errors->has('password')) ? $errors->first('password') : '' }}
                                </span>
                            </div>
                        </div>

                        <div class="form-group {{ ($errors->has('confirm-password')) ? 'has-error' : '' }}">
                            <label for="confirm-password" class="col-sm-2 control-label">
                                {{ __('global.user.fields.password_confirm') }}:
                            </label>
                            <div class="col-sm-10">
                                <input id="confirm-password" name="confirm-password"
                                       class="form-control"
                                       type="password"/>
                                <span id="span_confirm-password" name="span_confirm-password" class="help-block">
                                    {{ ($errors->has('confirm-password')) ? $errors->first('confirm-password') : '' }}
                                </span>
                            </div>
                        </div>
                        --}}
                        <!-- JELSZÓ VÉGE -->

                        <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">
                                    {{ trans('roles.title') }}:
                                </label>
                                <div class="col-sm-10" style="margin-top: 10px;">
                                    @foreach($roles as $role)
                                        <label>
                                            @php
                                            $vanJoga = false;

                                            /** @var string $role */
                                            $class = 'role' . ($role == 'Admin' ? '1' : '2') ;

                                            /** @var array $userRoles */
                                            foreach($userRoles as $v)
                                            {
                                                if( $v == $role )
                                                {
                                                    $vanJoga = true;
                                                    break;
                                                }
                                            }

                                            $disabled = '';
                                            // A felhasználó nem szerkesztheti a saját jogait
                                            if($loggedUser->ID == $user->ID)
                                            {
                                                $disabled = 'disabled';
                                            }
                                            elseif( $vanJoga == false )
                                            {
                                                //$disabled = 'disabled';
                                                //$disabled = ( count($userRoles) == 0 ) ? '' : 'disabled';
                                            }
                                            @endphp
                                            {{ Form::checkbox(
                                                'roles[]',
                                                $role,
                                                $vanJoga,
                                                [
                                                    'class' => $class,
                                                    'style' => 'margin-left: 5px;',
                                                    $disabled
                                                ]) }}
                                                {{ trans('roles.' . $role) }}
                                        </label><br/>
                                    @endforeach
                                </div>
                            </div>

                    </div>

                    <div class="box-footer">
                        <a href="{{ url('users') }}"
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
echo "<!-- BACGROUND COLOR -->\n";
echo "<style>.skin-blue .main-sidebar, .skin-blue .left-side {background-color: " . \App\Classes\Helper::getMenuBgColor('users') . ";}</style>\n";
echo "<!-- HEADER BG COLOR -->\n";
$header_bg_color = \App\Classes\Helper::getHeaderBgColor("users");
echo "<style>.skin-blue .main-header .navbar {background-color: " . $header_bg_color . ";}</style>\n";
echo "<style>.skin-blue .main-header .logo {background-color: " . $header_bg_color . ";}</style>\n";

echo "<!-- PANEL AND TAB COLOR -->\n";
echo "<style>.box.box-default {border-top-color: " . \App\Classes\Helper::getPanelTabLineColor('users') . ";}</style>\n";
@endphp
@endsection

@section('js')

    <script>
        $(document).ready(function()
        {
            var frm = $('#frm');

            frm.on('submit', function()
            {
                $('input').prop('disabled', false);
            });

            // Admin checkboxra kattintás
            $('.role1').on('click', function(event)
            {
                // Ha be van pipálva, akkor...
                if($(this).prop('checked') == true)
                {
                    $('input.role2').prop('checked', false);
                    $('input.role2').attr('disabled', true);
                }
                // Ha nincs bepipálva, akkor...
                else
                {
                    $('input.role2').removeAttr('disabled');
                }
            });

            // Adminon kívül másik checkboxra kattintás
            $('.role2').on('click', function(event)
            {
                var numberOfChecked = $('.role2').filter(':checked').length;
                //var totalCheckboxes = $('.role2').length;
                //var numberNotChecked = totalCheckboxes - numberOfChecked;

                if($(this).prop('checked') == true)
                {
                    $('input.role1').prop('checked', false);
                    $('input.role1').attr('disabled', true);
                }
                // Ha nincs bepipálva, akkor...
                else
                {
                    if( numberOfChecked == 0 )
                    {
                        $('input.role1').removeAttr('disabled');
                    }
                }
            });
        });
    </script>

@endsection
