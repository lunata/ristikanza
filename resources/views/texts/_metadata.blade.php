    <div class="text-metadata">
    @if (sizeof($text['genres']))
        <p><b>{{trans('text.genre')}}:</b> <i>{{ join(', ', $text['genres']) }}</i></p>
        @endif

        @if (sizeof($text['cycles']))
        <b>{{trans('text.cycle')}}:</b> <i>{{ join(', ', $text['cycles']) }}</i></p>
        @endif

        @if (sizeof($text['motives']))
        <p class="topic-list-title">{{trans('text.motives')}}:</p>
        <div class="topic-list">
            {!! join('<br> ', $text['motives']) !!}
        </div>
        @endif

        @if (sizeof($text['plots'])==1)
        <p><b>{{trans('text.plot')}}:</b> <i>{{ join(', ', $text['plots']) }}</i></p>
        @elseif (sizeof($text['plots'])>1)
        <p class="topic-list-title">{{trans('text.plots')}}:</p>
        <div class="topic-list">
            {!! join("<br>\n", $text['plots']) !!}
        </div>
        @endif

        @if (sizeof($text['topics']))
        <p class="topic-list-title">{{trans('text.topics')}}:</p>
        <div class="topic-list">
            {!! join("<br>\n", $text['topics']) !!}
        </div>
        @endif

        @if (sizeof($text['celebration_places']))
        <p class="topic-list-title">{{trans('text.celebration_places')}}:</p>
        <div class="topic-list">
            {!! join("<br>\n", $text['celebration_places']) !!}
        </div>
        @endif

        @if (sizeof($text['informants']))
            <div class="metadata-title">{{ trans('text.informants')}}:</div>
            <i>{!! join("<br>\n", $text['informants']) !!}</i>
        @endif

        @if ($text['event_place'])
        <p><b>{{ trans('text.record_place')}}:</b>
            <i>{{ $text['event_place'] }}</i></p>
        @endif

        @if ($text['event_date'])
        <p><b>{{ trans('text.record_year')}}:</b>
            <i>{{ $text['event_date'] }}</i></p>
        @endif

        @if ($text['recorders'])
        <p><b>{{ trans('text.recorded')}}:</b> <i>{!! join("<br>\n", $text['recorders']) !!}</i></p>
        @endif

        @if (sizeof($text['source']))
            <div class="metadata-title">{{ trans('text.source') }}:</div>
            <i>{!! join("<br>\n", $text['source']) !!}</i>
        @endif

        @if ($text['mentioned_places'])
        <p><b>{{trans('text.place_mentioned')}}:</b> <i>{{ $text['mentioned_places'] }}</i></p>
        @endif

        @if ($text['comment'])
        <p>{{ $text['comment'] }}</p>
        @endif

    </div>
