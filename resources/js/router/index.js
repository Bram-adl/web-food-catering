import Vue from 'vue'
import VueRouter from 'vue-router';

Vue.use(VueRouter);

const routes = [
    {
        path: '/payment',
        component: require('../client/PaymentPengiriman.vue').default,
    },
    {
        path: '/order',
        component: require('../client/PaymentPembayaran.vue').default,
    }
]

export default new VueRouter({
    mode: 'history',
    routes,
})