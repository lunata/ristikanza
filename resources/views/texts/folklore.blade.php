@extends('layouts.base')

@section('h1', __('navigation.'. $corpus).
                ( $url_args['genre_name'] ? '. '.$url_args['genre_name'] : ''))

@include('texts._texts')
