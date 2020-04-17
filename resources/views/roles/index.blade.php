@extends(session()->get('design').'.layouts.app')

@section('title', trans('roles.title'))

@section('content')

    <section class="content-header">
        <h1>
            {{ trans('roles.title') }}
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
                {{ trans('roles.title') }}
            </li>

        </ol>
    </section>

    <div class="content">

        <div class="row">

            <div class="col-md-12">

                <div class="box box-default">

                    <div class="box-header with-border">
                        <h3 class="box-title">
                            {{ trans('roles.title') }}
                        </h3>

                        <div class="box-tools pull-right">
                            <a class="btn btn-xs btn-success"
                               href="{{ url('roles.create') }}">&nbsp;
                                {{ trans('app.add_new') }}
                            </a>
                            <!--
                            <div class="has-feedback">
                                <input type="text" class="form-control input-sm"
                                       placeholder="Search Mail">
                                <span class="glyphicon glyphicon-search form-control-feedback"></span>
                            </div>
                            -->
                        </div>
                    </div>

                    <div class="box-body">

                        <div class="table-responsive mailbox-messages">

                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>{{ trans('app.id') }}</th>
                                    <th>{{ trans('app.name') }}</th>
                                    <th width="280px">{{ trans('app.operations') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($roles as $role)
                                    <tr>
                                        <td>{{ $role->id }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            <a class="btn btn-info"
                                               href="{{ url('roles.show',$role->id) }}"
                                               title="{{ trans('app.view') }}">
                                                <i class="fa fa-eye"></i>
                                            </a>

                                            {{--@can('role-edit')--}}
                                            <a class="btn btn-primary"
                                               href="{{ url('roles.edit',$role->id) }}"
                                               style="margin-left: 10px;"
                                               title="{{ trans('app.edit') }}">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            {{--@endcan--}}

                                            @can('role-delete')
                                                {!! Form::open([
                                                    'method' => 'DELETE',
                                                    'url' => ['roles.destroy', $role->id],
                                                    'style' => 'display:inline']) !!}

                                                <button type="submit" class="btn btn-danger"
                                                        style="margin-left: 10px;"
                                                        title="{{ trans('app.delete') }}">
                                                    <i class="fa fa-trash"></i>
                                                </button>

                                                {!! Form::close() !!}
                                            @endcan
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
    </div>

@endsection

@section('css')
@php
use App\Classes\ColorHelper as ColorHelper;
echo "<!-- MENU BACGROUND COLOR -->\n";
echo "<style>.skin-blue .main-sidebar, .skin-blue .left-side {background-color: " . ColorHelper::getMenuBgColor() . ";}</style>\n";
echo "<!-- HEADER BG COLOR -->\n";
$header_bg_color = ColorHelper::getHeaderBgColor();
echo "<style>.skin-blue .main-header .navbar {background-color: " . $header_bg_color . ";}</style>\n";
echo "<style>.skin-blue .main-header .logo {background-color: " . $header_bg_color . ";}</style>\n";

echo "<!-- PANEL AND TAB COLOR -->\n";
echo "<style>.box.box-default {border-top-color: " . ColorHelper::getPanelTabLineColor() . ";}</style>\n";
@endphp
@endsection
