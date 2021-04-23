@extends('layouts.app')

@section('title', e($property->title))

@section('content')
    <display-property :property="{{ json_encode($property) }}" inline-template>
        <div>
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div class="w-full flex justify-between">
                        <h2 class="font-semibold text-2xl text-teal-400" v-text="localProperty.title"></h2>
                    </div>
                </div>
            </header>

            <main class="">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="py-6 sm:px-0">
                        <div>
                            <div class="w-full mb-2 md:flex">
                                <!--Carrousel-->
                                <div class="w-full md:w-2/3 md:mr-4 mb-2 my-4">
                                    <div class="card transition hover:transform">
                                        <div class="card-body">
                                            <custom-carousel
                                                :images="localProperty.images"
                                                :module-name="'properties'"
                                                :size="'medium'"
                                            ></custom-carousel>
                                        </div>
                                    </div>

                                </div>

                                <div class="w-full md:w-1/3 mt-4">

                                    <div class="hidden md:block md:flex md:justify-between mb-2">
                                        {{--Specs List--}}
                                        <div class="w-full bg-white shadow-sm overflow-hidden sm:rounded-md h-auto">
                                            <ul>
                                                <li class="mt-3">
                                                    <div class="block hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition duration-150 ease-in-out">
                                                        <div class="px-4 py-3 sm:px-6">
                                                            <div class="flex items-center justify-between">
                                                                <div class="text-base leading-5 font-medium text-gray-600 truncate">
                                                                    Precio
                                                                </div>
                                                                <div class="ml-2 flex-shrink-0 flex">
                                                                    <span class="px-2 inline-flex text-base leading-5 font-semibold rounded-full text-gray-500"
                                                                          v-text="localProperty.formattedPrice"
                                                                    ></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="mt-3">
                                                    <div class="block hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition duration-150 ease-in-out">
                                                        <div class="px-4 py-3 sm:px-6">
                                                            <div class="flex items-center justify-between">
                                                                <div class="text-base leading-5 font-medium text-gray-600 truncate">
                                                                    Tipo de Negocio
                                                                </div>
                                                                <div class="ml-2 flex-shrink-0 flex">
                                                          <span class="px-2 inline-flex text-base leading-5 font-semibold rounded-full text-gray-500"
                                                                v-text="localProperty.businessType"
                                                          ></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="mt-3">
                                                    <div class="block hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition duration-150 ease-in-out">
                                                        <div class="px-4 py-3 sm:px-6">
                                                            <div class="flex items-center justify-between">
                                                                <div class="text-base leading-5 font-medium text-gray-600 truncate">
                                                                    Tipo
                                                                </div>
                                                                <div class="ml-2 flex-shrink-0 flex">
                                                                <span class="px-2 inline-flex text-base leading-5 font-semibold rounded-full text-gray-500"
                                                                      v-text="localProperty.propertyCategory.propertyType.display_name"
                                                                ></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="mt-3">
                                                    <div class="block hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition duration-150 ease-in-out">
                                                        <div class="px-4 py-3 sm:px-6">
                                                            <div class="flex items-center justify-between">
                                                                <div class="text-base leading-5 font-medium text-gray-600 truncate">
                                                                    Categoría
                                                                </div>
                                                                <div class="ml-2 flex-shrink-0 flex">
                                                              <span class="px-2 inline-flex text-base leading-5 font-semibold rounded-full text-gray-500"
                                                                    v-text="localProperty.propertyCategory.displayName"
                                                              ></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="mt-3">
                                                    <div class="block hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition duration-150 ease-in-out">
                                                        <div class="px-4 py-4 sm:px-6">
                                                            <div class="flex items-center justify-between">
                                                                <div class="text-base leading-5 font-medium text-gray-600 truncate">
                                                                    Actualizado
                                                                </div>
                                                                <div class="ml-2 flex-shrink-0 flex">
                                                              <span class="px-2 inline-flex text-base leading-5 font-semibold rounded-full text-gray-500"
                                                                    v-text="localProperty.meta.updatedAt"
                                                              ></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <divider title="Ubicación"></divider>

                            <property-location></property-location>

                            <divider title="Características"></divider>

                            <property-features></property-features>

                            <divider title="Mapa de Ubicación"></divider>

                            {{--Mapa--}}
                            <div class="mt-2 flex">
                                <div class="w-full">
                                    <div class="border-gray-300 h-auto"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- /End replace -->
                </div>
            </main>

        </div>
    </display-property>
@endsection
