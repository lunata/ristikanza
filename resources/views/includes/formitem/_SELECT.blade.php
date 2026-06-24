<?php 
$class = 'form-control';
$id_name = preg_replace("/[\.\]\[]/","_",$name);
$attributes['id'] = $id_name;
if (!empty($placeholder)) {
    if (isset($values[''])) {
        $values[''] = $placeholder;
    } else {
        $values = [''=>$placeholder]+$values;
    }
}
?>

<div class="form-group {{ $errors->has($name) || $errors->has($name) ? 'has-error' : '' }}">    
    @if(isset($title) && $title)
	<label for="{{$name}}">
            {{ $title }}
            @if (isset($call_add_onClick)) 
            <i onClick="{{$call_add_onClick}}" class="call-add fa fa-plus fa-lg" title="{{$call_add_title ?? ''}}"></i>
            @endif
        </label>
    @endif
    
    {{ html()->select($name)->id($id_name)->attributes($attributes ?? [])
             ->options($values ?? [])->value($value ?? null)->class($class); }}
    
    <p class="help-block">{!! $errors->first($name) !!}</p>
</div>