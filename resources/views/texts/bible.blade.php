@extends('layouts.page')

@section('title', trans('navigation.texts'))
@section('h1', trans('navigation.bible'))

@section('headExtra')
    {!! css('texts') !!}
@endsection

@section('page_top')
    <h2>{{ $book_title }}</h2>
@stop

@section('top_links')
    <a href="{{ route('texts.bible') }}" class="top-icon to-list">{!! __('messages.back_to_list') !!}</a>
@stop

@section('content')
    @include('texts._texts_with_contents')
@endsection
