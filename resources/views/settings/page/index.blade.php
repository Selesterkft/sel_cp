@extends('adminlte.layouts.app')

@section('title', trans('company_settings.title'))

@section('content-header')
    <section class="content-header">
        <h1>
            {{ trans('settings.title') }}
            <small>{{ trans('company_settings.sub_title') }}</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('/') }}">
                    <i class="fa fa-dashboard"></i>&nbsp;
                    {{ trans('app.dashboard') }}
                </a>
            </li>

            <li class="active">
                <i class="fa fa-users"></i>&nbsp;
                {{ trans('settings.title') }}
            </li>

        </ol>
    </section>
@endsection

@section('content')
    <section class="content">

        <div class="row">

            <section class="col-lg-7 connectedSortable">

                <div class="box box-default">

                    <div class="box-header with-border">
                        <h3 class="box-title">
                            {{ 'PAGE DESIGNS' }}
                        </h3>
                    </div>

                    <div class="box-body">

                    </div>

                </div>

                {{--<div class="box box-default">

                    <div class="box-header with-border">
                        <h3 class="box-title">
                            {{ 'COMPANY ' }}
                        </h3>
                    </div>

                    <div class="box-body"></div>

                </div>--}}

            </section>

            <section class="col-lg-5 connectedSortable">

                <div class="box box-default">

                    <div class="box-header with-border">
                        <h3 class="box-title">
                            {{ 'DESIGNS' }}
                        </h3>
                    </div>

                    <div class="box-body"></div>

                </div>

                {{--<div class="box box-default">

                    <div class="box-header with-border">
                        <h3 class="box-title">
                            {{ 'VERZIÓK' }}
                        </h3>
                    </div>

                    <div class="box-body"></div>

                </div>--}}

            </section>

        </div>

    </section>
@endsection

@section('css')@endsection

@section('js')@endsection
