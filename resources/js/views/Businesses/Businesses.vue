<script>
export default {
    name: "Businesses",
    data() {
        return {
            activeTab: 'explore-businesses',
            headerTitle: 'Negocios',
        }
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
