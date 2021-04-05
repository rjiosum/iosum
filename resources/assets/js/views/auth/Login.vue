<template>
    <v-container
            class="fill-height"
            fluid
    >
        <v-row no-gutters align="center" justify="center">
            <v-col
                    cols="12"
                    sm="8"
                    md="4"
            >
                <v-form @submit.prevent="login">
                    <AppCard class="px-5 py-3 mx-auto" max-width="374">
                        <template v-slot:heading>
                            <div class="display-1 font-weight-bold text-center">
                                Login
                            </div>
                            <div class="subtitle-1 font-weight-light text-center">
                                Please enter your credentials
                            </div>
                        </template>

                        <v-card-text>
                            <v-text-field
                                    color="purple"
                                    label="E-mail"
                                    placeholder="Enter your e-mail"
                                    v-model.trim="form.email"
                                    type="email"
                                    name="email"
                                    prepend-icon="mdi-email-outline"
                                    :error-messages="emailErrors"
                                    @input="$v.form.email.$touch()"
                                    @blur="$v.form.email.$touch()"
                                    class="pt-lg-10 pt-md-10 pt-sm-5"
                            ></v-text-field>
                            <v-text-field
                                    color="purple"
                                    label="Password"
                                    placeholder="Enter your password"
                                    v-model.trim="form.password"
                                    :type="showPassword ? 'text' : 'password'"
                                    name="password"
                                    prepend-icon="mdi-lock-open"
                                    :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                                    @click:append="showPassword = !showPassword"
                                    :error-messages="passwordErrors"
                                    @input="$v.form.password.$touch()"
                                    @blur="$v.form.password.$touch()"
                                    class="pt-lg-10 pt-md-10 pt-sm-5"
                            ></v-text-field>

                            <v-switch color="purple" class="pt-5" v-model="form.remember"
                                      :label="`Stay signed in`"></v-switch>

                        </v-card-text>

                        <template v-slot:actions>
                            <v-spacer></v-spacer>
                            <v-btn depressed
                                   color="accent"
                                   type="submit"
                                   width="50%"
                                   :loading="submitted"
                                   :disabled="submitted">Login
                            </v-btn>
                        </template>
                    </AppCard>
                </v-form>
            </v-col>
        </v-row>
    </v-container>


</template>

<script>
    import {validationMixin} from 'vuelidate'
    import {required, email} from 'vuelidate/lib/validators'
    import {mapGetters} from "vuex";
    import AppCard from "../../components/core/AppCard";

    export default {
        name: "AppLogin",
        mixins: [validationMixin],
        validations: {
            form: {
                email: {required, email},
                password: {required}
            }
        },
        components: {
            AppCard
        },
        data() {
            return {
                showPassword: false,
                form: {
                    email: null,
                    password: null,
                    remember: false
                },
                submitted: false
            }
        },
        methods: {
            async login() {
                this.$v.$touch();
                if (this.$v.$invalid) {
                    return;
                }
                this.submitted = true;
                try {
                    const response = await this.$store.dispatch('auth/login', this.form)

                    if (response.data.status) {
                        await this.$store.dispatch('notify/setNotice', {
                            msg: "Successfully logged in.",
                            color: "success",
                            icon: "mdi-check-circle"
                        });
                        if (this.$route.query.redirect) {
                            await this.$router.replace(this.$route.query.redirect);
                            return;
                        }
                        await this.$router.replace({name: 'dashboard'});
                    }
                } catch (e) {
                    //console.log(e)
                    this.submitted = false;
                }

            }
        },
        computed: {
            ...mapGetters({errors: "errors/errors"}),
            emailErrors() {
                const errors = [];
                if (!this.$v.form.email.$dirty) return errors;
                !this.$v.form.email.email && errors.push('Must be valid e-mail');
                !this.$v.form.email.required && errors.push('E-mail is required');
                this.errors.email && errors.push(this.errors.email[0]);
                return errors;
            },
            passwordErrors() {
                const errors = [];
                if (!this.$v.form.password.$dirty) return errors;
                !this.$v.form.password.required && errors.push('Password is required');
                this.errors.password && errors.push(this.errors.password[0]);
                return errors;
            }
        }
    }
</script>