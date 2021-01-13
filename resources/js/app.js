/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import router from './router';

import 'animate.css';

import Swal from 'sweetalert2';
window.Swal = Swal;

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 2000,
});
window.Toast = Toast;

import moment from 'moment';
window.moment = moment;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Vue.component('daily-catering', require('./components/DailyCatering.vue').default);

Vue.component('authentication', require('./auth/Authentication.vue').default);

Vue.component('profile', require('./client/profile/Profile.vue').default);
Vue.component('list-pembelian', require('./client/profile/ListPembelian.vue').default);
Vue.component('navbar', require('./components/Navbar.vue').default);

Vue.component('order-delivery', require('./client/order/Delivery.vue').default);
Vue.component('order-payment', require('./client/order/Payment.vue').default);

window.eventBus = new Vue();

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
});
