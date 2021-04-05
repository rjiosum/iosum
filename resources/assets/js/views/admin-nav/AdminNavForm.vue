<template>
    <v-row no-gutters align="center" justify="center">
    <v-col
            cols="12"
            sm="8"
            md="6"
    >
        <h2 class="mt-1 mb-6 text-center">Please fill up the form below and hit the save button</h2>
        <v-form @submit.prevent="handleSubmit">
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
                    hint="Please enter vue route url (e.g /admin-nav, /settings etc)"
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
</template>

<script>
    import { validationMixin } from 'vuelidate';
    import { required, maxLength } from 'vuelidate/lib/validators';
    import { mapGetters } from "vuex";

    import { Factory } from '@/repositories/factory';

    const NavRepository = Factory.get('nav');

    export default {
        name: "AdminNavForm",
        mixins: [validationMixin],
        validations: {
            form: {
                title: {required, maxLength: maxLength(50)},
                icon: {required, maxLength: maxLength(30)},
                route_name: {required, maxLength: maxLength(250)},
                route_path: {required, maxLength: maxLength(250)},
            }
        },
        props: {
            form: {
                type: Object,
                default: () => {
                    return {
                        uuid: '',
                        parent_id: 0,
                        title: '',
                        icon: '',
                        route_name: '',
                        route_path: '',
                    }
                }
            },
            edit: {
                type: Boolean,
                default: false
            }
        },
        data() {
            return {
                parents: [],
                submitted: false,
                submit: {
                    status: false,
                    type: 'success',
                    message: ''
                },
                placeholder: false
            }
        },

        created() {
            this.fetch()
        },

        methods: {
            fetch() {
                this.$store.dispatch('adminNav/setCollection', {
                        parentId: 0,
                        params: {
                            per_page: 1000
                        }
                    }
                ).then((r) => {
                    this.parents = this.navs.map((item) => {
                        return {
                            id: item.id,
                            title: item.title
                        }
                    })
                })
            },
            async handleSubmit() {
                this.$v.$touch();
                if (this.$v.$invalid) {
                    return
                }
                try {
                    this.submitted = true;
                    let response;

                    if(this.edit){
                        response = await NavRepository.update(this.form.uuid, this.form);
                    } else {
                        response = await NavRepository.create(this.form);
                    }

                    const data = response.data

                    this.submit.message = data.message;
                    this.submit.status = true;

                    if (data.status) {
                        this.submit.type = "success";
                        await this.$store.dispatch('navbar/getNavBar')
                    } else {
                        this.submit.type = "error";
                    }
                    this.submitted = false;

                    if(!this.edit) {
                        Object.keys(this.form).forEach((key) => {
                            this.form[key] = '';
                        });
                        this.$v.$reset();
                    }

                } catch (e) {
                    this.submitted = false;
                }
            }
        },

        computed: {
            ...mapGetters({
                navs: 'adminNav/collection',
                errors: 'errors/errors',
            }),

            titleErrors() {
                const errors = [];
                if (!this.$v.form.title.$dirty) return errors;
                !this.$v.form.title.required && errors.push('Title is required');
                !this.$v.form.title.maxLength && errors.push('Title cannot be more than 50 characters');
                this.errors.title && errors.push(this.errors.title[0]);
                return errors;
            },
            iconErrors() {
                const errors = [];
                if (!this.$v.form.icon.$dirty) return errors;
                !this.$v.form.icon.required && errors.push('Icon is required');
                !this.$v.form.icon.maxLength && errors.push('Icon cannot be more than 30 characters');
                this.errors.icon && errors.push(this.errors.icon[0]);
                return errors;
            },
            routeNameErrors() {
                const errors = [];
                if (!this.$v.form.route_name.$dirty) return errors;
                !this.$v.form.route_name.required && errors.push('Route name is required');
                !this.$v.form.route_name.maxLength && errors.push('Route name cannot be more than 250 characters');
                this.errors.route_name && errors.push(this.errors.route_name[0]);
                return errors;
            },
            routePathErrors() {
                const errors = [];
                if (!this.$v.form.route_path.$dirty) return errors;
                !this.$v.form.route_path.required && errors.push('Route url is required');
                !this.$v.form.route_path.maxLength && errors.push('Route url cannot be more than 250 characters');
                this.errors.route_path && errors.push(this.errors.route_path[0]);
                return errors;
            }
        }
    }
</script>
