@extends('layouts.app')
@section('title', trans('translations.title'))
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
                <i class="fa fa-language"></i>&nbsp;{{ trans('translations.title') }}
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
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            {{ trans('app.search') }}
                        </h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <form id="frmTranslation" name="frmTranslation" action="{{ url('translations') . '/' . $language }}" method="get">
                                <div class="col-xs-5">
                                    {{--<input type="text" class="form-control" placeholder=".col-xs-3">--}}
                                    @include('vendor.translation.forms.search', ['name' => 'filter', 'value' => Request::get('filter')])
                                </div>
                                <div class="col-xs-3">
                                    @include('vendor.translation.forms.select', ['name' => 'language', 'items' => $languages, 'submit' => true, 'selected' => $language])
                                </div>
                                <div class="col-xs-2">
                                    @include('vendor.translation.forms.select', ['name' => 'group', 'items' => $groups, 'submit' => true, 'selected' => Request::get('group'), 'optional' => true])
                                </div>
                                <div class="col-xs-2">
                                    <a href="{{ url('translations/create', $language) }}" class="btn btn-default">{{ trans('app.add') }}</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            {{ trans('translations.title') }}
                        </h3>
                    </div>
                    <div class="box-body with-border">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>{{ trans('app.id') }}</th>
                                <th>{{ trans('language.locale') }}</th>
                                <th>{{ trans('translation.namespace') }}</th>
                                <th>{{ trans('translation.group') }}</th>
                                <th>{{ trans('translation.item') }}</th>
                                <th>{{ trans('translation.text') }}</th>
                                <th>{{ trans('translation.unstable') }}</th>
                                <th>{{ trans('translation.locked') }}</th>
                                <th>{{ trans('app.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($translations as $translation)
                                <tr>
                                    <td>{{ $translation->id }}</td>
                                    <td>{{ $translation->locale }}</td>
                                    <td>{{ $translation->namespace }}</td>
                                    <td>{{ $translation->group }}</td>
                                    <td>{{ $translation->item }}</td>
                                    <td>{{ $translation->text }}</td>
                                    <td>{{ $translation->unstable }}</td>
                                    <td>{{ $translation->locked }}</td>
                                    <td>
                                        <a href="{{ url('translations') . '/' . $language . '/' . $translation->id}}"
                                           class="btn btn-default">
                                            {{ trans('app.edit') }}
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
@section('js')
    <script>
        $(document).ready(function()
        {
            $('select').on('change', function()
            {
                $('#frmTranslation').submit();
            });
        });
    </script>
@endsection
