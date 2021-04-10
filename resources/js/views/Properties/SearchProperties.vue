<template>

    <div>
        <search index="properties">
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
                                                    <p>Ubicación</p>
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
                    <div>
                        <!--Basic Details-->
                        <div v-show="filtersTab === 'basic-details'"
                             class="bg-white rounded-lg shadow-md px-8 py-4 w-full mb-4">
                            <div class="align-middle mb-4">
                                <h3 class="text-lg leading-6 font-medium text-cyan-500">
                                    Filtrar por Datos Basicos
                                </h3>
                            </div>
                            <div class="flex justify-between mt-6">
                                <!--Business Type-->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">
                                        Tipo de Negocio
                                    </label>
                                    <ais-refinement-list
                                        attribute="businessType"
                                    ></ais-refinement-list>
                                </div>
                                <!--Property Type-->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">
                                        Tipo de Propiedad
                                    </label>
                                    <ais-refinement-list
                                        attribute="propertyCategory.propertyType"
                                    ></ais-refinement-list>
                                </div>
                                <!--Property Category-->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">
                                        Categoría de la Propiedad
                                    </label>
                                    <ais-refinement-list
                                        attribute="propertyCategory.displayName"
                                    ></ais-refinement-list>
                                </div>
                            </div>
                            <div class="flex justify-between mt-6 md:-mx-2">
                                <!--Price Range-->
                                <div class="w-1/3 md:mx-2">
                                    <label class="block text-sm font-medium text-gray-700">
                                        Rango de Precio
                                    </label>
                                    <div class="flex mt-4">
                                        <ais-numeric-menu
                                            attribute="price"
                                            :items="priceRanges"/>
                                    </div>
                                </div>
                                <!--Title and Comments-->
                                <div class="w-2/3 md:mx-2">
                                    <label class="block text-sm font-medium text-gray-700">
                                        Busca por Titulo o Comentarios
                                    </label>
                                    <div class="mt-4 flex">
                                        <ais-search-box
                                            placeholder="Busca por Titulo o Comentarios"
                                        ></ais-search-box>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Location-->
                        <div v-show="filtersTab === 'location'" class="bg-white rounded-lg shadow-md px-8 pt-4 pb-20 w-full mb-4">
                            <div class="align-middle mb-4">
                                <h3 class="text-lg leading-6 font-medium text-cyan-500">
                                    Filtrar por Ubicación
                                </h3>
                            </div>
                            <div class="flex justify-between my-2">
                                <!--State-->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">
                                        Estado
                                    </label>
                                    <ais-refinement-list
                                        attribute="location.state.name"
                                    ></ais-refinement-list>
                                </div>
                                <!--City-->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">
                                        Ciudad
                                    </label>
                                    <ais-refinement-list
                                        attribute="location.city"
                                    ></ais-refinement-list>
                                </div>
                                <!--Neighborhood-->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">
                                        Fraccionamiento/Colonia
                                    </label>
                                    <ais-refinement-list
                                        attribute="location.neighborhood"
                                    ></ais-refinement-list>
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
                                    <label class="block text-sm font-medium text-gray-700">
                                        m² Propiedad
                                    </label>
                                    <div class="mt-2 flex">
                                        <ais-numeric-menu
                                            attribute="propertyFeature.propertySize"
                                            :items="propertySizeRanges"/>
                                    </div>
                                </div>
                                <!--Construction size-->
                                <div class="w-1/3 md:mx-2">
                                    <label class="block text-sm font-medium text-gray-700">
                                        m² de Construcción
                                    </label>
                                    <div class="mt-2 flex">
                                        <ais-numeric-menu
                                            attribute="propertyFeature.constructionSize"
                                            :items="constructionSizeRanges"/>
                                    </div>
                                </div>
                                <!--Level count-->
                                <div class="w-1/3 md:mx-2">
                                    <label class="block text-sm font-medium text-gray-700">
                                        No. de Niveles
                                    </label>
                                    <div class="mt-2 flex">
                                        <ais-numeric-menu
                                            attribute="propertyFeature.levelCount"
                                            :items="levelCountRanges"/>
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-between my-4 md:-mx-2">
                                <!--Bathroom count-->
                                <div class="w-full md:w-1/3 md:mx-2">
                                    <label class="block text-sm font-medium text-gray-700">
                                        No. de Baños
                                    </label>
                                    <div class="mt-2 flex">
                                        <ais-numeric-menu
                                            attribute="propertyFeature.bathroomCount"
                                            :items="bathroomCountRanges"/>
                                    </div>
                                </div>
                                <!--Half bathroom count-->
                                <div class="w-full md:w-1/3 md:mx-2">
                                    <label class="block text-sm font-medium text-gray-700">
                                        No. de Medios Baños
                                    </label>
                                    <div class="mt-2 flex">
                                        <ais-numeric-menu
                                            attribute="propertyFeature.halfBathroomCount"
                                            :items="halfBathroomCountRanges"/>
                                    </div>
                                </div>

                                <div class="w-full md:w-1/3 md:mx-2"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!--Results-->
            <ais-hits>
                <div class="w-full" slot-scope="{ items }">
                    <div class="flex justify-end mb-2 mt-2 align-middle">
                        <span class="text-emerald-600 text-sm px-4 md:mt-1">Resultados: {{ items.filter((item) => item.status === true).length }}</span>
                        <span class="bg-emerald-500 text-white text-sm shadow hover:shadow-inner px-4 py-1 rounded-lg ml-2">
                            <ais-clear-refinements>
                                <span slot="resetLabel" class="text-white rounded-lg font-bold">Reiniciar filtros</span>
                            </ais-clear-refinements>
                        </span>
                    </div>
                    <div v-for="item in items" :key="item.objectID" v-if="item.status">
                        <div class="mt-6">
                            <div class="bg-white rounded-lg shadow w-full pt-4 pl-4 pb-2 pr-4 mb-4 align-middle" v-cloak>
                                <div class="w-full md:flex md:justify-center md:align-middle">

                                    <property-card :property="item"></property-card>

                                    <div class="w-full md:w-2/3">
                                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                                            <div class="px-4 py-5 sm:px-6">
                                                <h3 class="text-lg leading-6 font-medium text-gray-900"
                                                    v-text="item.title"
                                                ></h3>
                                                <p class="mt-1 max-w-2xl text-xs md:text-xs md:text-sm text-gray-500">
                                                    Detalles de la Propiedad.
                                                </p>
                                            </div>
                                            <div class="border-t border-gray-200">
                                                <dl>
                                                    <!--Price-->
                                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                        <dt class="text-xs md:text-xs md:text-sm font-medium text-gray-500">
                                                            Precio
                                                        </dt>
                                                        <dd class="mt-1 text-xs md:text-xs md:text-sm text-gray-900 sm:mt-0 sm:col-span-2"
                                                            v-text="item.formattedPrice"
                                                        ></dd>
                                                    </div>
                                                    <!--BusinessType-->
                                                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                        <dt class="text-xs md:text-xs md:text-sm font-medium text-gray-500">
                                                            Tipo de Negocio
                                                        </dt>
                                                        <dd class="mt-1 text-xs md:text-xs md:text-sm text-gray-900 sm:mt-0 sm:col-span-2"
                                                            v-text="item.businessType"
                                                        ></dd>
                                                    </div>
                                                    <!--Category-->
                                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                        <dt class="text-xs md:text-sm font-medium text-gray-500">
                                                            Categoría de la Propiedad
                                                        </dt>
                                                        <dd class="mt-1 text-xs md:text-sm text-gray-900 sm:mt-0 sm:col-span-2"
                                                            v-text="item.propertyCategory.displayName"
                                                        ></dd>
                                                    </div>
                                                    <!--Location-->
                                                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                        <dt class="text-xs md:text-sm font-medium text-gray-500">
                                                            Dirección
                                                        </dt>
                                                        <dd class="mt-1 text-xs md:text-sm text-gray-900 sm:mt-0 sm:col-span-2"
                                                            v-text="item.location.fullAddress"
                                                        ></dd>
                                                    </div>
                                                    <!--Features-->
                                                    <div class="bg-gray-50 items-center align-middle px-4 py-1 sm:grid sm:grid-cols-3 sm:px-6">
                                                        <dt class="text-xs md:text-sm font-medium text-gray-500">
                                                            Caracteristicas
                                                        </dt>
                                                        <div class="flex justify-between space-x-4">
                                                            <ul class="">
                                                                <!--Property Size-->
                                                                <li class="my-3 mx-4 w-full flex text-xs items-center align-middle font-light">
                                                                    <span class="text-gray-600">m² Propiedad:</span>
                                                                    <strong v-text="item.propertyFeature.propertySize"
                                                                            class="ml-2 text-gray-900"
                                                                    ></strong>
                                                                </li>
                                                                <!--Construction Size-->
                                                                <li class="my-3 mx-4 w-full flex text-xs items-center align-middle font-light">
                                                                    <span class="text-gray-600">m² Construcción:</span>
                                                                    <strong v-text="item.propertyFeature.constructionSize"
                                                                            class="ml-2 text-gray-900"
                                                                    ></strong>
                                                                </li>
                                                            </ul>
                                                            <ul class="">
                                                                <!--Level Count-->
                                                                <li class="my-3 mx-4 w-full flex text-xs items-center align-middle font-light">
                                                                    <span class="text-gray-600">Niveles:</span>
                                                                    <strong v-text="item.propertyFeature.levelCount"
                                                                            class="ml-2 text-gray-900"
                                                                    ></strong>
                                                                </li>
                                                                <!--Room Count-->
                                                                <li class="my-3 mx-4 w-full flex text-xs items-center align-middle font-light">
                                                                    <span class="text-gray-600">Habitaciones:</span>
                                                                    <strong v-text="item.propertyFeature.roomCount"
                                                                            class="ml-2 text-gray-900"
                                                                    ></strong>
                                                                </li>
                                                            </ul>
                                                            <ul class="">
                                                                <li class="my-3 mx-4 w-full flex text-xs items-center align-middle font-light">
                                                                    <span class="text-gray-600">Baños:</span>
                                                                    <strong v-text="item.propertyFeature.bathroomCount"
                                                                            class="ml-2 text-gray-900"
                                                                    ></strong>
                                                                </li>
                                                                <!--HalfBathRoom-->
                                                                <li class="my-3 mx-4 w-full text-xs items-center align-middle font-light">
                                                                    <span class="text-gray-600">1/2 Baños:</span>
                                                                    <strong v-text="item.propertyFeature.halfBathroomCount"
                                                                            class="ml-2 text-gray-900"
                                                                    ></strong>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <!--Comments-->
                                                    <div v-if="item.comments"
                                                         class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                        <dt class="text-xs md:text-sm font-medium text-gray-500">
                                                            Comentarios
                                                        </dt>
                                                        <dd class="mt-1 text-xs md:text-sm text-gray-900 sm:mt-0 sm:col-span-2"
                                                            v-text="item.comments"
                                                        ></dd>
                                                    </div>
                                                </dl>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="my-6 border-b border-solid border-gray-200 border-1"></div>
                    </div>
                </div>
            </ais-hits>
        </search>
    </div>

