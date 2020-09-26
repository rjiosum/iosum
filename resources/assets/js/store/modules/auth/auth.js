import {Factory} from '@/repositories/factory'
import * as types from './mutation-types'

const AuthRepository = Factory.get('auth')
const UserRepository = Factory.get('user')

const state = () => ({
    user: null
})

const getters = {
    user(state){
         return state.user
    },
    isAuthenticated(state){
        return !!state.user
    }
}

const mutations = {
    [types.LOGIN](state, user){
        state.user = user
    },
    [types.LOGOUT](state){
        state.user = null
    }
}

const actions = {
    async login({commit, dispatch}, credentials){
        const response = await AuthRepository.login(credentials)
        if(response.data.status){
            commit(types.LOGIN, response.data.data);
            dispatch('navbar/getNavBar', {}, {root:true});
        }
        return response
    },
    async logout({commit}){
        const response = await AuthRepository.logout()
        if(response.data.status){
            commit(types.LOGOUT);
        }
        return response
    },
    async getUser ({commit}) {
        const response = await UserRepository.getUser()
        if(response.data.status){
            commit(types.LOGIN, response.data.data);
        }else{
            commit(types.LOGOUT);
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