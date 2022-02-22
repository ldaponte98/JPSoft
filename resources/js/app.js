require('./bootstrap');
import Select2 from 'v-select2-component';  
window.Vue = require('vue')

Vue.component('app', require('./components/AppComponent.vue'));
Vue.component('InfiniteLoading', require('vue-infinite-loading'));
  
    Vue.component('Select2', Select2);