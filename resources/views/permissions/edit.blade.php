@extends(session()->get('design').'.layouts.app')

@section('title', trans('permissions.title'))

@section('content-header')
    <section class="content-header">
        <h1>
            {{ trans('permissions.title') }}
            <small>{{ trans('permissions.create_sub_title') }}</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('/') }}">
                    <i class="fa fa-dashboard"></i>&nbsp;
                    {{ trans('app.dashboard') }}
                </a>
            </li>

            <li>
                <a href="{{ url('permissions') }}">
                    <i class="fa fa-files-o"></i>&nbsp;
                    {{ trans('permissions.title') }}
                </a>
            </li>

            <li class="active">
                <i class="fa fa-file-text-o"></i>&nbsp;
                {{ trans('permissions.create_sub_title') }}
            </li>

        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <form id="frm" name="frm" method="POST" class="form-horizontal"
                      action="{{ url('permissions.store', ['id' => $permission->id]) }}">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">

                    <input type="hidden" id="id" name="id"
                           value="{{ $permission->id }}">

                    <div class="box box-default">
                        <div class="box-header">
                            {{--<h3 class="box-title">
                                {{ trans('app.add_new') }}
                            </h3>--}}
                        </div>

                        <div class="box-body">

                            <div class="form-group {{ ($errors->has('name')) ? 'has-error' : '' }}">
                                <label for="name" class="col-sm-2 control-label">
                                    {{ trans('app.name') }}:
                                </label>
                                <div class="col-sm-10">
                                    <input id="name" name="name"
                                           class="form-control"
                                           type="text"
                                           value="{{ $permission->name }}"/>

                                    <span id="span_name" name="span_name"
                                          class="help-block">
                                        {{ ($errors->has('name')) ? $errors->first('name') : '' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="box-footer">
                            <a href="{{ url('permissions') }}"
                               class="btn btn-warning">{{ trans('app.cancel') }}</a>
                            <button type="submit" class="btn btn-info pull-right">
                                {{ trans('app.save') }}
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </section>
@endsection
