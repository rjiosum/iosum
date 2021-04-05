import * as types from './mutation-types';
import { Factory } from '@/repositories/factory'

const NavRepository = Factory.get('nav');

const state = () => ({
    collection: [],
    total: 0,
    filters:{
        page: 1,
        per_page: 0,
        sort_by: null,
        sort_direction: null,
        term: null,
        column: null
    },
    selectedHeaders: [],
    loading: true
})

const getters = {
    collection(state) {
        return state.collection
    },

    filters(state) {
        return state.filters
    },

    total(state) {
        return state.total
    },

    selectedHeaders(state) {
        return state.selectedHeaders
    },

    loading(state) {
        return state.loading
    }
}

const mutations = {
    [types.SET_COLLECTION](state, payload) {
        state.collection = payload
    },

    [types.SET_FILTERS](state, payload) {
        state.filters = { ...state.filters, ...payload }
    },

    [types.SET_TOTAL](state, payload) {
        state.total = payload
    },

    [types.SET_LOADING](state, payload) {
        state.loading = payload
    },

    [types.SET_SELECTED_HEADERS](state, payload) {
        state.selectedHeaders = payload
    },

}

const actions = {
    async setCollection({commit, state}, payload) {
        commit(types.SET_LOADING, true)

        const response = await NavRepository.index(payload.parentId, payload.params)

        if (response.status === 200) {

            const data = response.data.data.map(item => {
                const collection = {};
                collection.id = item.id
                collection.children_count = item.attributes.children_count
                collection.created_at = item.attributes.created_at
                collection.created_h = item.attributes.created_h
                collection.icon = item.attributes.icon
                collection.parent = item.attributes.parent
                collection.position = item.attributes.position
                collection.route_name = item.attributes.route_name
                collection.route_path = item.attributes.route_path
                collection.title = item.attributes.title
                collection.updated_at = item.attributes.updated_at
                collection.uuid = item.attributes.uuid
                return collection;
            })

            commit(types.SET_COLLECTION, data)

            const obj = {
                page: parseInt(response.data.meta.current_page),
                per_page: parseInt(response.data.meta.per_page),
                sort_by: response.data.meta.options.sort_by,
                sort_direction: response.data.meta.options.sort_direction,
                term: response.data.meta.options.term,
                column: response.data.meta.options.column
            }

            commit(types.SET_FILTERS, obj)
            commit(types.SET_TOTAL, parseInt(response.data.meta.last_page))
            commit(types.SET_LOADING, false)
        }
        return response
    },

    setFilters({commit}, obj) {
        commit(types.SET_FILTERS, obj)
    },

    setSelectedHeaders({commit}, payload) {
        commit(types.SET_SELECTED_HEADERS, payload)
    },
}

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}