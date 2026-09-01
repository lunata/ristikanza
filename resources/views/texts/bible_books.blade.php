@extends('layouts.base')

@section('title', trans('navigation.texts'))
@section('h1', trans('navigation.bible'))

@section('headExtra')
        {!! css('texts') !!}
@endsection

@section('main')
    @foreach ($books as $lang => $lang_books)
    <h2>{{ __('general.lang') }} {{ $lang }}</h2>
    <ol>
        @foreach ($lang_books as $book_id => $book_info)
        <li><a href="{{ route('texts.bible', ['book_id' => $book_id])}}">{{ $book_info['title'] }}</a></p>
        @endforeach
    </ol>
    @endforeach
@endsection
