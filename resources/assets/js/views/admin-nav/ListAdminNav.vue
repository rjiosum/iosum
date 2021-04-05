<template>
    <AppLayout>
        <AppCard color="black" class="px-5 py-3 mx-auto" max-width="98%" padding="pa-3">
            <template v-slot:heading>
                <AppCardToolBarHeading :heading="heading" :routeName="routeName"/>
            </template>

            <AppBreadcrumbs :breadcrumbs="breadcrumbs"/>

            <v-card-actions class="px-0 py-0">
                <v-row>
                    <v-col cols="12" md="12">
                        <AppSearchPanel>
                            <AppSearch store="adminNav" :columns="columns" @next="next"/>
                        </AppSearchPanel>
                    </v-col>
                </v-row>
            </v-card-actions>

            <v-card-actions class="px-4 py-0 block-border">
                <v-row>
                    <v-col cols="12" md="7">
                        <AppPagination store="adminNav" @next="next"/>
                    </v-col>
                    <v-col cols="12" md="3">
                        <AppToggleTableColumns store="adminNav" :headers="headers"/>
                    </v-col>
                    <v-col cols="12" md="2">
                        <v-switch dense hide-details class="mt-1" v-model="singleExpand"
                                  label="Single expand"></v-switch>
                    </v-col>
                </v-row>
            </v-card-actions>

            <v-card-text class="px-0">
                <v-data-table
                        :headers="showHeaders"
                        :items="navs"
                        :loading="loading"
                        :server-items-length="total"
                        hide-default-footer
                        hide-default-header
                        :headers-length="headers.length + 1"
                        class="elevation-0"
                        :single-expand="singleExpand"
                        :expanded.sync="expanded"
                        show-expand

                >
                    <template v-slot:header="{ props }">
                        <AppTableHeader :filters="filters" :headers="props.headers" @next="next"/>
                    </template>

                    <template v-slot:item.title="{ item }">
                        <span>{{item.title}}</span>
                    </template>

                    <template v-slot:item.actions="{ item }">
                        <v-btn depressed small color="primary"
                               route :to="{name: 'admin.nav.edit', params:{id: item.uuid}}">
                            <v-icon small class="mr-2">mdi-pencil</v-icon>
                            Edit
                        </v-btn>
                        <v-btn v-if="(item.children_count > 0)" depressed small color="info"
                               :to="{name: 'admin.nav', params:{parentId: item.id}}"
                        >View ({{item.children_count}})
                        </v-btn>
                    </template>

                    <template v-slot:expanded-item="{headers, item}">
                        <td :colspan="headers.length">
                            <div class="mt-2 mb-2">
                                <div>UUID: {{item.uuid}}</div>
                                <div>Created At: {{item.created_at}}</div>
                                <div>Updated At: {{item.updated_at}}</div>
                            </div>
                        </td>
                    </template>

                </v-data-table>
            </v-card-text>

            <v-card-actions class="px-4 py-0 block-border">
                <v-row>
                    <v-col cols="12" md="12">
                        <AppPagination store="adminNav" @next="next"/>
                    </v-col>
                </v-row>
            </v-card-actions>
        </AppCard>
    </AppLayout>
</template>

<script>
    import { mapGetters } from "vuex";
    import AppLayout from '@/components/core/AppLayout'
    import AppCard from "@/components/core/AppCard";
    import AppPagination from "@/components/core/AppPagination";
    import AppTableHeader from "@/components/core/AppTableHeader";
    import AppSearchPanel from "@/components/core/AppSearchPanel";
    import AppSearch from "@/components/core/AppSearch";
    import AppToggleTableColumns from "@/components/core/AppToggleTableColumns";
    import AppCardToolBarHeading from "@/components/core/AppCardToolBarHeading";
    import AppBreadcrumbs from "@/components/core/AppBreadcrumbs";
    import handleNext from "@/mixins/handleNext";

    export default {
        name: "ListAdminNav",

        props: {
            parentId: {
                default: 0
            }
        },

        components: {
            AppLayout,
            AppCardToolBarHeading,
            AppCard,
            AppPagination,
            AppTableHeader,
            AppSearch,
            AppSearchPanel,
            AppToggleTableColumns,
            AppBreadcrumbs
        },

        mixins: [handleNext],

        data() {
            return {
                heading: {
                    icon: 'fa-tools',
                    title: 'Admin Navigation List'
                },
                routeName: 'admin.nav.create',

                expanded: [],
                singleExpand: false,

                headers: [
                    {text: 'Id #', align: 'start', value: 'id', width: '100px', sortable: true},
                    {text: 'Title', value: 'title'},
                    {text: 'Icon', value: 'icon'},
                    {text: 'Route Name', value: 'route_name'},
                    {text: 'Route Path', value: 'route_path'},
                    {text: 'Actions', value: 'actions', sortable: false}
                ],

                defaults: {
                    page: parseInt(this.$route.query.page) || 1,
                    per_page: parseInt(this.$route.query.per_page) || 3,
                    sort_by: this.$route.query.sort_by || 'id',
                    sort_direction: this.$route.query.sort_direction || 'desc',
                    term: this.$route.query.term || null,
                    column: this.$route.query.column || null
                },

                columns: [
                    {text: 'Id', value: 'id'},
                    {text: 'UUID', value: 'uuid'},
                    {text: 'Title', value: 'title'}
                ],

                breadcrumbs: [
                    {'text': 'Dashboard', disabled: false, to: {name: 'dashboard'}, exact: true},
                    {'text': 'Admin Nav', disabled: false, to: {name: 'admin.nav'}, exact: true},
                ]
            }
        },

        computed: {
            ...mapGetters({
                loading: 'adminNav/loading',
                navs: 'adminNav/collection',
                total: 'adminNav/total',
                filters: 'adminNav/filters',
                selectedHeaders: 'adminNav/selectedHeaders',
            }),

            showHeaders() {
                return this.headers.filter((h) => {
                        return this.selectedHeaders.some(f => f.value === h.value)
                    }
                );
            },
        },

        created() {
            this.fetch(this.defaults)
        },

        methods: {
            addToBreadcrumbs() {
                if (this.navs && this.navs[0] && this.navs[0].parent) {
                    let params = {
                        text: this.navs[0].parent.title,
                        disabled: true,
                        to: {name: 'admin.nav', params: {parentId: this.navs[0].parent.id}},
                        exact: true
                    }
                    this.breadcrumbs.push(params)
                }
            },

            fetch(params) {
                this.$store.dispatch('adminNav/setCollection', {
                        parentId: this.parentId,
                        params: params
                    }
                ).then((r) => {
                    this.addToBreadcrumbs()
                })
            }
        }
    }
</script>