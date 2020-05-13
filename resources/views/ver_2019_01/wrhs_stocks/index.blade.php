@extends(session()->get('design') . '.layouts.app')

@section('title', trans('stocks.title'))

@section('content-header')
    <section class='content-header'>
        <h1>
            {{ trans('stocks.title') }}
            <small>
                {{-- trans('stocks.sub_title') --}}
                @if( $query_name != '' )
                    ({{ $query_name }})
                @endif
            </small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('/') }}">
                    <i class="fa fa-dashboard"></i>&nbsp;
                    {{ trans('app.dashboard') }}
                </a>
            </li>

            <li class="active">
                <i class="fa fa-files-o"></i>&nbsp;
                {{ trans('stocks.title') }}
            </li>
        </ol>

    </section>
@endsection

@section('content')

    @php
        $loggedUser = \Auth::user();
        $customer_id = (int)$loggedUser->Supervisor_ID;
        $client_id = (int)$loggedUser->CompanyID;

        //$customer_id = 37127568;
        //$client_id = 1038482;
    @endphp

    <input type="hidden" id="client_id" name="client_id" value="{{ $client_id }}"/>
    <input type="hidden" id="cust_id" name="cust_id" value="{{ $customer_id }}"/>
    <input type="hidden" id="table_name" name="table_name" value="{{ $table_name }}"/>
    <input type="hidden" id="query_name" name="query_name" value="{{ $query_name }}"/>

    <section class="content">
        <div class="row">

            <div class="col-md-3">
                <button class="btn btn-primary btn-block margin-bottom"
                        data-toggle="modal"
                        data-target="#exampleModal"
                        data-modal_title="{{ trans('reports.seve_report') }}"
                        data-report_id="0"
                        data-report_name=""
                        data-report_desc=""
                        data-action="save">
                    {{ trans('reports.save_report') }}
                </button>
                {{--
                <a href="{{ url('reports.create', 'cp_wrhs_stocks') }}"
                   class="btn btn-primary btn-block margin-bottom">
                    {{ trans('reports.seve_report') }}
                </a>
                --}}
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            {{ trans('reports.reports') }}
                        </h3>

                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool"
                                    data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked">

                            @foreach($company_reports as $company_report)
                                <li class="{{ ($query_name == $company_report->QueryName) ? 'active' : '' }}">
                                    <a href="{{ url('wrhs_stocks?query_name=' . $company_report->QueryName) }}"
                                       title="{{ $company_report->QueryDescription }}">
                                        <i class="fa fa-fw fa-file-text-o"></i>&nbsp;{{ $company_report->QueryName }}
                                        <span class="pull-right">

                                            <button class="btn btn-success btn-xs"
                                                    data-toggle="modal"
                                                    data-target="#exampleModal"
                                                    data-modal_title="{{ trans('app.rename') }}"
                                                    data-report_id="{{ $company_report->ID }}"
                                                    data-report_name="{{ $company_report->QueryName }}"
                                                    data-report_desc="{{ $company_report->QueryDescription }}"
                                                    data-action="rename">
                                                <i class="fa fa-fw fa-i-cursor"
                                                   title="{{ trans('app.rename') }}"></i>
                                            </button>

                                            <button class="btn btn-danger btn-xs"
                                                    data-toggle="modal"
                                                    data-target="#exampleModal"
                                                    data-modal_title="{{ trans('app.delete') }}"
                                                    data-report_id="{{ $company_report->ID }}"
                                                    data-action="delete">
                                                <i class="fa fa-fw fa-trash"
                                                   title="{{ trans('app.delete') }}"></i>
                                            </button>

                                        </span>
                                    </a>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="box box-default">
                    <div class="box-body">
                        <div class="table-responsive">

                            @includeIf(session()->get('version') . '.wrhs_stocks.wrhs_stock_table')

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    @includeIf('modals.modal_01', [
        'fields' => 'ver_2019_01.wrhs_stocks.partials.modal_fields'
    ])

@endsection

@section('css')
    {{-- Bootstrap Table --}}
    <link href="{{ asset('assets/bower_components/bootstrap-table/1.15.5/bootstrap-table.css') }}" rel="stylesheet"/>

    <style>
        table.table.table-striped.table-bordered td {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>

    @yield('wrhs_stocks_css')
@endsection

@section('js')
    {{-- Bootstrap Table --}}
    <script src="{{ asset('assets/bower_components/bootstrap-table/1.15.5/tableExport.min.js') }}"
            type="text/javascript"></script>

    <script src="{{ asset('assets/bower_components/bootstrap-table/1.15.5/bootstrap-table.min.js') }}"></script>
    <script
        src="{{ asset('assets/bower_components/bootstrap-table/1.15.5/locale/bootstrap-table-hu-HU.js') }}"></script>
    <script
        src="{{ asset('assets/bower_components/bootstrap-table/1.15.5/extensions/export/bootstrap-table-export.js') }}"></script>

    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/extensions/cookie/bootstrap-table-cookie.js"></script>

    {{-- Moment --}}
    <script src="{{ asset('assets/bower_components/moment/moment.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/bower_components/moment/locale/hu.js') }}" type="text/javascript"></script>

    <script>
        'use strict';

        var url = 'wrhs_stocks';
        var token = $('meta[name="csrf-token"]').attr('content');
        var modal = null;
        var state = '';
        var modal_title = '';
        var report_id = 0;
        var report_name = '';
        var report_desc = '';
        var query_name = '';

        // Open Modal
        $('#exampleModal').on('show.bs.modal', function (event)
        {
            var button = $(event.relatedTarget);// Button that triggered the modal
            //var recipient = button.data('whatever') // Extract info from data-* attributes

            modal_title = button.data('modal_title');
            report_id = button.data('report_id');
            report_name = button.data('report_name');
            report_desc = button.data('report_desc');
            state = button.data('action');
            modal = $(this);

            modal.find('.modal-title').text(modal_title);
            modal.find('#report_id').val(report_id);
            modal.find('#report_name').val(report_name);
            modal.find('#report_desc').text(report_desc);
        });

        // Close Modal
        $('#exampleModal').on('hide.bs.modal', function(event){});

        // Click Save
        $('#modal_save').on('click', function(event)
        {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': token
                }
            });

            event.preventDefault();

            var formData = {
                client_id: $('#client_id').val(),
                cust_id: $('#cust_id').val(),
                table_name: $('#table_name').val(),
                old_query_name: $('#query_name').val(),
                query_name: $('#report_name').val(),
                query_description: $('#report_desc').val()
            };

            var type = 'post';
            var myURL = url;

            if( state == 'rename' )
            {
                type = 'put';
                formData['id'] = report_id;
                myURL += '/' + report_id;
            }

            //console.log(myURL);

            $.ajax({
                url: myURL,
                type: type,
                data: formData,
                dataType: 'json',
                beforeSend: function(){},
                success: function(data)
                {
                    //console.log('success: ', data);
                    location.reload();
                },
                error: function(xhr, status, error)
                {
                    //var err = $.parseJSON(xhr.responseText);

                    console.log('error: ', err);
                    /*
                    if( err.name !== 'undefined')
                    {
                        //
                    }
                    */
                }
            });

        });

    </script>

    @yield('wrhs_stocks_js')
@endsection
