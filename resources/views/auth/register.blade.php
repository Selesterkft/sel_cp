<!DOCTYPE html>
<html>
<head>

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

    <title>{{ config('appConfig.appSortName') }} | @lang('global.register.title')</title>

    <!-- Bootstrap 3.3.7 -->
    <link href="{{ asset('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <style>
        body {
            height: 100%;
            overflow: hidden;
            width: 100% !important;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }

        .backRight {
            position: absolute;
            right: 0;
            width: 50%;
            height: 100%;
            background: #e74c3c url(https://download.unsplash.com/photo-1428279148693-1cf2163ed67d);
            background-size: cover;
            background-position: 50% 50%;
        }

        .backLeft {
            position: absolute;
            left: 0;
            width: 50%;
            height: 100%;
            background: #3498db url(https://download.unsplash.com/photo-1429041966141-44d228a42775);
            background-size: cover;
            background-position: 50% 50%;
        }

        #back {
            width: 100%;
            height: 100%;
            position: absolute;
            z-index: -999;
        }

        #slideBox {
            width: 50%;
            max-height: 100%;
            height: 100%;
            overflow: hidden;
            margin-left: 50%;
            position: absolute;
            box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
        }
        .topLayer {
            width: 200%;
            height: 100%;
            position: relative;
            left: 0;
            left: -100%;
        }

        .left {
            width: 50%;
            height: 100%;
            background: #2C3034;
            left: 0;
            position: absolute;
        }

        .right {
            width: 50%;
            height: 100%;
            background: #f9f9f9;
            right: 0;
            position: absolute;
        }

        .content {
            width: 250px;
            margin: 0 auto;
            top: 20%;
            position: absolute;
            left: 50%;
            margin-left: -125px;
        }

        .content h2 {
            color: #03A9F4;
            font-weight: 300;
            font-size: 35px;
        }
        /*
        button {
            background: #03A9F4;
            padding: 10px 16px;
            width: auto;
            font-weight: 600;
            text-transform:  uppercase;
            font-size: 14px;
            color: #fff;
            line-height: 16px;
            letter-spacing: 0.5px;
            border-radius: 2px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1), 0 3px 6px rgba(0,0,0,0.1);
            border: 0;
            outline: 0;
            margin: 15px 15px 15px 0;
            transition: all 0.25s;
        }

        button:hover {
            background: #0288D1;
            box-shadow: 0 4px 7px rgba(0,0,0,0.1), 0 3px 6px rgba(0,0,0,0.1);
        }
        */
        .off {
            background: none;
            color: #03A9F4;
            box-shadow: none;
        }

        .right .off:hover {
            background: #eee;
            color: #03A9F4;
            box-shadow: none;
        }
        .left .off:hover {
            box-shadow: none;
            color: #03A9F4;
            background: #363A3D;
        }
        /*
        input {
            background: transparent;
            border: 0;
            outline: 0;
            border-bottom: 1px solid #45494C;
            font-size: 14px;
            color: #959595;
            padding: 8px 0;
            margin-top: 20px;
        }
        */
    </style>

</head>
<body>

<div>

</div>

<div id="back">
    <div class="backRight"></div>
    <div class="backLeft"></div>
</div>

<div id="slideBox">
    <div class="topLayer">
        <div class="left">

        </div>

        <div class="right">
            <div class="content">

                <h2>@lang('global.register.title')</h2>

                <form id="frmLogin" name="frmLogin"
                      class="form-horizontal" role="form" method="POST"
                      action="{{ route('register') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="name" class="form-label">
                            @lang('global.app_name')
                        </label>
                        <input id="name" name="name"
                               class="form-control" type="text"
                               style="margin-top: 0px;"/>
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">
                            @lang('global.register.fields.email')
                        </label>
                        <input id="email" name="email"
                               class="form-control" type="text"
                               style="margin-top: 0px;"/>
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">
                            @lang('global.register.fields.password')
                        </label>
                        <input id="password" name="password"
                               class="form-control" type="password"
                               style="margin-top: 0px;"/>
                    </div>

                    <div class="form-group">
                        <label for="password-confirm" class="form-label">
                            @lang('global.register.fields.password_confirm')
                        </label>
                        <input id="password-confirm" name="password-confirm"
                               class="form-control" type="password"
                               style="margin-top: 0px;"/>
                    </div>

                    <a href="{{ route('login') }}"
                       id="login" name="login"
                       class="btn btn-success">
                        @lang('global.login.title')
                    </a>

                    <button id="register" name="register" type="submit"
                            class="btn btn-primary"
                            style="margin-top: 0px;margin-left: 10px;">
                        @lang('global.register.title')
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>

</body>
</html>