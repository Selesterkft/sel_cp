@extends('adminlte.layouts.app')

@section('title', trans('company_settings.title'))

@section('content-header')
    <section class="content-header">
        <h1>
            {{ trans('company_settings.title') }}
            <small></small>
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
                {{ trans('company_settings.title') }}
            </li>

        </ol>
    </section>
@endsection

@section('content')
    <section class="content">

        <div class="row">

            <section class="col-lg-7 connectedSortable">

                @includeIf('settings.company.company_version', [
                    'client_id' => Auth::user()->CompanyID,
                    'version' => session()->get('version'),
                    'companies' => $companies
                ])

                {{--@includeIf('settings.company.company_design')--}}

            </section>

            <section class="col-lg-5 connectedSortable">

                @includeIf('settings.company.versions')

                {{--@includeIf('settings.company.designs')--}}

            </section>

        </div>

    </section>
@endsection

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/vue-toastr-2/dist/vue-toastr-2.min.css">

    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/vue-toastr-2/dist/vue-toastr-2.js"></script>

@endsection

@section('js')

@endsection
