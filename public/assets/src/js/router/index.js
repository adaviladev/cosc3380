import Vue from 'vue';
import Router from 'vue-router';
import Welcome from '../components/Welcome.vue';
import Contact from '../components/Contact.vue';
import Login from '../components/auth/Login.vue';
import Admin from '../components/Admin/index.vue';

Vue.use(Router);

export default new Router({
  routes: [
    {
      path: '/',
      name: 'welcome',
      component: Welcome
    },
    {
      path: '/contact',
      name: 'contact',
      component: Contact
    },
    {
      path: '/login',
      name: 'login',
      component: Login
    },
    {
      path: '/admin',
      name: 'admin',
      component: Admin
    },
  ]
});