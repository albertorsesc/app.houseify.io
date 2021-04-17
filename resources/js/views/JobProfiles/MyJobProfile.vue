<template>
    <div>
        <div v-if="! myJobProfile.length" class="items-center flex justify-center">
            <svg v-show="menuTab === 'my-job-profile'"
                 @click="toggle"
                 class="cursor-pointer h-8 w-8 text-emerald-300 hover:h-10 hover:w-10 hover:text-emerald-400 h-transform h-transition appearance-none" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <button v-show="menuTab === 'new-job-profile'"
                    @click="toggle">
                <svg class="cursor-pointer h-8 w-8 text-emerald-300 hover:h-10 hover:w-10 hover:text-emerald-400 h-transform h-transition appearance-none"
                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
                </svg>
            </button>
        </div>

        <div v-if="menuTab === 'new-job-profile' && ! myJobProfile.length">
            <create-job-profile></create-job-profile>
        </div>

        <div v-show="menuTab === 'my-job-profile'"
             class="flex-wrap md:flex sm:justify-center mt-3">

            <job-profile-card v-for="jobProfile in myJobProfile"
                              :key="jobProfile.id"
                              :job-profile="jobProfile"
            ></job-profile-card>

        </div>

        <div v-if="menuTab === 'my-job-profile' && ! myJobProfile.length"
             class="flex-wrap md:flex sm:justify-center p-6 mt-3 items-center rounded-lg">

            <div class="flex flex-col md:flex-row items-center align-middle justify-center px-5 text-gray-700">
                <div class="max-w-md md:mr-20">
                    <div class="text-3xl font-dark font-bold">
                        Crea tu perfil laboral y encuentra tu próximo proyecto.
                    </div>
                    <p class="mb-8 mt-4 text-2xl md:text-3xl">Expande tu cartera de clientes.</p>
                </div>
                <div class="max-w-full">
                    <img src="/img/hire.svg" alt="Houseify.io image">
                </div>

            </div>
        </div>

    </div>
</template>

<script>
export default {
    name: "MyJobProfile",
    data() {
        return {
            endpoint: '/me/job-profile',
            myJobProfile: [],
            menuTab: 'my-job-profile'
        }
    },
    methods: {
        index () {
            axios.get(this.endpoint).then(response => {
                this.myJobProfile = response.data.data
            }).catch(error => dd(error))
        },
        toggle() {
            this.menuTab = this.menuTab === 'my-job-profile' ? 'new-job-profile' : 'my-job-profile'
        }
    },
    mounted() {
        this.index()
        Event.$on('job-profiles.new-job-profile', jobProfile => {
            this.myJobProfile.unshift(jobProfile)
            this.menuTab = 'my-job-profile'
        })
    },
    components: {
        CreateJobProfile: () => import(/* webpackChunkName: "create-job-profile" */ './CreateJobProfile'),
        JobProfileCard: () => import(/* webpackChunkName: "job-profile-card" */ '../../components/JobProfiles/JobProfileCard'),
    }
}
</script>

<style scoped>

</style>
