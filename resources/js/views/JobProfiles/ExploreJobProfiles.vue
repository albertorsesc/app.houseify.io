<template>
    <div class="flex-wrap md:flex sm:justify-center mt-3">

            <template v-for="jobProfilesChunk in jobProfiles">

                <job-profile-card v-for="jobProfile in jobProfilesChunk"
                               :key="jobProfile.id"
                               :job-profile="jobProfile"
                ></job-profile-card>

            </template>

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
        JobProfileCard: () => import(/* webpackChunkName: "job-profile-card" */ '../../components/JobProfiles/JobProfileCard'),
    }
}
</script>
