@extends('layouts.page')

@section('title', $oikonym['name'])
@section('h1', __('navigation.oikonyms_full'))

@section('headExtra')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
         integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
         crossorigin=""/>
    {!! css('map') !!}
    {!! css('table') !!}
@stop

@section('page_top')
    <h2>
        {{ $oikonym['name'] }}

        @if (!empty($oikonym['lang']))
            <small>({{ $oikonym['lang'] }})</small>
        @endif
    </h2>
@stop

@section('top_links')
    <p>
        <a href="{{ route('oikonyms.index') }}" class="top-icon to-list">
            {!! __('messages.back_to_list') !!}
        </a>
    </p>
@stop

@section('content')
    @if (!empty($oikonym['map']))
        <div class="row" style="margin-bottom: 20px;">
            <div class="col-sm-6" style="padding-bottom: 20px;">
                <div id="mapid" style="width: 100%; height: 500px;"></div>
            </div>

            <div class="col-sm-6">
    @endif

    @if (!empty($oikonym['topnames']))
        <p>
            <span class="field-name">{{ __('oikonym.topnames') }}:</span>
            <span class="field-value">{!! join(', ', $oikonym['topnames']) !!}</span>
        </p>
    @endif

    @if (!empty($oikonym['wrongnames']))
        <p>
            <span class="field-name">{{ __('oikonym.wrongnames') }}:</span>
            <span class="field-value">{{ join(', ', $oikonym['wrongnames']) }}</span>
        </p>
    @endif

    @if (!empty($oikonym['location']))
        <p>
            <span class="field-name">{{ __('oikonym.location') }}:</span>
            <span class="field-value">{{ $oikonym['location'] }}</span>
        </p>
    @endif

    @if (!empty($oikonym['location_1926']))
        <p>
            <span class="field-name">{{ __('oikonym.location_1926') }}:</span>
            <span class="field-value">{{ $oikonym['location_1926'] }}</span>
        </p>
    @endif

    @if (!empty($oikonym['main_info']))
        @if (preg_match("/\n/", $oikonym['main_info']))
        <div style="display: flex; margin-bottom: 10px">
            <span class='field-name'>{{ __('oikonym.main_info') }}:</span>
            <span class='field-value'>{!! nl2br(e($oikonym['main_info'])) !!}</span></div>
        @else
        <p><span class='field-name'>{{ __('oikonym.main_info') }}:</span>
            <span class='field-value'>{{ $oikonym['main_info'] }}</span></p>
        @endif
    @endif

    @if (!empty($oikonym['etymology_nation']))
        <p>
            <span class="field-name">{{ __('oikonym.etymology_nation') }}:</span>
            <span class="field-value">{{ $oikonym['etymology_nation'] }}</span>
        </p>
    @endif

    @if (!empty($oikonym['caseform']))
        <p>
            <span class="field-name">{{ __('oikonym.caseform') }}:</span>
            <span class="field-value">{{ $oikonym['caseform'] }}</span>
        </p>
    @endif

    @if (!empty($oikonym['etymology']))
        <p>
            <span class="field-name">{{ __('oikonym.etymology') }}:</span>
            <span class="field-value">{{ $oikonym['etymology'] }}</span>
        </p>
    @endif

    @if (!empty($oikonym['legend']))
        <p>
            <span class="field-name">{{ __('oikonym.legend') }}:</span>
            <span class="field-value">{{ $oikonym['legend'] }}</span>
        </p>
    @endif

    @if (!empty($oikonym['sources']))
        <p style="margin-bottom: 0;">
            <span class="field-name">{{ __('oikonym.mentions_in_sources') }}:</span>
        </p>

        <ol style="padding-left: 20px;">
            @foreach ($oikonym['sources'] as $source)
                <li class="field-value">
                    @if (!empty($source['mention']))
                        <i>{{ $source['mention'] }}</i>@if (!empty($source['source'])) // @endif
                    @endif

                    {!! $source['source'] ?? '' !!}
                </li>
            @endforeach
        </ol>
    @endif

    @if (!empty($oikonym['structs']))
        <p><span class="field-name">{{ __('oikonym.struct') }}</span></p>

        <ol>
            @foreach ($oikonym['structs'] as $struct)
                <li>
                    <span class="field-value">{{ $struct['name'] ?? '' }}</span>

                    @if (!empty($struct['group']))
                        ({{ $struct['group'] }})
                    @endif
                </li>
            @endforeach
        </ol>
    @endif

    @if (!empty($oikonym['map']))
            </div>
        </div>
    @endif

    @if (!empty($oikonym['events']))
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>{{ __('oikonym.record_place') }}</th>
                    <th>{{ mb_ucfirst(trans('messages.year')) }}</th>
                    <th>{{ __('oikonym.informants') }}</th>
                    <th>{{ __('oikonym.recorders') }}</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($oikonym['events'] as $number => $event)
                    <tr>
                        <td>{{ $number + 1 }}</td>
                        <td>{{ $event['place'] }}</td>
                        <td>{{ $event['date'] }}</td>
                        <td>{{ $event['informants'] }}</td>
                        <td>{{ $event['recorders'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@stop

@section('footScriptExtra')
        @include('includes.obj_on_map', ['mapData'=>$oikonym['map'], 'obj_name'=>$oikonym['name']])
@stop
