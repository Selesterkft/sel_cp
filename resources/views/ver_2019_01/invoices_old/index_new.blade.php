@extends($company . '.layouts.app')
@section('title', Lang::get('global.invoices.title'))

@section('content')
    <section class="content-header">
        <h1>
            @lang('global.invoices.title')
            <small>@lang('global.invoices.sub_title')</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('/') }}">
                    <i class="fa fa-dashboard"></i>&nbsp;
                    @lang('global.app_dashboard')
                </a>
            </li>

            <li class="active">
                <i class="fa fa-files-o"></i>&nbsp;@lang('global.invoices.title')
            </li>

        </ol>
    </section>

    <section class="content">
        <div class="box box-default">

            <div class="box-header with-border">
                <h3 class="box-title">
                    @lang('global.invoices.title')
                </h3>
            </div>

            <div class="box-body">
                <div class="table-responsive mailbox-messages">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>@lang('global.app_fields.id')</th>
                            <th>@lang('global.app_name')</th>
                            <th>@lang('global.invoices.fields.leaved')</th>
                            <th>@lang('global.invoices.fields.due')</th>
                            <th>@lang('global.invoices.fields.net')</th>
                            <th>@lang('global.invoices.fields.gross')</th>
                            <th>@lang('global.invoices.fields.vat')</th>
                            <th>@lang('global.app_fields.operations')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($invoices as $invoice)
                            <tr>
                                <td>{{ $invoice->ID }}</td>
                                <td>{{ $invoice->ClientID }}</td>
                                <td>{{-- $invoice-> --}}</td>
                                <td>{{-- $invoice-> --}}</td>
                                <td>{{-- $invoice-> --}}</td>
                                <td>{{-- $invoice-> --}}</td>
                                <td>{{-- $invoice-> --}}</td>
                                <td>
                                    <a href="{{-- route('users.show', $invoice->ID) --}}" class="btn btn-info">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    <a href="{{-- route('users.edit', $invoice->ID) --}}" class="btn btn-success"
                                       style="margin-left: 10px;">
                                        <i class="fa fa-pencil"></i>
                                    </a></td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot></tfoot>
                    </table>
                </div>
            </div>

            <div class="box-footer"></div>

        </div>
    </section>

@endsection