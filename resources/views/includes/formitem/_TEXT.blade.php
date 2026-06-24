<?php     
$classes = isset($size) ? 'form-control-sized' : 'form-control';    

if (isset($class)) {
    $classes .= ' '.$class;
}

$id_name = preg_replace("/[\.\]\[]/","_",$name);
$error_name = $id_name// rtrim(preg_replace("/\_+/",".",$id_name),'.'); не работает для имен с подчеркиванием
?>
<div id="group-{{ $id_name }}" class="form-group {!! $errors->has($error_name) ? 'has-error' : null !!}">
    @if(isset($title) && $title)
        {{ html()->label($title, $name); }}
    @endif
    
    {{ html()->text($name, $value ?? null)->placeholder(!empty($placeholder) ? mb_ucfirst($placeholder) : null)
             ->class($classes)->id($id_name)->required($required ?? null)
             ->size($size ?? null)->attributes($attributes ?? []); }}

    @if (isset($field_comments))
    <span class='field_comments'>{{$field_comments}}</span>
    @endif
    
    @if (isset($help_func) && $help_func) 
    <i class="help-icon fa-regular fa-question-circle fa-lg" onClick='{{$help_func}}'></i>
    @endif
    
    <p id="help-block-{{ $id_name }}" class="help-block">{!! $errors->first($error_name) !!}</p>
</div>