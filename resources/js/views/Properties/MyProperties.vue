<template>
    <div>
        <div class="items-center flex justify-center">
            <svg v-show="menuTab === 'my-properties'"
                 @click="toggle"
                 class="cursor-pointer h-8 w-8 text-emerald-300 hover:h-12 hover:w-12 hover:text-emerald-400 h-transform h-transition" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <svg v-show="menuTab === 'new-property'"
                 @click="toggle"
                 class="cursor-pointer h-8 w-8 text-emerald-300 hover:h-12 hover:w-12 hover:text-emerald-400 h-transform h-transition"
                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
            </svg>
        </div>
        <div v-show="menuTab === 'new-property'">
            <create-property></create-property>
        </div>
        <div v-show="menuTab === 'my-properties'"
             class="flex-wrap md:flex sm:justify-center mt-3">

                <property-card v-for="property in myProperties"
                               :key="property.id"
                               :property="property"
                ></property-card>

        </div>

        <div v-if="! myProperties.length && menuTab !== 'new-property'"
             class="flex-wrap md:flex sm:justify-center p-6 mt-3 items-center rounded-lg">
            <div class="flex flex-col md:flex-row items-center align-middle justify-center px-5 text-gray-700">
                <div class="max-w-md md:mr-20">
                    <div class="text-3xl font-dark font-bold">
                        Crea tu primera Propiedad y comienza a registrar sus detalles.
                    </div>
                    <p class="mb-8 mt-4 text-2xl md:text-3xl">Tus Propiedades serán vistas en toda la República Mexicana.</p>
                </div>
                <div class="max-w-full">
                    <img src="/img/houses_with_garden.svg" alt="Houseify.io image">
                </div>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    name: "MyProperties",
    data() {
        return {
            endpoint: '/me/properties',
            myProperties: [],
            menuTab: 'my-properties'
        }
    },
    methods: {
        index () {
            axios.get(this.endpoint).then(response => {
                this.myProperties = response.data.data
            }).catch(error => {})
        },
        toggle() {
            this.menuTab = this.menuTab === 'my-properties' ? 'new-property' : 'my-properties'
        }
    },
    created() {
        this.index()
        window.Event.$on('properties.new-property', (property) => {
            this.myProperties.unshift(property)
            this.menuTab = 'my-properties'
        })
    },
    components: {
        CreateProperty: () => import(/* webpackChunkName: "create-property" */ './CreateProperty'),
        PropertyCard: () => import(/* webpackChunkName: "property-card" */ '../../components/Properties/PropertyCard'),
    }
}
</script>

<style scoped>

</style>
