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
                            <select name="companies" class="form-control" id="companies"></select>
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
                            {{ trans('table_editor.title') }}
                        </h3>
                    </div>
                    <div class="box-body"></div>
                    <div class="box-footer"></div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('css')@endsection

@section('js')
    <script>
        var $companies = $('#companies');
        var $supervisors = $('#supervisors');
        var $tables = $('#tables');
        var $combo_data = {!! $registeredCompanies !!};

        /*
        options = $combo_data['supervisors'].map(function(val, ind){
            return $('<option></option>').val(val.Supervisor_ID).html(val.Supervisor_Name);
        });
        $supervisors.append(options);
        */

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
        });

    </script>
@endsection
