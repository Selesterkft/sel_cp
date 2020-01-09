@extends('layouts.app')
@section('title', __('global.version.title'))

@section('content')

    <section class="content-header">
        <h1>
            {{ __('global.version.title') }}
            <small>{{ __('global.version.sub_title') }}</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('/') }}">
                    <i class="fa fa-dashboard"></i>&nbsp;
                    {{ __('global.app_dashboard') }}
                </a>
            </li>

            <li>
                <a href="{{ url('versions') }}">
                    <i class="fa fa-files-o"></i>&nbsp;
                    {{ __('global.versions.title') }}
                </a>
            </li>

            <li class="active">
                <i class="fa fa-file-text-o"></i>&nbsp;
                {{ __('global.version.title') }}
            </li>

        </ol>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-md-12">

                {!! Form::model('', [
                    'method' => 'PUT',
                    'url' => ['versions.update', $version],
                    'id' => 'frm',
                    'name' => 'frm',
                    'class' => 'form-horizontal',
                ]) !!}

                <div class="box box-default">
                    <div class="box-header">
                        <h3 class="box-title">{{ __('global.version.edit_title') }}</h3>
                    </div>

                    <div class="box-body">

                        <input type="hidden" id="ID" name="ID" value="{{ $version->ID }}">

                        <div class="form-group {{ ($errors->has('Version')) ? 'has-error' : '' }}">
                            <label for="Version" class="col-sm-2 control-label">
                                {{ __('global.version.fields.version') }}:
                            </label>
                            <div class="col-sm-10">
                                <input id="Version" name="Version" class="form-control"
                                       type="text"
                                       value="{{ (old('Version')) ? old('Version') : $version->Version }}"/>
                                <span id="span_Version" name="span_Version" class="help-block">
                                    {{ ($errors->has('Version')) ? $errors->first('Version') : '' }}
                                </span>
                            </div>
                        </div>

                        <div class="form-group {{ ($errors->has('Active')) ? 'has-error' : '' }}">
                            <label for="Version" class="col-sm-2 control-label">
                                {{ __('global.version.fields.active') }}:
                            </label>
                            <div class="col-sm-10">
                                <label>
                                    @php
                                    $checked = '';
                                    if( $version->Active == 1 )
                                    {
                                        $checked = 'checked';
                                    }
                                    @endphp
                                    <input id="Active" name="Active" class="minimal"
                                           style="margin-left: 5px;margin-top: 10px;"
                                           type="checkbox" value="1" {{ $checked }}>
                                </label>
                            </div>
                        </div>

                    </div>

                    <div class="box-footer">
                        <a href="{{ url('versions') }}" class="btn btn-default">
                            <i class="fa fa-chevron-left"></i>&nbsp;
                            {{ __('global.app_cancel') }}
                        </a>
                        <button type="submit" class="btn btn-info pull-right">
                            <i class="fa fa-save"></i>&nbsp;
                            {{ __('global.app_save') }}
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
         var $iCheck = $('input[type="checkbox"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue'
        })

        //$iCheck.iCheck('check');
    </script>

@endsection
