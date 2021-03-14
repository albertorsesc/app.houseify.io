<template>

    <div>
        <div class="flex-wrap md:flex sm:justify-center mt-3" v-for="(propertyChunk, index) in properties" :key="index">

            <property-card v-for="property in propertyChunk"
                           :key="property.id"
                           :property="property"
            ></property-card>

        </div>
    </div>

<!--    <ul class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        <dl v-for="(propertyChunk, index) in properties"
                  :key="index">
            <li class="col-span-1 divide-y divide-gray-200" v-for="property in propertyChunk">
                <div class="card transition hover:transform">
                    <custom-carousel module-name="properties"></custom-carousel>
                </div>
                <div class="px-4 -mt-16 relative">
                    <div class="card transition hover:transform px-6 py-2">
                        <div class="flex justify-center justify-evenly items-center align-middle">
                            <span class="bg-teal-200 text-teal-700 font-semibold text-xs rounded-full px-2 py-1 tracking-wide leading-none inline-block">State</span>
                            <span class="bg-blue-200 text-teal-700 font-semibold text-xs rounded-full px-2 py-1 tracking-wide leading-none inline-block">Prop Category</span>
                            <span class="bg-purple-200 text-teal-700 font-semibold text-xs rounded-full px-2 py-1 tracking-wide leading-none inline-block">Venta</span>
                        </div>
                        <div class="font-semibold text-lg text-gray-700 mt-2 text-center">Titulo</div>
                        <div class="mb-1 text-center align-middle">
                            <span class="text-green-700 font-bold text-base">0000</span>
                            <span class="ml-1 text-sm text-gray-500">m.n.</span>
                        </div>

                        <hr>

                        <div class="flex justify-center align-middle items-center">
                            &lt;!&ndash;                        <interested-btn :model="property"
                                                                    :id="property.slug"
                                                                    model-name="properties"
                                                                    endpoint="/properties"
                                                    ></interested-btn>&ndash;&gt;
                            <a class="inline-block text-gray-700 hover:shadow-lg hover:text-indigo-500 tracking-wide text-sm font-bold mr-2 align-middle items-center"
                               :href="`https://www.facebook.com/sharer.php?u=`"
                               target="_blank"
                               title="Compartir">
                                <i class="fab fa-facebook text-blue-500 text-lg"></i>
                            </a>

                            <div class="mt-1 right-0 items-center align-middle px-4 text-green-500">
                                <a
                                    class="no-underline h-link hover:text-green-400 -mt-6"
                                    title="Visitar Propiedad">
                                    <svg class="h-5 w-5 text-base" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </dl>

    </ul>-->


</template>

<script>
import CustomCarousel from '../../components/CustomCarousel'

import PropertyCard from '../../components/Properties/PropertyCard'

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
        CustomCarousel,
        PropertyCard,
    }
}
</script>
