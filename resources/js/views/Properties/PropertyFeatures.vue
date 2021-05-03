<template>
    <div v-if="isSeller ||  isPropertyFeatureNotEmpty(propertyFeatures)">
        <divider title="Características"></divider>
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="flex justify-between px-4 py-5 sm:px-6 items-center">
                <h3 class="flex text-lg leading-6 font-medium text-emerald-600">
                    <svg class="mr-2 h-5 w-5 text-teal-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Características de la Propiedad
                </h3>
                <div v-if="isSeller">
                    <button @click="openModal" class="h-link bg-white -mt-1 shadow rounded-md py-2 px-2 float-left hover:text-emerald-500 focus:outline-none focus:shadow-outline-blue active:bg-emerald-50 active:text-emerald-800"
                            title="Registrar Características de la Propiedad">
                        <svg class="text-emerald-400 hover:text-emerald-600" width="25" height="25" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </button>
                </div>
            </div>
            <div v-if="isPropertyFeatureNotEmpty(propertyFeatures) || property.comments" class="border-t border-gray-200 mx-4 py-5 sm:px-6">
                <dl v-if="isPropertyFeatureNotEmpty" class="grid grid-cols-1 gap-x-4 gap-y-4 sm:grid-cols-3">
                    <div v-if="isNotEmpty(propertyFeatures.features.property_size)"
                         class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500 flex">
                            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                            </svg>
                            m² Propiedad
                        </dt>
                        <dd class="mt-1 text-base text-teal-600"
                            v-text="propertyFeatures.features.property_size"
                        ></dd>
                    </div>
                    <div v-if="isNotEmpty(propertyFeatures.features.construction_size)" class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500 flex">
                            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                            </svg>
                            m² Construcción
                        </dt>
                        <dd class="mt-1 text-base text-teal-600"
                            v-text="propertyFeatures.features.construction_size"
                        ></dd>
                    </div>
                    <div v-if="isNotEmpty(propertyFeatures.features.level_count)" class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500 flex">
                            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                            </svg>
                            No. Niveles
                        </dt>
                        <dd class="mt-1 text-base text-teal-600"
                            v-text="propertyFeatures.features.level_count"
                        ></dd>
                    </div>
                    <div v-if="isNotEmpty(propertyFeatures.features.room_count)"
                         class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500 flex">
                            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                            </svg>
                            No. Habitaciones
                        </dt>
                        <dd class="mt-1 text-base text-teal-600"
                            v-text="propertyFeatures.features.room_count"
                        ></dd>
                    </div>
                    <div v-if="isNotEmpty(propertyFeatures.features.bathroom_count)" class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500 flex">
                            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                            </svg>
                            No. Baños
                        </dt>
                        <dd class="mt-1 text-base text-teal-600"
                            v-text="propertyFeatures.features.bathroom_count"
                        ></dd>
                    </div>
                    <div v-if="isNotEmpty(propertyFeatures.features.half_bathroom_count)" class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500 flex">
                            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                            </svg>
                            No. Medios Baños
                        </dt>
                        <dd class="mt-1 text-base text-teal-600"
                            v-text="propertyFeatures.features.half_bathroom_count"
                        ></dd>
                    </div>
                </dl>
                <div v-if="property.comments"
                     class="sm:col-span-2 mt-4">
                    <dt class="text-sm font-medium text-gray-500">
                        Comentarios adicionales
                    </dt>
                    <dd class="mt-1 text-sm text-gray-600"
                        v-text="property.comments"
                    ></dd>
                </div>
            </div>

            <modal v-if="isSeller"
                   modal-id="property-features"
                   max-width="sm:max-w-5xl">
                <template #title>Características de la Propiedad</template>
                <template #content>
                    <form @submit.prevent>

                        <div class="w-full -mx-2 md:flex">
                            <div class="w-full md:w-1/3 mx-2">
                                <form-input
                                    title="m² de la Propiedad"
                                    type="number"
                                    :is-required="false"
                                    v-model="propertyFeaturesForm.features.property_size"
                                    :data="propertyFeaturesForm.features.property_size"
                                    input-id="property_size"
                                    :error="errors.property_size"
                                ></form-input>
                            </div>
                            <div class="w-full md:w-1/3 mx-2 mt-4 md:mt-0">
                                <form-input
                                    title="m² de Construcción"
                                    type="number"
                                    :is-required="false"
                                    v-model="propertyFeaturesForm.features.construction_size"
                                    :data="propertyFeaturesForm.features.construction_size"
                                    input-id="construction_size"
                                    :error="errors.construction_size"
                                ></form-input>
                            </div>
                            <div class="w-full md:w-1/3 mx-2 mt-4 md:mt-0">
                                <form-input
                                    title="Numero de Niveles"
                                    type="number"
                                    :is-required="false"
                                    v-model="propertyFeaturesForm.features.level_count"
                                    :data="propertyFeaturesForm.features.level_count"
                                    input-id="level_count"
                                    :error="errors.level_count"
                                ></form-input>
                            </div>
                        </div>

                        <div class="w-full -mx-2 md:flex mt-4">
                            <div class="w-full md:w-1/3 mx-2">
                                <form-input
                                    title="No. de Habitaciones"
                                    type="number"
                                    :is-required="false"
                                    v-model="propertyFeaturesForm.features.room_count"
                                    :data="propertyFeaturesForm.features.room_count"
                                    input-id="room_count"
                                    :error="errors.room_count"
                                ></form-input>
                            </div>
                            <div class="w-full md:w-1/3 mx-2 mt-4 md:mt-0">
                                <form-input
                                    title="No. de Baños"
                                    type="number"
                                    :is-required="false"
                                    v-model="propertyFeaturesForm.features.bathroom_count"
                                    :data="propertyFeaturesForm.features.bathroom_count"
                                    input-id="bathroom_count"
                                    :error="errors.bathroom_count"
                                ></form-input>
                            </div>
                            <div class="w-full md:w-1/3 mx-2 mt-4 md:mt-0">
                                <form-input
                                    title="No. de Medios Baños"
                                    type="number"
                                    :is-required="false"
                                    v-model="propertyFeaturesForm.features.half_bathroom_count"
                                    :data="propertyFeaturesForm.features.half_bathroom_count"
                                    input-id="half_bathroom_count"
                                    :error="errors.half_bathroom_count"
                                ></form-input>
                            </div>
                        </div>

                    </form>
                </template>
                <template #footer>
                    <button @click="closeModal"
                            type="button"
                            class="ml-3 h-link inline-flex items-center justify-center px-4 py-2 bg-white border border-gray-200 border border-gray-200 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:font-semibold focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-primary transition ease-in-out duration-150">
                        Cancelar
                    </button>
                    <button @click="submit"
                            class="ml-3 h-link inline-flex items-center justify-center px-4 py-2 bg-white border border-gray-200 rounded-md font-semibold text-xs text-emerald-500 uppercase tracking-widest hover:font-semibold hover:shadow-lg hover:bg-teal-500 hover:text-white focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-primary transition ease-in-out duration-150">
                        Guardar
                    </button>
                </template>
            </modal>
        </div>
    </div>
