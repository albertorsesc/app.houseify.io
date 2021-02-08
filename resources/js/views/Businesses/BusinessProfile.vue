
<script>
import Alert from "../../components/Alert";
import Modal from "../../components/Modal";
import Errors from "../../components/Errors";
import Divider from "../../components/Divider";
import SweetAlert from "../../models/SweetAlert";
import BusinessLocation from "./BusinessLocation";
import FormInput from "../../components/FormInput";

export default {
    name: "BusinessProfile",
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
    data() {
        return {
            endpoint: '/api/businesses/',
            localBusiness: this.business,
            businessForm: {},

            modal: {},
            actionType: '',
            status: {
                btnTitle: this.business.status ? 'ocultar' : 'publicar',
                alertClass: this.business.status ? 'bg-green-200' : 'bg-gray-200',
                icon: this.business.status ? 'fas fa-eye-slash' : 'far fa-eye'
            },
            errors: []
        }
    },
    methods: {
        update() {
            axios.put(this.endpoint + this.localBusiness.slug, {
                email: this.businessForm.email ? this.businessForm.email : this.localBusiness.email,
                phone: this.businessForm.phone ? this.businessForm.phone : this.localBusiness.phone,
                site: this.businessForm.site ? this.businessForm.site : this.localBusiness.site,
                comments: this.businessForm.comments,
            })
                .then(response => {
                    this.closeModal()
                    this.localBusiness = response.data.data
                    SweetAlert.success(`Tu Negocio ha sido actualizado exitosamente!`)
                })
                .catch(error => { this.errors = error.response.status === 422 ? error.response.data.errors : [] })
        },
        toggle() {
            axios
                .put(this.endpoint + `/${this.localBusiness.slug}/toggle`)
                .then(() => {
                    this.localBusiness.status = ! this.localBusiness.status
                    let status = this.business.status ? 'Publicado' : 'Ocultado'
                    SweetAlert.success(`El Negocio ha sido ${status} exitosamente!`)
                })
                .catch(error => { this.errors = error.response.status === 422 ? error.response.data.errors : [] })
        },
        openModal(action) {
            this.modal = {}
            this.actionType = action
            this.errors = []

            if (action === 'put') {
                this.modal.id = 'update-business'

                // this.selectedPropertyType = this.localBusiness.businessCategory.businessType
                // this.getPropertyCategoriesByPropertyType(this.selectedPropertyType)
                // this.businessForm.businessCategory = this.localBusiness.businessCategory
                this.businessForm.name = this.localBusiness.name
                this.businessForm.email = this.localBusiness.email
                this.businessForm.phone = this.localBusiness.phone
                this.businessForm.site = this.localBusiness.site
                this.businessForm.comments = this.localBusiness.comments
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
            this.businessForm = {}
        },
    },
    components: {
        Alert,
        Modal,
        Errors,
        Divider,
        FormInput,
        BusinessLocation,
    }
}
</script>

<style scoped>

</style>
