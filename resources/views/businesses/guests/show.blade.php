@extends('layouts.app')

@section('title', e($business->name))

@section('content')
    <display-business :business="{{ json_encode($business) }}" inline-template>
        <div>
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div class="w-full flex justify-between items-center">
                        <h2 class="font-semibold text-2xl text-teal-400"
                            v-text="localBusiness.name"
                        ></h2>
                    </div>
                </div>
            </header>

            <div class="mt-4 max-w-3xl mx-auto grid grid-cols-1 gap-6 sm:px-6 lg:max-w-7xl lg:grid-flow-col-dense lg:grid-cols-3">
                <div class="space-y-6 lg:col-start-1 lg:col-span-12">
                    <!-- Description list-->
                    <section aria-labelledby="business-information">

                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="py-6 sm:px-0">
                                <div>

                                    {{--Business Details--}}
                                    <div class="mt-12">
                                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                                            <div class="px-4 py-5 sm:px-6">
                                                <h3 class="text-lg leading-6 font-medium text-gray-600">
                                                    Detalles del Negocio
                                                </h3>
                                                <div class="flex justify-end">
                                                    <div class="rounded-full border border-emerald-200 hover:border hover:border-emerald-300 bg-white z-20 p-1 inline-block absolute -mt-24">
                                                        <div class="flex">
                                                            <label for="business-logo"
                                                                   class="relative">
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
                                </div>
                            </div>
                            <!-- /End replace -->
                        </div>

                    </section>
                </div>
            </div>

        </div>
    </display-business>
@endsection
