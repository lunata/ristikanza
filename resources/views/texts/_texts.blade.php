@section('title', trans('navigation.texts'))

@section('headExtra')
        {!! css('select2.min') !!}
        {!! css('table') !!}
        {!! css('texts') !!}
@endsection

@section('search_form')
    @include('texts._search_form', ['route'=>'texts.'. $corpus])
    @include('includes.found_records', ['n_records'=>$total])
@endsection

@section('main')
    @if ($total)
    <table class="table table-striped table-hover wide-md">
        <thead>
            <tr>
                <th>&numero;</th>
        @if (empty($url_args['search_lang']) || sizeof($url_args['search_lang'])>1)
                <th>{{ trans('general.lang') }}</th>
        @endif
        @if (empty($url_args['search_dialect']) || sizeof($url_args['search_dialect'])>1)
                <th>{{ trans('text.dialect') }}</th>
        @endif
                <th>{{ trans('text.title') }}</th>
                <th>{{ trans('text.translation') }}</th>
            </tr>
        </thead>

        <tbody>
        @foreach ($texts as $text)
            @php
                $id = data_get($text, 'id');
                $author = data_get($text, 'author');
            @endphp

            <tr>
                <td>
                    {{ ($current_page - 1) * $per_page + $loop->iteration }}
                </td>
            @if (empty($url_args['search_lang']) || sizeof($url_args['search_lang'])>1)
                <td data-th="{{ trans('text.lang') }}">{{ $text['lang'] }}</td>
            @endif
            @if (empty($url_args['search_dialect']) || sizeof($url_args['search_dialect'])>1)
                <td data-th="{{ trans('text.dialect') }}">
                    {!! join('<br>', $text['dialect']) !!}<br>
                </td>
            @endif
                <td data-th="{{ trans('text.title') }}">
                    {{ $text['author'] ? $text['author'].'.' : '' }}
                    <a href="{{ route('texts.show',['id'=>$id]) }}{{$args_by_get}}">{{ $text['title'] }}</a>
                </td>
                <td data-th="{{ trans('text.translation') }}">
                    @if ($text['trans_title'])
                    {{ $text['trans_author'] ? $text['trans_author'].'.' : '' }}
                    {{ $text['trans_title'] }}
                    @endif
                </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @include('includes.pagination', ['route' => 'texts.'. $corpus])
    @else
        <p>{{ __('messages.records_not_found') }}</p>
    @endif
@endsection

@section('footScriptExtra')
    {!! js('select2.min') !!}
    {!! js('lists') !!}
    {!! js('special_symbols') !!}
@endsection

@section('jqueryFunc')
    $('.select-lang').select2();
    selectDialect('search_lang');
    $('.select-author').select2();
    $('.select-informant').select2();
    $('.select-recorder').select2();
    $('.select-event-region').select2({
            allowClear: true,
            placeholder: '{{ trans('text.region') }}',
            width: '100%'
        });
    selectDistrict('search_event_region', '{{ __('text.district') }}', '.select-event-district');
    selectPlace('search_event_region', 'search_event_district', '{{ __('text.place') }}', '.select-event-place');
    $('.select-birth-region').select2({
            allowClear: true,
            placeholder: '{{ trans('text.region') }}',
            width: '100%'
        });
    selectDistrict('search_birth_region', '{{ __('text.district') }}', '.select-birth-district');
    selectPlace('search_birth_region', 'search_birth_district', '{{ __('text.place') }}', '.select-birth-place');
    $('.select-region').select2({
            allowClear: true,
            placeholder: '{{ trans('text.region') }}',
            width: '100%'
        });
    selectDistrict('search_region', '{{ __('text.district') }}');
    selectPlace('search_region', 'search_district', '{{ __('text.place') }}');
    selectTopic();
@stop
