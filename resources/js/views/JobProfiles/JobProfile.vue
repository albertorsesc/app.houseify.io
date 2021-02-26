<script>
import MyJobProfile from "./MyJobProfile";
import Rating from "../../components/Rating";

export default {
    name: "JobProfile",
    props: {
        jobProfile: {
            type: Object,
            required: true,
        }
    },
    data() {
        return {

        }
    },
    components: {
        Rating,
        MyJobProfile,
    }
}
</script>

<style scoped>

</style>
