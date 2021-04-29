<template>
    <div>
        <div class="flex-wrap md:flex sm:justify-center mt-3">

            <job-profile-card v-for="jobProfile in interestedJobProfiles"
                           :key="jobProfile.id"
                           :job-profile="jobProfile"
            ></job-profile-card>

            <div v-if="! interestedJobProfiles.length" class="flex-wrap md:flex sm:justify-center p-6 mt-3 items-center rounded-lg">
                <div class="container flex flex-col md:flex-row items-center justify-center px-5 text-gray-700">
                    <div class="max-w-md">
                        <div class="text-5xl font-dark font-bold">hmm..</div>
                        <p class="text-2xl md:text-3xl font-light leading-normal">Parece que aun no estás interesado en ningún Profesional de la construcción. </p>
                        <p class="mb-8 mt-4">Explora los perfiles de Técnicos, Profesionistas o Trabajadores del sector.</p>
                    </div>
                    <div class="max-w-lg">
                        <img src="/img/space.svg" alt="Houseify.io image">
                    </div>

                </div>
            </div>

        </div>
    </div>

</template>

<script>
export default {
    name: "InterestingJobProfiles",
    data() {
        return {
            interestedJobProfiles: [],
        }
    },
    methods: {
        getInterestingJobProfiles() {
            axios.get('/me/job-profiles/interested').then(response => {
                this.interestedJobProfiles = response.data.data
            }).catch(error => { dd(error) })
        },
        onToggleInterest() {
            Event.$on('interest-job-profiles', () => {
               this.getInterestingJobProfiles()
            })
        }
    },
    created() {
        this.getInterestingJobProfiles()
        this.onToggleInterest()
    },
    components: {
        JobProfileCard: () => import(/* webpackChunkName: "job-profile-card" */ '../../components/JobProfiles/JobProfileCard'),
    }
}
</script>

