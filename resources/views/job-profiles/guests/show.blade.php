@extends('layouts.app')

@section('title', e($jobProfile->title))

@section('content')

    <display-job-profile
        :job-profile="{{ json_encode($jobProfile) }}"
        inline-template>
        <div>
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-4 px-2 md:py-6 md:px-4 sm:px-6 lg:px-8">
                    <div class="w-full md:flex md:justify-between items-center">
                        <h2 class="font-semibold text-2xl text-teal-400"></h2>
                    </div>
                </div>
            </header>

            <main class="py-10">
                <div class="max-w-3xl mx-auto px-4 sm:px-6 md:flex align-middle md:items-center md:justify-between md:space-x-5 lg:max-w-7xl lg:px-8">
                    <div class="flex justify-between items-center space-x-5">
                        <div class="flex-shrink-0">
                            <div class="rounded-full border border-emerald-200 hover:border hover:border-emerald-300 bg-white z-20 px-1 py-1 inline-block">
                                <div class="flex">
                                    <label for="job-profile-photo"
                                           class="relative">
                                        @if ($jobProfile->photo)
                                            <img src="{{ str_replace('public', 'storage', $jobProfile->photo) }}"
                                                 class="text-white inline-block object-cover object-center rounded-full h-20 w-20"
                                                 loading="lazy"
                                                 alt="{{ $jobProfile->user->first_name . $jobProfile->user->last_name }}">
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
                        <div class="">
                            <h1 class="text-2xl font-bold text-gray-900" v-text="jobProfile.user.fullName"></h1>
                            <p class="text-sm font-medium text-gray-500" v-text="jobProfile.title"></p>
                        </div>
                    </div>
                </div>

                <div class="mt-4 max-w-3xl mx-auto grid grid-cols-1 gap-6 sm:px-6 lg:max-w-7xl lg:grid-flow-col-dense lg:grid-cols-3">
                    <div class="space-y-6 lg:col-start-1 lg:col-span-12">
                        <!-- Description list-->
                        <section aria-labelledby="job-profile-information">
                            <div class="bg-white shadow sm:rounded-lg">
                                <div class="px-4 py-5 sm:px-6">
                                    <div class="flex justify-between">
                                        <h2 id="job-profile-information" class="text-lg leading-6 font-medium text-gray-900">
                                            Area de Expertiz/Habilidades
                                        </h2>
                                    </div>
                                    <p class="flex mt-2 max-w-2xl text-sm text-gray-500">
                                        <span v-for="skill in jobProfile.skills"
                                              class="flex-shrink-0 shadow-xs mr-2 inline-block px-2 py-0.5 border border-green-200 text-green-800 text-sm font-medium bg-green-100 rounded-full"
                                              v-text="skill"
                                        ></span>
                                    </p>
                                </div>
                                <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                                    <dl class="flex-wrap md:flex sm:justify-between mt-3">
                                        <div class="w-full md:w-1/2 py-1" v-if="localJobProfile.phone">
                                            <dt class="text-sm font-medium text-gray-500">
                                                Telefono
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-900" v-text="localJobProfile.phone"></dd>
                                        </div>
                                        <div class="w-full md:w-1/2 py-1" v-if="localJobProfile.email">
                                            <dt class="text-sm font-medium text-gray-500">
                                                Correo Electrónico
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-900" v-text="localJobProfile.email"></dd>
                                        </div>
                                        <div class="w-full md:w-1/2 py-4">
                                            <dt class="text-sm font-medium text-gray-500">
                                                Edad
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-900" v-text="localJobProfile.age"></dd>
                                        </div>
                                        <div class="w-full md:w-1/2 py-4" v-if="localJobProfile.facebookProfile">
                                            <dt class="text-sm font-medium text-gray-500">
                                                Perfil de Facebook
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-900">
                                                <a :href="localJobProfile.facebookProfile"
                                                   class="h-link"
                                                   target="_blank"
                                                   v-text="localJobProfile.facebookProfile"
                                                ></a>
                                            </dd>
                                        </div>
                                        <div class="w-full md:w-1/2 py-2" v-if="localJobProfile.site">
                                            <dt class="text-sm font-medium text-gray-500">
                                                Sitio Web
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-900">
                                                <a :href="localJobProfile.site"
                                                   class="h-link"
                                                   target="_blank"
                                                   v-text="localJobProfile.site"
                                                ></a>
                                            </dd>
                                        </div>
                                    </dl>
                                    <div class="w-full mt-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Acerca de mi
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900" v-text="localJobProfile.bio"></dd>
                                    </div>
                                </div>
                            </div>

                            <divider title="Dirección"></divider>

                            <job-profile-location></job-profile-location>
                        </section>
                    </div>
                </div>
            </main>

        </div>
    </display-job-profile>

@endsection
