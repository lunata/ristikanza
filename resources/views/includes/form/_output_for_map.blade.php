<div class="output-fields">    
    <div class='row'>
        <div class="col-md-5">
            <div style='padding-bottom:10px'>{{ __('oikonym.coords_min') }} (<a href="#" id="select-min-coords">{{ __('oikonym.point') }}</a>)</div>
            <div class="row">
                <div class="col-md-6">        
                    @include('includes.formitem._TEXT', 
                            ['name' => 'min_lat',                  
                             'value' => $url_args['min_lat'],
                             'attributes' => ['placeholder' => trans('oikonym.latitude')],
                            ])     
                </div>
                <div class="col-md-6">        
                    @include('includes.formitem._TEXT', 
                            ['name' => 'min_lon',                  
                             'value' => $url_args['min_lon'],
                             'attributes' => ['placeholder' => trans('oikonym.longitude')],
                            ])     
                </div>
            </div>
        </div>        
        <div class="col-md-5">
            <div style='padding-bottom:10px'>{{ __('oikonym.coords_max') }} (<a href="#" id="select-max-coords">{{ __('oikonym.point') }}</a>)</div>
            <div class="row">
                <div class="col-md-6">        
                    @include('includes.formitem._TEXT', 
                            ['name' => 'max_lat',                  
                             'value' => $url_args['max_lat'],
                             'attributes' => ['placeholder' => trans('oikonym.latitude')],
                            ])     
                </div>
                <div class="col-md-6">        
                    @include('includes.formitem._TEXT', 
                            ['name' => 'max_lon',                  
                             'value' => $url_args['max_lon'],
                             'attributes' => ['placeholder' => trans('oikonym.longitude')],
                            ])     
                </div>
            </div>
        </div>        
        <div class="col-md-2">
            <div style='padding-bottom:10px'>{{ __('oikonym.map_height') }}</div>
                @include('includes.formitem._TEXT', 
                    ['name' => 'map_height',                  
                     'value' => $url_args['map_height']
                    ])     
        </div>    
        <div class='col-sm-12 output-fields-b'>
            <div class='output-fields-e'>
                <label><input name="not_claster" type="checkbox" hidden value="1"{{ $url_args['not_claster']==1 ? ' checked' : '' }}><span></span></label>
                <span>{!! __('oikonym.not_claster') !!}</span>
            </div>
            <div class='output-fields-e'>
                <label><input name="outside_bounds" type="checkbox" hidden value="1"{{ $url_args['outside_bounds']==1 ? ' checked' : '' }}><span></span></label>
                <span>{{ __('oikonym.outside_bounds') }}</span>
            </div>
            <div class='output-fields-e'>
                <label><input name="only_exact_coords" type="checkbox" hidden value="1"{{ $url_args['only_exact_coords']==1 ? ' checked' : '' }}><span></span></label>
                <span id='for-portion'>{{ __('oikonym.only_exact_coords') }}</span>
            </div>
            <input type="reset" class="btn btn-grey btn-default" value="{{ __('messages.clear') }}">
            <input type="submit" class="btn btn-primary btn-default" value="{{ __('messages.view') }}">
        </div>
    </div>
</div>    
