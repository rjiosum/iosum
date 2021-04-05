import {lazy, prefix} from '../utils/utility';
import auth from '@/middleware/auth';
import isLoggedIn from '@/middleware/isLoggedIn';

export default [
    {
        path: prefix('dashboard'),
        alias: prefix(''),
        name: 'dashboard',
        component: lazy('Dashboard'),
        meta: {
            middleware: [isLoggedIn, auth],
            title: 'Dashboard'
        }
    },
    {
        path: prefix('about'),
        name: 'about',
        component: lazy('About'),
        meta: {
            middleware: [isLoggedIn, auth],
            title: 'About'
        }
    }
]
