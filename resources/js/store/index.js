import Vue from 'vue/dist/vue'
import Vuex from 'vuex'

import global from './modules/global'
import properties from './modules/properties'

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        global,
        properties,
    },
})
