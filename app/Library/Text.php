<?php

namespace App\Library;

class Text
{
    const routes = [
        2 => 'bible',
        4 => 'folklore',
        12 => 'monuments',
        15 => 'ethnographic'
    ];

    public static function routesByCorpusId($corpus_id)
    {
        return self::routes[$corpus_id] ?? null;
    }

    public static function getBounds(array $objs): array
    {
        $bounds = ['min_lat' => null, 'min_lon' => null, 'max_lat' => null, 'max_lon' => null];
        foreach (array_keys($objs) as $coord) {
            list($lat, $lon) = explode("_", $coord);
            $lat = (float) $lat;
            $lon = (float) $lon;

            if ($bounds['min_lat'] === null || $lat < $bounds['min_lat']) {
                $bounds['min_lat'] = $lat;
            }
            if ($bounds['max_lat'] === null || $lat > $bounds['max_lat']) {
                $bounds['max_lat'] = $lat;
            }
            if ($bounds['min_lon'] === null || $lon < $bounds['min_lon']) {
                $bounds['min_lon'] = $lon;
            }
            if ($bounds['max_lon'] === null || $lon > $bounds['max_lon']) {
                $bounds['max_lon'] = $lon;
            }
        }
        return $bounds;
    }
}
