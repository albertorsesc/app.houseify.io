<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-teal-400 leading-tight">
            Bienvenid@s a Houseify.io
        </h2>
    </x-slot>

{{--            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">--}}
{{--                <x-jet-welcome />--}}
{{--            </div>--}}
    <div class="md:flex md:justify-between md:justify-center">
        {{--Properties--}}
        <div class="w-full md:w-1/2 xl:w-1/3 px-3 mt-4 md:mt-0">
            <a href="{{ route('web.properties.index') }}">
                <div class="card transition hover:transform text-center items-center">
                    <img src="/img/properties.png" class="object-cover" alt="Propiedades">
                    <div class="px-4 py-2">
                        <div class="font-bold text-gray-900 text-xl mb-2">
                            Propiedades
                        </div>
                        <p class="text-gray-700 text-base pb-4">
                            Explora las Propiedades disponibles!
                        </p>
                    </div>
                </div>
            </a>
        </div>

        {{--Businesses--}}
        <div class="w-full md:w-1/2 xl:w-1/3 px-3 mt-4 md:mt-0">
            <a href="#">
                <div class="card transition hover:transform text-center items-center">
                    <img src="/img/businesses.png"
                         class="object-center"
                         alt="Negocios en el ramo constructor"
                         loading="lazy">
                    <div class="px-4 py-1">
                        <div class="font-bold text-gray-900 text-xl mb-1">
                            Directorio de Negocios
                        </div>
                        <p class="text-gray-700 text-base pb-1">
                            Anuncia y Encuentra Proveedores relacionados al ramo de Construccion!
                        </p>
                    </div>
                </div>
            </a>
        </div>

        {{--Ads--}}
        <div class="w-full md:w-1/2 xl:w-1/3 px-3 mt-4 md:mt-0">
            <a href="#">
                <div class="card transition hover:transform text-center items-center">
                    <img src="/img/ads.png" class="object-fill" alt="Anuncios Publicitarios" loading="lazy">
                    <div class="px-4 py-1">
                        <div class="font-bold text-gray-900 text-xl mb-1">
                            Anuncios Publicitarios
                        </div>
                        <p class="text-gray-700 text-base pb-1">
                            Anuncia y Encuentra ofertas de Servicios o Productos de Construccion!
                        </p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</x-app-layout>
