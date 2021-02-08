<template>
    <div class="flex-wrap md:flex sm:justify-center mt-3">

            <template v-for="businessesChunk in businesses">

                <business-card v-for="business in businessesChunk"
                               :key="business.id"
                               :business="business"
                ></business-card>

            </template>

    </div>
</template>

<script>
import BusinessCard from "../../components/Businesses/BusinessCard";
export default {
    name: "ExploreBusinesses",
    data() {
        return {
            endpoint: '/api/businesses',
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
                }).catch(error => dd(error))
        },
        onScroll() {
            document.addEventListener('wheel', (evt) => {
                let bottomOfWindow = document.documentElement.scrollTop + window.innerHeight >= document.body.scrollHeight
                if (bottomOfWindow && this.currentPage <= this.totalPages) {
                    this.currentPage++
                    this.index()
                }
            }, { capture: false, passive: true})
            /*document.addEventListener('scroll', function (e) {

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
        BusinessCard,
    }
}
</script>
