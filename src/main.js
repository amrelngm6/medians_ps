import Vue from 'vue'
import App from './App.vue'

import VueSimpleAlert from "vue-simple-alert";
Vue.use(VueSimpleAlert);

import vSelectMenu from 'v-selectmenu';
Vue.use(vSelectMenu);

Vue.component('moment', () => import ('moment'));
Vue.component('calendar_booking_info', () => import('./components/calendar-booking-info'));
Vue.component('calendar_products', () => import('./components/calendar-products-list'));
Vue.component('calendar_products_selected', () => import('./components/calendar-products-selected'));
Vue.component('calendar_active_item', () => import('./components/calendar-active-item'));
Vue.component('calendar_modal', () => import('./components/calendar-booking-modal'));
Vue.component('calendar', () => import('./components/calendar'));

Vue.component('login-dashboard', () => import('./components/login-dashboard'));
Vue.component('side-menu', () => import('./components/side-menu'));
Vue.component('side_cart', () => import('./components/side_cart'));
Vue.component('close_icon', () => import('./components/svgs/Close'));

import QrcodeVue from 'qrcode.vue';
Vue.component('qr_code', QrcodeVue);
// Vue.component('customers_form', () => import('./customers_form.vue'));
// Vue.component('users_form', () => import('./users_form.vue'));


// Vue.component('user_modal', () => import('./user_modal.vue'));
// Vue.component('forms', () => import('./forms.vue'));
Vue.component('vue-medialibrary-manager', () => import('./components/Manager'));
Vue.component('vue-medialibrary-field', () => import('./components/Field'));

Vue.config.productionTip = false

global.jQuery = require('jquery');
var $ = global.jQuery;
window.$ = $;

new Vue({
  render: h => h(App),
}).$mount('#app')
