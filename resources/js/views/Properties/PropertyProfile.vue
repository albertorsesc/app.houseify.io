
<script>
import Alert from "../../components/Alert";
import Modal from "../../components/Modal";
import VueMultiselect from 'vue-multiselect'
import Errors from "../../components/Errors";
import Divider from "../../components/Divider";
import SweetAlert from "../../models/SweetAlert";
import PropertyLocation from "./PropertyLocation";
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
            endpoint: '/api/properties/',
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
                    // SweetAlert.success(`La Propiedad ha sido actualizada exitosamente!`)
                    this.localProperty = response.data.data
                    SweetAlert.success(`La Propiedad ha sido actualizada exitosamente!`)
                    setTimeout(() => {
                        window.location.href = `/propiedades/${response.data.data.slug}` }, 1500)
                    })
                .catch(error => { this.errors = error.response.status === 422 ? error.response.data.errors : [] })
        },
        getPropertyTypes() {
            axios.get('/api/property-types')
                .then(response => { this.propertyTypes = response.data.data })
                .catch(error => { console.log(error) })
        },
        getBusinessTypes() {
            axios.get('/api/business-types')
                .then(response => { this.businessTypes = response.data.data })
                .catch(error => { console.log(error) })
        },
        getPropertyCategoriesByPropertyType(selectedPropertyType) {
            this.selectedPropertyType = selectedPropertyType ? selectedPropertyType : this.selectedPropertyType
            this.propertyForm.propertyCategory = {}
            axios.get(`/api/property-types/${this.selectedPropertyType.id}/property-categories`)
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
    mounted() {
        this.getPropertyTypes()
        this.getBusinessTypes()
    },
    components: {
        Alert,
        Modal,
        Errors,
        Divider,
        FormInput,
        CustomCarousel,
        VueMultiselect,
        PropertyLocation,
    }
}
</script>

<style scoped>

</style>
