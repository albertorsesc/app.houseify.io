<script>
import Notifications from "./Notifications";
import Subscriptions from "./Subscriptions";

export default {
    name: "Profile",
    data() {
        return {
            activeTab: 'profile',
        }
    },
    components: {
        Notifications,
        Subscriptions,
    }
}
</script>

<style scoped>

</style>
