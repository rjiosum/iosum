<template>
    <AppLayout>
        <AppCard color="black" class="px-5 py-3 mx-auto" max-width="98%" padding="pa-3">
            <template v-slot:heading>
                <AppCardToolBarHeading :heading="heading" :goBack="goBack"/>
            </template>

            <AppBreadcrumbs :breadcrumbs="breadcrumbs"/>

            <v-card-text class="px-0">
                <AdminNavForm :edit="true" :form="form" />
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
    import { Factory } from '@/repositories/factory';

    const NavRepository = Factory.get('nav');

    export default {
        name: "EditAdminNav",
        props: {
            id: String
        },

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
                    title: 'Update Admin Navigation',
                },

                goBack: true,

                breadcrumbs: [
                    {'text': 'Dashboard', disabled: false, to: {name: 'dashboard'}, exact: true},
                    {'text': 'Admin Nav', disabled: false, to: {name: 'admin.nav'}, exact: true}
                ],
                form: {}
            }
        },

        async created(){
            try {
                const response = await NavRepository.show(this.id)
                if (response.status === 200) {
                    const item = response.data.data
                    this.form =
                        {
                            uuid: item.attributes.uuid,
                            parent_id: item.attributes.parent_id,
                            title: item.attributes.title,
                            icon: item.attributes.icon,
                            route_name: item.attributes.route_name,
                            route_path: item.attributes.route_path,
                        }
                    this.breadcrumbs.push({
                        'text': `Update Admin Nav - ${this.form.title}`,
                        disabled: true,
                        to: {name: 'admin.nav.edit', params:{id: this.id}},
                        exact: true})
                }
            }catch(e){

            }
        }
    }
</script>
