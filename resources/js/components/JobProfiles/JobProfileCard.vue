<template>

<!--    <ul class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">-->
        <div class="my-2 w-full flex flex-col sm:w-2/3 md:w-1/2 lg:w-1/3 px-3">
            <div class="card transition hover:transform divide-y divide-gray-200">
                <div class="w-full flex items-center justify-between px-4 py-3 space-x-6">
                    <div class="flex-1 truncate py-2">
                        <div class="items-center">
                            <h3 class="-mb-2 text-gray-900 text-sm font-medium truncate"
                                v-text="jobProfile.user.fullName"
                            ></h3>
                            <!--Skills-->
                            <span class="flex-1 mr-1 inline-block px-2 py-0.5 text-green-800 text-xs font-medium bg-green-100 rounded-full"
                                  v-for="(skill, index) in jobProfile.skills"
                                  :key="index"
                                  v-if="index <= 2"
                                  v-text="skill"
                            ></span>
                        </div>
                        <p class="mt-2 text-gray-500 text-sm truncate"
                           v-if="jobProfile.location && (jobProfile.location.city || jobProfile.location.state)"
                           v-text="jobProfile.location.city + ', ' + jobProfile.location.state.code">
                        </p>
                        <div v-if="isAuthenticated" class="flex-wrap truncate">
                            <span class="" @click.prevent>
                                <interested-btn :model="jobProfile"
                                                :id="jobProfile.uuid"
                                                model-name="job-profiles"
                                                endpoint="/job-profiles"
                                ></interested-btn>
                            </span>
                        </div>
                    </div>

<!--                    <img class="w-24 h-24 bg-gray-300 rounded-lg shadow-lg flex-shrink-0"
                         src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=4&amp;w=256&amp;h=256&amp;q=60"
                         alt="">-->
                    <img v-if="jobProfile.photo !== null && jobProfile.photo.includes('png')"
                         :src="jobProfile.photo.replace('public', 'storage')"
                         class="w-24 h-24 bg-white rounded-lg shadow-lg flex-shrink-0 object-cover"
                         loading="lazy"
                         :alt="jobProfile.user.fullName">
                    <span v-else class="h-24 w-24 bg-white rounded-lg shadow-md flex-shrink-0">
                        <svg class="w-full h-full font-light text-gray-200"
                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    </span>
                </div>
                <div>
                    <div class="-mt-px flex divide-x divide-gray-200">
                        <div class="w-0 flex-1 flex">
                            <!--Display Phone-->
                            <span v-if="jobProfile.phone && ! jobProfile.email"
                                  class="lg:relative -mr-px w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-transparent rounded-bl-lg hover:text-gray-500">
                                <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                                <span class="ml-3 text-xs cursor-pointer"
                                      v-if="! showPhone"
                                      @click="showPhone = true">
                                    Ver Teléfono
                                </span>
                                <span class="ml-3 text-xs"
                                      v-show="showPhone"
                                      v-text="formatPhone(jobProfile.phone)"
                                ></span>
                            </span>
                            <!--Display Email-->
                            <span v-if="jobProfile.email && ! jobProfile.phone"
                                  class="lg:relative -mr-px w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-transparent rounded-bl-lg hover:text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                                <span class="ml-3 text-xs cursor-pointer"
                                      v-if="! showEmail"
                                      @click="showEmail = true">
                                    Ver Correo Electronico
                                </span>
                                <span class="ml-3 text-xs"
                                      v-show="showEmail"
                                      v-text="jobProfile.email"
                                ></span>
                            </span>
                            <!--Display only Phone-->
                            <span v-if="jobProfile.phone && jobProfile.email"
                                  class="lg:relative -mr-px w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-transparent rounded-bl-lg hover:text-gray-500">
                                <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                                <span class="ml-3 text-xs cursor-pointer"
                                      v-if="! showPhone"
                                      @click="showPhone = true">
                                    Ver Teléfono
                                </span>
                                <span class="ml-3 text-xs"
                                      v-show="showPhone"
                                      v-text="formatPhone(jobProfile.phone)"
                                ></span>
                            </span>
                        </div>
                        <div class="-ml-px w-0 flex-1 flex">
                            <a :href="isAuthenticated ? jobProfile.meta.links.profile : jobProfile.meta.links.publicProfile"
                               class="lg:relative w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-transparent rounded-br-lg hover:text-gray-500">
                                <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span class="ml-3">Perfil</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!--    </ul>-->

</template>

<script>
export default {
    name: "JobProfileCard",
    props: {
        jobProfile: {
            type: Object,
            required: true,
        }
    },
    data() {
        return {
            showPhone: false,
            showEmail: false,
        }
    },
    components: {
        InterestedBtn: () => import(/* webpackChunkName: "interested-btn" */ '../InterestedBtn')
    }
}
</script>
