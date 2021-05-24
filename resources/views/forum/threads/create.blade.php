@extends('layouts.app')

@section('title', 'Foro: Publica tus consulta técnica sobre la industria constructora.')

@section('content')

    <div>
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <div class="w-full md:flex md:justify-between items-center">
                    <h2 class="font-semibold text-2xl text-teal-400">
                        Crear una Consulta
                    </h2>
                    <a href="{{ route('web.threads.index') }}" class="h-link text-emerald-500 font-light">
                        Regresar a Temas
                    </a>
                </div>
            </div>
        </header>

        <main class="my-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                {{--Create Thread--}}
                <div class="bg-white shadow overflow-hidden sm:rounded-md">
                    @auth
                        <div class="w-full px-10 py-6">
                            <form action="{{ route('web.threads.store') }}" method="POST" class="space-y-3">
                                @csrf
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
                                                    <select name="channel" id="channel" class="h-select">
                                                        <option value="">Selecciona una Categoria</option>
                                                        @foreach(config('houseify.construction_categories') as $channel)
                                                            <option value="{{ $channel }}">{{ $channel }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('channel')
                                                    <div class="flex justify-start items-center rounded-md text-sm text-red-700 p-2" role="alert">
                                                        <p>{{ $message }}</p>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="sm:grid sm:grid-cols-3 sm:gap-3 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                                <label for="title" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                                    Asunto
                                                </label>
                                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                                    <div class="flex rounded-md shadow-sm">
                                                        <input type="text"
                                                               name="title"
                                                               id="title"
                                                               autocomplete="title"
                                                               class="h-input w-full sm:text-sm"
                                                               value="{{ old('title') }}">
                                                    </div>
                                                    @error('title')
                                                    <div class="flex justify-start items-center rounded-md text-sm text-red-700 p-2" role="alert">
                                                        <p>{{ $message }}</p>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                                <label for="about" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                                    Cuerpo de la Consulta
                                                </label>
                                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                                    <textarea name="body"
                                                              id="body"
                                                              rows="6"
                                                              class="h-input block w-full sm:text-sm"
                                                    >{{ old('body') }}</textarea>
                                                    @error('body')
                                                    <div class="flex justify-start items-center rounded-md text-sm text-red-700 p-2" role="alert">
                                                        <p>{{ $message }}</p>
                                                    </div>
                                                    @enderror
                                                    <p class="mt-2 text-sm text-gray-500">Describe tu pregunta lo mas elaborada posible para que otros técnicos entiendan mejor tu situacion.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="pt-5">
                                    <div class="flex justify-end">
                                        <a href="{{ route('web.threads.index') }}" class="h-btn">
                                            Cancelar
                                        </a>
                                        <button type="submit"
                                                class="h-btn-success ml-4">
                                            Crear consulta
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endauth
                    @guest
                        <div class="text-center">
                            <div class="my-4">
                                <a href="{{ route('web.threads.index') }}" class="h-btn">
                                    Regresar a Consultas
                                </a>
                            </div>
                            <p class="px-10 py-6 text-base text-center text-gray-500">
                                Debes <a href="{{ route('login') }}" class="h-link text-teal-600">Iniciar sesión</a> para publicar tu consulta.
                            </p>
                        </div>
                    @endguest
                </div>
            </div>
        </main>

    </div>

@endsection
