import Vue from 'vue/dist/vue'
import Vuex from 'vuex'
import createPersistedState from "vuex-persistedstate";


import global from './modules/global'
import properties from './modules/properties'
import jobProfiles from './modules/job-profiles'


const appState = createPersistedState({
    key: 'app',
    paths: [
        // global.js
        'global.states',
        'global.categories',
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
        global,
        properties,
        jobProfiles,
    },
    plugins: [
        appState,
    ]
})
