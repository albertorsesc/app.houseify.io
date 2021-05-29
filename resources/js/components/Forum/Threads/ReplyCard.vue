<template>
    <div class="my-4 bg-white overflow-hidden shadow rounded-lg divide-y divide-gray-200"
         :class="isBest ? 'border border-blue-300 border-2' : ''">
        <div class="px-4 py-5 sm:px-6 md:flex w-full">
            <!--Author's meta-->
            <div class="md:flex w-full">
                <div class="flex-shrink-0 mr-3">
                    <img class="h-10 w-10 rounded-lg" :src="localReply.author.photo" :alt="localReply.author.fullName" />
                </div>
                <div>
                    <div>
                        <span v-text="localReply.author.fullName" class="text-base text-emerald-500 font-medium"></span>
                    </div>
                    <div class="-mt-1">
                        <span class="text-xs text-gray-600 font-light">
                            Fue publicado <span v-text="localReply.meta.createdAt"></span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="mt-6 md:mt-0 w-full flex justify-start md:justify-end align-middle">
                <span v-if="isBest"
                      class="bg-white rounded-full shadow-sm border border-blue-300 text-blue-400 px-3 lg:px-6 font-bold uppercase inline-flex items-center md:text-xs">
                    Mejor Respuesta
                </span>
                <div v-if="canUpdateReply(localReply)" class="flex ml-4">
                    <span class="">
                        <button v-if="! showReplyForm"
                                @click="showUpdateForm"
                                type="button"
                                class="mr-2 items-center shadow-sm px-4 py-1 flex justify-center border border-gray-100 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 hover:text-gray-900 focus:outline-none focus:shadow-outline-emerald focus:border-emerald-300 active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out"
                                title="Actualizar Datos de la Propiedad...">
                            <span class="text-gray-400">
                                Editar
                            </span>
                        </button>
                    </span>
                    <span class="">
                    <button @click="onDelete"
                            type="button"
                            class="items-center shadow-sm px-4 py-1 flex justify-center border border-gray-100 text-sm leading-5 font-medium rounded-md text-red-700 bg-white focus:outline-none focus:shadow-outline-red focus:border-red-300 transition duration-150 ease-in-out"
                            title="Eliminar Consulta...">
                            Eliminar
                    </button>
                </span>
                </div>
                <span v-if="isAuthenticated && canUpdateThread(thread) && ! isBest"
                      @click="markBestReply"
                      class="ml-2">
                        <button type="button"
                                class="items-center shadow-sm px-4 py-1 flex justify-center border border-gray-100 text-sm leading-5 font-medium rounded-lg text-blue-400 bg-white hover:bg-blue-500 hover:text-white focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out"
                                title="La respuesta soluciono tu consulta?">
                            Mejor Respuesta
                        </button>
                    </span>
            </div>
        </div>
        <div class="px-4 py-5 sm:p-6"
             v-if="! showReplyForm"
             v-text="localReply.body"
        ></div>

        <div v-if="showReplyForm"
             class="px-4 py-2">
            <form @submit.prevent id="update">
                <div class="w-full">
                    <div class="mt-1">
                        <textarea v-model="replyForm.body"
                                  :id="`body-${localReply.id}`"
                                  rows="5"
                                  class="h-input block w-full sm:text-sm"
                                  placeholder="Contestar Pregunta..."
                                  v-text="localReply.body"
                        ></textarea>
                    </div>
                    <errors :error="errors.body"
                            :id="`body-${localReply.id}`"
                            :options="{ noContainer: true }"
                    ></errors>
                </div>
                <div class="w-full flex my-4">
                    <button @click="update"
                            form="update"
                            :disabled="isLoading"
                            class="mr-2 items-center shadow-sm px-4 py-1 flex justify-center border border-gray-100 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 hover:text-gray-900 focus:outline-none focus:shadow-outline-emerald focus:border-emerald-300 active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                        <span class="text-gray-400">Responder</span>
                    </button>
                    <button @click="cancelUpdate"
                            type="button"
                            form="update"
                            class="mr-2 items-center shadow-sm px-4 py-1 flex justify-center border border-gray-100 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 hover:text-gray-900 focus:outline-none focus:shadow-outline-emerald focus:border-emerald-300 active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                        <span class="text-gray-400">Cancelar</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import SweetAlert from "../../../models/SweetAlert";
import replyPolicy from '../../../mixins/authorizations/reply-policy'
import threadPolicy from '../../../mixins/authorizations/thread-policy'

export default {
    name: "ReplyCard",
    mixins: [replyPolicy, threadPolicy],
    props: {
        reply: {
            type: Object,
            required: true
        },
        thread: {
            type: Object,
            required: true,
        }
    },
    data() {
        return {
            endpoint: `threads/${this.reply.thread.slug}/replies`,
            localReply: this.reply,
            bestReply: this.thread.bestReply,
            isBest: (this.thread.bestReply === this.reply.id),
            replyForm: {
                body: '',
            },

            showReplyForm: false,
            isLoading: false,
            errors: [],
        }
    },
    methods: {
        update() {
            axios.put(`${this.endpoint}/${this.localReply.id}`, {
                body: this.replyForm.body ? this.replyForm.body : null
            })
            .then(response => {
                SweetAlert.toast('Respuesta actualizada!', 'bottom-end')
                this.localReply = response.data.data
                window.Event.$emit('threads.replies.update', this.localReply)
                this.isLoading = false
                this.replyForm = {}
                this.showReplyForm = false
            })
            .catch(error => {
                this.errors = error.response.status === 422 ?
                    error.response.data.errors :
                    []
            })
        },
        destroyReply() {
            axios.delete(`${this.endpoint}/${this.reply.id}`)
            .then(() => {
                window.Event.$emit('threads.replies.destroy', this.reply.id)
            })
            .catch(error => { console.log(error) })
        },
        markBestReply() {
            axios.put(`threads/${this.reply.thread.slug}/replies/${this.localReply.id}/best`)
                .then(() => {
                    window.Event.$emit(
                        'best-reply-selected',
                        this.localReply.id
                    )
                })
                .catch(error => dd(error))
        },
        onDelete() {
            this.redirectIfGuest()
            if (confirm('Eliminar Respuesta?')) {
                this.destroyReply()
            }
        },
        showUpdateForm() {
            this.redirectIfGuest()

            if (! this.showReplyForm) {
                this.replyForm.body = this.localReply.body
                this.showReplyForm = true
            } else {
                this.update()
            }
        },
        cancelUpdate() {
            this.redirectIfGuest()

            this.showReplyForm = false
            this.replyForm = {}
        },
    },
    created() {
        window.Event.$on('best-reply-selected', id => {
            this.isBest = (id === this.reply.id)
        })
    },
    components: {
        Errors: () => import(/* webpackChunkName: "errors" */ '../../Errors'),
    }
}
</script>

<style scoped>

</style>
