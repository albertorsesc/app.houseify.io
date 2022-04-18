<x-jet-action-section>
    <x-slot name="title">
        {{ __('Desvincular mis Cuentas Sociales') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Desvincular y Eliminar mis cuentas sociales de forma definitiva. En caso de no tener contraseña se te pedirá crear una.') }}
    </x-slot>

    <x-slot name="content">
        <div class="flex">
            @if(auth()->user()->socialAccounts()->where('name', 'facebook')->exists())
            <div class="w-1/6 flex">
                <a href="{{ route('social-login.destroy', 'facebook') }}"
                   class="flex align-middle items-center py-2 px-3 bg-blue-500 rounded-full shadow text-white text-sm"
                   title="Desvincular Facebook">
                    <i class="fab fa-facebook -mb-1 h-5 w-5 rounded-full"></i>
                    Facebook
                </a>
            </div>
            @endif
            @if(auth()->user()->socialAccounts()->where('name', 'google')->exists())
            <div class="w-1/6 flex">
                <a href="{{ route('social-login.destroy', 'google') }}"
                   class="flex align-middle items-center py-2 px-3 bg-white rounded-full shadow text-gray-700 text-sm"
                   title="Desvincular Google">
                    <img src="/logos/google-icon.png" class="mr-2 object-contain h-3 w-3 rounded-full" alt="">
                    {{ __('Google') }}
                </a>
            </div>
            @endif
        </div>
    </x-slot>
</x-jet-action-section>
