@extends(session()->get('design') . '.layouts.app')

@section('title', trans('stocks.title'))

@section('content-header')
    <section class='content-header'>
        <h1>
            {{ trans('reports.title') }}
            <small>{{ trans('reports.sub_title') }}</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('/') }}">
                    <i class="fa fa-dashboard"></i>&nbsp;
                    {{ trans('app.dashboard') }}
                </a>
            </li>

            <li class="active">
                <i class="fa fa-files-o"></i>&nbsp;
                {{ trans('reports.title') }}
            </li>
        </ol>

    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row">

            <div class="col-sm-12">

                <div class="box box-default">

                    <div class="box-header">
                        <h3 class="box-title">{{ $table_name }}</h3>
                    </div>

                    <div class="box-body">

                        {!! Form::open([
                            'method' => 'POST',
                            'url' => 'reports.store',
                            'id' => 'frm',
                            'name' => 'frm',
                            'class' => 'form-horizontal'
                        ]) !!}

                        @foreach($table_data->Columns as $id => $t_data)

                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">
                                    @php
                                    $title = '';
                                    switch ( strtolower($t_data->title) )
                                    {
                                        case 'id':
                                        $title = trans('app.id');
                                        break;
                                        default:
                                        $title = trans(strtolower("{$table_name}.{$t_data->title}"));
                                        break;
                                    }
                                    @endphp
                                    {{ $title . ':' }}
                                </label>
                                <div class="col-sm-10">
                                    <label style="margin-top: 8px;">
                                        {{ Form::checkbox('fields[]', 'aa', false, ['class' => 'name']) }}
                                    </label>
                                </div>
                            </div>

                        @endforeach

                        {!! Form::close() !!}

                    </div>

                    <div class="box-footer">
                        <a href="#"
                           class="btn btn-warning">{{ trans('app.cancel') }}</a>
                        <button type="submit" class="btn btn-info pull-right">
                            {{ trans('app.save') }}
                        </button>
                    </div>

                </div>

            </div>

        </div>
    </section>
@endsection
