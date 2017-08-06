import Vue from 'vue';
import Router from './router';
import App from './components/App.vue';
import Welcome from './components/Welcome.vue';

let vm = new Vue({
  Router,
  render: (h) => h(App)
});

vm.$mount('#app');