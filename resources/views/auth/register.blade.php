<x-guest-layout>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-jet-label for="first_name" value="{{ __('Nombre') }}" />
                <x-jet-input id="first_name" class="block mt-1 w-full h-input" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="first_name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="last_name" value="{{ __('Apellido') }}" />
                <x-jet-input id="last_name" class="block mt-1 w-full h-input" type="text" name="last_name" :value="old('last_name')" required autofocus autocomplete="last_name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Correo Electrónico') }}" />
                <x-jet-input id="email" class="block mt-1 w-full h-input" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Contraseña') }}" />
                <x-jet-input id="password" class="block mt-1 w-full h-input" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirmar Contraseña') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full h-input" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('Al hacer clic en "Registrarte", aceptas nuestras Condiciones, la Política de datos y la Política de cookies :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terminos de Servicio').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Politicas de Privacidad').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="md:flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Ya estas registrad@?') }}
                </a>

                <button class="w-full md:w-auto md:ml-4 mt-4 py-4 h-btn-success">
                    {{ __('Registrarme') }}
                </button>
            </div>
            <div class="w-full mx-auto flex justify-center md:justify-end items-center align-middle mt-4">
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