</template>

<script>
import VueMultiselect from "vue-multiselect";
import properties from '../../mixins/properties'
import SweetAlert from "../../models/SweetAlert";

export default {
    name: "PropertyFeatures",
    inject: ['property'],
    mixins: [properties],
    data() {
        return {
            endpoint: `/properties/${this.property.slug}/features`,

            propertyFeatures: this.property.propertyFeature ? this.property.propertyFeature : {},

            propertyFeaturesForm: {
                features: {
                    property_size: 0,
                    construction_size: 0,
                    level_count: 0,
                    room_count: 0,
                    bathroom_count: 0,
                    half_bathroom_count: 0,
                }
            },

            errors: [],
            actionType: '',
            modal: {
                id: 'property-features'
            },
        }
    },
    methods: {
        store() {
            axios.post(this.endpoint, {
                features: {
                    property_size: this.propertyFeaturesForm.features.property_size,
                    construction_size: this.propertyFeaturesForm.features.construction_size,
                    level_count: this.propertyFeaturesForm.features.level_count,
                    room_count: this.propertyFeaturesForm.features.room_count,
                    bathroom_count: this.propertyFeaturesForm.features.bathroom_count,
                    half_bathroom_count: this.propertyFeaturesForm.features.half_bathroom_count,
                }
            }).then(response => {
                this.closeModal()
                console.log(response.data)
                this.propertyFeatures = response.data
                window.Event.$emit('properties.features', this.propertyFeatures)
                SweetAlert.success(`La Ubicación ha sido registrada exitosamente!`)
            }).catch(error => {
                this.errors = error.response.status === 422 ?
                    error.response.data.errors :
                    []
            })
        },
        update() {
            axios.put(this.endpoint, {
                features: {
                    property_size: this.propertyFeaturesForm.features.property_size,
                    construction_size: this.propertyFeaturesForm.features.construction_size,
                    level_count: this.propertyFeaturesForm.features.level_count,
                    room_count: this.propertyFeaturesForm.features.room_count,
                    bathroom_count: this.propertyFeaturesForm.features.bathroom_count,
                    half_bathroom_count: this.propertyFeaturesForm.features.half_bathroom_count,
                }
            }).then(response => {
                this.closeModal()
                this.propertyFeatures = response.data.data
                SweetAlert.success(`La Ubicación ha sido actualizada exitosamente!`)
            }).catch(error => {
                this.errors = error.response.status === 422 ?
                    error.response.data.errors :
                    []
            })
        },
        openModal() {
            this.modal = {}
            this.actionType = this.propertyFeatures ? 'put' : 'post'
            this.errors = []
            this.modal.id = 'property-features'

            if (this.actionType === 'put') {
                this.propertyFeaturesForm = {
                    features: {
                        property_size: parseInt(this.propertyFeatures.features.property_size),
                        construction_size: parseInt(this.propertyFeatures.features.construction_size),
                        level_count: parseInt(this.propertyFeatures.features.level_count),
                        room_count: parseInt(this.propertyFeatures.features.room_count),
                        bathroom_count: parseInt(this.propertyFeatures.features.bathroom_count),
                        half_bathroom_count: parseInt(this.propertyFeatures.features.half_bathroom_count),
                    }
                }
            }

            window.Event.$emit(`${this.modal.id}:open`)
        },
        closeModal() {
            window.Event.$emit(`${this.modal.id}:close`)
            this.errors = []
            this.actionType = ''
            this.modal = {}
            this.propertyFeaturesForm = {}
        },
        submit () {
            if (this.actionType === 'post') {
                this.store()
            }
            if (this.actionType === 'put') {
                this.update()
            }
        }
    },
    computed: {
        isSeller() {
            return this.property.seller.id === this.auth
        }
    },
    components: {
        VueMultiselect,
        Modal: () => import(/* webpackChunkName: "modal" */ '../../components/Modal'),
        Divider: () => import(/* webpackChunkName: "divider" */ '../../components/Divider'),
        FormInput: () => import(/* webpackChunkName: "form-input" */ '../../components/FormInput'),
    }
}
</script>

<style scoped>

</style>
