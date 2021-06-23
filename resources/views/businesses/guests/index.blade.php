@extends('layouts.app')

@section('title', 'Directorio de Negocios')

@section('meta')
    <meta property="og:url" content="{{ route('web.public.businesses.index') }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Directorio de Negocios y Empresas relacionadas a Construcción en México." />
    <meta property="og:description" content="Encuentra y Registra negocios y empresas relacionadas a Construcción en México." />
    <meta property="og:image" content="/logos/houseify-13.png" />
@endsection

@section('content')
    <businesses inline-template>
        <div>
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div class="w-full lg:flex lg:justify-between items-center">
                        <h2 class="font-semibold text-2xl text-teal-400">
                            @{{ headerTitle }}
                        </h2>
                        <div class="hidden md:flex md:justify-between md:mt-4">
                            <a @click="activeTab = 'explore-businesses'"
                               role="button"
                               href="#"
                               class="h-link mx-2 text-base font-medium text-cyan-500 border-b-2 leading-5"
                               :class="[activeTab === 'explore-businesses' ? 'border-emerald-400 text-cyan-600' : 'hover:border-emerald-400 hover:text-cyan-600']">
                                Explorar Negocios
                            </a>
                            <a @click="activeTab = 'my-businesses'"
                               role="button"
                               href="#"
                               class="h-link mx-2 text-base font-medium text-cyan-500 border-b-2 leading-5"
                               :class="[activeTab === 'my-businesses' ? 'border-emerald-400 text-cyan-600' : 'hover:border-emerald-400 hover:text-cyan-600']">
                                Mis Negocios
                            </a>
                            <a @click="activeTab = 'interesting-businesses'"
                               role="button"
                               href="#"
                               class="h-link mx-2 text-base font-medium text-cyan-500 border-b-2 leading-5"
                               :class="[activeTab === 'interesting-businesses' ? 'border-emerald-400 text-cyan-600' : 'hover:border-emerald-400 hover:text-cyan-600']">
                                Mis Intereses
                            </a>
                            <a @click="activeTab = 'search-businesses'"
                               role="button"
                               href="#"
                               class="h-link mx-2 text-base font-medium text-cyan-500 border-b-2 leading-5"
                               :class="[activeTab === 'search-businesses' ? 'border-emerald-400 text-cyan-600' : 'hover:border-emerald-400 hover:text-cyan-600']">
                                Búsqueda de Negocios
                            </a>
                        </div>

                        {{--Mobile--}}
                        <div class="w-full md:hidden mt-2">
                            <div class="flex-1 w-full ">
                                <a @click="activeTab = 'explore-businesses'"
                                   role="button"
                                   href="#"
                                   class="text-base font-normal text-cyan-500 hover:border-emerald-400 border-b-2 hover:text-cyan-600 leading-5 transition duration-150 ease-in-out"
                                   :class="[activeTab === 'explore-businesses' ? 'border-emerald-400 text-cyan-600' : 'hover:border-emerald-400 hover:text-cyan-600']">
                                    Explorar Negocios
                                </a>
                            </div>
                            <div class="flex-1 md:hidden mt-2">
                                <a @click="activeTab = 'my-businesses'"
                                   role="button"
                                   href="#"
                                   class="text-base font-normal text-cyan-500 hover:border-emerald-400 border-b-2 hover:text-cyan-600 leading-5 transition duration-150 ease-in-out"
                                   :class="[activeTab === 'my-businesses' ? 'border-emerald-400 text-cyan-600' : 'hover:border-emerald-400 hover:text-cyan-600']">
                                    Mis Negocios
                                </a>
                            </div>
                            <div class="flex-1 md:hidden mt-2">
                                <a @click="activeTab = 'interesting-businesses'"
                                   role="button"
                                   href="#"
                                   class="text-base font-normal text-cyan-500 hover:border-emerald-400 border-b-2 hover:text-cyan-600 leading-5 transition duration-150 ease-in-out">
                                    Mis Intereses
                                </a>
                            </div>
                            <div class="flex-1 md:hidden mt-2">
                                <a @click="activeTab = 'search-businesses'"
                                   role="button"
                                   href="#"
                                   class="text-base font-normal text-cyan-500 hover:border-emerald-400 border-b-2 hover:text-cyan-600 leading-5 transition duration-150 ease-in-out">
                                    Búsqueda de Negocios
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <main class="">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="px-4 py-6 sm:px-0">
                        <div v-show="activeTab === 'explore-businesses'" class="text-3xl block">
                            @foreach($businesses as $business)
                                <div class="flex-wrap md:flex sm:justify-center mt-3">
                                    <business-card
                                        :business="{{ json_encode($business) }}"
                                    ></business-card>
                                </div>
                            @endforeach
                        </div>
                        {{ $businesses->links() }}
                        <div v-show="activeTab === 'my-businesses'" class="text-3xl block">
                            <div class="text-center">
                                <p class="px-10 py-6 text-lg text-center text-gray-500">
                                    <a href="{{ route('login') }}"
                                       class="h-link text-teal-500">
                                        Inicia sesión
                                    </a> y publica tu(s) Negocio/Empresa.
                                </p>
                            </div>
                        </div>
                        <div v-show="activeTab === 'interesting-businesses'" class="text-3xl block">
                            <div class="text-center">
                                <p class="px-10 py-6 text-lg text-center text-gray-500">
                                    Debes
                                    <a href="{{ route('login') }}"
                                       class="h-link text-teal-500">
                                        Iniciar sesión
                                    </a> para guardar negocios de interés.
                                </p>
                            </div>
                        </div>
                        <div v-show="activeTab === 'search-businesses'"
                             class="text-3xl block">
                            <search-businesses></search-businesses>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </businesses>
@endsection

