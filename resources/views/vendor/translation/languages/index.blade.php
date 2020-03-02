@extends('layouts.app')
@section('title', trans('languages.title'))
@section('content')
    <section class="content-header">
        <h1>
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
                <i class="fa fa-language"></i>&nbsp;{{ trans('languages.title') }}
            </li>

        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                @includeIf('layouts.notifications')
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <div class="box-header with-border with-border-radius">
                        <h3 class="box-title">
                            {{ trans('languages.title') }}
                        </h3>

                        <div class="box-tools pull-right">
                            <a class="btn btn-xs btn-success"
                               href="{{ url('languages.create') }}">
                                {{ trans('app.add') }}
                            </a>
                        </div>

                    </div>
                    <div class="box-body with-border with-border-radius">

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>{{ trans('app.name') }}</th>
                                    <th>{{ trans('language.locale') }}</th>
                                    <th>{{ trans('app.percent') }}</th>
                                    <th>{{ trans('app.actions') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $model = new Waavi\Translation\Models\Language();
                                    $lr = new Waavi\Translation\Repositories\LanguageRepository($model, app());
                                @endphp
                                @foreach($languages as $language)
                                    <tr>
                                        <td>{{ $language->name }}</td>
                                        <td>{{ $language->locale }}</td>
                                        <td>{{ $lr->percentTranslated($language->locale) }}</td>
                                        <td>
                                            <a class="btn btn-default" href="{{ url('translations',  $language->locale)}}">
                                                {{ trans('translations.title') }}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection
