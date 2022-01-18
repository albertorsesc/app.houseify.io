<nav-bar inline-template>
    <nav class="bg-gradient-to-r from-emerald-400 to-cyan-400 sticky top-0 lg:my-0 absolute z-50" v-cloak>
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <a href="{{ route('dashboard') }}" class="h-link">
                            <img src="{{ asset('/logos/houseify-2.png') }}"
                                 height="130"
                                 width="130"
                                 class="object-fit -mt-2"
                                 alt="Houseify.io">
                        </a>
                    </div>

                    <div class="hidden sm:-my-px sm:ml-6 md:flex sm:space-x-8">
                        @auth
                        <div class="ml-10 flex items-baseline space-x-4">
                            <a href="{{ route('dashboard') }}"
                               class="h-link border-transparent text-white font-semibold hover:border-white hover:text-gray-50 inline-flex items-center px-1 pt-1 border-b-2 text-xl"
                               :class="{{ request()->routeIs('dashboard') ? '"border-white border-b-2"' : '' }}">
                                Inicio
                            </a>
                            <a href="{{ route('web.properties.index') }}"
                               class="h-link border-transparent text-white font-semibold hover:border-white hover:text-gray-50 inline-flex items-center px-1 pt-1 border-b-2 text-xl"
                               :class="{{ request()->routeIs('web.properties.index') || request()->segment(1) === 'propiedades' ? '"border-white border-b-2"' : '' }}">
                                Propiedades
                            </a>
                            <a href="{{ route('web.businesses.index') }}"
                               class="h-link border-transparent text-white font-semibold hover:border-white hover:text-gray-50 inline-flex items-center px-1 pt-1 border-b-2 text-xl"
                               :class="{{ request()->routeIs('web.businesses.index') || request()->segment(1) === 'directorio-de-negocios' ? '"border-white border-b-2"' : '' }}">
                                Negocios
                            </a>
                            <a href="{{ route('web.job-profiles.index') }}"
                               class="h-link border-transparent text-white font-semibold hover:border-white hover:text-gray-50 inline-flex items-center px-1 pt-1 border-b-2 text-xl"
                               :class="{{ request()->routeIs('web.job-profiles.index') || request()->segment(1) === 'tecnicos-y-profesionales' ? '"border-white border-b-2"' : '' }}">
                                Profesionales
                            </a>
                        </div>
                        @endauth
                        @guest
                        <div class="ml-10 flex items-baseline space-x-4">
                            <a href="{{ route('web.public.properties.index') }}"
                               class="h-link border-transparent text-white font-semibold hover:border-white hover:text-gray-50 inline-flex items-center px-1 pt-1 border-b-2 text-xl"
                               :class="{{ request()->routeIs('web.properties.index') || request()->segment(1) === 'propiedades' ? '"border-white border-b-2"' : '' }}">
                                Propiedades
                            </a>
                            <a href="{{ route('web.public.businesses.index') }}"
                               class="h-link border-transparent text-white font-semibold hover:border-white hover:text-gray-50 inline-flex items-center px-1 pt-1 border-b-2 text-xl"
                               :class="{{ request()->routeIs('web.public.businesses.index') || request()->segment(2) === 'directorio-de-negocios' ? '"border-white border-b-2"' : '' }}">
                                Negocios
                            </a>
                            <a href="{{ route('web.public.job-profiles.index') }}"
                               class="h-link border-transparent text-white font-semibold hover:border-white hover:text-gray-50 inline-flex items-center px-1 pt-1 border-b-2 text-xl"
                               :class="{{ request()->routeIs('web.public.job-profiles.index') || request()->segment(2) === 'tecnicos-y-profesionales' ? '"border-white border-b-2"' : '' }}">
                                Profesionales
                            </a>
                            <a href="{{ route('web.threads.index') }}"
                               class="h-link border-transparent text-white font-semibold hover:border-white hover:text-gray-50 inline-flex items-center px-1 pt-1 border-b-2 text-xl"
                               :class="{{ request()->routeIs('web.threads.index') || request()->segment(1) === 'forum' ? '"border-white border-b-2"' : '' }}">
                                Foro
                            </a>
                        </div>
                        <div class="ml-10 flex justify-end items-end space-x-4">
                            <a href="{{ route('login') }}"
                               class="h-link border-transparent text-white font-semibold hover:border-white hover:text-gray-50 inline-flex items-center px-1 pt-1 border-b-2 text-xl"
                               :class="{{ request()->routeIs('login') ? '"border-white border-b-2"' : '' }}">
                                Iniciar Sesión
                            </a>
                            <a href="{{ route('register') }}"
                               class="h-link border-transparent text-white font-semibold hover:border-white hover:text-gray-50 inline-flex items-center px-1 pt-1 border-b-2 text-xl"
                               :class="{{ request()->routeIs('register') ? '"border-white border-b-2"' : '' }}">
                                Registrarme
                            </a>
                        </div>
                        @endguest
                    </div>
                </div>
                @auth
                <div class="hidden md:block">
                    <div class="ml-4 flex items-center md:ml-6">
                        {{--<button class="bg-white p-1 rounded-full text-emerald-400 font-semibold hover:bg-gray-100 hover:text-emerald-500 hover:font-semibold focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                            <span class="sr-only">View notifications</span>
                            <!-- Heroicon name: bell -->
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </button>--}}
                        <!-- Profile dropdown -->
                        <div class="ml-3 relative">
                            <div>
                                <button @click="open = ! open" class="max-w-xs bg-gray-800 rounded-full flex items-center text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-emerald-400 focus:ring-white" id="user-menu" aria-haspopup="true">
                                    <span class="sr-only">Open user menu</span>
                                    <img class="h-8 w-8 rounded-full"
                                         src="{{ Auth::user()->getAvatar() }}" alt="" />
                                </button>
                            </div>
                            <transition name="fade" appear>
                                <div v-show="open"
                                     class="fixed inset-0 transform transition-all"
                                     @click="open = false">
                                    <div class="absolute inset-0 bg-gray-500 opacity-0"></div>
                                </div>
                            </transition>

{{--                                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>--}}
                            <!--
                              Profile dropdown panel, show/hide based on dropdown state.

                              Entering: "transition ease-out duration-100"
                                From: "transform opacity-0 scale-95"
                                To: "transform opacity-100 scale-100"
                              Leaving: "transition ease-in duration-75"
                                From: "transform opacity-100 scale-100"
                                To: "transform opacity-0 scale-95"
                            -->
                            <transition name="fade" appear>
                                <div v-show="open" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5"
                                     role="menu"
                                     aria-orientation="vertical"
                                     aria-labelledby="user-menu">
                                    <a href="{{ route('profile.show') }}"
                                       class="h-link block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                       :class="{{ request()->routeIs('profile.show') ? '"border-white border-b-2"' : '' }}"
                                       role="menuitem">
                                        Perfil
                                    </a>

                                    <a href="{{ route('web.threads.index') }}"
                                       class="h-link block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                       :class="{{ request()->routeIs('web.threads.index') ? '"border-white border-b-2"' : '' }}"
                                       role="menuitem">
                                        Foro
                                    </a>
                                    <a href="{{ route('web.suggestions.index') }}"
                                       class="h-link block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                       :class="{{ request()->routeIs('web.suggestions.index') ? '"border-white border-b-2"' : '' }}"
                                       role="menuitem">
                                        Sugerencias
                                    </a>

                                    <a href="{{ route('web.roadmap.index') }}"
                                       class="h-link block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                       :class="{{ request()->routeIs('web.roadmap.index') ? '"border-white border-b-2"' : '' }}"
                                       role="menuitem">
                                        Novedades
                                    </a>
                                    {{--
                                    <a href="/docs"
                                       class="h-link block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                       role="menuitem">
                                        Ayuda
                                    </a>--}}

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-jet-dropdown-link href="{{ route('logout') }}"
                                                             onclick="event.preventDefault();
                                        this.closest('form').submit();
                                        window.localStorage.removeItem('me');
                                        window.localStorage.removeItem('app')">
                                            {{ __('Cerrar Sesión') }}
                                        </x-jet-dropdown-link>
                                    </form>
                                </div>
                            </transition>
                        </div>
                    </div>
                </div>
                @endauth
                <!-- Mobile menu button -->
                <div class="-mr-2 flex md:hidden">
                    <button @click="isMobileOpen = ! isMobileOpen"
                            class="bg-white inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-emerald-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-emerald-600 focus:ring-white">
                        <span class="sr-only">Open main menu</span>
                        <svg class="block h-6 w-6 text-emerald-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div v-if="isMobileOpen" class="block md:hidden bg-white rounded-lg shadow-md mx-2 mb-4">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                @auth
                    <a href="{{ route('dashboard') }}"
                       class="text-gray-700 block px-3 py-2 rounded-md text-base font-medium"
                       :class="{{ request()->routeIs('dashboard') || request()->segment(1) === 'inicio' ? '"bg-gray-100 border-white border-b-2"' : '' }}">
                        Inicio
                    </a>

                    <a href="{{ route('web.properties.index') }}"
                       class="text-gray-500 hover:bg-gray-100 hover:text-white block px-3 py-2 rounded-md text-base font-medium"
                       :class="{{ request()->routeIs('web.properties.index') || request()->segment(1) === 'propiedades' ? '"bg-gray-100 border-white border-b-2"' : '' }}">
                        Propiedades
                    </a>

                    <a href="{{ route('web.businesses.index') }}"
                       class="text-gray-500 hover:bg-gray-100 hover:text-white block px-3 py-2 rounded-md text-base font-medium"
                       :class="{{ request()->routeIs('web.businesses.index') || request()->segment(1) === 'directorio-de-negocios' ? '"bg-gray-100 border-white border-b-2"' : '' }}">
                        Negocios
                    </a>

                    <a href="{{ route('web.job-profiles.index') }}"
                       class="text-gray-500 hover:bg-gray-100 hover:text-white block px-3 py-2 rounded-md text-base font-medium"
                       :class="{{ request()->routeIs('web.job-profiles.index') || request()->segment(1) === 'tecnicos-y-profesionales' ? '"bg-gray-100 border-white border-b-2"' : '' }}">
                        Profesionales
                    </a>
                @endauth
                @guest
                    <a href="{{ route('web.public.properties.index') }}"
                       class="text-gray-500 hover:bg-gray-100 hover:text-white block px-3 py-2 rounded-md text-sm font-medium"
                       :class="{{ request()->routeIs('web.public.properties.index') ? '"bg-gray-100 border-white border-b-2"' : '' }}">
                        Propiedades
                    </a>
                    <a href="{{ route('web.public.businesses.index') }}"
                       class="text-gray-500 hover:bg-gray-100 hover:text-white block px-3 py-2 rounded-md text-sm font-medium"
                       :class="{{ request()->routeIs('web.public.businesses.index') ? '"bg-gray-100 border-white border-b-2"' : '' }}">
                        Negocios
                    </a>
                    <a href="{{ route('web.public.job-profiles.index') }}"
                       class="text-gray-500 hover:bg-gray-100 hover:text-white block px-3 py-2 rounded-md text-sm font-medium"
                       :class="{{ request()->routeIs('web.public.job-profiles.index') ? '"bg-gray-100 border-white border-b-2"' : '' }}">
                        Profesionales
                    </a>
                    <a href="{{ route('web.threads.index') }}"
                       class="text-gray-500 hover:bg-gray-100 hover:text-white block px-3 py-2 rounded-md text-sm font-medium"
                       :class="{{ request()->routeIs('web.threads.index') ? '"bg-gray-100 border-white border-b-2"' : '' }}">
                        Foro
                    </a>
                    <a href="{{ route('login') }}"
                       class="text-gray-500 hover:bg-gray-100 hover:text-white block px-3 py-2 rounded-md text-sm font-medium"
                       :class="{{ request()->routeIs('login') ? '"bg-gray-100 border-white border-b-2"' : '' }}">
                        Iniciar Sesión
                    </a>
                    <a href="{{ route('register') }}"
                       class="text-gray-500 hover:bg-gray-100 hover:text-white block px-3 py-2 rounded-md text-sm font-medium"
                       :class="{{ request()->routeIs('register') ? '"bg-gray-100 border-white border-b-2"' : '' }}">
                        Registrarme
                    </a>
                @endguest
            </div>
            @auth
                <div class="pt-4 pb-3 border-t py-1 border-emerald-600">
                    <div class="flex items-center align-middle px-5">
                        <div class="flex-shrink-0">
                            <img class="h-12 w-12 rounded-full" src="{{ Auth::user()->getAvatar() }}" alt="" />
                        </div>
                        <div class="ml-3">
                            <div class="text-sm font-semibold leading-none text-gray-700">{{ auth()->user()->fullName() }}</div>
                            <div class="mt-2 text-sm font-medium leading-none text-gray-400">{{ auth()->user()->email }}</div>
                        </div>
                        {{--<button class="ml-auto bg-gray-100 flex-shrink-0 p-1 rounded-full text-gray-400 hover:text-emerald-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-emerald-800 focus:ring-white">
                            <span class="sr-only">Ver notificaciones</span>
                            <!-- Heroicon name: bell -->
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </button>--}}
                    </div>
                    <div class="mt-3 px-2 space-y-1">
                        <a href="{{ route('profile.show') }}"
                           class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700"
                           :class="{{ request()->routeIs('profile.show') || request()->segment(1) === 'profile' ? '"bg-gray-100 border-white border-b-2"' : '' }}"
                           role="menuitem">
                            Perfil
                        </a>
                        <a href="{{ route('web.suggestions.index') }}"
                           class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700"
                           :class="{{ request()->routeIs('web.suggestions.index') || request()->segment(1) === 'sugerencias' ? '"bg-gray-100 border-white border-b-2"' : '' }}"
                           role="menuitem">
                            Sugerencias
                        </a>

                        <a href="{{ route('web.roadmap.index') }}"
                           class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700"
                           :class="{{ request()->routeIs('web.roadmap.index') || request()->segment(1) === 'novedades' ? '"bg-gray-100 border-white border-b-2"' : '' }}"
                           role="menuitem">
                            Novedades
                        </a>
                        {{--
                        <a href="/docs"
                           class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700"
                           :class="{{ request()->routeIs('/docs') ? '"bg-gray-100 border-white border-b-2"' : '' }}"
                           role="menuitem">
                            Ayuda
                        </a>--}}

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();this.closest('form').submit();"
                               class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700">
                                Cerrar Sesión
                            </a>
                        </form>
                    </div>
                </div>
            @endauth
        </div>
    </nav>
</nav-bar>

