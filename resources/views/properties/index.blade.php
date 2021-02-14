@extends('layouts.app')

@section('title', 'Propiedades')

@section('styles')
    <link rel="stylesheet" href="/css/vue-multiselect.min.css">
@endsection

@section('content')
    <properties inline-template>
        <div>
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div class="w-full md:flex md:justify-between items-center">
                        <h2 class="font-semibold text-2xl text-teal-400">
                            @{{ headerTitle }}
                        </h2>
                        <div class="hidden md:flex md:justify-between">
                            <a @click="activeTab = 'explore-properties'"
                               role="button"
                               href="#"
                               class="mx-2 text-base font-medium text-cyan-500 border-b-2 leading-5 transition duration-150 ease-in-out"
                               :class="[activeTab === 'explore-properties' ? 'border-emerald-400 text-cyan-600' : 'hover:border-emerald-400 hover:text-cyan-600']">
                                Explorar Propiedades
                            </a>
                            <a @click="activeTab = 'my-properties'"
                               role="button"
                               href="#"
                               class="mx-2 text-base font-medium text-cyan-500 border-b-2 leading-5 transition duration-150 ease-in-out"
                               :class="[activeTab === 'my-properties' ? 'border-emerald-400 text-cyan-600' : 'hover:border-emerald-400 hover:text-cyan-600']">
                                Mis Propiedades
                            </a>
                            <a @click="activeTab = 'interesting-properties'"
                               role="button"
                               href="#"
                               class="mx-2 text-base font-medium text-cyan-500 border-b-2 leading-5 transition duration-150 ease-in-out"
                               :class="[activeTab === 'interesting-properties' ? 'border-emerald-400 text-cyan-600' : 'hover:border-emerald-400 hover:text-cyan-600']">
                                Mis Intereses
                            </a>
                            <a @click="activeTab = 'search-properties'"
                               role="button"
                               href="#"
                               class="mx-2 text-base font-medium text-cyan-500 border-b-2 leading-5 transition duration-150 ease-in-out"
                               :class="[activeTab === 'search-properties' ? 'border-emerald-400 text-cyan-600' : 'hover:border-emerald-400 hover:text-cyan-600']">
                                Busqueda de Propiedades
                            </a>
                        </div>

                        {{--Mobile--}}
                        <div class="w-full md:hidden mt-2">
                            <div class="flex-1 w-full ">
                                <a @click="activeTab = 'explore-properties'"
                                   role="button"
                                   href="#"
                                   class="text-base font-normal text-cyan-500 hover:border-emerald-400 border-b-2 hover:text-cyan-600 leading-5 transition duration-150 ease-in-out">
                                    Explorar Propiedades
                                </a>
                            </div>
                            <div class="flex-1 md:hidden mt-2">
                                <a @click="activeTab = 'my-properties'"
                                   role="button"
                                   href="#"
                                   class="text-base font-normal text-cyan-500 hover:border-emerald-400 border-b-2 hover:text-cyan-600 leading-5 transition duration-150 ease-in-out">
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
                                    Busqueda de Propiedades
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
                            <explore-properties></explore-properties>
                        </div>
                        <div v-show="activeTab === 'my-properties'" class="text-3xl block">
                            <my-properties></my-properties>
                        </div>
                        <div v-show="activeTab === 'interesting-properties'" class="text-3xl block">
                            <interesting-properties></interesting-properties>
                        </div>
                        <div v-show="activeTab === 'search-properties'"
                             class="text-3xl block">
                            Busqueda Avanzada de Propiedades
                        </div>
                    </div>
                    <!-- /End replace -->
                </div>
            </main>
        </div>
    </properties>
@endsection
