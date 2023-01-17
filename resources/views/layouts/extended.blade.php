<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css'])
</head>

<body>
    <div id="app">
        @include('examples.layouts.sidebar')
        <nav class="navbar my navbar-expand navbar-light bg-white shadow-sm ps-4 pe-4">
            @include('examples.layouts.burger')
            <a class="navbar-brand ms-1" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>

            <div class="collapse navbar-collapse" id="navbarsExample02">
                <!-- Left Side Of Navbar -->

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Add Course -->
                    <li class="nav-item position-relative">
                        <a class="nav-link hover-view rounded-circle" href="{{ route('course.create') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor"
                                class="bi bi-plus" viewBox="0 0 16 16">
                                <path
                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                            </svg>
                        </a>
                        @if (auth()->user()->invitation->count() > 0)
                            <div class="position-absolute top-0 end-0 mt-1 me-1 rounded-circle bg-success text-white d-flex
                            align-items-center justify-content-center"
                                style="width: 15px; height: 15px; font-size: 10px">
                                {{ auth()->user()->invitation->count() >= 10? '>': auth()->user()->invitation->count() }}
                            </div>
                        @endif
                    </li>
                    <!-- User -->
                    @include('examples.layouts.profile_dropdown')
                </ul>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
