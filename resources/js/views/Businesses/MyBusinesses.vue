<template>
    <div>
        <div class="items-center flex justify-center">
            <svg v-show="menuTab === 'my-businesses'"
                 @click="toggle"
                 class="h-transform h-transition cursor-pointer h-8 w-8 text-emerald-300 hover:h-12 hover:w-12 hover:text-emerald-400 " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <svg v-show="menuTab === 'new-business'"
                 @click="toggle"
                 class="h-transform h-transition cursor-pointer h-8 w-8 text-emerald-300 hover:h-12 hover:w-12 hover:text-emerald-400 "
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

        <div v-if="myBusinesses.length === 0 && menuTab === 'my-businesses'" class="flex-wrap md:flex sm:justify-center p-6 mt-3 items-center rounded-lg">
            <div class="container flex flex-col md:flex-row items-center justify-center px-5 text-gray-700">
                <div class="max-w-md md:mr-20">
                    <div class="text-3xl font-dark font-bold">Deja que México conozca tu negocio o empresa..</div>
                    <p class="mb-8 mt-4 text-2xl md:text-3xl">Puedes Registrar cuantos negocios poseas relacionados con el sector.</p>
                </div>
                <div class="max-w-lg">
                    <img src="/img/business_location.svg" class="h-72" alt="Houseify.io image">
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
            }).catch(error => {})
        },
        toggle() {
            this.menuTab = this.menuTab === 'my-businesses' ? 'new-business' : 'my-businesses'
        }
    },
    mounted() {
        this.index()
        window.Event.$on('businesses.new-business', (business) => {
            this.myBusinesses.unshift(business)
            this.menuTab = 'my-businesses'
        })
    },
    components: {
        CreateBusiness: () => import(/* webpackChunkName: "create-business" */ './CreateBusiness'),
    }
}
</script>
