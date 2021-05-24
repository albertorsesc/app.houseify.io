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

        <main>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="sm:px-4 py-6 sm:px-0">
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

                        {{--Businesses--}}
                        <div class="w-full md:w-1/2 lg:w-1/2 xl:w-1/3 mt-4 xl:mt-6 px-3 md:py-0 lg:py-2 xl:py-1 items-center">
                            <a href="{{ route('web.businesses.index') }}">
                                <div class="card h-transition hover:transform text-center items-center align-middle">
                                    <img src="/img/business_location.svg"
                                         class="block md:hidden ml-16 sm:ml-48 h-52 object-cover sm:object-contain"
                                         alt="Negocios en el ramo constructor"
                                         loading="lazy">
                                    <img src="/img/business_location.svg"
                                         class="hidden md:block lg:hidden sm:ml-16 md:px-2 md:py-0 md:h-48 md:ml-10 h-52 sm:object-contain"
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
