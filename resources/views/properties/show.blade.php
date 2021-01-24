@extends('layouts.app')

@section('title', 'Una Propiedad')

@section('styles')
    <link rel="stylesheet" href="/css/vue-multiselect.min.css">
@endsection

@section('content')
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="w-full md:flex md:justify-between items-center">
                <h2 class="font-semibold text-2xl text-teal-400">
                    Una Propiedad
                </h2>
                <div class="hidden md:flex md:justify-between">
                    <button class="h-link bg-white border-emerald-900 -mt-1 mr-1 shadow rounded-md py-2 px-2 hover:text-gray-500 focus:outline-none focus:ring-blue-100 focus:border-blue-300 active:bg-gray-50 active:text-gray-800"
                            title="Reportar Propiedad...">
                        <svg class="text-yellow-500 hover:text-yellow-600 hover:border-yellow-700 hover:border" width="25" height="25" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </button>
                    <button class="h-link bg-white border-emerald-900 -mt-1 shadow rounded-md py-2 px-2 float-left hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-50 active:text-gray-800"
                            title="Eliminar Propiedad">
                        <svg class="text-red-500 hover:text-red-600 hover:border-red-700 hover:border" width="25" height="25"  fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                </div>

                <div class="w-full md:hidden mt-2">
                    <button class="h-link bg-white -mt-1 mr-1 shadow-sm rounded-md py-2 px-2 float-left hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-50 active:text-gray-800"
                            title="Reportar Propiedad...">
                        <svg class="text-yellow-500 hover:text-yellow-600 hover:border-yellow-700 hover:border" width="25" height="25" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <main class="">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Replace with your content -->
            <div class="py-6 sm:px-0">
                <property-profile inline-template>
                    <div>
                        <alert :type="'warning'">Para Publicar la propiedad es necesario registrar su Direccion</alert>

                        <alert :type="'primary'">
                            Aparece en nuestra
                            <a href="#" class="h-link">
                                Busqueda Avanzada
                            </a> agregando las Caracteristicas relevantes!
                        </alert>

                        <alert :type="'info'">
                            Al cambiar tu Propiedad a "No Publica" podria tomar unos momentos
                            para desaparecer de la Busqueda Avanzada.
                        </alert>

                        <div class="w-full mb-2 md:flex">
                            <!--Carrousel-->
                            <div class="w-full md:w-2/3 md:mr-4 mb-2 my-4">
                                <div class="card transition hover:transform">
                                    <div class="card-body">
                                        {{--                            <a @click="openModal('get-images')" href="#">--}}
                                        <custom-carousel :module-name="'properties'"
                                        ></custom-carousel>
                                        {{--                            </a>--}}
                                    </div>
                                </div>

                                <div class="md:flex flex-1 mt-2">

                                    <!--Property Address-->
                                    <div class="w-full md:w-1/2 mt-2 md:mt-0 mr-2">
                                        {{--                                    @include('properties.components.property-address')--}}
                                    </div>

                                    {{--Property Feature--}}
                                    <div class="w-full md:w-1/2 mt-2 md:mt-0">
                                        {{--                                        @include('properties.components.property-features')--}}
                                    </div>
                                </div>
                            </div>

                            <div class="w-full md:w-1/3 mt-4">
                                <div class="hidden md:block md:flex md:justify-between md:-mx-2 mt-1 mb-2">
                                    {{--Publish/Unpublish--}}
                                    <div class="w-full md:mx-2 mb-2 md:mb-0">
                                        <span class="rounded-md shadow-sm">
                                            <button type="button"
                                                    class="-mt-1 flex shadow-sm justify-center w-full py-3 border border-gray-100 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-50 active:text-gray-800" title="Agregar Caracteristicas..."
                                                    >
                                                <svg class="text-green-300 hover:text-green-400 hover:border-green-100" width="25" height="25" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
{{--                                                <svg v-if="property.status" class="text-gray-300 hover:text-gray-400 hover:border-gray-100" width="25" height="25" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>                                </button>--}}
                                        </span>
                                    </div>

                                    {{--Update Property--}}
                                    <div class="w-full md:mx-2">
                                        <button @click="openModal('put')"
                                                type="button"
                                                class="-mt-1 items-center shadow-sm w-full py-3 flex justify-center border border-gray-100 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-50 active:text-gray-800"
                                                title="Actualizar Datos de la Propiedad...">
                                            <svg class="text-yellow-300 hover:text-yellow-400 hover:border-yellow-100" width="25" height="25" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </button>
                                    </div>
                                </div>

                                <div class="hidden md:block md:flex md:justify-between mb-2">
                                    {{--Specs List--}}
                                    <div class="w-full bg-white shadow-sm overflow-hidden sm:rounded-md h-auto">
                                        <ul>
                                            <li class="mt-3">
                                                <div class="block hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition duration-150 ease-in-out">
                                                    <div class="px-4 py-3 sm:px-6">
                                                        <div class="flex items-center justify-between">
                                                            <div class="text-base leading-5 font-medium text-gray-600 truncate">
                                                                Estatus
                                                            </div>
                                                            <div class="ml-2 flex-shrink-0 flex">
                                                                <!--                                                            <svg v-if="property.status" class="h-5 w-5 text-green-500"  fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                                                                                            <svg v-else class="h-5 w-5 text-gray-500"  fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                                                                                                                            <span class="px-2 inline-flex text-base leading-5 font-semibold rounded-full text-gray-500"
                                                                                                                                  v-text="property.status ? 'Publicada' : 'No Publicada'"
                                                                                                                            ></span>-->
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
                                                                Precio
                                                            </div>
                                                            <div class="ml-2 flex-shrink-0 flex">
                                                            <span class="px-2 inline-flex text-base leading-5 font-semibold rounded-full text-gray-500">
                                                                $200,000 MN
                                                            </span>
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
                                                          <span class="px-2 inline-flex text-base leading-5 font-semibold rounded-full text-gray-500">
                                                              Venta
                                                          </span>
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
                                                          <span class="px-2 inline-flex text-base leading-5 font-semibold rounded-full text-gray-500">
                                                              Residencial
                                                          </span>
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
                                                                Categoria
                                                            </div>
                                                            <div class="ml-2 flex-shrink-0 flex">
                                                              <span class="px-2 inline-flex text-base leading-5 font-semibold rounded-full text-gray-500">
                                                                  Casa
                                                              </span>
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
                                                          <span class="px-2 inline-flex text-base leading-5 font-semibold rounded-full text-gray-500">
                                                              2 semanas
                                                          </span>
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

                        <divider title="Caracteristicas"></divider>

                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                            <div class="px-4 py-5 sm:px-6">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    Caracteristicas de la Propiedad
                                </h3>
