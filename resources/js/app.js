require('./bootstrap');
require('alpinejs');
import Vue from 'vue/dist/vue'
if (process.env.MIX_NODE_ENV === 'production') {
    Vue.config.devtools = false;
    Vue.config.debug = false;
    Vue.config.silent = true;
    Vue.config.productionTip = true
}
window.baseURL = process.env.MIX_APP_URL
window.dd = console.log
/** Events */
window.Event = new Vue()
Vue.config.productionTip = false

Vue.component('nav-bar', require('./components/NavBar').default);
Vue.component('properties', require('./views/Properties/Properties').default);
Vue.component('property-profile', require('./views/Properties/PropertyProfile').default);
Vue.component('display-property', require('./views/Properties/Guests/DisplayProperty').default);

Vue.component('businesses', require('./views/Businesses/Businesses').default);
Vue.component('business-profile', require('./views/Businesses/BusinessProfile').default);
Vue.component('display-business', require('./views/Businesses/Guests/DisplayBusiness').default);

Vue.component('job-profiles', require('./views/JobProfiles/JobProfiles').default);
Vue.component('job-profile', require('./views/JobProfiles/JobProfile').default);
Vue.component('display-job-profile', require('./views/JobProfiles/Guests/DisplayJobProfile').default);

/* Forum */

Vue.component('thread-profile', require('./views/Forum/Threads/ThreadProfile').default);

Vue.component('profile', require('./views/User/Profile').default);

/** Auth mixin */
import auth from './mixins/auth';
Vue.mixin(auth)

/** Helper mixin */
import mixins from './mixins/mixins';
Vue.mixin(mixins)

/* Packages */

/**
 * Algolia - Vue Instant Search ^3.5.0
 * https://www.algolia.com/doc/guides/building-search-ui/installation/vue/#installing-vue-instantsearch
 */
import VueInstantSearch from 'vue-instantsearch';
Vue.use(VueInstantSearch);
// import { createServerRootMixin } from 'vue-instantsearch';

/**
 * Vuex
 * https://vuex.vuejs.org/
 */
import Vuex from 'vuex'
Vue.use(Vuex)

/**
 * Vuex Persisted State
 * https://github.com/robinvdvleuten/vuex-persistedstate
 */
import createPersistedState from "vuex-persistedstate";
/* Vuex Config */
import general from './store/modules/general'
import properties from './store/modules/properties'
import jobProfiles from './store/modules/job-profiles'
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
let store = new Vuex.Store({
    modules: {
        general,
        properties,
        jobProfiles,
    },
    plugins: [
        appState,
    ]
})

/*
* Vue-Multiselect
* https://vue-multiselect.js.org/
*  */

/**
 * Livewire/Vue CDN
 * https://github.com/livewire/vue
 * <script src="https://cdn.jsdelivr.net/gh/livewire/vue@v0.3.x/dist/livewire-vue.js"></script>
 * Not required for now
 */

/**
 * SweetAlert2
 * https://sweetalert2.github.io
 */

const app = new Vue({
    el: '#app',
    store,
});

/* Window variables/functions */

/* Geolocation */
window.currentLocation = function () {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(window.showLocation);
    } else {
        dd("Geolocalización no soportada.");
    }
};
window.showLocation = function (position) {
    if (! window.localStorage.hasOwnProperty('me')) {
        let obj = {
            location: {
                latitude: position.coords.latitude,
                longitude: position.coords.longitude
            }
        }
        window.localStorage.me = JSON.stringify(obj)
    }
};
window.currentLocation()


