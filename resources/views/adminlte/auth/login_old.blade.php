<?php
$subdomain = \App\Classes\Helper::getAppSubdomain();
$company_id = \App\Classes\Helper::getCompanyIDByCompanyNickName($subdomain);

if( $company_id == null )
{
?>
<script type="text/javascript">
    //window.location.href = "http://webandtrace.com";
    window.location.href = "http://google.hu";
</script>
<?php
}
$wallpaper = \App\Classes\Helper::getWallpaper($company_id);
$bgColor = \App\Classes\Helper::getLoginBgColor($company_id);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="{{ asset('adminlte/dist/img/favicon.png') }}" rel="shortcut icon" type="image/x-icon"/>
    <meta property="og:image" content="{{ asset('adminlte/dist/img/facebook-thumb.png') }}"/>
    <link rel="image_src" href="{{ asset('adminlte/dist/img/facebook-thumb.png') }}"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ trans('app.sort_title') }} | {{ trans('users.login') }}</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap 3.3.7 -->
    <link href="{{ asset('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/font-awesome/dist/css/font-awesome.min.css') }}">

    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/Ionicons/dist/css/ionicons.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css') }}">

    <style>
        .login-page  {
            background-image: url("{{ $wallpaper }}");
            background-size: cover;
            background-color: "{{ $bgColor }}";
        }
    </style>

    <!-- iCheck -->
    <!--<link rel="stylesheet" href="../../plugins/iCheck/square/blue.css">-->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/iCheck/square/blue.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="{{ asset('assets/bower_components/html5shiv/3.7.3/dist/html5shiv.min.js') }}"></script>
    <script src="{{ asset('assets/bower_components/respond/1.4.2/respond.min.js') }}"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!--<link rel="stylesheet" href="{{ asset('assets/dist/css/fonts/css.css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic') }}">-->

    <!-- jQuery 3 -->
    <script src="{{ asset('assets/bower_components/jquery/dist/jquery.min.js') }}"></script>

</head>
<body class="hold-transition login-page">

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
                       value="{{ \App\Classes\Helper::getAppSubdomain() }}"/>
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
<!-- /.login-box -->

<!-- jQuery 3 -->
<!--<script src="../../bower_components/jquery/dist/jquery.min.js"></script>-->
<!-- Bootstrap 3.3.7 -->
<!--<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>-->
<script src="{{ asset('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- iCheck -->
<!--<script src="../../plugins/iCheck/icheck.min.js"></script>-->
<script src="{{ asset('adminlte/plugins/iCheck/icheck.min.js') }}"></script>
<script>

    //var loc = window.location;
    //var sub_domain = loc.toString().split('.')[0].split('//')[1];

    //console.log(loc);
    //console.log(sub_domain);

    //document.getElementById('company').value = sub_domain;

    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });
    });
</script>
</body>
</html>
