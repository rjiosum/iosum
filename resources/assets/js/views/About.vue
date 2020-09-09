<template>
    <v-container
            class="fill-height"

    >
    <v-row>
        <v-col sm12>
            <h1>About</h1>

            <v-container fluid class="fill-height">
                <v-layout row wrap :justify-center="true">
                    <v-flex xs12 sm12 md5 lg4 xl4>

                        <v-list-item two-line class="mt-10 text-center">
                            <v-list-item-content>
                                <v-list-item-title class="font-weight-bold headline">Hello</v-list-item-title>
                                <v-list-item-subtitle class="subtitle-1">
                                    Great to see you back. Now login and get started.
                                </v-list-item-subtitle>
                            </v-list-item-content>
                        </v-list-item>



                    </v-flex>
                </v-layout>
            </v-container>
        </v-col>
    </v-row>
    </v-container>

</template>

<script>
    import {mapGetters, mapActions} from 'vuex'
    export default {
        name: 'About',
        data() {
            return {}
        },
        computed:{
            ...mapGetters({
                user: 'auth/user',
                isAuthenticated: 'auth/isAuthenticated'
            })
        },
    mounted() {
        this.$store.dispatch('notify/setNotice', {
            msg: "Successfully logged in.",
            color: "success",
            icon: "mdi-check-circle"
        });
    }
    }
</script>
