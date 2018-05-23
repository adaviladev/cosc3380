import Vue from 'vue';
import router from './router/index';
import App from './components/App.vue';

new Vue({
  el: '#app',
  router,
  template: '<App/>',
  components: {
    App
  },
  render: (h) => h(App)
});