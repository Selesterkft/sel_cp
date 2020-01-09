{{-- dd(2, $messages) --}}
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert"
            aria-hidden="true">&times;</button>
    <h4>
        <i class="icon fa fa-check"></i>&nbsp;{{ __('global.app_success') }}
    </h4>

    @if( is_array($messages) )
        <ul>
        @foreach( $messages as $message )
        <li>{{ "{$message}\n" }}</li>
        @endforeach
        </ul>
    @else
        {{ $messages }}
    @endif
</div>
