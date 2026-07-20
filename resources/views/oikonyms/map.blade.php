@extends('layouts.base')

@section('title', @trans('navigation.oikonyms'))
@section('h1', @trans('navigation.oikonyms'))

@section('content')
    <div id="map" style="height: 800px;"></div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
@endpush

@push('scripts')
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        const objs = @json($objs);
        const meta = @json($meta);

        const map = L.map('map').setView([61.5, 30.5], 8);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        const markers = [];

        objs.forEach(function (obj) {
            if (!obj.lat || !obj.lng) return;

            const marker = L.marker([obj.lat, obj.lng])
                .bindPopup(
                    `<a href="${obj.url}" target="_blank" rel="noopener noreferrer">${obj.name ?? 'Без названия'}</a>`
                )
                .addTo(map);

            markers.push(marker);
        });

        if (meta.bounds) {
            map.fitBounds(meta.bounds);
        } else if (markers.length) {
            const group = L.featureGroup(markers);
            map.fitBounds(group.getBounds().pad(0.05));
        }
    </script>
@endpush