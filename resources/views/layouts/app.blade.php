<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta property="og:site_name" content="Houseify">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="google-site-verification" content="SCtMxv5igpA_geVlWon_J8b0PmgBTkb81jATbcpYYS8" />
        <link rel="icon" href="/logos/favicon.png">
        @yield('meta')

        <title>@yield('title') | {{ config('app.name') }}</title>

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

        @if(app()->environment('production'))
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-0ZK70CFF51"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-0ZK70CFF51');
        </script>
        @endif
    </head>
    <body class="font-sans antialiased bg-gray-50 min-w-full">

{{--        @stack('modals')--}}

        <div class="bg-transparent">
            <div class="max-w-7xl mx-auto py-3 px-3 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between flex-wrap">
                    <div class="w-0 flex-1 flex items-center">
                            <span class="flex p-2 rounded-lg bg-cyan-600">
                                <i class="fas fa-code-branch text-white"></i>
                            </span>
                        <p class="ml-3 font-semibold text-cyan-700 truncate">
                                  <span class="sm:hidden">
                                    ¡Nuestra versión Beta esta al aire!
                                  </span>
                            <span class="hidden sm:block lg:hidden">
                                    ¡Nuestra versión Beta está al aire, espera nuevas funcionalidades!
                                  </span>
                            <span class="hidden md:inline">
                                Nos encontramos en nuestra versión Beta, Lo que significa que añadiremos funcionalidades nuevas para apoyar la industria constructora. Gracias!
                              </span>
                        </p>
                    </div>
                    <div class="order-3 mt-2 flex-shrink-0 w-full sm:order-2 sm:mt-0 sm:w-auto">
                        {{--<a href="" class="flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-cyan-600 bg-white hover:bg-cyan-50">
                            Registrate
                        </a>--}}
                    </div>
                    <div class="order-2 flex-shrink-0 sm:order-3 sm:ml-3">
                        <button type="button" class="bg-transparent -mr-1 flex p-2 focus:outline-none sm:-mr-2">
                            {{--<span class="sr-only">Dismiss</span>
                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>--}}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        @livewireScripts

        <div class="min-h-screen w-full">
            <div id="app" v-cloak>

                @include('layouts.nav')

                @yield('content')

            </div>
        </div>

    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    @yield('scripts')

    </body>
</html>
