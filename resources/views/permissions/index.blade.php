@extends(session()->get('design').'.layouts.app')

@section('title', trans('permissions.title'))

@section('content-header')
    <section class="content-header">
        <h1>
            {{ trans('permissions.title') }}
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
                <i class="fa fa-file-text-o"></i>&nbsp;
                {{ trans('permissions.title') }}
            </li>

        </ol>
    </section>
@endsection

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">

                    <div class="box-header with-border">
                        <div class="box-tools pull-right">
                            <a class="btn btn-xs btn-success"
                               href="{{ url('permissions.create') }}">&nbsp;
                                {{ trans('app.add_new') }}
                            </a>
                        </div>
                    </div>

                    <div class="box-body with-border">
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>{{ trans('app.id') }}</th>
                                    <th>{{ trans('app.name') }}</th>
                                    <th width="280px">{{ trans('app.operations') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($permissions as $permission)
                                <tr>
                                    <td>{{ $permission->id }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td>
                                        <a href="{{ url('permissions.edit', $permission->id) }}"
                                           class="btn btn-success">
                                            <i class="fa fa-pencil"></i>
                                        </a>

                                        {{--@can('permission-delete')--}}
                                        {!! Form::open([
                                            'method' => 'DELETE',
                                            'url' => ['permissions.destroy', $permission->id],
                                            'style' => 'display:inline',]) !!}
                                        <button class="btn btn-danger" type="submit"
                                                title="{{ trans('app.delete') }}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        {!! Form::close() !!}
                                        {{--@endcan--}}
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="box-footer with-border"></div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    {{--@php
        use App\Classes\ColorHelper as ColorHelper;
        echo "<!-- MENU BACGROUND COLOR -->\n";
        echo "<style>.skin-blue .main-sidebar, .skin-blue .left-side {background-color: " . ColorHelper::getMenuBgColor() . ";}</style>\n";
        echo "<!-- HEADER BG COLOR -->\n";
        $header_bg_color = ColorHelper::getHeaderBgColor();
        echo "<style>.skin-blue .main-header .navbar {background-color: " . $header_bg_color . ";}</style>\n";
        echo "<style>.skin-blue .main-header .logo {background-color: " . $header_bg_color . ";}</style>\n";

        echo "<!-- PANEL AND TAB COLOR -->\n";
        echo "<style>.box.box-default {border-top-color: " . ColorHelper::getPanelTabLineColor() . ";}</style>\n";
    @endphp--}}
@endsection

@section('js')@endsection
