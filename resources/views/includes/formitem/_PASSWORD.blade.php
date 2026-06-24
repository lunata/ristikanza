<?php 
/*if(!isset($value)) 
    $value = null;
if(!isset($title)) 
    $title = null;
if(!isset($placeholder)) 
    $placeholder = null;
if(!isset($size)) {
    $size = null;*/
    $class = 'form-control';
/*} else {
    $class = null;
}*/
?>
<div class="form-group {!! $errors->has($name) ? 'has-error' : null !!}">
    @if($title)
        {{ html()->label($title, $name); }}
    @endif
    <div class='password'>
        <input class="{{ $class }}" type="password" 
               name="{{ $name }}" id="{{ $name }}" value="{{ old($name) }}"
               placeholder="{{ $placeholder ?? null }}" 
               required="{{ $required ?? null }}">
    {{-- html()->password($name)->placeholder($placeholder ?? null)->class($class)
             ->required($required ?? null); --}}
    <a href="#" id="{{ $name }}-control" class='password-control'></a>        
    </div>
    
    <p class="help-block">{!! $errors->first($name) !!}</p>
</div>