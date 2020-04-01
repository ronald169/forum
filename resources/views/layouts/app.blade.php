<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/summernote.css">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script>
        window.App = {!! json_encode([
        'signedIn' => Auth::check(),
        'user' => Auth::user()
        ]) !!}
    </script>

    <!-- -->
    @yield('head')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <link href="https://fonts.googleapis.com/css?family=Nunito:400,700|Open+Sans|Oswald&display=swap" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app" class="trix-content">
        <div class="min-h-screen flex flex-col">



            @include('layouts.nav')

            <main class=" flex-1">
                @yield('content')
            </main>



            <flash message="{{ session('flash') }}"></flash>
        </div>

        <footer class="bg-gray-200 text-center font-semibold font-small mt-10 text-sm p-10">Copyright 2020 tout droit reservé. Open Knowledge</footer>
    </div>

    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
