@extends('layouts.base')

@section('title', trans('navigation.oikonyms'))
@section('h1', trans('navigation.oikonyms_full'))

@section('headExtra')
        {!! css('select2.min') !!}
        {!! css('table') !!}
@endsection

@section('search_form')
    @include('oikonyms._search_form', ['route'=>'oikonyms.index'])
    <div class="row" style='line-height: 26px;'>
         <div class="col-sm-4 total-rec">
            @include('includes.found_records', ['n_records'=>$total])
         </div>
         <div class="col-sm-8 output_in">
            @if ($total)
            <a href="{{ route('oikonyms.on_map').search_values_by_URL($url_args) }}">{!! __('oikonym.output_on_map') !!}</a>
            @endif 
         </div>
    </div>
@endsection

@section('main')
    @if ($total)
        <table class="table table-striped table-hover wide-md">
            <thead>
                <tr>
                    <th>&numero;</th>
                    <th>{{ __('oikonym.oikonym') }}</th>
                    <th>{{ __('oikonym.lang') }}</th>
                    <th>
                        {{ __('oikonym.location') }} /
                        <br>
                        <i>{{ __('oikonym.location_1926') }}</i>
                    </th>
                </tr>
            </thead>

            <tbody>
                @foreach ($toponyms as $r)
                    @php
                        $id = data_get($r, 'id');
                        $topnames = data_get($r, 'topname');
                    @endphp

                    <tr>
                        <td>
                            {{ ($current_page - 1) * $per_page + $loop->iteration }}
                        </td>

                        <td style="font-weight: bold">
                            @if ($id)
                                <a href="{{ route('oikonyms.show', ['id' => $id]) }}">
                                    {{ data_get($r, 'name') }}</a>
                            @else
                                {{ data_get($r, 'name') }}
                            @endif

                            @if ($topnames)
                                ({{ $topnames }})
                            @endif
                        </td>

                        <td>
                            {{ data_get($r, 'lang') }}
                        </td>

                        <td>
                            {{ data_get($r, 'location') }}
                            /
                            <br>
                            <i>{{ data_get($r, 'location1926') }}</i>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @include('includes.pagination', ['route' => 'oikonyms.index'])
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
        selectSource(@json(app()->getLocale()), '{{ trans('oikonym.sources') }}');
        $('.select-district').select2({
            allowClear: true,
            placeholder: '{{ trans('oikonym.district') }}',
            width: '100%'
        });
        selectSettlement('search_districts', @json(app()->getLocale()), '{{ trans('oikonym.settlement') }}', false);
        selectSelsovet1926('search_districts1926', @json(app()->getLocale()), '{{ trans('oikonym.selsovet_volost') }}', false);
        selectSettlement1926('search_districts1926', 'search_selsovets1926', @json(app()->getLocale()), '{{trans('oikonym.settlement')}}', false);
        $('.select-district1926').select2({
            allowClear: true,
            placeholder: '{{ trans('oikonym.district') }}',
            width: '100%'
        });
@stop
