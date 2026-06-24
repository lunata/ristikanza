<?php
    $locale = App::getLocale();
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<html lang="ru-RU">
<head>
@include('header._head')
</head>
    <!--[if lt IE 7]>
    <p class="browsehappy">Вы используете  <strong>слишком старый</strong> браузер. Пожалуйста <a href="http://browsehappy.com/">обновите ваш браузер</a> для нормального серфинга по современным сайтам.</p>
    <![endif]-->
    <div class="container">
@include('header._header')
@include('header._menu')
@include('errors._errmsg')

        @hasSection('h1')
        <h1>@yield('h1')</h1>
        @endif

        @hasSection('search_form')
        <section class="search-form">
            @yield('search_form')
        </section>
        @endif

        @hasSection('card_block')
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">@yield('card_header')</div>

                    <div class="card-body">
                    @yield('card_block')
                    </div>
                </div>
            </div>
        </div>
        @endif

        <section class='main'>
@yield('main')
        </section>
    </div>
@include('footer._footer')
@include('footer._foot_script')
</body>
</html>
