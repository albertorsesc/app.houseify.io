<script>
import MyBusinesses from "./MyBusinesses";
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
        ExploreBusinesses,
        InterestingBusinesses,
    }
}
</script>

<style scoped>

</style>
