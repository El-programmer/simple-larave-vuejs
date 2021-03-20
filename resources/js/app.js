require('./bootstrap');

window.Vue = require('vue').default;

import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)
import routes from './routes'
const router = new VueRouter({mode:'history',routes}); 

//Vue.use(require('vue-resource'));
//Vue.component('data-component', require('./components/DataComponent.vue'));
Vue.component('pagination', require('laravel-vue-pagination'));

//Import v-from
import { Form, HasError, AlertError } from 'vform'
window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

import Swal from 'sweetalert2'
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 2000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})
window.Swal = Swal
window.Toast = Toast

import Myheader from './components/Myheader'

const app = new Vue({
    el: '#app',
    router,
    components:{
        Myheader
    }    
});
