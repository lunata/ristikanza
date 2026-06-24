<?php     
$id_name = preg_replace("/[\.\]\[]/","_",$name);
?>
<div class="form-group {!! $errors->has($name) ? 'has-error' : null !!}">
    @if(isset($title) && $title)
        {{ html()->label($title, $name); }}
    @endif
    
    <input id="{{ $id_name }}" type="file" name="{{ $name }}" class="form-control">

    @if (isset($field_comments))
    <span class='field_comments'>{{$field_comments}}</span>
    @endif
    
    @if (isset($help_func) && $help_func) 
    <i class='help-icon far fa-question-circle fa-lg' onClick='{{$help_func}}'></i>
    @endif
    
    <p class="help-block">{!! $errors->first($name) !!}</p>
</div>