@extends('layouts.base')

@section('title', __('navigation.map_full'))
@section('h1', __('navigation.map_full'))

@section('headExtra')
    {!! css('select2.min') !!}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
         integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
         crossorigin=""/>
    @if (empty($url_args['not_claster']))
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css">
    @endif
    {!! css('leaflet') !!}
    {!! css('map') !!}
    {!! css('texts') !!}
@stop

@section('main')
    <div id="mapid" style="width: 100%; height: 1200px;"></div>
@stop

@section('footScriptExtra')
        {!! js('select2.min') !!}
        {!! js('lists') !!}
        {!! js('special_symbols') !!}
        @include('includes.objs_on_map', [
            'lon' => 0, 'lat' => 0,
            'cluster' => true,
            'bounds' => $bounds])
@endsection
