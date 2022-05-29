<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title', 'Welcome to Win Win Service Provider') </title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.1/css/all.css" />

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">

    @stack('styles')

</head>

<body>

    <div class="container g-0 border shadow bg-white rounded position-relative">
        @include('layouts.navbar')

        <main class="mt-1 mb-5 px-3">
            @yield('content')
        </main>
        <div class="position-absolute bottom-0 start-0 w-100 text-center py-2 bg-light border-top border-gray"> Copyright © 2022 Iqbal Hossen. All Rights Reserved </div>
    </div>

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Vuejs CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js"></script>
    <script src="https://unpkg.com/vue@next"></script>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#success").delay(5000).slideUp(300);
        });
    </script>

    @stack('scripts')

</body>

</html>
