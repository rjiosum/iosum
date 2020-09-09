import {lazy} from '../utils/utility';
import guest from '@/middleware/guest';
import auth from '@/middleware/auth';
import isLoggedIn from '@/middleware/isLoggedIn';

export default [
    {
        path: '/backoffice/login',
        name: 'login',
        component: lazy('auth/Login'),
        meta: {
            middleware: [guest],
            title: 'Login'
        }
    },
    {
        path: '/backoffice/logout',
        name: 'logout',
        component: lazy('auth/Logout'),
        meta: {
            middleware: [isLoggedIn, auth]
        }
    }
]