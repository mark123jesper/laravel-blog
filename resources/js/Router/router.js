import Vue from 'vue';
import VueRouter from 'vue-router';
import Login from '../components/Login/Login';
import Signup from '../components/Login/Signup';
import Logout from '../components/Login/Logout';
import Forum from '../components/Forum/Forum';
import Read from '../components/Forum/Read';
import AskQuestion from '../components/Forum/AskQuestion.vue';

Vue.use(VueRouter);


const routes = [
   { path: '/login', component: Login },
   { path: '/signup', component: Signup },
   { path: '/logout', component: Logout},
   { path: '/forum', component: Forum, name: 'forum' },
   { path: '/question/:slug', component: Read, name: 'read' },
   { path: '/ask', component: AskQuestion, name: 'ask-question' },
];

const router = new VueRouter({
    routes: routes,
    hashbang: false,
    mode: 'history',
});

export default router;
