@extends('adminlte.layouts.app')

@section('title', 'Table Editor')

@section('content-header')

    <section class='content-header'>
        <h1>
            {{ trans('table_editor.title') }}
            <small>
                {{-- trans('stocks.sub_title') --}}
                {{--@if( $query_name != '' )
                    ({{ $query_name }})
                @endif--}}
            </small>
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
                {{ trans('table_editor.title') }}
            </li>
        </ol>

    </section>

@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            {{ trans('table_editor.title') }}
                        </h3>
                    </div>
                    <div class="box-body"></div>
                    <div class="box-footer"></div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            {{ trans('table_editor.title') }}
                        </h3>
                    </div>
                    <div class="box-body"></div>
                    <div class="box-footer"></div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('css')@endsection

@section('js')@endsection
