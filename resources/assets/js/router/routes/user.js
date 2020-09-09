import {lazy} from '../utils/utility';
import auth from '@/middleware/auth';
import isLoggedIn from '@/middleware/isLoggedIn';

export default [
    {
        path: '/backoffice/dashboard',
        alias: '/backoffice',
        name: 'dashboard',
        component: lazy('Dashboard'),
        meta: {
            middleware: [isLoggedIn, auth],
            title: 'Dashboard'
        }
    },
    {
        path: '/backoffice/about',
        name: 'about',
        component: lazy('About'),
        meta: {
            middleware: [isLoggedIn, auth],
            title: 'About'
        }
    }
]