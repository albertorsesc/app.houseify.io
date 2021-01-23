@extends('layouts.app')

@section('title', 'Propiedades')
{{--<x-app-layout>--}}
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
                               class="mx-2 text-base font-medium text-cyan-500 hover:border-emerald-400 border-b-2 hover:text-cyan-600 leading-5 transition duration-150 ease-in-out">
                                Explorar Propiedades
                            </a>
                            <a @click="activeTab = 'my-properties'"
                               role="button"
                               href="#"
                               class="mx-2 text-base font-medium text-cyan-500 hover:border-emerald-400 border-b-2 hover:text-cyan-600 leading-5 transition duration-150 ease-in-out">
                                Mis Propiedades
                            </a>
                            <a @click="activeTab = 'my-interests'"
                               role="button"
                               href="#"
                               class="mx-2 text-base font-medium text-cyan-500 hover:border-emerald-400 border-b-2 hover:text-cyan-600 leading-5 transition duration-150 ease-in-out">
                                Mis Intereses
                            </a>
                            <a @click="activeTab = 'search-properties'"
                               role="button"
                               href="#"
                               class="mx-2 text-base font-medium text-cyan-500 hover:border-emerald-400 border-b-2 hover:text-cyan-600 leading-5 transition duration-150 ease-in-out">
                                Busqueda de Propiedades
                            </a>
                        </div>

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
                                <a @click="activeTab = 'my-interests'"
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

            <main>
                <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                    <!-- Replace with your content -->
                    <div class="px-4 py-6 sm:px-0 bg-red-300">
                        <div v-show="activeTab === 'explore-properties'" class="text-3xl block">Explorando</div>
                        <div v-show="activeTab === 'my-properties'" class="text-3xl block">Mis Propiedades</div>
                        <div v-show="activeTab === 'my-interests'" class="text-3xl block">Mis Intereses</div>
                        <div v-show="activeTab === 'search-properties'" class="text-3xl block">Busqueda Avanzada de Propiedades</div>
                        {{--                        <div class="border-4 border-dashed border-gray-200 rounded-lg h-96"></div>--}}
                    </div>
                    <!-- /End replace -->
                </div>
            </main>
        </div>
    </properties>
@endsection
{{--</x-app-layout>--}}
