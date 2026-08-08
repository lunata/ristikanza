@if (isset($text['transtext']['title']))
    <h4>{{ $text['transtext']['authors'] }}</h4>
    <h3>{{ $text['transtext']['title'] }}</h3>
    <h5>{{ $text['transtext']['lang'] }}</h5>
@endif      
@if (isset($text['transtext']['text']))
    <div id="transtext">{!! highlight($text['transtext']['text'], $url_args['search_text'] ?? '') !!}</div>
@endif      
