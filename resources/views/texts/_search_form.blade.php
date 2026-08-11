{{ html()->form('GET', route($route))->open(); }}
<input id='search_corpus' type="hidden" name='search_corpus' value='{{ $url_args['search_corpus'] }}'>
@if (isset($url_args['search_genre']))
<input id='search_genre' type="hidden" name='search_genre' value='{{ $url_args['search_genre'] }}'>
@endif

<div class="row">
    <div class="col-md-4">
        <!-- Language -->
        @include('includes.formitem._SELECT2',
                ['name' => 'search_lang',
                 'values' => $form_values['lang_values'],
                 'value' => $url_args['search_lang'] ?? [],
                 'title' => trans('general.lang'),
                 'class'=>'select-lang form-control',
        ])
    </div>
    <div class="col-md-4">
        @include('includes.formitem._SELECT2',
                ['name' => 'search_dialect',
                 'values' =>$form_values['dialect_values'],
                 'value' => $url_args['search_dialect'] ?? [],
                 'title' => trans('text.dialect'),
                 'class'=>'select-dialect form-control'
            ])
    </div>
    <div class="col-md-4">
        @include('includes.formitem._TEXT',
                ['name' => 'search_title',
                 'special_symbol' => true,
                 'title' => trans('text.title'),
                 'value' => $url_args['search_title'] ?? '',
                ])
    </div>
    <div class="col-md-4">
        @include('includes.formitem._SELECT2',
                ['name' => 'search_author',
                 'values' => $form_values['author_values'],
                 'value' => $url_args['search_author'] ?? [],
                 'title' => trans('text.author_or_trans'),
                 'class'=>'select-author form-control'
        ])
    </div>
    <div class="col-md-4">
        @include('includes.formitem._SELECT2',
                ['name' => 'search_informant',
                 'values' => $form_values['informant_values'],
                 'value' => $url_args['search_informant'] ?? [],
                 'title' => trans('text.informant'),
                 'class'=>'select-informant form-control'
        ])
    </div>
    <div class="col-md-4">
        @include('includes.formitem._SELECT2',
                ['name' => 'search_recorder',
                 'values' => $form_values['recorder_values'],
                 'value' => $url_args['search_recorder'] ?? [],
                 'title' => trans('text.recorder'),
                 'class'=>'select-recorder form-control'
        ])
    </div>
</div>
<p class="row-title">{{ trans('text.place_of_recording') }}</p>
<div class="row">
    <div class="col-md-4">
        <!-- Region of recording -->
        @include('includes.formitem._SELECT2',
                ['name' => 'search_event_region',
                 'values' => $form_values['region_values'],
                 'value' => $url_args['search_event_region'] ?? [],
                 'class'=>'select-event-region form-control'
        ])
    </div>
    <div class="col-md-4">
        @include('includes.formitem._SELECT2',
                ['name' => 'search_event_district',
                 'values' => $form_values['district_values'],
                 'value' => $url_args['search_event_district'] ?? [],
                 'class'=>'select-event-district form-control'
        ])
    </div>
    <div class="col-md-4">
        @include('includes.formitem._SELECT2',
                ['name' => 'search_event_place',
                 'values' => $form_values['place_values'],
                 'value' => $url_args['search_event_place'] ?? [],
                 'class'=>'select-event-place form-control'
        ])
    </div>
</div>

<p class="row-title">{{ trans('text.place_of_informant_birth') }}</p>
<div class="row">
    <div class="col-md-4">
        @include('includes.formitem._SELECT2',
                ['name' => 'search_birth_region',
                 'values' => $form_values['region_values'],
                 'value' => $url_args['search_birth_region'] ?? [],
                 'class'=>'select-birth-region form-control'
        ])
    </div>
    <div class="col-md-4">
        @include('includes.formitem._SELECT2',
                ['name' => 'search_birth_district',
                 'values' => $form_values['district_values'],
                 'value' => $url_args['search_birth_district'] ?? [],
                 'class'=>'select-birth-district form-control'
        ])
    </div>
    <div class="col-md-4">
        @include('includes.formitem._SELECT2',
                ['name' => 'search_birth_place',
                 'values' => $form_values['place_values'],
                 'value' => $url_args['search_birth_place'] ?? [],
                 'class'=>'select-birth-place form-control'
        ])
    </div>
</div>

