
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
    emits: [
        'SweetAlert:destroy',
        'businesses.location',
    ],
    data() {
        return {
            endpoint: '/businesses/',
            localBusiness: this.business,
            businessForm: {
                name: '',
                categories: [],
                email: '',
                phone: '',
                facebookProfile: '',
                linkedinProfile: '',
                site: '',
                comments: '',
            },
            logo: '',

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
                facebook_profile: this.businessForm.facebookProfile ? this.businessForm.facebookProfile : this.localBusiness.facebookProfile,
                linkedin_profile: this.businessForm.linkedinProfile ? this.businessForm.linkedinProfile : this.localBusiness.linkedinProfile,
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
        destroy() {
            axios.delete(`${this.endpoint}${this.localBusiness.slug}`)
                .then(() => {
                    setTimeout( () => {
                            window.location.href = `/directorio-de-negocios` },
                        1500
                    )
                }).catch(error => { console.log(error) })
        },
        toggle() {
            axios
                .put(this.endpoint + `${this.localBusiness.slug}/toggle`)
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

                this.businessForm.categories = this.selectedConstructionCategories = this.localBusiness.categories
                this.businessForm.name = this.localBusiness.name
                this.businessForm.categories = this.localBusiness.categories
                this.businessForm.email = this.localBusiness.email
                this.businessForm.phone = this.localBusiness.phone
                this.businessForm.facebookProfile = this.localBusiness.facebookProfile
                this.businessForm.linkedinProfile = this.localBusiness.linkedinProfile
                this.businessForm.site = this.localBusiness.site
                this.businessForm.comments = this.localBusiness.comments
            }

            if (action === 'report') {
                this.modal = {
                    id: 'reports',
                }
            }

            window.Event.$emit(`${this.modal.id}:open`)
        },
        closeModal() {
            window.Event.$emit(`${this.modal.id}:close`)
            this.errors = []
            this.actionType = ''
            this.modal = {}
            this.businessForm = {}
        },
        handleImage(e) {
            let reader = new FileReader()
            let target = e.target
            reader.readAsDataURL(target.files[0])

            reader.onloadend = (file) => {
                this.logo = reader.result
            }

            /*axios.put(`/businesses/${this.localBusiness.slug}/image`, {
                logo: this.logo
            }).then(response => {
                dd(response)
            }).catch(error => dd(error))*/
        },
        onDelete() {
            SweetAlert.danger(
                `Eliminar el Negocio/Empresa: ${this.localBusiness.name}`,
                'El Negocio/Empresa ha sido eliminado exitosamente!',
            )
        },
    },
    watch: {
        selectedConstructionCategories () {
            this.businessForm.categories = this.selectedConstructionCategories
        }
    },
    computed: {
        ...mapGetters({
            getConstructionCategories: 'general/getConstructionCategories',
            getStates: 'general/getStates'
        })
    },
    created() {
        window.Event.$on('SweetAlert:destroy', () => { this.destroy() })
        window.Event.$on('businesses.location', location => {
            this.localBusiness.location = location
            setTimeout(() => {
                window.location.reload()
            }, 1300)
        })

        if (this.isAuthenticated) {
            this.$store.dispatch('general/fetchConstructionCategories')
            this.$store.dispatch('general/fetchStates')
        }
    },
    components: {
        VueMultiselect,
        Likes: () => import(/* webpackChunkName: "likes" */ '../../components/Likes'),
        Alert: () => import(/* webpackChunkName: "alert" */ '../../components/Alert'),
        Modal: () => import(/* webpackChunkName: "modal" */ '../../components/Modal'),
        Report: () => import(/* webpackChunkName: "report" */ '../../components/Report'),
        Errors: () => import(/* webpackChunkName: "errors" */ '../../components/Errors'),
        Divider: () => import(/* webpackChunkName: "divider" */ '../../components/Divider'),
        GoogleMap: () => import(/* webpackChunkName: "google-map" */ '../../components/GoogleMap'),
        FormInput: () => import(/* webpackChunkName: "form-input" */ '../../components/FormInput'),
        BusinessLocation: () => import(/* webpackChunkName: "business-location" */ './BusinessLocation'),
        InterestedBtn: () => import(/* webpackChunkName: "interested-btn" */ '../../components/InterestedBtn'),
    }
}
</script>

<style scoped>

</style>
