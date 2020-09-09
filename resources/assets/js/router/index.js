import Vue from 'vue'
import VueRouter from 'vue-router'

import store from '@/store'
import {pipeline} from "./utils/utility"
import auth from './routes/auth'
import errors from "./routes/errors"
import user from "./routes/user"


Vue.use(VueRouter)

const routes = [
    ...auth,
    ...user,
    ...errors
];

const router = new VueRouter({
    routes,
    hashbang: false,
    mode: 'history'
});

router.beforeEach((to, from, next) => {
    if (to.meta.title) {
        document.title = to.meta.title
    }
    if (!to.meta.middleware) {
        return next()
    }
    const middleware = to.meta.middleware;
    const context = {to, from, next, store}

    return middleware[0]({
        ...context,
        next: pipeline(context, middleware, 1)
    })
})

export default router
