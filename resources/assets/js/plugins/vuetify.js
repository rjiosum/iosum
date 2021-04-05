import Vue from 'vue';
import Vuetify from 'vuetify';

import "vuetify/dist/vuetify.min.css";

Vuetify.config.silent = false

Vue.use(Vuetify);

const theme = {
    primary: '#673ab7',
    secondary: '#9c27b0',
    accent: '#e91e63',
    error: '#f44336',
    warning: '#ff9800',
    info: '#00bcd4',
    success: '#4caf50',
    black: '#363636'
}

export default new Vuetify({
    iconfont: 'mdi' || 'fa',
    theme: {
        themes: {
            dark: theme,
            light: theme,
        }
    },
});