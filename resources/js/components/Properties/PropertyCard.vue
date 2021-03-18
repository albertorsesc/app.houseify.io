<template>
    <div class="my-2 w-full flex flex-col sm:w-2/3 md:w-1/2 lg:w-1/3 px-3">
        <div class="card transition hover:transform">
            <custom-carousel module-name="properties"></custom-carousel>
        </div>
        <div class="px-4 -mt-16 relative">
            <div class="card transition hover:transform px-6 py-2">
                <div class="flex justify-center justify-evenly items-center align-middle">
                    <span class="bg-teal-200 text-teal-700 font-semibold text-xs rounded-full px-2 py-1 tracking-wide leading-none inline-block"
                          v-if="property.location"
                          v-text="property.location.state.name"
                          :title="property.location.state.name"
                    ></span>
                    <span class="bg-blue-200 text-teal-700 font-semibold text-xs rounded-full px-2 py-1 tracking-wide leading-none inline-block"
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
                <div class="mb-1 text-center align-middle">
                    <span class="text-green-700 font-bold text-base" v-text="property.formattedPrice"></span>
                    <span class="ml-1 text-sm text-gray-500">m.n.</span>
                </div>

                <hr>

                <div class="flex justify-center align-middle items-center">
                    <interested-btn :model="property"
                                    :id="property.slug"
                                    model-name="properties"
                                    endpoint="/properties"
                    ></interested-btn>
                    <a class="inline-block text-gray-700 hover:shadow-lg hover:text-indigo-500 tracking-wide text-sm font-bold mr-2 align-middle items-center"
                       :href="`https://www.facebook.com/sharer.php?u=` + currentUrl"
                       target="_blank"
                       title="Compartir">
                        <i class="fab fa-facebook text-blue-500 text-lg"></i>
                    </a>

                    <div class="mt-1 right-0 items-center align-middle px-4 text-green-500">
                        <a :href="property.meta.links.profile"
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
    </div>
</template>

<script>
export default {
    name: 'PropertyCard',
    props: {
        property: {
            required: true,
            type: Object,
        }
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
