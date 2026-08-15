<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\DictorpusClient;

use App\Library\Text;

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

            'search_birth_region' => ['nullable', 'array'],
            'search_birth_region.*' => ['integer', 'min:1'],

            'search_cycle' => ['nullable', 'array'],
            'search_cycle.*' => ['integer', 'min:1'],

            'search_dialect' => ['nullable', 'array'],
            'search_dialect.*' => ['integer', 'min:1'],

            'search_district' => ['nullable', 'array'],
            'search_district.*' => ['integer', 'min:1'],

            'search_event_region' => ['nullable', 'array'],
            'search_event_region.*' => ['integer', 'min:1'],

            'search_event_district' => ['nullable', 'array'],
            'search_event_district.*' => ['integer', 'min:1'],

            'search_event_place' => ['nullable', 'array'],
            'search_event_place.*' => ['integer', 'min:1'],

            'search_ieeh_archive_number1' => ['nullable', 'string', 'max:10'],
            'search_ieeh_archive_number2' => ['nullable', 'string', 'max:10'],

            'search_informant' => ['nullable', 'array'],
            'search_informant.*' => ['integer', 'min:1'],

            'search_lang' => ['nullable', 'array'],
            'search_lang.*' => ['integer', 'min:1'],

            'search_motive' => ['nullable', 'array'],
            'search_motive.*' => ['integer', 'min:1'],

            'search_place' => ['nullable', 'array'],
            'search_place.*' => ['integer', 'min:1'],

            'search_plot' => ['nullable', 'array'],
            'search_plot.*' => ['integer', 'min:1'],

            'search_recorder' => ['nullable', 'array'],
            'search_recorder.*' => ['integer', 'min:1'],

            'search_region' => ['nullable', 'array'],
            'search_region.*' => ['integer', 'min:1'],

            'search_topic' => ['nullable', 'array'],
            'search_topic.*' => ['integer', 'min:1'],

            'search_title' => ['nullable', 'string', 'max:255'],
            'search_source' => ['nullable', 'string', 'max:255'],
            'search_text' => ['nullable', 'string', 'max:255'],

            'search_corpus' => ['nullable', 'integer', 'min:1'],
            'search_genre' => ['nullable', 'integer', 'min:1'],
            'search_year_from' => ['nullable', 'integer', 'min:1', 'max:2100'],
            'search_year_to' => ['nullable', 'integer', 'min:1', 'max:2100'],

            'sort_by' => ['nullable', 'string'],
            'in_desc' => ['nullable', 'in:0,1'],
            'portion' => ['nullable', 'integer'],
            'page' => ['nullable', 'integer', 'min:1'],
            'with_audio' => ['nullable', 'in:0,1'],
            'with_photo' => ['nullable', 'in:0,1'],
            'with_transtext' => ['nullable', 'in:0,1'],
        ]);

        $params = [
            'sort_by' => $validated['sort_by'] ?? 'title',
            'in_desc' => (int)($validated['in_desc'] ?? 0),
            'portion' => (int)($validated['portion'] ?? 10),
            'page' => (int)($validated['page'] ?? 1),
            'with_audio' => (int)($validated['with_audio'] ?? 0),
            'with_photo' => (int)($validated['with_photo'] ?? 0),
            'with_transtext' => (int)($validated['with_transtext'] ?? 0),
        ];
        $params['limit_num'] = $params['portion'];

        foreach (['search_author', 'search_text', 'search_title', 'search_source'] as $k) {
            $params[$k] = trim((string)($validated[$k] ?? ''));
        }

        foreach (['search_corpus', 'search_genre', 'search_year_from', 'search_year_to'] as $k) {
            $params[$k] = $validated[$k] ?? null;
        }

        foreach (
            [
                'search_birth_district',
                'search_birth_region',
                'search_event_region',
                'search_birth_place',
                'search_informant',
                'search_region',
                'search_cycle',
                'search_dialect',
                'search_district',
                'search_event_district',
                'search_event_place',
                'search_lang',
                'search_motive',
                'search_place',
                'search_plot',
                'search_topic'
            ] as $k
        ) {
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

    private function searchArgsForMap(Request $request): array
    {
        $validated = $request->validate([
            'search_district' => ['nullable', 'array'],
            'search_district.*' => ['integer', 'min:1'],

            'search_region' => ['nullable', 'array'],
            'search_region.*' => ['integer', 'min:1'],

            'search_topic' => ['nullable', 'array'],
            'search_topic.*' => ['integer', 'min:1'],
        ]);

        $params = [];

        foreach (['search_district', 'search_region', 'search_topic'] as $k) {
            $params[$k] = array_values(array_unique($validated[$k] ?? []));
        }

        return array_filter($params, function ($value) {
            return $value !== null && $value !== '' && $value !== [];
        });
    }

    public function index()
    {
        return view('texts.index');
    }

    public function show(int $id, Request $request)
    {
        $text = $this->dictorpusClient->getText($id);
        //dd($text);
        if (isset($text['source']['number'])) {
            $text['source']['number'] = '<b>' . trans('text.archive_krc') . ':</b> ' . $text['source']['number'];
        }
        $url_args = $this->searchArgs($request);

        if (!isset($url_args['search_corpus']) && $text['corpus_id']) {
            $url_args['search_corpus'] = $text['corpus_id'];
        }

        $args_by_get = search_values_by_URL($url_args);

        $corpus_route = Text::routesByCorpusId($url_args['search_corpus']) ?? 'index';

        $h1 = isset($url_args['search_corpus']) && isset(__('text.corpuses')[$url_args['search_corpus']])
            ? __('text.corpuses')[$url_args['search_corpus']] .
            (isset($url_args['search_genre']) && isset(__('text.folklore_genres')[$url_args['search_genre']])
                ? '. ' . __('text.folklore_genres')[$url_args['search_genre']] : '')
            : __('navigation.texts');

        return view('texts.show', compact(
            'corpus_route',
            'h1',
            'text',
            'args_by_get',
            'url_args'
        ));
    }

    private function texts(string $corpus, array $url_args)
    {
        $result = $this->dictorpusClient->getTexts($corpus, $url_args);
        //dd($result);
        $texts = $result['data'] ?? [];
        $current_page = $result['current_page'] ?? 1;
        $last_page = $result['last_page'] ?? 1;
        $total = $result['total'] ?? 0;
        $per_page = $result['per_page'] ?? 10;
        $url_args = $result['url_args'] ?? $url_args;

        $args_by_get = search_values_by_URL($url_args);

        $form_values = $this->dictorpusClient->getTextFormValues(
            [
                'corpus_id' => $url_args['search_corpus'] ?? null,
                'genre_id' => $url_args['search_genre'] ?? null
            ]
        );
        //dd($form_values);
        return view('texts.' . $corpus, compact(
            'current_page',
            'form_values',
            'last_page',
            'per_page',
            'texts',
            'total',
            'args_by_get',
            'url_args',
            'corpus'
        ));
    }

    public function ethnographic(Request $request)
    {
        $url_args = $this->searchArgs($request);

        return $this->texts('ethnographic', $url_args);
    }

    public function folklore(Request $request)
    {
        $url_args = $this->searchArgs($request);

        if (!isset($url_args['search_genre'])) {
            $genres = $this->dictorpusClient->getFolkloreGenres();
            return view('texts.folklore_genres', compact('genres'));
        }

        return $this->texts('folklore', $url_args);
    }

    public function bible(Request $request) {}

    public function monuments(Request $request) {}

    public function genres(Request $request)
    {
        $params = $request->validate([
            'q' => ['nullable', 'string', 'max:255'],
        ]);

        $params['q'] = trim((string)($params['q'] ?? ''));

        return response()->json(
            $this->dictorpusClient->getTextFormValues($params, 'genres')
        );
    }

    public function dialects(Request $request)
    {
        $params = $request->validate([
            'q' => ['nullable', 'string', 'max:255'],
            'lang_id' => ['nullable', 'array'],
            'lang_id.*' => ['integer', 'min:1'],
        ]);

        $params['q'] = trim((string)($params['q'] ?? ''));

        return response()->json(
            $this->dictorpusClient->getTextFormValues($params, 'dialects')
        );
    }

    public function districts(Request $request)
    {
        $params = $request->validate([
            'q' => ['nullable', 'string', 'max:255'],
            'region_id' => ['nullable', 'array'],
            'region_id.*' => ['integer', 'min:1'],
        ]);

        $params['q'] = trim((string)($params['q'] ?? ''));

        return response()->json(
            $this->dictorpusClient->getTextFormValues($params, 'districts')
        );
    }

    public function places(Request $request)
    {
        $params = $request->validate([
            'q' => ['nullable', 'string', 'max:255'],
            'region_id' => ['nullable', 'array'],
            'region_id.*' => ['integer', 'min:1'],
            'district_id' => ['nullable', 'array'],
            'district_id.*' => ['integer', 'min:1'],
        ]);

        $params['q'] = trim((string)($params['q'] ?? ''));

        return response()->json(
            $this->dictorpusClient->getTextFormValues($params, 'places')
        );
    }

    public function topics(Request $request)
    {
        $params = $request->validate([
            'q' => ['nullable', 'string', 'max:255'],
            'corpus_id' => ['nullable', 'integer', 'min:1'],
            'genre_id' => ['nullable', 'integer', 'min:1'],
            'plot_id' => ['nullable', 'array'],
            'plot_id.*' => ['integer', 'min:1'],
        ]);

        $params['q'] = trim((string)($params['q'] ?? ''));

        return response()->json(
            $this->dictorpusClient->getTextFormValues($params, 'topics')
        );
    }

    public function plots(Request $request)
    {
        $params = $request->validate([
            'q' => ['nullable', 'string', 'max:255'],
            'corpus_id' => ['nullable', 'integer', 'min:1'],
            'genre_id' => ['nullable', 'integer', 'min:1'],
        ]);

        $params['q'] = trim((string)($params['q'] ?? ''));

        return response()->json(
            $this->dictorpusClient->getTextFormValues($params, 'plots')
        );
    }

    public function map(Request $request)
    {
        $url_args = $this->searchArgsForMap($request);
        $url_args['genre_id'] = Text::ETHNO_GENRE;
        $places = $this->dictorpusClient->getObjsForMap($url_args);
        $bounds = Text::getBounds($places);

        $objs = [];
        foreach (array_values($places) as $obj) {
            $popup = '<b>' . $obj['place'] . '</b><ul>';
            foreach ($obj['texts'] as $text_id => $text_title) {
                $popup .= '<li><a href="' . route('texts.show', $text_id) . '">' . $text_title . '</a></li>';
            }
            $popup .= '</ul>';

            $objs[] = [
                'lat' => $obj['lat'],
                'lon' => $obj['lon'],
                'color' => 'blue',
                'popup' => $popup
            ];
        }
        //dd($objs);
        $form_values = $this->dictorpusClient->getTextFormValues($url_args);
//dd($form_values);
        return view('texts.map', compact('bounds', 'form_values', 'objs', 'url_args'));
    }
}
