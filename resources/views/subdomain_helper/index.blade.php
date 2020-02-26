@extends('layouts.app')
@section('title', trans('SD Helper'))

@section('content')

<section class="content-header">

</section>

<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        {{ trans('global.sd_helper.title') }}
                    </h3>
                    <!--
                        <div class="box-tools pull-right">
                            <a class="btn btn-xs btn-success"
                               href="{{ url('roles.create') }}">&nbsp;
                                {{ trans('global.app_add_new') }}
                            </a>
                        </div>
                    -->
                </div>
                <div class="box-body">

                    <div class="table-responsive mailbox-messages">

                        <table id="table" name="table" class="table table-striped"
                               data-buttons-class="primary"
                               data-id-field="ID"
                               data-toggle="table"
                               data-search="true"
                               data-show-search-button="false"
                               data-search-on-enter-key="false"

                               data-virtual-scroll="true"

                               data-show-refresh="false"
                               data-show-toggle="false"
                               data-show-fullscreen="false"
                               data-show-columns="false"
                               data-show-export="false"
                               data-show-pagination-switch="false"

                               data-minimum-count-columns="2"
                               data-striped="true"

                               data-pagination="true"
                               data-page-size="10"
                               data-page-list="[10, 25, 50, 100]"

                               data-show-footer="true">
                            <thead>
                                <tr>
                                    <th data-halign="center" data-align="left" data-sortable="true" data-searchable="true" data-switchable="true">
                                        {{ trans('app.id') }}
                                    </th>
                                    <th data-halign="center" data-align="left" data-sortable="true" data-searchable="true" data-switchable="true">
                                        {{ trans('app.name') }}
                                    </th>
                                    <th data-halign="center" data-align="left" data-sortable="true" data-searchable="true" data-switchable="true">
                                        {{ trans('global.sd_helper.fields.sd') }}
                                    </th>
                                    <th data-halign="center" data-align="left" data-sortable="true" data-searchable="true" data-switchable="true">
                                        {{ trans('global.sd_helper.fields.url') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($companies as $company)
                                <tr>
                                    <td>{{ $company['ID'] }}</td>
                                    <td>{{ $company['Nev1'] }}</td>
                                    <td>{{ $company['Subdomain'] }}</td>
                                    <td>
                                        <a href="{{ $company['Url'] }}" target="_blank">
                                            {{ $company['Url'] }}
                                        </a>
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
</div>

@endsection

@section('css')
    <link href="{{ asset('assets/bower_components/bootstrap-table/1.15.4/dist/bootstrap-table.css') }}" rel="stylesheet"/>

@php
echo "<!-- BACGROUND COLOR -->\n";
echo "<style>.skin-blue .main-sidebar, .skin-blue .left-side {background-color: " . \App\Classes\Helper::getMenuBgColor() . ";}</style>\n";
echo "<!-- HEADER BG COLOR -->\n";
$header_bg_color = \App\Classes\Helper::getHeaderBgColor();
echo "<style>.skin-blue .main-header .navbar {background-color: " . $header_bg_color . ";}</style>\n";
echo "<style>.skin-blue .main-header .logo {background-color: " . $header_bg_color . ";}</style>\n";

echo "<!-- PANEL AND TAB COLOR -->\n";
echo "<style>.box.box-default {border-top-color: " . \App\Classes\Helper::getPanelTabLineColor() . ";}</style>\n";
@endphp
@endsection

@section('js')

    <script src="{{ asset('assets/bower_components/bootstrap-table/tableExport.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/bower_components/bootstrap-table/1.15.4/dist/bootstrap-table.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/bower_components/bootstrap-table/1.15.4/dist/locale/bootstrap-table-hu-HU.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/bower_components/bootstrap-table/1.15.4/dist/extensions/export/bootstrap-table-export.js') }}" type="text/javascript"></script>

    <script>

        var $table = $('#table');

        function initTable()
        {
            $table.bootstrapTable('destroy')
                .bootstrapTable({
                    height: 550,
                    exportTypes: ['csv', 'txt', 'excel', 'pdf'],
                    locale: '{{ config('app.locale') . '-' . strtoupper(config('app.locale')) }}',
                }).trigger('change');
        }

        $(function()
        {
            initTable();
        });

    </script>

@endsection
