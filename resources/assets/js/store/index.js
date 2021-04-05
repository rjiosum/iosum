import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from "vuex-persistedstate"

import drawer from './modules/core/drawer'
import errors from './modules/errors/server-errors'
import notify from "./modules/notify/notify"
import auth from "./modules/auth/auth"
import navbar from "./modules/navbar/navbar"
import adminNav from "./modules/admin-nav/admin-nav"

Vue.use(Vuex)

const dataState = createPersistedState({
    paths: ['drawer', 'adminNav.selectedHeaders']
})

export default new Vuex.Store({
    modules:{
        drawer,
        errors,
        notify,
        auth,
        navbar,
        adminNav
    },
    plugins: [dataState],
})


