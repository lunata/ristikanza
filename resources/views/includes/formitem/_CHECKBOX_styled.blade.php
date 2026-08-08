<div class="check-field {!! $errors->has($name) ? 'has-error' : null !!} {!! !empty($class) ? $class : null !!}">
    <input type="hidden" name="{{ $name }}" value="0">

    <label class="check-field-label">
        <input type="checkbox" name="{{ $name }}" value="{{ $value }}" hidden {{ $checked ? ' checked' : '' }}>
        <span></span>
        <span>{!! $tail !!}</span>
    </label>


    @if (empty($without_help))
    <p class="help-block">{!! $errors->first($name) !!}</p>
    @endif
</div>
