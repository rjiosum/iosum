import * as types from './mutation-types'

const state = () => ({
    drawer: true,
    expandOnHover: false
})

const getters = {
    drawer(state) {
        return state.drawer
    },
    expandOnHover(state){
        return state.expandOnHover
    }
}

const mutations = {
    [types.SET_DRAWER](state, payload){
        state.drawer = payload
    },
    [types.SET_EXPAND_ON_HOVER](state, payload){
        state.expandOnHover = payload
    }
}

const actions = {
    setDrawer({commit}, payload){
        commit(types.SET_DRAWER, payload)
    },

    setExpandOnHover({state, commit}, payload){
        if(!state.drawer){
            commit(types.SET_DRAWER, true)
            commit(types.SET_EXPAND_ON_HOVER, true)
        }else{
            commit(types.SET_EXPAND_ON_HOVER, payload)
        }
    }
}


export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}