<template>
    <div>
        <div class="items-center flex justify-center">
            <svg v-show="menuTab === 'my-businesses'"
                 @click="toggle"
                 class="cursor-pointer h-6 w-6 text-emerald-300 hover:h-10 hover:w-10 hover:text-emerald-400 transition duration-150 ease-in-out" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <svg v-show="menuTab === 'new-business'"
                 @click="toggle"
                 class="cursor-pointer h-6 w-6 text-emerald-300 hover:h-10 hover:w-10 hover:text-emerald-400 transition duration-150 ease-in-out"
                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
            </svg>
        </div>
        <div v-show="menuTab === 'new-business'">
            <create-business></create-business>
        </div>
        <div v-show="menuTab === 'my-businesses'"
             class="flex-wrap md:flex sm:justify-center mt-3">

            <business-card v-for="business in myBusinesses"
                           :key="business.id"
                           :business="business"
            ></business-card>

        </div>

        <div v-if="! myBusinesses.length" class="flex-wrap md:flex sm:justify-center p-6 mt-3 items-center rounded-lg">
            <div class="flex flex-col md:flex-row items-center align-middle justify-center px-5 text-gray-700">
                <div class="max-w-md">
                    <div class="text-5xl font-dark font-bold"></div>
                    <p class="text-2xl md:text-3xl font-light leading-normal">
                        Registra tu Negocio o Empresa y deja que tus clientes te encuentren mas facil.
                    </p>
<!--                    <p class="mb-8 mt-4">Tus Negocios .</p>-->
                </div>
                <div class="max-w-full">
                    <img src="/img/businesses.png" alt="Houseify.io image">
                </div>

            </div>
        </div>

    </div>

</template>

<script>
export default {
    name: "MyBusinesses",
    data() {
        return {
            endpoint: '/me/businesses',
            myBusinesses: [],
            menuTab: 'my-businesses'
        }
    },
    methods: {
        index () {
            axios.get(this.endpoint).then(response => {
                this.myBusinesses = response.data.data
            }).catch(error => dd(error))
        },
        toggle() {
            this.menuTab = this.menuTab === 'my-businesses' ? 'new-business' : 'my-businesses'
        }
    },
    mounted() {
        this.index()
        Event.$on('businesses.new-business', (business) => {
            this.myBusinesses.unshift(business)
            this.menuTab = 'my-businesses'
        })
    },
    components: {
        CreateBusiness: () => import(/* webpackChunkName: "create-business" */ './CreateBusiness'),
        BusinessCard: () => import(/* webpackChunkName: "business-card" */ '../../components/Businesses/BusinessCard'),
    }
}
</script>
