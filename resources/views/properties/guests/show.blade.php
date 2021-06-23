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
                                            <divider title="Compartir en"></divider>
                                            <div class="text-center mb-4 -mt-3">
                                                <a :href="`https://www.facebook.com/sharer.php?u=` + localProperty.meta.links.publicProfile"
                                                   target="_blank"
                                                   title="Compartir"
                                                   class="w-full md:w-1/2 inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                                    <span class="sr-only">Compartir en Facebook</span>
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                                        <path fill-rule="evenodd" d="M20 10c0-5.523-4.477-10-10-10S0 4.477 0 10c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V10h2.54V7.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V10h2.773l-.443 2.89h-2.33v6.988C16.343 19.128 20 14.991 20 10z" clip-rule="evenodd" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
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
            </main>

        </div>
    </display-property>
@endsection
