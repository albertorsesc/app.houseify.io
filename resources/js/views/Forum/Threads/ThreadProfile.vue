<script>
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
            endpoint: `threads/${this.thread.id}/replies`,

            replyForm: {
                body: '',
            },


            errors: [],
            isLoading: false,
        }
    },
    methods: {
        reply() {
            this.isLoading = true
            axios.post(this.endpoint, this.replyForm)
            .then(response => {
                this.localThread.replies.unshift(response.data.data)
                this.isLoading = false
                this.replyForm = {}
            })
            .catch(
                error => this.errors = error.response.status === 422 ?
                error.response.data.errors :
                []
            )
        }
    },
    components: {
        Errors: () => import(/* webpackChunkName: "errors" */ '../../../components/Errors'),
    }
}
</script>
