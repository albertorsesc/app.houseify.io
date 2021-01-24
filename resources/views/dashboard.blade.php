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
                                    <img src="/img/businesses.png"
                                         class="object-center"
                                         alt="Negocios en el ramo constructor"
                                         loading="lazy">
                                    <div class="px-4 py-1">
                                        <div class="font-bold text-gray-900 text-xl mb-1">
                                            Directorio de Negocios
                                        </div>
                                        <p class="text-gray-700 text-base pb-1">
                                            Anuncia y Encuentra Proveedores relacionados al ramo de Construccion!
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        {{--Ads--}}
                        <div class="w-full md:w-1/2 xl:w-1/3 px-3">
                            <a href="#">
                                <div class="card transition hover:transform text-center items-center">
                                    <img src="/img/ads.png" class="object-fill" alt="Anuncios Publicitarios" loading="lazy">
                                    <div class="px-4 py-1">
                                        <div class="font-bold text-gray-900 text-xl mb-1">
                                            Anuncios Publicitarios
                                        </div>
                                        <p class="text-gray-700 text-base pb-1">
                                            Anuncia y Encuentra ofertas de Servicios o Productos de Construccion!
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /End replace -->
            </div>
        </main>
    </div>

@endsection
