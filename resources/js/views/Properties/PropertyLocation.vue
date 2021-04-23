<template>
    <div>
        <divider title="Ubicación"></divider>
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="flex justify-between px-4 py-5 sm:px-6 items-center">
                <h3 class="flex text-lg leading-6 font-medium text-emerald-600">
                    <svg class="mr-2 h-5 w-5 text-teal-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Ubicación de la Propiedad
                </h3>
                <div v-if="property.seller.id === auth">
                    <button @click="openModal" class="h-link bg-white -mt-1 shadow rounded-md py-2 px-2 float-left hover:text-emerald-500 focus:outline-none focus:shadow-outline-blue active:bg-emerald-50 active:text-emerald-800"
                            title="Registrar Ubicación de la Propiedad">
                        <svg class="text-emerald-400 hover:text-emerald-600" width="25" height="25" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </button>
                </div>
            </div>
            <div v-if="location" class="border-t border-gray-200 mx-4 py-5 sm:px-6">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-4 sm:grid-cols-3">
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500 flex">
                            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                            </svg>
                            Estado
                        </dt>
                        <dd class="mt-1 text-base text-teal-600"
                            v-text="location.state.name"
                        ></dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500 flex">
                            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                            </svg>
                            Ciudad
                        </dt>
                        <dd class="mt-1 text-base text-teal-600"
                            v-text="location.city"
                        ></dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500 flex">
                            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                            </svg>
                            Fraccionamiento/Colonia
                        </dt>
                        <dd class="mt-1 text-base text-teal-600"
                            v-text="location.neighborhood"
                        ></dd>
                    </div>
                    <div class="sm:col-span-1" v-if="location.address">
                        <dt class="text-sm font-medium text-gray-500 flex">
                            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                            </svg>
                            Dirección
                        </dt>
                        <dd class="mt-1 text-base text-teal-600"
                            v-text="location.address"
                        ></dd>
                    </div>
                    <div class="sm:col-span-1" v-if="location.zipCode">
                        <dt class="text-sm font-medium text-gray-500 flex">
                            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                            </svg>
                            Código Postal
                        </dt>
                        <dd class="mt-1 text-base text-teal-600"
                            v-text="location.zipCode"
                        ></dd>
                    </div>
                </dl>
            </div>

            <modal v-if="property.seller.id === auth"
                   modal-id="property-location"
                   max-width="sm:max-w-5xl">
                <template #title>Ubicación de la Propiedad</template>
                <template #content>
                    <form @submit.prevent>

                        <div class="w-full md:flex md:-mx-2 mt-4">
                            <!--Address-->
                            <div class="w-full md:mx-2">
                                <div class="w-full">
                                    <form-input
                                        title="Dirección"
                                        :is-required="false"
                                        v-model="propertyLocationForm.address"
                                        :data="propertyLocationForm.address"
                                        input-id="address"
                                        :error="errors.address"
                                    ></form-input>
                                </div>
                            </div>
                        </div>

                        <div class="w-full md:flex md:-mx-2 mt-4">
                            <!--State-->
                            <div class="w-full md:w-1/3 md:mx-2 mt-3 md:mt-0">
                                <div class="form-group">
                                    <label for="state_id">
                                        <strong class="required">*</strong>
                                        Estado
                                        <span class="text-gray-500 font-light text-xs">(requerido)</span>
                                    </label>
                                    <div class="mt-1">
                                        <vue-multiselect v-model="propertyLocationForm.state"
                                                         :options="getStates"
                                                         id="state_id"
                                                         label="name"
                                                         track-by="id"
                                                         :show-no-results="true"
                                                         :searchable="true"
                                                         :close-on-select="true"
                                                         :show-labels="true"
                                                         select-label=""
                                                         selected-label=""
                                                         deselect-label=""
                                                         :hide-selected="true"
                                                         placeholder="Selecciona tu Estado..."
                                                         @select="getCities">
                                            <template slot="noResult">
                                                <span class="text-lg text-yellow-600">Lo sentimos, no se encontraron resultados :(</span>
                                            </template>
                                        </vue-multiselect>
                                    </div>
                                </div>
                            </div>
                            <!--City-->
                            <div class="w-full md:w-1/3 md:mx-2 mt-3 md:mt-0">
                                <div class="form-group">
                                    <label for="city">
                                        <strong class="required">*</strong>
                                        Ciudad
                                        <span class="text-gray-500 font-light text-xs">(requerido)</span>
                                    </label>
                                    <div class="mt-1">
                                        <vue-multiselect v-model="propertyLocationForm.city"
                                                         :options="cities"
                                                         id="city"
                                                         :searchable="true"
                                                         :close-on-select="true"
                                                         :show-labels="true"
                                                         select-label=""
                                                         selected-label=""
                                                         deselect-label=""
                                                         :hide-selected="true"
                                                         placeholder="Selecciona tu Ciudad..."
                                                         @select="getNeighborhoods"
                                        ></vue-multiselect>
                                    </div>
                                </div>
                            </div>
                            <!--Neighborhood-->
                            <div class="w-full md:w-1/3 md:mx-2 mt-3 md:mt-0">
                                <div class="form-group">
                                    <label for="neighborhood">
                                        <strong class="required">*</strong>
                                        Fraccionamiento/Colonia
                                        <span class="text-gray-500 font-light text-xs">(requerido)</span>
                                    </label>
                                    <div class="mt-1">
                                        <vue-multiselect v-model="propertyLocationForm.neighborhood"
                                                         :options="neighborhoods"
                                                         id="neighborhood"
                                                         :searchable="true"
                                                         :close-on-select="true"
                                                         :show-labels="true"
                                                         select-label=""
                                                         selected-label=""
                                                         deselect-label=""
                                                         :hide-selected="true"
                                                         placeholder="Fraccionamiento/Colonia..."
                                        ></vue-multiselect>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="w-full md:flex md:-mx-2 mt-4">
                            <!--ZipCode-->
                            <div class="w-full md:w-1/3 md:mx-2 mt-3 md:mt-0">
                                <form-input
                                    title="Código Postal"
                                    type="number"
                                    v-model="propertyLocationForm.zipCode"
                                    :data="propertyLocationForm.zipCode"
                                    input-id="store_zip_code"
                                    :error="errors.zip_code"
                                    custom-classes=""
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
import { mapGetters } from 'vuex'
import SweetAlert from "../../models/SweetAlert";
import VueMultiselect from "vue-multiselect";

export default {
    name: "PropertyLocation",
    inject: ['property'],
    data() {
        return {
            endpoint: `/properties/${this.property.slug}/location`,

            location: this.property.location,
            states: [],
            cities: [],
            neighborhoods: [],

            propertyLocationForm: {
                address: '',
                neighborhood: '',
                city: '',
                state: {
                    id: 0,
                    name: '',
                    code: '',
                    country: {
                        id: 0,
                    }
                },
                zipCode: '',
            },

            errors: [],
            actionType: '',
            modal: {
                id: 'property-location'
            },
        }
    },
    methods: {
        store() {
            axios.post(this.endpoint, {
                'address': this.propertyLocationForm.address,
                'neighborhood': this.propertyLocationForm.neighborhood,
                'city': this.propertyLocationForm.city,
                'state_id': this.propertyLocationForm.state ? this.propertyLocationForm.state.id : null,
                'zip_code': this.propertyLocationForm.zipCode,
            }).then(response => {
                this.closeModal()
                this.location = response.data.data
                Event.$emit('properties.location', this.location)
                SweetAlert.success(`La Ubicación ha sido registrada exitosamente!`)
            }).catch(error => {
                this.errors = error.response.status === 422 ?
                    error.response.data.errors :
                    []
            })
        },
        update() {
            axios.put(this.endpoint, {
                'address': this.propertyLocationForm.address,
                'neighborhood': this.propertyLocationForm.neighborhood,
                'city': this.propertyLocationForm.city,
                'state_id': this.propertyLocationForm.state.id,
                'zip_code': this.propertyLocationForm.zipCode,
            }).then(response => {
                this.closeModal()
                this.location = response.data.data
                Event.$emit('properties.location', this.location)
                SweetAlert.success(`La Ubicación ha sido actualizada exitosamente!`)
            }).catch(error => {
                this.errors = error.response.status === 422 ?
                    error.response.data.errors :
                    []
            })
        },
        getCities(selectedState) {
            let state = this.isObject(selectedState) ? selectedState : this.propertyLocationForm.state
            axios.get(`/states/${state.name}/cities`)
                .then(response => { this.cities = response.data })
                .catch(error => { console.log(error) })
        },
        getNeighborhoods(selectedCity) {
            let city = selectedCity ? selectedCity : this.propertyLocationForm.city

            axios.get(`/cities/${city}/neighborhoods`)
                .then(response => { this.neighborhoods = response.data })
                .catch(error => { console.log(error) })
        },
        openModal() {
            this.modal = {}
            this.actionType = this.location ? 'put' : 'post'
            this.errors = []
            this.modal.id = 'property-location'

            if (this.actionType === 'put') {
                this.propertyLocationForm.address = this.location.address
                this.propertyLocationForm.neighborhood = this.location.neighborhood
                this.propertyLocationForm.city = this.location.city
                this.propertyLocationForm.state = this.location.state
                this.propertyLocationForm.zipCode = this.location.zipCode

                this.getCities(this.propertyLocationForm.state.name)
                this.getNeighborhoods(this.propertyLocationForm.city)
            }

            Event.$emit(`${this.modal.id}:open`)
        },
        closeModal() {
            Event.$emit(`${this.modal.id}:close`)
            this.errors = []
            this.actionType = ''
            this.modal = {}
            this.propertyLocationForm = {}
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
        ...mapGetters({
            getStates: 'global/getStates'
        })
    },
    created() {
        if (this.auth === this.property.seller.id) {
            this.$store.dispatch('global/fetchStates')
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
