@extends(session()->get('design') . '.layouts.app')

@section('title', trans('users.user_title'))

@section('content-header')
    <section class="content-header">
        <h1>
            {{ trans('users.user_title') }}
            <small>{{ trans('users.user_title_create') }}</small>
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
                    <i class="fa fa-users"></i>&nbsp;{{ trans('users.title') }}
                </a>
            </li>

            <li class="active">
                <i class="fa fa-user"></i>&nbsp;{{ trans('users.user_title_create') }}
            </li>

        </ol>
    </section>
@endsection

@section('content')
    <section class="content">

        <div class="row">

            <div class="col-md-12">

                <form id="frm" name="frm"
                      action="{{ url('users.store') }}"
                      method="POST" class="form-horizontal">
                    @csrf

                    <div class="box box-default">

                        <div class="box-header with-border">
                            <h3 class="box-title">{{ trans('users.user_title_create') }}</h3>
                            <small>{{-- trans('users.user_title_create') --}}</small>
                        </div>

                        <div class="box-body">

                            <input id="sendEmail" name="sendEmail" type="hidden" value="0"/>

                            <div class="form-group {{ ($errors->has('Name')) ? 'has-error' : '' }}">
                                {{ Form::label('Name', trans('app.name') . ':',
                                    ['class' => 'col-sm-2 control-label']) }}

                                <div class="col-sm-10">
                                    <input id="Name" name="Name" class="form-control" type="text"
                                           value="{{ old('Name') }}"/>
                                    <span id="span_name" name="span_name" class="help-block">
                                    {{ ($errors->has('Name')) ? $errors->first('Name') : '' }}
                                </span>
                                </div>
                            </div>

                            <div class="form-group {{ ($errors->has('Email')) ? 'has-error' : '' }}">
                                {{ Form::label('Email', trans('app.email') . ':',
                                    ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">
                                    <input id="Email" name="Email" class="form-control" type="text"
                                           value="{{ old('Email') }}"/>
                                    <span id="span_email" name="span_email" class="help-block">
                                    {{ ($errors->has('Email')) ? $errors->first('Email') : '' }}
                                </span>
                                </div>
                            </div>

                            @if(Auth::user()->CompanyID == 71 && Auth::user()->hasRole('Admin'))

                                <div class="form-group {{ ($errors->has('CompanyID')) ? 'has-error' : '' }}">
                                    {{ Form::label('CompanyID',
                                        trans('users.company') . ':',
                                        ['class' => 'col-sm-2 control-label']) }}
                                    <div class="col-sm-10">
                                        {{ Form::select('CompanyID', $companies,
                                            [],
                                            ['class' => 'form-control'])
                                        }}
                                        <span id="span_company_id" name="span_company_id" class="help-block">
                                    {{ ($errors->has('CompanyID')) ? $errors->first('CompanyID') : '' }}
                                </span>
                                    </div>
                                </div>

                            @else
                                <input id="CompanyID" name="CompanyID" type="hidden" value="{{ Auth::user()->CompanyID }}"/>
                            @endif

                            {{-- CSAK CÉGEN BELLÜLI FELHASZNÁLÓNAK HOZHAT LÉTRE HOZZÁFÉRÉST --}}
                            {{--<input id="CompanyID" name="CompanyID" type="hidden" value="{{ Auth::user()->CompanyID }}"/>--}}
                            <input id="Supervisor_ID" name="Supervisor_ID" type="hidden" value="{{ Auth::user()->Supervisor_ID }}"/>
                            <input id="Supervisor_Name" name="Supervisor_Name" type="hidden" value="{{ Auth::user()->Supervisor_Name }}"/>

                            @php
                                $languages = config('appConfig.languages');
                                foreach ($languages as $key => $value)
                                {
                                    $languages[$key] = trans("app." . $key);
                                }
                            @endphp

                            <div class="form-group {{ ($errors->has('language')) ? 'has-error' : '' }}">
                                {{ Form::label('language',
                                    trans('app.language') . ':',
                                    ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">
                                    {!! Form::select('language', $languages,
                                        [],
                                        ['class' => 'form-control'])
                                    !!}
                                    <span id="span_language" name="span_language" class="help-block">
                                    {{ ($errors->has('language')) ? $errors->first('language') : '' }}
                                </span>
                                </div>
                            </div>

                            <div class="form-group {{ ($errors->has('password')) ? 'has-error' : '' }}">
                                {{ Form::label('password',
                                    trans('users.password') . ':',
                                    ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">
                                    <input id="password" name="password" class="form-control" type="password"/>
                                    <span id="span_password" name="span_password" class="help-block">
                            {{ ($errors->has('password')) ? $errors->first('password') : '' }}
                        </span>
                                </div>
                            </div>

                            <div class="form-group {{ ($errors->has('confirm-password')) ? 'has-error' : '' }}">
                                {{ Form::label('confirm-password',
                                    trans('users.password_confirm') . ':',
                                    ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">
                                    <input id="confirm-password" name="confirm-password" class="form-control"
                                           type="password"/>
                                    <span id="span_confirm-password" name="span_confirm-password" class="help-block">
                                {{ ($errors->has('confirm-password')) ? $errors->first('confirm-password') : '' }}
                            </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">
                                    {{ trans('roles.title') }}:
                                </label>
                                <div class="col-sm-10" style="margin-top: 10px;">

                                    @foreach($roles as $role)

                                        @php
                                            $class = 'role';
                                            /** @var string $role */
                                            if($role == 'Admin'){ $class .= '1'; }else{ $class .= '2'; }
                                        @endphp

                                        <label>
                                            {{ Form::checkbox(
                                                'roles[]', $role, false, [
                                                    'class' => $class,
                                                    'style' => 'margin-left: 5px;',
                                                    'id' => $role
                                                ]
                                            ) }}
                                            {{ trans('roles.' . $role) }}
                                        </label><br/>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="box-footer">
                            <a href="{{ url('users') }}"
                               class="btn btn-warning">
                                {{ trans('app.cancel') }}
                            </a>
                            <button type="submit" class="btn btn-info pull-right" style="margin-left: 10px;">
                                {{ trans('app.save') }}
                            </button>
                        <!--
                        <button class="btn btn-default pull-right" id="btnSendMail"
                                name="btnSendMail">
                            {{-- __('SAVE AND SEND MAIL') --}}
                            </button>
-->
                        </div>

                    </div>

                </form>
            </div>
        </div>

    </section>
@endsection

@section('css')@endsection

@section('js')
    <script>
        $(document).ready(function()
        {
            var frm = $('#frm');
            var btnSendMail = $('#btnSendMail');

            $('#btnSendMail').on('click', function(e)
            {
                e.preventDefault();
                sendMail.val(1);
                frm.submit();
            });

            // Cég select választó
            $('#CompanyID').on('change', function()
            {
                var optionSelected = $("option:selected", this);
                var valueSelected = this.value;
                var textSelected   = optionSelected.text();

                if( valueSelected == 71 )
                {
                    $('input.role1').prop('checked', false);
                    //$('input.role2').prop('checked', true);
                    $('.role2').click();
                }
                else
                {
                    $('input.role2').prop('checked', false);
                    //$('input.role1').prop('checked', true);
                    $('.role1').click();
                }

                //console.log(optionSelected);
                //console.log(valueSelected);
                //console.log(textSelected);
            });

            //
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
                    if( numberOfChecked == 0 ){
                        $('input.role1').removeAttr('disabled');
                    }
                }
            });
        });
    </script>
@endsection
