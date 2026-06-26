<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>@yield('title') :: {!!__('main.abbr')!!}</title>

<!-- Fonts -->
<link href="/fontawesome/css/fontawesome.min.css" rel="stylesheet">
<link href="/fontawesome/css/regular.min.css" rel="stylesheet">
<link href="/fontawesome/css/solid.min.css" rel="stylesheet">
<link href="/fontawesome/css/brands.min.css" rel="stylesheet">
<link href="/fontawesome/css/v5-font-face.min.css" rel="stylesheet" />

<!-- Styles -->
<link href="/css/bootstrap.min.css" rel="stylesheet">
{!! css('languages.min') !!}
<link href="/css/main.css" rel="stylesheet">

@yield('headExtra')


