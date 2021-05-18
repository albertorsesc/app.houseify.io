@extends('layouts.app')

@section('title', 'Novedades')

@section('content')

    <div>
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <div class="w-full md:flex md:justify-between items-center">
                    <h2 class="font-semibold text-2xl text-teal-400">
                        Novedades
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
                    <div class="bg-white">
                        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:py-24 lg:px-8">
                            <div class="max-w-3xl mx-auto text-center">
                                <h2 class="text-3xl font-extrabold text-gray-900">Secciones y funcionalidades en desarrollo</h2>
                                <p class="mt-4 text-lg text-gray-500">
                                    Los siguientes puntos representan la ruta de actualizaciones para Houseify.io, en donde se trabaja en añadir: funcionalidades,
                                    secciones, optimización/mejoras y sugerencias de nuestros usuarios.
                                </p>
                            </div>
                            <dl class="mt-12 space-y-10 sm:space-y-0 sm:grid sm:grid-cols-2 sm:gap-x-6 sm:gap-y-12 lg:grid-cols-4 lg:gap-x-8">

                                <div class="relative">
                                    <dt>
                                        <!-- Heroicon name: outline/check -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                        </svg>
                                        <p class="ml-9 text-lg leading-6 font-medium text-gray-400">
                                            Foro de Consultas
                                            <span class="bg-gray-50 rounded-full border border-gray-200 text-gray-400 text-sm p-2">
                                                75%
                                            </span>
                                        </p>
                                    </dt>
                                    <dd class="mt-2 ml-9 text-base text-gray-400">
                                        Foro en donde Técnicos y Profesionistas puedan realizar consultas técnicas y entre todos podamos resolverlas.
                                        <p class="text-xs mt-2">
                                            Fecha estimada de lanzamiento: <br>
                                            <span class="text-gray-600 font-light">{{ \Carbon\Carbon::make(now())->addDays(20)->diffForHumans() }}</span>
                                        </p>
                                    </dd>
                                </div>

                                <div class="relative">
                                    <dt>
                                        <!-- Heroicon name: outline/check -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                        </svg>
                                        <p class="ml-9 text-lg leading-6 font-medium text-gray-400">
                                            Bolsa de Trabajo
                                        </p>
                                    </dt>
                                    <dd class="mt-2 ml-9 text-base text-gray-400">
                                        Espacio para la publicación de Ofertas de Trabajo, Oportunidades de Comercio y Relaciones Laborales.
                                        <p class="text-xs mt-2">
                                            Fecha estimada de lanzamiento: <br>
                                            <span class="text-gray-600 font-light">{{ \Carbon\Carbon::make(now())->addDays(25)->diffForHumans() }}</span>
                                        </p>
                                    </dd>
                                </div>

                                <div class="relative">
                                    <dt>
                                        <!-- Heroicon name: outline/check -->
                                        <svg class="absolute h-6 w-6 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <p class="ml-9 text-lg leading-6 font-medium text-gray-900">Técnicos y Profesionistas</p>
                                    </dt>
                                    <dd class="mt-2 ml-9 text-base text-gray-500">
                                        Espacio para que Técnicos y Profesionistas puedan crear su perfil de Trabajo con el fin de
                                        ofrecer sus servicios y permitir a sus clientes encontrarlos en un solo lugar.
                                    </dd>
                                </div>

                                <div class="relative">
                                    <dt>
                                        <!-- Heroicon name: outline/check -->
                                        <svg class="absolute h-6 w-6 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <p class="ml-9 text-lg leading-6 font-medium text-gray-900">Directorio de Negocios y Empresas</p>
                                    </dt>
                                    <dd class="mt-2 ml-9 text-base text-gray-500">
                                        Registrar y Encontrar Negocios o Empresas relacionadas con la industria Constructora en México.
                                    </dd>
                                </div>

                                <div class="relative">
                                    <dt>
                                        <!-- Heroicon name: outline/check -->
                                        <svg class="absolute h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <p class="ml-9 text-lg leading-6 font-medium text-gray-900">Propiedades</p>
                                    </dt>
                                    <dd class="mt-2 ml-9 text-base text-gray-500">
                                        Habilidad del Usuario de Publicar y Explorar propiedades en México.
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

@endsection
