require('./bootstrap');

window.Vue = require('vue');
import Vue from 'vue';
import Vuetify from 'vuetify';
import router from './Router/router';

Vue.use(Vuetify);

import User from './Helpers/User';
window.User = User;
console.log(User.hasToken());

window.EventBus = new Vue();

Vue.component('app-home', require('./components/AppHome.vue').default);

new Vue({
    vuetify: new Vuetify(),
    el: '#app',
    router
});




