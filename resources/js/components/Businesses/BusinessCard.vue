<template>
    <div class="my-3 w-full sm:w-1/2 md:w-1/3 px-2 mt-8 md:mb-8 md:mt-4">
        <a :href="isAuthenticated ? business.meta.links.profile : business.meta.links.publicProfile">
            <div class="card transition hover:transform max-w-sm rounded-lg border border-gray-200 bg-white shadow-lg px-2 py-4">
                <div class="text-right align-middle items-end">
                    <div class="flex justify-end">
                        <span class="text-xs text-gray-500 items-center"
                              v-text="business.meta.updatedAt"
                        ></span>
                        <span v-if="isAuthenticated"
                              class="-mt-3 ml-3"
                              @click.prevent>
                            <interested-btn :model="business"
                                            :id="business.slug"
                                            model-name="businesses"
                                            endpoint="/businesses"
                            ></interested-btn>
                        </span>
                    </div>
                </div>

                <!--Logo-->
                <div class="flex items-center relative mb-3">
<!--                    <div class="border-t border-gray-200 z-20 w-full"></div>-->
                    <div class="rounded-full border border-emerald-200 bg-white z-20 px-1 py-1 inline-block absolute mx-8 mb-8">
                        <img v-if="business.logo && business.logo.includes('png')"
                             :src="business.logo.replace('public', 'storage')"
                             class="inline-block object-cover object-center rounded-full h-20 w-20"
                             loading="lazy"
                             :alt="business.name">
                        <img v-else
                             src="/logos/houseify-13.png"
                             class="text-white inline-block object-contain rounded-full h-20 w-20"
                             loading="lazy"
                             alt="Houseify.io">
                    </div>
                </div>

                <div class="px-8 pb-1 w-full mt-8 items-center">

                    <div class="flex mb-2">
                        <h2 class="text-gray-800 text-xl font-bold"
                            v-text="limitString(business.name,25)"
                        ></h2>
                    </div>

                    <div class="text-sm border-t border-gray-500 leading-relaxed font-medium py-2">
                        <div class="flex justify-start align-middle items-center text-gray-700">
                            <div class="flex">
                                <span v-if="business.location && business.location.city"
                                      :title="business.location.city"
                                      class="mr-2">
                                    {{ limitString(business.location.city, 15) }},
                                </span>
                                <span v-if="business.location && business.location.state"
                                      v-text="'  ' + business.location.state.code"
                                      class="mr-2">
                                </span>
                            </div>
                             &bullet;
                            <span v-if="business.phone && ! business.email"
                                  v-text="formatPhone(business.phone)"
                                  class="ml-2"
                            ></span>
                            <span v-if="business.email && ! business.phone"
                                  v-text="business.email"
                                  class="ml-2"
                            ></span>
                            <span v-if="business.email && business.phone"
                                  v-text="business.phone"
                                  class="ml-2"
                            ></span>
                        </div>
                    </div>

                </div>

                <!--Categories-->
                <div class="flex justify-start px-8 text-left items-start align-middle">
                    <div class="mr-1 px-3 py-1 text-xs bg-emerald-100 font-medium leading-5 text-emerald-900 rounded-full shadow-sm"
                         v-for="(category, index) in business.categories"
                         :key="index"
                         v-if="index <= 2"
                         v-text="category"
                    ></div>
                </div>
            </div>
        </a>
    </div>
</template>

<script>

export default {
    props: {
        business: {
            type: Object,
            required: true
        }
    },
    components: {
        Divider: () => import(/* webpackChunkName: "divider" */ '../Divider'),
        InterestedBtn: () => import(/* webpackChunkName: "interested-btn" */ '../InterestedBtn'),
    }
}
</script>
