require ('./bootstrap');
import Auth from "./authorize";
import Common from "./common";
import User from "./user";
import AdminNavigation from "./admin-navigation";

const auth = Auth(window.axios)('/admin/auth');
const user = User(window.axios)('/admin/user');
const nav = AdminNavigation(window.axios)('/admin/navigation');

const CommonRepository = Common(window.axios);


const repositories = {
    auth,
    user,
    nav
};

export const Factory = {
    get: name => repositories[name]
};