<?php
use App\Classes\ColorHelper;
use App\Classes\Helper;
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

{{--<link rel="stylesheet" href="{{ asset('assets/dist/css/fonts/css.css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic') }}">--}}

<!-- jQuery 3 -->
    <script src="{{ asset('assets/bower_components/jquery/dist/jquery.min.js') }}"></script>

</head>
<body class="hold-transition login-page">

@yield('content')

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
