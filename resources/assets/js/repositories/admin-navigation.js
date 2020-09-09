export default $axios => resource => ({

   index(page) {
        return $axios.get(`${resource}/index?page=${page}`);
    },

    create(payload) {
        return $axios.post(`${resource}`, payload)
    },

    update(id, payload) {
        return $axios.patch(`${resource}/${id}`, payload)
    },

    delete(id) {
        return $axios.delete(`${resource}/${id}`)
    }
})
