<?php

namespace App\Http\Controllers;

use App\Services\TopkarClient;
use Illuminate\Http\Request;

class OikonymController extends Controller
{
    private function searchArgs(Request $request): array
    {
        $validated = $request->validate([
            'search_toponym' => ['nullable', 'string', 'max:255'],

            'search_year_from' => ['nullable', 'integer', 'min:1', 'max:2100'],
            'search_year_to' => ['nullable', 'integer', 'min:1', 'max:2100'],

            'search_sources' => ['nullable', 'array'],
            'search_sources.*' => ['integer', 'min:1'],

            'search_districts' => ['nullable', 'array'],
            'search_districts.*' => ['integer', 'min:1'],

            'search_settlements' => ['nullable', 'array'],
            'search_settlements.*' => ['integer', 'min:1'],

            'sort_by' => ['nullable', 'string'],
            'in_desc' => ['nullable', 'in:0,1'],
            'portion' => ['nullable', 'integer'],
            'page' => ['nullable', 'integer', 'min:1'],
        ]);

        $params = [
            'search_toponym' => trim((string)($validated['search_toponym'] ?? '')),

            'search_year_from' => $validated['search_year_from'] ?? null,
            'search_year_to' => $validated['search_year_to'] ?? null,
            'search_sources' => array_values(array_unique($validated['search_sources'] ?? [])),
            
            'search_districts' => array_values(array_unique($validated['search_districts'] ?? [])),
            'search_settlements' => array_values(array_unique($validated['search_settlements'] ?? [])),

            'sort_by' => $validated['sort_by'] ?? 'name',
            'in_desc' => (int)($validated['in_desc'] ?? 0),
            'portion' => (int)($validated['portion'] ?? 10),
            'page' => (int)($validated['page'] ?? 1),
        ];

        if (
            $params['search_year_from']
            && $params['search_year_to']
            && $params['search_year_from'] > $params['search_year_to']
        ) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'search_year_to' => 'Год окончания должен быть не меньше года начала.',
            ]);
        }

        return array_filter($params, function ($value) {
            return $value !== null && $value !== '' && $value !== [];
        });
    }

    public function index(Request $request, TopkarClient $topkar)
    {
        $url_args = $this->searchArgs($request);
//dd($url_args);    
        $result = $topkar->getNLadogaOikonyms($url_args);

        $toponyms = $result['data'] ?? [];
        $current_page = $result['current_page'] ?? 1;
        $last_page = $result['last_page'] ?? 1;
        $total = $result['total'] ?? 0;
        $per_page = $result['per_page'] ?? 10;

        $form_values = $topkar->getNLadogaOikonymFormValues();
        
        return view('oikonyms.index', compact(
            'current_page',
            'form_values',
            'last_page',
            'per_page',
            'toponyms',
            'total',
            'url_args',
        ));
    }

    public function map(Request $request, TopkarClient $topkar)
    {
        $result = $topkar->getNLadogaOikonymsMap($request->query());

        $objs = $result['data'] ?? [];
        $meta = $result['meta'] ?? [];

        return view('oikonyms.map', compact('objs', 'meta'));
    }

    public function show(Request $request, TopkarClient $topkar)
    {
    }
    
    public function sources(Request $request, TopkarClient $topkar)
    {
        $params = $request->validate([
            'q' => ['nullable', 'string', 'max:255'],
            'year_from' => ['nullable', 'integer', 'min:1', 'max:2100'],
            'year_to' => ['nullable', 'integer', 'min:1', 'max:2100'],
        ]);

        $params['q'] = trim((string)($params['q'] ?? ''));

        if (
            !empty($params['year_from'])
            && !empty($params['year_to'])
            && $params['year_from'] > $params['year_to']
        ) {
            return response()->json([]);
        }

        return response()->json(
            $topkar->getNLadogaSources($params)
        );
    }

    public function settlements(Request $request, TopkarClient $topkar)
    {
        $params = $request->validate([
            'q' => ['nullable', 'string', 'max:255'],
            'search_districts' => ['nullable', 'array'],
            'search_districts.*' => ['integer', 'min:1'],
        ]);

        $params['q'] = trim((string)($params['q'] ?? ''));

        return response()->json(
            $topkar->getNLadogaSettlements($params)
        );
    }
    
}