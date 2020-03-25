@extends($design . '.layouts.auth_app')

@section('content-header')@endsection

@section('content')

    <?php
    use App\Classes\ColorHelper as ColorHelper;use App\Classes\Helper as Helper;
    $subdomain = Helper::getAppSubdomain();
    $company_id = Helper::getCompanyIDByCompanyNickName($subdomain);

    if( $company_id == null )
    {
    ?>
    <script type="text/javascript">
        //window.location.href = "http://webandtrace.com";
        window.location.href = "http://google.hu";
    </script>
    <?php
    }
    $wallpaper = Helper::getWallpaper($company_id);
    $bgColor = ColorHelper::getLoginBgColor($company_id);
    ?>

    <div class="login-box box-default">

        <div class="login-logo">
            <a href="{{ url('/') }}"><b>{{ config('appConfig.appName') }}</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">{{ trans('users.login_title') }}</p>

            <form class="form-horizontal" role="form" method="POST"
                  action="{{ url('login') }}" autocomplete="off">
                {{ csrf_field() }}

                <div class="{{ $errors->has('company') ? 'has-error' : '' }}">
                    <input id="company" name="company" type="hidden"
                           value="{{ Helper::getAppSubdomain() }}"/>
                    <span id="span_company" name="span_company" class="help-block">
                    {{ ($errors->has('company')) ? $errors->first('company') : '' }}
                </span>
                </div>

                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                    <input id="email" name="email" type="email" class="form-control"
                           placeholder="{{ trans('app.email') }}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    <span id="span_email" name="span_email"
                          class="help-block">
                    {{ ($errors->has('email')) ? $errors->first('email') : '' }}
                        {{-- (Session::has('email')) ? Session::get('email') : '' --}}
                </span>
                </div>

                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                    <input id="password" name="password" type="password"
                           class="form-control"
                           placeholder="{{ trans('users.password') }}">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    <span id="span_password" name="span_password" class="help-block">
                    {{ ($errors->has('password')) ? $errors->first('password') : '' }}
                </span>
                </div>

                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <!--<input type="checkbox">&nbsp;Emlékezz rám-->
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit"
                                class="btn btn-primary btn-block">
                            {{ trans('users.login') }}
                        </button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        <!--
        <a href="{{-- url('password.request') --}}">Elfelejtetted a jelszavad?</a><br>
        <a href="{{-- url('register') --}}" class="text-center">
            Regisztráljon egy új tagságot
        </a>
        -->
        </div>
        <!-- /.login-box-body -->
    </div>

@endsection
