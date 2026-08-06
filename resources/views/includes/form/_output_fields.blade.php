<div class="output-fields">    
    <div class='row'>
        <div class='col-sm-4' style='padding-top: 12px;'>
            @include('includes.formitem._SELECT', 
                    ['name' => 'sort_by', 
                     'values' => $form_values['sort_values'] ?? [],
                     'value' => $url_args['sort_by'] ?? '',
                     ]) 
        </div>
        <div class='col-sm-8 output-fields-b'>
            <div class='output-fields-e'>
                <input type="hidden" name="in_desc" value="0">

                <label>
                    <input name="in_desc"
                           type="checkbox"
                           value="1"
                           hidden
                           {{ !empty($url_args['in_desc']) && (int)$url_args['in_desc'] === 1 ? ' checked' : '' }}>
                    <span></span>
                </label>

                <span>{!! __('search.in_desc') !!}</span>
            </div>
            <div class='output-fields-e'>
                <input class='form-control'
                       id="portion"
                       name="portion"
                       type="number"
                       min="1"
                       step="1"
                       value="{{ $url_args['portion'] ?? 10 }}">
                <span id='for-portion'>{!! __('search.entries_per_page') !!}</span>
            </div>
            <a href="{{ route(request()->route()->getName()) }}"
                class="btn btn-grey btn-default btn-clear">
                 {{ __('messages.clear') }}
             </a>
            <input type="submit" class="btn btn-primary btn-default" value="{{ __('messages.view') }}">
        </div>
    </div>
</div>    
