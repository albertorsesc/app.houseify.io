@extends('layouts.app')

@section('title', e($thread->title) . ' | Forum')

@section('meta')
    <meta name="description" content="{{ $thread->body }}">
@endsection

@section('styles')
    <link rel="stylesheet" href="/css/vue-multiselect.min.css">
@endsection

@section('content')
    <thread-profile :thread="{{ json_encode($thread) }}"
                    inline-template>
        <div>
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div class="w-full md:flex md:justify-between items-center">
                        <h2 class="font-semibold text-2xl text-teal-400">
                            Foro
                        </h2>
                        <a href="{{ route('web.threads.index') }}" class="h-link text-emerald-500 font-light">
                            Regresar a Temas
                        </a>
                    </div>
                </div>
            </header>

            <main class="my-6">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    {{--Thread--}}
                    <div class="w-full mb-4">
                        <div class="bg-white overflow-hidden shadow rounded-lg divide-y divide-gray-200">
                            <div class="px-4 py-5 sm:px-6 flex items-center align-middle">
                                <div class="w-full">
                                    {{--Thread Header--}}
                                    <div class="w-full my-1">
                                        <div class="md:flex md:justify-between">
                                            <div class="flex w-full md:w-2/3">
                                                <div class="flex-shrink-0 mr-3">
                                                    <img class="h-10 w-10 rounded-lg" :src="thread.author.photo" :alt="thread.author.fullName" />
                                                </div>
                                                <div>
                                                    <div>
                                                        <span v-text="thread.author.fullName" class="text-base text-emerald-500 font-medium"></span>
                                                    </div>
                                                    <div class="-mt-1">
                                                <span class="text-xs text-gray-600 font-light">
                                                    Fue publicado <span v-text="thread.meta.createdAt"></span>
                                                </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="-mt-0 md:-mt-2 flex items-center align-middle">
                                                <span v-if="thread.bestReply" class="mr-4 flex bg-white rounded-lg px-3 py-1 text-xs text-blue-400 border-2 border-blue-300 text-blue-400 uppercase items-center align-middle">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-1 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg> Resuelto
                                                </span>
                                                <a :href="`/forum/${localThread.channel.slug}`">
                                                    <span class="bg-white rounded-lg px-3 py-1 text-xs text-teal-400 border border-gray-300 uppercase"
                                                          v-text="localThread.channel.name"
                                                    ></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div v-if="! showThreadForm"
                                         class="w-full mt-6 mb-4 text-gray-700 font-medium text-xl bg-gray-50 p-4 rounded-lg shadow-sm border border-gray-100"
                                         v-text="localThread.title"
                                    ></div>
                                    {{--Thread Form--}}
                                    <div v-if="showThreadForm && isAuthenticated && localThread.author.id === auth"
                                         class="w-full mt-6 mb-4 text-gray-700 font-medium text-xl p-4 rounded-lg shadow-sm border border-gray-100">
                                        <div class="w-full px-10 py-6">
                                            <form @submit.prevent
                                                  class="space-y-8 divide-y divide-gray-200">
                                                <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">
                                                    <div class="mt-6 sm:mt-5 space-y-6 sm:space-y-5">
                                                        <div class="sm:grid sm:grid-cols-3 sm:gap-3 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                                            <label for="channel" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                                                Categoría
                                                            </label>
                                                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                                                <vue-multiselect v-model="threadForm.channel"
                                                                                 value="Array"
                                                                                 label="name"
                                                                                 :placeholder="''"
                                                                                 :options="channels"
                                                                                 :hide-selected="true"
                                                                                 id="channel"
                                                                                 :searchable="true"
                                                                                 :close-on-select="true"
                                                                                 select-label=""
                                                                                 selected-label=""
                                                                                 deselect-label=""
                                                                                 :tag-placeholder="''"
                                                                                 placeholder="Selecciona la Categoría de la Consulta...">
                                                                    <span slot="noResult">Los sentimos, no se encontraron resultados.</span>
                                                                </vue-multiselect>
                                                                <errors :error="errors.channel"
                                                                        :options="{ noContainer: true }"
                                                                ></errors>
                                                            </div>
                                                        </div>

                                                        <div class="sm:grid sm:grid-cols-3 sm:gap-3 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                                            <label for="username" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                                                Asunto
                                                            </label>
                                                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                                                <div class="flex rounded-md shadow-sm">
                                                                    <input type="text"
                                                                           v-model="threadForm.title"
                                                                           id="title"
                                                                           autocomplete="title"
                                                                           class="h-input w-full sm:text-sm"
                                                                           v-text="threadForm.title">
                                                                </div>
                                                                <errors :error="errors.title"
                                                                        :options="{ noContainer: true }"
                                                                ></errors>
                                                            </div>
                                                        </div>

                                                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                                            <label for="about" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                                                Cuerpo de la Consulta
                                                            </label>
                                                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                                                <textarea id="body"
                                                                          v-model="threadForm.body"
                                                                          rows="6"
                                                                          class="h-input block w-full sm:text-sm"
                                                                          v-text="threadForm.body"
                                                                ></textarea>
                                                                <errors :error="errors.body"
                                                                        :options="{ noContainer: true }"
                                                                ></errors>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div v-if="isAuthenticated && localThread.author.id === auth"
                                         class="w-full">
                                        <span class="w-full flex justify-end mr-2">
                                            <button v-if="showThreadForm"
                                                    @click="cancelUpdate"
                                                    type="button"
                                                    class="mr-2 items-center px-4 shadow-sm w-1/12 py-1 flex justify-center border border-gray-100 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 hover:text-gray-900 focus:outline-none focus:shadow-outline-emerald focus:border-emerald-300 active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                                                <span class="text-gray-400">Cancelar</span>
                                            </button>
                                            <button @click="showUpdateForm()"
                                                    type="button"
                                                    class="mr-2 items-center px-4 shadow-sm w-1/12 py-1 flex justify-center border border-gray-100 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 hover:text-gray-900 focus:outline-none focus:shadow-outline-emerald focus:border-emerald-300 active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out"
                                                    title="Actualizar Datos de la Propiedad...">
{{--                                                <span class="text-gray-400" v-if="! showThreadForm">Editar</span>--}}
                                                <span class="text-gray-400">Actualizar</span>
                                            </button>
<!--                                            <span class="w-1/12 rounded-md shadow-sm">
                                                <button @click="onDelete"
                                                        type="button"
                                                        class="items-center px-4 shadow-sm py-1 flex justify-center border border-gray-100 text-sm leading-5 font-medium rounded-md text-red-700 bg-white hover:text-red-900 focus:outline-none focus:shadow-outline-red focus:border-red-300 transition duration-150 ease-in-out"
                                                        title="Eliminar Consulta...">
                                                        Eliminar
                                                </button>
                                            </span>-->
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-5 sm:p-6">
                                <div class="-mt-3 text-xs text-gray-500 text-light items-start">Descripcion de la consulta</div>

                                <div class="mt-4 text-gray-600 text-base leading-4"
                                     v-text="localThread.body"
                                ></div>
                            </div>
                        </div>
                    </div>

                    @guest
                        <p class="text-base text-center text-gray-500">
                            Debes <a href="/login" class="h-link text-teal-600">Iniciar sesión</a> para participar en esta discusión.
                        </p>
                    @endguest

                    {{--Replies--}}
                    <div class="w-full">
                        <replies :thread="localThread"></replies>
                    </div>
                </div>
            </main>

        </div>
    </thread-profile>
@endsection
