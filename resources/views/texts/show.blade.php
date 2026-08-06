@extends('layouts.base')

@section('title', trans('navigation.texts'))
@section('h1', trans('navigation.texts'))

@section('headExtra')
        {!! css('select2.min') !!}
        {!! css('table') !!}
        {!! css('texts') !!}
@endsection

@section('page_top')
    <h2>
        {{ $text->authorsToString() ? $text->authorsToString().'.' : '' }}
        {!!highlight($text->title, $url_args['search_w'], 'search-word')!!}
    </h2>
@stop

@section('top_links')
    <p>
        <a href="{{ route('texts.index') }}" class="top-icon to-list">
            {{ __('messages.back_to_list') }}
        </a>
    </p>
@stop

@section('content')
@endsection
