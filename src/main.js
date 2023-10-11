import Vue from 'vue'
import App from './App.vue'
import "@andresouzaabreu/vue-data-table/dist/DataTable.css";

import VueSimpleAlert from "vue-simple-alert";
Vue.use(VueSimpleAlert);

import vSelectMenu from 'v-selectmenu';
Vue.use(vSelectMenu);

import VueNativeNotification from 'vue-native-notification'
Vue.use(VueNativeNotification, {requestOnNotify: false})


import DataTable from "@andresouzaabreu/vue-data-table";
Vue.component("data-table", DataTable);

import * as VueGoogleMaps from 'vue2-google-maps';
Vue.use(VueGoogleMaps, {
    load: {key: 'AIzaSyDL0vscd-iCbsPOhokIhMBXtujAkLShlME',
    libraries: 'places,routes'
    }
});


Vue.component('moment', () => import ('moment'));
Vue.component('dataTableActions', () => import('./components/includes/data-table-actions.vue'));

Vue.component('login-dashboard', () => import('./components/login-dashboard'));
Vue.component('side-menu', () => import('./components/side-menu'));
Vue.component('close_icon', () => import('./components/svgs/Close'));


import QrcodeVue from 'qrcode.vue';
Vue.component('qr_code', QrcodeVue);
Vue.component('vue-medialibrary-manager', () => import('./components/includes/Manager'));
Vue.component('vue-medialibrary-field', () => import('./components/includes/Field'));
Vue.component('notifications_events', () => import('./components/notifications_events'));
Vue.component('notifications', () => import('./components/notifications'));
Vue.component('login', () => import('./components/login-dashboard')); // Used if sessions expired but needs refresh
Vue.component('SideMenu', () => import('./components/side-menu'));
Vue.component('navbar', () => import('./components/navbar'));
Vue.component('dashboard', () => import('./components/dashboard')); // Dashboard for branch admin
Vue.component('master_dashboard', () => import('./components/master_dashboard')); // Dashboard for Master
Vue.component('categories', () => import('./components/categories'));
Vue.component('settings', () => import('./components/settings'));
Vue.component('system_settings', () => import('./components/system_settings'));
Vue.component('side-form-update', () => import('./components/includes/side-form-update'));
Vue.component('side-form-create', () => import('./components/includes/side-form-create'));
Vue.component('users', () => import('./components/users'));
Vue.component('customers', () => import('./components/customers'));
Vue.component('pages', () => import('./components/pages'));
Vue.component('blog', () => import('./components/blog'));
Vue.component('students', () => import('./components/students'));
Vue.component('drivers', () => import('./components/drivers'));
Vue.component('routes', () => import('./components/routes'));
Vue.component('vehicles', () => import('./components/vehicles'));
Vue.component('locations', () => import('./components/locations'));
Vue.component('trips', () => import('./components/trips'));
Vue.component('help_messages', () => import('./components/help_messages'));
Vue.component('maps', () => import('./components/includes/map'));


Vue.config.productionTip = false

global.jQuery = require('jquery');
var jQuery = global.jQuery;
var $ = global.jQuery;
window.$ = $;


function pushScreenshotToServer(dataURL, err, info) {  
    $.ajax({ 
        url: "/api/bug_report",  
        type: "POST",  
        data: {info:info, err: err, image: dataURL},  
        dataType: "html", 
        success: function() {}  
    });  
}   
Vue.config.errorHandler = function (err, vm, info)  {
  console.log('[Global Error Handler]: Error in ' + info + ': ' + err);
  if (!enable_debug)
    return null;
  const screenshotTarget = document.body;
  html2canvas(screenshotTarget).then(canvas => {
      document.body.appendChild(canvas);  
      pushScreenshotToServer(canvas.toDataURL(), err, info); 
  });
};

new Vue({
  render: h => h(App),
}).$mount('#app')
