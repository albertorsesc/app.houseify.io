<script>
export default {
    props: {
        business: {
            type: Object,
            required: true
        }
    },
    provide() {
        return {
            business: this.localBusiness
        }
    },
    data () {
        return {
            localBusiness: this.business,
        }
    },
    components: {
        Divider: () => import(/* webpackChunkName: "divider" */ '../../../components/Divider'),
        BusinessLocation: () => import(/* webpackChunkName: "business-location" */ '../BusinessLocation'),
        CustomCarousel: () => import(/* webpackChunkName: "custom-carousel" */ '../../../components/CustomCarousel'),
    }
}
</script>
