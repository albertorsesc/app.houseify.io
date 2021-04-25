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

                <a class="mt-2 block md:hidden underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                    {{ __('Crear una cuenta') }}
                </a>

                <button class="ml-4 mt-4 h-btn-success"
                        onclick="login">
                    {{ __('Iniciar sesión') }}
                </button>

            </div>

            <div class="w-full mx-auto flex justify-center items-center align-middle mt-4">
                <div class="w-full md:w-1/2">
                    <a href="{{ route('facebook.redirect') }}"
                       class="py-2 px-3 bg-blue-500 rounded-full shadow text-white text-sm md:text-xs">
                        <i class="fab fa-facebook h-5 w-5 rounded-full"></i>
                        {{ __('Iniciar sesión con Facebook') }}
                    </a>
                </div>
                <div class="w-full md:w-1/2">
                    <a href="{{ route('google.redirect') }}"
                       class="flex align-middle items-center py-2 px-3 bg-white rounded-full shadow text-gray-700 text-sm md:text-xs">
                        <img src="/logos/google-icon.png" class="mr-2 object-contain h-3 w-3 rounded-full" alt="">
                        {{ __('Iniciar sesión con Google') }}
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
