import {lazy, prefix} from '../utils/utility';
import guest from '@/middleware/guest';
import auth from '@/middleware/auth';
import isLoggedIn from '@/middleware/isLoggedIn';

export default [
    {
        path: prefix('login'),
        name: 'login',
        component: lazy('auth/Login'),
        meta: {
            middleware: [isLoggedIn, guest],
            title: 'Login'
        }
    },
    {
        path: prefix('logout'),
        name: 'logout',
        component: lazy('auth/Logout'),
        meta: {
            middleware: [isLoggedIn, auth]
        }
    }
]
