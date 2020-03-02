<div class="form-group {{ $errors->has($field) ? 'has-error' : '' }}">
    <label for="{{ $field }}" class="control-label">{{ $label }}</label>
    <div>
        <input id="{{ $field }}"
               name="{{ $field }}"
               class="form-control"
               type="text"
               placeholder="{{ isset($placeholder) ? $placeholder : '' }}"
               value="{{ (old($field)) ? old($field) : $value }}" {{ isset($disabled) ? 'disabled' : '' }}>
        <span class="help-block">
            {{ ($errors->has($field)) ? $errors->first($field) : '' }}
        </span>
    </div>
</div>

{{--<div class="input-group">
    <label for="{{ $field }}">
        {{ $label }}
    </label>
    <input
        class="@if($errors->has($field)) error @endif"
        name="{{ $field }}"
        id="{{ $field }}"
        type="text"
        placeholder="{{ isset($placeholder) ? $placeholder : '' }}"
        value="{{ (old($field)) ? old($field) : $value }}" {{ isset($disabled) ? 'disabled' : '' }}
        {{ isset($required) ? 'required' : '' }}>
    @if($errors->has($field))
        @foreach($errors->get($field) as $error)
            <p class="error-text">{!! $error !!}</p>
        @endforeach
    @endif
</div>--}}
