require('./bootstrap');
import Vue from 'vue';
import VeeValidate from 'vee-validate';

import router from './router';
import store from './store';

import { Validator } from 'vee-validate';
import messages from './messages';

window.Vue = Vue;
Vue.use(VeeValidate, {
    locale: 'vi',
    dictionary: {
        vi: messages['vi']
    }
});

Vue.component(
    'admin-layout',
    require('./components/layouts/AdminLayout.vue')
);

Vue.config.performance = process.env.NODE_ENV !== 'production'

const app = new Vue({
    el: '#wrapper',
    router,
    store
});
