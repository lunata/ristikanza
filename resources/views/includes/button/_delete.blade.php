<?php
    if (!isset($args)) {
        $args = [];
    }

    if (isset($url_args)) {
        $args = array_merge($args,$url_args);
    }
//dd($route, $args);
    $link = URL::route($route, $args);
//    $link = '/'.plural_from_model($obj_name).'/'.$obj->id.'?'.search_values_by_URL($args);
    $token = csrf_token();
    $alt = \Lang::get('messages.delete');
    
    if (!empty($without_text)) {
        $title = '';
    } else {
        $title = \Lang::get('messages.delete');
    }
/*
    $format = '<a href="%s" data-toggle="tooltip" data-delete%s="%s" title="%s"';

    if (isset($is_button) && $is_button) {
        $format .= ' class="btn btn-xs btn-danger btn-small"';
    }

    $format .= '><i class="fa fa-trash fa-lg'. (isset($class) ? ' '.$class : ''). '"></i>%s</a>';

    print sprintf($format, $link, !empty($what_delete) ? $what_delete : '', $token, $alt, $title ? ' '.$title : '');*/
    ?>
<a href="{{ $link }}" data-toggle="tooltip" data-delete{{ !empty($what_delete) ? $what_delete : '' }}="{{ $token }}" 
   title="{{ $alt }}">@include('includes.icons.delete'){{ $title ? ' '.$title : '' }}</a>
