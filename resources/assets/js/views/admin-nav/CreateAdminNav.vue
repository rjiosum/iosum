<template>
    <AppLayout>
        <AppCard color="black" class="px-5 py-3 mx-auto" max-width="98%" padding="pa-3">
            <template v-slot:heading>
                <AppCardToolBarHeading :heading="heading" :goBack="goBack"/>
            </template>

            <AppBreadcrumbs :breadcrumbs="breadcrumbs"/>

            <v-card-text class="px-0">
                <AdminNavForm/>
            </v-card-text>

        </AppCard>
    </AppLayout>
</template>

<script>

    import AppLayout from '@/components/core/AppLayout'
    import AppCard from "@/components/core/AppCard";
    import AppBreadcrumbs from "@/components/core/AppBreadcrumbs";
    import AppCardToolBarHeading from "@/components/core/AppCardToolBarHeading";
    import AdminNavForm from "./AdminNavForm";

    export default {
        name: "CreateAdminNav",

        components: {
            AppLayout,
            AppCard,
            AppBreadcrumbs,
            AppCardToolBarHeading,
            AdminNavForm
        },

        data() {
            return {
                heading: {
                    icon: 'fa-tools',
                    title: 'Create Admin Navigation',
                },
                goBack: true,

                breadcrumbs: [
                    {'text': 'Dashboard', disabled: false, to: {name: 'dashboard'}, exact: true},
                    {'text': 'Admin Nav', disabled: false, to: {name: 'admin.nav'}, exact: true},
                    {'text': 'Create Admin Nav', disabled: true, to: {name: 'admin.nav.create'}, exact: true},
                ],
            }
        },

    }
</script>
