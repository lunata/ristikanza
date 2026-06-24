<?php
if (!isset($checked)) { $checked = null; }
if (!isset($values)) { $values = []; }
//dd($checked, 0===$checked);
?>
<div class="{{!empty($class) ? $class : ''}} {!! $errors->has($name) ? 'has-error' : null !!}">
    @if(isset($title))
	<label for="{{$name}}">{{ $title }}</label>&nbsp;
    @endif
    
    @foreach ($values as $value=>$tail)
        @if (isset($with_break) && $with_break) 
        <br>
        @endif
<?php //dd($value, $checked, $value===$checked) ?>        
        <input type="radio" name="{{ $name }}" id="{{ $name }}_{{ $value }}" value="{{ $value }}" @if ($value===$checked) checked @endif>
        {{$tail ?? null}}&nbsp;
    @endforeach

    @if (empty($without_help))
    <p class="help-block">{!! $errors->first($name) !!}</p>
    @endif
</div>