<script>
export default {
    name: "JobProfiles",
    data() {
        return {
            activeTab: 'explore-job-profiles',
            headerTitle: 'Tecnicos y Profesionistas',
        }
    },
    watch: {
        activeTab() {
            if (this.activeTab === 'explore-job-profiles') {
                this.headerTitle = 'Tecnicos y Profesionistas'
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
    }
}
</script>

<style scoped>

</style>
