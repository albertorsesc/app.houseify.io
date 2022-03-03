@extends('layouts.app')

@section('title', e($business->name))

@section('meta')
    <meta property="og:url" content="{{ $business->publicProfile() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ $business->name }}" />
    <meta name="description" content="Negocio/Empresa en {{ $business->location ? $business->location->city . ' - ' . $business->location->state->code : null }}" />
    <meta property="og:image" content="{{ $business->logo ? str_replace('public', 'storage', $business->logo) : '' }}" />
@endsection

@section('styles')
    <link rel="stylesheet" href="/css/vue-multiselect.min.css">
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
@endsection

@section('scripts')
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.gmaps_api') }}&region=MX&libraries=places&v=weekly"
        async
    ></script>
@endsection

@section('content')
    <business-profile :business="{{ json_encode($business) }}" inline-template>
        <div>
            <header class="bg-white shadow" v-cloak>
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div class="w-full md:flex md:justify-between items-center">
                        <h2 class="font-semibold text-2xl text-teal-400"
                            v-text="localBusiness.name"
                        ></h2>
                        <div class="hidden md:flex md:justify-between">
                            <a @click="businessTab = 'profile'"
                               role="button"
                               href="#"
                               class="h-link mx-2 text-base font-medium text-cyan-500 border-b-2 leading-5"
                               :class="[businessTab === 'profile' ? 'border-emerald-400 text-cyan-600' : 'hover:border-emerald-400 hover:text-cyan-600']">
                                Perfil del Negocio
                            </a>
                            @if($business->products->count() > 0 || $business->owner->id === auth()->id())
                            <a @click="businessTab = 'inventory'"
                               role="button"
                               href="#"
                               class="h-link mx-2 text-base font-medium text-cyan-500 border-b-2 leading-5"
                               :class="[businessTab === 'inventory' ? 'border-emerald-400 text-cyan-600' : 'hover:border-emerald-400 hover:text-cyan-600']">
                                <template v-if="localBusiness.owner.id === auth">Mi Inventario</template>
                                <template v-else>Inventario</template>
                            </a>
                            @endif
                        </div>
                        @auth
                        {{--Desktop--}}
                        <div class="hidden md:flex md:justify-between">
                            @if($business->owner->id !== auth()->id())
                            {{--Report--}}
                            <report :model-id="localBusiness.slug" model-name="businesses" inline-template>
                                <div>
                                    <button @click="openModal" class="h-link bg-white -mt-1 mr-1 shadow-sm hover:shadow rounded-md py-2 px-2 float-left hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-50 active:text-gray-800"
                                            title="Reportar Propiedad...">
                                        <svg class="text-yellow-500 hover:text-yellow-600" width="25" height="25" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                    </button>
                                    <modal modal-id="reports" max-width="sm:max-w-md">
                                        <template #title>Reportar Negocio/Empresa</template>
                                        <template #content>
                                            <form @submit.prevent>
                                                <div class="w-full">
                                                    <div class="w-full">
                                                        <label for="reporting_cause">
                                                            <strong class="required">*</strong>
                                                            Causa del Reporte
                                                        </label>
                                                        <select v-model="report.reportingCause"
                                                                class="h-select"
                                                                id="reporting_cause">
                                                            <option value="" selected disabled>Seleccione una Causa...</option>
                                                            @foreach(\App\Models\Businesses\Business::getReportingCauses() as $key => $reportingCause)
                                                                <option value="{{ $reportingCause }}">{{ $reportingCause }}</option>
                                                            @endforeach
                                                        </select>
                                                        <errors :error="errors.reporting_cause"
                                                                :options="{ noContainer: true }"
                                                        ></errors>
                                                    </div>
                                                    <div class="w-full mt-4">
                                                        <div>
                                                            <label for="report_comments">Comentarios</label>
                                                            <textarea v-model="report.comments"
                                                                      class="h-input form-input block w-full"
                                                                      id="report_comments"
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
                            @endif
                            {{--Delete--}}
                            @if($business->owner->id === auth()->id())
                                <button @click="onDelete"
                                        class="h-link bg-white -mt-1 mr-1 shadow-sm hover:shadow rounded-md py-2 px-2 float-left hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-50 active:text-gray-800"
                                        title="Eliminar Negocio/Empresa">
                                    <svg class="text-red-500 hover:text-red-600" width="25" height="25"  fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            @endif
                        </div>

                        {{--Mobile Header--}}
                        <div class="w-full flex justify-end md:hidden mt-2">
                            {{--Report--}}
                            @if($business->owner->id !== auth()->id())
                            <report :model-id="localBusiness.slug"
                                    model-name="businesses"
                                    inline-template>
                                <div>
                                    <button @click="openModal" class="h-link bg-white -mt-1 mr-1 shadow-sm rounded-md py-2 px-2 float-left hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-50 active:text-gray-800"
                                            title="Reportar Propiedad...">
                                        <svg class="text-yellow-500 hover:text-yellow-600" width="25" height="25" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                    </button>
                                    <modal modal-id="reports" max-width="sm:max-w-md">
                                        <template #title>Reportar Negocio/Empresa</template>
                                        <template #content>
                                            <form @submit.prevent>
                                                <div class="w-full">
                                                    <div class="w-full">
                                                        <label for="reporting_cause">
                                                            <strong class="required">*</strong>
                                                            Causa del Reporte
                                                        </label>
                                                        <select v-model="report.reportingCause"
                                                                class="h-select"
                                                                id="reporting_cause">
                                                            <option value="" selected disabled>Seleccione una Causa...</option>
                                                            @foreach(\App\Models\Businesses\Business::getReportingCauses() as $key => $reportingCause)
                                                                <option value="{{ $reportingCause }}">{{ $reportingCause }}</option>
                                                            @endforeach
                                                        </select>
                                                        <errors :error="errors.reporting_cause"
                                                                :options="{ noContainer: true }"
                                                        ></errors>
                                                    </div>
                                                    <div class="w-full mt-4">
                                                        <div>
                                                            <label for="report_comments">Comentarios</label>
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
                            @endif

                            {{--Delete--}}
                            @if($business->owner->id === auth()->id())
                            <button @click="onDelete"
                                    class="h-link bg-white -mt-1 mr-1 shadow-sm hover:shadow rounded-md py-2 px-2 float-left hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-50 active:text-gray-800"
                                    title="Eliminar Negocio/Empresa">
                                <svg class="text-red-500 hover:text-red-600" width="25" height="25"  fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                            @endif
                        </div>
                        @endauth
                    </div>
                </div>
            </header>

            <div v-if="businessTab === 'profile'"
                 class="mt-4 mb-20 max-w-3xl mx-auto grid grid-cols-1 gap-6 lg:max-w-7xl lg:grid-flow-col-dense lg:grid-cols-3">
                <div class="space-y-6 lg:col-start-1"
                     :class="[isAuthenticated && localBusiness.owner.id === auth ? 'lg:col-span-2' : 'lg:col-span-12']">
                    {{--Mobile--}}
                    <div v-if="isAuthenticated && localBusiness.owner.id === auth"
                         class="flex justify-end md:hidden mx-2 md:-mx-3 mt-1 mb-2" v-cloak>
                        {{--Publish/UnPublish--}}
                        <div class="w-full md:w-1/3 mx-2 md:mx-3 mb-2 md:mb-0">
                            <span class="rounded-md shadow-sm">
                                <button @click="toggle"
                                        :disabled="! localBusiness.location"
                                        type="button"
                                        :class="[status.btnClass, ! localBusiness.location ? 'bg-gray-200' : '']"
                                        class="-mt-1 flex shadow-sm justify-center w-full py-3 border border-gray-100 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-50 active:text-gray-800"
                                        :title="localBusiness.status ? 'Ocultar mi Negocio del publico...' : 'Publicar mi Negocio...'">
                                        <span v-if="! localBusiness.status" class="text-green-300 hover:text-green-400">Publicar</span>
                                        <span v-if="localBusiness.status" class="text-gray-300 hover:text-gray-400">Ocultar</span>
                                </button>
                            </span>
                        </div>

                        {{--Update--}}
                        <div class="w-full md:w-1/3 mx-2 md:mx-3">
                            <span class="rounded-md shadow-sm">
                                <button @click="openModal('put')"
                                        type="button"
                                        class="-mt-1 items-center shadow-sm w-full py-3 flex justify-center border border-gray-100 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-50 active:text-gray-800"
                                        title="Actualizar Datos del Negocio...">
                                    <span class="text-gray-300">Editar</span>
                                </button>
                            </span>
                        </div>
                    </div>

                    <!-- Description list-->
                    <section aria-labelledby="business-information">

                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="py-2 md:py-0 sm:px-0">
                                <div>
                                    <div v-if="localBusiness.owner.id === auth && ! localBusiness.location"
                                         class="mb-4">
                                        <alert :type="'warning'">
                                            Para Publicar el negocio es necesario registrar su Dirección
                                        </alert>
                                    </div>

                                    <div v-if="isAuthenticated && localBusiness.owner.id !== auth"
                                        class="w-1/2 w-4/5 mb-2 items-end align-middle flex justify-end">
                                        <div class="mr-4 lg:mr-0 w-1/12 w-4/5 flex justify-end">
                                            {{--Likes--}}
                                            <span class="mr-3">
                                                <likes :endpoint="`/businesses/${localBusiness.slug}`"
                                                       :model="localBusiness"
                                                       :model-id="localBusiness.slug"
                                                ></likes>
                                            </span>
                                            {{--InterestedBtn--}}
                                            <span>
                                                <interested-btn :model="localBusiness"
                                                                :id="localBusiness.slug"
                                                                model-name="business"
                                                                endpoint="/businesses"
                                                                icon-size="h-8 w-8"
                                                ></interested-btn>
                                            </span>
                                        </div>
                                    </div>

                                    {{--Business Details--}}
                                    <div :class="isAuthenticated ? '' : 'mt-6'" v-cloak>
                                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                                            <div class="px-4 py-5 sm:px-6">
                                                <h3 class="text-lg leading-6 font-medium text-gray-600">
                                                    Detalles del Negocio
                                                </h3>
                                                <div class="flex justify-end mt-8">
                                                    <div class="rounded-full border border-emerald-200 hover:border hover:border-emerald-300 hover:ml-2 hover:shadow-md bg-white z-20 p-1 inline-block absolute -mt-24">
                                                        <div class="flex">
                                                            <label for="file-upload"
                                                                   class="relative"
                                                                   :class="isAuthenticated && localBusiness.owner.id === auth ? 'cursor-pointer' : ''">
                                                                <form v-if="isAuthenticated && localBusiness.owner.id === auth"
                                                                      action="{{ route('businesses.logo.store', $business) }}"
                                                                      method="POST"
                                                                      id="logo-form"
                                                                      enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <input id="file-upload"
                                                                           name="logo"
                                                                           type="file"
                                                                           class="hidden sr-only"
                                                                           onchange="document.getElementById('logo-form').submit()">
                                                                </form>

                                                                @if ($business->logo)
                                                                    <img src="{{ str_replace('public', 'storage', $business->logo) }}"
                                                                         class="text-white inline-block object-cover object-center rounded-full h-20 w-20"
                                                                         loading="lazy"
                                                                         alt="{{ $business->name }}">
                                                                @else
                                                                    <img src="/logos/houseify-13.png"
                                                                         class="text-white inline-block object-contain rounded-full h-20 w-20"
                                                                         loading="lazy"
                                                                         alt="Houseify.io">
                                                                @endif
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                                                <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                                                    <div class="sm:col-span-1">
                                                        <dt class="text-sm font-medium text-gray-500">
                                                            Nombre del Negocio
                                                        </dt>
                                                        <dd class="mt-1 text-sm text-gray-900" v-text="localBusiness.name"></dd>
                                                    </div>
                                                    <div class="sm:col-span-1">
                                                        <dt class="text-sm font-medium text-gray-500">
                                                            Estatus
                                                        </dt>
                                                        <dd class="mt-1 flex text-sm text-gray-900">
                                                            <svg v-if="localBusiness.status" class="h-5 w-5 text-green-500"  fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                            <svg v-else class="h-5 w-5 text-gray-500"  fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                                                            <span class="px-2 inline-flex text-base leading-5 font-semibold rounded-full text-gray-500"
                                                                  v-text="localBusiness.status ? 'Publicado' : 'No Publicado'"
                                                            ></span>
                                                        </dd>
                                                    </div>
                                                    <div class="sm:col-span-1">
                                                        <dt class="text-sm font-medium text-gray-500">
                                                            Categorías del Negocio
                                                        </dt>
                                                        <dd class="mt-2 text-sm flex flex-wrap text-gray-900">
                                                            <div class="mr-3 my-2"
                                                                 v-for="(category, index) in localBusiness.categories"
                                                                 :key="index">
                                                            <span class="px-3 py-1 text-sm bg-emerald-100 font-medium leading-5 text-emerald-900 rounded-full shadow-sm"
                                                                  v-text="category"
                                                            ></span>
                                                            </div>
                                                        </dd>
                                                    </div>
                                                    <div v-if="localBusiness.email" class="sm:col-span-1">
                                                        <dt class="text-sm font-medium text-gray-500">
                                                            Correo Electrónico
                                                        </dt>
                                                        <dd class="mt-1 text-sm text-gray-900" v-text="localBusiness.email"></dd>
                                                    </div>
                                                    <div v-if="localBusiness.phone" class="sm:col-span-1">
                                                        <dt class="text-sm font-medium text-gray-500">
                                                            Teléfono
                                                        </dt>
                                                        <dd class="mt-1 text-sm text-gray-900"
                                                            v-text="formatPhone(localBusiness.phone)"
                                                        ></dd>
                                                    </div>
                                                    <div v-if="localBusiness.facebookProfile" class="sm:col-span-1">
                                                        <dt class="text-sm font-medium text-gray-500">
                                                            Perfil de Facebook
                                                        </dt>
                                                        <dd class="mt-1 text-sm text-gray-900">
                                                            <a :href="localBusiness.facebookProfile"
                                                               class="h-link"
                                                               v-text="localBusiness.facebookProfile"
                                                            ></a>
                                                        </dd>
                                                    </div>
                                                    <div v-if="localBusiness.linkedinProfile" class="sm:col-span-1">
                                                        <dt class="text-sm font-medium text-gray-500">
                                                            Perfil de LinkedIn
                                                        </dt>
                                                        <dd class="mt-1 text-sm text-gray-900">
                                                            <a :href="localBusiness.linkedinProfile"
                                                               class="h-link"
                                                               v-text="localBusiness.linkedinProfile"
                                                            ></a>
                                                        </dd>
                                                    </div>
                                                    <div v-if="localBusiness.site" class="sm:col-span-1">
                                                        <dt class="text-sm font-medium text-gray-500">
                                                            Sitio Web
                                                        </dt>
                                                        <dd class="mt-1 text-sm text-gray-900">
                                                            <a :href="localBusiness.site"
                                                               class="h-link"
                                                               v-text="localBusiness.site"
                                                            ></a>
                                                        </dd>
                                                    </div>
                                                    <div class="sm:col-span-1">
                                                        <dt class="text-sm font-medium text-gray-500">
                                                            Actualizado hace:
                                                        </dt>
                                                        <dd class="mt-1 text-sm text-gray-900" v-text="localBusiness.meta.updatedAt"></dd>
                                                    </div>
                                                    <div class="sm:col-span-1">
                                                        <dt class="text-sm font-medium text-gray-500">
                                                            Compartir
                                                        </dt>
                                                        <dd class="mt-1 text-sm text-gray-900">
                                                            <div class="w-1/2">
                                                                <a :href="`https://www.facebook.com/sharer.php?u=` + localBusiness.meta.links.publicProfile"
                                                                   target="_blank"
                                                                   title="Compartir"
                                                                   class="w-full md:w-1/2 inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                                                    <span class="sr-only">Compartir en Facebook</span>
                                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                                                        <path fill-rule="evenodd" d="M20 10c0-5.523-4.477-10-10-10S0 4.477 0 10c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V10h2.54V7.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V10h2.773l-.443 2.89h-2.33v6.988C16.343 19.128 20 14.991 20 10z" clip-rule="evenodd" />
                                                                    </svg>
                                                                </a>
                                                            </div>
                                                        </dd>
                                                    </div>
                                                    <div v-if="localBusiness.comments" class="sm:col-span-2">
                                                        <dt class="text-sm font-medium text-gray-500">
                                                            Información Adicional
                                                        </dt>
                                                        <dd class="mt-1 text-sm text-gray-900" v-text="localBusiness.comments"></dd>
                                                    </div>
                                                </dl>
                                            </div>
                                        </div>
                                    </div>

                                    <divider title="Dirección"></divider>

                                    <business-location v-cloak></business-location>

                                    @if ($business->location && ! is_null($business->location->coordinates))
                                        <google-map :location="{{ json_encode($business->location) }}"
                                                    :redirect-to="{{ json_encode($business->location->getGoogleMap()) }}"
                                                    :map-class="'rounded-lg border-gray-300 h-80 min-w-full relative'"
                                        ></google-map>
                                    @endif

                                    <modal v-if="localBusiness.owner.id === auth" modal-id="update-business" max-width="sm:max-w-5xl" v-cloak>
                                        <template #title>Actualizar Datos de tu Negocio</template>
                                        <template #content>
                                            <form @submit.prevent>
                                                <div class="w-full md:flex md:-mx-2 mt-4">
                                                    <div class="w-full md:mx-2">
                                                        <div class="w-full">
                                                            <form-input
                                                                title="Nombre del Negocio"
                                                                :data="businessForm.name"
                                                                input-id="name"
                                                                :error="errors.name"
                                                                :is-disabled="true"
                                                                :custom-classes="'text-gray-400 bg-gray-100'"
                                                            ></form-input>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="w-full md:flex md:-mx-2 mt-4">
                                                    <div class="w-full md:mx-2 mt-3 md:mt-0">
                                                        <label for="neighborhood">
                                                            <strong class="required">*</strong>
                                                            Categorías
                                                            <span class="text-gray-500 font-light text-xs">(requerido)</span>
                                                        </label>
                                                        <div class="mt-2 rounded-md shadow-sm text-base">
                                                            <vue-multiselect v-model="selectedConstructionCategories"
                                                                             :placeholder="''"
                                                                             :options="getConstructionCategories"
                                                                             :multiple="true"
                                                                             :taggable="true"
                                                                             :hide-selected="true"
                                                                             id="categories"
                                                                             :searchable="true"
                                                                             :close-on-select="false"
                                                                             select-label=""
                                                                             selected-label=""
                                                                             deselect-label=""
                                                                             placeholder="Selecciona las Categorías de Construcción de tu Negocio..."
                                                            ></vue-multiselect>
                                                        </div>
                                                        <errors :error="errors.categories"
                                                                :options="{ noContainer: true }"
                                                        ></errors>
                                                    </div>
                                                </div>

                                                <div class="w-full md:flex md:-mx-2 mt-4">
                                                    {{--Email--}}
                                                    <div class="w-full md:w-1/2 md:mx-2 mt-3 md:mt-0">
                                                        <form-input
                                                            title="Correo Electrónico"
                                                            v-model="businessForm.email"
                                                            :data="businessForm.email"
                                                            input-id="email"
                                                            :error="errors.email"
                                                        ></form-input>
                                                    </div>
                                                    {{--Phone--}}
                                                    <div class="w-full md:w-1/2 md:mx-2 mt-3 md:mt-0">
                                                        <form-input
                                                            title="Teléfono"
                                                            v-model="businessForm.phone"
                                                            :data="businessForm.phone"
                                                            input-id="phone"
                                                            :error="errors.phone"
                                                        ></form-input>
                                                    </div>
                                                </div>

                                                <div class="w-full md:flex md:-mx-2 mt-4">
                                                    {{--Facebook Profile--}}
                                                    <div class="w-full md:w-1/3 md:mx-2 mt-3 md:mt-0">
                                                        <form-input
                                                            title="Perfil de Facebook"
                                                            v-model="businessForm.facebookProfile"
                                                            :data="businessForm.facebookProfile"
                                                            input-id="facebook_profile"
                                                            :error="errors.facebook_profile"
                                                        ></form-input>
                                                    </div>
                                                    {{--LinkedIn Profile--}}
                                                    <div class="w-full md:w-1/3 md:mx-2 mt-3 md:mt-0">
                                                        <form-input
                                                            title="Perfil de LinkedIn"
                                                            v-model="businessForm.linkedinProfile"
                                                            :data="businessForm.linkedinProfile"
                                                            input-id="linkedin_profile"
                                                            :error="errors.linkedin_profile"
                                                        ></form-input>
                                                    </div>
                                                    {{--Site--}}
                                                    <div class="w-full md:w-1/3 md:mx-2 mt-3 md:mt-0">
                                                        <form-input
                                                            title="Sitio Web"
                                                            v-model="businessForm.site"
                                                            :data="businessForm.site"
                                                            input-id="site"
                                                            :error="errors.site"
                                                        ></form-input>
                                                    </div>
                                                </div>

                                                <div class="w-full my-6 md:mt-3">
                                                    <div>
                                                        <label for="comments">
                                                            Comentarios
                                                            <span class="text-gray-500 font-light text-xs">(opcional)</span>
                                                        </label>
                                                        <div class="mt-2">
                                                    <textarea v-model="businessForm.comments"
                                                              id="comments"
                                                              class="block rounded-md shadow-sm w-full outline-none border-emerald-200 bg-gray-50 focus:bg-white"
                                                              rows="5"
                                                    ></textarea>
                                                        </div>
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
                                                    class="h-btn">
                                                Cancelar
                                            </button>
                                            <button @click="update"
                                                    class="h-btn-success">
                                                Guardar
                                            </button>
                                        </template>
                                    </modal>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

                <section v-if="isAuthenticated && localBusiness.owner.id === auth"
                         aria-labelledby="timeline-title"
                         class="lg:col-start-3 lg:col-span-1">
                    <div class="md:mt-6">
                        <div class="hidden lg:flex mb-2">
                            {{--Publish/UnPublish--}}
                            <div class="w-full md:w-1/2 mr-2 mb-2 md:mb-0">
                                <span class="rounded-md shadow-sm">
                                    <button @click="toggle"
                                            :disabled="! localBusiness.location"
                                            type="button"
                                            :class="[status.btnClass, ! localBusiness.location ? 'bg-gray-200' : '']"
                                            class="-mt-1 flex shadow-sm justify-center w-full py-3 border border-gray-100 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-50 active:text-gray-800"
                                            :title="localBusiness.status ? 'Ocultar mi Negocio del publico...' : 'Publicar mi Negocio...'">
                                        <span v-if="! localBusiness.status" class="text-green-300 hover:text-green-400">Publicar</span>
                                        <span v-if="localBusiness.status" class="text-gray-300 hover:text-gray-400">Ocultar</span>
                                    </button>
                                </span>
                            </div>
                            {{--Update--}}
                            <div class="w-full md:w-1/2 mb-2 md:mb-0">
                                <span class="rounded-md shadow-sm">
                                    <button @click="openModal('put')"
                                            type="button"
                                            class="-mt-1 items-center shadow-sm w-full py-3 flex justify-center border border-gray-100 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-50 active:text-gray-800"
                                            title="Actualizar Datos del Negocio...">
                                        <span class="text-gray-300">Editar</span>
                                    </button>
                                </span>
                            </div>
                        </div>

                        {{--Activity--}}
{{--                        @if($likes['like_count'] || $interests['interest_count'])--}}
                            <div class="bg-white px-4 py-5 shadow sm:rounded-lg sm:px-6">
                                <h2 id="timeline-title" class="text-lg font-medium text-gray-900">Actividad</h2>

                                <div class="mt-6 flow-root">
                                    <ul class="-mb-8 pb-12">
                                        @if($likes['like_count'])
                                            <li>
                                                <div class="relative pb-16">
                                                    <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                                    <div class="relative flex space-x-3">
                                                        <div>
                                              <span class="h-8 w-8 rounded-full bg-white border border-emerald-300 flex items-center justify-center ring-8 ring-white">
                                                  <svg class="h-5 w-5 text-emerald-300"
                                                       fill="none"
                                                       xmlns="http://www.w3.org/2000/svg"
                                                       viewBox="0 0 24 24"
                                                       stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                                    </svg>
                                              </span>
                                                        </div>

                                                        <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                                            <div>
                                                                <p class="text-sm text-gray-500">
                                                                    Tienes <span class="font-medium text-gray-900">1</span> nuevo Like.
                                                                </p>
                                                            </div>
                                                            <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                                                <time datetime="{{ $likes['last_like_at'] }}">
                                                                    {{ $likes['last_like_at'] }}
                                                                </time>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                            </li>
                                        @endif

                                    <!--                                    <li>
                                                                            <div class="relative pb-8">
                                                                                <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                                                                <div class="relative flex space-x-3">
                                                                                    <div>
                                                                                  <span class="h-8 w-8 rounded-full bg-white border border-blue-300 flex items-center justify-center ring-8 ring-white">
                                                                                      <svg class="h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                                                        </svg>
                                                                                  </span>
                                                                                    </div>
                                                                                    <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                                                                        <div>
                                                                                            <p class="text-sm text-gray-500">Tuviste una nueva <a href="#" class="font-medium text-gray-900">visita</a></p>
                                                                                        </div>
                                                                                        <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                                                                            <time datetime="2020-09-22">Sep 22</time>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>-->

                                        @if($interests['interest_count'])
                                            <li>
                                                <div class="relative pb-8">
                                                    <div class="relative flex space-x-3">
                                                        <div>
                                          <span class="h-8 w-8 rounded-full bg-white border border-red-300 flex items-center justify-center ring-8 ring-white">
                                              <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                            </svg>
                                          </span>
                                                        </div>
                                                        <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                                            <div>
                                                                <p class="text-sm text-gray-500">
                                                                    Hay <span class="font-medium text-gray-900">1</span> nuevo interesado.
                                                                </p>
                                                            </div>
                                                            <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                                                <time datetime="{{ $interests['last_interest_at'] }}">
                                                                    {{ $interests['last_interest_at'] }}
                                                                </time>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="flex flex-col justify-stretch">
                                    <div class="block bg-gray-50 px-4 py-4 hover:text-gray-700 sm:rounded-b-lg">
                                        <div class="flex justify-evenly">
                                            <!--                                        <div>
                                                                                        <span class="text-xs font-medium text-gray-500 text-center">Visitas</span>
                                                                                        <span class="text-blue-500 text-sm">23</span>
                                                                                    </div>-->
                                            <div class="mr-2">
                                                <span class="text-xs font-medium text-gray-500 text-center">Likes</span>
                                                <span class="text-blue-500 text-sm">{{ $likes['like_count'] }}</span>
                                            </div>
                                            <div>
                                                <span class="text-xs font-medium text-gray-500 text-center">Interesados</span>
                                                <span class="text-blue-500 text-sm">{{ $interests['interest_count'] }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
{{--                        @endif--}}
                    </div>
                </section>
            </div>

            {{--Inventory--}}
            <div v-if="businessTab === 'inventory'"
                 class="mt-4 mb-20 max-w-3xl mx-auto grid grid-cols-1 gap-6 lg:max-w-7xl lg:grid-flow-col-dense lg:grid-cols-3">
                <div class="space-y-6 lg:col-start-1 lg:col-span-12">
                    <section aria-labelledby="business-inventory">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="py-2 md:py-0 sm:px-0">
                                <business-inventory :business="localBusiness"></business-inventory>
                            </div>
                        </div>
                    </section>
                </div>
            </div>

        </div>
    </business-profile>
@endsection
