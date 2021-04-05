<template>
    <v-breadcrumbs :items="breadcrumbs">

        <template v-slot:divider>
            <v-icon>mdi-chevron-right</v-icon>
        </template>

        <template v-slot:item="{ item }">
            <v-breadcrumbs-item
                    :disabled="item.disabled"
                    :to="item.to"
                    :exact="item.exact"
            >
                <!--<v-btn depressed dark color="black" x-small>{{ item.text.toUpperCase() }}</v-btn>-->
                {{ item.text.toUpperCase() }}
            </v-breadcrumbs-item>
        </template>

    </v-breadcrumbs>
</template>

<script>
    export default {
        name: "AppBreadcrumbs",
        props:{
            breadcrumbs: {
                type: Array,
                required: true
            }
        }
    }
</script>

<style scoped>

</style>