import Vue from 'vue';
import VueRouter from 'vue-router';
import Login from '../components/Login/Login';
import Signup from '../components/Login/Signup';
import Forum from '../components/Forum/Forum';

Vue.use(VueRouter);


const routes = [
   { path: '/login', component: Login },
   { path: '/signup', component: Signup },
   { path: '/forum', component: Forum, name: 'forum' },
];

const router = new VueRouter({
    routes: routes,
    hashbang: false,
    mode: 'history',
});

export default router;
