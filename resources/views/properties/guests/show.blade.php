@extends('layouts.app')

@section('title', e($property->title))

@section('meta')
    <meta property="og:url" content="{{ $property->publicProfile() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ $property->title }}" />
    <meta name="description" content="Propiedad en {{ $property->location ? $property->location->city . ' - ' . $property->location->state->code : null }}" />
    <meta property="og:image" content="{{ $property->media ? optional($property->media->first())->getFullUrl() : '' }}" />
@endsection

@section('styles')
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
@endsection

@section('scripts')
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.gmaps_api') }}&region=MX&libraries=places&v=weekly"
        async
    ></script>
@endsection

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
                                                <li v-if="localProperty.phone"
                                                    class="mt-3">
                                                    <div class="block hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition duration-150 ease-in-out">
                                                        <div class="px-4 py-3 sm:px-6">
                                                            <div class="flex items-center justify-between">
                                                                <div class="text-base leading-5 font-medium text-gray-600 truncate">
                                                                    Teléfono
                                                                </div>
                                                                <div class="ml-2 flex-shrink-0 flex">
                                                                  <span class="px-2 inline-flex text-base leading-5 font-semibold rounded-full text-gray-500"
                                                                        v-text="localProperty.phone"
                                                                  ></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li v-if="localProperty.email"
                                                    class="mt-3">
                                                    <div class="block hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition duration-150 ease-in-out">
                                                        <div class="px-4 py-3 sm:px-6">
                                                            <div class="flex items-center justify-between">
                                                                <div class="text-base leading-5 font-medium text-gray-600 truncate">
                                                                    Correo Electrónico
                                                                </div>
                                                                <div class="ml-2 flex-shrink-0 flex">
                                                                  <span class="px-2 inline-flex text-base leading-5 font-semibold rounded-full text-gray-500"
                                                                        v-text="localProperty.email"
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

                            <property-location></property-location>

                            <property-features></property-features>

                            <divider title="Mapa de Ubicación"></divider>

                            @if ($property->location && ! is_null($property->location->coordinates))

                                <google-map :location="{{ json_encode($property->location) }}"
                                            :redirect-to="{{ json_encode($property->location->getGoogleMap()) }}"
                                            :map-class="'rounded-lg border-gray-300 h-80 min-w-full relative'"
                                ></google-map>

                            @endif

                        </div>
                    </div>
                    <!-- /End replace -->
                </div>
            </main>

        </div>
    </display-property>
@endsection
