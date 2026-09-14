@php
    $isWide = !empty($is_wide);
@endphp

{{ html()->form('GET', route('texts.bible_texts'))
    ->class($isWide ? 'bible-search bible-search--wide' : 'bible-search')
    ->open(); }}

<div class="bible-search-fields">

    <div class="bible-search-field">
        <!-- Language -->
        @include('includes.formitem._SELECT2',
            ['name' => 'search_lang',
                'values' => $form_values['lang_values'],
                'value' => $url_args['search_lang'] ?? [],
                'title' => trans('general.lang'),
                'class' => 'select-lang form-control',
            ])
    </div>

    <div class="bible-search-field">
        <!-- Bible -->
        @include('includes.formitem._SELECT2',
            ['name' => 'search_bible',
                'values' => $form_values['bible_values'],
                'value' => $url_args['search_bible'] ?? [],
                'title' => trans('text.book'),
                'class' => 'select-bible form-control',
            ])
    </div>

    <div class="bible-search-field bible-search-range">
        <!-- Chapter -->
        <p class="row-title">{{ __('text.chapters') }}</p>

        <div class="row">
            <div class="col-md-6">
                @include('includes.formitem._NUMBER',
                    ['name' => 'search_chapter_from',
                        'value' => $url_args['search_chapter_from'] ?? '',
                        'attributes' => [
                            'placeholder' => trans('general.from')
                        ],
                        'min' => 1,
                    ])
            </div>

            <div class="col-md-6">
                @include('includes.formitem._NUMBER',
                    ['name' => 'search_chapter_to',
                        'value' => $url_args['search_chapter_to'] ?? '',
                        'attributes' => [
                            'placeholder' => trans('general.to')
                        ],
                        'min' => 1,
                    ])
            </div>
        </div>
    </div>

    <div class="bible-search-field bible-search-range">
        <!-- Verses -->
        <p class="row-title">{{ __('text.verses') }}</p>

        <div class="row">
            <div class="col-md-6">
                @include('includes.formitem._NUMBER',
                    ['name' => 'search_verse_from',
                        'value' => $url_args['search_verse_from'] ?? '',
                        'attributes' => [
                            'placeholder' => trans('general.from')
                        ],
                        'min' => 1,
                    ])
            </div>

            <div class="col-md-6">
                @include('includes.formitem._NUMBER',
                    ['name' => 'search_verse_to',
                        'value' => $url_args['search_verse_to'] ?? '',
                        'attributes' => [
                            'placeholder' => trans('general.to')
                        ],
                        'min' => 1,
                    ])
            </div>
        </div>
    </div>

</div>

<div class="output-fields">
    <div class="output-fields-e">
        <div class="bible-search-parallel">
            @include('includes.formitem._CHECKBOX_styled',
                ['name' => 'with_parallel',
                    'value' => 1,
                    'checked' => !empty($url_args['with_parallel'])
                        && (int) $url_args['with_parallel'] === 1,
                    'tail' => trans('search.with_parallel'),
                ])
        </div>

        <div class="bible-search-portion">
            <input id="portion"
                name="portion"
                class="form-control"
                type="number"
                min="1"
                step="1"
                value="{{ $url_args['portion'] ?? 10 }}">

            <span id="for-portion">
                {!! __('search.entries_per_page') !!}
            </span>
        </div>
    </div>

    <a href="{{ route(request()->route()->getName()) }}"
        class="btn btn-grey btn-default btn-clear">
        {{ __('messages.clear') }}
    </a>

    <input type="submit"
        class="btn btn-primary btn-default"
        value="{{ __('messages.view') }}">
</div>

{{ html()->form()->close() }}