<!--                                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                    Personal details and application.
                                </p>-->
                            </div>
                            <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                                <dl class="grid grid-cols-1 gap-x-4 gap-y-4 sm:grid-cols-3">
                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500 flex">
                                            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                                            </svg>
                                            m² Propiedad
                                        </dt>
                                        <dd class="mt-1 text-base text-teal-600">
                                            200
                                        </dd>
                                    </div>
                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500 flex">
                                            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                                            </svg>
                                            m² Construccion
                                        </dt>
                                        <dd class="mt-1 text-base text-teal-600">
                                            120
                                        </dd>
                                    </div>
                                    <div class="sm:col-span-1">

                                        <dt class="text-sm font-medium text-gray-500 flex">
                                            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                            </svg>
                                            No. Niveles
                                        </dt>
                                        <dd class="mt-1 text-base text-teal-600">
                                            2
                                        </dd>
                                    </div>
                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500 flex">
                                            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                            </svg>
                                            No. Habitaciones
                                        </dt>
                                        <dd class="mt-1 text-base text-teal-600">
                                            4
                                        </dd>
                                    </div>
                                    <div class="sm:col-span-1">

                                        <dt class="text-sm font-medium text-gray-500 flex">
                                            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                            No. Banos
                                        </dt>
                                        <dd class="mt-1 text-base text-teal-600">
                                            3
                                        </dd>
                                    </div>
                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500 flex">
                                            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                            No. Medios Banos
                                        </dt>
                                        <dd class="mt-1 text-base text-teal-600">
                                            3
                                        </dd>
                                    </div>

                                    <div class="sm:col-span-2">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Comentarios adicionales
                                        </dt>
                                        <dd class="mt-1 text-sm text-emerald-700">
                                            Fugiat ipsum ipsum deserunt culpa aute sint do nostrud anim incididunt cillum culpa consequat. Excepteur qui ipsum aliquip consequat sint. Sit id mollit nulla mollit nostrud in ea officia proident. Irure nostrud pariatur mollit ad adipisicing reprehenderit deserunt qui eu.
                                        </dd>
                                    </div>
                                </dl>
                            </div>
                        </div>

                        <divider title="Mapa de Ubicacion"></divider>

                        {{--Mapa--}}
                        <div class="mt-2 flex">
                            <div class="w-full">
                                <div class="border-gray-300 h-auto"></div>
                            </div>
                        </div>

                        <!--Timeline-->
                        <divider title="Comentarios Publicos"></divider>

                        <div class="bg-white shadow-lg rounded-lg p-6 mt-4">
                            <div class="flow-root">
                                <ul class="-mb-8">
                                    <li>
                                        <div class="relative pb-8">
                                            <span class="absolute top-5 left-5 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                            <div class="relative flex items-start space-x-3">
                                                <div class="relative">
                                                    <img class="h-10 w-10 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white" src="https://images.unsplash.com/photo-1520785643438-5bf77931f493?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=8&amp;w=256&amp;h=256&amp;q=80" alt="">

                                                    <span class="absolute -bottom-0.5 -right-1 bg-white rounded-tl px-0.5 py-px">
              <!-- Heroicon name: chat-alt -->
              <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z" clip-rule="evenodd" />
              </svg>
            </span>
                                                </div>
                                                <div class="min-w-0 flex-1">
                                                    <div>
                                                        <div class="text-sm">
                                                            <a href="#" class="font-medium text-gray-900">Eduardo Benz</a>
                                                        </div>
                                                        <p class="mt-0.5 text-sm text-gray-500">
                                                            Commented 6d ago
                                                        </p>
                                                    </div>
                                                    <div class="mt-2 text-sm text-gray-700">
                                                        <p>
                                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Tincidunt nunc ipsum tempor purus vitae id. Morbi in vestibulum nec varius. Et diam cursus quis sed purus nam.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="relative pb-8">
                                            <span class="absolute top-5 left-5 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                            <div class="relative flex items-start space-x-3">
                                                <div>
                                                    <div class="relative px-1">
                                                        <div class="h-8 w-8 bg-gray-100 rounded-full ring-8 ring-white flex items-center justify-center">
                                                            <!-- Heroicon name: user-circle -->
                                                            <svg class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="min-w-0 flex-1 py-1.5">
                                                    <div class="text-sm text-gray-500">
                                                        <a href="#" class="font-medium text-gray-900">Hilary Mahy</a>
                                                        assigned
                                                        <a href="#" class="font-medium text-gray-900">Kristin Watson</a>
                                                        <span class="whitespace-nowrap">2d ago</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="relative pb-8">
                                            <span class="absolute top-5 left-5 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                            <div class="relative flex items-start space-x-3">
                                                <div>
                                                    <div class="relative px-1">
                                                        <div class="h-8 w-8 bg-gray-100 rounded-full ring-8 ring-white flex items-center justify-center">
                                                            <!-- Heroicon name: tag -->
                                                            <svg class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                                <path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="min-w-0 flex-1 py-0">
                                                    <div class="text-sm leading-8 text-gray-500">
              <span class="mr-0.5">
                <a href="#" class="font-medium text-gray-900">Hilary Mahy</a>
                added tags
              </span>
                                                        <span class="mr-0.5">
                <a href="#" class="relative inline-flex items-center rounded-full border border-gray-300 px-3 py-0.5 text-sm">
                  <span class="absolute flex-shrink-0 flex items-center justify-center">
                    <span class="h-1.5 w-1.5 rounded-full bg-rose-500" aria-hidden="true"></span>
                  </span>
                  <span class="ml-3.5 font-medium text-gray-900">Bug</span>
                </a>

                <a href="#" class="relative inline-flex items-center rounded-full border border-gray-300 px-3 py-0.5 text-sm">
                  <span class="absolute flex-shrink-0 flex items-center justify-center">
                    <span class="h-1.5 w-1.5 rounded-full bg-indigo-500" aria-hidden="true"></span>
                  </span>
                  <span class="ml-3.5 font-medium text-gray-900">Accessibility</span>
                </a>
              </span>
                                                        <span class="whitespace-nowrap">6h ago</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="relative pb-8">
                                            <div class="relative flex items-start space-x-3">
                                                <div class="relative">
                                                    <img class="h-10 w-10 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white" src="https://images.unsplash.com/photo-1531427186611-ecfd6d936c79?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=8&amp;w=256&amp;h=256&amp;q=80" alt="">

                                                    <span class="absolute -bottom-0.5 -right-1 bg-white rounded-tl px-0.5 py-px">
              <!-- Heroicon name: chat-alt -->
              <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z" clip-rule="evenodd" />
              </svg>
            </span>
                                                </div>
                                                <div class="min-w-0 flex-1">
                                                    <div>
                                                        <div class="text-sm">
                                                            <a href="#" class="font-medium text-gray-900">Jason Meyers</a>
                                                        </div>
                                                        <p class="mt-0.5 text-sm text-gray-500">
                                                            Commented 2h ago
                                                        </p>
                                                    </div>
                                                    <div class="mt-2 text-sm text-gray-700">
                                                        <p>
                                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Tincidunt nunc ipsum tempor purus vitae id. Morbi in vestibulum nec varius. Et diam cursus quis sed purus nam. Scelerisque amet elit non sit ut tincidunt condimentum. Nisl ultrices eu venenatis diam.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <modal modal-id="update-property" max-width="sm:max-w-5xl">
                            <template #title>Actualizar Datos de la Propiedad</template>
                            <template #content>
                                <form @submit.prevent>

                                    <div class="w-full md:flex md:-mx-2 mt-4">
                                        <div class="w-full md:w-2/3 mx-2">
                                            <form-input
                                                title="Titulo de la Publicacion"
                                                :is-required="true"
                                                v-model="propertyForm.title"
                                                :data="propertyForm.title"
                                                input-id="title"
                                                :error="errors.title"
                                                placeholder="Casa Hermosa junto a la playa..."
                                            ></form-input>
                                        </div>
                                        <div class="w-full md:w-1/3 mx-2 mt-3 md:mt-0">
                                            <div :class="['form-group', errors.business_type ? 'invalid' : '']">
                                                <label for="business_type">
                                                    <strong class="required">*</strong>
                                                    Tipos de Negocio
                                                </label>
                                                <vue-multiselect v-model="propertyForm.businessType"
                                                                 :options="businessTypes"
                                                                 :searchable="false"
                                                                 :close-on-select="true"
                                                                 :show-labels="true"
                                                                 select-label=""
                                                                 selected-label=""
                                                                 deselect-label=""
                                                                 :hide-selected="true"
                                                                 placeholder="Seleccione un Tipo de Negocio..."
                                                ></vue-multiselect>
                                                <div v-if="errors.business_type"
                                                     :class="['alert alert-danger']"
                                                     v-text="errors.business_type[0]"
                                                ></div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="w-full md:flex md:-mx-2 mt-4">
                                        <div class="w-full md:w-1/3 mx-2">
                                            <form-input
                                                title="Precio"
                                                type="number"
                                                :is-required="true"
                                                v-model="propertyForm.price"
                                                :data="propertyForm.price"
                                                input-id="price"
                                                :error="errors.price"
                                                placeholder="300000"
                                            ></form-input>
                                        </div>
                                        <div class="w-full md:w-1/3 mx-2 mt-3 md:mt-0">
                                            <div class="form-group">
                                                <label for="property_type_id">
                                                    <strong class="required">*</strong>
                                                    Tipo de Propiedad
                                                </label>
                                                <vue-multiselect v-model="selectedPropertyType"
                                                                 :options="propertyTypes"
                                                                 :searchable="false"
                                                                 label="display_name"
                                                                 :close-on-select="true"
                                                                 :show-labels="true"
                                                                 select-label=""
                                                                 selected-label=""
                                                                 deselect-label=""
                                                                 :hide-selected="true"
                                                                 placeholder="Tipos de Propiedad..."
                                                                 @select="getPropertyCategoriesByPropertyType"
                                                ></vue-multiselect>
                                            </div>
                                        </div>
                                        <div class="w-full md:w-1/3 mx-2 mt-3 md:mt-0 mb-4">
                                            <div :class="['form-group', errors.property_category_id ? 'invalid' : '']">
                                                <label for="property_category_id">
                                                    <strong class="required">*</strong>
                                                    Categoria de la Propiedad
                                                </label>
                                                <vue-multiselect v-model="propertyForm.propertyCategory"
                                                                 :options="propertyCategoriesByPropertyType"
                                                                 :searchable="false"
                                                                 label="displayName"
                                                                 :close-on-select="true"
                                                                 :show-labels="true"
                                                                 select-label=""
                                                                 selected-label=""
                                                                 deselect-label=""
                                                                 :hide-selected="true"
                                                                 placeholder="Categorias de Propiedad"
                                                ></vue-multiselect>
                                                <div v-if="errors.property_category_id"
                                                     :class="['alert alert-danger']"
                                                     v-text="errors.property_category_id[0]"
                                                ></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="w-full my-6 md:mt-0">
                                        <div>
                                            <label for="comments">Comentarios</label>
                                            <textarea v-model="propertyForm.comments"
                                                      id="comments"
                                                      class="block rounded-md shadow-sm w-full outline-none border-emerald-200 bg-gray-100 focus:bg-white border-none"
                                                      rows="5"
                                            ></textarea>
                                            <errors :error="errors.comments"
                                                    :options="{ noContainer: true }"
                                            ></errors>
                                        </div>
                                    </div>

                                </form>
                            </template>
                            <template #footer>
                                <button @click="closeModal"
                                        type="button"
                                        class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">
                                    Cancelar
                                </button>
                                <button class="h-link ml-2 mt-2 md:mt-0 inline-flex items-center justify-center px-4 py-2 bg-teal-500 border border-gray-200 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:font-semibold hover:shadow-lg hover:bg-teal-400 hover:text-white focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150">
                                    Guardar
                                </button>
                            </template>
                        </modal>

                    </div>
                </property-profile>
            </div>
            <!-- /End replace -->
        </div>
    </main>
@endsection
