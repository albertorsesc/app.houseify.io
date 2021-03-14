@extends('layouts.app')

@section('title', 'Directorio de Negocios')

@section('styles')
    <link rel="stylesheet" href="/css/vue-multiselect.min.css">
@endsection

@section('content')
    <businesses inline-template>
        <div>
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div class="w-full md:flex md:justify-between items-center">
                        <h2 class="font-semibold text-2xl text-teal-400">
                            @{{ headerTitle }}
                        </h2>
                        <div class="hidden md:flex md:justify-between">
                            <a @click="activeTab = 'explore-businesses'"
                               role="button"
                               href="#"
                               class="mx-2 text-base font-medium text-cyan-500 border-b-2 leading-5 transition duration-150 ease-in-out"
                               :class="[activeTab === 'explore-businesses' ? 'border-emerald-400 text-cyan-600' : 'hover:border-emerald-400 hover:text-cyan-600']">
                                Explorar Negocios
                            </a>
                            <a @click="activeTab = 'my-businesses'"
                               role="button"
                               href="#"
                               class="mx-2 text-base font-medium text-cyan-500 border-b-2 leading-5 transition duration-150 ease-in-out"
                               :class="[activeTab === 'my-businesses' ? 'border-emerald-400 text-cyan-600' : 'hover:border-emerald-400 hover:text-cyan-600']">
                                Mis Negocios
                            </a>
                            <a @click="activeTab = 'my-interests'"
                               role="button"
                               href="#"
                               class="mx-2 text-base font-medium text-cyan-500 border-b-2 leading-5 transition duration-150 ease-in-out"
                               :class="[activeTab === 'my-interests' ? 'border-emerald-400 text-cyan-600' : 'hover:border-emerald-400 hover:text-cyan-600']">
                                Mis Intereses
                            </a>
                            <a @click="activeTab = 'search-businesses'"
                               role="button"
                               href="#"
                               class="mx-2 text-base font-medium text-cyan-500 border-b-2 leading-5 transition duration-150 ease-in-out"
                               :class="[activeTab === 'search-businesses' ? 'border-emerald-400 text-cyan-600' : 'hover:border-emerald-400 hover:text-cyan-600']">
                                Busqueda de Negocios
                            </a>
                        </div>

                        {{--Mobile--}}
                        <div class="w-full md:hidden mt-2">
                            <div class="flex-1 w-full ">
                                <a @click="activeTab = 'explore-businesses'"
                                   role="button"
                                   href="#"
                                   class="text-base font-normal text-cyan-500 hover:border-emerald-400 border-b-2 hover:text-cyan-600 leading-5 transition duration-150 ease-in-out">
                                    Explorar Negocios
                                </a>
                            </div>
                            <div class="flex-1 md:hidden mt-2">
                                <a @click="activeTab = 'my-businesses'"
                                   role="button"
                                   href="#"
                                   class="text-base font-normal text-cyan-500 hover:border-emerald-400 border-b-2 hover:text-cyan-600 leading-5 transition duration-150 ease-in-out">
                                    Mis Negocios
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
                                <a @click="activeTab = 'search-businesses'"
                                   role="button"
                                   href="#"
                                   class="text-base font-normal text-cyan-500 hover:border-emerald-400 border-b-2 hover:text-cyan-600 leading-5 transition duration-150 ease-in-out">
                                    Busqueda de Negocios
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
                            <explore-businesses></explore-businesses>
                        </div>
                        <div v-show="activeTab === 'my-businesses'" class="text-3xl block">
                            <my-businesses></my-businesses>
                        </div>
                        <div v-show="activeTab === 'my-interests'" class="text-3xl block">
                            <interesting-businesses></interesting-businesses>
                        </div>
                        <div v-show="activeTab === 'search-businesses'"
                             class="text-3xl block">
                            <search-businesses></search-businesses>
                        </div>
                    </div>
                    <!-- /End replace -->
                </div>
            </main>
        </div>
    </businesses>
@endsection
