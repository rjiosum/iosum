<template>
    <v-snackbar top
                v-model="show"
                :color="color"
                :multi-line="true"
                :timeout="timeout"
                :vertical="true"
    >
        <v-icon dark left>{{icon}}</v-icon>
        {{message}}

        <template v-slot:action="{ attrs }">
            <v-btn
                    dark
                    text
                    v-bind="attrs"
                    @click.native="show = false"
            >
                Close
            </v-btn>
        </template>
    </v-snackbar>
</template>

<script>
    export default {
        name: "AppNotify",
        data() {
            return {
                show: false,
                message: '',
                color: 'success',
                icon: 'mdi-check-bold',
                timeout: -1
            }
        },
        created() {
            this.$store.watch(state => state.notify.notice.msg, () => {
                const msg = this.$store.state.notify.notice.msg;
                if (msg !== '') {
                    this.show = true;
                    this.message = this.$store.state.notify.notice.msg;
                    this.color = this.$store.state.notify.notice.color;
                    this.icon = this.$store.state.notify.notice.icon;
                    this.timeout = this.$store.state.notify.notice.timeout;
                    this.$store.dispatch('notify/setNotice', {msg: '', color: '', icon: '', timeout: 6});
                }
            })
        }
    }
</script>