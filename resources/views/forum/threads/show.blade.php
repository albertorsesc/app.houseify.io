@extends('layouts.app')

@section('title', e($thread->title))

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
                        <a href="{{ route('web.forum.threads.index') }}" class="h-link text-emerald-500 font-light">
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
                                    <div class="w-full my-1">
                                        {{--Header--}}
                                        <div class="flex justify-between">
                                            <div class="flex w-full">
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
                                            <div>
                                                <a href="#" class="h-btn">Electricidad</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div v-if="! showThreadForm"
                                         class="w-full mt-6 mb-4 text-gray-700 font-medium text-xl bg-gray-50 p-4 rounded-lg shadow-sm border border-gray-100"
                                         v-text="localThread.title"
                                    ></div>
                                    <div v-if="showThreadForm" class="w-full mt-6 mb-4 text-gray-700 font-medium text-xl bg-gray-50 p-4 rounded-lg shadow-sm border border-gray-100">
                                        <textarea v-model="threadForm.title"
                                                  id="title"
                                                  rows="5"
                                                  class="h-input block w-full sm:text-sm"
                                                  placeholder="Nuevo titulo de la Consulta..."
                                                  v-text="threadForm.title"
                                        ></textarea>
                                    </div>
                                    <div v-if="isAuthenticated && localThread.author.id === auth"
                                         class="w-full flex justify-end">
                                        <span class="w-1/12 rounded-md shadow-sm mr-2">
                                            <button @click="showUpdateForm()"
                                                    type="button"
                                                    class="items-center px-4 shadow-sm w-full py-1 flex justify-center border border-gray-100 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 hover:text-gray-900 focus:outline-none focus:shadow-outline-emerald focus:border-emerald-300 active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out"
                                                    title="Actualizar Datos de la Propiedad...">
                                                <span class="text-gray-300">Editar</span>
                                            </button>
                                        </span>
                                        <span class="w-1/12 rounded-md shadow-sm">
                                            <button type="button"
                                                    class="items-center px-4 shadow-sm w-full py-1 flex justify-center border border-gray-100 text-sm leading-5 font-medium rounded-md text-red-700 bg-white hover:bg-red-500 hover:text-red-900 focus:outline-none focus:shadow-outline-red focus:border-red-300 active:text-red-800 transition duration-150 ease-in-out"
                                                    title="Eliminar Consulta...">
                                                <span class="text-gray-300">Eliminar</span>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-5 sm:p-6">
                                <div class="-mt-3 text-xs text-gray-500 text-light items-start">Descripcion de la consulta</div>

                                <div class="mt-4 text-gray-600 text-base leading-4">
                                    {{ $thread->body }}
                                </div>
                            </div>
                        </div>
                    </div>

                    @auth
                        {{--Form--}}
                        <div class="w-full my-6">
                            <div class="bg-white overflow-hidden shadow rounded-lg divide-y divide-gray-200">
                                <div class="px-4 py-2">
                                    <form @submit.prevent>
                                        <div class="w-full">
                                            <div class="mt-1">
                                            <textarea v-model="replyForm.body"
                                                      id="body"
                                                      rows="5"
                                                      class="h-input block w-full sm:text-sm"
                                                      placeholder="Contestar Pregunta..."
                                            ></textarea>
                                            </div>
                                            <errors :error="errors.body"
                                                    :options="{ noContainer: true }"
                                            ></errors>
                                        </div>
                                        <div class="w-full my-4">
                                            <button @click="reply"
                                                    :disabled="isLoading"
                                                    class="h-btn-success">
                                                Enviar Respuesta
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endauth
                    @guest
                        <p class="text-base text-teal-500">
                            Debes <a href="/login" class="h-link text-gray-600">Iniciar sesion</a> para participar en esta discusion.
                        </p>
                    @endguest

                    {{--Replies--}}
                    <div class="w-full">
                        <div v-for="reply in localThread.replies"
                             :key="reply.id"
                             class="my-4 bg-white overflow-hidden shadow rounded-lg divide-y divide-gray-200">
                            <div class="px-4 py-5 sm:px-6 flex">
                                <div class="flex w-full">
                                    <div class="flex-shrink-0 mr-3">
                                        <img class="h-10 w-10 rounded-lg" :src="reply.author.photo" :alt="reply.author.fullName" />
                                    </div>
                                    <div>
                                        <div>
                                            <span v-text="reply.author.fullName" class="text-base text-emerald-500 font-medium"></span>
                                        </div>
                                        <div class="-mt-1">
                                                <span class="text-xs text-gray-600 font-light">
                                                    Fue publicado <span v-text="reply.meta.createdAt"></span>
                                                </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-5 sm:p-6" v-text="reply.body"></div>
                        </div>
                    </div>
                </div>
            </main>

        </div>
    </thread-profile>
@endsection
