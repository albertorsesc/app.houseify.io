const state = {
    /* Common */
    categories: [],
    states: [],
}

const getters = {
    getConstructionCategories(state){
        return state.categories
    },

    getStates(state){
        return state.states
    },
}

const actions = {
    fetchConstructionCategories({ commit }){
        return new Promise((resolve, reject) => {
            axios.get("/construction-categories")
                .then(response => {
                    commit('SET_CONSTRUCTION_CATEGORIES', response.data.data)
                })
                .catch(error => {
                    reject(error)
                    console.log("Error fetching Construction Categories")
                })
        })
    },

    fetchStates({ commit }){
        return new Promise((resolve, reject) => {
            axios.get("/states")
                .then(response => {
                    commit('SET_STATES', response.data.data)
                })
                .catch(error => {
                    reject(error)
                    console.log("Error fetching States")
                })
        })
    }
}

const mutations = {
    SET_CONSTRUCTION_CATEGORIES(state, data) {
        state.categories = data
    },
    SET_STATES(state, data) {
        state.states = data
    },
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
