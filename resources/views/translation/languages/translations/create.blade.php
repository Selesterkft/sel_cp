@extends('layouts.app')
@section('title', trans('translations.create'))
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
                <i class="fa fa-language"></i>&nbsp;{{ trans('translations.create') }}
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
                <form action="{{ url('translations/store', $language) }}" method="POST" role="form">
                    @csrf
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                {{ trans('translations.create') }}
                            </h3>
                        </div>
                        <div class="box-body with-border">

                            <input type="hidden" id="locale" name="locale" value="{{ $language }}">
                            <input type="hidden" id="unstable" name="unstable" value="0">
                            <input type="hidden" id="locked" name="locked" value="0">
                            <input type="hidden" id="namespace" name="namespace" value="*">

                            @include('vendor.translation.forms.text', [
                                'field' => 'group',
                                'label' => trans('translations.group_label'),
                                'placeholder' => trans('translations.group_placeholder'),
                                'value' => '',
                            ])

                            @include('vendor.translation.forms.text', [
                                'field' => 'item',
                                'label' => trans('translations.item_label'),
                                'placeholder' => trans('translations.item_placeholder'),
                                'value' => '',
                            ])

                            @include('vendor.translation.forms.text', [
                                'field' => 'text',
                                'label' => trans('translations.text_label'),
                                'placeholder' => trans('translations.text_placeholder'),
                                'value' => '',
                            ])

                            {{--@include('vendor.translation.forms.text', [
                                'field' => 'namespace',
                                'label' => trans('translations.namespace_label'),
                                'placeholder' => trans('translations.namespace_placeholder'),
                                'value' => '',
                            ])--}}
                        </div>
                        <div class="panel-footer with-border">

                            <a href="{{ url()->to('translations', $language) }}"
                               class="btn btn-info">
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
