@extends('layouts.app')

@section('title', trans('company_subdomain.title'))

@section('content')
<section class="content-header">
    <h1>
        {{ trans('company_subdomain.menu_title') }}
        <small>{{ trans('company_subdomain.sub_title') }}</small>
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ url('/') }}">
                <i class="fa fa-dashboard"></i>&nbsp;
                {{ trans('app.dashboard') }}
            </a>
        </li>

        <li class="active">
            <i class="fa fa-users"></i>&nbsp;{{ trans('company_subdomain.menu_title') }}
        </li>

    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            @if( session()->has('success') )

                @includeIf('layouts.success', ['messages' => session()->get('success') ])

            @elseif( session()->has('errors') )

                @includeIf('layouts.alert', ['messages' => session()->get('errors')] )

            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">

                <div class="box-header with-border">
                        <h3 class="box-title">
                            {{ trans('company_subdomain.menu_title') }}
                        </h3>

                        <div class="box-tools pull-right">
                            <a class="btn btn-success btn-xs"
                               style="margin-top: 5px;"
                               href="{{ url('companysubdomain.create') }}">&nbsp;
                                {{ trans('app.add_new') }}
                            </a>
                        </div>

                    </div>

                <div class="box-body">
                    <div class="table-responsive mailbox-messages">

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    {{--<th>#</th>--}}
                                    {{--<th>CompanyID</th>--}}
                                    <th>{{ trans('app.company') }}</th>
                                    <th>{{ trans('company_subdomain.company_nickname') }}</th>
                                    <th>{{ trans('company_subdomain.subdomain') }}</th>
                                    <th>{{ trans('app.operations') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($company_subdomain as $cs)
                                <tr>
                                    {{--<td>{{ $cs->id }}</td>--}}
                                    {{--<td>{{ $cs->CompanyID }}</td>--}}
                                    <td>{{ $cs->CompanyName }}</td>
                                    <td>{{ $cs->CompanyNickName }}</td>
                                    <td>{{ $cs->SubdomainName }}</td>
                                    <td>
                                        <a href="{{ url('companysubdomain.show', ['id' => $cs->id]) }}"
                                           class="btn btn-info btn-xs">
                                            <i class="fa fa-eye"></i>
                                        </a>

                                        <a href="{{ url('companysubdomain.edit', ['id' => $cs->id]) }}"
                                           class="btn btn-success btn-xs"
                                           style="margin-left: 10px;">
                                            <i class="fa fa-pencil"></i>
                                        </a>

                                    @if($cs->deleted_at)
                                        <form action="{{ url('companysubdomain.restore', ['id' => $cs->id]) }}"
                                              method="POST"
                                              style="display:inline;">
                                            @csrf
                                            <button type="submit"
                                                    class="btn btn-info btn-xs"
                                                    style="margin-left: 5px;">
                                                <i class="fa fa-recycle"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form method="POST"
                                              action="{{ url('companysubdomain.destroy', [
                                                      'id' => $cs->id
                                                  ]) }}"
                                                style="display:inline;">
                                            <input type="hidden" name="_method" value="DELETE"/>
                                            @csrf
                                            <button type="submit"
                                                    class="btn btn-danger btn-xs"
                                                    style="margin-left: 10px;">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>

                <div class="box-footer"></div>

            </div>
        </div>
    </div>

</section>
@endsection
