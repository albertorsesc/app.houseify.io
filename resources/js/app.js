require('./bootstrap');
require('alpinejs');
// import Vue from 'vue/dist/vue.runtime.esm.js'
// window.Vue = require('vue/dist/vue')
window.Vue = require('vue/dist/vue.js')

Vue.component('nav-bar', require('./components/NavBar').default);
Vue.component('properties', require('./views/Properties/Properties').default);


const app = new Vue({
    el: '#app',
});
