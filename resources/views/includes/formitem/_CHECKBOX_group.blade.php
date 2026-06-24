<?php
if(!isset($checked)) 
    $checked = null;
if(!isset($values)) 
    $values = []; 
?>
<div class="form-group {{ $errors->has($name) || $errors->has($name) ? 'has-error' : '' }}">
    @if(isset($title) && $title)
        <label for="{{$name}}">{{ $title }}</label>
    @endif
    
    @foreach($values as $value=>$t)
        {{ html()->checkbox($name, in_array($value,$checked), $value) }}
	{{ $t }}<br>
    @endforeach 
    <p class="help-block">{!! $errors->first($name) !!}</p>
</div>