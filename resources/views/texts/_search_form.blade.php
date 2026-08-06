{{ html()->form('GET', route($route))->open(); }}
<input type="hidden" name='search_corpus' value='{{ $url_args['search_corpus'] ?? '' }}'>
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
<div class="row">
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

</div>

@include('includes.form._output_fields')
{{ html()->form()->close() }}
