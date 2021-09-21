require('./bootstrap');
import 'material-design-icons-iconfont/dist/material-design-icons.css';


window.Vue = require('vue');
import Vue from 'vue';
import router from './Router/router';

import Vuetify from 'vuetify';
Vue.use(Vuetify);

import VueEasymde from "vue-easymde";
Vue.component('vue-easymde', VueEasymde);

import VueSimplemde from 'vue-simplemde'
Vue.component('vue-simplemde', VueSimplemde)

import User from './Helpers/User';
window.User = User;
console.log(User.own());

import Exception from './Helpers/Exception';
window.Exception = Exception;

window.EventBus = new Vue();

import md from 'marked';
window.md = md;

Vue.component('app-home', require('./components/AppHome.vue').default);

new Vue({
    vuetify: new Vuetify(),
    el: '#app',
    router
});




