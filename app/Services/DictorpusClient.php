<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class DictorpusClient
{
    protected function normalizeParams(array $params): array
    {
        foreach ($params as $key => $value) {
            if (is_array($value)) {
                sort($value);
                $params[$key] = $value;
            }
        }
        ksort($params);
        return $params;
    }


    protected function cacheKey(string $prefix, array $params = []): string
    {
        $key = 'dictorpus.' . $prefix;
        if (sizeof($params)) {
            $params = $this->normalizeParams($params);
            $key .= '.' . md5(http_build_query($params));
        }
        return $key;
    }

    protected function responseRemember(string $key, $time, $route, array $params = [])
    {
        $locale = app()->getLocale();

        return Cache::remember(
            $this->cacheKey($key . '.' . $locale, $params),
            $time,
            function () use ($params, $locale, $route) {
                $response = Http::acceptJson()
                    ->withHeaders([
                        'Accept-Language' => $locale,
                    ])
                    ->withToken(config('services.dictorpus.token'))
                    ->timeout(15)
                    ->get(
                        rtrim(config('services.dictorpus.url'), '/') .
                            '/api/ristikanza/texts/' . $route,
                        $params
                    );

                $response->throw();

                return $response->json();
            }
        );
    }

    public function getTexts(string $route, array $params = []): array
    {
        return $this->responseRemember('texts', now()->addMinutes(30), $route, $params);
    }

    public function getText($id)
    {
        return $this->responseRemember('text.' . $id, now()->addHours(6), $id, []);
    }

    public function getTextFormValues(array $params = [], $route = 'form-values'): array
    {
        return $this->responseRemember('texts.' . $route, now()->addDay(), $route, $params);
    }

    public function getFolkloreGenres(): array
    {
        return $this->responseRemember('texts.folklore_genres', now()->addDay(), 'folklore_genres', []);
    }

    public function getMonumentBooks(): array
    {
        return $this->responseRemember('texts.monument_books', now()->addDay(), 'monument_books', []);
    }

    public function getObjsForMap(array $params = []): array
    {
        return $this->responseRemember('texts.for_map', now()->addMinutes(30), 'for_map', $params);
    }
}
