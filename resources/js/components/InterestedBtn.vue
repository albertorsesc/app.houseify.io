<template>
    <button @click="toggle()"
            class="inline-block bg-grey-lighter text-grey-darker hover:shadow-lg hover:bg-red-lightest hover:text-red rounded-full tracking-wide px-2 py-1 mt-1 text-sm font-bold mr-2"
            :title="[title]">
<!--        <svg class="h-5 w-5" :class="isInterested ? 'text-yellow-500' : 'text-gray-300'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">-->
<!--            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />-->
<!--        </svg>-->
<!--        <svg class="h-5 w-5" :class="isInterested ? 'text-emerald-400' : 'text-gray-300'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">-->
<!--            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />-->
<!--        </svg>-->
        <svg :class="[isInterested ? 'text-red-400' : 'text-gray-300', iconSize]" xmlns="http://www.w3.org/2000/svg" :fill="isInterested ? 'red' : 'none'" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
        </svg>
    </button>
</template>

<script>

    export default {
        props: {
            model: {
                required: true,
                type: Object
            },
            id: {
                required: false,
                type: String,
            },
            modelName: {
                required: true,
                type: String
            },
            endpoint: {
                required: true,
                type: String,
            },
            iconClass: {
                type: String
            },
            iconSize: {
                type: String,
                default: 'h-5 w-5'
            }
        },
        data() {
            return {
                modelId: this.id ? this.id : this.model.id,
                interests: this.model.interests,
                isInterested: false,
                userId: 0,
            }
        },
        methods: {
            toggle() {
                this.isInterested ? this.uninterested() : this.interested()
                window.Event.$emit(`interest-${this.modelName}`, this.model)
            },
            check() {
                this.redirectIfGuest()
                if (
                    this.interests &&
                    this.interests.length > 0 &&
                    this.interests[0].interested_by === this.auth
                ) {
                    this.isInterested = true
                } else {
                    this.isInterested = false
                }
            },
            interested() {
                axios
                    .post(`${this.endpointUrl}/interested`)
                    .then(response => {
                        this.isInterested = response.data.data
                    })
                    .catch(error => { console.log(error) })
            },
            uninterested() {
                axios
                    .delete(`${this.endpointUrl}/uninterested`)
                    .then(response => { this.isInterested = response.data.data })
                    .catch(error => { console.log(error) })
            },
        },
        computed: {
            endpointUrl() { return `${this.endpoint}/${this.modelId}` },
            title() { return this.isInterested ? 'No me interesa' : 'Guardar en Mis Intereses!' },
            interestCount() {
                return this.interests.length
            },
        },
        created () {
            this.check()

            window.Event.$emit('interests:count', () => this.interestCount)
        }
    }
</script>

<style scoped> .fas { color: red; } </style>
