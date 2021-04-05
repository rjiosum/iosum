<template>
    <AppLayout>
        <AppCard color="black" class="px-5 py-3 mx-auto" max-width="98%" padding="pa-3">
            <template v-slot:heading>
                <AppCardToolBarHeading :heading="heading" />
            </template>

            <AppBreadcrumbs :breadcrumbs="breadcrumbs"/>
            <v-row no-gutters align="center" justify="center">
                <v-col
                        cols="12"
                        sm="8"
                        md="6"
                >
                    <h2 class="mt-1 mb-6 text-center">Please fill up the form below and hit the save button</h2>
                    <v-form @submit.prevent="handleSubmit">

                        <v-simple-table>
                            <template v-slot:default>
                                <thead>
                                <tr>
                                    <th class="text-left">
                                        Name
                                    </th>
                                    <th class="text-left">
                                        Type
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <v-text-field
                                                outlined
                                                dense
                                                clearable
                                                v-model.trim="form.title"
                                                type="text"
                                                name="title"
                                        ></v-text-field>
                                    </td>
                                    <td>

                                    </td>
                                </tr>
                                </tbody>
                            </template>
                        </v-simple-table>

                        <v-select
                                v-model="form.parent_id"
                                :items="parents"
                                :placeholder="!placeholder ? ' ' : ''"
                                persistent-hint
                                hint="Please select parent category. Leave it empty if you are creating a new parent category."
                                item-text="title"
                                item-value="id"
                                label="Select a parent nav/category"
                                outlined
                                clearable
                                class="mb-5"
                        ></v-select>

                        <v-text-field
                                outlined
                                clearable
                                counter="50"
                                :placeholder="!placeholder ? ' ' : ''"
                                persistent-hint
                                hint="Please enter navigation title (e.g Products, Taxonomy etc)"
                                label="Title"
                                v-model.trim="form.title"
                                type="text"
                                name="title"
                                append-icon="fa-code-branch"
                                :error-messages="titleErrors"
                                @input="$v.form.title.$touch()"
                                @blur="$v.form.title.$touch()"
                                class="mb-5"
                        >
                        </v-text-field>

                        <v-text-field
                                outlined
                                clearable
                                counter="30"
                                :placeholder="!placeholder ? ' ' : ''"
                                persistent-hint
                                hint="Please enter font awesome icon class (e.g fa-tools, fa-users etc)"
                                label="Icon"
                                v-model.trim="form.icon"
                                type="text"
                                name="icon"
                                append-icon="fa-code-branch"
                                :error-messages="iconErrors"
                                @input="$v.form.icon.$touch()"
                                @blur="$v.form.icon.$touch()"
                                class="mb-5"
                        ></v-text-field>

                        <v-text-field
                                outlined
                                clearable
                                counter="250"
                                :placeholder="!placeholder ? ' ' : ''"
                                persistent-hint
                                hint="Please enter vue route name (e.g admin.nav, admin.settings etc)"
                                label="Route Name"
                                v-model.trim="form.route_name"
                                type="text"
                                name="route_name"
                                append-icon="fa-code-branch"
                                :error-messages="routeNameErrors"
                                @input="$v.form.route_name.$touch()"
                                @blur="$v.form.route_name.$touch()"
                                class="mb-5"
                        ></v-text-field>

                        <v-text-field
                                outlined
                                clearable
                                :placeholder="!placeholder ? ' ' : ''"
                                counter="250"
                                persistent-hint
                                hint="Please enter vue route url (e.g /backoffice/admin-nav, /backoffice/settings etc)"
                                label="Route Url"
                                v-model.trim="form.route_path"
                                type="text"
                                name="route_path"
                                append-icon="fa-code-branch"
                                :error-messages="routePathErrors"
                                @input="$v.form.route_path.$touch()"
                                @blur="$v.form.route_path.$touch()"
                                class="mb-5"
                        ></v-text-field>

                        <v-alert tile dismissible outlined border="left" v-model="submit.status"
                                 :type="submit.type">
                            {{submit.message}}
                        </v-alert>

                        <div class="text-center">
                            <v-btn depressed color="primary" class="mt-3" type="submit" width="50%"
                                   :loading="submitted"
                                   :disabled="submitted">Save
                            </v-btn>
                        </div>
                    </v-form>
                </v-col>
            </v-row>

        </AppCard>
    </AppLayout>
</template>
<script>
    import AppLayout from "@/components/core/AppLayout";
    import AppCard from "@/components/core/AppCard";
    import AppCardToolBarHeading from "@/components/core/AppCardToolBarHeading";
    import AppBreadcrumbs from "@/components/core/AppBreadcrumbs";
    import { validationMixin } from 'vuelidate';
    import { required, maxLength } from 'vuelidate/lib/validators';

    export default {
        name: "CrudGenerator",
        mixins: [validationMixin],
        validations: {
            form: {
                title: {required, maxLength: maxLength(50)},
                icon: {required, maxLength: maxLength(30)},
                route_name: {required, maxLength: maxLength(250)},
                route_path: {required, maxLength: maxLength(250)},
            }
        },
        components:{
            AppLayout,
            AppBreadcrumbs,
            AppCardToolBarHeading,
            AppCard
        },

        data(){
            return {
                heading: {
                    icon: 'fa-tools',
                    title: 'CRUD Generator'
                },
                breadcrumbs: [
                    {'text': 'Dashboard', disabled: false, to: {name: 'dashboard'}, exact: true},
                    {'text': 'Crud Generator', disabled: true, to: {name: 'admin.crud.gen'}, exact: true}
                ],
                submitted: false,
                submit: {
                    status: false,
                    type: 'success',
                    message: ''
                },
                placeholder: false,
                form: {
                            uuid: '',
                            parent_id: 0,
                            title: '',
                            icon: '',
                            route_name: '',
                            route_path: '',
                }
            }
        },
        methods: {
            handleSubmit(){

            }
        }
    }
</script>

<style scoped>

</style>