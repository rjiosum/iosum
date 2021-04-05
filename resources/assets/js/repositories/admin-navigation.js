export default $axios => resource => ({

   index(parentId, request) {
        return $axios.get(`${resource}/${parentId}`, {params: request});
    },

    create(payload) {
        return $axios.post(`${resource}/store`, payload)
    },

    show(id) {
        return $axios.get(`${resource}/show/${id}`)
    },

    update(id, payload) {
        return $axios.patch(`${resource}/edit/${id}`, payload)
    },

    delete(id) {
        return $axios.delete(`${resource}/destroy/${id}`)
    },

    tree(){
        return $axios.get(`${resource}/tree`);
    }

})
