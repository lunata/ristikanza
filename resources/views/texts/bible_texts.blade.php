@extends('layouts.base')

@section('title', trans('navigation.texts'))
@section('h1', trans('navigation.bible'))

@section('headExtra')
        {!! css('select2.min') !!}
        {!! css('texts') !!}
@endsection

@section('search_form')
    @include('texts._bible_search', ['is_wide' => true])
    @include('includes.found_records', ['n_records'=>$total])
@endsection

@section('main')
    @if ($total)
    <table class="table table-striped table-hover wide-md">
        <thead>
            <tr>
                <th>&numero;</th>
        @if (empty($url_args['search_lang']) || sizeof($url_args['search_lang'])>1)
                <th>{{ trans('general.lang') }}</th>
        @endif
                <th>{{ trans('text.title') }}</th>
                <th>{{ trans('text.translation') }}</th>
                <th>{{ trans('text.bible_passage') }}</th>
            </tr>
        </thead>

        <tbody>
        @foreach ($texts as $text)
            @php
                $id = data_get($text, 'id');
                $author = data_get($text, 'author');
            @endphp

            <tr>
                <td>
                    {{ ($current_page - 1) * $per_page + $loop->iteration }}
                </td>
            @if (empty($url_args['search_lang']) || sizeof($url_args['search_lang'])>1)
                <td data-th="{{ trans('text.lang') }}">{{ $text['lang'] }}</td>
            @endif
                <td data-th="{{ trans('text.title') }}">
                    {{ $text['author'] ? $text['author'].'.' : '' }}
                    <a href="{{ route('texts.show',['id'=>$id]) }}{{$args_by_get}}">{{ $text['title'] }}</a>
                </td>
                <td data-th="{{ trans('text.translation') }}">
                    @if ($text['trans_title'])
                    {{ $text['trans_author'] ? $text['trans_author'].'.' : '' }}
                    {{ $text['trans_title'] }}
                    @endif
                </td>
                <td data-th="{{ trans('text.bible_passage') }}">
                    {{ $text['bible_passage'] }}
                    @if ($text['parallel_passages']) 
                    <br>({{ $text['parallel_passages'] }})
                    @endif
                </td>
            </tr>
                @endforeach
            </tbody>
        </table>

        @include('includes.pagination', ['route' => 'texts.bible_texts'])
    @else
        <p>{{ __('messages.records_not_found') }}</p>
    @endif
@endsection

@section('footScriptExtra')
    {!! js('select2.min') !!}
@endsection

@section('jqueryFunc')
    $('.select-lang').select2({ width: '100%' });
    $('.select-bible').select2({ width: '100%' });
@endsection

