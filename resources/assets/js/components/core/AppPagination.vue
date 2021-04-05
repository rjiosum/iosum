<template>
        <v-row align="center" no-gutters>
            <v-col
                    cols="12"
                    sm="2"
            >
                <v-select
                        v-model="itemsPerPage"
                        :items="items"
                        @change="handlePageSizeChange"
                        outlined
                        flat
                        dense
                        hide-details
                        style="width:85px"
                ></v-select>
            </v-col>
            <v-col
                    class="d-flex"
                    cols="12"
                    sm="10"
            >
                <v-pagination
                        v-model="currentPage"
                        :length="total"
                        :total-visible="6"
                        @input="handlePageChange"
                        circle
                        color="black"
                ></v-pagination>
            </v-col>
        </v-row>
</template>

<script>

    export default {
        name: "ListAdminNavPagination",

        props: {
            store: {
                type: String,
                required: true
            },
            totalGetter: {
                type: String,
                default: 'total'
            },
            filtersGetter: {
                type: String,
                default: 'filters'
            },
            filtersAction: {
                type: String,
                default: 'setFilters'
            }
        },

        data() {
            return {
                items: [3, 5, 10, 20, 50, 100, 200],
                oldCurrentPage: -1
            }
        },

        computed: {

            total: {
                get() {
                    return this.$store.getters[this.store + '/' + this.totalGetter]
                }
            },

            currentPage: {
                get() {
                    return this.$store.getters[this.store + '/' + this.filtersGetter].page
                },
                set(value) {
                    this.oldCurrentPage = this.currentPage
                    this.$store.dispatch(this.store + '/' + this.filtersAction, {page: parseInt(value)})
                }
            },

            itemsPerPage: {
                get() {
                    return this.$store.getters[this.store + '/' + this.filtersGetter].per_page
                },
                set(value) {
                    this.$store.dispatch(this.store + '/' + this.filtersAction, {per_page: parseInt(value)})
                }
            },
        },

        methods: {
            handlePageSizeChange() {
                this.$store.dispatch(this.store + '/' + this.filtersAction, {page: 1})
                this.$emit('next')
            },

            handlePageChange() {
                if (this.oldCurrentPage === this.currentPage) {
                    return
                }
                this.$emit('next')
            }
        },
    }
</script>
