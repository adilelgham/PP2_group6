require('./bootstrap');
window.Vue = require('vue');

import store from './store/index.js'

Vue.component('appointments', require('./components/Appointments.vue').default);
Vue.component('createAppointments', require('./components/CreateAppointments.vue').default);

const app = new Vue({
    el: '#app',
    store
});