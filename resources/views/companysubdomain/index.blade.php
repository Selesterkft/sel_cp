@extends('layouts.app')

@section('title', __('global.company_subdomain.tab_title'))

@section('content')
<section class="content-header">
    <h1>
        {{ __('global.company_subdomain.menu_title') }}
        <small>{{ __('global.company_subdomain.sub_title') }}</small>
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ url('/') }}">
                <i class="fa fa-dashboard"></i>&nbsp;
                {{ __('global.app_dashboard') }}
            </a>
        </li>

        <li class="active">
            <i class="fa fa-users"></i>&nbsp;{{ __('global.company_subdomain.menu_title') }}
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
                            {{ __('global.company_subdomain.menu_title') }}
                        </h3>

                        <div class="box-tools pull-right">
                            <a class="btn btn-success btn-xs"
                               style="margin-top: 5px;"
                               href="{{ url('companysubdomain.create') }}">&nbsp;
                                {{ __('global.app_add_new') }}
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
                                    <th>{{ __('global.company_subdomain.fields.company') }}</th>
                                    <th>{{ __('global.company_subdomain.fields.company_nickname') }}</th>
                                    <th>{{ __('global.company_subdomain.fields.subdomain') }}</th>
                                    <th>{{ __('global.app_fields.operations') }}</th>
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
                                                    style="margin-left: 10px;">
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