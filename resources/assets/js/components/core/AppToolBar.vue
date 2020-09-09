<template>
    <v-app-bar app flat color="#363636" dark>
        <v-btn icon @click.stop="setExpandOnHover(!expandOnHover)">
            <v-icon>mdi-chevron-left</v-icon>
        </v-btn>
        <v-app-bar-nav-icon @click.stop="setDrawer(!drawer)"></v-app-bar-nav-icon>
        <v-toolbar-title class="ml-3">Application</v-toolbar-title>

        <v-spacer></v-spacer>

        <v-btn
                class="ml-2"
                min-width="0"
                icon
                router :to="{name: 'dashboard'}"
        >
            <v-icon>mdi-home</v-icon>
        </v-btn>

        <v-menu tile
                bottom
                left
                offset-y
                :close-on-content-click="false"
                origin="top right"
                transition="scale-transition"
        >
            <template v-slot:activator="{ attrs, on }">
                <v-btn
                        class="ml-2"
                        icon
                        v-bind="attrs"
                        v-on="on"
                >
                    <v-badge
                            color="red"
                            overlap
                            bordered
                    >
                        <template v-slot:badge>
                            <span>5</span>
                        </template>

                        <v-icon>mdi-bell</v-icon>
                    </v-badge>
                </v-btn>
            </template>


            <v-list dense nav>
                <v-list-item v-for="(n, i) in notifications" :key="`item-${i}`" link>
                    <v-list-item-icon>
                        <v-icon>mdi-bell</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>{{ n }}</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>

        </v-menu>

        <v-menu tile
                bottom
                left
                offset-y
                origin="top right"
                transition="scale-transition"
        >
            <template v-slot:activator="{ on, attrs }">
                <v-btn
                        icon
                        v-bind="attrs"
                        v-on="on"
                >
                    <v-icon>mdi-account</v-icon>
                </v-btn>
            </template>
            <v-list dense min-width="250">
                <div class="text-center mb-4">
                    <v-list-item-avatar size="80">
                        <v-img :src="user.avatar"></v-img>
                    </v-list-item-avatar>
                    <v-list-item-subtitle><i>{{user.name}}</i></v-list-item-subtitle>
                </div>
                <v-divider></v-divider>
                <v-hover
                        v-slot:default="{ hover }"
                >
                <v-list-item link
                             :class="hover ? 'secondary elevation-12': ''">
                    <v-list-item-title
                            :class="hover ? 'white--text': ''">Profile</v-list-item-title>
                </v-list-item>
                </v-hover>
                <v-list-item link>
                    <v-list-item-title>Settings</v-list-item-title>
                </v-list-item>
                <v-divider></v-divider>
                <v-list-item link route :to="{name: 'logout'}">
                    <v-list-item-title>Logout</v-list-item-title>
                </v-list-item>
            </v-list>
        </v-menu>

        <v-switch
                v-model="$vuetify.theme.dark"
                hide-details
                color="#FFFFFF"
                flat
                dense
        ></v-switch>

    </v-app-bar>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex';

    export default {
        name: "AppToolBar",
        data(vm) {
            return {
                notifications: [
                    'Mike John Responded to your email',
                    'You have 5 new tasks',
                    'You\'re now friends with Andrew',
                    'Another Notification',
                    'Another one',
                ],
                initialDark: vm.$vuetify
                    ? vm.$vuetify.theme.dark
                    : false,
            }
        },
        computed: {
            ...mapGetters({
                drawer: 'drawer/drawer',
                expandOnHover: 'drawer/expandOnHover',
                user: 'auth/user'
            })

        },
        methods: {
            ...mapActions({
                setDrawer: 'drawer/setDrawer',
                setExpandOnHover: 'drawer/setExpandOnHover',
            }),
        },
        created() {
            EventBus.$on('kick', () => {
                this.$store.dispatch('auth/logout')
                    .then((response) => {
                        this.$store.dispatch('notify/setNotice', {
                            msg:"You are successfully logged out!!",
                            color: "info",
                            icon: "mdi-check-circle"
                        });
                        this.$router.back();
                    })
                    .catch((error) => {
                        window.location = '/login';
                    });
            });
        }
    }
</script>