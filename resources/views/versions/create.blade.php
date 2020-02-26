@extends('layouts.app')
@section('title', trans('versions.create_sub_title'))

@section('content')

    <section class="content-header">
        <h1>
            {{ trans('versions.version') }}
            <small>{{ trans('versions.create_sub_title') }}</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('/') }}">
                    <i class="fa fa-dashboard"></i>&nbsp;
                    {{ trans('app.dashboard') }}
                </a>
            </li>

            <li>
                <a href="{{ url('versions') }}">
                    <i class="fa fa-files-o"></i>&nbsp;
                    {{ trans('versions.title') }}
                </a>
            </li>

            <li class="active">
                <i class="fa fa-file-text-o"></i>&nbsp;
                {{ trans('versions.create_sub_title') }}
            </li>

        </ol>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-md-12">

                {!! Form::open([
                    'method' => 'POST',
                    'url' => 'versions.store',
                    'id' => 'frm',
                    'name' => 'frm',
                    'class' => 'form-horizontal',
                ]) !!}

                <div class="box box-default">
                    <div class="box-header">
                        <h3 class="box-title">{{ trans('versions.create_sub_title') }}</h3>
                    </div>

                    <div class="box-body">

                        <div class="form-group {{ ($errors->has('Version')) ? 'has-error' : '' }}">
                            <label for="Version" class="col-sm-2 control-label">
                                {{ trans('versions.version') }}:
                            </label>
                            <div class="col-sm-10">
                                <input id="Version" name="Version" class="form-control" type="text"
                                       value="{{ old('Version') }}"/>
                                <span id="span_Version" name="span_Version" class="help-block">
                                    {{ ($errors->has('Version')) ? $errors->first('Version') : '' }}
                                </span>
                            </div>
                        </div>

                        <div class="form-group {{ ($errors->has('Active')) ? 'has-error' : '' }}">
                            <label for="Version" class="col-sm-2 control-label">
                                {{ trans('app.active') }}:
                            </label>
                            <div class="col-sm-10">
                                <label>
                                    <input id="Active" name="Active"
                                           class="minimal"
                                           type="checkbox" value="1">
                                </label>
                            </div>
                        </div>

                    </div>

                    <div class="box-footer">
                        <a href="{{ url('versions') }}" class="btn btn-default">
                            <i class="fa fa-chevron-left"></i>&nbsp;
                            {{ trans('app.cancel') }}
                        </a>
                        <button type="submit" class="btn btn-info pull-right">
                            <i class="fa fa-save"></i>&nbsp;
                            {{ trans('app.save') }}
                        </button>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>

    </section>

@endsection

@section('css')
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/iCheck/all.css') }}">
@php
echo "<!-- BACGROUND COLOR -->\n";
echo "<style>.skin-blue .main-sidebar, .skin-blue .left-side {background-color: " . \App\Classes\Helper::getMenuBgColor() . ";}</style>\n";
echo "<!-- HEADER BG COLOR -->\n";
$header_bg_color = \App\Classes\Helper::getHeaderBgColor();
echo "<style>.skin-blue .main-header .navbar {background-color: " . $header_bg_color . ";}</style>\n";
echo "<style>.skin-blue .main-header .logo {background-color: " . $header_bg_color . ";}</style>\n";

echo "<!-- PANEL AND TAB COLOR -->\n";
echo "<style>.box.box-default {border-top-color: " . \App\Classes\Helper::getPanelTabLineColor() . ";}</style>\n";
@endphp
@endsection

@section('js')
    <!-- iCheck 1.0.1 -->
    <script src="{{ asset('assets/plugins/iCheck/icheck.js') }}"></script>

    <script>
        $('input[type="checkbox"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue'
        })
    </script>

@endsection
