@extends('layouts.app')

@section('title', __('global.company_version.edit_title') )

@section('content')
    <section class="content-header">
        <h1>
            {{ __('global.company_version.edit_title') }}
            <small>{{ __('global.company_version.edit_subtitle') }}</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('/') }}">
                    <i class="fa fa-dashboard"></i>&nbsp;
                    @lang('global.app_dashboard')
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
                {{ __('global.company_version.edit_title') }}
            </li>

        </ol>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-sm-12">

                {!! Form::model('', [
                    'method' => 'PUT',
                    'url' => ['version_company.update', $vc],
                    'id' => 'frm',
                    'name' => 'frm',
                    'class' => 'form-horizontal',
                ]) !!}

                <div class="box box-default">

                    <div class="box-header">
                        <h3 class="box-title">
                            {{ __('global.company_version.edit_title') }}
                        </h3>
                    </div>

                    <div class="box-body">
                    <!--
                            <div class="form-group {{-- ($errors->has('CompanyID')) ? 'has-error' : '' --}}">
                                <label for="CompanyID" class="col-sm-2 control-label">{{-- __('global.company_version.fields.company') --}}:</label>
                                <div class="col-sm-10">
                                    <input id="CompanyID" name="CompanyID" class="form-control" type="text"/>
                                    <span id="span_CompanyID" name="span_CompanyID" class="help-block">
                                        {{-- ($errors->has('CompanyID')) ? $errors->first('CompanyID') : '' --}}
                            </span>
                        </div>
                    </div>
-->
                        <input type="hidden" id="ID" name="ID" value="{{ $vc->ID }}">
                        <div class="form-group {{ ($errors->has('CompanyID')) ? 'has-error' : '' }}">
                            <label for="CompanyID" class="col-sm-2 control-label">{{ __('global.versions.fields.company') }}:</label>
                            <div class="col-sm-10">
                                <!--
                                <input id="CompanyID" name="CompanyID" class="form-control" type="text"/>
                                -->
                                {{ Form::select(
                                    'CompanyID',
                                    $companies,
                                    (old('CompanyID')) ? old('CompanyID') : $vc->CompanyID, [
                                        'class' => 'form-control',
                                        'id' => 'CompanyID'
                                ]) }}
                                <span id="span_CompanyID" name="span_CompanyID" class="help-block">
                                    {{ ($errors->has('CompanyID')) ? $errors->first('CompanyID') : '' }}
                                </span>
                            </div>
                        </div>

                        <div class="form-group {{ ($errors->has('VersionID')) ? 'has-error' : '' }}">
                            <label for="VersionID" class="col-sm-2 control-label">
                                {{ __('global.versions.fields.version') }}:
                            </label>
                            <div class="col-sm-10">
                                {{ Form::select('VersionID',
                                    $versions,
                                    (old('VersionID')) ? old('VersionID') : $vc->VersionID, [
                                        'class' => 'form-control',
                                        'id' => 'VersionID',
                                ]) }}
                                <span id="span_VersionID" name="span_VersionID" class="help-block">
                                    {{ ($errors->has('VersionID')) ? $errors->first('VersionID') : '' }}
                                </span>
                            </div>
                        </div>

                        <div class="form-group {{ ($errors->has('Active')) ? 'has-error' : '' }}">
                            <label for="Active" class="col-sm-2 control-label">{{ __('global.versions.fields.active') }}:</label>
                            <div class="col-sm-10">
                                <label>
                                    @php
                                    $checked = '';
                                    if( $vc->Active == 1 )
                                    {
                                        $checked = 'checked';
                                    }
                                    @endphp
                                    <input id="Active" name="Active"
                                           class="minimal"
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

                </form>

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
