@extends(session()->get('design') . '.layouts.app')

@section('title', trans('stocks.title'))

@section('content-header')
    <section class='content-header'>
        <h1>
            {{ trans('stocks.title') }}
            <small>
                {{-- trans('stocks.sub_title') --}}
                {{--@if( $query_name != '' )
                    ({{ $query_name }})
                @endif--}}
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
    //dd($query_name)
@endphp

    <input type="hidden" id="client_id" name="client_id" value="{{ $client_id }}"/>
    <input type="hidden" id="cust_id" name="cust_id" value="{{ $customer_id }}"/>
    <input type="hidden" id="table_name" name="table_name" value="{{ $table_name }}"/>
    <input type="hidden" id="query_name" name="query_name" value="{{ $query_name }}"/>

    <section class="content">
        <div class="row">

            <div class="col-md-3">

                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            {{ trans('stocks.stocks_reports') }}
                        </h3>
                        {{--
                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool"
                                    data-widget="collapse">
                                    <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        --}}
                    </div>
                    <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked">
                            <li class="{{ ($table_name == 'cp_wrhs_stocks') ? 'active' : '' }}"
                                style="{{ ($table_name == 'cp_wrhs_stocks') ? 'background-color: rgb(243, 212, 155);' : '' }}">

                                <a href="{{ url('stocks?table_name=cp_wrhs_stocks') }}">
                                    {{ trans('stocks.title') }}
                                </a>

                            </li>

                            <li class="{{ ($table_name == 'cp_wrhs_trans') ? 'active' : '' }}"
                                style="{{ ($table_name == 'cp_wrhs_trans') ? 'background-color: rgb(243, 212, 155);' : '' }}">
                                <a href="{{ url('stocks?table_name=cp_wrhs_trans') }}">
                                    {{ trans('stocks.movements_title') }}
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>

                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            {{--Felhasználói riportok--}}
                            {{ trans('stocks.user_reports') }}
                        </h3>

                        <div class="box-tools">
                            @if(Auth::user()->hasRole('Admin'))
                            <button type="button"
                                    class="btn btn-box-tool"
                                    data-toggle="modal"
                                    data-target="#{{ $table_name }}_modal"
                                    data-modal_title="{{ trans('reports.save_report') }}"
                                    data-modal-report_id="0"
                                    data-modal-report_name=""
                                    data-modal-report_desc=""
                                    data-action="save">
                                <i class="fa fa-plus"></i>
                            </button>
                            @endif
                        </div>

                    </div>
                    <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked">
                            @php
                            $default_query_name = config('appConfig.default_query_name');
                            @endphp
                            @foreach($company_reports as $company_report)

                            <li class="{{ ( $query_name == $company_report->QueryName ) ? 'active' : '' }}"
                                style="{{ ( $query_name == $company_report->QueryName ) ? 'background-color: rgb(243, 212, 155);' : '' }}">

                                <a href="{{ url('stocks?table_name=' . $table_name . '&query_name=' . $company_report->QueryName) }}">
                                    @php

                                    if($company_report->QueryName == $default_query_name){
                                        $_query_name = trans('app.default_query_name');
                                    }
                                    else{
                                        $_query_name = $company_report->QueryName;
                                    }

                                    @endphp
                                    <i class="fa fa-circle-o text-red"></i>&nbsp;{{ $_query_name }}

                                    <span class=pull-right>

                                        @if($company_report->QueryName != $default_query_name)
                                            @if(Auth::user()->hasRole('Admin'))
                                        {{-- Szerkesztés gomb --}}
                                        <button class="btn btn-success btn-xs"
                                                onclick="event.preventDefault();"
                                                data-toggle="modal"
                                                data-target="#{{ $table_name }}_modal"
                                                data-modal_title="{{ trans('app.rename') }}"
                                                data-report_id="{{ $company_report->ID }}"
                                                data-report_name="{{ $company_report->QueryName }}"
                                                data-report_desc="{{ $company_report->QueryDescription }}"
                                                data-action="rename">
                                            <i class="fa fa-fw fa-pencil"></i>
                                        </button>
                                        {{-- Törlés gomb --}}
                                        <button class="btn btn-danger btn-xs"
                                                onclick="event.preventDefault();"
                                                data-toggle="modal"
                                                data-target="#delete_confirm_modal"
                                                data-modal_title="Törlés megerősítése"
                                                data-record_id="{{ $company_report->ID }}"
                                                data-action="delete">
                                            <i class="fa fa-fw fa-trash"></i>
                                        </button>
                                        @endif
                                        @endif
                                    </span>
                                </a>

                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                @if( $table_name == 'cp_wrhs_trans' )
                @include(session()->get('version') . '.panels.filter_panel')
                @endif

                <div class="box box-solid">
{{--
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            {{ $table_name }}
                        </h3>

                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
--}}

                    <div class="box-body">

                        {{-- TÁBLÁZAT --}}
                        @includeIf(session()->get('version') . '.stocks.stocks_table', [
                            'table_name' => $table_name,
                            'query_name' => $query_name,
                            'paginate_number' => config('appConfig.paginate_number'),
                            'url' => url('stocks?table_name=' . $table_name . '&query_name=' . $query_name),
                            'locale' => app()->getLocale() . '-' . strtoupper(app()->getLocale()),
                            'table_columns' => $table_columns,
                        ])

                    </div>

                </div>

            </div>

        </div>
    </section>

    {{-- MODAL --}}
    @includeIf('modals.modal_01', [
        'modal_name' => $table_name . '_modal',
        'fields' => session()->get('version') . '.stocks.partials.' . $table_name . '_modal_fields',
    ])

    {{-- MODAL DANGER --}}
    @includeIf('modals.modal_danger', [
        'modal_name' => 'delete_confirm_modal'
    ])
