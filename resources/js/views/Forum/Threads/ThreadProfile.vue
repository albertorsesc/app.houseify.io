<script>
import {mapGetters} from "vuex";
import VueMultiselect from "vue-multiselect";
import SweetAlert from "../../../models/SweetAlert";

export default {
    props: {
        thread: {
            required: true,
            type: Object
        }
    },
    data() {
        return {
            localThread: this.thread,
            endpoint: `threads/${this.thread.slug}`,

            threadForm: {
                title: '',
                body: '',
                channel: {},
            },
            channels: [],

            showThreadForm: false,

            errors: [],
            isLoading: false,
        }
    },
    methods: {
        update() {
            this.isLoading = true
            axios.put(`${this.endpoint}`, {
                title: this.threadForm.title,
                body: this.threadForm.body,
                channel_id: this.threadForm.channel ? this.threadForm.channel.id : this.localThread.channel.id,
            })
            .then(response => {
                this.localThread = response.data.data
                this.showThreadForm = false
                this.replyForm = {}
                this.isLoading = false
            })
            .catch(error => {
                this.errors = error.response.status === 422 ?
                    error.response.data.errors :
                    []
                this.isLoading = false
            })
        },
        destroy() {
            axios.delete(`threads/${this.localThread.slug}`)
                .then(() => {
                    setTimeout( () => {
                            window.location.href = `/forum/temas`
                    }, 1300)
                }).catch(error => { console.log(error) })
        },
        getThreadChannels() {
            axios.get('/thread-channels')
            .then(response => this.channels = response.data.data)
            .catch(error => dd(error))
        },
        showUpdateForm() {
            this.redirectIfGuest()
            this.getThreadChannels()

            if (! this.showThreadForm) {
                this.threadForm.title = this.localThread.title
                this.threadForm.body = this.localThread.body
                this.threadForm.channel = this.localThread.channel
                this.showThreadForm = true
            } else {
                this.update()
            }
        },
        cancelUpdate() {
            this.redirectIfGuest()

            this.showThreadForm = false
            this.threadForm = {}
        },
        onDelete() {
            this.redirectIfGuest()

            SweetAlert.danger(
                `Eliminar la Consulta`,
                'La Consulta ha sido eliminada exitosamente!',
            )
        },
    },
    computed: {
        ...mapGetters({
            getConstructionCategories: 'general/getConstructionCategories'
        })
    },
    created() {
        window.Event.$on('SweetAlert:destroy', () => { this.destroy() })

        window.Event.$on('threads.replies.store', data => {
            this.localThread.replies.unshift(data)
        })

        this.$store.dispatch('general/fetchConstructionCategories')
    },
    components: {
        VueMultiselect,
        Errors: () => import(/* webpackChunkName: "errors" */ '../../../components/Errors'),
        Replies: () => import(/* webpackChunkName: "reply" */ '../../../components/Forum/Threads/Replies'),
    }
}
</script>
