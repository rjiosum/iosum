<template>
    <v-hover v-slot:default="{ hover }">
        <v-list-item link router :to="{name: }"
                     :class="hover ? 'secondary elevation-12': ''">
            <v-list-item-title
                    :class="hover ? 'white--text': ''">Profile</v-list-item-title>
        </v-list-item>
    </v-hover>
</template>

<script>
    export default {
        name: "AppHover",
        props:{
            routeName:{
                type: String,
                default: ''
            },
            title: {
                type: String,
                default: ''
            }
        }
    }
</script>

<style scoped>

</style>