@extends('layouts.page')

@section('title', trans('navigation.texts'))
@section('h1', $h1)

@section('headExtra')
        {!! css('select2.min') !!}
        {!! css('table') !!}
        {!! css('texts') !!}
@endsection

@section('page_top')
    <h2>
        {{ sizeof($text['authors']) ? join(', ', $text['authors']).'.' : '' }}
        {{ $text['title'] }}
    </h2>
@stop

@section('top_links')
    <a href="{{ route('texts.'. $corpus_route) }}{{ $args_by_get }}" class="top-icon to-list">{!! __('messages.back_to_list') !!}</a>
@stop

@section('content')
    @include('includes.modal',['name'=>'modalOpenBigPhoto',
                          'title'=>$text['event_place'] ?? ''])

    @include('texts._metadata')

    <div class='photos-b'>
        @foreach ($text['photos'] as $photo)
        <img class='photo' src="{{ config('services.dictorpus.url').$photo['src'] }}" data-big="{{ env('DICTORPUS_URL').$photo['big'] }}" data-title="{{ str_replace('"', '\"', $photo['title']) }}">
        @endforeach
    </div>

    @foreach ($text['audiotexts'] as $route)
        <div style='display:flex; margin-bottom: 20px'>
            @include('includes.audio', ['route'=>config('services.dictorpus.url').$route])
        </div>
    @endforeach


    @if (sizeof($text['cyrtext']))
        @include('texts._3_columns')
    @else
        <div class="row corpus-text">
            <div class="col-sm-{{$text['transtext'] ? '6' : '12'}}">
            @include('texts._text')
            </div>
        @if ($text['transtext'])
            <div class="col-sm-6">
            @include('texts._transtext')
            </div>
        @endif
        </div>
    @endif

@endsection

@section('footScriptExtra')
    {!! js('text')!!}
    {!! js('photo')!!}
@stop

@section('jqueryFunc')
    highlightSentences();
    openBigPhoto('.photo');
    toggleColumns();
@stop
