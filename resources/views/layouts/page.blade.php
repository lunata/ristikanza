@extends('layouts.base')

@section('head_base')
    {!! css('page') !!}
@stop

@section('main')
    <div class="blank">
        <div class="page-top-links">
            <div class="page-top">
                @yield('page_top')
            </div>
            <div class="top-links">
                @yield('top_links')
            </div>
        </div>

        @yield('content')
    </div>
@endsection
