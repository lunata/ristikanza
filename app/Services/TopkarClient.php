<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class TopkarClient
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

        return 'topkar.' . $prefix . '.' . md5(http_build_query($params));
    }

    public function getNLadogaOikonyms(array $params = []): array
    {
        $locale = app()->getLocale();
        $key = $this->cacheKey('nladoga.oikonyms.' . $locale, $params);

        return Cache::remember($key, now()->addMinutes(30), function () use ($params, $locale) {
            $response = Http::acceptJson()
                ->withHeaders([
                    'Accept-Language' => $locale,
                ])
                ->withToken(config('services.topkar.token'))
                ->timeout(15)
                ->get(
                    rtrim(config('services.topkar.url'), '/') .
                        '/api/ristikanza/nladoga/oikonyms',
                    $params
                );

            $response->throw();

            return $response->json();
        });
    }

    public function getNLadogaOikonym($id): array
    {
        $locale = app()->getLocale();

        $response = Http::acceptJson()
            ->withHeaders([
                'Accept-Language' => $locale,
            ])
            ->withToken(config('services.topkar.token'))
            ->timeout(15)
            ->get(
                rtrim(config('services.topkar.url'), '/') .
                    '/api/ristikanza/nladoga/oikonyms/' . $id
            );

        $response->throw();

        $data = $response->json();

        if (!is_array($data)) {
            throw new \RuntimeException('TopKar returned invalid JSON.');
        }

        return $data;
    }

    public function getNLadogaOikonymsMap(array $params = []): array
    {
        $key = $this->cacheKey('nladoga.oikonyms.map', $params);

        return Cache::remember($key, now()->addHours(6), function () use ($params) {
            $response = Http::acceptJson()
                ->withToken(config('services.topkar.token'))
                ->timeout(20)
                ->get(rtrim(config('services.topkar.url'), '/') . '/api/ristikanza/nladoga/oikonyms/map', $params);

            $response->throw();

            return $response->json();
        });
    }

    public function getNLadogaOikonymFormValues(): array
    {
        $locale = app()->getLocale();

        $key = $this->cacheKey(
            'nladoga.oikonyms.form-values.' . $locale,
            []
        );

        return Cache::remember($key, now()->addDay(), function () use ($locale) {
            $response = Http::acceptJson()
                ->withHeaders([
                    'Accept-Language' => $locale,
                ])
                ->withToken(config('services.topkar.token'))
                ->timeout(15)
                ->get(
                    rtrim(config('services.topkar.url'), '/') .
                        '/api/ristikanza/nladoga/oikonyms/form-values'
                );

            $response->throw();

            return $response->json();
        });
    }

    public function getNLadogaSources(array $params = []): array
    {
        $locale = app()->getLocale();

        $response = Http::acceptJson()
            ->withHeaders([
                'Accept-Language' => $locale,
            ])
            ->withToken(config('services.topkar.token'))
            ->timeout(15)
            ->get(
                rtrim(config('services.topkar.url'), '/') .
                    '/api/ristikanza/nladoga/oikonyms/sources',
                $params
            );

        $response->throw();

        return $response->json();
    }

    public function getNLadogaSettlements(array $params = []): array
    {
        $locale = app()->getLocale();

        $response = Http::acceptJson()
            ->withHeaders([
                'Accept-Language' => $locale,
            ])
            ->withToken(config('services.topkar.token'))
            ->timeout(15)
            ->get(
                rtrim(config('services.topkar.url'), '/') .
                    '/api/ristikanza/nladoga/oikonyms/settlements',
                $params
            );

        $response->throw();
        /*return [
            'sent_params' => $params,
            'topkar_status' => $response->status(),
            'topkar_body' => $response->json(),
        ];*/
        return $response->json();
    }

    public function getNLadogaSettlements1926(array $params = []): array
    {
        $locale = app()->getLocale();

        $response = Http::acceptJson()
            ->withHeaders([
                'Accept-Language' => $locale,
            ])
            ->withToken(config('services.topkar.token'))
            ->timeout(15)
            ->get(
                rtrim(config('services.topkar.url'), '/') .
                    '/api/ristikanza/nladoga/oikonyms/settlements1926',
                $params
            );

        $response->throw();

        return $response->json();
    }

    public function getNLadogaSelsovets1926(array $params = []): array
    {
        $locale = app()->getLocale();

        $response = Http::acceptJson()
            ->withHeaders([
                'Accept-Language' => $locale,
            ])
            ->withToken(config('services.topkar.token'))
            ->timeout(15)
            ->get(
                rtrim(config('services.topkar.url'), '/') .
                    '/api/ristikanza/nladoga/oikonyms/selsovets1926',
                $params
            );

        $response->throw();

        return $response->json();
    }
}
