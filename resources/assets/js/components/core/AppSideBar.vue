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

            <v-list-item link router :to="{name: 'dashboard'}" active-class="accent">
                <v-list-item-icon>
                    <v-icon>fa-tachometer-alt</v-icon>
                </v-list-item-icon>
                <v-list-item-content>
                    <v-list-item-title>Dashboard</v-list-item-title>
                </v-list-item-content>
            </v-list-item>

            <v-list-group
                    v-for="item in mitems"
                    :key="item.title"
                    v-model="item.active"
                    :prepend-icon="item.action"
                    append-icon="mdi-menu-down"
                    no-action
                    color="grey lighten-5"
            >
                <template v-slot:activator>
                    <v-list-item-content>
                        <v-list-item-title v-text="item.title"></v-list-item-title>
                    </v-list-item-content>
                </template>

                <v-list-item
                        v-for="subItem in item.items"
                        :key="subItem.title"
                        router :to="{name:'about'}"
                        active-class="primary"
                >
                    <v-list-item-content>
                        <v-list-item-title v-text="subItem.title"></v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list-group>
        </v-list>
    </v-navigation-drawer>
</template>

<script>
    import {mapGetters} from 'vuex'
    export default {
        name: "AppSideBar",
        data() {
            return {
                mitems: [
                    {
                        action: 'mdi-view-dashboard',
                        title: 'Attractions',
                        items: [
                            { title: 'List Item 01' },
                            { title: 'List Item 02' },
                            { title: 'List Item 03' },
                            { title: 'List Item 04' },
                            { title: 'List Item 05' },
                        ],
                    },
                    {
                        action: 'mdi-view-dashboard',
                        title: 'Dining',
                        items: [
                            { title: 'Breakfast & brunch' },
                            { title: 'New American' },
                            { title: 'Sushi' },
                        ],
                    },
                    {
                        action: 'mdi-view-dashboard',
                        title: 'Education',
                        items: [
                            { title: 'List Item 01' },
                            { title: 'List Item 02' },
                            { title: 'List Item 03' },
                            { title: 'List Item 04' },
                            { title: 'List Item 05' },
                        ],
                    },
                    {
                        action: 'mdi-view-dashboard',
                        title: 'Family',
                        items: [
                            { title: 'List Item 01' },
                            { title: 'List Item 02' },
                            { title: 'List Item 03' },
                            { title: 'List Item 04' },
                            { title: 'List Item 05' },
                        ],
                    },
                    {
                        action: 'mdi-view-dashboard',
                        title: 'Health',
                        items: [
                            { title: 'List Item 01' },
                            { title: 'List Item 02' },
                            { title: 'List Item 03' },
                            { title: 'List Item 04' },
                            { title: 'List Item 05' },
                        ],
                    },
                    {
                        action: 'mdi-view-dashboard',
                        title: 'Office',
                        items: [
                            { title: 'List Item 01' },
                            { title: 'List Item 02' },
                            { title: 'List Item 03' },
                            { title: 'List Item 04' },
                            { title: 'List Item 05' },
                        ],
                    },
                    {
                        action: 'mdi-view-dashboard',
                        title: 'Promotions',
                        items: [
                            { title: 'List Item 01' },
                            { title: 'List Item 02' },
                            { title: 'List Item 03' },
                            { title: 'List Item 04' },
                            { title: 'List Item 05' },
                        ],
                    },
                ],
            }
        },
        computed: {
            ...mapGetters({
                drawer: 'drawer/drawer',
                expandOnHover: 'drawer/expandOnHover',
                user: 'auth/user'
            })
        }
    }
</script>

<style scoped>

</style>