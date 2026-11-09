@extends('layouts.page')

@section('title')
{{ trans('main.site_title') }}
@endsection

@section('headExtra')
{!! css('fancybox') !!}
@stop

@section('content')
<div style="font-size:1.5em">
    {!! __('page.about_site') !!}
</div>
@endsection

@section('footScriptExtra')
{!! js('fancybox.umd') !!}
{!! js('special_symbols') !!}
{!! js('help') !!}
@stop

@section('jqueryFunc')
toggleSpecial();
@stop