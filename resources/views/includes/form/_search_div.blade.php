<?php 
if (!isset($submit_value) || !$submit_value) {
    $submit_value = 'view';
}

?>
    <div class="col-sm-4 search-button-b">       
        <span>
        {{trans('search.show_by')}}
        </span>
        @include('includes.formitem._TEXT', 
                ['name' => 'portion', 
                'value' => $url_args['portion'], 
                'placeholder' => trans('messages.portion') ]) 
        <span>
                {{ trans('messages.records') }}
        </span>
        @include('includes.formitem._SUBMIT', ['title' => trans('messages.'.$submit_value)])
    </div>
