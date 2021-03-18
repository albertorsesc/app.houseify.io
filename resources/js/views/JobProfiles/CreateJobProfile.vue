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
                            Registra tus datos basicos para el perfil.
                        </p>
                    </div>

                    <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                        <!--Title-->
                        <div class="sm:col-span-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">
                                <strong class="required">*</strong>
                                Titulo del Perfil
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

                        <!--Skills-->
                        <div class="sm:col-span-4">
                            <div class="w-full">
                                <label for="skills" class="block text-sm font-medium text-gray-700">
                                    <strong class="required">*</strong>
                                    Habilidades
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
                                                     placeholder="Selecciona tus habilidades de Trabajo..."
                                    ></vue-multiselect>
                                </div>
                                <errors :error="errors.skills"
                                        :options="{ noContainer: true }"
                                ></errors>
                            </div>
                        </div>

                        <div class="sm:col-span-4 md:flex md:-mx-2">
                            <!--Email-->
                            <div class="w-full md:w-1/3 md:mx-2">
                                <label for="email" class="block text-sm font-medium text-gray-700">
                                    Correo Electronico
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
                            <div class="mt-4 md:mt-0 w-full md:w-1/3 md:mx-2">
                                <label for="phone" class="block text-sm font-medium text-gray-700">
                                    Telefono
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
                            <!--BirthdateAt-->
                            <div class="mt-4 md:mt-0 w-full md:w-1/3 md:mx-2">
                                <label for="birthdate_at" class="block text-sm font-medium text-gray-700">
                                    <strong class="required">*</strong>
                                    Fecha de Nacimiento
                                </label>
                                <div class="my-1 flex rounded-md shadow-sm">
                                    <input type="date"
                                           v-model="jobProfileForm.birthdateAt"
                                           id="birthdate_at"
                                           autocomplete="birthdate_at"
                                           class="h-input flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300">
                                </div>
                                <errors :error="errors.birthdate_at"
                                        :options="{ noContainer: true }"
                                ></errors>
                            </div>
                        </div>

                        <div class="sm:col-span-4 md:flex md:-mx-2">
                            <!--Site-->
                            <div class="w-full md:w-1/2 md:mx-2">
                                <label for="site" class="block text-sm font-medium text-gray-700">
                                    Sitio Web
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
                            <!--Facebook Profile-->
                            <div class="w-full md:w-1/2 md:mx-2">
                                <label for="facebook_profile" class="block text-sm font-medium text-gray-700">
                                    Perfil de Facebook
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
                        </div>

                        <!--Comments-->
                        <div class="sm:col-span-4">
                            <label for="bio" class="block text-sm font-medium text-gray-700">
                                <strong class="required">*</strong>
                                Comentarios adicionales
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
                birthdateAt: '',
                email: '',
                phone: '',
                site: '',
                facebookProfile: '',
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
                birthdate_at: this.jobProfileForm.birthdateAt,
                email: this.jobProfileForm.email,
                phone: this.jobProfileForm.phone,
                site: this.jobProfileForm.site,
                facebook_profile: this.jobProfileForm.facebookProfile,
                bio: this.jobProfileForm.bio
            }).then(response => {
                Event.$emit('job-profiles.new-job-profile', response.data.data)
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
    mounted() {
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
        Errors: () => import(/* webpackChunkName: "errors" */ '../../components/Errors'),
        VueMultiselect,
    }
}
</script>