<p class="row-title">{{ trans('text.mentioned_place') }}</p>
<div class="row text-search-row">
    <div class="col-md-4">
        @include('includes.formitem._SELECT2',
                ['name' => 'search_region',
                 'values' => $form_values['region_values'],
                 'value' => $url_args['search_region'] ?? [],
                 'class'=>'select-region form-control'
        ])
    </div>
    <div class="col-md-4">
        @include('includes.formitem._SELECT2',
                ['name' => 'search_district',
                 'values' => $form_values['district_values'],
                 'value' => $url_args['search_district'] ?? [],
                 'class'=>'select-district form-control'
        ])
    </div>
    <div class="col-md-4">
        @include('includes.formitem._SELECT2',
                ['name' => 'search_place',
                 'values' => $form_values['place_values'],
                 'value' => $url_args['search_place'] ?? [],
                 'class'=>'select-place form-control'
        ])
    </div>
@php /*
    <div class="col-md-4">
        @include('includes.formitem._SELECT2',
                ['name' => 'search_plot',
                 'values' => $form_values['plot_values'],
                 'value' => $url_args['search_plot'] ?? [],
                 'title' => trans('text.plot'),
                 'class'=>'select-plot form-control'
        ])
    </div> */
@endphp
@if ($corpus == 'ethnographic')
    <div class="col-md-4">
        @include('includes.formitem._SELECT2',
                ['name' => 'search_topic',
                 'values' => $form_values['topic_values'],
                 'value' => $url_args['search_topic'] ?? [],
                 'title' => trans('text.topic'),
                 'class'=>'select-topic form-control'
        ])
    </div>
@endif
    <div class="col-md-8">
        <p class="row-title">{{ __('text.publication') }}</p>
        <div class="row">
            <div class="col-md-3">
                <!-- Sourse year from -->
                @include('includes.formitem._NUMBER',
                        ['name' => 'search_year_from',
                         'value' => !empty($url_args['search_year_from']) ? $url_args['search_year_from'] : '',
                         'attributes' => ['placeholder' => trans('oikonym.year_from')],
                         'min' => 1,
                         'max' => 2100
                        ])
            </div>
            <div class="col-md-3">
                <!-- Sourse year to -->
                @include('includes.formitem._NUMBER',
                        ['name' => 'search_year_to',
                         'value' => !empty($url_args['search_year_to']) ? $url_args['search_year_to'] : '',
                         'attributes' => ['placeholder' => trans('oikonym.year_to')],
                         'min' => 1,
                         'max' => 2100
                        ])
            </div>
            <div class="col-md-6">
                <!-- Source -->
                @include('includes.formitem._TEXT',
                        ['name' => 'search_source',
                        'special_symbol' => true,
                        'value' => $url_args['search_source'] ?? '',
                         'attributes' => ['placeholder' => trans('text.source')],
                        ])
            </div>
        </div>
    </div>

    <div class="col-md-4">
        @include('includes.formitem._TEXT',
                ['name' => 'search_text',
                 'special_symbol' => true,
                 'value' => $url_args['search_text'] ?? '',
                 'title' => trans('text.text_fragment')
                ])

    </div>
    <div class="col-md-{{ $corpus == 'ethnographic' ? 3 : 4 }} col-for-checkbox">
        @include('includes.formitem._CHECKBOX_styled',
                ['name' => 'with_audio',
                'value' => 1,
                'checked' => !empty($url_args['with_audio']) && (int)$url_args['with_audio'] === 1,
                'tail'=>trans('text.with_audio')])
    </div>
    <div class="col-md-{{ $corpus == 'ethnographic' ? 2 : 4 }} col-for-checkbox">
        @include('includes.formitem._CHECKBOX_styled',
                ['name' => 'with_photo',
                'value' => 1,
                'checked' => !empty($url_args['with_photo']) && (int)$url_args['with_photo'] === 1,
                'tail'=>trans('text.with_photo')])
    </div>
    <div class="col-md-{{ $corpus == 'ethnographic' ? 3 : 4 }} col-for-checkbox">
        @include('includes.formitem._CHECKBOX_styled',
                ['name' => 'with_transtext',
                'value' => 1,
                'checked' => !empty($url_args['with_transtext']) && (int)$url_args['with_transtext'] === 1,
                'tail'=>trans('text.with_transtext')])
    </div>
</div>

@include('includes.form._output_fields')
{{ html()->form()->close() }}
