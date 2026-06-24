<?php     
$classes = 'form-control'. (!empty($class) ? ' '.$class : '');
$id_name = preg_replace("/[\.\]\[]/","_",$name);
?>
<div class="form-group {!! $errors->has($name) ? 'has-error' : null !!}">
    @if(isset($title) && $title)
        {{ html()->label($title, $name); }}
    @endif
    
    <input class="{{ $classes }}" type="tel"
           name="{{ $name }}" id="{{ $id_name }}" value="{{ $value ?? old($name) }}"
           placeholder="{{ $placeholder ?? null }}"
        @if (!empty($required))
           required
        @endif
    >
<!-- pattern="[\+]?\d[\(\s\)-]*\d[\(\s\)-]*[\(\s\)-]*\d[\(\s\)-]*\d[\(\s\)-]*\d[\(\s\)-]*\d[\(\s\)-]*\d[\(\s\)-]*\d[\(\s\)-]*\d[\(\s\)-]*\d[\(\s\)-]*\d"-->
    @if (isset($field_comments))
    <span class='field_comments'>{{$field_comments}}</span>
    @endif
    
    @if (isset($help_func) && $help_func) 
    <i class='help-icon far fa-question-circle fa-lg' onClick='{{$help_func}}'></i>
    @endif
    
    <p class="help-block">{!! $errors->first($name) !!}</p>
</div>