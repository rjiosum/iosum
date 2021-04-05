export default {
    methods:{
        next(params = {}) {
            const merged = {...this.filters, ...params}
            this.$router.push({query: merged})
        },
    }
}