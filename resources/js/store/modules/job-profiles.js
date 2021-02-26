const state = {
    skills: [],
}

const getters = {
    getSkills(state) {
        return state.skills
    },
}

const actions = {
    fetchSkills({ commit }) {
        return new Promise((resolve, reject) => {
            axios.get("/skills")
                .then(response => {
                    commit('SET_SKILLS', response.data.data)
                })
                .catch(error => {
                    reject(error)
                    console.log("Error fetching Skills")
                })
        })
    },
}

const mutations = {
    SET_SKILLS(state, data) {
        state.skills = data
    },
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
