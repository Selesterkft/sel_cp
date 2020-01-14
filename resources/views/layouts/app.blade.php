@php

$locale = (session()->has('locale')) ? session()->get('locale') : config('app.locale');
//dd('app.blade', session()->get('locale'), config('app.locale'));
@endphp

<!DOCTYPE html>
<html lang="{{ $locale }}" locale="{{ $locale }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- FAVICONS -->
    <link href="{{ \App\Classes\Helper::getFavicon() }}" rel="shortcut icon" type="image/x-icon" sizes="32x32"/>
<!--
    <meta property="og:image" content="{{ asset('assets/dist/img/facebook-thumb.png') }}"/>
    <link rel="image_src" href="{{ asset('assets/dist/img/facebook-thumb.png') }}"/>
-->
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@lang('global.global_sort_title') | @yield('title')</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap v3.4.1 -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/skins/_all-skins.min.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <!--[endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

@yield('css')

<!-- jQuery 3 -->
    {{--<script src="{{ asset('assets/bower_components/jquery/dist/jquery.min.js') }}"></script>--}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="{{ url('/') }}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <!--<span class="logo-mini"><b>A</b>LT</span>-->
            <span class="logo-mini">@lang('global.global_sort_title')</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">@lang('global.global_title')</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle"
               data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <div class="navbar-custom-menu">

                <ul class="nav navbar-nav">

                @includeIf('layouts.dropdown.dropdown_language-menu')

                <!-- Messages: style can be found in dropdown.less-->
                {{--@includeIf($company . '.layouts.dropdown.dropdown_message-menu')--}}

                <!-- Notifications: style can be found in dropdown.less -->
                {{--@includeIf($company . '.layouts.dropdown.dropdown_notifications-menu')--}}

                <!-- Tasks: style can be found in dropdown.less -->
                {{--@includeIf($company . '.layouts.dropdown.dropdown_task-menu')--}}

                <!-- User Account: style can be found in dropdown.less -->

                @includeIf('layouts.dropdown.dropdown_user-menu')

                <!-- Control Sidebar Toggle Button -->
                    <!--<li>
                        <a href="#" data-toggle="control-sidebar">
                            <i class="fa fa-gears"></i>
                        </a>
                    </li>-->
                </ul>
            </div>
        </nav>
    </header>
    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->
    @include('layouts.main-sidebar')
    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        @yield('content')

    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>{{ __('global.version.title') }}:</b>&nbsp;{{ session()->get('version') }}
        </div>
        <strong>
            {{ __('global.app_copyright_1') }}&nbsp;<a href="http://selester.hu" target="_blank">Selester Kft</a>
        </strong>{{ __('global.app_copyright_2') }}
        <!--
        <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights reserved.
        -->
    </footer>

    <!-- Control Sidebar -->
    {{-- @include('layouts.control_sidebar') --}}
    <!-- /.control-sidebar -->

    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- Bootstrap v3.4.1 -->
{{--<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.js"></script>

<!-- SlimScroll -->
<script src="{{ asset('assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('assets/bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('assets/dist/js/demo.js') }}"></script>

@yield('js')

<script>
    $(document).ready(function ()
    {
        if( $('.alert-success').length > 0 )
        {
            setTimeout(function()
            {
                $('.alert').fadeOut();
            }, 3000);
        }
    })
</script>
{{--
<script type="text/javascript">
    /**
     * https://stackoverflow.com/questions/31449434/handling-expired-token-in-laravel
     */
    var csrfToken = $('[name="csrf_token"]').attr('content');

    setInterval(refreshToken, 3600000); // 1 hour

    function refreshToken(){
        $.get('refresh-csrf').done(function(data){
            csrfToken = data; // the new token
        });
    }

    setInterval(refreshToken, 3600000); // 1 hour

</script>
--}}
</body>
</html>
