const state = {
    businessTypes: [],
    propertyTypes: [],

}

const getters = {
    getPropertyTypes(state) {
        return state.propertyTypes
    },
    getBusinessTypes(state) {
        return state.businessTypes
    },
}

const actions = {
    fetchPropertyTypes({ commit }) {
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
    },
    fetchBusinessTypes({ commit }) {
        return new Promise((resolve, reject) => {
            axios.get("/business-types")
                .then(response => {
                    commit('SET_BUSINESS_TYPES', response.data.data)
                })
                .catch(error => {
                    reject(error)
                    console.log("Error fetching Business Types")
                })
        })
    },
}

const mutations = {
    SET_PROPERTY_TYPES(state, data) {
        state.propertyTypes = data
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
