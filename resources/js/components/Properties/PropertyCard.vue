<template>
    <div class="my-4 w-full md:w-1/2 lg:w-1/3 px-3 flex flex-col">
        <div class="card transition hover:transform">
            <custom-carousel :images="property.images" module-name="properties" :size="'small'"></custom-carousel>
        </div>
        <div class="px-4 -mt-16 relative">
            <div class="card transition hover:transform px-6 py-2">
                <div class="flex justify-center items-center align-middle">
<!--                    <span class="bg-teal-200 text-teal-700 font-semibold text-xs rounded-full px-2 py-1 tracking-wide leading-none inline-block"
                          v-if="property.location"
                          v-text="property.location.state.name"
                          :title="property.location.state.name"
                    ></span>-->
                    <span class="mr-4 bg-blue-200 text-teal-700 font-semibold text-xs rounded-full px-2 py-1 tracking-wide leading-none inline-block"
                          v-text="limitString(property.propertyCategory.displayName, 10)"
                          :title="property.propertyCategory.displayName"
                    ></span>
                    <span class="bg-purple-200 text-teal-700 font-semibold text-xs rounded-full px-2 py-1 tracking-wide leading-none inline-block"
                          v-text="property.businessType"
                    ></span>
                </div>
                <div class="font-semibold text-lg text-gray-700 mt-2 text-center"
                     v-text="propertyTitle"
                     :title="property.title"
                ></div>

                <div class="text-sm md:text-xs py-1">
                    <div class="flex justify-center items-center">
                        <span v-if="property.location && property.location.city"
                              :title="property.location.city">
                            {{ limitString(property.location.city, 18) }}
                        </span>

                        <span class="mx-2">&bullet;</span>

                        <span v-if="property.location && property.location.state"
                              v-text="property.location.state.code">
                        </span>
                    </div>
                </div>

                <div class="mb-1 text-center align-middle -mt-2">
                    <span class="text-green-700 font-bold text-base" v-text="property.formattedPrice"></span>
                    <span class="ml-1 text-sm text-gray-500">m.n.</span>
                </div>

                <hr>

                <div class="flex justify-center align-middle items-center">
                    <interested-btn v-if="isAuthenticated"
                                    :model="property"
                                    :id="property.slug"
                                    model-name="properties"
                                    endpoint="/properties"
                    ></interested-btn>
                    <a class="inline-block text-gray-700 hover:shadow-lg hover:text-indigo-500 tracking-wide text-sm font-bold mr-2 align-middle items-center"
                       :href="`https://www.facebook.com/sharer.php?u=` + property.meta.links.publicProfile"
                       target="_blank"
                       title="Compartir">
                        <i class="fab fa-facebook text-blue-500 text-lg"></i>
                    </a>
                    <div class="mt-1 ml-2 right-0 items-center align-middle">
                        <a :href="isAuthenticated ? property.meta.links.profile : property.meta.links.publicProfile"
                           class="h-link flex no-underline text-sm font-medium text-gray-300 hover:text-emerald-400"
                           title="Ver Propiedad">
                            Ver
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'PropertyCard',
    props: {
        property: {
            required: true,
            type: Object,
        },
    },
    data() {
        return {
            currentUrl: window.location.href,

            propertyTitle: this.limitString(this.property.title, 23),
        }
    },
    components: {
        InterestedBtn: () => import(/* webpackChunkName: "interested-btn" */ '../InterestedBtn'),
        CustomCarousel: () => import(/* webpackChunkName: "custom-carousel" */ '../../components/CustomCarousel'),
    }
}
</script>
