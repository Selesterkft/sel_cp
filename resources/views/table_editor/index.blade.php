@extends('adminlte.layouts.app')

@section('title', 'Table Editor')

@section('content-header')

    <section class='content-header'>
        <h1>
            {{ trans('table_editor.title') }}
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
                {{ trans('table_editor.title') }}
            </li>
        </ol>

    </section>

@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            {{ trans('app.filter') }}
                        </h3>
                    </div>
                    <div class="box-body">

                        <div class="form-group">
                            <label for="companies" class="">{{ trans('app.companies') }}</label>
                            <select id="companies" name="companies" class="form-control"></select>
                        </div>

                        <div class="form-group">
                            <label for="supervisors" class="">{{ trans('app.partners') }}</label>
                            <select id="supervisors" name="supervisors" class="form-control"></select>
                        </div>

                        <div class="form-group">
                            <label for="tables" class="">{{ trans('app.tables') }}</label>
                            <select id="tables" name="tables" class="form-control"></select>
                        </div>

                    </div>
                    <div class="box-footer"></div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            {{ trans('table_editor.query_tipes') }}
                        </h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="query_types" name="query_types"
                                   class="table table-striped table-bordered"
                                   data-toolbar="#toolbar"
                                   data-buttons-class="primary"
                                   data-toggle="table"

                                   data-show-refresh="true"
                                   data-show-columns="true"
                                   data-show-export="true"
                                   data-striped="true"

                                   data-minimum-count-columns="2"
                                   data-side-pagination="server"
                                   data-pagination="true"
                                   data-page-size="10"
                                   data-page-list="[10, 25, 50, 100]"
                                   data-height="460"></table>
                        </div>
                    </div>
                    <div class="box-footer"></div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-md-3">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            {{ trans('app.filter') }}
                        </h3>
                    </div>
                    <div class="box-body">

                        <div class="form-group">
                            <label for="reports" class="">{{ trans('app.companies') }}</label>
                            <select id="reports" name="reports" class="form-control"></select>
                        </div>

                    </div>
                    <div class="box-footer"></div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            {{ trans('table_editor.users_queries') }}
                        </h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="user_queries" name="user_queries"
                                   class="table table-striped table-bordered"
                                   data-toolbar="#toolbar"
                                   data-buttons-class="primary"
                                   data-toggle="table"

                                   data-show-refresh="true"
                                   data-show-columns="true"
                                   data-show-export="true"
                                   data-striped="true"

                                   data-minimum-count-columns="2"
                                   data-side-pagination="server"
                                   data-pagination="true"
                                   data-page-size="10"
                                   data-page-list="[10, 25, 50, 100]"
                                   data-height="460"></table>
                        </div>
                    </div>
                    <div class="box-footer"></div>
                </div>
            </div>
        </div>

    </section>
@endsection

@section('css')
    {{-- Bootstrap Table --}}
    <link href="{{ asset('assets/bower_components/bootstrap-table/1.15.5/dist/bootstrap-table.css') }}" rel="stylesheet"/>
@endsection

@section('js')

    {{-- Bootstrap Table --}}
    <script src="{{ asset('assets/bower_components/bootstrap-table/tableExport.min.js') }}"
            type="text/javascript"></script>

    <script src="{{ asset('assets/bower_components/bootstrap-table/1.15.5/dist/bootstrap-table.min.js') }}"></script>
    <script
        src="{{ asset('assets/bower_components/bootstrap-table/1.15.5/dist/locale/bootstrap-table-hu-HU.js') }}"></script>
    <script
        src="{{ asset('assets/bower_components/bootstrap-table/1.15.5/dist/extensions/export/bootstrap-table-export.js') }}"></script>

    <script>
        'use strict';

        var $companies = $('#companies');
        var $supervisors = $('#supervisors');
        var $tables = $('#tables');
        var $combo_data = {!! $registeredCompanies !!};
        var $query_types = $('#query_types');
        var $user_queries = $('#user_queries');

        /*
        options = $combo_data['supervisors'].map(function(val, ind){
            return $('<option></option>').val(val.Supervisor_ID).html(val.Supervisor_Name);
        });
        $supervisors.append(options);
        */

        function initQueryTypesTable(){
            //
            $query_types
                .bootstrapTable('destroy')
                .bootstrapTable({});
        }

        function initUserQueriesTable(){
            //
            $user_queries
                .bootstrapTable('destroy')
                .bootstrapTable();
        }

        function eventHandlers(){
            //
            $companies.on('change', function(ev){
                var selectedCompany = $(this).children("option:selected").val();
                initSupervisorsCombo(selectedCompany);
            });
        }

        function initCompaniesCombo(){

            $companies.children().remove();

            var options = $combo_data['companies'].map(function(val, ind){
                return $('<option></option>').val(val.id).html(val.name);
            });

            $companies.append(options);
        }

        function initSupervisorsCombo($companyID){

            $supervisors.children().remove();

            var options = $combo_data['supervisors'].map(function(val, ind){

                if($companyID == val.CompanyID){
                    return $('<option></option>').val(val.Supervisor_ID).html(val.Supervisor_Name);
                }

            });

            $supervisors.append(options);
        }

        function initTablesCombo(){
            //
        }

        $(function(){

            eventHandlers();
            initCompaniesCombo();
            initTablesCombo();

            initQueryTypesTable();
            initUserQueriesTable();
        });

    </script>
@endsection
