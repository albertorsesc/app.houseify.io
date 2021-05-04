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
                                    <div class="w-full mt-6 mb-4 text-gray-700 font-medium text-xl bg-gray-50 p-4 rounded-lg shadow-sm border border-gray-100">
                                        {{ $thread->title }}
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
                                            {{--                                    <p class="mt-2 text-sm text-gray-500">Write a few sentences about yourself.</p>--}}
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
                            </div>
                            <div class="px-4 py-5 sm:p-6" v-text="reply.body"></div>
                        </div>
                    </div>
                </div>
            </main>

        </div>
    </thread-profile>
@endsection
