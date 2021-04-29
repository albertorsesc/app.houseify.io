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
                            Registra los datos básicos de tu negocio.
                        </p>
                    </div>

                    <div class="mt-6 grid grid-cols-1 gap-y-4 gap-x-4 sm:grid-cols-6">
                        <div class="col-span-4">
                            <div class="w-full">
                                <label for="name" class="block text-sm font-medium text-gray-700">
                                    <strong class="required">*</strong>
                                    Nombre del Negocio
                                    <span class="text-gray-500 font-light text-xs">(requerido)</span>
                                    <span class="ml-2 text-gray-700 font-light text-xs">
                                    Asegúrate de introducir el nombre correcto, una vez registrado no puede ser cambiado.
                                </span>
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
                            </div>
                        </div>

                        <div class="col-span-4">
                            <div class="w-full">
                                <label for="categories" class="block text-sm font-medium text-gray-700">
                                    Categorías
                                    <span class="text-gray-500 font-light text-xs">(requerido)</span>
                                    <span class="text-gray-500 font-light text-xs">
                                        Si no encuentras tu categoría deja tu sugerencia en nuestro buzón de
                                        <a href="/sugerencias" class="h-link text-emerald-500 underline">Sugerencias</a>
                                    </span>
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
                                                     :tag-placeholder="''"
                                                     placeholder="Categorías de tu Negocio..."
                                    ></vue-multiselect>
                                </div>
                            </div>
                        </div>

                        <div class="col-span-4 lg:flex md:-mx-2">
                            <div class="w-full lg:w-1/2 md:mx-2">
                                <label for="email" class="block text-sm font-medium text-gray-700">
                                    Correo Electrónico
                                    <span class="text-gray-500 font-light text-xs">(opcional)</span>
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
                            <div class="w-full lg:w-1/2 md:mx-2 mt-4 md:mt-0">
                                <label for="phone" class="block text-sm font-medium text-gray-700">
                                    Teléfono
                                    <span class="text-gray-500 font-light text-xs">(opcional)</span>
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

                        <div class="col-span-4 lg:flex md:-mx-2">
                            <div class="w-full lg:w-1/3 md:mx-2">
                                <label for="site" class="block text-sm font-medium text-gray-700">
                                    Perfil de Facebook
                                    <span class="text-gray-500 font-light text-xs">(opcional)</span>
                                </label>
                                <div class="my-1 rounded-md shadow-sm text-base">
                                    <input type="text"
                                           v-model="businessForm.facebookProfile"
                                           id="facebook_profile"
                                           class="h-input flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300">
                                </div>
                                <errors :error="errors.facebook_profile"
                                        :options="{ noContainer: true }"
                                ></errors>
                            </div>
                            <div class="w-full lg:w-1/3 md:mx-2 mt-4 lg:mt-0">
                                <label for="site" class="block text-sm font-medium text-gray-700">
                                    Perfil de LinkedIn
                                    <span class="text-gray-500 font-light text-xs">(opcional)</span>
                                </label>
                                <div class="my-1 rounded-md shadow-sm text-base">
                                    <input type="text"
                                           v-model="businessForm.linkedinProfile"
                                           id="linkedin_profile"
                                           class="h-input flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300">
                                </div>
                                <errors :error="errors.linkedin_profile"
                                        :options="{ noContainer: true }"
                                ></errors>
                            </div>
                            <div class="w-full lg:w-1/3 md:mx-2 mt-4 lg:mt-0">
                                <label for="site" class="block text-sm font-medium text-gray-700">
                                    Sitio Web
                                    <span class="text-gray-500 font-light text-xs">(opcional)</span>
                                </label>
                                <div class="my-1 rounded-md shadow-sm text-base">
                                    <input type="text"
                                           v-model="businessForm.site"
                                           id="site"
                                           autocomplete="site"
                                           class="h-input flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300">
                                </div>
                                <errors :error="errors.site"
                                        :options="{ noContainer: true }"
                                ></errors>
                            </div>
                        </div>

                        <!--Comments-->
                        <div class="col-span-4">
                            <div class="w-full">
                                <label for="about" class="block text-sm font-medium text-gray-700">
                                    Comentarios adicionales
                                    <span class="text-gray-500 font-light text-xs">(opcional)</span>
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
                            class="ml-3 h-btn-success">
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


