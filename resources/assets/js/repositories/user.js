export default $axios => resource => ({

    getUser() {
        return $axios.get(`${resource}/profile`);
    },

})
