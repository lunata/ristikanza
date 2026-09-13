@extends('layouts.base')

@section('title', trans('navigation.texts'))
@section('h1', trans('navigation.bible'))

@section('headExtra')
        {!! css('select2.min') !!}
        {!! css('texts') !!}
@endsection

@section('main')
    <div class="row">
        <div class="col-lg-8">
            @foreach ($books as $lang => $lang_books)
            <h3>{{ __('general.lang') }} {{ $lang }}</h3>
            <ol>
                @foreach ($lang_books as $book_id => $book_info)
                <li><a href="{{ route('texts.bible', ['book_id' => $book_id])}}">{{ $book_info['title'] }}</a></p>
                @endforeach
            </ol>
            @endforeach
        </div>
        <div class="col-lg-4">
            @include('texts._bible_search')
        </div>
    </div>
@endsection

@section('footScriptExtra')
    {!! js('select2.min') !!}
@endsection

@section('jqueryFunc')
    $('.select-lang').select2({ width: '100%' });
    $('.select-bible').select2({ width: '100%' });
@endsection

