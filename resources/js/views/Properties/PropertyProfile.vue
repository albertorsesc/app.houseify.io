
<script>
import Alert from "../../components/Alert";
import Modal from "../../components/Modal";
import VueMultiselect from 'vue-multiselect'
import Errors from "../../components/Errors";
import Divider from "../../components/Divider";
import FormInput from "../../components/FormInput";
import CustomCarousel from "../../components/CustomCarousel";

export default {
    name: "PropertyProfile",
    data () {
        return {
            property: {},
            propertyForm: {},
            selectedPropertyType: {},

            propertyTypes: [],
            businessTypes: [],
            propertyCategoriesByPropertyType: [],

            modal: {},
            actionType: '',
            errors: []
        }
    },
    methods: {
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

                // this.selectedPropertyType = this.property.propertyCategory.propertyType
                // this.getPropertyCategoriesByPropertyType()
                this.propertyForm.propertyCategory = this.property.propertyCategory
                this.propertyForm.businessType = this.property.businessType
                this.propertyForm.title = this.property.title
                this.propertyForm.price = this.property.price
                this.propertyForm.comments = this.property.comments
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
        VueMultiselect,
        CustomCarousel,
    }
}
</script>

<style scoped>

</style>
