@extends('layouts.app')

@section('title', 'Inicio')

@section('content')

    <div>
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <div class="w-full md:flex md:justify-between items-center">
                    <h2 class="font-semibold text-2xl text-teal-400">
                        Bienvenid@s a Houseify.io
                    </h2>
                    <div class="hidden md:flex md:justify-between">
                    </div>

                    <div class="w-full md:hidden mt-2">
                    </div>
                </div>
            </div>
        </header>

        <div class="mt-4 top-0 inset-x-0">
            <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
                <div class="p-2 rounded-lg bg-white shadow-lg sm:p-3">
                    <div class="flex items-center justify-between flex-wrap">
                        <div class="w-0 flex-1 flex items-center">
          <span class="flex p-2 rounded-lg bg-white">
            <!-- Heroicon name: outline/speakerphone -->
            <svg class="h-6 w-6 text-emerald-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
            </svg>
          </span>
                            <p class="ml-3 font-medium text-emerald-400 truncate">
                                <a href="{{ route('web.roadmap.index') }}">
                                    <span class="md:hidden">
                                      Explora, Registra y Publica!
                                    </span>
                                </a>
                                <span class="hidden md:inline">
                                    Asegúrate de explorar las distintas secciones dedicadas a cada área de nuestra industria!
                                </span>
                            </p>
                        </div>
                        <div class="hidden md:inline order-3 mt-2 flex-shrink-0 w-full sm:order-2 sm:mt-0 sm:w-auto">
                            <a href="{{ route('web.roadmap.index') }}"
                               class="flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-gray-400 bg-white hover:bg-emerald-50">
                                Novedades
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <main>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="sm:px-4 sm:px-0">
                    <div class="sm:flex sm:flex-wrap lg:justify-between lg:justify-center">
                        {{--Properties--}}
                        <div class="w-full md:w-1/2 lg:w-1/2 xl:w-1/3 px-3 mt-4 xl:mt-6">
                            <a href="{{ route('web.properties.index') }}">
                                <div class="card transition hover:transform text-center items-center">
                                    <img src="/img/properties.png" class="object-cover" alt="Propiedades">
                                    <div class="px-4 xl:py-2">
                                        <div class="font-bold text-gray-900 text-xl mb-2">
                                            Propiedades
                                        </div>
                                        <p class="text-gray-700 text-base pb-4">
                                            ¡Explora las Propiedades disponibles!
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        {{--Businesses --}}
                        <div class="w-full md:w-1/2 lg:w-1/2 xl:w-1/3 mt-4 xl:mt-6 px-3 md:py-0 lg:py-2 xl:py-1 items-center">
                            <a href="{{ route('web.businesses.index') }}">
                                <div class="card h-transition hover:transform text-center items-center align-middle">
                                    <img src="/img/business_location.svg"
                                         class="block md:hidden ml-16 sm:ml-48 h-52 object-cover sm:object-contain"
                                         alt="Negocios en el ramo constructor"
                                         loading="lazy">
                                    <img src="/img/business_location.svg"
                                         class="hidden md:block lg:hidden sm:ml-16 md:px-2 md:py-0 md:h-60 md:ml-10 h-52 sm:object-contain"
                                         alt="Negocios en el ramo constructor"
                                         loading="lazy">
                                    <img src="/img/business_location.svg"
                                         class="hidden lg:block lg:h-60 lg:-mt-1 lg:p-2 lg:ml-16 xl:h-48 xl:ml-16 xl:p-2 items-center object-cover"
                                         alt="Negocios en el ramo constructor"
                                         loading="lazy">
                                    <div class="px-4 py-0 pb-2 md:py-0 md:-mt-3 lg:py-2 xl:py-2 xl:mt-2">
                                        <div class="font-bold text-gray-900 text-xl my-1">
                                            Directorio de Negocios
                                        </div>
                                        <p class="text-gray-700 text-base pb-1 xl:pb-3">
                                            ¡Proveedores de la Construcción!
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        {{--JobProfiles--}}
                        <div class="w-full md:w-1/2 lg:w-1/2 xl:w-1/3 mt-4 md:mt-6 px-3">
                            <a href="{{ route('web.job-profiles.index') }}">
                                <div class="card transition hover:transform text-center items-center">
                                    <img src="/img/hire.svg" class="object-cover p-8" alt="Anuncios Publicitarios" loading="lazy">
                                    <div class="px-4 py-1">
                                        <div class="font-bold text-gray-900 text-xl">
                                            Técnicos y Profesionales
                                        </div>
                                        <p class="text-gray-700 text-base pb-1">
                                            ¡Técnicos y Profesionales de Servicios de Construcción!
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        {{--Forum--}}
                        <div class="w-full md:w-1/2 lg:w-1/2 xl:w-1/3 mt-4 md:mt-6 px-3">
                            <a href="{{ route('web.threads.index') }}">
                                <div class="card transition hover:transform text-center items-center">
                                    <img src="/img/forum.png" class="object-cover px-4 py-2" alt="Foro de Construcción" loading="lazy">
                                    <div class="px-4 py-1">
                                        <div class="font-bold text-gray-900 text-xl">
                                            Foro de Construcción
                                        </div>
                                        <p class="text-gray-700 text-base pb-1">
                                            Publica tus consultas técnicas y entre todos encontraremos la respuesta.
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        {{--Job Posts--}}
                        <div class="w-full md:w-1/2 lg:w-1/2 xl:w-1/3 px-3 mt-4 md:mt-6">
                            <div class="bg-white border-4 border-dashed border-gray-200 rounded-lg text-center items-center">
                                <img src="/img/professionals.png" class="object-fill" alt="Bolsa de Trabajo">
                                <div class="px-4">
                                    <div class="font-bold text-gray-900 text-xl mb-1">
                                        Bolsa de Trabajo
                                    </div>
                                    <p class="text-gray-700 text-base pb-2">
                                        Anuncia Empleos o Profesionales de la Construcción (Próximamente)
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="hidden xl:block w-full md:w-1/2 lg:w-1/2 xl:w-1/3 px-3 mt-4 md:mt-6">
                            <div class="bg-white border-4 border-dashed border-gray-200 rounded-lg text-center items-center h-full"></div>
                        </div>
<!--                        <div class="hidden xl:block w-full md:w-1/2 lg:w-1/2 xl:w-1/3 px-3 mt-4 md:mt-6">
                            <div class="bg-white border-4 border-dashed border-gray-200 rounded-lg text-center items-center h-full"></div>
                        </div>-->
                    </div>
                </div>

            </div>
        </main>
    </div>

@endsection
