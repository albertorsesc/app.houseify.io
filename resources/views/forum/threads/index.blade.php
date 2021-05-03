@extends('layouts.app')

@section('title', 'Foro: Publica tus dudas sobre un area de la industria y entre todos encontraremos la respuesta')

@section('content')

    <threads inline-template>
        <div>
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div class="w-full md:flex md:justify-between items-center">
                        <h2 class="font-semibold text-2xl text-teal-400">
                            Foro
                        </h2>
                    </div>
                </div>
            </header>

            <main class="my-6">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div v-if="threadsTab === 'show-threads'" class="bg-white px-4 py-5 border-b border-gray-200 sm:px-6 flex justify-between">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Temas
                        </h3>
                        <button @click="threadsTab = 'create-thread'"
                                class="h-btn-success"
                        >Crear nueva Consulta</button>
                    </div>
                    <div v-if="threadsTab === 'show-threads'"
                         class="bg-white shadow overflow-hidden sm:rounded-md">

                        <ul class="divide-y divide-gray-200">
                            <li v-for="thread in threads" :key="thread.id">
                                <a :href="`/forum/temas/${thread.id}`"
                                   class="block hover:bg-gray-50">
                                    <div class="flex items-center px-4 py-4 sm:px-6">
                                        <div class="min-w-0 flex-1 flex items-center">
                                            <div class="flex-shrink-0">
                                                <img class="h-12 w-12 rounded-full" :src="thread.author.photo" :alt="thread.author.fullName" />
                                            </div>
                                            <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                                                <div>
                                                    <p class="text-sm font-medium text-indigo-600 truncate"
                                                       v-text="thread.author.fullName"
                                                    ></p>
                                                    <p class="mt-2 flex items-center text-sm text-gray-500">
                                                        <!-- Heroicon name: solid/mail -->
                                                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                                        </svg>
                                                        <span class="truncate" v-text="thread.author.email"></span>
                                                    </p>
                                                </div>
                                                <div class="hidden md:block">
                                                    <div>
                                                        <p class="text-sm text-gray-900">
                                                            Creado hace
                                                            <span v-text="thread.meta.createdAt"></span>
                                                        </p>
                                                        <p class="mt-2 flex items-center text-sm text-gray-500" v-text="limitString(thread.title, 70) + '..'">
<!--                                                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                            </svg>
                                                            Completed phone screening-->
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
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


                    <div v-if="threadsTab === 'create-thread'"
                         class="bg-white shadow overflow-hidden sm:rounded-md">
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
                                                Consulta tus dudas con otros tecnicos en tu rama laboral.
                                            </p>
                                        </div>

                                        <div class="mt-6 sm:mt-5 space-y-6 sm:space-y-5">
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
                                                    <p class="mt-2 text-sm text-gray-500">Describe tu pregunta lo mas elaborada posible para que otros tecnicos entiendan mejor tu situacion.</p>
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
                            <div class="my-3">
                                <button @click="threadsTab = 'show-threads'"
                                        class="h-btn"
                                >Regresar a Consultas</button>
                            </div>
                            <p class="px-10 py-6">
                                <a href="/login" class="h-link text-teal-500">Inicia Sesion</a> para participar en esta consulta
                            </p>
                        </div>
                    </div>
                </div>
            </main>

        </div>
    </threads>


@endsection
