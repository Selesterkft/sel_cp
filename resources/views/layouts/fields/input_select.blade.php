<div class="form-group col-sm-12">
    <label for="{{ $select_id }}" class="control-label">{{ $title }}</label>
    <div>
        <select id="{{ $select_id }}" name="{{ $select_id }}"
                class="form-control tooltip-enabled">

            @if( $get_option_all )
                <option value="">{{ $get_option_all }}</option>
            @endif

            @if( is_array($elements) )
                @foreach($elements as $key => $val)
                    <option value="{{ $key }}" @if($selected_value == $val) selected @endif>{{ $val }}</option>
                @endforeach
            @elseif( is_object($elements) )
                @foreach($elements as $element)
                    <option value="{{ $element->ID }}" @if($element->ID == $val) selected @endif>{{ $element->Name }}</option>
                @endforeach
            @endif


        </select>
    </div>
</div>
