<script>
import {mapGetters} from "vuex";

export default {
    name: "JobProfiles",
    data() {
        return {
            activeTab: 'explore-job-profiles',
            headerTitle: 'Técnicos y Profesionistas',
        }
    },
    watch: {
        activeTab() {
            if (this.activeTab === 'explore-job-profiles') {
                this.headerTitle = 'Técnicos y Profesionistas'
            }
            if (this.activeTab === 'my-job-profile') {
                this.headerTitle = 'Mi Perfil de Trabajo'
            }
            if (this.activeTab === 'my-interests') {
                this.headerTitle = 'Mis Intereses'
            }
            if (this.activeTab === 'search-job-profiles') {
                this.headerTitle = 'Búsqueda Avanzada de Profesionales'
            }
        }
    },
    components: {
        MyJobProfile: () => import(/* webpackChunkName: "job-profile" */ './MyJobProfile'),
        SearchJobProfiles: () => import(/* webpackChunkName: "search-job-profiles" */ './SearchJobProfiles'),
        ExploreJobProfiles: () => import(/* webpackChunkName: "explore-job-profiles" */ './ExploreJobProfiles'),
        InterestingJobProfiles: () => import(/* webpackChunkName: "interesting-job-profiles" */ './InterestingJobProfiles'),
    }
}
</script>

<style scoped>

</style>
