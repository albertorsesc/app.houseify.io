<script>
import {mapGetters} from "vuex";
import VueMultiselect from "vue-multiselect";
import SweetAlert from "../../models/SweetAlert";

export default {
    name: "JobProfile",
    props: {
        jobProfile: {
            type: Object,
            required: true,
        }
    },
    provide() {
        return {
            jobProfile: this.localJobProfile
        }
    },
    data() {
        return {
            endpoint: `/job-profiles`,
            localJobProfile: this.jobProfile,
            jobProfileForm: {},
            selectedSkills: [],

            modal: {},
            actionType: '',
            status: {
                btnTitle: this.jobProfile.status ? 'ocultar' : 'publicar',
                alertClass: this.jobProfile.status ? 'bg-green-200' : 'bg-gray-200',
                icon: this.jobProfile.status ? 'fas fa-eye-slash' : 'far fa-eye'
            },
            errors: []
        }
    },
    methods: {
        update() {
            axios.put(`${this.endpoint}/${this.localJobProfile.uuid}`, {
                title: this.jobProfileForm.title ? this.jobProfileForm.title : null,
                skills: this.selectedSkills ? this.selectedSkills : this.localJobProfile.skills,
                email: this.jobProfileForm.email ? this.jobProfileForm.email : null,
                phone: this.jobProfileForm.phone ? this.jobProfileForm.phone : null,
                site: this.jobProfileForm.site ? this.jobProfileForm.site : null,
                facebook_profile: this.jobProfileForm.facebookProfile ? this.jobProfileForm.facebookProfile : null,
                linkedin_profile: this.jobProfileForm.linkedinProfile ? this.jobProfileForm.linkedinProfile : null,
                bio: this.jobProfileForm.bio ? this.jobProfileForm.bio : null,
            })
                .then(response => {
                    this.closeModal()
                    this.localJobProfile = response.data.data
                    SweetAlert.success(`Tu Negocio ha sido actualizado exitosamente!`)
                })
                .catch(error => { this.errors = error.response.status === 422 ? error.response.data.errors : [] })
        },
        destroy() {
            axios.delete(`${this.endpoint}/${this.localJobProfile.uuid}`)
                .then(() => {
                    setTimeout( () => {
                            window.location.href = `/tecnicos-y-profesionistas` },
                        1500
                    )
                }).catch(error => { console.log(error) })
        },
        toggle() {
            axios
                .put(this.endpoint + `/${this.localJobProfile.uuid}/toggle`)
                .then(() => {
                    this.localJobProfile.status = ! this.localJobProfile.status
                    let status = this.jobProfile.status ? 'Publicado' : 'Ocultado'
                    SweetAlert.success(`El Perfil ha sido ${status} exitosamente!`)
                })
                .catch(error => {})
        },
        openModal(action) {
            this.modal = {}
            this.actionType = action
            this.errors = []

            if (action === 'put') {
                this.modal.id = 'update-job-profile'

                this.jobProfileForm.skills = this.selectedSkills = this.localJobProfile.skills
                this.jobProfileForm.title = this.localJobProfile.title
                this.jobProfileForm.birthdateAt = this.localJobProfile.birthdateAt
                this.jobProfileForm.email = this.localJobProfile.email
                this.jobProfileForm.phone = this.localJobProfile.phone
                this.jobProfileForm.site = this.localJobProfile.site
                this.jobProfileForm.facebookProfile = this.localJobProfile.facebookProfile
                this.jobProfileForm.bio = this.localJobProfile.bio
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
            this.jobProfileForm = {}
        },
        onDelete() {
            SweetAlert.danger(
                `Eliminar tu Perfil de Trabajo: ${this.localJobProfile.title}`,
                'Tu Perfil ha sido eliminado exitosamente!',
            )
        },
    },
    computed: {
        ...mapGetters({
            getSkills: 'jobProfiles/getSkills'
        })
    },
    created() {
        this.$store.dispatch('jobProfiles/fetchSkills')

        Event.$on('SweetAlert:destroy', () => { this.destroy() })

        Event.$on('job-profiles.location', location => {
            this.localJobProfile.location = location
        })
    },
    components: {
        VueMultiselect,
        Likes: () => import(/* webpackChunkName: "likes" */ '../../components/Likes'),
        Modal: () => import(/* webpackChunkName: "modal" */ '../../components/Modal'),
        Errors: () => import(/* webpackChunkName: "errors" */ '../../components/Errors'),
        Report: () => import(/* webpackChunkName: "report" */ '../../components/Report'),
        MyJobProfile: () => import(/* webpackChunkName: "job-profile" */ './MyJobProfile'),
        Divider: () => import(/* webpackChunkName: "divider" */ '../../components/Divider'),
        FormInput: () => import(/* webpackChunkName: "form-input" */ '../../components/FormInput'),
        InterestedBtn: () => import(/* webpackChunkName: "interested-btn" */ '../../components/InterestedBtn'),
        JobProfileLocation: () => import(/* webpackChunkName: "job-profile-location" */ './JobProfileLocation'),
    }
}
</script>
