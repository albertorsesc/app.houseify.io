@extends('layouts.app')

@section('title', 'Perfil')

@section('content')
    <profile inline-template>
        <div>
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div class="w-full md:flex md:justify-between items-center">
                        <h2 class="font-semibold text-2xl text-teal-400">
                            Mi Perfil
                        </h2>

                        <div class="hidden md:flex md:justify-between">
                            <a @click="activeTab = 'profile'"
                               role="button"
                               href="#"
                               class="mx-2 text-base font-medium text-cyan-500 border-b-2 leading-5 transition duration-150 ease-in-out"
                               :class="[activeTab === 'profile' ? 'border-emerald-400 text-cyan-600' : 'hover:border-emerald-400 hover:text-cyan-600']">
                                Perfil
                            </a>
                            <a @click="activeTab = 'notifications'"
                               role="button"
                               href="#"
                               class="mx-2 text-base font-medium text-cyan-500 border-b-2 leading-5 transition duration-150 ease-in-out"
                               :class="[activeTab === 'notifications' ? 'border-emerald-400 text-cyan-600' : 'hover:border-emerald-400 hover:text-cyan-600']">
                                Notificaciones
                            </a>
                            <a @click="activeTab = 'subscriptions'"
                               role="button"
                               href="#"
                               class="mx-2 text-base font-medium text-cyan-500 border-b-2 leading-5 transition duration-150 ease-in-out"
                               :class="[activeTab === 'subscriptions' ? 'border-emerald-400 text-cyan-600' : 'hover:border-emerald-400 hover:text-cyan-600']">
                                Suscripciones
                            </a>
                            <a @click="activeTab = 'payment-methods'"
                               role="button"
                               href="#"
                               class="mx-2 text-base font-medium text-cyan-500 border-b-2 leading-5 transition duration-150 ease-in-out"
                               :class="[activeTab === 'payment-methods' ? 'border-emerald-400 text-cyan-600' : 'hover:border-emerald-400 hover:text-cyan-600']">
                                Metodos de Pago
                            </a>
                        </div>
                    </div>
                </div>
            </header>

            <div v-show="activeTab === 'profile'">
                <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                    @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                        @livewire('profile.update-profile-information-form')

                        <x-jet-section-border />
                    @endif

                    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                        <div class="mt-10 sm:mt-0">
                            @livewire('profile.update-password-form')
                        </div>

                        <x-jet-section-border />
                    @endif

                    @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                        <div class="mt-10 sm:mt-0">
                            @livewire('profile.two-factor-authentication-form')
                        </div>

                        <x-jet-section-border />
                    @endif

                    <div class="mt-10 sm:mt-0">
                        @livewire('profile.logout-other-browser-sessions-form')
                    </div>

                    @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                        <x-jet-section-border />

                        <div class="mt-10 sm:mt-0">
                            @livewire('profile.delete-user-form')
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </profile>
@endsection
