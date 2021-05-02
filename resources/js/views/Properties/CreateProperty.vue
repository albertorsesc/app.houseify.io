<template>
    <div class="bg-white shadow-lg rounded-lg p-6 mt-4">
        <form @submit.prevent class="space-y-8 divide-y divide-gray-200">
            <div class="space-y-8 divide-y divide-gray-200">
                <div>
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Nueva Propiedad
                        </h3>
                        <p class="mt-1 text-sm text-gray-500">
                            Registra los datos básicos de tu propiedad.
                        </p>
                    </div>

                    <div class="mt-6 grid grid-cols-1 gap-y-4 gap-x-4 sm:grid-cols-6">

                        <div class="col-span-4">
                            <div class="w-full">
                                <label for="title" class="block text-sm font-medium text-gray-700">
                                    <strong class="required">*</strong>
                                    Título de la Publicación
                                    <span class="text-gray-500 font-light text-xs">(requerido)</span>
                                </label>
                                <div class="my-1 flex rounded-md shadow-sm">
                                    <input type="text"
                                           v-model="propertyForm.title"
                                           id="title"
                                           autocomplete="title"
                                           class="h-input flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300">
                                </div>
                                <errors :error="errors.title"
                                        :options="{ noContainer: true }"
                                ></errors>
                            </div>
                        </div>

                        <div class="col-span-4 lg:flex lg:-mx-2">
                            <div class="w-full lg:w-1/2 lg:mx-2">
                                <label for="property_type" class="block text-sm font-medium text-gray-700">
                                    <strong class="required">*</strong>
                                    Tipo de Propiedad
                                    <span class="text-gray-500 font-light text-xs">(requerido)</span>
                                </label>
                                <div class="my-1 rounded-md shadow-sm text-base">
                                    <vue-multiselect v-model="selectedPropertyType"
                                                     :options="getPropertyTypes"
                                                     id="property_type"
                                                     label="display_name"
                                                     :searchable="false"
                                                     :close-on-select="true"
                                                     :show-labels="true"
                                                     select-label=""
                                                     selected-label=""
                                                     deselect-label=""
                                                     :hide-selected="true"
                                                     @select="lookupPropertyCategories"
                                    ></vue-multiselect>
                                </div>
                                <errors :error="errors.property_category_id"
                                        :options="{ noContainer: true }"
                                ></errors>
                            </div>
                            <div class="w-full lg:w-1/2 lg:mx-2 mt-6 lg:mt-0">
                                <label for="property_category_id" class="block text-sm font-medium text-gray-700">
                                    <strong class="required">*</strong>
                                    Categoría de la Propiedad
                                    <span class="text-gray-500 font-light text-xs">(requerido)</span>
                                </label>
                                <div class="my-1 rounded-md shadow-sm text-base">
                                    <vue-multiselect v-model="propertyForm.propertyCategory"
                                                     :options="propertyCategoriesByPropertyType"
                                                     label="displayName"
                                                     id="property_category_id"
                                                     :searchable="false"
                                                     :close-on-select="true"
                                                     :show-labels="true"
                                                     select-label=""
                                                     selected-label=""
                                                     deselect-label=""
                                                     :hide-selected="true">
                                        <template slot="noResult">
                                            <span class="text-lg text-yellow-600">Lo sentimos, no se encontraron resultados :(</span>
                                        </template>
                                        <template slot="noOptions">Selecciona un Tipo de Propiedad</template>
                                    </vue-multiselect>
                                </div>
                                <errors :error="errors.property_category_id"
                                        :options="{ noContainer: true }"
                                ></errors>
                            </div>
                        </div>

                        <div class="col-span-4 lg:flex lg:-mx-2">
                            <div class="w-full lg:w-1/2 lg:mx-2">
                                <label for="business_type" class="block text-sm font-medium text-gray-700">
                                    <strong class="required">*</strong>
                                    Tipo de Negocio
                                    <span class="text-gray-500 font-light text-xs">(requerido)</span>
                                </label>
                                <div class="my-1 rounded-md shadow-sm text-base">
                                    <vue-multiselect v-model="propertyForm.businessType"
                                                     :options="getBusinessTypes"
                                                     id="business_type"
                                                     :searchable="false"
                                                     :close-on-select="true"
                                                     :show-labels="true"
                                                     :select-label="''"
                                                     :selected-label="''"
                                                     :deselect-label="''"
                                                     :hide-selected="true"
                                                     :placeholder="''"
                                    ></vue-multiselect>
                                </div>
                                <errors :error="errors.business_type"
                                        :options="{ noContainer: true }"
                                ></errors>
                            </div>
                            <div class="w-full lg:w-1/2 lg:mx-2 mt-6 lg:mt-0">
                                <label for="price" class="block text-sm font-medium text-gray-700">
                                    <strong class="required">*</strong>
                                    Precio
                                    <span class="text-gray-500 font-light text-xs">(requerido)</span>
                                </label>
                                <div class="my-1 flex rounded-md shadow-sm">
                                    <input type="number"
                                           v-model="propertyForm.price"
                                           id="price"
                                           autocomplete="price"
                                           class="h-input flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300">
                                </div>
                                <errors :error="errors.price"
                                        :options="{ noContainer: true }"
                                ></errors>
                            </div>
                        </div>

                        <div class="col-span-4 lg:flex lg:-mx-2">
                            <div class="w-full lg:w-1/2 lg:mx-2">
                                <label for="phone" class="block text-sm font-medium text-gray-700">
                                    <strong class="required">*</strong>
                                    Teléfono
                                    <span class="text-gray-500 font-light text-xs">(opcional)</span>
                                </label>
                                <div class="my-1 rounded-md shadow-sm text-base">
                                    <input type="text"
                                           v-model="propertyForm.phone"
                                           id="phone"
                                           class="h-input flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300">
                                </div>
                                <errors :error="errors.phone"
                                        :options="{ noContainer: true }"
                                ></errors>
                            </div>
                            <div class="w-full lg:w-1/2 lg:mx-2 mt-6 lg:mt-0">
                                <label for="email" class="block text-sm font-medium text-gray-700">
                                    <strong class="required">*</strong>
                                    Correo Electrónico
                                    <span class="text-gray-500 font-light text-xs">(opcional)</span>
                                </label>
                                <div class="my-1 flex rounded-md shadow-sm">
                                    <input type="email"
                                           v-model="propertyForm.email"
                                           id="email"
                                           class="h-input flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300">
                                </div>
                                <errors :error="errors.email"
                                        :options="{ noContainer: true }"
                                ></errors>
                            </div>
                        </div>

                        <div class="col-span-4">
                            <div class="w-full">
                                <label for="about" class="block text-sm font-medium text-gray-700">
                                    Comentarios adicionales
                                    <span class="text-gray-500 font-light text-xs">(opcional)</span>
                                </label>
                                <div class="mt-1">
                                    <textarea id="about" v-model="propertyForm.comments" rows="6" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
                                </div>
                                <errors :error="errors.comments"
                                        :options="{ noContainer: true }"
                                ></errors>
                                <p class="mt-2 text-sm text-gray-500">Escribe comentarios adicionales sobre la propiedad.</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="pt-5">
                <div class="flex justify-end">
                    <button @click="cancel"
                            type="button"
                            class="ml-3 h-btn">
                        Cancelar
                    </button>
                    <button @click="store"
                            type="submit"
                            class="ml-3 h-btn-success"
                            :disabled="isLoading">
                        Guardar
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
import VueMultiselect from 'vue-multiselect'
import SweetAlert from "../../models/SweetAlert";

export default {
    name: "CreateProperty",
    data() {
        return {
            endpoint: '/properties',
            propertyForm: {
                title: '',
                propertyCategory: {
                    name: '',
                    displayName: '',
                    propertyType: {}
                },
                businessType: '',
                price: 0,
                phone: '',
                email: '',
                comments: ''
            },
            propertyTypes: [],
            businessTypes: [],
            propertyCategoriesByPropertyType: [],

            selectedPropertyType: {},


            isLoading: false,
            errors: [],
        }
    },
    methods: {
        store() {
            this.isLoading = true
            axios.post(this.endpoint, {
                title: this.propertyForm.title,
                property_category_id: this.propertyForm.propertyCategory ? this.propertyForm.propertyCategory.id : null,
                business_type: this.propertyForm.businessType,
                price: this.propertyForm.price,
                phone: this.propertyForm.phone,
                email: this.propertyForm.email,
                comments: this.propertyForm.comments
            }).then(response => {
                window.Event.$emit('properties.new-property', response.data.data)
                this.propertyForm = {}
                SweetAlert.success('Tu Propiedad ha sido creada exitosamente!')
            }).catch(error => this.errors = error.response.status === 422 ?
                error.response.data.errors :
                [])
            this.isLoading = false
        },
        getPropertyCategoriesByPropertyType(selectedPropertyType) {
            this.selectedPropertyType = selectedPropertyType ? selectedPropertyType : this.selectedPropertyType
            this.propertyForm.propertyCategory = {}
            axios.get(`/property-types/${this.selectedPropertyType.id}/property-categories`)
                .then(response => { this.propertyCategoriesByPropertyType = response.data.data })
                .catch(error => { console.log(error) })
        },
        cancel() {
            location.reload()
        },
        lookupPropertyCategories(propertyType) {
            this.propertyCategoriesByPropertyType = this.getPropertyCategories.filter(propertyCategory => {
                return propertyCategory.propertyType.id === propertyType.id
            })
        },
    },
    computed: {
        ...mapGetters({
            getPropertyTypes: 'properties/getPropertyTypes',
            getPropertyCategories: 'properties/getPropertyCategories',
            getBusinessTypes: 'properties/getBusinessTypes'
        })
    },
    created() {
        window.currentTab = 'createProperty'

        this.$store.dispatch('properties/fetchPropertyTypes')
        this.$store.dispatch('properties/fetchPropertyCategories')
        this.$store.dispatch('properties/fetchBusinessTypes')
    },
    components: {
        VueMultiselect,
        Errors: () => import(/* webpackChunkName: "errors" */ '../../components/Errors'),
    }
}
</script>


