<template>
    <div>
        <div v-if="businesses[0] && businesses[0].length !== 0"
             class="flex-wrap md:flex sm:justify-center mt-3">

            <template v-for="businessesChunk in businesses">

                <business-card v-for="business in businessesChunk"
                               :key="business.id"
                               :business="business"
                ></business-card>

            </template>

        </div>

        <div v-show="businesses[0] && businesses[0].length === 0"
             class="flex-wrap md:flex sm:justify-center p-6 mt-3 items-center rounded-lg"
             v-cloak>
            <div class="container flex flex-col md:flex-row items-center justify-center px-5 text-gray-700">
                <div class="max-w-md md:mr-20">
                    <div class="text-3xl font-dark font-bold">Se el primero en publicar un Negocio relacionado con el sector de la Construcción..</div>
                    <p class="mb-8 mt-4 text-2xl md:text-3xl">No hay Negocios o Empresas registradas por el momento..</p>
                </div>
                <div class="max-w-lg">
                    <img src="/img/into-the-void.svg" class="h-72" alt="Houseify.io image">
                </div>

            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ExploreBusinesses",
    data() {
        return {
            endpoint: '/businesses',
            businesses: [],

            totalPages: 0,
            currentPage: 1,
        }
    },
    methods: {
        index () {
            axios.get(this.endpoint + `?page=${this.currentPage}`)
                .then(response => {
                    let data = response.data
                    this.businesses.push(data.data)
                    this.currentPage = data.meta.current_page
                    this.totalPages = data.meta.last_page
                }).catch(error => {})
        },
        onScroll() {
            document.addwindow.EventListener('wheel', (evt) => {
                let bottomOfWindow = document.documentElement.scrollTop + window.innerHeight >= document.body.scrollHeight
                if (bottomOfWindow && this.currentPage <= this.totalPages) {
                    this.currentPage++
                    this.index()
                }
            }, { capture: false, passive: true})
            /*document.addwindow.EventListener('scroll', function (e) {

                let bottomOfWindow = document.documentElement.scrollTop + window.innerHeight >= document.body.scrollHeight
                dd(bottomOfWindow && this.currentPage <= this.totalPages)
                if (bottomOfWindow && this.currentPage <= this.totalPages) {
                    this.currentPage++
                    this.index()
                }
            })*/
        },
        load() {
            let bottomOfWindow = document.documentElement.scrollTop + window.innerHeight >= document.body.scrollHeight
            if (bottomOfWindow && this.currentPage <= this.totalPages) {
                this.currentPage++
                this.index()
            }
        }
    },
    created() {
        this.index()
        this.onScroll()
    },
    components: {
        BusinessCard: () => import(/* webpackChunkName: "business-card" */ '../../components/Businesses/BusinessCard'),
    }
}
</script>
