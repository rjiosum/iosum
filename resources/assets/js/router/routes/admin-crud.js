import { lazy, prefix } from '../utils/utility'
import auth from '@/middleware/auth'
import isLoggedIn from '@/middleware/isLoggedIn'


export default [
    {
        path: prefix('crud-generator'),
        name: 'admin.crud.gen',
        component: lazy('admin-crud/CrudGenerator'),
        meta: {
            middleware: [isLoggedIn, auth],
            title: 'Crud Generator'
        }
    }
]
