@extends('layouts.base')

@section('title', trans('navigation.texts'))
@section('h1', trans('navigation.texts'))

@section('headExtra')
        {!! css('texts') !!}
@endsection

@section('main')
    <div class="row text-sec-link">
        <div class="col-sm-6">
            <a href="{{ route('texts.ethnographic') }}">{{ __('navigation.ethnographic') }}</a>
        </div>
        <div class="col-sm-6">
            <a href="{{ route('texts.folklore') }}">{{ __('navigation.folklore') }}</a>
        </div>
        <div class="col-sm-6">
            <a href="#">{{ __('navigation.bible') }}</a>
        </div>
        <div class="col-sm-6">
            <a href="#">{{ __('navigation.monuments') }}</a>
        </div>
    </div>
@endsection
