<div class="box box-default">

    <div class="box-header with-border">
        <h3 class="box-title">
            {{ trans('settings.login_page_wallpaper') }} | {{ session()->get('version') }}
        </h3>
    </div>

    <div class="box-body with-border">
        <form id="frmLoginWallpaper" name="frmLoginWallpaper"
              class="form-horizontal"
              action="{{ url('settings.LoginWallpaperSave', $id) }}"
              method="post" enctype="multipart/form-data">
            @csrf

            <input type="hidden"
                   id="LoginWallpaperID" name="LoginWallpaperID"
                   value="{{ $id }}">

            <div class="form-group">

                <label class="col-sm-2 control-label">{{ trans('settings.login_page_wallpaper') }}:</label>

                <div class="col-sm-8">

                    <input type="text"
                           class="form-control"
                           value="{{ $value }}"
                           disabled/>
                    <input type="hidden"
                           id="wallpaper" name="wallpaper"
                           class="form-control"
                           value="{{ $value }}"/>
                    <br/>
                    <!--<input type="file" id="file" name="file">-->
                    {{-- Form::file('image') --}}
                    <div class="dropzone" id="attachments-dropzone" name="attachments-dropzone">

                    </div>
                </div>

            </div>

        </form>
    </div>

    <div class="box-footer with-border">
        <button type="submit" class="btn btn-info"
                onclick="event.preventDefault();document.getElementById('frmLoginWallpaper').submit();">
            <i class="fa fa-save"></i>&nbsp;
            {{ trans('app.save') }}
        </button>
    </div>

</div>
