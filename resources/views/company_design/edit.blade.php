@extends(session()->get('design') . '.layouts.app')

@section('title', trans('company_design.edit_title'))

@section('content-header')
    <section class="content-header">
        <h1>
            &nbsp;
            <small>&nbsp;</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('/') }}">
                    <i class="fa fa-dashboard"></i>&nbsp;
                    {{ trans('app.dashboard') }}
                </a>
            </li>

            {{--<li>
                <a href="{{ url('companysubdomain') }}">
                    <i class="fa fa-users"></i>&nbsp;{{ trans('company_design.title') }}
                </a>
            </li>--}}

            <li class="active">
                <i class="fa fa-user"></i>
                {{ trans('company_design.edit_title') }}
            </li>

        </ol>
    </section>
@endsection

@section('content')
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
                      action="{{ url('company_design.update', ['id' => $company_design->id]) }}"
                      method="POST" class="form-horizontal">
                    <input type="hidden" name="_method" value="PUT"/>
                    @csrf

                    <div class="box box-default">

                        <div class="box-header with-border">
                            <h3 class="box-title">{{ trans('company_design.edit_title') }}</h3>
                            <small>&nbsp;</small>
                        </div>

                        <div class="box-body">

                            <input type="hidden" id="id" name="id" value="{{ $company_design->id }}">

                            {{-- COMPANIES --}}
                            <input type="hidden" id="company_id" name="company_id" value="{{ $company_design->company_id }}">
                            <div class="form-group {{ ($errors->has('company_id')) ? 'has-error' : '' }}">
                                <label for="company_id" class="col-sm-2 control-label">{{ trans('app.company') }}:</label>
                                <div class="col-sm-10">
                                    {!! Form::select('', $companies,
                                        (old('company_id')) ? old('company_id') : $company_design->company_id,
                                        ['class' => 'form-control', 'disabled'])
                                    !!}
                                    <span class="help-block">
                                        {{ $errors->has('company_id') ? $errors->first('company_id') : '' }}
                                    </span>
                                </div>
                            </div>

                            {{-- DESIGNS --}}
                            <div class="form-group {{ ($errors->has('design')) ? 'has-error' : '' }}">
                                <label for="design" class="col-sm-2 control-label">{{ trans('app.design') }}:</label>
                                <div class="col-sm-10">
                                    {!! Form::select('design', $designs,
                                        (old('design')) ? old('design') : $company_design->design,
                                        ['class' => 'form-control'])
                                    !!}
                                    <span class="help-block">
                                        {{ $errors->has('design') ? $errors->first('design') : '' }}
                                    </span>
                                </div>
                            </div>

                        </div>

                        <div class="box-footer">
                            <a href="{{ url('versions') }}"
                               class="btn btn-warning">
                                {{ trans('app.cancel') }}
                            </a>
                            <button type="submit" class="btn btn-info pull-right"
                                    style="margin-left: 10px;">
                                {{ trans('app.save') }}
                            </button>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </section>

@endsection
