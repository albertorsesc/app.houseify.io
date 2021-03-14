<script>
import MyBusinesses from "./MyBusinesses";
import SearchBusinesses from "./SearchBusinesses";
import ExploreBusinesses from "./ExploreBusinesses";
import InterestingBusinesses from "./InterestingBusinesses";

export default {
    name: "Businesses",
    data() {
        return {
            activeTab: 'explore-businesses',
            headerTitle: 'Negocios',
        }
    },
    components: {
        MyBusinesses,
        SearchBusinesses,
        ExploreBusinesses,
        InterestingBusinesses,
    }
}
</script>

<style scoped>

</style>