@endsection

@section('css')

    {{-- Bootstrap Table --}}
    <link href="{{ asset('assets/bower_components/bootstrap-table/1.15.5/bootstrap-table.css') }}" rel="stylesheet"/>

    <!-- Bootstrap Datetime Picker -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css') }}">

    <style>
        table.table.table-striped.table-bordered td {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>

    @yield('stocks_css')
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
    {{--
    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/extensions/cookie/bootstrap-table-cookie.js"></script>
    --}}

    {{-- Moment --}}
    <script src="{{ asset('assets/bower_components/moment/moment.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/bower_components/moment/locale/hu.js') }}" type="text/javascript"></script>

    <!--
        Bootstrap Datetime Picker
        https://www.malot.fr/bootstrap-datetimepicker/index.php
    -->
    <script src="{{ asset('assets/bower_components/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js') }}"></script>
<!--
    <script src="{{ asset('assets/bower_components/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.en.js') }}"
            charset="UTF-8"></script>
    -->
    <script src="{{ asset('assets/bower_components/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.hu.js') }}"
            charset="UTF-8"></script>

    <script>
        'use strict'

        var token           = $('meta[name="csrf-token"]').attr('content');
        var modal           = null;
        var modal_title     = '';
        var report_id       = null;
        var record_id       = null;
        var report_name     = '';
        var report_desc     = '';
        var query_name      = '';
        var visibleColumns  = null;
        var hiddenColumns   = null;
        var table_name      = '{{ $table_name }}';
        var $local_short    = '{{ app() ->getLocale() }}';
        var action          = '';
        var type            = 'post';

        var url = 'stocks';
        /*
        if( table_name === 'cp_wrhs_stocks' ){
            url = 'wrhs_stocks';
        }
        else if(table_name === 'cp_wrhs_trans'){
            url = 'wrhs_trans';
        }
        */

        // Open Modal
        $('#{!! $table_name !!}_modal').on('show.bs.modal', function(event){

                var button = $(event.relatedTarget);

                modal_title = button.data('modal_title');
                report_id = button.data('report_id');
                report_name = button.data('report_name');
                report_desc = button.data('report_desc');
                action = button.data('action');
                modal = $(this);

                modal.find('.modal-title').text(modal_title);
                modal.find('#report_id').val(report_id);
                modal.find('#report_name').val(report_name);
                modal.find('#report_desc').val(report_desc);
            }
        );

        // Open Delete Confirm Modal
        $('#delete_confirm_modal').on('show.bs.modal', function(event){

            var button = $(event.relatedTarget);

            modal_title = button.data('modal_title');
            record_id = button.data('record_id');

            modal = $(this);
            modal.find('.modal-title').text(modal_title);
            modal.find('#record_id').val(record_id);
        });

        // Törlés
        $('#modal_delete').on('click', function(event){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': token
                }
            });

            event.preventDefault();
            var id = $('#record_id').val();
            //var formData = { id: id };

            $.ajax({
                url: url + '/' + id,
                type: 'DELETE',
                dataType: 'json',
                beforeSend: function(){},
                success: function(data){
                    //console.log(data);
                    location.reload();
                },
                error: function(xhr, status, error){
                    console.log(error);
                }
            });
        });

        // Mentés
        $('#modal_save').on('click', function(event){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': token
                }
            });

            event.preventDefault();

            var formData = {
                client_id:          $('#client_id').val(),
                cust_id:            $('#cust_id').val(),
                table_name:         $('#table_name').val(),
                old_query_name:     $('#query_name').val(),
                query_name:         $('#report_name').val(),
                query_description:  $('#report_desc').val()
            };

            var myURL = url;

            if( action == 'rename' ){
                type = 'put';
                formData['id'] = report_id;
                myURL += '/' + report_id;
            }

            $.ajax({
                url: myURL,
                type: type,
                data: formData,
                dataType: 'json',
                beforeSend: function(){},
                success: function(data){
                    location.reload();
                },
                error: function(xhr, status, error){
                    console.log(error);
                },
            });

        });

        function dateFormatter(data)
        {
            return moment(data).locale($local_short).format('L');
        }

        function decimalFormatter(data)
        {
            return FormatNumber(data);
        }

        function FormatNumber(number, numberOfDigits = 2)
        {
            try {
                //retVal = new Intl.NumberFormat('hu-HU').format(parseFloat(number).toFixed(2));
                return parseFloat(number).toFixed(numberOfDigits);
            } catch (error) {
                console.log(error);
                return 0;
            }
        }

    </script>

    @yield('stocks_js')

@endsection
