import {lazy, prefix} from '../utils/utility';
import isLoggedIn from '@/middleware/isLoggedIn';

export default [
    {
        path: prefix('404'),
        name: 'not.found',
        component: lazy('errors/NotFound'),
        meta: {
            middleware: [isLoggedIn],
            title: 'Error 404'
        }
    },
    {
        path: prefix('*'),
        component: lazy('errors/NotFound'),
        meta: {
            middleware: [isLoggedIn],
            title: 'Error 404'
        }
    }
]
