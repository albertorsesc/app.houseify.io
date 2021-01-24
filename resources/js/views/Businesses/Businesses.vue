<script>
import MyBusinesses from "./MyBusinesses";
import ExploreBusinesses from "./ExploreBusinesses";

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
    }
}
</script>

<style scoped>

</style>
