<template>
    <v-toolbar flat dense color="rgba(0,0,0,0.0)">
        <v-toolbar-title><v-icon small class="mr-2">{{heading.icon}}</v-icon>{{heading.title}}</v-toolbar-title>

        <v-spacer></v-spacer>

        <v-btn v-if="routeName" color="accent" depressed dark small route :to="{name: routeName}">New Item</v-btn>
        <v-btn v-if="goBack" color="accent" depressed dark small @click="back">Back</v-btn>
    </v-toolbar>
</template>

<script>
    export default {
        name: "AppCardToolBarHeading",
        props: {
            heading: {
                type: Object,
                default: function () {
                    return {
                        icon: 'fa-tools',
                        title: 'List'
                    }
                },
            },
            routeName: {
                type: String,
                default: ''
            },
            goBack: {
                type: Boolean,
                default: false
            },
        },
        methods:{
            back() {
                this.$router.back();
            }
        }
    }
</script>

<style scoped>

</style>