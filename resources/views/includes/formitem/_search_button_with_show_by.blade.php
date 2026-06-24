        <span>
        {{trans('search.show_by')}}
        </span>
        @include('includes.formitem._TEXT', 
                ['name' => 'portion', 
                'value' => $url_args['portion'], 
                'attributes'=>['size' => 5,
                               'placeholder' => trans('messages.portion') ]]) 
        <span>
                {{ trans('messages.records') }}
        </span>
        @include('includes.formitem._SUBMIT', ['title' => trans('messages.view')])
