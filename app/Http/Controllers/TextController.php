<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\DictorpusClient;

class TextController extends Controller
{
    private $dictorpusClient;

    public function __construct(DictorpusClient $dictorpusClient)
    {
        $this->dictorpusClient = $dictorpusClient;
    }

    private function searchArgs(Request $request): array
    {
        $validated = $request->validate([
            'search_author' => ['nullable', 'string', 'max:255'],

            'search_birth_district'  => ['nullable', 'array'],
            'search_birth_district.*' => ['integer', 'min:1'],

            'search_birth_place' => ['nullable', 'array'],
            'search_birth_place.*' => ['integer', 'min:1'],

            'search_birth_region' => ['nullable', 'integer', 'min:1'],

            'search_corpus' => ['nullable', 'array'],
            'search_corpus.*' => ['integer', 'min:1'],

            'search_cycle' => ['nullable', 'array'],
            'search_cycle.*' => ['integer', 'min:1'],

            'search_dialect' => ['nullable', 'array'],
            'search_dialect.*' => ['integer', 'min:1'],

            'search_district' => ['nullable', 'array'],
            'search_district.*' => ['integer', 'min:1'],

            'search_event_district' => ['nullable', 'array'],
            'search_event_district.*' => ['integer', 'min:1'],

            'search_event_place' => ['nullable', 'array'],
            'search_event_place.*' => ['integer', 'min:1'],

            'search_event_region' => ['nullable', 'integer', 'min:1'],

            'search_genre' => ['nullable', 'array'],
            'search_genre.*' => ['integer', 'min:1'],

            'search_ieeh_archive_number1' => ['nullable', 'string', 'max:10'],
            'search_ieeh_archive_number2' => ['nullable', 'string', 'max:10'],

            'search_informant' => ['nullable', 'integer', 'min:1'],

            'search_lang' => ['nullable', 'array'],
            'search_lang.*' => ['integer', 'min:1'],

            'search_motive' => ['nullable', 'array'],
            'search_motive.*' => ['integer', 'min:1'],

            'search_place' => ['nullable', 'array'],
            'search_place.*' => ['integer', 'min:1'],

            'search_plot' => ['nullable', 'array'],
            'search_plot.*' => ['integer', 'min:1'],

            'search_recorder' => ['nullable', 'integer', 'min:1'],
            'search_region' => ['nullable', 'integer', 'min:1'],
            'search_source' => ['nullable', 'integer', 'min:1'],

            'search_title' => ['nullable', 'string', 'max:255'],

            'search_topic' => ['nullable', 'array'],
            'search_topic.*' => ['integer', 'min:1'],

            'search_text' => ['nullable', 'string', 'max:255'],
            'search_w' => ['nullable', 'string', 'max:255'],
            'search_word' => ['nullable', 'string', 'max:255'],

            'search_year_from' => ['nullable', 'integer', 'min:1', 'max:2100'],
            'search_year_to' => ['nullable', 'integer', 'min:1', 'max:2100'],

            'limit_num' => ['nullable', 'integer'],
            'page' => ['nullable', 'integer', 'min:1'],
            'with_audio' => ['nullable', 'in:0,1'],
            'with_transtext' => ['nullable', 'in:0,1'],
        ]);

        $params = [
            'limit_num' => (int)($validated['limit_num'] ?? 10),
            'page' => (int)($validated['page'] ?? 1),
            'with_audio' => (int)($validated['not_claster'] ?? 0),
            'with_transtext' => (int)($validated['outside_bounds'] ?? 0),
        ];

        foreach (['search_author', 'search_text', 'search_title', 'search_w', 'search_word'] as $k) {
            $params[$k] = trim((string)($validated[$k] ?? ''));
        }

        foreach (['search_birth_district', 'search_birth_region', 'search_event_region', 'search_ieeh_archive_number1', 'search_ieeh_archive_number2', 'search_informant', 'search_region', 'search_source', 'search_year_from', 'search_year_to'] as $k) {
            $params[$k] = $validated[$k] ?? null;
        }

        foreach (['search_birth_place', 'search_corpus', 'search_cycle', 'search_dialect', 'search_district', 'search_event_district', 'search_event_place', 'search_genre', 'search_lang', 'search_motive', 'search_place', 'search_plot', 'search_topic'] as $k) {
            $params[$k] = array_values(array_unique($validated[$k] ?? []));
        }

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

    public function index()
    {
        return view('texts.index');
    }

    public function show(int $id)
    {
        $text = $this->dictorpusClient->getText($id);
        return view('texts.show', compact('text'));
    }

    public function ethnography(Request $request)
    {
        $url_args = $this->searchArgs($request);
        //dd($url_args);
        $url_args_w = remove_empty($url_args);
        $args_by_get = search_values_by_URL($url_args_w);

        $result = $this->dictorpusClient->getEthnographicTexts($url_args);
        //dd($result);
        $texts = $result['data'] ?? [];
        $current_page = $result['current_page'] ?? 1;
        $last_page = $result['last_page'] ?? 1;
        $total = $result['total'] ?? 0;
        $per_page = $result['per_page'] ?? 10;

        $form_values = $this->dictorpusClient->getTextFormValues();

        return view('texts.ethnography', compact(
            'current_page',
            'form_values',
            'last_page',
            'per_page',
            'texts',
            'total',
            'args_by_get',
            'url_args',
        ));
    }

    public function folklore(Request $request) {}

    public function bible(Request $request) {}

    public function monuments(Request $request) {}

    public function genres(Request $request)
    {
        $params = $request->validate([
            'q' => ['nullable', 'string', 'max:255'],
        ]);

        $params['q'] = trim((string)($params['q'] ?? ''));

        return response()->json(
            $this->dictorpusClient->getGenres($params)
        );
    }
}
