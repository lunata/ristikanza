
@extends('layouts.base')

@section('title', @trans('navigation.about_full'))
@section('h1', @trans('navigation.about_full'))

@section('headExtra')
    {!! css('fancybox') !!}
@stop

@section('main')
@endsection

@section('footScriptExtra')
    {!! js('fancybox.umd') !!}
    {!! js('special_symbols') !!}
    {!! js('help') !!}
@stop

@section('jqueryFunc')
    toggleSpecial();
@stop
