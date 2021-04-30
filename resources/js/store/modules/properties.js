const state = {
    businessTypes: [],
    propertyTypes: [],
    propertyCategories: [],
}

const getters = {
    getPropertyTypes(state) {
        return state.propertyTypes
    },
    getPropertyCategories(state) {
        return state.propertyCategories
    },
    getBusinessTypes(state) {
        return state.businessTypes
    },
}

const actions = {
    fetchPropertyTypes({ commit }) {
        let storage = window.localStorage
        if (
            storage.hasOwnProperty('app') &&
            JSON.parse(storage.app).hasOwnProperty('properties') &&
            JSON.parse(storage.app).properties.hasOwnProperty('propertyTypes') &&
            JSON.parse(storage.app).properties.propertyTypes.length > 0
        ) {
            commit(
                'SET_PROPERTY_TYPES',
                JSON.parse(storage.app).properties.propertyTypes
            )
            // dd('propertyTypes from properties.js')
        } else {
            return new Promise((resolve, reject) => {
                axios.get("/property-types")
                    .then(response => {
                        commit('SET_PROPERTY_TYPES', response.data.data)
                    })
                    .catch(error => {
                        reject(error)
                        console.log("Error fetching Property Types")
                    })
            })
        }
    },
    fetchPropertyCategories({ commit }) {
        let storage = window.localStorage
        if (
            storage.hasOwnProperty('app') &&
            JSON.parse(storage.app).hasOwnProperty('properties') &&
            JSON.parse(storage.app).properties.hasOwnProperty('propertyCategories') &&
            JSON.parse(storage.app).properties.propertyCategories.length
        ) {
            commit(
                'SET_PROPERTY_CATEGORIES',
                JSON.parse(storage.app).properties.propertyCategories
            )
            // dd('propertyCategories from properties.js')
        } else {
            return new Promise((resolve, reject) => {
                axios.get("/property-categories")
                    .then(response => {
                        commit('SET_PROPERTY_CATEGORIES', response.data.data)
                    })
                    .catch(error => {
                        reject(error)
                        console.log("Error fetching Property Categories")
                    })
            })
        }

    },
    fetchBusinessTypes({ commit }) {
        let storage = window.localStorage
        if (
            storage.hasOwnProperty('app') &&
            JSON.parse(storage.app).hasOwnProperty('properties') &&
            JSON.parse(storage.app).properties.hasOwnProperty('businessTypes') &&
            JSON.parse(storage.app).properties.businessTypes.length
        ) {
            commit(
                'SET_BUSINESS_TYPES',
                JSON.parse(storage.app).properties.businessTypes
            )
            // dd('businessTypes from properties.js')
        } else {
            return new Promise((resolve, reject) => {
                axios.get("/business-types")
                    .then(response => {
                        commit('SET_BUSINESS_TYPES', response.data.data)
                    })
                    .catch(error => {
                        reject(error)
                        dd("Error fetching Business Types")
                    })
            })
        }
    },
}

const mutations = {
    SET_PROPERTY_TYPES(state, data) {
        state.propertyTypes = data
    },
    SET_PROPERTY_CATEGORIES(state, data) {
        state.propertyCategories = data
    },
    SET_BUSINESS_TYPES(state, data) {
        state.businessTypes = data
    },
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
