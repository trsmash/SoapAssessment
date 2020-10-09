require('./bootstrap');

import VueRouter from "vue-router";
import App from './components/App.vue';
import routes from "./routes";
import PortalVue from 'portal-vue';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';

window.Vue = require('vue');
Vue.use(VueRouter);
Vue.use(PortalVue);
Vue.use(BootstrapVue);
Vue.use(IconsPlugin);

const app = new Vue({
    el: '#app',
    router: routes,
    components: {App}
});
