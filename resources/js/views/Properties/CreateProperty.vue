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
                            Registra los datos basicos de tu propiedad.
                        </p>
                    </div>

                    <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">

                        <div class="sm:col-span-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">
                                <strong class="required">*</strong>
                                Titulo de la Publicacion
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
                        <div class="sm:col-span-4 flex md:-mx-2">
                            <div class="w-full md:w-1/2 md:mx-2">
                                <label for="property_type" class="block text-sm font-medium text-gray-700">
                                    <strong class="required">*</strong>
                                    Tipo de Propiedad
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
                            <div class="w-full md:w-1/2 md:mx-2">
                                <label for="property_category_id" class="block text-sm font-medium text-gray-700">
                                    <strong class="required">*</strong>
                                    Categoria de la Propiedad
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

                        <div class="sm:col-span-4 flex md:-mx-2">
                            <div class="w-full md:w-1/2 md:mx-2">
                                <label for="business_type" class="block text-sm font-medium text-gray-700">
                                    <strong class="required">*</strong>
                                    Tipo de Negocio
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
                            <div class="w-full md:w-1/2 md:mx-2">
                                <label for="price" class="block text-sm font-medium text-gray-700">
                                    <strong class="required">*</strong>
                                    Precio
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

                        <div class="sm:col-span-6">
                            <label for="about" class="block text-sm font-medium text-gray-700">
                                Comentarios adicionales
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

            <div class="pt-5">
                <div class="flex justify-end">
                    <button @click="cancel" type="button" class="ml-3 h-link inline-flex items-center justify-center px-4 py-2 bg-white border border-gray-200 border border-gray-200 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:font-semibold focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-primary transition ease-in-out duration-150">
                        Cancelar
                    </button>
                    <button @click="store"
                            type="submit"
                            class="ml-3 h-link inline-flex items-center justify-center px-4 py-2 bg-white border border-gray-200 rounded-md font-semibold text-xs text-emerald-500 uppercase tracking-widest hover:font-semibold hover:shadow-lg hover:bg-teal-500 hover:text-white focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-primary transition ease-in-out duration-150">
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
                comments: ''
            },
            propertyTypes: [],
            businessTypes: [],
            propertyCategoriesByPropertyType: [],

            selectedPropertyType: {},

            errors: [],
        }
    },
    methods: {
        store() {
            axios.post(this.endpoint, {
                title: this.propertyForm.title,
                property_category_id: this.propertyForm.propertyCategory ? this.propertyForm.propertyCategory.id : null,
                business_type: this.propertyForm.businessType,
                price: this.propertyForm.price,
                comments: this.propertyForm.comments
            }).then(response => {
                Event.$emit('properties.new-property', response.data.data)
                this.propertyForm = {}
                SweetAlert.success('Tu Propiedad ha sido creada exitosamente!')

            }).catch(error => this.errors = error.response.status === 422 ?
                error.response.data.errors :
                [])
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


