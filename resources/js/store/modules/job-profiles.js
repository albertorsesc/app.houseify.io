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
        let storage = window.localStorage
        if (
            storage.hasOwnProperty('app') &&
            JSON.parse(storage.app).hasOwnProperty('jobProfiles') &&
            JSON.parse(storage.app).jobProfiles.hasOwnProperty('skills') &&
            JSON.parse(storage.app).jobProfiles.skills.length > 0
        ) {
            commit('SET_SKILLS', JSON.parse(storage.app).jobProfiles.skills)
            dd('skills from jobProfiles.js')
        } else {
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
        }
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
