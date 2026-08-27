@extends('layouts.base')

@section('title', trans('navigation.texts'))
@section('h1', trans('navigation.monuments'))

@section('headExtra')
        {!! css('texts') !!}
@endsection

@section('main')
    <div class="row">
    @foreach ($books as $book_id => $book_info)
        <div class="col-sm-3">
        @if ($book_info['photo'])
            <img class='photo' src="{{ config('services.dictorpus.url').$book_info['photo'] }}"><br>
        @endif
            <p>{{ $book_info['title'] }}</p>
        </div>
    @endforeach
    </div>
@endsection
