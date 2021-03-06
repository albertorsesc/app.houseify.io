<template>

    <div class="md:flex md:-mx-2">
        <div class="w-full md:w-1/3 md:mx-2">
            <div class="bg-white shadow overflow-hidden sm:rounded-md">
                <ul class="divide-y divide-gray-200">
                    <li @click="filtersTab = 'basic-details'"
                        :class="[filtersTab === 'basic-details' ? 'bg-gray-100' : 'hover:bg-gray-100']">
                        <a href="#" class="block hover:bg-gray-50">
                            <div class="px-4 py-4 flex items-center sm:px-6">
                                <div class="min-w-0 flex-1 sm:flex sm:items-center sm:justify-between">
                                    <div>
                                        <div class="flex text-sm font-medium text-emerald-600 truncate">
                                            <p>Datos Basicos</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="ml-5 flex-shrink-0">
                                    <!-- Heroicon name: solid/chevron-right -->
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li @click="filtersTab = 'location'"
                        :class="[filtersTab === 'location' ? 'bg-gray-100' : 'hover:bg-gray-100']">
                        <a href="#" class="block hover:bg-gray-50">
                            <div class="px-4 py-4 flex items-center sm:px-6">
                                <div class="min-w-0 flex-1 sm:flex sm:items-center sm:justify-between">
                                    <div>
                                        <div class="flex text-sm font-medium text-emerald-600 truncate">
                                            <p>Ubicacion</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="ml-5 flex-shrink-0">
                                    <!-- Heroicon name: solid/chevron-right -->
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li @click="filtersTab = 'features'"
                        :class="[filtersTab === 'features' ? 'bg-gray-100' : 'hover:bg-gray-100']">
                        <a href="#" class="block hover:bg-gray-50">
                            <div class="px-4 py-4 flex items-center sm:px-6">
                                <div class="min-w-0 flex-1 sm:flex sm:items-center sm:justify-between">
                                    <div>
                                        <div class="flex text-sm font-medium text-emerald-600 truncate">
                                            <p>Caracteristicas</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="ml-5 flex-shrink-0">
                                    <!-- Heroicon name: solid/chevron-right -->
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="w-full md:w-2/3 md:mx-2">
            <!--Basic Details-->
            <div v-show="filtersTab === 'basic-details'" class="bg-white rounded-lg shadow-md px-8 py-4 w-full mb-4">
                <div class="align-middle mb-4">
                    <h3 class="text-lg leading-6 font-medium text-cyan-500">
                        Filtrar por Datos Basicos
                    </h3>
                </div>
                <div class="flex justify-between my-2">
                    <!--Business Type-->
                    <div>
                        <label for="from_price" class="block text-sm font-medium text-gray-700">
                            Tipo de Negocio
                        </label>
                        <div class="mt-3">
                            <!--Sale-->
                            <div class="relative flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="offers" name="offers" type="checkbox" class="focus:ring-emerald-400 h-4 w-4 text-emerald-400 border-gray-300 rounded">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="offers" class="font-medium text-gray-700">Venta</label>
                                </div>
                            </div>
                            <!--Rent-->
                            <div class="relative flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="offers" name="offers" type="checkbox" class="focus:ring-emerald-400 h-4 w-4 text-emerald-400 border-gray-300 rounded">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="offers" class="font-medium text-gray-700">Renta</label>
                                </div>
                            </div>
                            <!--Trespass-->
                            <div class="relative flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="offers" name="offers" type="checkbox" class="focus:ring-emerald-400 h-4 w-4 text-emerald-400 border-gray-300 rounded">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="offers" class="font-medium text-gray-700">Traspaso</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Property Type-->
                    <div>
                        <label for="from_price" class="block text-sm font-medium text-gray-700">
                            Tipo de Propiedad
                        </label>
                        <div class="mt-3">
                            <!--Residential-->
                            <div class="relative flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="offers" name="offers" type="checkbox" class="focus:ring-emerald-400 h-4 w-4 text-emerald-400 border-gray-300 rounded">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="offers" class="font-medium text-gray-700">Residencial</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Property Category-->
                    <div>
                        <label for="from_price" class="block text-sm font-medium text-gray-700">
                            Categoria de la Propiedad
                        </label>
                        <div class="mt-3">
                            <!--House-->
                            <div class="relative flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="offers" name="offers" type="checkbox" class="focus:ring-emerald-400 h-4 w-4 text-emerald-400 border-gray-300 rounded">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="offers" class="font-medium text-gray-700">Casa</label>
                                </div>
                            </div>
                            <!--Department-->
                            <div class="relative flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="offers" name="offers" type="checkbox" class="focus:ring-emerald-400 h-4 w-4 text-emerald-400 border-gray-300 rounded">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="offers" class="font-medium text-gray-700">Departamento</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-between my-4 md:-mx-2">
                    <!--Price Range-->
                    <div class="w-1/2 md:mx-2">
                        <label for="from_price" class="block text-sm font-medium text-gray-700">
                            Rango de Precio
                        </label>
                        <div class="mt-2 flex rounded-md shadow-sm">
                            <span class="inline-flex items-center px-2 border border-r-0  border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                              De
                            </span>
                            <input type="text"
                                   name="from_price"
                                   id="from_price"
                                   class="flex-1 min-w-0 block w-10 px-3 py-2 rounded-none focus:ring-emerald-200 focus:border-emerald-200 sm:text-sm border-gray-300"
                                   placeholder="0">
                            <span class="inline-flex items-center px-2 border border-r-0 border-l-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                              a
                            </span>
                            <input type="text"
                                   name="to_price"
                                   id="to_price"
                                   class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-r-md focus:ring-emerald-200 focus:border-emerald-200 sm:text-sm border-gray-300"
                                   placeholder="100,000,000">
                        </div>
                    </div>
                    <!--Title and Comments-->
                    <div class="w-1/2 md:mx-2">
                        <label for="title_or_comments" class="block text-sm font-medium text-gray-700">
                            Busca por Titulo o Comentarios
                        </label>
                        <div class="mt-2 flex rounded-md shadow-sm">
                            <input type="text"
                                   name="title_or_comments"
                                   id="title_or_comments"
                                   class="flex-1 min-w-0 block w-10 px-3 py-2 rounded-md focus:ring-emerald-200 focus:border-emerald-200 sm:text-sm border-gray-300"
                                   placeholder="">
                        </div>
                    </div>
                </div>
            </div>

            <!--Location-->
            <div v-show="filtersTab === 'location'" class="bg-white rounded-lg shadow-md px-8 py-4 w-full mb-4">
                <div class="align-middle mb-4">
                    <h3 class="text-lg leading-6 font-medium text-cyan-500">
                        Filtrar por Ubicacion
                    </h3>
                </div>
                <div class="flex justify-between my-2">
                    <!--State-->
                    <div>
                        <label for="from_price" class="block text-sm font-medium text-gray-700">
                            Estado
                        </label>
                        <div class="mt-3">
                            <div class="relative flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="state" name="state" type="checkbox" class="focus:ring-emerald-400 h-4 w-4 text-emerald-400 border-gray-300 rounded">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="state" class="font-medium text-gray-700">Baja California</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--City-->
                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-700">
                            Ciudad
                        </label>
                        <div class="mt-3">
                            <div class="relative flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="city" name="city" type="checkbox" class="focus:ring-emerald-400 h-4 w-4 text-emerald-400 border-gray-300 rounded">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="city" class="font-medium text-gray-700">Mexicali</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Neighborhood-->
                    <div>
                        <label for="neighborhood" class="block text-sm font-medium text-gray-700">
                            Categoria de la Propiedad
                        </label>
                        <div class="mt-3">
                            <!--House-->
                            <div class="relative flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="neighborhood" name="neighborhood" type="checkbox" class="focus:ring-emerald-400 h-4 w-4 text-emerald-400 border-gray-300 rounded">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="neighborhood" class="font-medium text-gray-700">Hacienda del Rio</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Features-->
            <div v-show="filtersTab === 'features'" class="bg-white rounded-lg shadow-md px-8 py-4 w-full mb-4">
                <div class="align-middle mb-4">
                    <h3 class="text-lg leading-6 font-medium text-cyan-500">
                        Filtrar por Caracteristicas
                    </h3>
                </div>
                <div class="flex justify-between my-2 md:-mx-2">
                    <!--Property Size-->
                    <div class="w-1/3 md:mx-2">
                        <label for="property_size" class="block text-sm font-medium text-gray-700">
                            m² Propiedad
                        </label>
                        <div class="mt-2 flex rounded-md shadow-sm">
                            <input type="text"
                                   name="property_size"
                                   id="property_size"
                                   class="flex-1 min-w-0 block w-10 px-3 py-2 rounded-md focus:ring-emerald-200 focus:border-emerald-200 sm:text-sm border-gray-300"
                                   placeholder="0">
                        </div>
                    </div>
                    <!--Construction size-->
                    <div class="w-1/3 md:mx-2">
                        <label for="construction_size" class="block text-sm font-medium text-gray-700">
                            m² de Construccion
                        </label>
                        <div class="mt-2 flex rounded-md shadow-sm">
                            <input type="text"
                                   name="construction_size"
                                   id="construction_size"
                                   class="flex-1 min-w-0 block w-10 px-3 py-2 rounded-md focus:ring-emerald-200 focus:border-emerald-200 sm:text-sm border-gray-300"
                                   placeholder="0">
                        </div>
                    </div>
                    <!--Level count-->
                    <div class="w-1/3 md:mx-2">
                        <label for="level_cout" class="block text-sm font-medium text-gray-700">
                            No. de Niveles
                        </label>
                        <div class="mt-2 flex rounded-md shadow-sm">
                            <input type="text"
                                   name="level_cout"
                                   id="level_cout"
                                   class="flex-1 min-w-0 block w-10 px-3 py-2 rounded-md focus:ring-emerald-200 focus:border-emerald-200 sm:text-sm border-gray-300"
                                   placeholder="0">
                        </div>
                    </div>
                </div>

                <div class="flex justify-between my-2 md:-mx-2">
                    <!--Bathroom count-->
                    <div class="w-1/2 md:mx-2">
                        <label for="bathroom_count" class="block text-sm font-medium text-gray-700">
                            No. de Banos
                        </label>
                        <div class="mt-2 flex rounded-md shadow-sm">
                            <input type="text"
                                   name="bathroom_count"
                                   id="bathroom_count"
                                   class="flex-1 min-w-0 block w-10 px-3 py-2 rounded-md focus:ring-emerald-200 focus:border-emerald-200 sm:text-sm border-gray-300"
                                   placeholder="0">
                        </div>
                    </div>
                    <!--Half bathroom count-->
                    <div class="w-1/2 md:mx-2">
                        <label for="half_bathroom_count" class="block text-sm font-medium text-gray-700">
                            No. de Medios Banos
                        </label>
                        <div class="mt-2 flex rounded-md shadow-sm">
                            <input type="text"
                                   name="half_bathroom_count"
                                   id="half_bathroom_count"
                                   class="flex-1 min-w-0 block w-10 px-3 py-2 rounded-md focus:ring-emerald-200 focus:border-emerald-200 sm:text-sm border-gray-300"
                                   placeholder="0">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    name: "SearchProperties",
    data() {
        return {
            filtersTab: '',
        }
    }
}
</script>

<style scoped>

</style>
