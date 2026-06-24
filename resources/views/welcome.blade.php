
@extends('layouts.master')

@section('title')
{{ trans('main.site_title') }}
@endsection

@section('headExtra')
    {!!Html::style('css/fancybox.css')!!}
@stop

@section('content')
@endsection

@section('footScriptExtra')
    {!!Html::script('js/fancybox.umd.js')!!}
    {!!Html::script('js/special_symbols.js')!!}
    {!!Html::script('js/help.js')!!}
@stop

@section('jqueryFunc')
    toggleSpecial();
@stop
