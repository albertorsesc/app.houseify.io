<x-guest-layout>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 text-sm border-t-4 border-red-400 rounded-b px-4 py-3 shadow-md w-full mt-2 mb-6" role="alert">
                <div class="flex justify-start align-middle items-center">
                    <div class="py-1"><svg class="text-red-600 fill-current h-6 w-6 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                    <div>
                        <p class="font-bold">
                            Algo sucedio; {{ session('error') }}
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Correo Electrónico') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Contraseña') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block md:flex md:justify-between mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Recordar este dispositivo') }}</span>
                </label>
                <a class="hidden md:block underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                    {{ __('Crear una cuenta') }}
                </a>
            </div>

            <div class="md:flex md:items-center items-end align-middle md:justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="mt-8 underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('¿Olvidaste tu contraseña?') }}
                    </a>
                @endif

                <a class="mt-2 hidden underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                    {{ __('Crear una cuenta') }}
                </a>

                <button class="w-full md:w-auto md:ml-4 mt-4 py-4 h-btn-success"
                        onclick="login">
                    {{ __('Iniciar sesión') }}
                </button>

                <a href="{{ route('register') }}" class="block md:hidden w-full md:ml-4 mt-4 py-4 h-btn-success">
                    {{ __('Crear una cuenta') }}
                </a>

            </div>

            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center">
            <span class="px-2 bg-white text-sm text-gray-500">
                Iniciar sesión por medio de
            </span>
                </div>
            </div>

            <div class="w-full mx-auto flex justify-center items-center align-middle mt-4">
                <div class="w-auto items-center align-middle mr-4">
                    <a href="{{ route('facebook.redirect') }}"
                       class="flex align-middle items-center py-2 px-3 bg-blue-500 rounded-full shadow text-white text-sm"
                       title="Inicia Sesión con Facebook">
                        <i class="fab fa-facebook -mb-1 h-5 w-5 rounded-full"></i>
                        {{ __('Facebook') }}
                    </a>
                </div>
                <div class="w-auto items-center">
                    <a href="{{ route('google.redirect') }}"
                       class="flex align-middle items-center py-2 px-3 bg-white rounded-full shadow text-gray-700 text-sm"
                       title="Inicia Sesión con Google">
                        <img src="/logos/google-icon.png" class="mr-2 object-contain h-3 w-3 rounded-full" alt="">
                        {{ __('Google') }}
                    </a>
                </div>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>

<script>
    function login () {
        window.axios.get('/sanctum/csrf-cookie').then(response => {
            window.axios.post('login').then(response => {
                dd('bienvenido');
            });
        });
    }
</script>
