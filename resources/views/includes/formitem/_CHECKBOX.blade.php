<div class="{!! $errors->has($name) ? 'has-error' : null !!} {!! !empty($class) ? $class : null !!}">
    @if (!empty($title))
	<label for="{{$name}}">{!! $title !!}</label>
    @endif
    
    {{ html()->checkbox($name, $checked ?? null, $value ?? null) }}
    
    @if (!empty($tail))
	<label for="{{$name}}">{!! $tail !!}</label>
    @endif
    
    @if (empty($without_help))
    <p class="help-block">{!! $errors->first($name) !!}</p>
    @endif
</div>