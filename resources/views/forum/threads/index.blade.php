@extends('layouts.app')

@section('title', 'Foro: Publica o Aclara tus dudas técnicas sobre la industria constructora.')

@section('styles')
    <link rel="stylesheet" href="/css/vue-multiselect.min.css">
@endsection

@section('content')

    <threads inline-template>
        <div>
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div class="w-full md:flex md:justify-between items-center">
                        <h2 class="font-semibold text-2xl text-teal-400">
                            Foro
                        </h2>
                        <a v-show="threadsTab === 'create-thread'" href="{{ route('web.forum.threads.index') }}" class="h-link text-emerald-500 font-light">
                            Regresar a Temas
                        </a>
                    </div>
                </div>
            </header>

            <main class="my-6">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div v-if="threadsTab === 'show-threads'" class="bg-white px-4 py-5 border-b border-gray-200 sm:px-6 flex justify-between">
                        <h3 class="mr-4 text-lg leading-6 font-medium text-gray-900">
                            Temas
                        </h3>
                        <div class="flex items-center">
                            <div class="flex py-1">
                                <vue-multiselect v-model="selectedChannel"
                                                 value="Object"
                                                 :placeholder="''"
                                                 :options="getConstructionCategories"
                                                 :hide-selected="true"
                                                 id="channel"
                                                 :searchable="true"
                                                 :close-on-select="true"
                                                 select-label=""
                                                 selected-label=""
                                                 deselect-label=""
                                                 :tag-placeholder="''"
                                                 placeholder="Buscar por Categoria..."
                                                 @select="threadsByChannel">
                                    <span slot="noResult">Los sentimos, no se encontraron resultados.</span>
                                </vue-multiselect>
                            </div>
                            <button @click="threadsTab = 'create-thread'"
                                    class="h-btn-success ml-2"
                            >Crear nueva Consulta</button>
                        </div>
                    </div>
                    <div v-if="threadsTab === 'show-threads'"
                         class="overflow-hidden">

                        <ul class="divide-y divide-gray-200">
                            <li v-for="thread in threads" :key="thread.id" class="my-4">
                                <a :href="`/forum/temas/${thread.id}`"
                                   class="block hover:bg-gray-50 card transition hover:transform">
                                    <div class="flex items-center px-4 py-4 sm:px-6">
                                        <div class="min-w-0 flex-1 flex items-center align-middle">
                                            <div class="flex-shrink-0">
                                                <img class="h-16 w-16 rounded-lg" :src="thread.author.photo" :alt="thread.author.fullName" />
                                            </div>
                                            <div class="px-4 w-full md:w-2/3">
                                                <div class="hidden md:block">
                                                    <div class="w-full py-2">
                                                        <p class="flex items-start text-xl text-gray-500"
                                                           v-text="limitString(thread.title, 65) + '..'"
                                                        ></p>
                                                    </div>
                                                    <div class="w-full py-1">
                                                        <p class="flex items-start text-sm text-gray-500"
                                                           v-text="limitString(thread.body, 65) + '..'"
                                                        ></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="md:-mt-8 w-full md:w-1/3 flex justify-end mr-4">
                                                <span class="flex align-middle items-center text-xs">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-1 text-gray-600 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                                    </svg>
                                                    @{{ thread.repliesCount }}
                                                </span>
                                                <span class="uppercase ml-4 px-6 align-middle items-center text-xs text-blue-500 border border-blue-700 bg-white shadow-sm rounded-full p-2"
                                                      v-text="thread.channel"
                                                ></span>
                                            </div>
                                        </div>
                                        <div class="">
                                            <!-- Heroicon name: solid/chevron-right -->
                                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>

                    {{--Create Thread--}}
                    <div v-if="threadsTab === 'create-thread'"
                         class="bg-white shadow overflow-hidden sm:rounded-md">
                        {{--New Thread--}}
                        <div v-if="isAuthenticated" class="w-full px-10 py-6">
                            <form @submit.prevent
                                  class="space-y-8 divide-y divide-gray-200">
                                <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">
                                    <div>
                                        <div>
                                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                                Crea una nueva Consulta
                                            </h3>
                                            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                                Consulta tus dudas con otros técnicos en tu rama laboral.
                                            </p>
                                        </div>

                                        <div class="mt-6 sm:mt-5 space-y-6 sm:space-y-5">
                                            <div class="sm:grid sm:grid-cols-3 sm:gap-3 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                                <label for="channel" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                                    Categoría
                                                </label>
                                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                                    <vue-multiselect v-model="threadForm.channel"
                                                                     value="Object"
                                                                     :placeholder="''"
                                                                     :options="getConstructionCategories"
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
                                                               class="h-input w-full sm:text-sm">
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
                                                    <textarea id="body" v-model="threadForm.body" rows="6" class="h-input block w-full sm:text-sm"></textarea>
                                                    <errors :error="errors.body"
                                                            :options="{ noContainer: true }"
                                                    ></errors>
                                                    <p class="mt-2 text-sm text-gray-500">Describe tu pregunta lo mas elaborada posible para que otros técnicos entiendan mejor tu situacion.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="pt-5">
                                    <div class="flex justify-end">
                                        <button @click="threadsTab = 'show-threads'" type="button" class="h-btn">
                                            Cancelar
                                        </button>
                                        <button @click="store"
                                                type="submit"
                                                class="h-btn-success ml-4">
                                            Crear consulta
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div v-if="! isAuthenticated" class="text-center">
                            <div class="my-4">
                                <button @click="threadsTab = 'show-threads'"
                                        class="h-btn">
                                    Regresar a Consultas
                                </button>
                            </div>
                            <p class="px-10 py-6 text-base text-center text-gray-500">
                                Debes <a href="/login" class="h-link text-teal-600">Iniciar sesión</a> para publicar tu consulta.
                            </p>
                        </div>
                    </div>
                </div>
            </main>

        </div>
    </threads>


@endsection
