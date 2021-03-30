<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🏡</text></svg>">

        <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>

        <script>
            window.me = @json(auth()->check() ? ['loggedIn' => auth()->check() ?? false, 'i' => auth()->id()] : false)
        </script>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    {{--        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">--}}

        <!-- Styles -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @yield('styles')
        @livewireStyles
    </head>
    <body class="font-sans antialiased bg-gray-50">
{{--        <x-jet-banner />--}}

        {{--<div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>--}}

{{--        @stack('modals')--}}

        @livewireScripts
        <div class="min-h-screen">

                <div id="app" v-cloak>

                    @include('layouts.nav')

                    @yield('content')

                </div>
        </div>

    <script src="{{ mix('/js/manifest.js') }}"></script>
    <script src="{{ mix('/js/app.js') }}"></script>
    <script src="{{ mix('/js/vendor.js') }}"></script>
    </body>
</html>
