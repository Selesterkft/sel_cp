@extends(session()->get('design').'.layouts.app')

@section('title', trans('app.new_connection'))

@section('content-header')
    <section class="content-header">
        <h1>&nbsp;
            {{-- trans('app.new_connection') --}}
            <small>&nbsp;</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('/') }}">
                    <i class="fa fa-dashboard"></i>&nbsp;
                    {{ trans('app.dashboard') }}
                </a>
            </li>

            <li class="active">
                <i class="fa fa-user"></i>&nbsp;{{ trans('app.new_connection') }}
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

                <form class="form-horizontal"
                      action="{{ url('company_design.store') }}"
                      method="POST">
                    @csrf

                    <div class="box box-default">

                        <div class="box-header with-border">
                            <h3 class="box-title">{{ trans('app.new_connection') }}</h3>
                            <small>&nbsp;</small>
                        </div>

                        <div class="box-body">

                            {{-- COMPANIES --}}
                            <div class="form-group {{ ($errors->has('company_id')) ? 'has-error' : '' }}">
                                <label for="company_id" class="col-sm-2 control-label">{{ trans('app.company') }}:</label>
                                <div class="col-sm-10">
                                    {{--<select id="company_id" name="company_id" class="form-control"></select>--}}
                                    {!! Form::select('company_id', $companies,
                                        [],
                                        ['class' => 'form-control'])
                                    !!}
                                </div>
                            </div>

                            {{-- DESIGNS --}}
                            <div class="form-group {{ ($errors->has('design')) ? 'has-error' : '' }}">
                                <label for="design" class="col-sm-2 control-label">{{ trans('app.design') }}:</label>
                                <div class="col-sm-10">
                                    {{--<select id="design" name="design" class="form-control"></select>--}}
                                    {!! Form::select('design', $designs,
                                        [],
                                        ['class' => 'form-control'])
                                    !!}
                                </div>
                            </div>

                        </div>

                        <div class="box-footer">
                            <a href="{{ url('versions') }}"
                               class="btn btn-warning">
                                {{ trans('app.cancel') }}
                            </a>
                            <button type="submit" class="btn btn-info pull-right" style="margin-left: 10px;">
                                {{ trans('app.save') }}
                            </button>
                        </div>

                    </div>

                </form>

            </div>
        </div>

    </section>
@endsection
