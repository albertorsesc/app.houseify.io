import Vue from 'vue/dist/vue'
import Vuex from 'vuex'
import createPersistedState from "vuex-persistedstate";


import general from './modules/general'
import properties from './modules/properties'
import jobProfiles from './modules/job-profiles'


const appState = createPersistedState({
    key: 'app',
    paths: [
        // general.js
        'general.states',
        'general.categories',
        // properties.js
        'properties.propertyTypes',
        'properties.propertyCategories',
        'properties.businessTypes',
        // job-profiles.js
        'jobProfiles.skills',
    ]
})

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        general,
        properties,
        jobProfiles,
    },
    plugins: [
        appState,
    ]
})
