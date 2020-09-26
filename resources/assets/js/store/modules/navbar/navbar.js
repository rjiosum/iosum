import {Factory} from '@/repositories/factory'
import * as types from './mutation-types'
const NavRepository = Factory.get('nav')

const state = () => ({
    nav: {}
})

const getters = {
    navbar(state){
        return state.nav
    }
}

const mutations = {
    [types.SET_NAVBAR](state, payload){
        state.nav = Object.assign({}, state.nav, payload)
    },
    [types.UNSET_NAVBAR](state){
        state.nav = {}
    }
}

const actions = {
    async getNavBar ({commit}) {
        const response = await NavRepository.tree()
        if(response.status === 200){
            commit(types.SET_NAVBAR, response.data.data)
        }else{
            commit(types.UNSET_NAVBAR);
        }
        return response
    }
}


export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}