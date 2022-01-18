@extends('layouts.app')

@section('title', 'Sugerencias')

@section('content')

{{--    <suggestions inline-template>--}}
    <div>
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <div class="w-full md:flex md:justify-between items-center">
                    <h2 class="font-semibold text-2xl text-teal-400">
                        Buzón de Sugerencias
                    </h2>
                    <div class="hidden md:flex md:justify-between">
                    </div>

                    <div class="w-full md:hidden mt-2">
                    </div>
                </div>
            </div>
        </header>

        <main class="mt-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="px-4 py-6 sm:px-0">

                    <div class="relative">
                        <div class="absolute inset-0">
                            <div class="absolute inset-y-0 left-0 w-1/2 bg-gray-50"></div>
                        </div>
                        <div class="relative max-w-7xl mx-auto lg:grid lg:grid-cols-5">
                            <div class="bg-gray-50 lg:py-16 px-4 sm:px-6 lg:col-span-2 lg:px-8 lg:py-24 xl:pr-12">
                                <div class="max-w-lg mx-auto">
                                    <h2 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">
                                        Nos encantaría leer tus sugerencias
                                    </h2>
                                    <p class="mt-3 text-lg leading-6 text-gray-500 text-justify">
                                        El equipo de Houseify trabaja incansablemente para desarrollar nuevas funcionalidades y solucionar
                                        errores ocasionales que naturalmente se descubren, sin embargo tus sugerencias nos
                                        ayudarían muchísimo para añadir lo que es más importante para ti.
                                    </p>
                                    <dl class="mt-8 text-base text-gray-500">
                                        <div class="mt-3">
                                            <dt class="sr-only">Correo Electrónico</dt>
                                            <dd class="flex">
                                                <svg class="flex-shrink-0 h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                </svg>
                                                <span class="ml-3">
                                            soporte@houseify.io
                                          </span>
                                            </dd>
                                        </div>
                                    </dl>
                                </div>
                            </div>
                            <div class="bg-white rounded-lg align-middle shadow-lg py-6 px-4 sm:px-6 lg:col-span-3 lg:py-18 lg:px-8 xl:pl-12">
                                @if (session()->has('success'))
                                    <div class="">
                                        @include('general-components.alert', ['message' => session()->get('success')])
                                    </div>
                                @endif
                                <div class="max-w-lg mx-auto lg:max-w-none py-10">
                                    <form action="{{ route('suggestions.store') }}" method="POST" class="grid grid-cols-1 gap-y-8">
                                        @csrf
                                        <div>
                                            <label for="subject" class="sr-only">Asunto</label>
                                            <input type="text"
                                                   name="subject"
                                                   id="subject"
                                                   autocomplete="subject"
                                                   class="h-input block w-full shadow-sm py-3 px-4 placeholder-gray-500 focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md"
                                                   placeholder="Asunto">
                                        </div>
                                        <div>
                                            <label for="body" class="sr-only">Sugerencia</label>
                                            <textarea id="body"
                                                      name="body"
                                                      rows="8"
                                                      class="h-input block w-full shadow-sm py-3 px-4 placeholder-gray-500 focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md"
                                                      placeholder="Sugerencia"
                                            ></textarea>
                                        </div>
                                        <div>
                                            <button type="submit" class="md:-mt-2 inline-flex justify-center py-3 px-6 border border-gray-300 shadow text-base font-medium rounded-md text-emerald-500 bg-white hover:text-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                Enviar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /End replace -->
            </div>
        </main>
    </div>
{{--    </suggestions>--}}

@endsection
