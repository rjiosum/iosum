import { lazy, prefix } from '../utils/utility'
import auth from '@/middleware/auth';
import isLoggedIn from '@/middleware/isLoggedIn';


export default [
    {
        path: prefix('admin-nav/edit/:id'),
        name: 'admin.nav.edit',
        component: lazy('admin-nav/EditAdminNav'),
        props: true,
        meta: {
            middleware: [isLoggedIn, auth],
            title: 'Edit Admin Navigation'
        }
    },
    {
        path: prefix('admin-nav/create'),
        name: 'admin.nav.create',
        component: lazy('admin-nav/CreateAdminNav'),
        meta:{
            middleware: [isLoggedIn, auth],
            title: 'Create Admin Navigation'
        }
    },
    {
        path: prefix('admin-nav/:parentId?'),
        name: 'admin.nav',
        component: lazy('admin-nav/ListAdminNav'),
        props: true,
        meta: {
            middleware: [isLoggedIn, auth],
            title: 'Admin Navigation'
        }
    },

]


