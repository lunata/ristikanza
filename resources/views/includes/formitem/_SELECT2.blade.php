<?php 
if(!isset($value)) {
    $value = [];
} else {
    $value = (array)$value;
}
if(!isset($values)) 
    $values = array(); 

$multiple = !isset($is_multiple) || $is_multiple? ' multiple' : '';

if (empty($class)) {
    $class = 'multiple-select form-control';
}
$id_name = preg_replace("/[\.\]\[]/","_",$name);
?>
<div class="form-group {{ $errors->has($name) || $errors->has($name) ? 'has-error' : '' }} {{$group_class ?? null }}"
     id="{{ $id ?? '' }}" 
     @if(!empty($style))
     style="{{ $style }}"
     @endif
     >
    @if(!empty($title))
    <label for="{{$name}}{{$multiple ? '[]': ''}}">
        {{ $title }}
        @if (isset($call_add_onClick)) 
        <i onClick="{{$call_add_onClick}}" class="call-add fa fa-plus fa-lg" title="{{$call_add_title ?? ''}}"></i>
        @endif
    </label>
    @endif
    <select{{ $multiple }} class="{{ $class }}" name="{{ $name }}{{$multiple ? '[]': ''}}" id="{{ $id_name }}" placeholder="choooose" {{$event ?? null}}>
        <!--option></option-->
    @if (!empty($grouped))
        @foreach ($values as $group_name=>$group_values)
        <optgroup label="{{$group_name}}">
            @foreach ($group_values as $key=>$val)
                <option value="{{$key}}"{{ in_array($key,$value) ? ' selected' : '' }}>{{$val}}</option>
            @endforeach
        </optgroup>
        @endforeach
    @else 
        @foreach ($values as $key=>$val)
            <option value="{{$key}}"{{ in_array($key,$value) ? ' selected' : '' }}
                    {{ !empty($disabled) && in_array($key,$disabled) ? '  disabled="disabled"' : '' }}>{{$val}}</option>
        @endforeach
    @endif
    </select>
    
    @if (isset($field_comments))
    <span class='field_comments'>{{$field_comments}}</span>
    @endif
    
    @if (isset($help_func) && $help_func) 
    <i class='help-icon far fa-question-circle fa-lg' onClick='{{$help_func}}'></i>
    @endif
    
    <p class="help-block">{!! $errors->first($name) !!}</p>
</div>