</template>

<script>
import properties from "../../mixins/properties";

export default {
    name: "SearchProperties",
    mixins: [properties],
    data() {
        return {
            endpoint: '/properties/search',
            results: [],

            search: {
                business_type: '',
            },
            priceRanges: [
                { label: 'Cualquier Precio' },
                { label: 'Menos de $5,000 M.N.', end: 5000 },
                { label: '$5,000 - $10,000 M.N.', start: 5001, end: 10000 },
                { label: '$10,000 - $50,000 M.N.', start: 10001, end: 50000 },
                { label: '$50,000 - $100,000 M.N.', start: 50001, end: 100000 },
                { label: '$100,001 - $500,000 M.N.', start: 100001, end: 500000 },
                { label: 'Mas de $500,000 M.N.', start: 500001 },
            ],
            propertySizeRanges: [
                { label: 'Cualquier cantidad de m²' },
                { label: 'Menos de 100 m²', end: 100 },
                { label: '101 m² - 300 m²', start: 101, end: 300 },
                { label: '301 m² - 500 m²', start: 301, end: 500 },
                { label: '501 - 1,000 m²', start: 501, end: 1000 },
                { label: '1,001 m² - 5,000 m²', start: 1001, end: 5000 },
                { label: 'Mas de 5,000', start: 5001 },
            ],
            constructionSizeRanges: [
                { label: 'Cualquier cantidad de m²' },
                { label: 'Menos de 100 m²', end: 100 },
                { label: '101 m² - 300 m²', start: 101, end: 300 },
                { label: '301 m² - 500 m²', start: 301, end: 500 },
                { label: '501 - 1,000 m²', start: 501, end: 1000 },
                { label: '1,001 m² - 5,000 m²', start: 1001, end: 5000 },
                { label: 'Mas de 5,000', start: 5001 },
            ],
            levelCountRanges: [
                { label: 'Cualquier cantidad' },
                { label: '1 nivel', end: 1 },
                { label: '2 niveles', start: 2, end: 2 },
                { label: 'Mas de 2 niveles', start: 2 },
            ],
            bathroomCountRanges: [
                { label: 'Cualquier cantidad' },
                { label: '1 bano', end: 1 },
                { label: '2 banos', start: 2, end: 2 },
                { label: 'Mas de 2 banos', start: 2 },
            ],
            halfBathroomCountRanges: [
                { label: 'Cualquier cantidad' },
                { label: '1', end: 1 },
                { label: '2', start: 2, end: 2 },
                { label: 'Mas de 2', start: 2 },
            ],

            filtersTab: 'basic-details',
        }
    },
    methods: {
        onSearch() {
            axios.post(this.endpoint, {
                business_type: this.search.business_type,
            })
                .then(response => {
                    this.results = response.data.data
                })
                .catch(error => { dd(error) })
        }
    },
    components: {
        Search: () => import(/* webpackChunkName: "search" */ '../../components/Search'),
        PropertyCard: () => import(/* webpackChunkName: "property-card" */ '../../components/Properties/PropertyCard'),
    }
}
</script>

<style scoped>

</style>
