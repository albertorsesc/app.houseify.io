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
                    {{--Features--}}
                    <div class="bg-white rounded-lg shadow">
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
                                                90%
                                            </span>
                                        </p>
                                    </dt>
                                    <dd class="mt-2 ml-9 text-base text-gray-400">
                                        Foro en donde Técnicos y Profesionistas puedan realizar consultas técnicas y entre todos podamos resolverlas.
                                        <p class="text-xs mt-2">
                                            Fecha estimada de lanzamiento: <br>
                                            <span class="text-gray-600 font-light">{{ \Carbon\Carbon::createFromDate('2021-05-19')->addDays(10)->diffForHumans() }}</span>
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
                                            <span class="text-gray-600 font-light">{{ \Carbon\Carbon::createFromDate('2021-05-19')->addDays(25)->diffForHumans() }}</span>
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
                                        Publica y Explora Propiedades en México.
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    {{--Minor Changes--}}
                    <div class="relative my-6">
                        <div class="absolute inset-0 flex items-center" aria-hidden="true">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center">
                            <span class="px-2 bg-white text-sm text-gray-500">
                                Actualizaciones menores
                            </span>
                        </div>
                    </div>
                    <div class="my-8 bg-white rounded-lg shadow p-4">

                        <div class="flex flex-col">
                            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Actualizacion
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Descripcion
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Fecha
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">

                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-700">
                                                    <span class="mr-2 bg-green-100 text-xs text-green-500 border border-green-400 rounded-full px-3 py-1">
                                                        Nuevo
                                                    </span>
                                                    Inicio de Sesión con Facebook
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    Inicio de sesión seguro a través de Facebook.
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    21 Mayo 2021
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-700">
                                                    <span class="mr-2 bg-green-100 text-xs text-green-500 border border-green-400 rounded-full px-3 py-1">
                                                        Nuevo
                                                    </span>
                                                    <span class="text-gray-700 font-medium text-sm">Sección</span> : Novedades
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    Sección que en lista nuevas características y actualizaciones.
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    17 Mayo 2021
                                                </td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>

@endsection
