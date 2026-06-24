<?php
        if (isset($args_by_get)) {
            $route .= $args_by_get;
        }
        if (isset($without_text) && $without_text) {
            $link_text = '';
        } elseif(!isset($link_text) || !$link_text) {
            $link_text = ' '.trans('messages.edit');
        }
        $link = LaravelLocalization::localizeURL($route);
?>
<a  href="{{ $link }}">@include('includes.icons.edit'){{ $link_text }}</a>