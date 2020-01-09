<select id="{{ $id }}" name="{{ $id }}" class="form-control tooltip-enabled"
        data-toggle="tooltip"
        title="{{ ( isset($title) ? $title : '' ) }}">
    @if( !isset($like) || $like == false )
        <option value="0" {{ (isset($selected) && $selected == 0 ) ? 'selected' : '' }}>&nbsp;=&nbsp;</option>
        <option value="1" {{ (isset($selected) && $selected == 1 ) ? 'selected' : '' }}>&nbsp;<>&nbsp;</option>
        <option value="2" {{ (isset($selected) && $selected == 2 ) ? 'selected' : '' }}>&nbsp;>&nbsp;</option>
        <option value="3" {{ (isset($selected) && $selected == 3 ) ? 'selected' : '' }}>&nbsp;<&nbsp;</option>
        <option value="4" {{ (isset($selected) && $selected == 4 ) ? 'selected' : '' }}>&nbsp;>=&nbsp;</option>
        <option value="5" {{ (isset($selected) && $selected == 5 ) ? 'selected' : '' }}>&nbsp;<=&nbsp;</option>
    @else
        <option value="6" {{ (isset($selected) && $selected == 6 ) ? 'selected' : '' }}>like</option>
        <option value="7" {{ (isset($selected) && $selected == 7 ) ? 'selected' : '' }}>not like</option>
    @endif
</select>
