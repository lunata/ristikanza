@extends('layouts.base')

@section('title', __('navigation.oikonyms'))
@section('h1', __('navigation.oikonyms_full'))

@section('headExtra')
    {!! css('select2.min') !!}  
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
         integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
         crossorigin=""/>
    {!! css('map') !!}  
    {!! css('leaflet') !!}  
@stop

@section('search_form')
    @include('oikonyms._search_form', ['route'=>'oikonyms.on_map', 'for_map' => true])
    <div class="row" style='line-height: 26px;'>
         <div class="col-sm-6 total-rec">
    @if ($meta['show_count'] == $meta['total_rec'])
            @include('includes.found_records', ['n_records'=>number_format($meta['total_rec'])])
    @else
        <p>{!! __('oikonym.found_from', 
            ['show_count'=>number_format($meta['show_count'], 0, ',', ' '), 
             'total'=>number_format($meta['total_rec'], 0, ',', ' ')]) !!}
        </p>
    @endif
         </div>
         <div class="col-sm-6 output_in">
            @if ($meta['total_rec'])
            <a href="{{ route('oikonyms.index').search_values_by_URL($url_args) }}">{!! __('oikonym.back_to_index') !!}</a>
            @endif 
         </div>
    </div>
@endsection

@section('wide-block')   
    @if (empty($url_args['only_exact_coords']))
    <div class="row" style="margin-bottom: 20px;">
        <div class="col-sm-4"><img src="/img/markers/marker-icon-blue.png" class="legend-icon"> 
            {{ __('oikonym.coord_toponym') }}</div>
        <div class="col-sm-4"><img src="/img/markers/marker-icon-grey.png" class="legend-icon"> 
            {{ __('oikonym.coord_settl') }}</div>
        <div class="col-sm-4"><img src="/img/markers/marker-icon-violet.png" class="legend-icon"> 
            {{ __('oikonym.coord_toponyms') }}</div>
    </div>
    @endif
    <div id="mapid" style="width: 100%; height: {{ $url_args['map_height'] }}px;"></div>
@stop

@section('footScriptExtra')
        {!! js('select2.min') !!}
        {!! js('lists') !!}
        {!! js('special_symbols') !!}
        @include('includes.objs_on_map'.(empty($url_args['not_claster']) ? '_claster' : ''), [
            'lon' => $url_args['min_lon']+($url_args['max_lon']-$url_args['min_lon'])/2,
            'lat' => $url_args['min_lat']+($url_args['max_lat']-$url_args['min_lat'])/2,
            'bounds' => $meta['bounds']])
@endsection

@section('jqueryFunc')
        selectSource(@json(app()->getLocale()), '{{ trans('oikonym.sources') }}');
        $('.select-district').select2({
            allowClear: true,
            placeholder: '{{ trans('oikonym.district') }}',
            width: '100%'
        });
        selectSettlement('search_districts', @json(app()->getLocale()), '{{ trans('oikonym.settlement') }}', false);
        selectSelsovet1926('search_districts1926', @json(app()->getLocale()), '{{ trans('oikonym.selsovet_volost') }}', false);
        selectSettlement1926('search_districts1926', 'search_selsovets1926', @json(app()->getLocale()), '{{trans('oikonym.settlement')}}', false);
        $('.select-district1926').select2({
            allowClear: true,
            placeholder: '{{ trans('oikonym.district') }}',
            width: '100%'
        });
        
        $('input[type=reset]').on('click', function (e) {
        @foreach (['districts', 'settlements', 'districts1926', 'selsovets1926', 'settlements1926', 'sources'] as $f)
            $('#search_{{ $f }}').val(null).trigger('change');
        @endforeach
        @foreach (['min_lat', 'min_lon', 'max_lat', 'max_lon', 'map_height'] as $f)
            $('#{{ $f }}').attr('value','');
        @endforeach
        setTimeout(function () {
        @foreach (['outside_bounds', 'popup_all', 'only_exact_coords'] as $f)
            $('input[name="{{ $f }}"]').prop('checked', false);
        @endforeach
        });
            $('#search_toponym').attr('value','');
        });        
@stop
