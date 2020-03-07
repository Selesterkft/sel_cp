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
                            <form id="frmTranslation" name="frmTranslation"
                                  action="{{ url('translations') . '/' . $language }}"
                                  method="get" onsubmit="afterSubmit()">
                                <div class="col-xs-5">
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
                                <input type="hidden" id="export" name="export" value="0">
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
                        <div class="box-tools">
                            <form class="form-horizontal" action="{{ url('translations/import') }}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <button id="btnExport" name="btnExport" class="btn btn-default btn-sm" style="display:inline;">Export</button>
                                <span class="control-fileupload" style="display:inline;">
                                    <label for="file" style="display:inline;margin-left: 10px;">Fájl kiválasztása :</label>
                                    {{--<input type="file" id="importFile" name="importFile" style="display:inline;">--}}
                                    <input type="file" id="file" name="file" class="form-control">
                                </span>
                                <button id="btnImport" name="btnImport" class="btn btn-default btn-sm" style="display:inline;">Import</button>
                            </form>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    {{--<th>{{ trans('app.id') }}</th>--}}
                                    <th>{{ trans('language.locale') }}</th>
                                    {{--<th>{{ trans('translation.namespace') }}</th>--}}
                                    <th>{{ trans('translations.group') }}</th>
                                    <th>{{ trans('translations.item') }}</th>
                                    <th>{{ trans('translations.text') }}</th>
                                    {{--<th>{{ trans('translation.unstable') }}</th>--}}
                                    {{--<th>{{ trans('translation.locked') }}</th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($translations as $translation)
                                    <tr>
                                        {{--<td>{{ $translation->id }}</td>--}}
                                        <td>{{ $translation->locale }}</td>
                                        {{--<td>{{ $translation->namespace }}</td>--}}
                                        <td>{{ $translation->group }}</td>
                                        <td>{{ $translation->item }}</td>
                                        <td>
                                            <a href="#"
                                               id="text" name="text"
                                               class="editable editable-pre-wrapped editable-click"
                                               data-type="textarea"
                                               data-name="{{ $language }}"
                                               data-pk="{{ $translation->id }}"
                                               data-url="{{ url("api/translations/{$language}/edit") }}"
                                               data-title="Szerkesztés">{{ $translation->text }}</a>
                                        </td>
                                        {{--<td>{{ $translation->unstable }}</td>--}}
                                        {{--<td>{{ $translation->locked }}</td>--}}
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $translations->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection
@section('css')
    <link href="{{ asset('assets/x-editable/bootstrap3-editable/css/bootstrap-editable.css') }}" rel="stylesheet">
@endsection
@section('js')
    <script src="{{ asset('assets/x-editable/bootstrap3-editable/js/bootstrap-editable.js') }}"></script>
    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function()
        {
            $.fn.editable.defaults.mode = 'popup';
        });

        $(document).ready(function()
        {
            $('.editable').editable({
                rows: 10,
                showbuttons: 'bottom',
                emptytext: '{{ trans('app.empty') }}',
                ajaxOptions: {
                    type: 'post',
                    dataType: 'json'
                },
                success: function(response, newValue) {
                    location.reload();
                }
            });

            $('select').on('change', function()
            {
                $('#frmTranslation').submit();
            });

            $('#btnExport').click(function(e)
            {
                e.preventDefault();

                $('#export').val(1);
                $('#frmTranslation').submit();
            });

        });

        function afterSubmit()
        {
            setTimeout(function()
            {
                $('#export').val(0);
            }, 1000);
        }

    </script>
@endsection
