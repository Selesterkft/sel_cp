@extends('layouts.app')

@section('title', __('BEÁLLÍTÁSOK'))

@section('content')

<section class="content-header">
    <h1>
        {{ __('BEÁLLÍTÁSOK') }}
        <small>{{ __('EGYÉNI BEÁLLÍTÁSOK') }}</small>
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ url('/') }}">
                <i class="fa fa-dashboard"></i>&nbsp;
                {{ __('global.app_dashboard') }}
            </a>
        </li>

        <li class="active">
            <i class="fa fa-users"></i>&nbsp;
            {{ __('BEÁLLÍTÁSOK') }}
        </li>

    </ol>
</section>

<section class="content">
    @php
    $n = "settings.partials.loginWallpaper_" . session()->get('version');
    //dd('settings.index', $n);
    @endphp
    @if(count($settings) == 0)
        @include($n, ['id' => '0', 'value' => ''])
    @else
        @foreach($settings as $setting)
        @if( $setting->PropertyName == 'Login_Wallpaper' )
        @include($n, ['id' => $setting->ID, 'value' => $setting->PropertyValue])
        @endif
        
        {{--@if( $settings->PropertyName == 'favicon' )--}}
        @includeIf('settings.partials.favicon')
        {{--@endif--}}
        
        @endforeach
    @endif
    
</section>

@endsection

@section('css')
@if( session()->get('version') == 'ver_2019_02' )
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
@endif
@endsection

@section('js')
@if( session()->get('version') == 'ver_2019_02' )
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<script>
    var uploadedAttachmentsMap = {};
    Dropzone.options.attachmentsDropzone = {
        url: '{{ url('settings.StoreMedia') }}',
        maxFilesize: 2, // MB
        addRemoveLinks: true,
        headers: {
          'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        params: {
          size: 2
        },
        success: function (file, response) {
          $('form').append('<input type="hidden" name="attachments[]" value="' + response.name + '">')
          uploadedAttachmentsMap[file.name] = response.name
        },
        removedfile: function (file) {
          file.previewElement.remove()
          var name = ''
          if (typeof file.file_name !== 'undefined') {
            name = file.file_name
          } else {
            name = uploadedAttachmentsMap[file.name]
          }
          $('form').find('input[name="attachments[]"][value="' + name + '"]').remove()
        },
        init: function () {
@if(count($settings) == 0)
          var files =
            {!! json_encode($ticket->attachments) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="attachments[]" value="' + file.file_name + '">')
            }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endif
@endsection