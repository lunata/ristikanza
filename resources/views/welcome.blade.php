
@extends('layouts.base')

@section('title')
{{ trans('main.site_title') }}
@endsection

@section('headExtra')
    {!! css('fancybox') !!}
@stop

@section('content')
@endsection

@section('footScriptExtra')
    {!! js('fancybox.umd') !!}
    {!! js('special_symbols') !!}
    {!! js('help') !!}
@stop

@section('jqueryFunc')
    toggleSpecial();
@stop
