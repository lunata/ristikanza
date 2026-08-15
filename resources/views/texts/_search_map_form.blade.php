{{ html()->form('GET', route($route))->open(); }}

<div class="row">
    <div class="col-md-3">
        @include('includes.formitem._SELECT2',
                ['name' => 'search_region',
                 'values' => $form_values['region_values'],
                 'value' => $url_args['search_region'] ?? [],
                 'title' => trans('text.region'),
                 'class'=>'select-region form-control'
        ])
    </div>
    <div class="col-md-3">
        @include('includes.formitem._SELECT2',
                ['name' => 'search_district',
                 'values' => $form_values['district_values'],
                 'value' => $url_args['search_district'] ?? [],
                 'title' => trans('text.district'),
                 'class'=>'select-district form-control'
        ])
    </div>
    <div class="col-md-3">
        @include('includes.formitem._SELECT2',
                ['name' => 'search_topic',
                 'values' => $form_values['topic_values'],
                 'value' => $url_args['search_topic'] ?? [],
                 'title' => trans('text.topic'),
                 'class'=>'select-topic form-control'
        ])
    </div>
    <div class='col-sm-3 output-fields-b' style="align-items: flex-start; padding-top: 30px">
        <div class='output-fields-e'>
            <a href="{{ route(request()->route()->getName()) }}"
                class="btn btn-grey btn-default btn-clear" style="padding-top: 5px; margin-right: 5px;">
                 {{ __('messages.clear') }}
             </a>
            <input type="submit" class="btn btn-primary btn-default" value="{{ __('messages.view') }}">
        </div>
    </div>
{{ html()->form()->close() }}
