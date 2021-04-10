<template>

    <div>
        <search index="businesses">
            <div class="md:flex md:-mx-2">
                <div class="w-full md:mx-2">
                    <div class="bg-white rounded-lg shadow-md px-8 py-4 w-full mb-4">
                        <div class="align-middle mb-4">
                            <h3 class="text-lg leading-6 font-medium text-cyan-500">
                                Filtrar por Datos del Negocio
                            </h3>
                        </div>
                        <div class="md:flex md:justify-between mt-4 md:mt-6">
                            <!--Business Categories-->
                            <div class="w-full md:w-1/3">
                                <label class="block text-sm font-medium text-gray-700">
                                    Categorías del Negocio
                                </label>
                                <div class="mt-1">
                                    <ais-refinement-list
                                        attribute="categories"
                                    ></ais-refinement-list>
                                </div>
                            </div>
                            <!--State-->
                            <div class="w-full md:w-1/3">
                                <label class="block text-sm font-medium text-gray-700">
                                    Estado
                                </label>
                                <ais-refinement-list
                                    attribute="location.state.name"
                                ></ais-refinement-list>
                            </div>
                            <!--City-->
                            <div class="w-full md:w-1/3">
                                <label class="block text-sm font-medium text-gray-700">
                                    Ciudad
                                </label>
                                <ais-refinement-list
                                    attribute="location.city"
                                ></ais-refinement-list>
                            </div>
                            <!--Neighborhood-->
                            <div class="w-full md:w-1/3">
                                <label class="block text-sm font-medium text-gray-700">
                                    Fraccionamiento/Colonia
                                </label>
                                <ais-refinement-list
                                    attribute="location.neighborhood"
                                ></ais-refinement-list>
                            </div>
                        </div>

                        <div class="flex justify-between mt-6 my-2">
                            <!--Name and Comments-->
                            <div class="w-2/3">
                                <label class="block text-sm font-medium text-gray-700">
                                    Busca por Nombre del Negocio o Informacion adicional
                                </label>
                                <div class="mt-1">
                                    <ais-search-box :placeholder="''"></ais-search-box>
                                </div>
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

                    <div
                         class="w-full md:flex sm:justify-center md:align-middle mt-6 flex-wrap" v-cloak>
                            <business-card v-for="item in items"
                                           :key="item.objectID"
                                           v-if="item.status"
                                           :business="item"
                            ></business-card>
                    </div>
                </div>
            </ais-hits>
        </search>
    </div>

</template>

<script>
export default {
    name: "SearchBusinesses",
    data() {
        return {
            endpoint: '/businesses/search',
            results: [],

            filtersTab: 'basic-details',
        }
    },
    mounted() {
        /*this.$store.dispatch('global/fetchStates')
        this.$store.dispatch('businesses/fetchPropertyTypes')
        this.$store.dispatch('businesses/fetchBusinessTypes')*/
    },
    components: {
        Search: () => import(/* webpackChunkName: "search" */ '../../components/Search'),
        BusinessCard: () => import(/* webpackChunkName: "business-card" */ '../../components/Businesses/BusinessCard'),
    }
}
</script>

<style scoped>

</style>
