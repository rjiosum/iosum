<template>
    <v-app>
        <AppNotify />
        <AppSideBar v-if="isAuthenticated" />
        <AppToolBar v-if="isAuthenticated" />
        <v-main>
            <router-view :key="$route.fullPath"></router-view>
        </v-main>
        <AppToTop />
    </v-app>
</template>

<script>
    import AppNotify from "./components/core/AppNotify";
    import AppSideBar from "./components/core/AppSideBar";
    import AppToolBar from "./components/core/AppToolBar";
    import AppToTop from "./components/core/AppToTop";
    import {mapGetters} from 'vuex'

    export default {
        name: "App",
        components: {
            AppNotify,
            AppSideBar,
            AppToolBar,
            AppToTop
        },
        computed:{
            ...mapGetters({
                isAuthenticated: 'auth/isAuthenticated'
            })
        }
    }
</script>