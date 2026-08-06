<div class="output-fields-e {!! $errors->has($name) ? 'has-error' : null !!} {!! !empty($class) ? $class : null !!}">
    <input type="hidden" name="{{ $name }}" value="0">

    <label>
        <input name="{{ $name }}"
                type="checkbox"
                value="{{ $value }}"
                hidden
                {{ $checked ? ' checked' : '' }}>
        <span></span>
    </label>

    <span>{!! $tail !!}</span>

    @if (empty($without_help))
    <p class="help-block">{!! $errors->first($name) !!}</p>
    @endif
</div>
