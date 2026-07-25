{{ html()->form('GET', route($route))->open(); }}

<div class="row">
    <div class="col-md-4">
        <p class="row-title">{{ trans('oikonym.oikonym') }}</p>
        @include('includes.formitem._TEXT',
                ['name' => 'search_toponym',
                 'special_symbol' => true,
                 'full_special_list' => true,
                 'value' => $url_args['search_toponym'] ?? '',
                ])
    </div>
    <div class="col-md-8">
        <p class="row-title">{{ trans('oikonym.mentions_in_sources') }}</p>
        <div class="row">
            <div class="col-md-3">
                <!-- Sourse year from -->
                @include('includes.formitem._NUMBER',
                        ['name' => 'search_year_from',
                         'value' => $url_args['search_year_from'] ?? '',
                         'attributes' => ['placeholder' => trans('oikonym.year_from')],
                         'min' => 1,
                         'max' => 2100
                        ])
            </div>
            <div class="col-md-3">
                <!-- Sourse year to -->
                @include('includes.formitem._NUMBER',
                        ['name' => 'search_year_to',
                         'value' => $url_args['search_year_to'] ?? '',
                         'attributes' => ['placeholder' => trans('oikonym.year_to')],
                         'min' => 1,
                         'max' => 2100
                        ])
            </div>
            <div class="col-md-6">
                <!-- Settlement1926 -->
                @include('includes.formitem._SELECT2',
                        ['name' => 'search_sources',
                         'values' => $form_values['source_values'] ?? [],
                         'value' => $url_args['search_sources'] ?? [],
                         'class'=>'select-source form-control'
                ])
            </div>
        </div>
    </div>
</div>
<div class="row-title">{{ trans('oikonym.cur_adm_div') }}</div>
<div class="row">
    <div class="col-md-6">
        <!-- District -->
        @include('includes.formitem._SELECT2',
                ['name' => 'search_districts',
                 'values' => $form_values['district_values'] ?? [],
                 'value' => $url_args['search_districts'] ?? [],
                 'class' => 'select-district form-control'
        ])
    </div>
    <div class="col-md-6">
        <!-- Settlement -->
        @include('includes.formitem._SELECT2',
                ['name' => 'search_settlements',
                 'values' => $form_values['settlement_values'] ?? [],
                 'value' => $url_args['search_settlements'] ?? [],
                 'class'=>'select-settlement form-control'
        ])
    </div>
</div>
<div class="row-title">{{ trans('oikonym.early_adm_div') }}</div>
<div class="row">
    <div class="col-md-4">
        <!-- District1926 -->
        @include('includes.formitem._SELECT2',
                ['name' => 'search_districts1926',
                 'values' => $form_values['district1926_values'] ?? [],
                 'value' => $url_args['search_districts1926'] ?? [],
                 'class' => 'select-district1926 form-control'
        ])
    </div>
    <div class="col-md-4">
        <!-- Selsovet1926 -->
        @include('includes.formitem._SELECT2',
                ['name' => 'search_selsovets1926',
                 'values' => $form_values['selsovet1926_values'] ?? [],
                 'value' => $url_args['search_selsovets1926'] ?? [],
                 'class'=>'select-selsovet1926 form-control'
        ])
    </div>
    <div class="col-md-4">
        <!-- Settlement1926 -->
        @include('includes.formitem._SELECT2',
                ['name' => 'search_settlements1926',
                 'values' => $form_values['settlement1926_values'] ?? [],
                 'value' => $url_args['search_settlements1926'] ?? [],
                 'class'=>'select-settlement1926 form-control'
        ])
    </div>
</div>
@if (!empty($for_map))
    @include("includes.form._output_for_map")
@else    
    @include('includes.form._output_fields')
@endif    
{{ html()->form()->close() }}
