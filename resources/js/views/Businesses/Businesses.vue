<script>
import {mapGetters} from "vuex";

export default {
    name: "Businesses",
    data() {
        return {
            activeTab: 'explore-businesses',
            headerTitle: 'Negocios',
        }
    },
    computed: {
        ...mapGetters({
            getStates: 'global/getStates'
        })
    },
    created() {
        this.$store.dispatch('global/fetchStates')
    },
    components: {
        MyBusinesses: () => import(/* webpackChunkName: "my-businesses" */ './MyBusinesses'),
        SearchBusinesses: () => import(/* webpackChunkName: "search-businesses" */ './SearchBusinesses'),
        ExploreBusinesses: () => import(/* webpackChunkName: "explore-businesses" */ './ExploreBusinesses'),
        InterestingBusinesses: () => import(/* webpackChunkName: "interesting-businesses" */ './InterestingBusinesses'),
    }
}
</script>

<style scoped>

</style>
