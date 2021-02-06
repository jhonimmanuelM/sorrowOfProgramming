<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>DCKAP - Blackbox</title>
    <link rel='shortcut icon' type='image/x-icon' href="{{ asset('assets/img/favicon.ico') }}"/>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/app.min.css') }}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom/custom.css') }}">
</head>
<body>
<div class="loader"></div>
<div id="app">
    <div class="main-wrapper main-wrapper-1">
        @if (Route::has('login'))
            @auth
                @include('layouts.header')
                @include('layouts.sidebar')
            @endif
        @endif
        <div class="main-content">
            <section class="section">
                @yield('content')
            </section>
            @include('layouts.setting-sidebar')
        </div>
        @include('layouts.footer')
    </div>
</div>
</body>
</html>
