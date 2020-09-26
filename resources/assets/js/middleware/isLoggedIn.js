export default async function isLoggedIn({next, store}) {
    if (!store.getters['auth/isAuthenticated']) {
        try {
            await store.dispatch('auth/getUser');
            await store.dispatch('navbar/getNavBar');
        } catch (e) {}
    }
    return next();
}