import './assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'
import App from './App.vue'

const app = createApp(App)


import VueFeather from 'vue-feather';
app.component(VueFeather.name, VueFeather);


app.config.productionTip = false
import $ from "jquery";
window.$ = $;


// function pushScreenshotToServer(dataURL, err, info) {  
//     $.ajax({ 
//         url: "/api/bug_report",  
//         type: "POST",  
//         data: {info:info, err: err, image: dataURL},  
//         dataType: "html", 
//         success: function() {}  
//     });  
// }   


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
app.use(createPinia())

app.mount('#app')
