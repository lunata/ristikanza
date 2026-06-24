<?php 
$id_name = preg_replace("/[\.\]\[]/","_",$name);
$attributes['id'] = $id_name;
if (!isset($value)) { $value = []; }
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
    
    <select id="{{$name}}" name="{{$name}}" class="form-control" {!! $func ?? '' !!}>
        @foreach ($values as $label => $group)
        <optgroup label="{{$label}}">
            @foreach ($group as $v => $t)
            <option value="{{$v}}"
                    @if ($v == $value) selected @endif>{{$t}}</option>
            @endforeach
        </optgroup>
        @endforeach
    </select>
    
    <p class="help-block">{!! $errors->first($name) !!}</p>
</div>