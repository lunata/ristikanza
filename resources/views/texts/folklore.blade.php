@extends('layouts.base')

@section('h1', __('navigation.'. $corpus).
                ( isset($url_args['genre_name']) ? '. '.$url_args['genre_name'] : ''))
@section('h1_link', route('texts.folklore'))

@include('texts._texts')
