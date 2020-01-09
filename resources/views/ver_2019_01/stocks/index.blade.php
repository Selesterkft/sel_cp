@extends($company . '.layouts.app')
@section('title', Lang::get('global.stocks.title'))

@section('content')

    <section class="content-header">
        <h1>
            @lang('global.stocks.title')
            <small>@lang('global.stocks.sub_title')</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('/') }}">
                    <i class="fa fa-dashboard"></i>&nbsp;
                    @lang('global.app_dashboard')
                </a>
            </li>

            <li class="active">
                <i class="fa fa-files-o"></i>&nbsp;@lang('global.stocks.title')
            </li>

        </ol>
    </section>

    <div class="content">
        <div class="row">

            <div class="col-md-12">

                <div class="box box-default">

                    <div class="box-header with-border">
                        <h3 class="box-title">
                            @lang('global.stocks.title')
                        </h3>

                        <div class="box-tools pull-right">
                            <!--<a class="btn btn-success btn-xs" href="#">&nbsp;
                                @lang('global.app_add_new')
                            </a>-->
                        </div>

                    </div>

                    <div class="box-body">

                        <div class="table-responsive mailbox-messages">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>TERMÉK</th>
                                    <th>MENNYISÉG</th>
                                    <th>@lang('global.app_fields.operations')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @for($i = 1; $i <= 10; $i++)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ "Termék_{$i}" }}</td>
                                        <td>{{ $i * 10 }}</td>
                                        <td></td>
                                    </tr>
                                @endfor
                                </tbody>
                            </table>
                        </div>

                    </div>

                    <div class="box-footer"></div>

                </div>

            </div>
        </div>
    </div>

@endsection