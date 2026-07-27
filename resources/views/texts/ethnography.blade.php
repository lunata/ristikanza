@extends('layouts.base')

@section('title', trans('navigation.texts'))
@section('h1', trans('navigation.texts'))

@section('headExtra')
        {!! css('select2.min') !!}
        {!! css('table') !!}
        {!! css('texts') !!}
@endsection

@section('main')
    @if ($total)
    <table class="table table-striped table-hover wide-md">
        <thead>
            <tr>
                <th>&numero;</th>
        @if (empty($url_args['search_lang']))
                <th>{{ trans('text.lang') }}</th>
        @endif
        @if (empty($url_args['search_dialect']))
                <th>{{ trans('text.dialect') }}</th>
        @endif
                <th>{{ trans('text.title') }}</th>
        @if (empty($url_args['search_word']))
                <th>{{ trans('text.translation') }}</th>
        @else
                <th style='text-align: center'>{{ trans('text.sentences') }}</th>
        @endif
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
            @if (empty($url_args['search_lang']))
                <td data-th="{{ trans('text.lang') }}">{{ $text['lang'] }}</td>
            @endif
            @if (empty($url_args['search_dialect']))
                <td data-th="{{ trans('text.dialect') }}">
                    {!! join('<br>', $text['dialect']) !!}<br>
                </td>
            @endif
                <td data-th="{{ trans('text.title') }}">
                    {{ $text['author'] ? $text['author'].'.' : '' }}
                    <a href="{{ route('texts.show',['id'=>$id]) }}{{$args_by_get}}">{!! highlight($text['title'], $url_args['search_w'] ?? '', 'search-word') !!}</a>
                @if (!empty($url_args['search_word']) && !empty($text['transtitle']))
                    <br>({!! highlight($text['transtitle'], $url_args['search_w'] ?? '', 'search-word') !!})
                @endif
                </td>
                <td data-th="{{ trans('text.translation') }}">
                    @if ($text['trans_title'])
                    {{ $text['trans_author'] ? $text['trans_author'].'.' : '' }}
                    {!! highlight($text['trans_title'], $url_args['search_w'] ?? '', 'search-word') !!}
                    @endif
                </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @include('includes.pagination', ['route' => 'texts.ethnography'])
    @else
        <p>{{ __('messages.records_not_found') }}</p>
    @endif
@endsection
