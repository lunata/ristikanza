@extends('layouts.base')

@section('h1', __('navigation.'. $corpus). '. '. 
             (__('text.folklore_genres')[$url_args['search_genre']] ?? ''))

@include('texts._texts')
