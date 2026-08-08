    <h4></h4>
@if (isset($text['cyrtext']['title']))
    <h3>{{ $text['cyrtext']['title'] }}</h3>
@endif      
@if ($text['cyrtext']['text'])
    <div id="cyrtext">{!! highlight($text['cyrtext']['text'], $url_args['search_text'] ?? '') !!}</div>
@endif      
