@extends('layouts.base')

@section('title', trans('navigation.texts'))
@section('h1', trans('navigation.monuments'))

@section('headExtra')
        {!! css('texts') !!}
@endsection

@section('main')
    @foreach ($books as $lang => $lang_books)
    <h2>{{ __('general.lang') }} {{ $lang }}</h2>
    <div class="row">
        @foreach ($lang_books as $book_id => $book_info)
        <div class="col-sm-3">
            <div class="book-b">
            @if ($book_info['photo'])
                <img class='photo' src="{{ config('services.dictorpus.url').$book_info['photo'] }}">
            @endif
                <p class="book-title"><a href="{{ route('texts.monuments', ['book_id' => $book_id])}}">{{ $book_info['title'] }}</a></p>
            </div>
        </div>
        @endforeach
    </div>
    @endforeach
@endsection
