@extends('layouts.base')

@section('title', trans('navigation.texts'))
@section('h1', trans('navigation.folklore'))

@section('headExtra')
        {!! css('texts') !!}
@endsection

@section('main')
    <div class="row">
    @foreach ($genres as $genre_id => $genre_info)
        <div class="col">
            <p class="text-sec-link">
                <a href="{{ route('texts.folklore', ['search_genre'=>$genre_id]) }}">{{ $genre_info['name'] }}</a>
            </p>
            @foreach ($genre_info['genres'] as $sgenre_id => $genre_name)
            <p class="text-sec-link-li">
                <a href="{{ route('texts.folklore', ['search_genre'=>$sgenre_id]) }}">{{ $genre_name }}</a>
            </p>
            @endforeach
        </div>
    @endforeach
    </div>
@endsection
