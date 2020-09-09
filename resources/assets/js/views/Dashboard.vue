<template>
    <v-container class="fill-height">
    <v-row>
        <v-col cols="12" lg="4">
            {{user}}
            {{isAuthenticated}}
        </v-col>
    </v-row>
    </v-container>

</template>

<script>
    import {mapGetters, mapActions} from 'vuex'
    export default {
        name: 'Dashboard',
        data() {
            return {}
        },
        computed:{
            ...mapGetters({
                user: 'auth/user',
                isAuthenticated: 'auth/isAuthenticated'
            })
        },
        methods:{
            ...mapActions({
                getUser: 'auth/getUser'
            })
        }
    }
</script>
