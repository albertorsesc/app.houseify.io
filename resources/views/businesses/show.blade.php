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
                    <div class="w-full md:flex md:justify-between items-center">
                        <h2 class="font-semibold text-2xl text-teal-400"
                            v-text="localBusiness.name"
                        ></h2>
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
                        <div class="w-full md:hidden mt-2">
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
                    </div>
                </div>
            </header>

            <main class="">

                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="py-6 sm:px-0">
                        <div>
                            <div v-if="localBusiness.owner.id === auth && ! localBusiness.location" class="mb-4">
                                <alert :type="'warning'">
                                    Para Publicar el negocio es necesario registrar su Direccion
                                </alert>
                            </div>

                            <div class="w-full mb-2 md:flex">
                                <div class="w-full md:w-1/6 mr-2 mb-2 md:mb-0">
                                    <span class="rounded-md shadow-sm">
                                        {{--Publish/UnPublish--}}
                                        <button @click="toggle"
                                                :disabled="! localBusiness.location"
                                                type="button"
                                                :class="[status.btnClass, ! localBusiness.location ? 'bg-gray-200' : '']"
                                                class="-mt-1 flex shadow-sm justify-center w-full py-3 border border-gray-100 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-50 active:text-gray-800"
                                                :title="localBusiness.status ? 'Ocultar el Negocio del publico...' : 'Hacer publico el Negocio...'">
                                                <svg v-if="! localBusiness.status" class="text-green-300 hover:text-green-400 hover:border-green-100" width="25" height="25" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                <svg v-if="localBusiness.status" class="text-gray-300 hover:text-gray-400 hover:border-gray-100" width="25" height="25" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                                        </button>
                                    </span>
                                </div>
                                <div class="w-full md:w-1/6 mb-2 md:mb-0">
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

                            <div>
                                <!--                            <alert :type="'warning'">Para Publicar la propiedad es necesario registrar su Direccion</alert>

                                                            <alert :type="'primary'">
                                                                Aparece en nuestra
                                                                <a href="#" class="h-link">
                                                                    Busqueda Avanzada
                                                                </a> agregando las Caracteristicas relevantes!
                                                            </alert>

                                                            <alert :type="'info'">
                                                                Al cambiar tu Negocio a "No Publica" podria tomar unos momentos
                                                                para desaparecer de la Busqueda Avanzada.
                                                            </alert>-->

                                <div class="w-full mb-2">
                                    <div class="w-full bg-white shadow overflow-hidden sm:rounded-lg items-center">
                                        <div class="w-full bg-contain bg-center h-44 py-4 object-contain bg-no-repeat"
                                             style="background-image: url(/img/businesses.png)">
                                        </div>
                                        <div class="px-4 py-6 sm:px-10 items-center">
                                            <dl class="px-2">
                                                <divider title="Detalles"></divider>

                                                <div class="md:flex md:justify-between">{{--grid grid-cols-1 gap-x-44 gap-y-8 sm:grid-cols-3--}}
                                                    {{--Status--}}
                                                    <div class="mt-4 md:mt-0">
                                                        <dt class="text-sm font-medium text-gray-500">
                                                            Estatus
                                                        </dt>
                                                        <dd class="mt-1 flex md:mt-3 text-sm text-gray-900">
                                                            <svg v-if="localBusiness.status" class="h-5 w-5 text-green-500"  fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                            <svg v-else class="h-5 w-5 text-gray-500"  fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                                                            <span class="px-2 inline-flex text-base leading-5 font-semibold rounded-full text-gray-500"
                                                                  v-text="localBusiness.status ? 'Publicado' : 'No Publicado'"
                                                            ></span>
                                                        </dd>
                                                    </div>
                                                    {{--Categories--}}
                                                    <div class="mt-4 md:mt-0">
                                                        <dt class="text-sm font-medium text-gray-500">
                                                            Categorias del Negocio
                                                        </dt>
                                                        <div class="flex mt-2 md:mt-3">
                                                            <div class="mr-3"
                                                                 v-for="(category, index) in localBusiness.categories"
                                                                 :key="index">
                                                                <span class="text-xs border-emerald-900 border-1 shadow rounded-full bg-blue-50 px-4 py-2 my-2"
                                                                      v-text="category"
                                                                ></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{--Phone--}}
                                                    <div class="mt-4 md:mt-0" v-if="localBusiness.phone">
                                                        <dt class="text-sm font-medium text-gray-500">
                                                            Telefono
                                                        </dt>
                                                        <dd class="mt-1 md:mt-3 text-sm text-gray-900"
                                                            v-text="localBusiness.phone"
                                                        ></dd>
                                                    </div>
                                                    {{--Email--}}
                                                    <div class="mt-4 md:mt-0" v-if="localBusiness.email">
                                                        <dt class="text-sm font-medium text-gray-500">
                                                            Correo Electronico
                                                        </dt>
                                                        <dd class="mt-1 md:mt-3 text-sm text-gray-900"
                                                            v-text="localBusiness.email"
                                                        ></dd>
                                                    </div>
                                                </div>

                                                <div class="md:flex md:justify-start mt-6">
                                                    {{--Site--}}
                                                    <div class="w-full md:w-1/4 mt-4 md:mt-0" v-if="localBusiness.site">
                                                        <dt class="text-sm font-medium text-gray-500">
                                                            Sitio Web
                                                        </dt>
                                                        <dd class="mt-1 md:mt-3 text-sm text-gray-900">
                                                            <a :href="localBusiness.site"
                                                               class="h-link"
                                                               v-text="localBusiness.site"
                                                            ></a>
                                                        </dd>
                                                    </div>
                                                    {{--UpdatedAt--}}
                                                    <div class="w-full md:w-1/4 mt-4 md:mt-0 md:ml-16">
                                                        <dt class="text-sm font-medium text-gray-500">
                                                            Actualizado hace:
                                                        </dt>
                                                        <dd class="mt-1 md:mt-3 text-sm text-gray-900">
                                                            @{{ localBusiness.meta.updatedAt }}
                                                        </dd>
                                                    </div>
                                                </div>

                                                <divider title="Informacion Adicional"></divider>

                                                <div class="w-full" v-text="localBusiness.comments">
                                                    <dd class="text-sm text-gray-600"
                                                        v-text="localBusiness.comments"
                                                    ></dd>
                                                </div>
                                            </dl>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <divider title="Direccion"></divider>

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
                                                    <div class="mt-2 md:flex rounded-md shadow-sm">
                                                    <span class="inline-flex items-center px-3 rounded-l-md border md:border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                                      houseify.io/directorio-de-negocios/
                                                    </span>
                                                    <span class="p-2 bg-gray-100 flex-1 focus:ring-indigo-500 focus:border-indigo-500 border md:border-r-0 border-gray-300 block w-full min-w-0 rounded-none rounded-r-md text-sm border-gray-300">
                                                    @{{ businessForm.name | toKebabCase }}
                                                    </span>
                                                    </div>
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
                                                                     placeholder="Selecciona las Categorias de Construccion de tu Negocio..."
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
                                                    title="Correo Electronico"
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
                                            class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">
                                        Cancelar
                                    </button>
                                    <button @click="update"
                                            class="h-link ml-2 mt-2 md:mt-0 inline-flex items-center justify-center px-4 py-2 bg-teal-500 border border-gray-200 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:font-semibold hover:shadow-lg hover:bg-teal-400 hover:text-white focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 transition ease-in-out duration-150">
                                        Guardar
                                    </button>
                                </template>
                            </modal>
                        </div>
                    </div>
                    <!-- /End replace -->
                </div>
            </main>
        </div>
    </business-profile>
@endsection
