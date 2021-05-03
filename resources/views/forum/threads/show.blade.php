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
                    </div>
                </div>
            </header>

            <main class="my-6">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    {{--Thread--}}
                    <div class="w-full mb-4">
                        <div class="bg-white overflow-hidden shadow rounded-lg divide-y divide-gray-200">
                            <div class="px-4 py-5 sm:px-6">
                                {{ $thread->title }} -
                                <a href="#" class="h-link text-emerald-500">
                                    {{ $thread->author->fullName() }}
                                </a>
                            </div>
                            <div class="px-4 py-5 sm:p-6">
                                {{ $thread->body }}
                            </div>
                        </div>
                    </div>

                    {{--Replies--}}
                    <div class="w-full">
                        <div v-for="reply in localThread.replies"
                             :key="reply.id"
                             class="my-4 bg-white overflow-hidden shadow rounded-lg divide-y divide-gray-200">
                            <div class="px-4 py-5 sm:px-6 flex">
                                <a href="#" class="mr-3 h-link text-emerald-500">
                                    @{{ reply.author.fullName }}</a> contesto hace
                                @{{ reply.meta.createdAt }}...
                            </div>
                            <div class="px-4 py-5 sm:p-6" v-text="reply.body"></div>
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
                </div>
            </main>

        </div>
    </thread-profile>
@endsection
