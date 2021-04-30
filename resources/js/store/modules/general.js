const state = {
    /* Common */
    categories: [],
    states: [],
}

const getters = {
    getConstructionCategories(state) {
        return state.categories
    },

    getStates(state) {
        return state.states
    },
}

const actions = {
    fetchConstructionCategories({ commit }){
        let storage = window.localStorage
        if (
            storage.hasOwnProperty('app') &&
            JSON.parse(storage.app).hasOwnProperty('general') &&
            JSON.parse(storage.app).general.hasOwnProperty('categories') &&
            JSON.parse(storage.app).general.categories.length > 0
        ) {
            commit(
                'SET_CONSTRUCTION_CATEGORIES',
                JSON.parse(storage.app).general.categories
            )
            // dd('constructionCategories from global.js')
        } else {
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
        }
    },

    fetchStates({ commit }){
        let storage = window.localStorage
        if (
            storage.hasOwnProperty('app') &&
            JSON.parse(storage.app).hasOwnProperty('general') &&
            JSON.parse(storage.app).general.hasOwnProperty('states') &&
            JSON.parse(storage.app).general.states.length > 0
        ) {
            commit('SET_STATES', JSON.parse(storage.app).general.states)
            // dd('states from global.js')
        } else {
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
    mutations,
}
