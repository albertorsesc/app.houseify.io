@extends('layouts.app')

@section('title', 'Propiedades')

@section('meta')
    <meta property="og:url" content="{{ route('web.public.properties.index') }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Propiedades en venta, renta o traspaso en México." />
    <meta property="og:description" content="Encuentra propiedades en venta, renta o traspaso en México." />
    <meta property="og:image" content="/logos/houseify-13.png" />
@endsection

@section('content')
    <properties inline-template>
        <div>
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div class="w-full lg:flex lg:justify-between items-center">
                        <h2 class="font-semibold text-2xl text-teal-400">
                            @{{ headerTitle }}
                        </h2>
                        <div class="hidden md:flex md:justify-between md:mt-4">
                            <a @click="activeTab = 'explore-properties'"
                               role="button"
                               href="#"
                               class="h-link mx-2 text-base font-medium text-cyan-500 border-b-2 leading-5"
                               :class="[activeTab === 'explore-properties' ? 'border-emerald-400 text-cyan-600' : 'hover:border-emerald-400 hover:text-cyan-600']">
                                Explorar Propiedades
                            </a>
                            <a @click="activeTab = 'my-properties'"
                               role="button"
                               href="#"
                               class="h-link mx-2 text-base font-medium text-cyan-500 border-b-2 leading-5"
                               :class="[activeTab === 'my-properties' ? 'border-emerald-400 text-cyan-600' : 'hover:border-emerald-400 hover:text-cyan-600']">
                                Mis Propiedades
                            </a>
                            <a @click="activeTab = 'interesting-properties'"
                               role="button"
                               href="#"
                               class="h-link mx-2 text-base font-medium text-cyan-500 border-b-2 leading-5"
                               :class="[activeTab === 'interesting-properties' ? 'border-emerald-400 text-cyan-600' : 'hover:border-emerald-400 hover:text-cyan-600']">
                                Mis Intereses
                            </a>
                            <a @click="activeTab = 'search-properties'"
                               role="button"
                               href="#"
                               class="h-link mx-2 text-base font-medium text-cyan-500 border-b-2 leading-5"
                               :class="[activeTab === 'search-properties' ? 'border-emerald-400 text-cyan-600' : 'hover:border-emerald-400 hover:text-cyan-600']">
                                Búsqueda de Propiedades
                            </a>
                        </div>

                        {{--Mobile--}}
                        <div class="w-full md:hidden mt-2">
                            <div class="flex-1 w-full ">
                                <a @click="activeTab = 'explore-properties'"
                                   role="button"
                                   href="#"
                                   class="text-base font-normal text-cyan-500 hover:border-emerald-400 border-b-2 hover:text-cyan-600 leading-5 transition duration-150 ease-in-out"
                                   :class="[activeTab === 'explore-properties' ? 'border-emerald-400 text-cyan-600' : 'hover:border-emerald-400 hover:text-cyan-600']">
                                    Explorar Propiedades
                                </a>
                            </div>
                            <div class="flex-1 md:hidden mt-2">
                                <a @click="activeTab = 'my-properties'"
                                   role="button"
                                   href="#"
                                   class="text-base font-normal text-cyan-500 hover:border-emerald-400 border-b-2 hover:text-cyan-600 leading-5 transition duration-150 ease-in-out"
                                   :class="[activeTab === 'my-properties' ? 'border-emerald-400 text-cyan-600' : 'hover:border-emerald-400 hover:text-cyan-600']">
                                    Mis Propiedades
                                </a>
                            </div>
                            <div class="flex-1 md:hidden mt-2">
                                <a @click="activeTab = 'interesting-properties'"
                                   role="button"
                                   href="#"
                                   class="text-base font-normal text-cyan-500 hover:border-emerald-400 border-b-2 hover:text-cyan-600 leading-5 transition duration-150 ease-in-out">
                                    Mis Intereses
                                </a>
                            </div>
                            <div class="flex-1 md:hidden mt-2">
                                <a @click="activeTab = 'search-properties'"
                                   role="button"
                                   href="#"
                                   class="text-base font-normal text-cyan-500 hover:border-emerald-400 border-b-2 hover:text-cyan-600 leading-5 transition duration-150 ease-in-out">
                                    Búsqueda de Propiedades
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <main class="">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <!-- Replace with your content -->
                    <div class="px-4 py-6 sm:px-0">
                        <div v-show="activeTab === 'explore-properties'" class="text-3xl block">
                            @foreach($properties as $property)
                                <div class="flex-wrap md:flex sm:justify-center mt-3">
                                    <property-card
                                        :property="{{ json_encode($property) }}"
                                    ></property-card>
                                </div>
                            @endforeach
                        </div>
                        {{ $properties->links() }}
                        <div v-show="activeTab === 'my-properties'" class="text-3xl block">
                            <div class="text-center">
                                <p class="px-10 py-6 text-lg text-center text-gray-500">
                                    <a href="{{ route('login') }}"
                                       class="h-link text-teal-500">
                                        Inicia sesión
                                    </a> y publica tus propiedades.
                                </p>
                            </div>
                        </div>
                        <div v-show="activeTab === 'interesting-properties'" class="text-3xl block">
                            <div class="text-center">
                                <p class="px-10 py-6 text-lg text-center text-gray-500">
                                    Debes
                                    <a href="{{ route('login') }}"
                                       class="h-link text-teal-500">
                                        Iniciar sesión
                                    </a> para guardar propiedades de interés.
                                </p>
                            </div>
                        </div>
                        <div v-show="activeTab === 'search-properties'"
                             class="text-3xl block">
                            <search-properties></search-properties>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </properties>
@endsection

