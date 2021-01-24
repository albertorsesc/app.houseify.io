require('./bootstrap');
require('alpinejs');
// import Vue from 'vue/dist/vue.runtime.esm.js'
// window.Vue = require('vue/dist/vue')
window.Vue = require('vue/dist/vue.js')
window.dd = console.log
window.baseURL = window.URL

Vue.component('nav-bar', require('./components/NavBar').default);
Vue.component('properties', require('./views/Properties/Properties').default);
Vue.component('property-profile', require('./views/Properties/PropertyProfile').default);

Vue.component('businesses', require('./views/Businesses/Businesses').default);
Vue.component('business-profile', require('./views/Businesses/BusinessProfile').default);

Vue.component('profile', require('./views/User/Profile').default);

/*
* Vue-Multiselect
* https://vue-multiselect.js.org/
*  */

/** Events */
window.Event = new Vue()

const app = new Vue({
    el: '#app',
});
