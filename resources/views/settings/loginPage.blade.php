<div class="box box-default">
    
    <div class="box-header clearfix">
        <h4 class="box-title pull-left" style="padding-top: 7.5px;">
            {{ __('global.settings.login_page.title') }}
        </h4>
        <div class="btn-group pull-right">
            <button class="btn btn-success btn-sm" 
                    onclick="event.preventDefault();document.getElementById('frmLogin').submit()">
                <i class="fa fa-save"></i>&nbsp;{{ __('global.app_save') }}
            </button>
            <!--<a href="#" class="btn btn-default btn-sm">## Delete</a>-->
            <a href="{{ url('settings.restoreLogin') }}" class="btn btn-danger btn-sm">
                <i class="fa fa-recycle">&nbsp;
                    {{ __('global.app_restore') }}
                </i>
            </a>
        </div>
    </div>
    
    <div class="box-body">
        <form id="frmLogin" name="frmLogin" 
              class="form-horizontal"
              method="post" 
              enctype="multipart/form-data"
              action="{{ url('settings.saveLogin') }}">
            <input name="_method" type="hidden" value="PUT">
            {!! csrf_field() !!}
            
            <div class="form-group">
                <input type="hidden" id="login_wallpaper_id" name="login_wallpaper_id" 
                       value="{{ $login_wallpaper_id }}">
                <label class="col-sm-2 control-label">
                    {{ __('global.settings.login_page.wallpaper') }}:
                </label>
                
                <div class="col-sm-8">
                    @php
                    if( $login_wallpaper_id != 0 )
                    {
                        $login_wallpaper_name = \App\Classes\Helper::timestampRemover($login_wallpaper_value);
                    }
                    @endphp
                    <input type="text" class="form-control" 
                           value="{{ $login_wallpaper_name }}" disabled>
                    
                    {{ Form::file('login_image') }}
                    
                </div>
                
            </div>
            
            <div class="form-group">
                <input type="hidden" 
                       id="login_background_color_id" name="login_background_color_id" 
                       value="{{ $login_background_color_id }}">
                
                <label class="col-sm-2 control-label">
                    {{ __('global.settings.login_page.background_color') }}:
                </label>
                
                <div class="col-sm-8">
                    
                    <div class="input-group" 
                         id="login_background_color" name="login_background_color">
                        <input type="text" class="form-control" 
                               id="login_background_color_value" 
                               name="login_background_color_value" 
                               value="{{ $login_background_color_value }}">
                        
                        <div class="input-group-addon">
                            <i></i>
                        </div>
                        
                    </div>
                    
                </div>
                
            </div>
            <!--
            <div class="form-group">
                <input type="hidden" 
                       id="login_logo_id" name="login_logo_id" 
                       value="{{-- $login_logo_id --}}">
                
                <label class="col-sm-2 control-label">
                    {{-- __('LOGÓ') --}}:
                </label>
                
                <div class="col-sm-8">
                    
                    <input type="text" 
                           id="login_logo_value" name="login_logo_value" 
                           class="form-control" 
                           value="{{-- $login_logo_value --}}">
                    
                </div>
                
            </div>
            -->
        </form>
    </div>
    
    <div class="box-footer"></div>
    
</div>