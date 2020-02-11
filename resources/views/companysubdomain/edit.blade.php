@extends('layouts.app')
@section('title', __('global.company_subdomain.title'))

@section('content')

<section class="content-header">
    <h1>
        {{ __('global.company_subdomain.title') }}
        <small>{{ __('global.company_subdomain.sub_title') }}</small>
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ url('/') }}">
                <i class="fa fa-dashboard"></i>&nbsp;
                {{ __('global.app_dashboard') }}
            </a>
        </li>

        <li>
            <a href="{{ url('companysubdomain') }}">
                <i class="fa fa-users"></i>&nbsp;{{ __('global.company_subdomain.menu_title') }}
            </a>
        </li>

        <li class="active">
            <i class="fa fa-user"></i>&nbsp;{{ __('global.company_subdomain.title') }}
        </li>

    </ol>
</section>

<section class="content">

    <div class="row">
        <div class="col-md-12">

            @if( session()->has('success') )

                @includeIf('layouts.success', ['messages' => session()->get('success') ])

            @elseif( session()->has('errors') )

                @includeIf('layouts.alert', ['messages' => session()->get('errors')] )

            @endif

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <form id="frm" name="frm"
                  action="{{ url('companysubdomain.store') }}"
                  method="POST" class="form-horizontal">
                @csrf

                <div class="box box-default">

                    <div class="box-header with-border">
                        <h3 class="box-title">{{ __('global.company_subdomain.title') }}</h3>
                        <small>{{ __('global.company_subdomain.sub_title') }}</small>
                    </div>

                    <div class="box-body">

                        {{-- COMPANIES --}}
                        <div class="form-group {{ ($errors->has('CompanyID')) ? 'has-error' : '' }}">
                            {{ Form::label('CompanyID',
                                __('global.company_subdomain.fields.company') . ':',
                                ['class' => 'col-sm-2 control-label']) }}
                            <div class="col-sm-10">
                                {!! Form::select(
                                    'CompanyID',
                                    $companies,
                                    (old('CompanyID')) ? old('CompanyID') : $cs->CompanyID,
                                    ['class' => 'form-control'])
                                !!}
                                <span id="span_company_id" name="span_company_id" class="help-block">
                                    {{ ($errors->has('CompanyID')) ? $errors->first('CompanyID') : '' }}
                                </span>
                            </div>
                        </div>

                        {{-- SUBDOMAIN --}}
                        <div class="form-group {{ ($errors->has('SubdomainName')) ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label" for="SubdomainName">{{ __('global.company_subdomain.fields.subdomain') }}:</label>
                            <div class="col-sm-10">
                                <input id="SubdomainName" name="SubdomainName" class="form-control" type="text"
                                       value="{{ (old('SubdomainName')) ? old('SubdomainName') : $cs->SubdomainName }}"/>
                                <span id="span_email" name="span_email" class="help-block">
                                    {{ ($errors->has('SubdomainName')) ? $errors->first('SubdomainName') : '' }}
                                </span>
                            </div>
                        </div>

                    </div>

                    <div class="box-footer">
                        <div class="box-footer">
                        <a href="{{ url('versions') }}"
                           class="btn btn-default">
                            {{ __('global.app_cancel') }}
                        </a>
                        <button type="submit" class="btn btn-info pull-right" style="margin-left: 10px;">
                            {{ __('global.app_save') }}
                        </button>
                    </div>
                    </div>

                </div>

            </form>
        </div>
    </div>
</section>

@endsection
