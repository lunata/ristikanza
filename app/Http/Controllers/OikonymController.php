<?php

namespace App\Http\Controllers;

use App\Services\TopkarClient;
use Illuminate\Http\Request;

class OikonymController extends Controller
{
    private $topkarClient;

    public function __construct(TopkarClient $topkarClient)
    {
        $this->topkarClient = $topkarClient;
    }


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

            'search_districts1926' => ['nullable', 'array'],
            'search_districts1926.*' => ['integer', 'min:1'],

            'search_selsovets1926' => ['nullable', 'array'],
            'search_selsovets1926.*' => ['integer', 'min:1'],

            'search_settlements1926' => ['nullable', 'array'],
            'search_settlements1926.*' => ['integer', 'min:1'],

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
            'search_districts1926' => array_values(array_unique($validated['search_districts1926'] ?? [])),
            'search_selsovets1926' => array_values(array_unique($validated['search_selsovets1926'] ?? [])),
            'search_settlements1926' => array_values(array_unique($validated['search_settlements1926'] ?? [])),

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

    public function index(Request $request)
    {
        $url_args = $this->searchArgs($request);
        //dd($url_args);
        $result = $this->topkarClient->getNLadogaOikonyms($url_args);

        $toponyms = $result['data'] ?? [];
        $current_page = $result['current_page'] ?? 1;
        $last_page = $result['last_page'] ?? 1;
        $total = $result['total'] ?? 0;
        $per_page = $result['per_page'] ?? 10;

        $form_values = $this->topkarClient->getNLadogaOikonymFormValues();

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

    public function map(Request $request)
    {
        $result = $this->topkarClient->getNLadogaOikonymsMap($request->query());

        $objs = $result['data'] ?? [];
        $meta = $result['meta'] ?? [];

        return view('oikonyms.map', compact('objs', 'meta'));
    }

    public function show(int $id)
    {
        $oikonym = $this->topkarClient->getNLadogaOikonym($id);
        return view('oikonyms.show', compact('oikonym'));
    }

    public function sources(Request $request)
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
            $this->topkarClient->getNLadogaSources($params)
        );
    }

    public function settlements(Request $request)
    {
        $params = $request->validate([
            'q' => ['nullable', 'string', 'max:255'],
            'districts' => ['nullable', 'array'],
            'districts.*' => ['integer', 'min:1'],
        ]);

        $params['q'] = trim((string)($params['q'] ?? ''));

        return response()->json(
            $this->topkarClient->getNLadogaSettlements($params)
        );
    }

    public function settlements1926(Request $request)
    {
        $params = $request->validate([
            'q' => ['nullable', 'string', 'max:255'],
            'districts' => ['nullable', 'array'],
            'districts.*' => ['integer', 'min:1'],
            'selsovets' => ['nullable', 'array'],
            'selsovets.*' => ['integer', 'min:1'],
        ]);

        $params['q'] = trim((string)($params['q'] ?? ''));

        return response()->json(
            $this->topkarClient->getNLadogaSettlements1926($params)
        );
    }

    public function selsovets1926(Request $request)
    {
        $params = $request->validate([
            'q' => ['nullable', 'string', 'max:255'],
            'districts' => ['nullable', 'array'],
            'districts.*' => ['integer', 'min:1'],
        ]);

        $params['q'] = trim((string)($params['q'] ?? ''));

        return response()->json(
            $this->topkarClient->getNLadogaSelsovets1926($params)
        );
    }
}
