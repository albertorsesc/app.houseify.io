@extends('layouts.app')

@section('title', e($property->title))

@section('styles')
    <link rel="stylesheet" href="/css/vue-multiselect.min.css">
@endsection

@section('scripts')
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script>
        let map;

        function initMap() {
            @if ($property->location)
                const coordinates = {
                    lat: {{ $property->location->coordinates['latitude'] }},
                    lng: {{ $property->location->coordinates['longitude'] }}
                }

                let zoom = 15;
                @if ($property->location->address)
                    zoom = 20
                @endif

                map = new google.maps.Map(document.getElementById("map"), {
                    center: coordinates,
                    zoom: zoom,
                });

                map.addListener('click', function(e) {
                    window.location.href = '{{ $property->location->getGoogleMap() }}'
                });

                new google.maps.Marker({
                    position: coordinates,
                    map,
                    title: "{{ $property->location->getFullAddress() }}",
                });
            @endif
        }
    </script>

    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.gmaps_api') }}&callback=initMap&libraries=&v=weekly"
        async
    ></script>
@endsection

@section('meta')
    <meta property="og:url" content="{{ $property->publicProfile() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ $property->title }}" />
    <meta name="description" content="Propiedad en {{ $property->location ? $property->location->city . ' - ' . $property->location->state->code : null }}" />
    <meta property="og:image" content="{{ $property->media ? optional($property->media->first())->getFullUrl() : '' }}" />
@endsection

