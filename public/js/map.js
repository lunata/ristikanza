(function (window, $) {
    'use strict';

    function createIcon(color) {
        return L.icon({
            iconUrl: '/img/markers/marker-icon-' + color + '.png',
            iconSize: [30, 41]
        });
    }

    function createIcons(objects) {
        var icons = {};

        $.each(objects, function (_, object) {
            if (!icons[object.color]) {
                icons[object.color] = createIcon(object.color);
            }
        });

        return icons;
    }

    function createMap(options) {
        var map = L.map(options.mapId).setView(
            [options.lat, options.lon],
            options.zoom
        );

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution:
                '&copy; <a href="https://openstreetmap.org/copyright">' +
                'OpenStreetMap contributors</a>'
        }).addTo(map);

        L.control.scale().addTo(map);

        if (options.bounds) {
            map.fitBounds([
                [options.bounds.min_lat, options.bounds.min_lon],
                [options.bounds.max_lat, options.bounds.max_lon]
            ]);
        }

        return map;
    }

    function popupOptions(object, popupAll) {
        var options = {};

        if (object.color !== 'blue' && object.popup.length > 300) {
            options.maxWidth = object.popup.length < 2400
                ? 300 + Math.round((object.popup.length - 300) / 3)
                : 1000;
        }

        if (popupAll) {
            options.autoClose = false;
        }

        return options;
    }

    function createMarker(object, icons, popupAll) {
        var marker = L.marker(
            [object.lat, object.lon],
            {
                icon: icons[object.color]
            }
        ).bindPopup(
            object.popup,
            popupOptions(object, popupAll)
        );

        if (popupAll) {
            marker.openPopup();
        }

        return marker;
    }

    function addMarkers(map, objects, icons, popupAll) {
        $.each(objects, function (_, object) {
            createMarker(object, icons, popupAll).addTo(map);
        });
    }

    function createClusterGroup(color) {
        return L.markerClusterGroup({
            iconCreateFunction: function (cluster) {
                return L.divIcon({
                    html:
                        '<div class="cluster-' + color + '">' +
                        '<span>' + cluster.getChildCount() + '</span>' +
                        '</div>',
                    className: 'custom-cluster',
                    iconSize: L.point(30, 30)
                });
            }
        });
    }

    function addClusterMarkers(map, objects, icons, popupAll) {
        var clusters = {
            blue: createClusterGroup('blue'),
            grey: createClusterGroup('grey'),
            violet: createClusterGroup('violet')
        };

        $.each(objects, function (_, object) {
            var marker = createMarker(object, icons, popupAll);

            if (clusters[object.color]) {
                clusters[object.color].addLayer(marker);
            } else {
                marker.addTo(map);
            }
        });

        $.each(clusters, function (_, cluster) {
            cluster.addTo(map);
        });
    }

    function showCoordinateHint(text) {
        if ($('#coord-hint').length) {
            return;
        }

        $('<div id="coord-hint"></div>')
            .text(text)
            .css({
                position: 'fixed',
                bottom: '20px',
                left: '50%',
                transform: 'translateX(-50%)',
                background: '#333',
                color: '#fff',
                padding: '10px 20px',
                borderRadius: '8px',
                zIndex: 10000,
                fontSize: '14px'
            })
            .appendTo('body')
            .delay(3000)
            .fadeOut(400, function () {
                $(this).remove();
            });
    }

    function initCoordinatePicker(map, messages) {
        var mode = null;

        var $minLat = $('input[name="min_lat"]');
        var $minLon = $('input[name="min_lon"]');
        var $maxLat = $('input[name="max_lat"]');
        var $maxLon = $('input[name="max_lon"]');

        function activateMode(newMode) {
            var $container = $(map.getContainer());
            var scrollTop = $container.offset().top;

            mode = newMode;
            $container.css('cursor', 'help');

            if (mode === 'min') {
                scrollTop += $container.outerHeight() - $(window).height();
            }

            $('html, body').animate({
                scrollTop: scrollTop
            }, 500);

            showCoordinateHint(
                mode === 'min'
                    ? messages.selectMinCoords
                    : messages.selectMaxCoords
            );
        }

        $('#select-min-coords').on('click', function (event) {
            event.preventDefault();
            activateMode('min');
        });

        $('#select-max-coords').on('click', function (event) {
            event.preventDefault();
            activateMode('max');
        });

        map.on('click', function (event) {
            var lat = event.latlng.lat.toFixed(6);
            var lon = event.latlng.lng.toFixed(6);

            if (mode === 'min') {
                $minLat.val(lat);
                $minLon.val(lon);
                $minLat.focus();
            }

            if (mode === 'max') {
                $maxLat.val(lat);
                $maxLon.val(lon);
                $maxLat.focus();
            }

            mode = null;
            $(map.getContainer()).css('cursor', '');
        });
    }

    window.initObjectsMap = function (options) {
        if (!window.L || !options || !options.objects || !options.objects.length) {
            return null;
        }

        var map = createMap(options);
        var icons = createIcons(options.objects);

        if (options.cluster) {
            addClusterMarkers(
                map,
                options.objects,
                icons,
                options.popupAll
            );
        } else {
            addMarkers(
                map,
                options.objects,
                icons,
                options.popupAll
            );
        }

        initCoordinatePicker(map, options.messages);

        return map;
    };

}(window, jQuery));
