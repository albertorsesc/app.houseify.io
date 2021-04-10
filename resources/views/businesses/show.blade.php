@extends('layouts.app')

@section('title', e($business->name))

@section('styles')
    <link rel="stylesheet" href="/css/vue-multiselect.min.css">
@endsection

@section('content')
    <business-profile :business="{{ json_encode($business) }}" inline-template>
        <div>
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div class="w-full flex justify-between items-center">
                        <h2 class="font-semibold text-2xl text-teal-400"
                            v-text="localBusiness.name"
                        ></h2>
                        @auth
                        <div class="hidden md:flex md:justify-between">
                            <report :model-id="localBusiness.slug" model-name="businesses" inline-template>
                                <div>
                                    <button @click="openModal" class="h-link bg-white -mt-1 mr-1 shadow-sm rounded-md py-2 px-2 float-left hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-50 active:text-gray-800"
                                            title="Reportar Propiedad...">
                                        <svg class="text-yellow-500 hover:text-yellow-600 hover:border-yellow-700 hover:border" width="25" height="25" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
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
                            <button class="h-link bg-white border-emerald-900 -mt-1 shadow rounded-md py-2 px-2 float-left hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-50 active:text-gray-800"
                                    title="Eliminar Negocio">
                                <svg class="text-red-500 hover:text-red-600 hover:border-red-700 hover:border" width="25" height="25"  fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </div>

                        {{--Mobile Header--}}
                        <div class="w-full flex justify-end md:hidden mt-2">
                            <report :model-id="localBusiness.slug" model-name="businesses" inline-template>
                                <div>
                                    <button @click="openModal" class="h-link bg-white -mt-1 mr-1 shadow-sm rounded-md py-2 px-2 float-left hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-50 active:text-gray-800"
                                            title="Reportar Propiedad...">
                                        <svg class="text-yellow-500 hover:text-yellow-600 hover:border-yellow-700 hover:border" width="25" height="25" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
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
                        </div>
                        @endauth
                    </div>
                </div>
            </header>

            <div class="mt-4 max-w-3xl mx-auto grid grid-cols-1 gap-6 sm:px-6 lg:max-w-7xl lg:grid-flow-col-dense lg:grid-cols-3">
                <div class="space-y-6 lg:col-start-1"
                     :class="[isAuthenticated && localBusiness.owner.id === auth ? 'lg:col-span-2' : 'lg:col-span-12']">
                    <!-- Description list-->
                    <section aria-labelledby="business-information">

                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="py-6 sm:px-0">
                                <div>
                                    <div v-if="localBusiness.owner.id === auth && ! localBusiness.location" class="mb-4">
                                        <alert :type="'warning'">
                                            Para Publicar el negocio es necesario registrar su Dirección
                                        </alert>
                                    </div>

                                    {{--Likes--}}
                                    <div v-if="isAuthenticated"
                                         class="w-1/2 md:w-4/5 mb-2 items-end align-middle flex justify-end">
                                        <div class="w-1/12 md:w-4/5 md:flex md:justify-end ">
                                            <likes
                                                :endpoint="`/businesses/${localBusiness.slug}`"
                                                :model="localBusiness"
                                            ></likes>
                                        </div>
                                    </div>

                                    {{--Business Details--}}
                                    <div :class="isAuthenticated ? '' : 'mt-6'">
                                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                                            <div class="px-4 py-5 sm:px-6">
                                                <h3 class="text-lg leading-6 font-medium text-gray-600">
                                                    Detalles del Negocio
                                                </h3>
                                                <div class="flex justify-end">
                                                    <div class="rounded-full border border-emerald-200 hover:border hover:border-emerald-300 hover:ml-2 hover:shadow-md bg-white z-20 p-1 inline-block absolute -mt-24">
                                                        <div class="flex">
                                                            <label for="file-upload"
                                                                   class="relative cursor-pointer">
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
                                                        <dd class="mt-2 text-sm flex text-gray-900">
                                                            <div class="mr-3"
                                                                 v-for="(category, index) in localBusiness.categories"
                                                                 :key="index">
                                                            <span class="px-3 py-1 text-sm bg-emerald-100 font-medium leading-5 text-emerald-900 rounded-full shadow-sm"
                                                                  v-text="category"
                                                            ></span>
                                                            </div>
                                                        </dd>
                                                    </div>
                                                    <div class="sm:col-span-1">
                                                        <dt class="text-sm font-medium text-gray-500">
                                                            Correo Electrónico
                                                        </dt>
                                                        <dd class="mt-1 text-sm text-gray-900" v-text="localBusiness.email"></dd>
                                                    </div>
                                                    <div class="sm:col-span-1">
                                                        <dt class="text-sm font-medium text-gray-500">
                                                            Telefono
                                                        </dt>
                                                        <dd class="mt-1 text-sm text-gray-900" v-text="localBusiness.phone"></dd>
                                                    </div>
                                                    <div class="sm:col-span-1">
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
                                                    <div class="sm:col-span-2">
                                                        <dt class="text-sm font-medium text-gray-500">
                                                            Informacion Adicional
                                                        </dt>
                                                        <dd class="mt-1 text-sm text-gray-900" v-text="localBusiness.comments"></dd>
                                                    </div>
                                                </dl>
                                            </div>
                                        </div>
                                    </div>

                                    <divider title="Dirección"></divider>

                                    <business-location></business-location>

                                    <divider title="Mapa" v-if="localBusiness.location"></divider>

                                    <!--                        <div class="mt-2 flex">
                                                                <div class="w-full mt-2">
                                                                    <div class="border-gray-300 h-auto"></div>
                                                                </div>
                                                            </div>-->

                                    <divider title="Comentarios"></divider>

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

                                    <modal modal-id="update-business" max-width="sm:max-w-5xl">
                                        <template #title>Actualizar Datos de tu Negocio</template>
                                        <template #content>
                                            <form @submit.prevent>

                                                <div class="w-full md:flex md:-mx-2 mt-4">
                                                    <div class="w-full md:mx-2">
                                                        <div class="w-full">
                                                            <form-input
                                                                title="Nombre del Negocio"
                                                                v-model="businessForm.name"
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
                                                        <div class="my-1 rounded-md shadow-sm text-base">
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
                                                    <div class="w-full md:w-1/3 md:mx-2 mt-3 md:mt-0">
                                                        <form-input
                                                            title="Correo Electrónico"
                                                            v-model="businessForm.email"
                                                            :data="businessForm.email"
                                                            input-id="email"
                                                            :error="errors.email"
                                                        ></form-input>
                                                    </div>
                                                    <div class="mt-2 md:mt-0 w-full md:w-1/3 md:mx-2">
                                                        <form-input
                                                            title="Telefono"
                                                            v-model="businessForm.phone"
                                                            :data="businessForm.phone"
                                                            input-id="phone"
                                                            :error="errors.phone"
                                                        ></form-input>
                                                    </div>
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

                                                <div class="w-full my-6 md:mt-2">
                                                    <div>
                                                        <label for="comments">Comentarios</label>
                                                        <div class="mt-1">
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
                            <!-- /End replace -->
                        </div>

                    </section>
                </div>

                <section v-if="isAuthenticated && localBusiness.owner.id === auth"
                         aria-labelledby="timeline-title" class="lg:col-start-3 lg:col-span-1">
                    <div class="md:mt-6">
                        <div class="md:flex mb-2">
                            <div class="w-full md:w-1/2 mr-2 mb-2 md:mb-0">
                                <span class="rounded-md shadow-sm">
                                    {{--Publish/UnPublish--}}
                                    <button @click="toggle"
                                            :disabled="! localBusiness.location"
                                            type="button"
                                            :class="[status.btnClass, ! localBusiness.location ? 'bg-gray-200' : '']"
                                            class="-mt-1 flex shadow-sm justify-center w-full py-3 border border-gray-100 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-50 active:text-gray-800"
                                            :title="localBusiness.status ? 'Ocultar mi Negocio del publico...' : 'Publicar mi Negocio...'">
                                            <svg v-if="! localBusiness.status" class="text-green-300 hover:text-green-400 hover:border-green-100" width="25" height="25" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                            <svg v-if="localBusiness.status" class="text-gray-300 hover:text-gray-400 hover:border-gray-100" width="25" height="25" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                                    </button>
                                </span>
                            </div>
                            <div class="w-full md:w-1/2 mb-2 md:mb-0">
                                <span class="rounded-md shadow-sm">
                                    <button @click="openModal('put')"
                                            type="button"
                                            class="-mt-1 items-center shadow-sm w-full py-3 flex justify-center border border-gray-100 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-50 active:text-gray-800"
                                            title="Actualizar Datos del Negocio...">
                                        <svg class="text-yellow-300 hover:text-yellow-400 hover:border-yellow-100" width="25" height="25" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div class="bg-white px-4 py-5 shadow sm:rounded-lg sm:px-6">
                            <h2 id="timeline-title" class="text-lg font-medium text-gray-900">Actividad</h2>

                            <!-- Activity Feed -->
                            <div class="mt-6 flow-root">
                                <ul class="-mb-8 pb-12">
                                    <li>
                                        <div class="relative pb-8">
                                            <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                            <div class="relative flex space-x-3">
                                                <div>
                                              <span class="h-8 w-8 rounded-full bg-white border border-yellow-300 flex items-center justify-center ring-8 ring-white">
                                                  <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                                    </svg>
                                              </span>
                                                </div>
                                                <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                                    <div>
                                                        <p class="text-sm text-gray-500">Dio una Calificacion de <a href="#" class="font-medium text-gray-900">9</a></p>
                                                    </div>
                                                    <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                                        <time datetime="2020-09-20">Sep 20</time>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                    <li>
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
                                    </li>

                                    <li>
                                        <div class="relative pb-8">
                                            {{--                                    <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>--}}
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
                                                        <p class="text-sm text-gray-500">Completed phone screening with <a href="#" class="font-medium text-gray-900">Martha Gardner</a></p>
                                                    </div>
                                                    <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                                        <time datetime="2020-09-28">Sep 28</time>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="mt-6 flex flex-col justify-stretch">
                                <div class="block bg-gray-50 px-4 py-4 hover:text-gray-700 sm:rounded-b-lg">
                                    <div class="flex justify-center justify-between">
                                        <div>
                                            <span class="text-xs font-medium text-gray-500 text-center">Visitas</span>
                                            <span class="text-blue-500 text-sm">23</span>
                                        </div>
                                        <div>
                                            <span class="text-xs font-medium text-gray-500 text-center">Calificacion</span>
                                            <span class="text-blue-500 text-sm">15.3</span>
                                        </div>
                                        <div>
                                            <span class="text-xs font-medium text-gray-500 text-center">Interesados</span>
                                            <span class="text-blue-500 text-sm">12</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

        </div>
    </business-profile>
@endsection
