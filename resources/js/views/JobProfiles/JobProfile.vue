<script>
import MyJobProfile from "./MyJobProfile";
import Report from "../../components/Report";
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
            localJobProfile: this.jobProfile,
        }
    },
    components: {
        Rating,
        Report,
        MyJobProfile,
    }
}
</script>

<style scoped>

</style>
