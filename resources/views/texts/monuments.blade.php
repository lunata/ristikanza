@extends('layouts.page')

@section('title', trans('navigation.texts'))
@section('h1', trans('navigation.monuments'))

@section('headExtra')
    {!! css('texts') !!}
@endsection

@section('page_top')
    <h2>{{ $book_title }}</h2>
@stop

@section('top_links')
    <a href="{{ route('texts.monuments') }}" class="top-icon to-list">{!! __('messages.back_to_list') !!}</a>
@stop

@section('content')
    @if (count($texts))
        <ol class="monument-contents">
            @foreach ($texts as $text_id => $text_info)
                @php
                    // убираем название книги из заголовков
                    $title = trim(preg_replace('/^' . preg_quote($book_title, '/') . '\.?\s*/u', '', $text_info['title']));
                @endphp
                <li class="monument-contents-item">
                    <a
                        class="monument-contents-title"
                        href="{{ route('texts.show', ['id'=>$text_id] + $url_args) }}"
                    >
                        {{ $title }}
                    </a>

                    <span class="monument-contents-leader" aria-hidden="true"></span>

                    <span class="monument-contents-pages">
                        {{ $text_info['page'] }}
                    </span>
                </li>
            @endforeach
        </ol>
    @else
        <p>{{ trans('messages.records_not_found') }}</p>
    @endif
@endsection