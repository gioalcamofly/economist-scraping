require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue';
import Vuetify from 'vuetify';
import colors from 'vuetify/lib/util/colors';

import AppNavbar from "./components/AppNavbar.vue";
import RightNavbar from "./components/RightNavbar.vue";
import MainPortal from "./components/MainPortal.vue";

const vuetify = new Vuetify(opts);

const opts = {
    theme: {
        themes: {
            light: {
                primary: "#36abfc",
                secondary: "#636e72",
                add: "#78b73b",
                accent: "#009DDF",
                greyBackground: colors.greyBackground,
                error: colors.red.accent3,
            },
            dark: {
                primary: colors.blue.lighten3,
            },
        },
    },
    customProperties: true,
    iconfont: 'md',
};

Vue.use(Vuetify);

Vue.component('app-navbar', AppNavbar);
Vue.component('right-navbar', RightNavbar);
Vue.component('main-portal', MainPortal);

const app = new Vue({
    el: '#app',
    vuetify,
    components: {AppNavbar}
})
