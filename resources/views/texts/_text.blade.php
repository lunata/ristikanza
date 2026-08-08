@if ($text['title'])
    <h4>{{ join(', ', $text['authors']) }}</h4>
    <h3>{{ $text['title'] }}</h3>
    <h5>
        {{ $text['lang'] }}
    @if ($text['dialects'])
        <br>{!! join('<br>', $text['dialects']) !!}
    @endif
    </h5>
@endif      

@if ($text['text'])
    <div id="text">{!! highlight($text['text'], $url_args['search_text'] ?? ''); !!}</div>
@endif      
