import './assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'
import App from './App.vue'

const app = createApp(App)

app.use(createPinia())


// import VueNativeNotification from 'vue-native-notification'
// app.use(VueNativeNotification, {requestOnNotify: false})



// import moment from 'moment';
app.component('open-icon', () => import('./components/svgs/open-icon.vue'));
app.component('vue-medialibrary-manager', () => import('./components/includes/Manager.vue'));
app.component('notifications', () => import('./components/notifications.vue'));
app.component('login', () => import('./components/login-dashboard.vue')); // Used if sessions expired but needs refresh
app.component('master_dashboard', () => import('./components/master_dashboard.vue')); // Dashboard for Master
app.component('users', () => import('./components/users.vue'));
app.component('pages', () => import('./components/pages.vue'));
app.component('locations', () => import('./components/locations.vue'));
app.component('destinations', () => import('./components/destinations.vue'));
app.component('trip_map', () => import('./components/includes/trip_map.vue'));
app.component('trip_page', () => import('./components/trip_page.vue'));


app.config.productionTip = false
import $ from "jquery";
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
// app.config.errorHandler = function (err, vm, info)  {
//   console.log(vm);
//   console.log('[Global Error Handler]: Error in ' + info + ': ' + err);
//   if (!enable_debug)
//     return null;
//   const screenshotTarget = document.body;
//   html2canvas(screenshotTarget).then(canvas => {
//       document.body.appendChild(canvas);  
//       pushScreenshotToServer(canvas.toDataURL(), err, info); 
//   });
// };

app.mount('#app')
