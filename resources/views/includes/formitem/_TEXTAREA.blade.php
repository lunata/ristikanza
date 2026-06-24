<?php 
$classes = 'form-control';    

if (isset($class)) {
    $classes .= ' '.$class;
}

$id_name = preg_replace("/[\.\]\[]/","_",$name);
?>
<div class="form-group {!! $errors->has($name) ? 'has-error' : null !!}">
    @if(isset($title) && $title)
        {{ html()->label($title, $name); }}
        <span class='imp'>{!! isset($help_text) ? $help_text : '' !!}</span>
    @endif

    {{ html()->textarea($name, $value ?? null)->placeholder($placeholder ?? null)
             ->class($classes)->id($id_name)->required($required ?? null)->attribute('rows', $rows ?? 3); }}
    <p class="help-block">
        {!! $errors->first($name) !!}
    </p>
</div>