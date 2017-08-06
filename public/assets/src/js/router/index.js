import Vue from 'vue';
import Router from 'vue-router';
import Welcome from '../components/Welcome.vue';

const routes = [
  {
    path: '/',
    component: Welcome
  }
];

Vue.use(Router);

export default new Router({routes});