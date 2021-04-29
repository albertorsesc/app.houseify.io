@extends('layouts.app')

@section('title', 'Perfil de Trabajo')

@section('styles')
    <link rel="stylesheet" href="/css/vue-multiselect.min.css">
@endsection

@section('scripts')
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script>
        let map;

        function initMap() {
            @if ($jobProfile->location && $jobProfile->location->coordinates)
            const coordinates = {
                lat: {{ $jobProfile->location->coordinates['latitude'] }},
                lng: {{ $jobProfile->location->coordinates['longitude'] }}
            }

            let zoom = 15;
            @if ($jobProfile->location && $jobProfile->location->address)
                zoom = 20
            @endif

                map = new google.maps.Map(document.getElementById("map"), {
                center: coordinates,
                zoom: zoom,
            });

            map.addListener('click', function(e) {
                window.location.href = '{{ $jobProfile->location->getGoogleMap() }}'
            });

            new google.maps.Marker({
                position: coordinates,
                map,
                title: "{{ $jobProfile->location->getFullAddress() }}",
            });
            @endif
        }
    </script>

    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.gmaps_api') }}&callback=initMap&libraries=&v=weekly"
        async
    ></script>
@endsection

@section('content')

    <job-profile :job-profile="{{ json_encode($jobProfile) }}"
                 inline-template>
        <div>
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-4 px-2 md:py-6 md:px-4 sm:px-6 lg:px-8">
                    <div class="w-full md:flex md:justify-between items-center">
                        <h2 class="font-semibold text-2xl text-teal-400"></h2>
                        <div class="hidden md:flex md:justify-between">
                            <button v-if="isAuthenticated" class="h-link bg-white -mt-1 mr-1 shadow rounded-md py-2 px-2 hover:text-gray-500 focus:outline-none focus:ring-blue-100 focus:border-blue-300 active:bg-gray-50 active:text-gray-800"
                                    title="Reportar Propiedad...">
                                <svg class="text-yellow-500 hover:text-yellow-600" width="25" height="25" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            </button>
                            <button v-if="isAuthenticated && localJobProfile.user.id === auth" class="h-link bg-white -mt-1 shadow rounded-md py-2 px-2 float-left hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-50 active:text-gray-800"
                                    title="Eliminar Propiedad">
                                <svg class="text-red-500 hover:text-red-600" width="25" height="25"  fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </div>

                        <div class="w-full md:hidden md:mt-2">
                            <button class="h-link bg-white md:-mt-1 md:mr-1 shadow-sm rounded-md py-2 px-2 md:float-left hover:text-gray-500 focus:outline-none active:text-gray-800"
                                    title="Reportar Propiedad...">
                                <svg class="text-yellow-500 hover:text-yellow-600" width="25" height="25" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <main class="py-10">
                <div class="max-w-3xl mx-auto px-4 sm:px-6 md:flex align-middle md:items-center md:justify-between md:space-x-5 lg:max-w-7xl lg:px-8">
                    <div v-if="isAuthenticated && localJobProfile.user.id === auth"
                         class="w-full block md:hidden mb-6">
                        <div class="flex md:flex-col-reverse justify-stretch space-y-3 space-y-reverse sm:flex-row-reverse sm:justify-end sm:space-x-reverse sm:space-y-0 sm:space-x-3 md:mt-0 md:flex-row md:space-x-3">
                            {{--Publish/Unpublish--}}
                            <div class="w-full mx-2 md:mx-4">
                                <span class="rounded-md shadow-sm">
                                    <button @click="toggle"
                                            :disabled="! localJobProfile.location"
                                            type="button"
                                            :class="[status.btnClass, ! localJobProfile.location ? 'bg-gray-200' : '']"
                                            class="-mt-1 flex shadow-sm justify-center w-full py-3 border border-gray-100 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-50 active:text-gray-800"
                                            :title="localJobProfile.status ? 'Ocultar tu Perfil del publico...' : 'Publicar tu Perfil...'">
                                        <span v-if="! localJobProfile.status" class="text-green-300 hover:text-green-400">Publicar</span>
                                        <span v-if="localJobProfile.status" class="text-gray-300 hover:text-gray-400">Ocultar</span>
                                    </button>
                                </span>
                            </div>

                            {{--Update Job Profile--}}
                            <div class="w-full mx-2 md:mx-4">
                                <button @click="openModal('put')"
                                        type="button"
                                        class="-mt-1 items-center shadow-sm w-full py-3 flex justify-center border border-gray-100 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-50 active:text-gray-800"
                                        title="Actualizar Datos del Perfil...">
                                    <span class="text-gray-300">Editar</span>
                                    {{--                                    <svg class="text-yellow-300 hover:text-yellow-400 hover:border-yellow-100" width="25" height="25" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>--}}
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="flex md:justify-between items-center space-x-5">
                        {{--Image--}}
                        <div class="flex-shrink-0">
                            <div class="rounded-full border border-emerald-200 hover:border hover:border-emerald-300 hover:shadow-md bg-white z-20 px-1 py-1 inline-block">
                                <div class="flex">
                                    <label for="file-upload"
                                           class="relative cursor-pointer">
                                        <form action="{{ route('job-profiles.photo.store', $jobProfile) }}"
                                              method="POST"
                                              id="photo-form"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <input id="file-upload"
                                                   name="photo"
                                                   type="file"
                                                   class="hidden sr-only"
                                                   onchange="document.getElementById('photo-form').submit()">
                                        </form>

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

                    <div v-if="isAuthenticated && localJobProfile.user.id === auth"
                         class="hidden md:block w-full md:w-1/3 mt-4 md:float-right">
                        <div class="md:mt-6 flex flex-col-reverse justify-stretch space-y-3 space-y-reverse sm:flex-row-reverse sm:justify-end sm:space-x-reverse sm:space-y-0 sm:space-x-3 md:mt-0 md:flex-row md:space-x-3">
                            {{--Publish/Unpublish--}}
                            <div class="w-full md:mx-4">
                                <span class="rounded-md shadow-sm">
                                    <button @click="toggle"
                                            :disabled="! localJobProfile.location"
                                            type="button"
                                            :class="[status.btnClass, ! localJobProfile.location ? 'bg-gray-200' : '']"
                                            class="-mt-1 flex shadow-sm justify-center w-full py-3 border border-gray-100 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-50 active:text-gray-800"
                                            :title="localJobProfile.status ? 'Ocultar tu Perfil del publico...' : 'Publicar tu Perfil...'">
{{--                                        <span v-if="! localJobProfile.status" class="text-green-300 hover:text-green-400">Publicar</span>--}}
                                        <span v-if="! localJobProfile.status" class="text-green-300 hover:text-green-400">Publicar</span>
                                        <span v-if="localJobProfile.status" class="text-gray-300 hover:text-gray-400">Ocultar</span>
{{--                                            <svg v-if="! localJobProfile.status" class="text-green-300 hover:text-green-400" width="25" height="25" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>--}}
                                        {{--                                            <svg v-if="localJobProfile.status" class="text-gray-300 hover:text-gray-400" width="25" height="25" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>--}}
                                    </button>
                                </span>
                            </div>

                            {{--Update Job Profile--}}
                            <div class="w-full md:mx-4">
                                <button @click="openModal('put')"
                                        type="button"
                                        class="-mt-1 items-center shadow-sm w-full py-3 flex justify-center border border-gray-100 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-50 active:text-gray-800"
                                        title="Actualizar Datos del Perfil...">
                                    {{--                                    <svg class="text-yellow-300 hover:text-yellow-400 hover:border-yellow-100" width="25" height="25" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>--}}
                                    <span class="text-gray-300 hover:text-gray-400">Editar</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 max-w-3xl mx-auto grid grid-cols-1 gap-6 sm:px-6 lg:max-w-7xl lg:grid-flow-col-dense lg:grid-cols-3">
                    <div class="space-y-6 lg:col-start-1"
                         :class="[isAuthenticated && localJobProfile.user.id === auth ? 'lg:col-span-2' : 'lg:col-span-12']">
                        <!-- Description list-->
                        <section aria-labelledby="job-profile-information">
                            <div class="bg-white shadow sm:rounded-lg">
                                <div class="px-4 py-4 sm:px-6">
                                    <div class="flex justify-between">
                                        <h2 id="job-profile-information" class="text-lg leading-6 font-medium text-gray-900">
                                            Area de Expertiz/Habilidades
                                        </h2>
                                        <div v-if="isAuthenticated" {{--&& localJobProfile.user.id !== auth--}}
                                             class="flex items-center align-middle">
                                            {{--Likes--}}
                                            <span class="mr-2">
                                                <likes :endpoint="`/job-profiles/${localJobProfile.uuid}`"
                                                       :model="localJobProfile"
                                                       :model-id="localJobProfile.uuid"
                                                ></likes>
                                            </span>
                                            <span class="-mt-4 -mr-6">
                                                {{--InterestedBtn--}}
                                                <interested-btn :model="localJobProfile"
                                                                :id="localJobProfile.uuid"
                                                                model-name="job-profiles"
                                                                endpoint="/job-profiles"
                                                                icon-size="h-8 w-8"
                                                ></interested-btn>
                                            </span>
                                        </div>
                                    </div>
                                    <p class="flex max-w-2xl text-sm text-gray-500 align-middle items-center"
                                       :class="isAuthenticated && localJobProfile.user.id === auth ? 'mt-3' : 'mt-0'">
                                        <span v-for="skill in jobProfile.skills"
                                              class="flex-shrink-0 shadow-xs mr-2 inline-block px-2 py-0.5 border border-green-200 text-green-800 text-sm font-medium bg-green-100 rounded-full"
                                              :class="isAuthenticated && localJobProfile.user.id === auth ? '-mt-0' : '-mt-3'"
                                              v-text="skill"
                                        ></span>
                                    </p>
                                </div>
                                <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                                    <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                                        <div class="sm:col-span-1">
                                            <dt class="text-sm font-medium text-gray-500">
                                                Estatus del Perfil
                                            </dt>
                                            <dd class="mt-1 flex text-sm text-gray-900">
                                                <svg v-if="localJobProfile.status" class="h-5 w-5 text-green-500"  fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                <svg v-else class="h-5 w-5 text-gray-500"  fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                                                <span class="px-2 inline-flex text-base leading-5 font-semibold rounded-full text-gray-500"
                                                      v-text="localJobProfile.status ? 'Publicado' : 'No Publicado'"
                                                ></span>
                                            </dd>
                                        </div>
                                        <div v-if="localJobProfile.phone" class="sm:col-span-1">
                                            <dt class="text-sm font-medium text-gray-500">
                                                Teléfono
                                            </dt>
                                            <dd v-text="formatPhone(localJobProfile.phone)"
                                                class="mt-1 text-sm text-gray-900"
                                            ></dd>
                                        </div>
                                        <div v-if="localJobProfile.email" class="sm:col-span-1">
                                            <dt class="text-sm font-medium text-gray-500">
                                                Correo Electrónico
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-900"
                                                v-text="localJobProfile.email"
                                            ></dd>
                                        </div>
                                        <div v-if="localJobProfile.facebookProfile" class="sm:col-span-1">
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
                                        <div v-if="localJobProfile.linkedinProfile" class="sm:col-span-1">
                                            <dt class="text-sm font-medium text-gray-500">
                                                Perfil de LinkedIn
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-900">
                                                <a :href="localJobProfile.linkedinProfile"
                                                   class="h-link"
                                                   target="_blank"
                                                   v-text="localJobProfile.linkedinProfile"
                                                ></a>
                                            </dd>
                                        </div>
                                        <div v-if="localJobProfile.site" class="sm:col-span-1">
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
                                    <div v-if="localJobProfile.bio"
                                         class="w-full mt-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Acerca de mi
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900" v-text="localJobProfile.bio"></dd>
                                    </div>
                                </div>
                            </div>

                            <divider title="Dirección"></divider>

                            <job-profile-location></job-profile-location>

                            @if ($jobProfile->location && $jobProfile->location->coordinates)
                                <divider title="Mapa"></divider>

                                {{--Mapa--}}
                                <div class="flex">
                                    <div class="w-full bg-white rounded-lg shadow p-3">
                                        <div id="map" class="rounded-lg border-gray-300 h-80"></div>
                                    </div>
                                </div>
                            @endif
                        </section>
                    </div>

                    <!-- Activity Feed -->
                    <section v-if="isAuthenticated && jobProfile.user.id === auth"
                             aria-labelledby="timeline-title"
                             class="lg:col-start-3 lg:col-span-1">
                        <div class="bg-white px-4 py-5 shadow sm:rounded-lg sm:px-6">
                            <h2 id="timeline-title" class="text-lg font-medium text-gray-900">Actividad</h2>
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
                    </section>
                </div>

                <modal v-if="isAuthenticated && localJobProfile.user.id === auth"
                       modal-id="update-job-profile"
                       max-width="sm:max-w-5xl">
                    <template #title>Actualizar Datos de tu Perfil</template>
                    <template #content>
                        <form @submit.prevent>

                            <div class="w-full md:flex md:-mx-2 mt-4">
                                <div class="w-full md:mx-2">
                                    <form-input
                                        title="Titulo del Perfil"
                                        v-model="jobProfileForm.title"
                                        :data="jobProfileForm.title"
                                        input-id="title"
                                        :is-required="true"
                                        :error="errors.title"
                                    ></form-input>
                                </div>
                            </div>

                            <div class="w-full md:flex md:-mx-2 mt-4">
                                <div class="w-full md:mx-2 mt-3 md:mt-0">
                                    <label for="skills">
                                        Habilidades de Trabajo
                                        <span class="text-gray-500 font-light text-xs">(requerido)</span>
                                    </label>
                                    <div class="my-1 rounded-md shadow-sm text-base">
                                        <vue-multiselect v-model="selectedSkills"
                                                         :placeholder="''"
                                                         :options="getSkills"
                                                         :multiple="true"
                                                         :taggable="true"
                                                         :hide-selected="true"
                                                         id="skills"
                                                         :searchable="true"
                                                         :close-on-select="false"
                                                         select-label=""
                                                         selected-label=""
                                                         deselect-label=""
                                                         :tag-placeholder="''"
                                                         placeholder="Selecciona tus Habilidades de Trabajo..."
                                        ></vue-multiselect>
                                    </div>
                                    <errors :error="errors.skills"
                                            :options="{ noContainer: true }"
                                    ></errors>
                                </div>
                            </div>

                            <div class="w-full md:flex md:-mx-2 mt-4">
                                <div class="w-full md:w-1/2 md:mx-2 mt-3 md:mt-0">
                                    <form-input
                                        title="Correo Electrónico"
                                        v-model="jobProfileForm.email"
                                        :data="jobProfileForm.email"
                                        input-id="email"
                                        :error="errors.email"
                                    ></form-input>
                                </div>
                                <div class="w-full md:w-1/2 md:mx-2 mt-3 md:mt-0">
                                    <form-input
                                        title="Teléfono"
                                        v-model="jobProfileForm.phone"
                                        :data="jobProfileForm.phone"
                                        input-id="phone"
                                        :error="errors.phone"
                                    ></form-input>
                                </div>
                            </div>

                            <div class="w-full md:flex md:-mx-2 mt-4">
                                <div class="w-full md:w-1/2 md:mx-2 mt-3 md:mt-0">
                                    <form-input
                                        title="Perfil de Facebook (URL)"
                                        v-model="jobProfileForm.facebookProfile"
                                        :data="jobProfileForm.facebookProfile"
                                        input-id="facebook_profile"
                                        :error="errors.facebook_profile"
                                    ></form-input>
                                </div>
                                <div class="w-full md:w-1/2 md:mx-2 mt-3 md:mt-0">
                                    <form-input
                                        title="Perfil de LinkedIn (URL)"
                                        v-model="jobProfileForm.linkedinProfile"
                                        :data="jobProfileForm.linkedinProfile"
                                        input-id="linkedin_profile"
                                        :error="errors.linkedin_profile"
                                    ></form-input>
                                </div>
                                <div class="w-full md:w-1/2 md:mx-2 mt-3 md:mt-0">
                                    <form-input
                                        title="Sitio Web"
                                        v-model="jobProfileForm.site"
                                        :data="jobProfileForm.site"
                                        input-id="site"
                                        :error="errors.site"
                                    ></form-input>
                                </div>
                            </div>

                            <div class="w-full my-6 md:mt-2">
                                <div>
                                    <label for="bio">
                                        Comentarios
                                        <span class="text-gray-500 font-light text-xs">(opcional)</span>
                                    </label>
                                    <div class="mt-1">
                                        <textarea v-model="jobProfileForm.bio"
                                                  id="bio"
                                                  class="block rounded-md shadow-sm w-full outline-none border-emerald-200 bg-gray-50 focus:bg-white"
                                                  rows="5"
                                        ></textarea>
                                    </div>
                                    <errors :error="errors.bio"
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
            </main>

        </div>
    </job-profile>

@endsection
