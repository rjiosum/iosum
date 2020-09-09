export default $axios => resource => ({

    login(payload) {
        return $axios.post(`${resource}/login`, payload);
    },

    logout() {
        return $axios.post(`${resource}/logout`);
    }
})
