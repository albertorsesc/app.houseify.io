<template>
    <div>
        <div class="flex-wrap md:flex sm:justify-center mt-3"
             v-if="jobProfiles[0] && jobProfiles[0].length !== 0"
             v-for="(jobProfileChunk, index) in jobProfiles"
             :key="index">

            <job-profile-card v-for="jobProfile in jobProfileChunk"
                              :key="jobProfile.id"
                              :job-profile="jobProfile"
            ></job-profile-card>

        </div>

        <div v-if="jobProfiles[0] && jobProfiles[0].length === 0"
             class="flex-wrap md:flex sm:justify-center p-6 mt-3 items-center rounded-lg"
             v-cloak>
            <div class="container flex flex-col md:flex-row items-center justify-center px-5 text-gray-700">
                <div class="max-w-md md:mr-20">
                    <div class="text-3xl font-dark font-bold">Se el primero en publicarse y ofrece tus servicios relacionados con la Construcción..</div>
                    <p class="mb-8 mt-4 text-2xl md:text-3xl">No hay Técnicos o Profesionales de la construcción registrados por el momento..</p>
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
    name: "ExploreJobProfiles",
    data() {
        return {
            endpoint: '/job-profiles',
            jobProfiles: [],

            totalPages: 0,
            currentPage: 1,
        }
    },
    methods: {
        index () {
            axios.get(this.endpoint + `?page=${this.currentPage}`)
                .then(response => {
                    let data = response.data
                    this.jobProfiles.push(data.data)
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
    }
}
</script>
