<template>
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="md:flex md:justify-between px-4 py-5 sm:px-6 items-center">
            <h3 class="flex text-lg leading-6 font-medium text-emerald-600">
                <svg class="mr-2 h-5 w-5 text-teal-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Imagenes de la Propiedad
            </h3>
            <div>
                <button @click="openModal"
                        class="h-link bg-white border-emerald-900 -mt-1 shadow rounded-md py-2 px-2 float-left hover:text-emerald-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-emerald-50 active:text-emerald-800"
                        title="Administrar Imagenes de la Propiedad...">
                    <svg class="text-emerald-400 hover:text-emerald-600 hover:border-emerald-700 hover:border" width="25" height="25" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </button>
                <modal modal-id="manage-property-images" max-width="sm:max-w-5xl">
                    <template #title>Administrar Imagenes de la Propiedad</template>
                    <template #content>
                        <div class="md:flex md:flex-wrap">
                            <div class="w-full items-center md:w-32 p-2" v-for="image in images" :key="image.id">
                                <img :src="baseUrl + `/img/small/${image.file_name.split('public/').pop()}`"
                                     class="h-32 w-32 z-0"
                                     title="Eliminar imagen"
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

            Event.$emit(`${this.modal.id}:open`)
        },
        closeModal() {
            Event.$emit(`${this.modal.id}:close`)
            this.modal = {}
        },
        deleteMedia(imageId) {
            axios.delete(`/properties/${this.property.slug}/images/${imageId}`)
            .then(() => {
                this.images = this.images.filter(image => image.id !== imageId)
                SweetAlert.toast('La Imagen ha sido eliminada exitosamente!')
                Event.$emit('properties-images-destroy', this.images)
            })
            .catch(error => dd(error))
        },
    },
    mounted() {
        Event.$on('dropzone.success', response => {
            SweetAlert.success('Las imagenes han sido guardadas exitosamente!')
            setTimeout(() => {
                window.location.reload()
            }, 1500)
        })
    },
    components: {
        Modal: () => import(/* webpackChunkName: "modal" */ '../../components/Modal'),
        Dropzone: () => import(/* webpackChunkName: "dropzone" */ '../../components/Dropzone'),
    }

}
</script>

<style scoped>

</style>
