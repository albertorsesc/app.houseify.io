<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            En Houseify agradecemos que te hayas unido y que encuentres util esta herramienta hecha para ti!
            Antes de comenzar, podrias verificar tu correo electronico al hacer click en el enlace que se envio a tu correo?
            Si no recibiste el correo, con gusto enviaremos otro.
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                Un nuevo enlace de verificacion ha sido enviado al correo electronico que nos proporcionaste durante el registro.
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-jet-button type="submit">
                        Reenviar correo de verificacion
                    </x-jet-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Cerrar Sesion
                </button>
            </form>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>
