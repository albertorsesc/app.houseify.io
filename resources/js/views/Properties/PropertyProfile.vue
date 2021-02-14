
<script>
import { mapGetters } from 'vuex'
import Alert from "../../components/Alert";
import Modal from "../../components/Modal";
import VueMultiselect from 'vue-multiselect'
import Errors from "../../components/Errors";
import Divider from "../../components/Divider";
import SweetAlert from "../../models/SweetAlert";
import PropertyLocation from "./PropertyLocation";
import PropertyFeatures from "./PropertyFeatures";
import FormInput from "../../components/FormInput";
import CustomCarousel from "../../components/CustomCarousel";

export default {
    name: "PropertyProfile",
    props: {
        property: {
            required: true,
            type: Object,
        }
    },
    data () {
        return {
            endpoint: '/properties/',
            propertyForm: {},
            localProperty: this.property,
            selectedPropertyType: {},

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
                property_category_id: this.propertyForm.propertyCategory ? this.propertyForm.propertyCategory.id : this.localProperty.propertyCategory.id,
                business_type: this.propertyForm.businessType ? this.propertyForm.businessType : this.localProperty.businessType,
                title: this.propertyForm.title ? this.propertyForm.title : this.localProperty.title,
                price: this.propertyForm.price ? this.propertyForm.price : this.localProperty.price,
                comments: this.propertyForm.comments,
            })
                .then(response => {
                    this.closeModal()
                    this.localProperty = response.data.data
                    SweetAlert.success(`La Propiedad ha sido actualizada exitosamente!`)

                    if (this.property.slug !== response.data.data.slug) {
                        setTimeout(() => {
                            window.location.href = `/propiedades/${response.data.data.slug}`
                        }, 1500)
                    }
                })
                .catch(error => { this.errors = error.response.status === 422 ? error.response.data.errors : [] })
        },
        toggle() {
            axios
                .put(`/properties/${this.localProperty.slug}/toggle`)
                .then(() => {
                    this.localProperty.status = ! this.localProperty.status
                    let status = this.property.status ? 'Ocultada' : 'Publicada'
                    SweetAlert.success(`La Propiedad ha sido ${status} exitosamente!`)
                })
                .catch(error => { this.errors = error.response.status === 422 ? error.response.data.errors : [] })
        },
        getPropertyCategoriesByPropertyType(selectedPropertyType) {
            this.selectedPropertyType = selectedPropertyType ? selectedPropertyType : this.selectedPropertyType
            this.propertyForm.propertyCategory = {}
            axios.get(`/property-types/${this.selectedPropertyType.id}/property-categories`)
                .then(response => { this.propertyCategoriesByPropertyType = response.data.data })
                .catch(error => { console.log(error) })
        },
        openModal(action) {
            this.modal = {}
            this.actionType = action
            this.errors = []

            if (action === 'put') {
                this.modal.id = 'update-property'

                this.selectedPropertyType = this.localProperty.propertyCategory.propertyType
                this.getPropertyCategoriesByPropertyType(this.selectedPropertyType)
                this.propertyForm.propertyCategory = this.localProperty.propertyCategory
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

            if (action === 'get-images') {
                this.modal = {
                    id: 'get-images',
                    maxWidth: 'sm:max-w-screen-lg',
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
        },
    },
    created() {
        this.$store.dispatch('properties/fetchPropertyTypes')
        this.$store.dispatch('properties/fetchBusinessTypes')

        Event.$on('properties.location', location => {
            this.localProperty.location = location
        })
    },
    provide() {
        return {
            property: this.localProperty
        }
    },
    computed: {
        ...mapGetters({
            getStates: 'global/getStates',
            getPropertyTypes: 'properties/getPropertyTypes',
            getBusinessTypes: 'properties/getBusinessTypes'
        })
    },
    components: {
        Alert,
        Modal,
        Errors,
        Divider,
        FormInput,
        CustomCarousel,
        VueMultiselect,
        PropertyFeatures,
        PropertyLocation,
    }
}
</script>

<style scoped>

</style>
