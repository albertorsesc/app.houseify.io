
<script>
import { mapGetters } from 'vuex'
import VueMultiselect from 'vue-multiselect'
import SweetAlert from "../../models/SweetAlert";

export default {
    name: "PropertyProfile",
    props: {
        property: {
            required: true,
            type: Object,
        }
    },
    provide() {
        return {
            property: this.localProperty
        }
    },
    data () {
        return {
            endpoint: '/properties/',
            propertyForm: {},
            localProperty: this.property,
            selectedPropertyType: {},
            selectedPropertyCategory: {},

            propertyTypes: [],
            businessTypes: [],
            propertyCategoriesByPropertyType: [],

            modal: {},
            actionType: '',
            status: {
                btnTitle: this.property.status ? 'ocultar' : 'publicar',
                alertClass: this.property.status ? 'bg-green-200' : 'bg-gray-200',
                icon: this.property.status ? 'fas fa-eye-slash' : 'far fa-eye'
            },
            errors: []
        }
    },
    methods: {
        update() {
            axios.put(this.endpoint + this.localProperty.slug, {
                property_category_id: this.selectedPropertyCategory.id,
                business_type: this.propertyForm.businessType ? this.propertyForm.businessType : this.localProperty.businessType,
                title: this.propertyForm.title ? this.propertyForm.title : this.localProperty.title,
                price: this.propertyForm.price ? this.propertyForm.price : this.localProperty.price,
                comments: this.propertyForm.comments,
            })
                .then(response => {
                    this.closeModal()
                    this.localProperty = response.data.data
                    SweetAlert.success(`La Propiedad ha sido actualizada exitosamente!`)
                })
                .catch(error => { this.errors = error.response.status === 422 ? error.response.data.errors : [] })
        },
        toggle() {
            axios
                .put(`/properties/${this.localProperty.slug}/toggle`)
                .then(() => {
                    this.localProperty.status = ! this.localProperty.status
                    let status = this.localProperty.status ? 'Publicada' : 'Ocultada'
                    SweetAlert.success(`La Propiedad ha sido ${status} exitosamente!`)
                })
                .catch(error => { this.errors = error.response.status === 422 ? error.response.data.errors : [] })
        },
        getPropertyCategoriesByPropertyType(propertyType) {
            propertyType = this.selectedPropertyType
            this.selectedPropertyCategory = {}

            axios.get(`/property-types/${propertyType.id}/property-categories`)
                .then(response => { this.propertyCategoriesByPropertyType = response.data.data; })
                .catch(error => {
                    console.log('this is error ' + error)
                })
        },
        retrievePropertyCategories(selected) {
            this.selectedPropertyCategory = {}

            axios.get(`/property-types/${selected.id}/property-categories`)
                .then(response => { this.propertyCategoriesByPropertyType = response.data.data; })
                .catch(error => {
                    console.log('other error: ' + error)
                })
        },
        openModal(action) {
            this.modal = {}
            this.actionType = action
            this.errors = []

            if (action === 'put') {
                this.modal.id = 'update-property'

                this.selectedPropertyType = this.localProperty.propertyCategory.propertyType
                this.lookupPropertyCategories(this.selectedPropertyType)
                this.propertyForm.propertyCategory = this.selectedPropertyCategory = this.localProperty.propertyCategory
                this.propertyForm.businessType = this.localProperty.businessType
                this.propertyForm.title = this.localProperty.title
                this.propertyForm.price = this.localProperty.price
                this.propertyForm.comments = this.localProperty.comments
            }

            if (action === 'report') {
                this.modal = {
                    id: 'reports',
                }
            }

            Event.$emit(`${this.modal.id}:open`)
        },
        closeModal() {
            Event.$emit(`${this.modal.id}:close`)
            this.errors = []
            this.actionType = ''
            this.modal = {}
            this.propertyForm = {}
            this.selectedPropertyType = {}
            this.selectedPropertyCategory = {}
        },
        lookupPropertyCategories(propertyType) {
            this.propertyCategoriesByPropertyType = this.getPropertyCategories.filter(propertyCategory => {
                return propertyCategory.propertyType.id === propertyType.id
            })
        },
    },
    computed: {
        ...mapGetters({
            getBusinessTypes: 'properties/getBusinessTypes',
            getPropertyTypes: 'properties/getPropertyTypes',
            getPropertyCategories: 'properties/getPropertyCategories',
        }),
    },
    created() {
        this.$store.dispatch('properties/fetchPropertyTypes')
        this.$store.dispatch('properties/fetchPropertyCategories')
        this.$store.dispatch('properties/fetchBusinessTypes')

        Event.$on('properties.location', location => {
            this.localProperty.location = location
        })
    },
    watch: {
        /*selectedPropertyCategory: function() {
            this.propertyForm.propertyCategory = this.selectedPropertyCategory
        },*/
        selectedPropertyType: function () {
            // this.selectedPropertyCategory = {}
        },
    },
    components: {
        VueMultiselect,
        Alert: () => import(/* webpackChunkName: "alert" */ '../../components/Alert'),
        Modal: () => import(/* webpackChunkName: "modal" */ '../../components/Modal'),
        Errors: () => import(/* webpackChunkName: "errors" */ '../../components/Errors'),
        Report: () => import(/* webpackChunkName: "report" */ '../../components/Report'),
        Divider: () => import(/* webpackChunkName: "divider" */ '../../components/Divider'),
        FormInput: () => import(/* webpackChunkName: "form-input" */ '../../components/FormInput'),
        PropertyLocation: () => import(/* webpackChunkName: "property-location" */ './PropertyLocation'),
        PropertyFeatures: () => import(/* webpackChunkName: "property-features" */ './PropertyFeatures'),
        CustomCarousel: () => import(/* webpackChunkName: "custom-carousel" */ '../../components/CustomCarousel'),
        PropertyImages: () => import(/* webpackChunkName: "property-images" */ '../../components/Properties/PropertyImages')
    }
}
</script>

<style scoped>

</style>
