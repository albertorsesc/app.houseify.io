@extends('layouts.app')

@section('title', 'Directorio de Profesionales')

@section('meta')
    <meta property="og:url" content="{{ route('web.public.job-profiles.index') }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Directorio de Técnicos y Profesionistas de la Construcción en México." />
    <meta property="og:description" content="Encuentra y Registrate como Técnico o Profesionista de la Construcción en México." />
    <meta property="og:image" content="/logos/houseify-13.png" />
@endsection

@section('content')
    <job-profiles inline-template>
        <div>
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div class="w-full lg:flex lg:justify-between items-center">
                        <h2 class="font-semibold text-2xl text-teal-400">
                            @{{ headerTitle }}
                        </h2>
                        <div class="hidden md:flex md:justify-between md:mt-4">
                            <a @click="activeTab = 'explore-job-profiles'"
                               role="button"
                               href="#"
                               class="h-link mx-2 text-base font-medium text-cyan-500 border-b-2 leading-5"
                               :class="[activeTab === 'explore-job-profiles' ? 'border-emerald-400 text-cyan-600' : 'hover:border-emerald-400 hover:text-cyan-600']">
                                Explorar Técnicos y/o Profesionistas
                            </a>
                            <a @click="activeTab = 'my-job-profiles'"
                               role="button"
                               href="#"
                               class="h-link mx-2 text-base font-medium text-cyan-500 border-b-2 leading-5"
                               :class="[activeTab === 'my-job-profiles' ? 'border-emerald-400 text-cyan-600' : 'hover:border-emerald-400 hover:text-cyan-600']">
                                Mi Perfil Técnico
                            </a>
                            <a @click="activeTab = 'interesting-job-profiles'"
                               role="button"
                               href="#"
                               class="h-link mx-2 text-base font-medium text-cyan-500 border-b-2 leading-5"
                               :class="[activeTab === 'interesting-job-profiles' ? 'border-emerald-400 text-cyan-600' : 'hover:border-emerald-400 hover:text-cyan-600']">
                                Mis Intereses
                            </a>
                            <a @click="activeTab = 'search-job-profiles'"
                               role="button"
                               href="#"
                               class="h-link mx-2 text-base font-medium text-cyan-500 border-b-2 leading-5"
                               :class="[activeTab === 'search-job-profiles' ? 'border-emerald-400 text-cyan-600' : 'hover:border-emerald-400 hover:text-cyan-600']">
                                Búsqueda de Técnicos
                            </a>
                        </div>

                        {{--Mobile--}}
                        <div class="w-full md:hidden mt-2">
                            <div class="flex-1 w-full ">
                                <a @click="activeTab = 'explore-job-profiles'"
                                   role="button"
                                   href="#"
                                   class="text-base font-normal text-cyan-500 hover:border-emerald-400 border-b-2 hover:text-cyan-600 leading-5 transition duration-150 ease-in-out"
                                   :class="[activeTab === 'explore-job-profiles' ? 'border-emerald-400 text-cyan-600' : 'hover:border-emerald-400 hover:text-cyan-600']">
                                    Explorar Técnicos
                                </a>
                            </div>
                            <div class="flex-1 md:hidden mt-2">
                                <a @click="activeTab = 'my-job-profiles'"
                                   role="button"
                                   href="#"
                                   class="text-base font-normal text-cyan-500 hover:border-emerald-400 border-b-2 hover:text-cyan-600 leading-5 transition duration-150 ease-in-out"
                                   :class="[activeTab === 'my-job-profiles' ? 'border-emerald-400 text-cyan-600' : 'hover:border-emerald-400 hover:text-cyan-600']">
                                    Mi Perfil
                                </a>
                            </div>
                            <div class="flex-1 md:hidden mt-2">
                                <a @click="activeTab = 'interesting-job-profiles'"
                                   role="button"
                                   href="#"
                                   class="text-base font-normal text-cyan-500 hover:border-emerald-400 border-b-2 hover:text-cyan-600 leading-5 transition duration-150 ease-in-out">
                                    Mis Intereses
                                </a>
                            </div>
                            <div class="flex-1 md:hidden mt-2">
                                <a @click="activeTab = 'search-job-profiles'"
                                   role="button"
                                   href="#"
                                   class="text-base font-normal text-cyan-500 hover:border-emerald-400 border-b-2 hover:text-cyan-600 leading-5 transition duration-150 ease-in-out">
                                    Búsqueda de Técnicos
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <main class="">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="px-4 py-6 sm:px-0">
                        <div v-show="activeTab === 'explore-job-profiles'" class="text-3xl block">
                            @foreach($jobProfiles as $jobProfile)
                                <div class="flex-wrap md:flex sm:justify-center mt-3">
                                    <job-profile-card
                                        :job-profile="{{ json_encode($jobProfile) }}"
                                    ></job-profile-card>
                                </div>
                            @endforeach
                        </div>
                        {{ $jobProfiles->links() }}
                        <div v-show="activeTab === 'my-job-profiles'" class="text-3xl block">
                            <div class="text-center">
                                <p class="px-10 py-6 text-lg text-center text-gray-500">
                                    <a href="{{ route('login') }}"
                                       class="h-link text-teal-500">
                                        Inicia sesión
                                    </a> y publica tu Perfil Técnico.
                                </p>
                            </div>
                        </div>
                        <div v-show="activeTab === 'interesting-job-profiles'" class="text-3xl block">
                            <div class="text-center">
                                <p class="px-10 py-6 text-lg text-center text-gray-500">
                                    Debes
                                    <a href="{{ route('login') }}"
                                       class="h-link text-teal-500">
                                        Iniciar sesión
                                    </a> para guardar Técnicos de interés.
                                </p>
                            </div>
                        </div>
                        <div v-show="activeTab === 'search-job-profiles'"
                             class="text-3xl block">
                            <search-job-profiles></search-job-profiles>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </job-profiles>
@endsection

