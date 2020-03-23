<div class="box box-default">

    <div class="box-header clearfix">
        <h4 class="box-title pull-left" style="padding-top: 7.5px;">
            {{ trans('settings.general_title') }}
        </h4>
        <div class="btn-group pull-right">
            <button class="btn btn-success btn-sm"
                    onclick="event.preventDefault();document.getElementById('frmGeneral').submit()">
                <i class="fa fa-save"></i>&nbsp;{{ trans('app.save') }}
            </button>
            <!--<a href="#" class="btn btn-warning btn-sm">## Delete</a>-->
            <a href="{{ url('settings.restoreGeneral') }}" class="btn btn-danger btn-sm">
                <i class="fa fa-recycle">&nbsp;
                    {{ trans('app.restore') }}
                </i>
            </a>
        </div>
    </div>

    <div class="box-body">
        <form id="frmGeneral" name="frmGeneral"
              class="form-horizontal"
              method="post"
              accept-charset="UTF-8"
              enctype="multipart/form-data"
              action="{{ url('settings.saveGeneral') }}">
            <input name="_method" type="hidden" value="PUT">
            {!! csrf_field() !!}

            {{-- FAVICON --}}
            <div class="form-group">
                <input type="hidden"
                       id="general_favicon_id" name="general_favicon_id"
                       value="{{ $general_favicon_id }}">
                <label class="col-sm-2 control-label">
                    {{ trans('settings.general_favicon') }}:
                </label>

                <div class="col-sm-8">
                    @php
                        use App\Classes\Helper;
                        /** @var int $general_favicon_id */
                        if( $general_favicon_id != 0 )
                        {
                            /** @var string $general_favicon_value */
                            $general_favicon_name = Helper::timestampRemover($general_favicon_value);
                        }
                    @endphp
                    <input type="text" class="form-control" value="{{ $general_favicon_name }}" disabled>
                    {{ Form::file('general_favicon_value') }}

                </div>

            </div>

            {{-- LOGO --}}
            <div class="form-group">
                <input type="hidden"
                       id="general_logo_id" name="general_logo_id"
                       value="{{ $general_logo_id }}">
                <label class="col-sm-2 control-label">
                    {{ trans('settings.general_logo_image') }}:
                </label>

                <div class="col-sm-8">
                    @php
                        /** @var int $general_logo_id */
                        if( $general_logo_id != 0 )
                        {
                            /** @var string $general_logo_value */
                            $general_logo_name = Helper::timestampRemover($general_logo_value);
                        }
                    @endphp
                    <input type="text" class="form-control"
                           value="{{ $general_logo_name }}" disabled>
                    {{ Form::file('general_logo_value') }}

                </div>

            </div>

            {{-- PROFILE --}}
            <div class="form-group">
                <input type="hidden"
                       id="general_profil_image_id" name="general_profil_image_id"
                       value="{{ $general_profil_image_id }}">
                <label class="col-sm-2 control-label">
                    {{ trans('settings.general_profile_image') }}:
                </label>

                <div class="col-sm-8">
                    @php
                        /** @var int $general_profil_image_id */
                        if( $general_profil_image_id != 0 )
                        {
                            /** @var string $general_profil_image_value */
                            $general_profil_image_name = Helper::timestampRemover($general_profil_image_value);
                        }
                    @endphp
                    <input type="text" class="form-control"
                           value="{{ $general_profil_image_value }}" disabled>
                    {{ Form::file('general_profil_image_value') }}

                </div>

            </div>

            {{-- GENERAL MENU BACKGROUND COLOR --}}
            <div class="form-group">
                <input type="hidden" value="{{ $general_menu_bg_color_id }}"
                       id="general_menu_bg_color_id" name="general_menu_bg_color_id">
                <label class="col-sm-2 control-label">
                    {{ trans('settings.menu_bg_color') }}:
                </label>

                <div class="col-sm-8">

                    <div class="input-group"
                         id="general_menu_bg_color" name="general_menu_bg_color">
                        <input type="text" class="form-control"
                               id="general_menu_bg_color_value"
                               name="general_menu_bg_color_value"
                               value="{{ $general_menu_bg_color_value }}">

                        <div class="input-group-addon">
                            <i></i>
                        </div>

                    </div>
                </div>

            </div>

            {{-- GENERAL HEADER BACKGROUND COLOR --}}
            <div class="form-group">
                <input type="hidden" value="{{ $general_header_bg_color_id }}"
                       id="general_header_bg_color_id" name="general_header_bg_color_id">
                <label class="col-sm-2 control-label">
                    {{ trans('settings.header_bg_color') }}:
                </label>

                <div class="col-sm-8">

                    <div class="input-group"
                         id="general_header_bg_color"
                         name="general_header_bg_color">

                        <input type="text" class="form-control"
                               id="general_header_bg_color_value"
                               name="general_header_bg_color_value"
                               value="{{ $general_header_bg_color_value }}">

                        <div class="input-group-addon">
                            <i></i>
                        </div>

                    </div>
                </div>

            </div>

            {{-- GENERAL PANEL AND TAB LINE COLOR --}}
            <div class="form-group">
                <input type="hidden"
                       id="general_panel_tab_color_id" name="general_panel_tab_color_id"
                       value="{{ $general_panel_tab_color_id }}">
                <label class="col-sm-2 control-label">
                    {{ trans('settings.panel_tab_line_color') }}:
                </label>

                <div class="col-sm-8">

                    <div class="input-group"
                         id="general_panel_tab_color" name="general_panel_tab_color">
                        <input type="text" class="form-control"
                               id="general_panel_tab_color_value"
                               name="general_panel_tab_color_value"
                               value="{{ $general_panel_tab_color_value }}">

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
