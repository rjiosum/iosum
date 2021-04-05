<template>
    <v-container
            class="fill-height"
            fluid
    >
        <v-layout row wrap justify-center="true">
            <v-flex xs12 class="mt-10">
                <slot></slot>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    export default {
        name: "AppLayout"
    }
</script>