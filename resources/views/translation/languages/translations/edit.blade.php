@extends('layouts.app')
@section('title', trans('translations.edit'))
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

            <li>
                <a href="{{ url('translations', $language) }}">
                    <i class="fa fa-language"></i>&nbsp;{{ trans('translations.title') }}
                </a>
            </li>

            <li class="active">
                <i class="fa fa-language"></i>&nbsp;{{ trans('translations.edit') }}
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
                <form action="{{ url('translations/update', ['language' => $language, 'id' => $translation->id]) }}" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    @csrf

                    <input type="hidden" id="locale" name="locale" value="{{ $language }}">
                    <input type="hidden" id="unstable" name="unstable" value="{{ $translation->unstable }}">
                    <input type="hidden" id="locked" name="locked" value="{{ $translation->locked }}">
                    <input type="hidden" id="id" name="id" value="{{ $translation->id }}">

                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                {{ trans('translations.edit') }}
                            </h3>
                        </div>
                        <div class="box-body with-border">

                            @include('vendor.translation.forms.text', [
                                'field' => 'group',
                                'label' => trans('translations.group_label'),
                                'placeholder' => trans('translations.group_placeholder'),
                                'value' => $translation->group,
                                'disabled' => ''
                            ])

                            @include('vendor.translation.forms.text', [
                                'field' => 'item',
                                'label' => trans('translations.item_label'),
                                'placeholder' => trans('translations.item_placeholder'),
                                'value' => $translation->item,
                                'disabled' => ''
                            ])

                            @include('vendor.translation.forms.text', [
                                'field' => 'text',
                                'label' => trans('translations.text_label'),
                                'placeholder' => trans('translations.text_placeholder'),
                                'value' => $translation->text,
                            ])

                            @include('vendor.translation.forms.text', [
                                'field' => 'namespace',
                                'label' => trans('translations.namespace_label'),
                                'placeholder' => trans('translations.namespace_placeholder'),
                                'value' => $translation->namespace,
                                'disabled' => ''
                            ])
                        </div>
                        <div class="panel-footer">

                            <a href="{{ url()->previous() }}"
                               class="btn btn-warning">
                                {{ trans('app.back_to_list') }}
                            </a>
                            <button type="submit" class="btn btn-success pull-right">
                                {{ trans('app.save') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </section>

@endsection
