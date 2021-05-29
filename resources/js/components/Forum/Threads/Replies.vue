<template>
    <div>
        <!--Store Reply-->
        <div v-if="isAuthenticated" class="w-full my-6" v-cloak>
            <div class="bg-white overflow-hidden shadow rounded-lg divide-y divide-gray-200">
                <div class="px-4 py-2">
                    <form @submit.prevent>
                        <div class="w-full">
                            <div class="my-1">
                                <textarea v-model="replyForm.body"
                                          id="body"
                                          rows="5"
                                          class="h-input block w-full sm:text-sm"
                                          placeholder="Contestar Pregunta..."
                                ></textarea>
                            </div>
                            <errors :error="errors.body"
                                    :options="{ noContainer: true }"
                            ></errors>
                        </div>
                        <div class="w-full my-4">
                            <button @click="store"
                                    :disabled="isLoading"
                                    class="h-btn-success">
                                Enviar Respuesta
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--Replies-->
        <reply-card v-for="reply in replies"
                    :key="reply.id"
                    :reply="reply"
                    :thread="thread"
                    v-cloak
        ></reply-card>
    </div>
</template>
<script>

export default {
    props: {
        thread: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            endpoint: `threads/${this.thread.slug}/replies`,
            replies: this.thread.replies,
            threadAuthor: this.thread.author,

            replyForm: {
                body: '',
            },
            isLoading: false,
            errors: [],
        }
    },
    methods: {
        store() {
            this.isLoading = true
            axios.post(this.endpoint, this.replyForm)
                .then(response => {
                    dd(response.data)
                    this.replies.unshift(response.data.data)
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
    },
    mounted() {
        window.Event.$on('threads.replies.destroy', replyId => {
            this.replies = this.replies.filter(reply => reply.id !== replyId)
        })
    },
    components: {
        ReplyCard: () => import(/* webpackChunkName: "reply-card" */ './ReplyCard'),
        Errors: () => import(/* webpackChunkName: "errors" */ '../../../components/Errors'),
    }
}
</script>
