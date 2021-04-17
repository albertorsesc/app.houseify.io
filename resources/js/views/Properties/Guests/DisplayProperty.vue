<script>
export default {
    props: {
        property: {
            type: Object,
            required: true
        }
    },
    provide() {
        return {
            property: this.localProperty
        }
    },
    data () {
        return {
            localProperty: this.property,
        }
    },
    components: {
        Divider: () => import(/* webpackChunkName: "divider" */ '../../../components/Divider'),
        PropertyLocation: () => import(/* webpackChunkName: "property-location" */ '../PropertyLocation'),
        PropertyFeatures: () => import(/* webpackChunkName: "property-features" */ '../PropertyFeatures'),
        CustomCarousel: () => import(/* webpackChunkName: "custom-carousel" */ '../../../components/CustomCarousel'),
    }
}
</script>
