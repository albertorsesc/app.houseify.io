<template>
    <div class="bg-white shadow-lg rounded-lg p-6 mt-4">
        <form @submit.prevent class="space-y-8 divide-y divide-gray-200">
            <div class="space-y-8 divide-y divide-gray-200">
                <div>
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Nuevo Perfil de Trabajo
                        </h3>
                        <p class="mt-1 text-sm text-gray-500">
                            Registra tus datos básicos para el perfil.
                        </p>
                    </div>

                    <div class="mt-6 grid grid-cols-1 gap-y-4 gap-x-4 sm:grid-cols-6">
                        <!--Title-->
                        <div class="col-span-4">
                            <div class="w-full">
                                <label for="title" class="block text-sm font-medium text-gray-700">
                                    <strong class="required">*</strong>
                                    Titulo del Perfil
                                    <span class="text-gray-500 font-light text-xs">(requerido)</span>
                                    <span class="text-gray-500 font-light text-xs">Escriba una breve presentación.</span>
                                </label>
                                <div class="my-1 flex rounded-md shadow-sm">
                                    <input type="text"
                                           v-model="jobProfileForm.title"
                                           id="title"
                                           autocomplete="title"
                                           autofocus
                                           class="h-input flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300">
                                </div>
                                <errors :error="errors.title"
                                        :options="{ noContainer: true }"
                                ></errors>
                            </div>
                        </div>

                        <!--Skills-->
                        <div class="col-span-4">
                            <div class="w-full">
                                <label for="skills" class="block text-sm font-medium text-gray-700">
                                    <strong class="required">*</strong>
                                    Habilidades
                                    <span class="text-gray-500 font-light text-xs">(requerido)</span>
                                    <span class="text-gray-500 font-light text-xs">
                                        Si no encuentras tu oficio o profesión deja tu sugerencia en nuestro buzón de
                                        <a href="/sugerencias" class="h-link text-emerald-500 underline">Sugerencias</a>
                                    </span>
                                </label>
                                <div class="my-1 rounded-md shadow-sm text-base ring-white">
                                    <vue-multiselect v-model="jobProfileForm.skills"
                                                     value="Object"
                                                     :placeholder="''"
                                                     :options="getSkills"
                                                     :multiple="true"
                                                     :taggable="true"
                                                     :hide-selected="true"
                                                     id="skills"
                                                     :searchable="true"
                                                     :close-on-select="false"
                                                     select-label=""
                                                     selected-label=""
                                                     deselect-label=""
                                                     :tag-placeholder="''"
                                                     placeholder="Selecciona tus habilidades de Trabajo..."
                                    ></vue-multiselect>
                                </div>
                                <errors :error="errors.skills"
                                        :options="{ noContainer: true }"
                                ></errors>
                            </div>
                        </div>

                        <div class="col-span-4 lg:flex -mx-0 lg:-mx-2">
                            <!--Email-->
                            <div class="w-full lg:w-1/2 mx-0 lg:mx-2">
                                <label for="email" class="block text-sm font-medium text-gray-700">
                                    Correo Electrónico
                                    <span class="text-gray-500 font-light text-xs">(opcional)</span>
                                </label>
                                <div class="my-1 rounded-md shadow-sm text-base">
                                    <input type="email"
                                           v-model="jobProfileForm.email"
                                           id="email"
                                           autocomplete="email"
                                           class="h-input flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300">
                                </div>
                                <errors :error="errors.email"
                                        :options="{ noContainer: true }"
                                ></errors>
                            </div>
                            <!--Phone-->
                            <div class="w-full lg:w-1/2 mx-0 lg:mx-2 mt-4 xl:mt-0">
                                <label for="phone" class="block text-sm font-medium text-gray-700">
                                    Teléfono
                                    <span class="text-gray-500 font-light text-xs">(opcional)</span>
                                </label>
                                <div class="my-1 flex rounded-md shadow-sm">
                                    <input type="text"
                                           v-model="jobProfileForm.phone"
                                           id="phone"
                                           autocomplete="phone"
                                           class="h-input flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300">
                                </div>
                                <errors :error="errors.phone"
                                        :options="{ noContainer: true }"
                                ></errors>
                            </div>
                        </div>

                        <div class="col-span-4 lg:flex lg:-mx-2">
                            <!--Facebook Profile-->
                            <div class="w-full lg:w-1/3 lg:mx-2">
                                <label for="facebook_profile" class="block text-sm font-medium text-gray-700">
                                    Perfil de Facebook
                                    <span class="text-gray-500 font-light text-xs">(opcional)</span>
                                </label>
                                <div class="my-1 rounded-md shadow-sm text-base">
                                    <input type="text"
                                           v-model="jobProfileForm.facebookProfile"
                                           id="facebook_profile"
                                           autocomplete="facebook_profile"
                                           class="h-input flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300">
                                </div>
                                <errors :error="errors.facebook_profile"
                                        :options="{ noContainer: true }"
                                ></errors>
                            </div>
                            <!--LinkedIn Profile-->
                            <div class="w-full lg:w-1/3 lg:mx-2 mt-4 lg:mt-0">
                                <label for="facebook_profile" class="block text-sm font-medium text-gray-700">
                                    Perfil de LinkedIn
                                    <span class="text-gray-500 font-light text-xs">(opcional)</span>
                                </label>
                                <div class="my-1 rounded-md shadow-sm text-base">
                                    <input type="text"
                                           v-model="jobProfileForm.linkedinProfile"
                                           id="linkedin_profile"
                                           autocomplete="linkedin_profile"
                                           class="h-input flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300">
                                </div>
                                <errors :error="errors.linkedin_profile"
                                        :options="{ noContainer: true }"
                                ></errors>
                            </div>
                            <!--Site-->
                            <div class="w-full lg:w-1/3 lg:mx-2 mt-4 lg:mt-0">
                                <label for="site" class="block text-sm font-medium text-gray-700">
                                    Sitio Web
                                    <span class="text-gray-500 font-light text-xs">(opcional)</span>
                                </label>
                                <div class="my-1 rounded-md shadow-sm text-base">
                                    <input type="text"
                                           v-model="jobProfileForm.site"
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
                                <label for="bio" class="block text-sm font-medium text-gray-700">
                                    Comentarios adicionales
                                    <span class="text-gray-500 font-light text-xs">(opcional)</span>
                                </label>
                                <div class="mt-1">
                            <textarea id="bio"
                                      v-model="jobProfileForm.bio"
                                      rows="6"
                                      class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                            ></textarea>
                                </div>
                                <errors :error="errors.bio"
                                        :options="{ noContainer: true }"
                                ></errors>
                                <p class="mt-2 text-sm text-gray-500">Escribe comentarios adicionales sobre ti.</p>
                            </div>
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
    name: "CreateJobProfile",
    data() {
        return {
            endpoint: '/job-profiles',
            jobProfileForm: {
                title: '',
                skills: [],
                email: '',
                phone: '',
                site: '',
                facebookProfile: '',
                linkedinProfile: '',
                bio: ''
            },

            errors: [],
        }
    },
    methods: {
        store() {
            axios.post(this.endpoint, {
                title: this.jobProfileForm.title,
                skills: this.jobProfileForm.skills,
                email: this.jobProfileForm.email,
                phone: this.jobProfileForm.phone,
                site: this.jobProfileForm.site,
                facebook_profile: this.jobProfileForm.facebookProfile,
                linkedin_profile: this.jobProfileForm.linkedinProfile,
                bio: this.jobProfileForm.bio
            }).then(response => {
                window.Event.$emit('job-profiles.new-job-profile', response.data.data)
                this.jobProfileForm = {}
                SweetAlert.success('Tu Perfil ha sido creado exitosamente!')
            }).catch(error => this.errors = error.response.status === 422 ?
                error.response.data.errors :
                [])
        },
        cancel() {
            location.reload()
        },
    },
    computed: {
        ...mapGetters({
            getSkills: 'jobProfiles/getSkills'
        })
    },
    created() {
        window.currentTab = 'createJobProfile'

        this.$store.dispatch('jobProfiles/fetchSkills')
    },
    components: {
        VueMultiselect,
        Errors: () => import(/* webpackChunkName: "errors" */ '../../components/Errors'),
    }
}
</script>


