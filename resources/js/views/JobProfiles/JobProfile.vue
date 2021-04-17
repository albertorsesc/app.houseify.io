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
                title: this.jobProfileForm.title ? this.jobProfileForm.title : this.localJobProfile.title,
                birthdate_at: this.jobProfileForm.birthdateAt ? this.jobProfileForm.birthdateAt : this.localJobProfile.birthdateAt,
                skills: this.jobProfileForm.skills ? this.jobProfileForm.skills : this.localJobProfile.skills,
                email: this.jobProfileForm.email ? this.jobProfileForm.email : this.localJobProfile.email,
                phone: this.jobProfileForm.phone ? this.jobProfileForm.phone : this.localJobProfile.phone,
                site: this.jobProfileForm.site ? this.jobProfileForm.site : this.localJobProfile.site,
                facebook_profile: this.jobProfileForm.facebookProfile ? this.jobProfileForm.facebookProfile : this.localJobProfile.facebookProfile,
                bio: this.jobProfileForm.bio,
            })
                .then(response => {
                    this.closeModal()
                    this.localJobProfile = response.data.data
                    SweetAlert.success(`Tu Negocio ha sido actualizado exitosamente!`)
                })
                .catch(error => { this.errors = error.response.status === 422 ? error.response.data.errors : [] })
        },
        toggle() {
            axios
                .put(this.endpoint + `/${this.localJobProfile.uuid}/toggle`)
                .then(() => {
                    this.localJobProfile.status = ! this.localJobProfile.status
                    let status = this.jobProfile.status ? 'Publicado' : 'Ocultado'
                    SweetAlert.success(`El Perfil ha sido ${status} exitosamente!`)
                })
                .catch(error => { dd(error) })
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
                this.jobProfileForm.skills = this.localJobProfile.skills
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
    },
    computed: {
        ...mapGetters({
            getSkills: 'jobProfiles/getSkills'
        })
    },
    created() {
        this.$store.dispatch('jobProfiles/fetchSkills')

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
        JobProfileLocation: () => import(/* webpackChunkName: "job-profile-location" */ './JobProfileLocation'),
    }
}
</script>