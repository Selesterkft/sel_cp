<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert"
            aria-hidden="true">&times;</button>
    <h4>
        <i class="icon fa fa-ban"></i>&nbsp;{{ trans('app.alert') }}
    </h4>
    {{-- @dd('alert.blade', $messages->all(), is_array($messages->all())) --}}
    @if( is_array($messages->all()) )
        <ul>
        @foreach( $messages as $message )
        <li>{{ "{$message->getMessages()}\n" }}</li>
        @endforeach
        </ul>
    @else
        {{ $messages->getMessages() }}
    @endif
</div>
