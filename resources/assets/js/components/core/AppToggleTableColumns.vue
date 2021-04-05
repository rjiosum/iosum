<template>
        <v-select v-model="selectedHeaders"
                  :items="headers"
                  label="Show/Hide Columns"
                  multiple
                  outlined
                  return-object
                  dense
                  hide-details
        >
            <template v-slot:selection="{ item, index }">
                <v-chip v-if="index < 2" small>
                    <span>{{ item.text }}</span>
                </v-chip>
                <span v-if="index === 2" class="grey--text caption">(+{{ selectedHeaders.length - 2 }} others)</span>
            </template>
        </v-select>
</template>

<script>
    export default {
        name: "AppToggleTableColumns",

        props: {
            store: {
                type: String,
                required: true
            },
            headers: {
                type: Array,
                required: true
            },
            selectedHeadersGetter: {
                type: String,
                default: 'selectedHeaders'
            },
            selectedHeadersAction: {
                type: String,
                default: 'setSelectedHeaders'
            },
        },

        computed: {
            selectedHeaders: {
                get() {
                    const selected = JSON.parse(window.localStorage.getItem('vuex')).adminNav.selectedHeaders
                    return (selected.length !== 0) ? selected : this.headers
                },
                set(value) {
                    this.$store.dispatch(this.store + '/' + this.selectedHeadersAction, value)
                }
            }
        }

    }
</script>

<style scoped>

</style>