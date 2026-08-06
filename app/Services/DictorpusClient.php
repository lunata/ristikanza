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
        $params = $this->normalizeParams($params);
        return 'dictorpus.' . $prefix . '.' . md5(http_build_query($params));
    }


    public function getEthnographicTexts(array $params = []): array
    {
        $locale = app()->getLocale();

        return Cache::remember(
            $this->cacheKey('texts.' . $locale, $params),
            now()->addMinutes(30),
            function () use ($params, $locale) {
                $response = Http::acceptJson()
                    ->withHeaders([
                        'Accept-Language' => $locale,
                    ])
                    ->withToken(config('services.dictorpus.token'))
                    ->timeout(15)
                    ->get(
                        rtrim(config('services.dictorpus.url'), '/') .
                            '/api/ristikanza/texts/ethnographic',
                        $params
                    );

                $response->throw();

                return $response->json();
            }
        );
    }

    public function getText($id)
    {
        return Cache::remember(
            'dictorpus.text.' . $id,
            now()->addHours(6),
            function () use ($id) {
                $response = Http::acceptJson()
                    ->withToken(config('services.dictorpus.token'))
                    ->timeout(10)
                    ->get(
                        rtrim(config('services.dictorpus.url'), '/')
                            . '/api/ristikanza/texts/' . $id
                    );

                $response->throw();

                return $response->json('data');
            }
        );
    }

    public function getTextFormValues(): array
    {
        $locale = app()->getLocale();

        $key = $this->cacheKey(
            'dictorpus.text.form-values.' . $locale,
            []
        );

        return Cache::remember($key, now()->addDay(), function () use ($locale) {
            $response = Http::acceptJson()
                ->withHeaders([
                    'Accept-Language' => $locale,
                ])
                ->withToken(config('services.dictorpus.token'))
                ->timeout(15)
                ->get(
                    rtrim(config('services.dictorpus.url'), '/') .
                        '/api/ristikanza/texts/form-values'
                );

            $response->throw();

            return $response->json();
        });
    }

    public function getDialects(array $params = []): array
    {
        $locale = app()->getLocale();

        $response = Http::acceptJson()
            ->withHeaders([
                'Accept-Language' => $locale,
            ])
            ->withToken(config('services.dictorpus.token'))
            ->timeout(15)
            ->get(
                rtrim(config('services.dictorpus.url'), '/') .
                    '/api/ristikanza/texts/dialects',
                $params
            );

        $response->throw();

        return $response->json();
    }

    public function getDistricts(array $params = []): array
    {
        $locale = app()->getLocale();

        $response = Http::acceptJson()
            ->withHeaders([
                'Accept-Language' => $locale,
            ])
            ->withToken(config('services.dictorpus.token'))
            ->timeout(15)
            ->get(
                rtrim(config('services.dictorpus.url'), '/') .
                    '/api/ristikanza/texts/districts',
                $params
            );

        $response->throw();

        return $response->json();
    }

    public function getGenres(array $params = []): array
    {
        $locale = app()->getLocale();

        $response = Http::acceptJson()
            ->withHeaders([
                'Accept-Language' => $locale,
            ])
            ->withToken(config('services.dictorpus.token'))
            ->timeout(15)
            ->get(
                rtrim(config('services.dictorpus.url'), '/') .
                    '/api/ristikanza/texts/genres',
                $params
            );

        $response->throw();

        return $response->json();
    }

    public function getPlaces(array $params = []): array
    {
        $locale = app()->getLocale();

        $response = Http::acceptJson()
            ->withHeaders([
                'Accept-Language' => $locale,
            ])
            ->withToken(config('services.dictorpus.token'))
            ->timeout(15)
            ->get(
                rtrim(config('services.dictorpus.url'), '/') .
                    '/api/ristikanza/texts/places',
                $params
            );

        $response->throw();

        return $response->json();
    }

    public function getTopics(array $params = []): array
    {
        $locale = app()->getLocale();

        $response = Http::acceptJson()
            ->withHeaders([
                'Accept-Language' => $locale,
            ])
            ->withToken(config('services.dictorpus.token'))
            ->timeout(15)
            ->get(
                rtrim(config('services.dictorpus.url'), '/') .
                    '/api/ristikanza/texts/topics',
                $params
            );

        $response->throw();

        return $response->json();
    }
}
