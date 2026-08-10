@extends('layouts.base')

@section('title', trans('navigation.texts'))
@section('h1', trans('navigation.folklore'))

@section('headExtra')
        {!! css('texts') !!}
@endsection

@section('main')
    <div class="row text-sec-link">
    @foreach ($genres as $genre_id => $genre_name)
        <div class="col">
            <a href="{{ route('texts.folklore', ['search_genre'=>$genre_id]) }}">{{ $genre_name }}</a>
        </div>
    @endforeach
    </div>
@endsection
