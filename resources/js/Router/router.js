import Vue from 'vue';
import VueRouter from 'vue-router';
import Login from '../components/Login/Login.vue';
import Signup from '../components/Login/Signup.vue';
import Logout from '../components/Login/Logout.vue';
import Forum from '../components/Forum/Forum.vue';
import Read from '../components/Forum/Read.vue';
import AskQuestion from '../components/Forum/AskQuestion.vue';
import CreateCategory from '../components/Category/CreateCategory.vue';

Vue.use(VueRouter);


const routes = [
   { path: '/login', component: Login },
   { path: '/signup', component: Signup },
   { path: '/logout', component: Logout},
   { path: '/forum', component: Forum, name: 'forum' },
   { path: '/question/:slug', component: Read, name: 'read' },
   { path: '/ask', component: AskQuestion, name: 'ask-question' },
   { path: '/category', component: CreateCategory, name: 'create-category' },
];

const router = new VueRouter({
    routes: routes,
    hashbang: false,
    mode: 'history',
});

export default router;
