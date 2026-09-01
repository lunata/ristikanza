    @if (count($texts))
        @foreach ($texts as $section_title => $section_texts)
            @if ($section_title)
        <h4>{{ $section_title }}</h4>
            @endif
        <ol class="book-contents">
            @foreach ($section_texts as $text_id => $text_info)
                @php
                    // убираем название книги из заголовков
                    $title = trim(preg_replace('/^' . preg_quote($book_title, '/') . '\.?\s*/u', '', $text_info['title']));
                @endphp
                <li class="book-contents-item">
                    <a
                        class="book-contents-title"
                        href="{{ route('texts.show', ['id'=>$text_id] + $url_args) }}"
                    >
                        {{ $title }}
                    </a>

                    <span class="book-contents-leader" aria-hidden="true"></span>

                    <span class="book-contents-pages">
                        {{ $text_info['page'] }}
                    </span>
                </li>
            @endforeach
        </ol>
        @endforeach
    @else
        <p>{{ trans('messages.records_not_found') }}</p>
    @endif