@section('content')
    <property-profile :property="{{ json_encode($property) }}" inline-template>
        <div>
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div class="w-full md:flex md:justify-between">
                        <h2 class="font-semibold text-2xl text-teal-400"
                            v-text="localProperty.title"
                        ></h2>
                        @auth
                        <div class="hidden md:flex md:justify-between">
                            {{--Report--}}
                            <report :model-id="localProperty.slug" model-name="properties" inline-template>
                                <div>
                                    <button @click="openModal" class="h-link bg-white -mt-1 mr-1 shadow rounded-md py-2 px-2 float-left hover:text-gray-500 hover:shadow appearance-none focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-50 active:text-gray-800"
                                            title="Reportar Propiedad...">
                                        <svg class="text-yellow-500 hover:text-yellow-600" width="25" height="25" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                    </button>
                                    <modal modal-id="reports" max-width="sm:max-w-md">
                                        <template #title>Reportar Propiedad</template>
                                        <template #content>
                                            <form @submit.prevent>
                                                <div class="w-full">
                                                    <div class="w-full">
                                                        <label for="reporting_cause">
                                                            <strong class="required">*</strong>
                                                            Causa del Reporte
                                                            <span class="text-gray-500 text-xs">(requerido)</span>
                                                        </label>
                                                        <div class="mt-1">
                                                            <select v-model="report.reportingCause"
                                                                    class="h-select"
                                                                    id="reporting_cause">
                                                                <option value="" selected disabled>Seleccione una Causa...</option>
                                                                @foreach(\App\Models\Properties\Property::getReportingCauses() as $key => $reportingCause)
                                                                    <option value="{{ $reportingCause }}">{{ $reportingCause }}</option>
                                                                @endforeach
                                                            </select>
                                                            <errors :error="errors.reporting_cause"
                                                                    :options="{ noContainer: true }"
                                                            ></errors>
                                                        </div>
                                                    </div>
                                                    <div class="w-full mt-4">
                                                        <div>
                                                            <label for="report_comments">Comentarios</label>
                                                            <textarea v-model="report.comments"
                                                                      id="report_comments"
                                                                      class="h-input form-input block w-full"
                                                                      rows="5"
                                                                      v-text="report.comments"
                                                            ></textarea>
                                                            <errors :error="errors.comments"
                                                                    :options="{ noContainer: true }"
                                                            ></errors>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </template>
                                        <template #footer>
                                            <button @click="closeModal()"
                                                    type="button" class="h-btn">
                                                Cancelar
                                            </button>
                                            <button @click="submitReport"
                                                    class="h-btn-success">
                                                Guardar
                                            </button>
                                        </template>
                                    </modal>
                                </div>
                            </report>
                            @if($property->seller->id === auth()->id())
                            {{--Delete--}}
                            <button @click="onDelete"
                                    class="h-link bg-white border-emerald-900 -mt-1 shadow rounded-md py-2 px-2 float-left appearance-none hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-50 active:text-gray-800"
                                    title="Eliminar Propiedad">
                                <svg class="text-red-500 hover:text-red-600" width="25" height="25"  fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                            @endif
                        </div>

                        {{--Mobile--}}
                        <div class="w-full md:hidden mt-3 flex justify-end">
                            <report :model-id="localProperty.slug" model-name="properties" inline-template>
                                <div>
                                    <button @click="openModal" class="h-link bg-white -mt-1 mr-1 shadow-sm rounded-md py-2 px-2 float-left hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-50 active:text-gray-800"
                                            title="Reportar Propiedad...">
                                        <svg class="text-yellow-500 hover:text-yellow-600 hover:border-yellow-700 hover:border" width="25" height="25" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                    </button>
                                    <modal modal-id="reports" max-width="sm:max-w-md">
                                        <template #title>Reportar Propiedad</template>
                                        <template #content>
                                            <form @submit.prevent>
                                                <div class="w-full">
                                                    <div class="w-full">
                                                        <label for="reporting_cause_mobile">
                                                            <strong class="required">*</strong>
                                                            Causa del Reporte
                                                            <span class="text-gray-500 text-xs">(requerido)</span>
                                                        </label>
                                                        <select v-model="report.reportingCause"
                                                                class="h-select"
                                                                id="reporting_cause_mobile">
                                                            <option value="" selected disabled>Seleccione una Causa...</option>
                                                            @foreach(\App\Models\Properties\Property::getReportingCauses() as $key => $reportingCause)
                                                                <option value="{{ $reportingCause }}">{{ $reportingCause }}</option>
                                                            @endforeach
                                                        </select>
                                                        <errors :error="errors.reporting_cause"
                                                                :options="{ noContainer: true }"
                                                        ></errors>
                                                    </div>
                                                    <div class="w-full mt-4">
                                                        <div>
                                                            <label for="report_comments_mobile">Comentarios</label>
                                                            <textarea v-model="report.comments"
                                                                      id="report_comments_mobile"
                                                                      class="h-input form-input block w-full"
                                                                      rows="5"
                                                                      v-text="report.comments"
                                                            ></textarea>
                                                            <errors :error="errors.comments"
                                                                    :options="{ noContainer: true }"
                                                            ></errors>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </template>
                                        <template #footer>
                                            <button @click="closeModal()"
                                                    type="button" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">
                                                Cancelar
                                            </button>
                                            <button @click="submitReport"
                                                    class="h-link ml-2 mt-2 md:mt-0 inline-flex items-center justify-center px-4 py-2 bg-teal-500 border border-gray-200 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:font-semibold hover:shadow-lg hover:bg-teal-400 hover:text-white focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150">
                                                Guardar
                                            </button>
                                        </template>
                                    </modal>
                                </div>
                            </report>
                            @if($property->seller->id === auth()->id())
                                {{--Delete--}}
                                <button @click="onDelete"
                                        class="h-link bg-white -mt-1 mr-1 shadow-sm rounded-md py-2 px-2 hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-50 active:text-gray-800"
                                        title="Eliminar Propiedad">
                                    <svg class="text-red-500 hover:text-red-600" width="25" height="25"  fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            @endif
                        </div>
                        @endauth
                    </div>
                </div>
            </header>

            <main class="">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="py-6 sm:px-0">
                        <div>
                            <alert v-if="localProperty.seller.id === auth && ! localProperty.location" :type="'warning'">
                                Para Publicar la propiedad es necesario registrar su Dirección
                            </alert>

                            <alert v-if="localProperty.seller.id === auth && ! localProperty.propertyFeature && localProperty.location"
                                   :type="'primary'">
                                ¡ Aparece en nuestra
                                <a href="#" class="h-link">
                                    Búsqueda Avanzada
                                </a> agregando las Características relevantes!
                            </alert>

                            <!--<alert :type="'info'">
                                Al cambiar tu Propiedad a "No Publica" podria tomar unos momentos
                                para desaparecer de la Búsqueda Avanzada.
                            </alert>-->

                            <div class="w-full mb-2 md:flex mt-4">
                                <div class="md:hidden">
                                    @if(auth()->check() && auth()->user()->owns($property, 'seller_id'))
                                        <div class="flex justify-end md:hidden mx-2 md:-mx-3 mt-1 mb-2">
                                            {{--Publish/Unpublish--}}
                                            <div class="w-full md:w-1/3 mx-2 md:mx-3 mb-2 md:mb-0">
                                                <span class="rounded-md shadow-sm">
                                                    <button @click="toggle"
                                                            :disabled="! localProperty.location"
                                                            type="button"
                                                            :class="[status.btnClass, ! localProperty.location ? 'bg-gray-200' : '']"
                                                            class="-mt-1 flex shadow-sm justify-center w-full py-3 border border-gray-100 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-50 active:text-gray-800"
                                                            :title="localProperty.status ? 'Ocultar esta Propiedad del publico...' : 'Hacer publico esta Propiedad...'">
                                                        <svg v-if="! localProperty.status" class="text-green-300 hover:text-green-400 hover:border-green-100" width="25" height="25" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                        <svg v-if="localProperty.status" class="text-gray-300 hover:text-gray-400 hover:border-gray-100" width="25" height="25" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                                                    </button>
                                                </span>
                                            </div>

                                            {{--Update Property--}}
                                            <div class="w-full md:w-1/3 mx-2 md:mx-3">
                                                <span class="rounded-md shadow-sm">
                                                    <button @click="openModal('put')"
                                                            type="button"
                                                            class="-mt-1 items-center shadow-sm w-full py-3 flex justify-center border border-gray-100 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-50 active:text-gray-800"
                                                            title="Actualizar Datos de la Propiedad...">
                                                        <svg class="text-yellow-300 hover:text-yellow-400 hover:border-yellow-100" width="25" height="25" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
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
                                    @if(auth()->check() && auth()->user()->owns($property, 'seller_id'))
                                    <div class="hidden md:flex md:justify-between md:-mx-2 mt-1 mb-2">
                                        {{--Publish/Unpublish--}}
                                        <div class="w-full md:w-1/2 md:mx-2 mb-2 md:mb-0">
                                        <span class="rounded-md shadow-sm">
                                            <button @click="toggle"
                                                    :disabled="! localProperty.location"
                                                    type="button"
                                                    :class="[status.btnClass, ! localProperty.location ? 'bg-gray-200' : '']"
                                                    class="-mt-1 flex shadow-sm justify-center w-full py-3 border border-gray-100 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-50 active:text-gray-800"
                                                    :title="localProperty.status ? 'Ocultar esta Propiedad del publico...' : 'Hacer publico esta Propiedad...'">
                                                <span v-if="! localProperty.status" class="text-green-300 hover:text-green-400">Publicar</span>
                                                <span v-if="localProperty.status" class="text-gray-300 hover:text-gray-400">Ocultar</span>
                                            </button>
                                        </span>
                                        </div>

                                        {{--Update Property--}}
                                        <div class="w-full md:w-1/2 md:mx-2">
                                        <span class="rounded-md shadow-sm">
                                            <button @click="openModal('put')"
                                                    type="button"
                                                    class="-mt-1 items-center shadow-sm w-full py-3 flex justify-center border border-gray-100 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-50 active:text-gray-800"
                                                    title="Actualizar Datos de la Propiedad...">
                                                <span class="text-gray-300">Editar</span>
                                            </button>
                                        </span>
                                        </div>
                                    </div>
                                    @endif

                                    {{--Specs List--}}
                                    <div class="md:flex md:justify-between mb-2">
                                        <div class="w-full bg-white shadow-sm overflow-hidden sm:rounded-md h-auto">
                                            <ul>
                                                <li class="mt-3" v-if="isAuthenticated && localProperty.seller.id === auth">
                                                    <div class="block hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition duration-150 ease-in-out">
                                                        <div class="px-4 py-3 sm:px-6">
                                                            <div class="flex items-center justify-between">
                                                                <div class="text-base leading-5 font-medium text-gray-600 truncate">
                                                                    Estatus
                                                                </div>
                                                                <div class="ml-2 flex-shrink-0 flex">
                                                                    <svg v-if="localProperty.status" class="h-5 w-5 text-green-500"  fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                                    <svg v-else class="h-5 w-5 text-gray-500"  fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                                                                    <span class="px-2 inline-flex text-base leading-5 font-semibold rounded-full text-gray-500"
                                                                          v-text="localProperty.status ? 'Publicada' : 'No Publicada'"
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
                                                <li @click="copy"
                                                    class="mt-3 cursor-pointer">
                                                    <div class="block hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition duration-150 ease-in-out">
                                                        <div class="px-4 pb-4 sm:px-6">
                                                            <div class="flex items-center justify-center">
                                                                <svg class="h-6 w-6 mr-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                                                </svg>
                                                                <div class="text-base leading-5 font-medium text-gray-600 truncate">
                                                                    Copiar Enlace de la Propiedad
                                                                </div>
                                                                {{--<div class="ml-2 flex-shrink-0 flex w-1/2">
                                                                    <a @click="copy"
                                                                       role="button"
                                                                       class="cursor-pointer text-xs">
                                                                        {{ $property->publicProfile() }}
                                                                        <action-message
                                                                            :message="'Copiado!'"
                                                                        ></action-message>
                                                                    </a>
                                                                </div>--}}
                                                            </div>
                                                        </div>

                                                        <action-message
                                                            :message="'Copiado!'"
                                                        ></action-message>
                                                    </div>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            @if(auth()->check() && auth()->id() === $property->seller_id)
                            <div>
                                <property-images></property-images>
                            </div>
                            @endif

                            <property-location></property-location>

                            @if ($property->location && $property->location->coordinates)
                            <divider title="Mapa"></divider>

                            {{--Mapa--}}
                            <div class="flex">
                                <div class="w-full bg-white rounded-lg shadow p-3">
                                    <div id="map" class="rounded-lg border-gray-300 h-80"></div>
                                </div>
                            </div>
                            @endif

                            <property-features></property-features>

                            @if(auth()->check() && auth()->id() === $property->seller_id)
                                <modal modal-id="update-property" max-width="sm:max-w-5xl">
                                    <template #title>Actualizar Datos de la Propiedad</template>
                                    <template #content>
                                        <form @submit.prevent>

                                            <div class="w-full md:flex md:-mx-2 mt-4">
                                                <div class="w-full md:w-2/3 md:mx-2">
                                                    <form-input
                                                        title="Título de la Publicación"
                                                        :is-required="true"
                                                        v-model="propertyForm.title"
                                                        :data="propertyForm.title"
                                                        input-id="title"
                                                        :error="errors.title"
                                                        placeholder="Casa Hermosa junto a la playa..."
                                                        @change="propertyForm.title"
                                                    ></form-input>
                                                </div>
                                                <div class="w-full md:w-1/3 md:mx-2 mt-3 md:mt-0">
                                                    <div :class="['form-group', errors.business_type ? 'invalid' : '']">
                                                        <label for="business_type">
                                                            <strong class="required">*</strong>
                                                            Tipos de Negocio
                                                            <span class="text-gray-500 font-light text-xs">(requerido)</span>
                                                        </label>
                                                        <div class="mt-2">
                                                            <vue-multiselect v-model="propertyForm.businessType"
                                                                             :options="getBusinessTypes"
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
                                            </div>

                                            <div class="w-full md:flex md:-mx-2 mt-4">
                                                <div class="w-full md:w-1/3 md:mx-2 mt-3 md:mt-0">
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
                                                <div class="w-full md:w-1/3 md:mx-2 mt-3 md:mt-0">
                                                    <div class="form-group">
                                                        <label for="property_type_id">
                                                            <strong class="required">*</strong>
                                                            Tipo de Propiedad
                                                            <span class="text-gray-500 font-light text-xs">(requerido)</span>
                                                        </label>
                                                        <div class="mt-2">
                                                            <vue-multiselect v-model="selectedPropertyType"
                                                                             :options="getPropertyTypes"
                                                                             :searchable="false"
                                                                             label="display_name"
                                                                             :close-on-select="true"
                                                                             :show-labels="true"
                                                                             select-label=""
                                                                             selected-label=""
                                                                             deselect-label=""
                                                                             :hide-selected="true"
                                                                             placeholder="Tipos de Propiedad..."
                                                                             @select="lookupPropertyCategories"
                                                            ></vue-multiselect>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="w-full md:w-1/3 md:mx-2 mt-3 md:mt-0 mb-4">
                                                    <div :class="['form-group', errors.property_category_id ? 'invalid' : '']">
                                                        <label for="property_category_id">
                                                            <strong class="required">*</strong>
                                                            Categoría de la Propiedad
                                                            <span class="text-gray-500 font-light text-xs">(requerido)</span>
                                                        </label>
                                                        <div class="mt-2">
                                                            <vue-multiselect v-model="selectedPropertyCategory"
                                                                             :options="propertyCategoriesByPropertyType"
                                                                             :searchable="false"
                                                                             label="displayName"
                                                                             :close-on-select="true"
                                                                             :show-labels="true"
                                                                             select-label=""
                                                                             selected-label=""
                                                                             deselect-label=""
                                                                             :hide-selected="true"
                                                                             placeholder="Categorías de Propiedad"
                                                            ></vue-multiselect>
                                                        </div>
                                                        <errors :error="errors.property_category_id"
                                                                :options="{ noContainer: true }"
                                                        ></errors>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="w-full my-6 md:mx-2 md:mt-0">
                                                <div class="form-group">
                                                    <label for="comments">Comentarios</label>
                                                    <span class="text-gray-500 font-light text-xs">(opcional)</span>
                                                    <div class="mt-2">
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
                                            </div>

                                        </form>
                                    </template>
                                    <template #footer>
                                        <button @click="closeModal"
                                                type="button"
                                                class="h-btn">
                                            Cancelar
                                        </button>
                                        <button @click="update"
                                                class="h-btn-success">
                                            Guardar
                                        </button>
                                    </template>
                                </modal>
                            @endif

                        </div>
                    </div>
                </div>
            </main>

        </div>
    </property-profile>
@endsection
