
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
            propertyCategoriesByPropertyType: [],
            sellerId: this.property.seller.uuid,

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
                title: this.propertyForm.title,
                price: this.propertyForm.price,
                phone: this.propertyForm.phone,
                email: this.propertyForm.email,
                comments: this.propertyForm.comments,
            })
                .then(response => {
                    this.closeModal()
                    this.localProperty = response.data.data
                    SweetAlert.success(`La Propiedad ha sido actualizada exitosamente!`)
                })
                .catch(error => { this.errors = error.response.status === 422 ? error.response.data.errors : [] })
        },
        destroy() {
            axios.delete(`${this.endpoint}${this.localProperty.slug}`)
            .then(() => {
                setTimeout( () => {
                    window.location.href = `/propiedades` },
                    1500
                )
            }).catch(error => { console.log(error) })
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
                this.propertyForm.phone = this.localProperty.phone
                this.propertyForm.email = this.localProperty.email
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
        onDelete() {
            SweetAlert.danger(
                `Eliminar la Propiedad: ${this.localProperty.title}`,
                'La Propiedad ha sido eliminada exitosamente!',
            )
        },
        lookupPropertyCategories(propertyType) {
            this.propertyCategoriesByPropertyType = this.getPropertyCategories.filter(propertyCategory => {
                return propertyCategory.propertyType.id === propertyType.id
            })
        },
        copy() {
            let publicProfile = this.localProperty.meta.links.publicProfile
            navigator.clipboard.writeText(publicProfile)
            Event.$emit('copied')
            // publicProfile.select()
            // document.execCommand('copy')
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

        Event.$on('SweetAlert:destroy', () => { this.destroy() })

        Event.$on('properties.location', location => {
            this.localProperty.location = location
        })
        Event.$on('properties.features', features => {
            this.localProperty.propertyFeature = features
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
        Report: () => import(/* webpackChunkName: "report" */ '../../components/Report'),
        Errors: () => import(/* webpackChunkName: "errors" */ '../../components/Errors'),
        Divider: () => import(/* webpackChunkName: "divider" */ '../../components/Divider'),
        FormInput: () => import(/* webpackChunkName: "form-input" */ '../../components/FormInput'),
        PropertyLocation: () => import(/* webpackChunkName: "property-location" */ './PropertyLocation'),
        PropertyFeatures: () => import(/* webpackChunkName: "property-features" */ './PropertyFeatures'),
        InterestedBtn: () => import(/* webpackChunkName: "interested-btn" */ '../../components/InterestedBtn'),
        ActionMessage: () => import(/* webpackChunkName: "action-message" */ '../../components/ActionMessage'),
        CustomCarousel: () => import(/* webpackChunkName: "custom-carousel" */ '../../components/CustomCarousel'),
        PropertyImages: () => import(/* webpackChunkName: "property-images" */ '../../components/Properties/PropertyImages')
    }
}
</script>

<style scoped>

</style>
