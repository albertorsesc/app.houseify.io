<template>
    <div class="my-3 w-full sm:w-1/2 md:w-1/3 px-2 mt-8 md:mb-8 md:mt-4">
        <a :href="business.meta.profile">
            <div class="card transition hover:transform max-w-sm rounded-lg border border-gray-200 bg-white shadow-lg px-2 py-4">
                <div class="text-right align-middle items-end">
                    <div class="flex justify-end">
                        <span class="text-xs text-gray-500 items-center"
                              v-text="business.meta.updatedAt"
                        ></span>
                        <span class="-mt-3 ml-3" @click.prevent>
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
                    <div class="border-t border-gray-200 z-20 w-full"></div>

                    <div class="rounded-full border border-emerald-200 bg-white z-20 p-3 inline-block absolute mx-8 mb-8">
                        <img src="/logos/houseify-13.png" class="text-white inline-block object-contain h-20 w-20" alt="">
                    </div>
                </div>

                <!--Rating-->
                <div class="flex justify-end -mt-3 pt-2">
                    <svg class="ml-10 h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                    </svg>
                    <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                    </svg>
                    <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                    </svg>
                    <svg class="h-5 w-5 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                    </svg>
                    <svg class="h-5 w-5 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                    </svg>
                </div>

                <div class="px-8 pb-1 w-full mt-4 items-center">

                    <div class="flex items-center">
                        <h2 class="text-gray-800 text-xl font-bold"
                            v-text="business.name"
                        ></h2>
                    </div>

                    <div class="text-xs border-t border-gray-300 py-2">
                        <div class="flex justify-start"
                             v-if="business.location || business.phone">
                            <span v-if="business.location">
                                {{ business.location.city }}
                            </span>, {{ business.location.state.code }} - Mexico
                            <span class="mx-2">&bullet;</span>
                            <span v-text="business.phone"></span>
                        </div>
                    </div>

                </div>

                <!--Categories-->
                <div class="flex justify-evenly text-left items-start align-middle px-2">
                    <div class="px-3 py-1 text-xs bg-emerald-100 font-medium leading-5 text-emerald-900 rounded-full shadow-sm"
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
        InterestedBtn: () => import(/* webpackChunkName: "interested-btn" */ '../InterestedBtn')
    }
}
</script>
