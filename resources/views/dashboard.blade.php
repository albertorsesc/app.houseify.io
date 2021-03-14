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
                <!-- Replace with your content -->
                <div class="px-4 py-6 sm:px-0">
                    <div class="md:flex md:justify-between md:justify-center">
                        {{--Properties--}}
                        <div class="w-full md:w-1/2 xl:w-1/3 px-3">
                            <a href="{{ route('web.properties.index') }}">
                                <div class="card transition hover:transform text-center items-center">
                                    <img src="/img/properties.png" class="object-cover" alt="Propiedades">
                                    <div class="px-4 py-2">
                                        <div class="font-bold text-gray-900 text-xl mb-2">
                                            Propiedades
                                        </div>
                                        <p class="text-gray-700 text-base pb-4">
                                            Explora las Propiedades disponibles!
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        {{--Businesses--}}
                        <div class="w-full md:w-1/2 xl:w-1/3 px-3">
                            <a href="{{ route('web.businesses.index') }}">
                                <div class="card transition hover:transform text-center items-center">
                                    <img src="/img/business_location.svg"
                                         class="h-52 ml-16 pt-1 py-0 items-center"
                                         alt="Negocios en el ramo constructor"
                                         loading="lazy">
                                    <div class="px-4 py-1">
                                        <div class="font-bold text-gray-900 text-xl my  -1">
                                            Directorio de Negocios
                                        </div>
                                        <p class="text-gray-700 text-base pb-1">
                                            Proveedores relacionados al ramo de Construccion!
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        {{--Ads--}}
                        <div class="w-full md:w-1/2 xl:w-1/3 px-3">
                            <a href="{{ route('web.job-positions.index') }}">
                                <div class="card transition hover:transform text-center items-center">
                                    <img src="/img/hire.svg" class="object-cover p-8" alt="Anuncios Publicitarios" loading="lazy">
                                    <div class="px-4 py-1">
                                        <div class="font-bold text-gray-900 text-xl">
                                            Tecnicos y Profesionales
                                        </div>
                                        <p class="text-gray-700 text-base pb-1">
                                            Tecnicos y Profesionales de Servicios de Construccion!
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /End replace -->
                <div class="w-full md:w-1/2 xl:w-1/3 px-3 mt-4 md:mt-0">
               <div class="bg-white border-4 border-dashed border-gray-200 rounded-lg text-center items-center">
                   <img src="/img/professionals.png" class="object-fill" alt="Bolsa de Trabajo">
                   <div class="px-4">
                       <div class="font-bold text-gray-900 text-xl mb-1">
                           Bolsa de Trabajo
                       </div>
                       <p class="text-gray-700 text-base pb-2">
                           Anunciate o Encuentra profesionales de la Construccion (Proximamente)
                       </p>
                   </div>
               </div>
           </div>
            </div>
        </main>
    </div>

@endsection
