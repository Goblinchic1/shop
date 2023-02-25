<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ Vite::image('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ Vite::image('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ Vite::image('favicon-16x16.png') }}">

    <title>@yield('title', $seo_title ?? env('APP_NAME'))</title>

    @vite(['resources/css/app.css','resources/sass/main.sass', 'resources/js/app.js'])
</head>
<body class="antialiased">

@include('shared.flash')

@include('shared.header')

<main class="py-16 lg:py-20">
    <div class="container">
@yield('content')
    </div>
</main>

@include('shared.footer')

<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</body>
</html>
