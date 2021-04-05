<template>
    <div>
        <v-row>
            <v-col
                    cols="12"
                    md="9"
            >
                <v-text-field
                        v-model="searchTerm"
                        label="Search"
                        placeholder="Type your query...."
                        outlined
                        dense
                        hide-details
                        clearable
                ></v-text-field>

            </v-col>

            <v-col cols="12" md="3">
                <v-select
                        v-model="searchColumn"
                        :items="columns"
                        item-text="text"
                        item-value="value"
                        label="Select column"
                        placeholder=""
                        hide-details
                        outlined
                        flat
                        dense
                        clearable
                ></v-select>
            </v-col>
        </v-row>
        <slot/>
        <v-row no-gutters>
            <v-col cols="12" md="12">
                <v-btn depressed color="secondary" @click="handleSearch">Search</v-btn>
                <v-btn depressed color="error" @click="handleReset">Reset</v-btn>
            </v-col>
        </v-row>
    </div>
</template>

<script>
    export default {
        name: "AppSearch",
        props: {
            store: {
                type: String,
                required: true
            },
            columns:{
                type: Array,
                required: true,
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

        computed: {
            searchTerm: {
                get() {
                    return this.$store.getters[this.store + '/' + this.filtersGetter].term
                },
                set(value) {
                    this.$store.dispatch(this.store + '/' + this.filtersAction, {term: value})
                }
            },

            searchColumn: {
                get() {
                    return this.$store.getters[this.store + '/' + this.filtersGetter].column
                },
                set(value) {
                    this.$store.dispatch(this.store + '/' + this.filtersAction, {column: value})
                }
            },
        },
        methods: {
            handleSearch() {
                this.$store.dispatch(this.store + '/' + this.filtersAction, {page: 1})
                this.$emit('next')
            },

            handleReset() {
                this.$store.dispatch(this.store + '/' + this.filtersAction, {page: 1, term: '', column: ''})
                this.$emit('next')
            },
        }
    }
</script>

<style scoped>

</style>