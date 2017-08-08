import Vue from 'vue';
import Router from 'vue-router';
import Welcome from '../components/Welcome.vue';
import Contact from '../components/Contact.vue';

Vue.use(Router);

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Welcome',
      component: Welcome
    },
    {
      path: '/contact',
      name: 'Contact',
      component: Contact
    },
  ]
});