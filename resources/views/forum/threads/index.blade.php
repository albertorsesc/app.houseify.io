@extends('layouts.app')

@section('title', 'Foro: Publica o Aclara tus dudas técnicas sobre la industria constructora.')

@section('meta')
    <meta name="title" content="Foro: Publica o Aclara tus dudas técnicas sobre la industria constructora.">
    <meta name="description" content="Crea consultas relacionadas a tu ramo laboral y participa en la primera comunidad dedicada exclusivamente al sector de Construcción en México ">
    <meta name="keywords" content="foro,consultas,dudas,houseify,houseify.io,construcción,propiedades,negocios,empresas,ferreterías,electricistas,ingeniería civil,arquitecto,albañil,soldador">
@endsection

@section('content')

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
                <div class="bg-white px-4 py-5 border-b border-gray-200 sm:px-6 flex justify-between">
                    <h3 class="mr-4 text-lg leading-6 font-medium text-gray-900">
                        Temas
                    </h3>
                    <div class="flex items-center">
                        <a href="{{ route('web.threads.create') }}"
                           class="h-btn-success ml-2">
                            Crear nueva Consulta
                        </a>
                    </div>
                </div>
                {{--Search--}}
                <div class="mx-4 md:mx-0 md:flex md:justify-end items-center align-middle py-4">
                    <div class="w-full md:w-1/3 md:mr-4 mt-2">
                        <select name="channel"
                                id="channel"
                                class="h-select" onchange="window.location.href = `/forum/${event.target.value}`">
                            <option value="">Filtra por Categoria</option>
                            <option value="">Todo</option>
                            @foreach(\App\Models\Forum\Threads\ThreadChannel::orderBy('name')->get() as $channel)
                                <option value="{{ $channel->slug }}">
                                    {{ $channel->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <form action="{{ route('web.threads.channels.index') }}"
                          method="GET"
                          class="inline-flex md:flex md:justify-end w-full"
                          id="search-form">
                        <div class="w-full md:w-1/2 md:mr-3 mt-2">
                            <div class="md:flex">
                                <input type="text" name="busqueda" class="w-full rounded-r-none h-input" placeholder="Buscar por Consulta o Descripción...">
                                <button class="hidden md:block p-2 bg-white border-l-0 border border-gray-300 text-sm rounded-l-none rounded-lg shadow">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-400 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="flex justify-end mt-4 items-center align-middle">
                        <button form="search-form" class="mr-3 block md:hidden p-2 bg-white border border-gray-300 text-sm rounded-lg shadow">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-400 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                        <a href="{{ route('web.threads.index') }}" class="items-center align-middle md:-mt-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mt-4 -mb-1 md:mt-2 rounded-full shadow-md hover:shadow-inner border p-1 cursor-pointer border-gray-300 mx-auto md:mx-0 text-gray-300 h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                        </a>
                    </div>
                </div>

                {{--Threads--}}
                <div class="overflow-hidden">
                    <ul class="md:divide-y md:divide-gray-200">
                        @foreach($threads as $thread)
                            <li class="my-4">
                                <a href="{{ $thread->profile() }}"
                                   class="mx-4 md:mx-0 block hover:bg-gray-50 card transition hover:transform">
                                    <div class="flex items-center px-4 py-4 sm:px-6">
                                        <div class="min-w-0 flex-1 flex items-center align-middle">
                                            <div class="flex-shrink-0">
                                                <img class="h-10 w-10 md:h-16 md:w-16 rounded-lg"
                                                     src="{{ $thread->author->defaultProfilePhotoUrl() }}"
                                                     alt="{{ $thread->author->fullName() }}" />
                                            </div>
                                            <div class="px-4 w-full md:w-2/3">
                                                <div class="block">
                                                    <div class="w-full py-2">
                                                        <p class="flex items-start text-sm md:text-xl text-gray-500">
                                                            {{ \Illuminate\Support\Str::limit($thread->title, 65) }}
                                                        </p>
                                                    </div>
                                                    <div class="hidden md:block w-full py-1">
                                                        <p class="flex items-start text-sm text-gray-500">
                                                            {{ \Illuminate\Support\Str::limit($thread->body, 65) }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="hidden md:-mt-8 w-full md:w-1/3 md:flex justify-end align-middle items-center mr-4">
                                                @if($thread->best_reply_id)
                                                    <span class="mr-4 text-xs uppercase flex justify-end align-middle items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-1 text-green-400 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg> Resuelto
                                                    </span>
                                                @endif
                                                <span class="flex align-middle items-center text-xs">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-1 text-gray-600 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                                    </svg>
                                                    {{ $thread->replies_count }}
                                                </span>
                                                <span class="uppercase mx-4 px-6 align-middle items-center text-xs text-blue-500 border border-blue-700 bg-white shadow-sm rounded-full p-2">
                                                    {{ $thread->channel->name }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex">
                                            @if($thread->bestReply)
                                            <svg xmlns="http://www.w3.org/2000/svg" class="block md:hidden mr-1 text-green-400 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            @endif
                                            <!-- Heroicon name: solid/chevron-right -->
                                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </main>

    </div>

@endsection
