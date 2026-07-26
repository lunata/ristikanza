@if (!empty($objs))
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin="">
    </script>
    @if (!empty($cluster))
        <script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>
    @endif

    <script src="{{ asset('js/map.js') }}"></script>

    @php
        $objectsForMap = collect($objs)
            ->map(function ($obj) {
                return [
                    'lat' => (float) $obj['lat'],
                    'lon' => (float) $obj['lon'],
                    'color' => $obj['color'],
                    'popup' => $obj['popup'],
                ];
            })
            ->values()
            ->all();

        $mapOptions = [
            'mapId' => 'mapid',

            'lat' => isset($lat) ? (float) $lat : 63.5,
            'lon' => isset($lon) ? (float) $lon : 33,
            'zoom' => isset($zoom) ? (int) $zoom : 7,

            'bounds' => empty($bounds) ? null : [
                'min_lat' => (float) $bounds['min_lat'],
                'min_lon' => (float) $bounds['min_lon'],
                'max_lat' => (float) $bounds['max_lat'],
                'max_lon' => (float) $bounds['max_lon'],
            ],

            'objects' => $objectsForMap,

            'cluster' => !empty($cluster),

            'popupAll' => !empty($url_args['popup_all']),

            'messages' => [
                'selectMinCoords' => __('toponym.click_to_select_min_coords'),
                'selectMaxCoords' => __('toponym.click_to_select_max_coords'),
            ],
        ];
    @endphp

    <script>
        initObjectsMap({!! json_encode($mapOptions) !!});
    </script>
@endif
