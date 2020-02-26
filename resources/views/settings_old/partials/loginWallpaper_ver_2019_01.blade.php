<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">
            {{ trans('settings.login_page_wallpaper') }}
        </h3>
    </div>

    <div class="box-body with-border">

        <!--
        <form id="frmLoginWallpaper" name="frmLoginWallpaper"
              class="form-horizontal"
              action="{{ url('settings.LoginWallpaperSave', $id) }}"
              method="post" enctype="multipart/form-data">
            @csrf
        -->
        <form method="POST"
              action="{{ url('settings.LoginWallpaperSave', $id) }}"
              accept-charset="UTF-8"
              enctype="multipart/form-data"
              id="frmLoginWallpaper" name="frmLoginWallpaper"
              class="form-horizontal">
            <input name="_method" type="hidden" value="PUT">
            {!! csrf_field() !!}
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

                    <br/>
                    <!--<input type="file" id="file" name="file">-->
                    {{ Form::file('image') }}
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
