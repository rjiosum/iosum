import Vue from 'vue'
import Vuex from 'vuex'
import * as types from "../mutation-types"

Vue.use(Vuex)

export const state = {
    user: {
        "first_name": "John",
        "last_name": "Doe",
        "name": "John Doe",
        "email": "john@gmail.com",
        "avatar": "/storage/admin/avatars/avatar.png"
    }
}

export const getters = {
    user: jest.fn().mockReturnValue({
        "first_name": "John",
        "last_name": "Doe",
        "name": "John Doe",
        "email": "john@gmail.com",
        "avatar": "/storage/admin/avatars/avatar.png"
    }),
    isAuthenticated: jest.fn().mockReturnValue(true)
}

export const mutations = {
    [types.LOGIN]: jest.fn(),
    [types.LOGOUT]: jest.fn()
}

export const actions = {
    login: jest.fn(),
    logout: jest.fn(),
    getUser: jest.fn()
}



export function __createMocks(custom = { getters: {}, mutations: {}, actions: {}, state: {} }) {
    const mockGetters = Object.assign({}, getters, custom.getters);
    const mockMutations = Object.assign({}, mutations, custom.mutations);
    const mockActions = Object.assign({}, actions, custom.actions);
    const mockState = Object.assign({}, state, custom.state);

    return {
        getters: mockGetters,
        mutations: mockMutations,
        actions: mockActions,
        state: mockState,
        store: new Vuex.Store({
            modules: {
                auth: {
                    getters: mockGetters,
                    mutations: mockMutations,
                    actions: mockActions,
                    state: mockState,
                    namespaced: true
                }
            }
        }),
    };
}

//export const store = __createMocks().store;