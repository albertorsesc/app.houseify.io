<script>
export default {
    name: 'DisplayJobProfile',
    props: {
        jobProfile: {
            type: Object,
            required: true
        }
    },
    provide() {
        return {
            jobProfile: this.localJobProfile
        }
    },
    data () {
        return {
            localJobProfile: this.jobProfile,
        }
    },
    components: {
        Divider: () => import(/* webpackChunkName: "divider" */ '../../../components/Divider'),
        JobProfileLocation: () => import(/* webpackChunkName: "job-profile-location" */ '../JobProfileLocation'),
        CustomCarousel: () => import(/* webpackChunkName: "custom-carousel" */ '../../../components/CustomCarousel'),
    }
}
</script>
