<template>
    <v-navigation-drawer
            app
            :value="drawer"
            :expand-on-hover="expandOnHover"
            dark
    >
        <v-list
                dense
                nav
                class="py-0"
        >
            <v-list-item two-line class="px-0">
                <v-list-item-avatar>
                    <v-img :src="user.avatar"></v-img>
                </v-list-item-avatar>

                <v-list-item-content>
                    <v-list-item-title>{{user.first_name}}</v-list-item-title>
                    <v-list-item-subtitle>{{user.email}}</v-list-item-subtitle>
                </v-list-item-content>
            </v-list-item>

            <v-divider></v-divider>

            <v-list-item link router :to="{name: 'dashboard'}" active-class="accent" class="pl-1">
                <v-list-item-avatar size="32">
                    <v-icon size="22">fa-tachometer-alt</v-icon>
                </v-list-item-avatar>
                <v-list-item-content>
                    <v-list-item-title>Dashboard</v-list-item-title>
                </v-list-item-content>
            </v-list-item>
            <v-list-group
                    v-for="item in navs"
                    :key="item.id"
                    v-model="item.active"
                    append-icon="mdi-menu-down"
                    no-action
                    color="grey lighten-5"
            >
                <template v-slot:activator>
                    <v-list-item-avatar size="32">
                        <v-icon size="22" v-text="item.attributes.icon"></v-icon>
                    </v-list-item-avatar>
                    <v-list-item-content>
                        <v-list-item-title v-text="item.attributes.title"></v-list-item-title>
                    </v-list-item-content>
                </template>

                <v-list-item
                        v-for="subItem in item.attributes.children.data"
                        :key="subItem.id"
                        router :to="{ name: subItem.attributes.route_name }"
                        :active-class="subItem.attributes.route_name === currentRouteName ? 'primary' : ''"
                        class="pl-2"
                        dense
                >
                    <v-list-item-avatar size="32" color="cyan darken-1">
                        <v-icon small v-text="subItem.attributes.icon"></v-icon>
                    </v-list-item-avatar>
                    <v-list-item-content>
                        <v-list-item-title v-text="subItem.attributes.title"></v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                <v-divider></v-divider>
            </v-list-group>
        </v-list>
    </v-navigation-drawer>
</template>

<script>
    import {mapGetters} from 'vuex'
    export default {
        name: "AppSideBar",
        computed: {
            ...mapGetters({
                drawer: 'drawer/drawer',
                expandOnHover: 'drawer/expandOnHover',
                user: 'auth/user',

            }),
            navs:{
                get(){
                    return this.$store.getters['navbar/navbar']
                }
            },
            currentRouteName() {
                return this.$route.name;
            }
        },
        /*methods: {
            currentRouteName() {
                console.log(this.navs)
                const entries = Object.entries(this.navs)
                console.log(entries)

            }
        }*/
    }
</script>

<style scoped>

</style>
