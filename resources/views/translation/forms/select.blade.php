<select id="{{ $name }}" name="{{ $name }}" class="form-control">
    @if(isset($optional) && $optional)<option value> ----- </option>@endif

    @foreach($items as $key => $value)
        @if( !empty($value['locale']) )
            <option value="{{ $value['locale'] }}" @if(isset($selected) && $selected === $value['locale']) selected="selected" @endif>{{ $value['name'] }}</option>
        @elseif( !empty( $value['group'] ) )
            <option value="{{ $value['group'] }}" @if(isset($selected) && $selected === $value['group']) selected="selected" @endif>{{ $value['group'] }}</option>
        @endif
    @endforeach

</select>
{{--<div class="select-group">
    <select id="{{ $name }}" name="{{ $name }}" class="select">
        @if(isset($optional) && $optional)<option value> ----- </option>@endif

        @foreach($items as $key => $value)
            @if( !empty($value['locale']) )
                <option value="{{ $value['locale'] }}" @if(isset($selected) && $selected === $value['locale']) selected="selected" @endif>{{ $value['name'] }}</option>
            @elseif( !empty( $value['group'] ) )
                <option value="{{ $value['group'] }}" @if(isset($selected) && $selected === $value['group']) selected="selected" @endif>{{ $value['group'] }}</option>
            @endif
        @endforeach

    </select>

    <div class="caret">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
        </svg>
    </div>
</div>--}}
