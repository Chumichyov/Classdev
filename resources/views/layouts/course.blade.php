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
            <a class="navbar-brand ms-1 points" style="max-width: 300px;" href="{{ route('course.show', $course) }}">
                {{ $course->title }}
            </a>

            <div class="collapse navbar-collapse" id="navbarsExample02">
                <!-- Left Side Of Navbar -->

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <!-- User -->
                        @include('examples.layouts.profile_dropdown')
                    @endguest
                </ul>
            </div>
        </nav>
        @if (Route::currentRouteName() == 'course.setting.index')
            @include('examples.layouts.setting.header')
        @elseif (Route::currentRouteName() == 'course.setting.connection.index')
            @include('examples.layouts.setting.header')
        @elseif (Route::currentRouteName() == 'course.setting.task.index')
            @include('examples.layouts.setting.header')
        @elseif (Route::currentRouteName() == 'course.setting.task.show')
            @include('examples.layouts.setting.header')
        @else
            @include('examples.layouts.course.header')
        @endif
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
