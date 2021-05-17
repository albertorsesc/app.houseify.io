<template>
    <div v-if="isSeller">
        <divider title="Imágenes"></divider>
        <div v-if="isSeller"
             class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="flex justify-between px-4 py-5 sm:px-6 items-center">
                <h3 class="flex text-lg leading-6 font-medium text-emerald-600">
                    <svg class="mr-2 h-5 w-5 text-teal-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Imágenes de la Propiedad
                </h3>
                <div v-if="images.length > 0">
                    <button @click="openModal"
                            class="h-link bg-white border-emerald-900 -mt-1 shadow rounded-md py-2 px-2 float-left hover:text-emerald-500 focus:outline-none focus:shadow-outline-blue active:text-emerald-800"
                            title="Administrar Imágenes de la Propiedad...">
                        <svg class="h-6 w-6 text-emerald-400 hover:text-emerald-600 appearance-none" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                    <modal modal-id="manage-property-images" max-width="sm:max-w-5xl">
                        <template #title>Administrar Imágenes de la Propiedad</template>
                        <template #content>
                            <div class="md:flex md:flex-wrap">
                                <div class="w-full items-center md:w-32 p-2" v-for="image in images" :key="image.id">
                                    <img :src="image.file_name"
                                         class="h-32 w-32 z-0"
                                         title="Eliminar imágen"
                                         alt="Property image">
                                    <svg @click="deleteMedia(image.id)" class="text-red-500 bg-white h-8 w-8 -mt-4 ml-24 cursor-pointer" xmlns="http://www.w3.org/2000/svg" fill="#fff" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                        </template>
                    </modal>
                </div>
            </div>
            <div v-if="property.seller.id === auth"
                 class="border-t border-gray-200 mx-4 py-5 sm:px-6">
                <div class="w-full mt-4">
                    <dropzone :endpoint="endpoint"></dropzone>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import SweetAlert from "../../models/SweetAlert";

export default {
    name: "PropertyImages",
    inject: ['property'],
    data () {
        return {
            endpoint: `/api/properties/${this.property.slug}/images`,
            images: this.property.images,
            modal: {},
            errors: [],
        }
    },
    methods: {
        openModal(action) {
            this.modal = {}
            this.actionType = action
            this.errors = []
            this.modal.id = 'manage-property-images'

            window.Event.$emit(`${this.modal.id}:open`)
        },
        closeModal() {
            window.Event.$emit(`${this.modal.id}:close`)
            this.modal = {}
        },
        deleteMedia(imageId) {
            axios.delete(`/properties/${this.property.slug}/images/${imageId}`)
            .then(() => {
                this.images = this.images.filter(image => image.id !== imageId)
                SweetAlert.toast('La Imagen ha sido eliminada exitosamente!')
                window.Event.$emit('properties-images-destroy', this.images)
            })
            .catch(error => dd(error))
        },
    },
    computed: {
        isSeller() {
            return this.property.seller.id === this.auth
        }
    },
    mounted() {
        window.Event.$on('dropzone.success', response => {
            SweetAlert.success('Las imágenes han sido guardadas exitosamente!')
            setTimeout(() => {
                window.location.reload()
            }, 1500)
        })
    },
    components: {
        Modal: () => import(/* webpackChunkName: "modal" */ '../../components/Modal'),
        Divider: () => import(/* webpackChunkName: "divider" */ '../../components/Divider'),
        Dropzone: () => import(/* webpackChunkName: "dropzone" */ '../../components/Dropzone'),
    }

}
</script>

<style scoped>

</style>
