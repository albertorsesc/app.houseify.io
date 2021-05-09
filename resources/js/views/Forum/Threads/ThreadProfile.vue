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

            threadForm: {
                title: '',
                body: '',
            },
            replyForm: {
                body: '',
            },

            showThreadForm: false,

            errors: [],
            isLoading: false,
        }
    },
    methods: {
        update() {
            this.isLoading = true
            axios.put(`threads/${this.thread.id}`, this.threadForm)
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
        reply() {
            this.isLoading = true
            axios.post(this.endpoint, this.replyForm)
            .then(response => {
                this.localThread.replies.unshift(response.data.data)
                this.isLoading = false
                this.replyForm = {}
                this.errors = {}
            })
            .catch(error => {
                this.errors = error.response.status === 422 ?
                    error.response.data.errors :
                    []
                this.isLoading = false
            })
        },
        showUpdateForm() {
            if (! this.showThreadForm) {
                this.threadForm.title = this.localThread.title
                this.threadForm.body = this.localThread.body
                this.showThreadForm = true
            } else {
                this.update()
            }
        },
        cancelUpdate() {
            this.showThreadForm = false
            this.threadForm = {}
        }
    },
    components: {
        Errors: () => import(/* webpackChunkName: "errors" */ '../../../components/Errors'),
    }
}
</script>
