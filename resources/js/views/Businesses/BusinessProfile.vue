
<script>
import { mapGetters } from 'vuex'
import VueMultiselect from 'vue-multiselect'
import SweetAlert from "../../models/SweetAlert";

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
            endpoint: '/businesses/',
            localBusiness: this.business,
            businessForm: {},

            selectedConstructionCategories: [],

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
                categories: this.businessForm.categories ? this.businessForm.categories : this.localBusiness.categories,
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
                this.businessForm.categories = this.selectedConstructionCategories = this.localBusiness.categories
                this.businessForm.name = this.localBusiness.name
                this.businessForm.categories = this.localBusiness.categories
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
    watch: {
        selectedConstructionCategories () {
            this.businessForm.categories = this.selectedConstructionCategories
        }
    },
    computed: {
        ...mapGetters({
            getConstructionCategories: 'global/getConstructionCategories'
        })
    },
    created() {
        this.$store.dispatch('global/fetchConstructionCategories')

        Event.$on('businesses.location', location => {
            this.localBusiness.location = location
        })
    },
    components: {
        VueMultiselect,
        Alert: () => import(/* webpackChunkName: "alert" */ '../../components/Alert'),
        Modal: () => import(/* webpackChunkName: "modal" */ '../../components/Modal'),
        Report: () => import(/* webpackChunkName: "report" */ '../../components/Report'),
        Errors: () => import(/* webpackChunkName: "errors" */ '../../components/Errors'),
        Divider: () => import(/* webpackChunkName: "divider" */ '../../components/Divider'),
        FormInput: () => import(/* webpackChunkName: "form-input" */ '../../components/FormInput'),
        BusinessLocation: () => import(/* webpackChunkName: "business-location" */ './BusinessLocation'),
    }
}
</script>

<style scoped>

</style>
