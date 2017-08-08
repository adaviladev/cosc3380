import Vue from 'vue';
import router from './router';
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