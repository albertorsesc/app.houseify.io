<template>

    <div>
        <div class="flex-wrap md:flex sm:justify-center mt-3"
             v-if="properties[0].length !== 0"
             v-for="(propertyChunk, index) in properties"
             :key="index">

            <property-card v-for="property in propertyChunk"
                           :key="property.id"
                           :property="property"
            ></property-card>

        </div>

        <div v-else
             class="flex-wrap md:flex sm:justify-center p-6 mt-3 items-center rounded-lg"
             v-cloak>
            <div class="container flex flex-col md:flex-row items-center justify-center px-5 text-gray-700">
                <div class="max-w-md md:mr-20">
                    <div class="text-3xl font-dark font-bold">Se el primero en publicar una Propiedad.</div>
                    <p class="mb-8 mt-4 text-2xl md:text-3xl">No hay Propiedades registradas por el momento..</p>
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
    name: "ExploreProperties",
    data() {
        return {
            endpoint: '/properties',
            properties: [],

            totalPages: 0,
            currentPage: 1,
        }
    },
    methods: {
        index () {
            axios.get(this.endpoint + `?page=${this.currentPage}`)
                .then(response => {
                    let data = response.data
                    this.properties.push(data.data)
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

        Event.$on('interest-properties', property => {
            // dd('from Explore: ' + property.status)
            let interestedProperty = {}
            // this.properties.forEach(function (propertyChunk) {
                // interestedProperty = propertyChunk.filter(localProperty => localProperty.id === property.id)[0]
            // })
            // let prop = this.properties.find(prop => prop[0].id === property.id)
            // dd(prop.status)
            // dd(property.status)
            // let propert = this.properties.filter(filteredProperties => filteredProperties[0].id === property.id)
            // dd(this.properties.splice(this.properties.indexOf(propert[0])))
            // this.properties.push(property)
        })
    },
    components: {
        CustomCarousel: () => import(/* webpackChunkName: "custom-carousel" */ '../../components/CustomCarousel'),
        PropertyCard: () => import(/* webpackChunkName: "property-card" */ '../../components/Properties/PropertyCard'),
    }
}
</script>
