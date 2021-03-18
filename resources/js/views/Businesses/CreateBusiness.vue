<template>
    <div class="bg-white shadow-lg rounded-lg p-6 mt-4">
        <form @submit.prevent class="space-y-8 divide-y divide-gray-200">
            <div class="space-y-8 divide-y divide-gray-200">
                <div>
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Nuevo Negocio
                        </h3>
                        <p class="mt-1 text-sm text-gray-500">
                            Registra los datos basicos de tu negocio.
                        </p>
                    </div>

                    <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                        <div class="sm:col-span-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">
                                <strong class="required">*</strong>
                                Nombre del Negocio
                            </label>
                            <div class="my-1 flex rounded-md shadow-sm">
                                <input type="text"
                                       v-model="businessForm.name"
                                       id="name"
                                       autocomplete="name"
                                       class="h-input flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300">
                            </div>
                            <errors :error="errors.name"
                                    :options="{ noContainer: true }"
                            ></errors>
                            <div class="mt-2 w-full md:flex rounded-md shadow-sm">
                                <span class="inline-flex items-center px-3 py-2 rounded-l-md border md:border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                  houseify.io/directorio-de-negocios/
                                </span>
                                <span class="py-2 px-2 md:p-3 bg-gray-100 flex-1 focus:ring-indigo-500 focus:border-indigo-500 border border-r-0 border-gray-300 block w-full min-w-0 rounded-none rounded-r-md text-sm border-gray-300">
                                    {{this.businessForm.name | toKebabCase}}
                                </span>
                            </div>
                        </div>

                        <div class="sm:col-span-4 md:-mx-2">
                            <div class="w-full md:mx-2">
                                <label for="categories" class="block text-sm font-medium text-gray-700">
                                    Categorias
                                </label>
                                <div class="my-1 rounded-md shadow-sm text-base ring-white">
                                    <vue-multiselect v-model="businessForm.categories"
                                                     :placeholder="''"
                                                     :options="getConstructionCategories"
                                                     :multiple="true"
                                                     :taggable="true"
                                                     :hide-selected="true"
                                                     id="categories"
                                                     :searchable="true"
                                                     :close-on-select="false"
                                                     select-label=""
                                                     selected-label=""
                                                     deselect-label=""
                                                     placeholder="Selecciona las Categorias de Construccion de tu Negocio..."
                                    ></vue-multiselect>
                                </div>
<!--                                <vue-multiselect v-model="businessForm.categories"
                                                 :options="categories"
                                                 id="categories"
                                                 :multiple="true"
                                                 :value="Array"
                                                 label="name"
                                                 :searchable="true"
                                                 :show-labels="true"
                                                 select-label=""
                                                 selected-label=""
                                                 deselect-label=""
                                                 :close-on-select="false"
                                                 :clear-on-select="false"
                                                 :hide-selected="true"
                                                 placeholder="Selecciona tu Estado...">
                                    <template slot="noResult">
                                        <span class="text-lg text-yellow-600">Lo sentimos, no se encontraron resultados :(</span>
                                    </template>
                                </vue-multiselect>-->
                            </div>
                        </div>

                        <div class="sm:col-span-4 md:flex md:-mx-2">
                            <div class="w-full md:w-1/2 md:mx-2">
                                <label for="email" class="block text-sm font-medium text-gray-700">
                                    Correo Electronico
                                </label>
                                <div class="my-1 rounded-md shadow-sm text-base">
                                    <input type="email"
                                           v-model="businessForm.email"
                                           id="email"
                                           autocomplete="email"
                                           class="h-input flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300">
                                </div>
                                <errors :error="errors.email"
                                        :options="{ noContainer: true }"
                                ></errors>
                            </div>
                            <div class="mt-4 md:mt-0 w-full md:w-1/2 md:mx-2">
                                <label for="phone" class="block text-sm font-medium text-gray-700">
                                    Telefono
                                </label>
                                <div class="my-1 flex rounded-md shadow-sm">
                                    <input type="text"
                                           v-model="businessForm.phone"
                                           id="phone"
                                           autocomplete="phone"
                                           class="h-input flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300">
                                </div>
                                <errors :error="errors.phone"
                                        :options="{ noContainer: true }"
                                ></errors>
                            </div>
                        </div>

                        <div class="sm:col-span-4 md:flex md:-mx-2">
                            <div class="w-full md:mx-2">
                                <label for="site" class="block text-sm font-medium text-gray-700">
                                    Sitio Web
                                </label>
                                <div class="my-1 rounded-md shadow-sm text-base">
                                    <input type="text"
                                           v-model="businessForm.site"
                                           id="site"
                                           autocomplete="site"
                                           class="h-input flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300">
                                </div>
                                <errors :error="errors.email"
                                        :options="{ noContainer: true }"
                                ></errors>
                            </div>
                        </div>

                        <!--Comments-->
                        <div class="sm:col-span-4">
                            <label for="about" class="block text-sm font-medium text-gray-700">
                                Comentarios adicionales
                            </label>
                            <div class="mt-1">
                                <textarea id="about"
                                          v-model="businessForm.comments"
                                          rows="6"
                                          class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                ></textarea>
                            </div>
                            <errors :error="errors.comments"
                                    :options="{ noContainer: true }"
                            ></errors>
                            <p class="mt-2 text-sm text-gray-500">Escribe comentarios adicionales sobre tu negocio/empresa.</p>
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
    name: "CreateBusiness",
    data() {
        return {
            endpoint: '/businesses',
            businessForm: {
                name: '',
                categories: [],
                email: '',
                phone: '',
                site: '',
                comments: ''
            },

            errors: [],
        }
    },
    methods: {
        store() {
            axios.post(this.endpoint, {
                name: this.businessForm.name,
                email: this.businessForm.email,
                categories: this.businessForm.categories,
                phone: this.businessForm.phone,
                site: this.businessForm.site,
                comments: this.businessForm.comments
            }).then(response => {
                Event.$emit('businesses.new-business', response.data.data)
                this.businessForm = {}
                SweetAlert.success('Tu Negocio ha sido creado exitosamente!')
            }).catch(error => this.errors = error.response.status === 422 ?
                error.response.data.errors :
                [])
        },
        cancel() {
            location.reload()
        },
    },
    mounted() {
    },
    computed: {
        ...mapGetters({
            getConstructionCategories: 'global/getConstructionCategories'
        })
    },
    created() {
        window.currentTab = 'createBusiness'

        this.$store.dispatch('global/fetchConstructionCategories')
    },
    components: {
        VueMultiselect,
        Errors: () => import(/* webpackChunkName: "errors" */ '../../components/Errors'),
    }
}
</script>


