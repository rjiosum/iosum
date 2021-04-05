<template>
    <thead class="v-data-table-header">
    <tr>
        <th v-for="head in headers"
            :width="(head.hasOwnProperty('width')) ? head.width : ''"
            @click="isSortable(head) ? changeSort(head.value) : ''"
            :class="[
                (filters.sort_by === head.value) ? 'active '+ filters.sort_direction : '',
                isSortable(head) ? 'sortable' : ''
            ]"
        ><span>{{ head.text.toUpperCase() }}</span>
            <span>
                <v-icon small
                        v-if="(filters.sort_by === head.value && filters.sort_direction === 'desc')"
                >mdi-arrow-up</v-icon>
                <v-icon small
                        v-if="(filters.sort_by === head.value && filters.sort_direction === 'asc')"
                >mdi-arrow-down</v-icon>
            </span>
        </th>
    </tr>
    </thead>
</template>

<script>
    export default {
        name: "AppTableHeader",
        props: {
            headers: {
                type: Array,
                required: true
            },
            filters: {
                type: Object,
                required: true
            }
        },
        methods: {
            isSortable(head) {
                return (!head.hasOwnProperty('sortable') || head.sortable === true)
            },

            changeSort(column) {
                const sortDirection = (this.filters.sort_direction === 'asc' && this.filters.sort_by === column) ? 'desc' : 'asc'
                const params = {
                    sort_by: column,
                    sort_direction: sortDirection
                }
                this.$emit('next', params)
            }
        }
    }
</script>
<style scoped>
    .theme--light.v-data-table .v-data-table-header th,
    .theme--light.v-data-table .v-data-table-header th.sortable.active,
    .theme--light.v-data-table .v-data-table-header th.sortable.active i,
    .theme--light.v-data-table .v-data-table-header th.sortable:hover{
        color: #fff;
        background-color: #363636 !important;
        border-color: #363636 !important;
    }
</style>