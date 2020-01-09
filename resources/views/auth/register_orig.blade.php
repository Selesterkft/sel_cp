<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- Tell the browser to be responsive to screen width -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta name="description" content="">
<meta name="author" content="">

<link href="{{ asset('assets/dist/img/favicon.png') }}" rel="shortcut icon" type="image/x-icon"/>
<meta property="og:image" content="{{ asset('assets/dist/img/facebook-thumb.png') }}"/>
<link rel="image_src" href="{{ asset('assets/dist/img/facebook-thumb.png') }}"/>

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name') }} | Regisztráció</title>

<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

<!-- Bootstrap 3.3.7 -->
<link href="{{ asset('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">

<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('assets/bower_components/font-awesome/css/font-awesome.min.css') }}">

<!-- Ionicons -->
<link rel="stylesheet" href="{{ asset('assets/bower_components/Ionicons/css/ionicons.min.css') }}">

<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('assets/dist/css/AdminLTE.min.css') }}">

<!-- iCheck -->
<!--<link rel="stylesheet" href="../../plugins/iCheck/square/blue.css">-->
<link rel="stylesheet" href="{{ asset('assets/plugins/iCheck/square/blue.css') }}">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<!--<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>-->
<script src="{{ asset('assets/bower_components/html5shiv/3.7.3/html5shiv.min.js') }}"></script>
<!--<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>-->
<script src="{{ asset('assets/bower_components/respond/1.4.2/respond.min.js') }}"></script>
<![endif]-->

<!-- Google Font -->
<!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">-->
<link rel="stylesheet" href="{{ asset('assets/dist/css/fonts/css.css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic') }}">


<!-- jQuery 3 -->
<script src="{{ asset('assets/bower_components/jquery/dist/jquery.min.js') }}"></script>

</head>
<body class="hold-transition register-page">
<div class="register-box">

    <div class="register-logo">
        <a href="{{ url('/') }}"><b>{{ config('appConfig.appName') }}</a>
    </div>

    <div class="register-box-body">
        <p class="login-box-msg">Regisztráljon egy új tagságot</p>

        <form action="{{ route('register') }}" method="post">
            {{ csrf_field() }}

            <div class="form-group has-feedback {{ ($errors->has('name')) ? 'has-error' : '' }}">
                <input type="text"
                       name="name" id="name"
                       class="form-control"
                       value="{{ old('name') }}"
                       placeholder="Teljes név">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback {{ ($errors->has('email')) ? 'has-error' : '' }}">
                <input id="email" name="email"
                       type="email" value="{{ old('email') }}"
                       class="form-control" placeholder="E-mail">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback {{ ($errors->has('password')) ? 'has-error' : '' }}">
                <input id="password" name="password"
                       type="password" class="form-control"
                       placeholder="Jelszó">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input id="password-confirm" name="password-confirm"
                       type="password" class="form-control"
                       placeholder="Megerősítés">
                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-7">
                    <div class="checkbox icheck">
                        <label>
                            <!--<input type="checkbox"> I agree to the <a href="#">terms</a>-->
                            <input type="checkbox">&nbsp;Egyetértek a <a href="#">feltételekkel</a></input>
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-5">
                    <button type="submit"
                            class="btn btn-primary btn-block btn-flat">
                        Regisztráció
                    </button>
                </div>
                <!-- /.col -->
            </div>
        </form>
<!--
        <div class="social-auth-links text-center">
            <p>- OR -</p>
            <a href="#" class="btn btn-block btn-social btn-facebook btn-flat">
                <i class="fa fa-facebook"></i>&nbsp;Sign up using Facebook
            </a>
            <a href="#" class="btn btn-block btn-social btn-google btn-flat">
                <i class="fa fa-google-plus"></i>&nbsp;Sign up using Google+
            </a>
        </div>
-->
        <a href="{{ route('login') }}" class="text-center">Van tagságom</a>
    </div>
    <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 3 -->
<!--<script src="../../bower_components/jquery/dist/jquery.min.js"></script>-->
<!-- Bootstrap 3.3.7 -->
<!--<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>-->
<script src="{{ asset('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- iCheck -->
<!--<script src="../../plugins/iCheck/icheck.min.js"></script>-->
<script src="{{ asset('assets/plugins/iCheck/icheck.min.js') }}"></script>

<script>
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
