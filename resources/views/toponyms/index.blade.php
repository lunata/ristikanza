
@extends('layouts.base')

@section('title', @trans('navigation.toponyms_full'))
@section('h1', @trans('navigation.toponyms_full'))

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
