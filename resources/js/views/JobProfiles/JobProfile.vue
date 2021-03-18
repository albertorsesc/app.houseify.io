<script>
import {mapGetters} from "vuex";
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
        toggle() {
            axios
                .put(this.endpoint + `/${this.localJobProfile.uuid}/toggle`)
                .then(() => {
                    this.localJobProfile.status = ! this.localJobProfile.status
                    let status = this.jobProfile.status ? 'Publicado' : 'Ocultado'
                    SweetAlert.success(`El Negocio ha sido ${status} exitosamente!`)
                })
                .catch(error => { dd(error) })
        },
    },
    created() {
        Event.$on('job-profiles.location', location => {
            this.localJobProfile.location = location
        })
    },
    components: {
        Divider: () => import(/* webpackChunkName: "divider" */ '../../components/Divider'),
        Rating: () => import(/* webpackChunkName: "rating" */ '../../components/Rating'),
        Report: () => import(/* webpackChunkName: "report" */ '../../components/Report'),
        MyJobProfile: () => import(/* webpackChunkName: "job-profile" */ './MyJobProfile'),
        JobProfileLocation: () => import(/* webpackChunkName: "job-profile-location" */ './JobProfileLocation'),
    }
}
</script>
