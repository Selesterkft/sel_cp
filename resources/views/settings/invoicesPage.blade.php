<div class="box box-default">

    <div class="box-header clearfix">
        <h4 class="box-title pull-left" style="padding-top: 7.5px;">
            {{ trans('settings.invoices_page_title') }}
        </h4>
        <div class="btn-group pull-right">
            <button class="btn btn-success btn-sm"
                    onclick="event.preventDefault();document.getElementById('frmInvoices').submit()">
                <i class="fa fa-save"></i>&nbsp;{{ trans('app.save') }}
            </button>
            <!--<a href="#" class="btn btn-warning btn-sm">## Delete</a>-->
            <a href="{{ url('settings.restoreInvoices') }}" class="btn btn-danger btn-sm">
                <i class="fa fa-recycle">&nbsp;
                    {{ trans('app.restore') }}
                </i>
            </a>
        </div>
    </div>

    <div class="box-body">
        <form id="frmInvoices" name="frmInvoices"
              class="form-horizontal"
              method="post"
              action="{{ url('settings.saveInvoices') }}">

            <input name="_method" type="hidden" value="PUT">
            {!! csrf_field() !!}

            {{-- INVOICES MENU BACKGROUND COLOR --}}
            <div class="form-group">
                <input type="hidden" value="{{ $invoices_menu_bg_color_id }}"
                       id="invoices_menu_bg_color_id" name="invoices_menu_bg_color_id">
                <label class="col-sm-2 control-label">
                    {{ trans('settings.menu_bg_color') }}:
                </label>

                <div class="col-sm-8">

                    <div class="input-group"
                         id="invoices_menu_bg_color" name="invoices_menu_bg_color">
                        <input type="text" class="form-control"
                               id="invoices_menu_bg_color_value"
                               name="invoices_menu_bg_color_value"
                               value="{{ $invoices_menu_bg_color_value }}">

                        <div class="input-group-addon">
                            <i></i>
                        </div>

                    </div>

                </div>

            </div>

            {{-- DASHBOARD HEADER BACKGROUND COLOR --}}
            <div class="form-group">
                <input type="hidden" value="{{ $invoices_header_bg_color_id }}"
                       id="invoices_header_bg_color_id" name="invoices_header_bg_color_id">
                <label class="col-sm-2 control-label">
                    {{ trans('settings.header_bg_color') }}:
                </label>

                <div class="col-sm-8">

                    <div class="input-group"
                         id="invoices_header_bg_color" name="invoices_header_bg_color">
                        <input type="text" class="form-control"
                               id="invoices_header_bg_color_value"
                               name="invoices_header_bg_color_value"
                               value="{{ $invoices_header_bg_color_value }}">

                        <div class="input-group-addon">
                            <i></i>
                        </div>

                    </div>

                </div>

            </div>

            {{-- DASHBOARD PANEL AND TAB LINE COLOR --}}
            <div class="form-group">
                <input type="hidden"
                       id="invoices_panel_tab_color_id" name="invoices_panel_tab_color_id"
                       value="{{ $invoices_panel_tab_color_id }}">
                <label class="col-sm-2 control-label">
                    {{ trans('settings.panel_tab_line_color') }}:
                </label>

                <div class="col-sm-8">

                    <div class="input-group"
                         id="invoices_panel_tab_color" name="invoices_panel_tab_color">
                        <input type="text" class="form-control"
                               id="invoices_panel_tab_color_value"
                               name="invoices_panel_tab_color_value"
                               value="{{ $invoices_panel_tab_color_value }}">

                        <div class="input-group-addon">
                            <i></i>
                        </div>

                    </div>

                </div>

            </div>

        </form>
    </div>

    <div class="box-footer"></div>

</div>
