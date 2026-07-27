@extends('layouts.base')

@section('title', trans('navigation.texts'))
@section('h1', trans('navigation.texts'))

@section('headExtra')
        {!! css('texts') !!}
@endsection

@section('main')
    <div class="row text-sec-link">
        <div class="col-sm-6">
            <a href="{{ route('texts.ethnography') }}">{{ __('navigation.ethnography') }}</a>
        </div>
        <div class="col-sm-6">
            <a href="#">{{ __('navigation.folklore') }}</a>
        </div>
        <div class="col-sm-6">
            <a href="#">{{ __('navigation.bible') }}</a>
        </div>
        <div class="col-sm-6">
            <a href="#">{{ __('navigation.monuments') }}</a>
        </div>
    </div>
@endsection
