(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-d81b96d6"],{d5df:function(t,s,e){"use strict";e("f376")},dff1:function(t,s,e){"use strict";e.r(s);e("b54a");var a=function(){var t=this,s=t._self._c;return s("div",{staticClass:"w-full flex overflow-auto",staticStyle:{height:"85vh","z-index":"9999"}},[s("div",{staticClass:"w-full"},[t.content&&!t.showLoader?s("main",{staticClass:"flex-1 overflow-x-hidden overflow-y-auto w-full"},[s("div",{staticClass:"px-4 mb-6 py-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 flex w-full"},[s("h1",{staticClass:"font-bold text-lg w-full",domProps:{textContent:t._s(t.__("settings"))}})]),s("hr",{staticClass:"mt-2"}),s("div",{staticClass:"w-full lg:flex gap gap-6"},[s("div",{staticClass:"w-full mb-6"},[t.showForm&&t.content.setting?s("form",{staticClass:"action py-0 m-auto rounded-lg pb-10",attrs:{action:"/api/update",method:"POST","data-refresh":"1",id:"add-device-form"}},[s("input",{attrs:{name:"type",type:"hidden",value:"SystemSettings.update"}}),"basic"==t.activeTab?s("div",{staticClass:"w-full"},[s("div",{staticClass:"card w-full"},[s("div",{staticClass:"card-body pt-0"},[s("div",{staticClass:"settings-form"},[s("label",{staticClass:"block py-3"},[s("input",{attrs:{name:"params[settings][logo]",type:"hidden"},domProps:{value:t.content.setting.logo}}),s("div",{staticClass:"w-full block cursor-pointer"},[s("span",{staticClass:"text-gray-700 w-20"},[t._v(t._s(t.__("Logo"))+" "),s("span",{staticClass:"star-red"},[t._v("*")])]),s("vue-medialibrary-field",{attrs:{name:"params[settings][logo]",api_url:t.conf.url},model:{value:t.content.setting.logo,callback:function(s){t.$set(t.content.setting,"logo",s)},expression:"content.setting.logo"}})],1)]),s("label",{staticClass:"block py-3"},[s("span",{staticClass:"text-gray-700"},[t._v(t._s(t.__("Sitename"))+" "),s("span",{staticClass:"star-red"},[t._v("*")])]),s("input",{staticClass:"h-10 mt-3 rounded w-full border px-3 text-gray-400 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{name:"params[sitename]",type:"text",required:"",placeholder:t.__("Sitename")},domProps:{value:t.content.setting.sitename}})]),s("label",{staticClass:"block py-3"},[s("span",{staticClass:"text-gray-700"},[t._v(t._s(t.__("Language"))+" "),s("span",{staticClass:"star-red"},[t._v("*")])]),s("select",{staticClass:"select h-10 mt-3 rounded w-full border px-3 text-gray-400 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{name:"params[lang]"},domProps:{value:t.content.setting.lang}},[s("option",{attrs:{value:"english"}},[t._v("English")]),s("option",{attrs:{value:"arabic"}},[t._v("العربية")])])])])])]),s("div",{staticClass:"w-full"},[s("div",{staticClass:"card"},[s("div",{staticClass:"card-body pt-0"},[s("div",{staticClass:"settings-form"},[s("label",{staticClass:"block py-3"},[s("label",[t._v(t._s(t.__("Enable debugging"))+" "),s("span",{staticClass:"star-red"},[t._v("*")])]),s("select",{staticClass:"select h-10 mt-3 rounded w-full border px-3 text-gray-400 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{name:"params[settings][enable_debug]"},domProps:{value:t.content.setting.enable_debug}},[s("option",{attrs:{value:"1"},domProps:{textContent:t._s(t.__("enabled"))}}),s("option",{attrs:{value:"0"},domProps:{textContent:t._s(t.__("disabled"))}})])])])])])])]):t._e(),"notifications"==t.activeTab?s("div",{staticClass:"w-full"},[s("div",{staticClass:"card w-full"},[s("div",{staticClass:"card-header pt-0"},[s("span",{staticClass:"text-gray-700 font-semibold"},[s("span",{domProps:{textContent:t._s(t.__("notifications"))}})])]),s("div",{staticClass:"card-body pt-0"},[s("div",{staticClass:"settings-form mt-2"},[s("label",{staticClass:"block pb-3"},[s("span",{staticClass:"text-gray-700"},[s("span",{domProps:{textContent:t._s(t.__("enable_notifications"))}})]),s("input",{directives:[{name:"model",rawName:"v-model",value:t.content.setting.enable_notifications,expression:"content.setting.enable_notifications"}],staticClass:"h-4 w-4 mx-4 p-2 rounded border px-3 text-gray-400 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{name:"params[enable_notifications]",type:"checkbox",value:"1"},domProps:{checked:Array.isArray(t.content.setting.enable_notifications)?t._i(t.content.setting.enable_notifications,"1")>-1:t.content.setting.enable_notifications},on:{change:function(s){var e=t.content.setting.enable_notifications,a=s.target,o=!!a.checked;if(Array.isArray(e)){var r="1",l=t._i(e,r);a.checked?l<0&&t.$set(t.content.setting,"enable_notifications",e.concat([r])):l>-1&&t.$set(t.content.setting,"enable_notifications",e.slice(0,l).concat(e.slice(l+1)))}else t.$set(t.content.setting,"enable_notifications",o)}}})]),s("hr"),s("label",{staticClass:"block py-3"},[s("span",{staticClass:"text-gray-700"},[s("span",{domProps:{textContent:t._s(t.__("welcome_message_subject"))}})]),s("input",{directives:[{name:"model",rawName:"v-model",value:t.content.setting.welcome_message_subject,expression:"content.setting.welcome_message_subject"}],staticClass:"h-10 mt-3 rounded w-full border px-3 text-gray-400 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{name:"params[welcome_message_subject]",type:"text",placeholder:t.__("welcome_message_subject")},domProps:{value:t.content.setting.welcome_message_subject},on:{input:function(s){s.target.composing||t.$set(t.content.setting,"welcome_message_subject",s.target.value)}}})]),s("label",{staticClass:"block py-3"},[s("span",{staticClass:"text-gray-700"},[s("span",{domProps:{textContent:t._s(t.__("welcome_message_icon"))}})]),s("input",{directives:[{name:"model",rawName:"v-model",value:t.content.setting.welcome_message_icon,expression:"content.setting.welcome_message_icon"}],staticClass:"h-10 mt-3 rounded w-full border px-3 text-gray-400 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{name:"params[welcome_message_icon]",type:"text",placeholder:t.__("welcome_message_icon")},domProps:{value:t.content.setting.welcome_message_icon},on:{input:function(s){s.target.composing||t.$set(t.content.setting,"welcome_message_icon",s.target.value)}}})]),s("label",{staticClass:"block py-3"},[s("span",{staticClass:"text-gray-700"},[s("span",{domProps:{textContent:t._s(t.__("welcome_message"))}})]),s("textarea",{directives:[{name:"model",rawName:"v-model",value:t.content.setting.notifications_welcome_message,expression:"content.setting.notifications_welcome_message"}],staticClass:"mt-3 rounded w-full border px-3 text-gray-700 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{name:"params[notifications_welcome_message]",rows:"3",placeholder:t.__("welcome_message")},domProps:{value:t.content.setting.notifications_welcome_message},on:{input:function(s){s.target.composing||t.$set(t.content.setting,"notifications_welcome_message",s.target.value)}}})])])])])]):t._e(),"smtp"==t.activeTab?s("div",{staticClass:"w-full lg:flex gap-4"},[s("div",{staticClass:"card w-full"},[s("div",{staticClass:"card-header pt-0"},[s("span",{staticClass:"text-gray-700 font-semibold"},[s("span",{domProps:{textContent:t._s(t.__("SMTP_INFO"))}})])]),s("div",{staticClass:"card-body pt-0"},[s("div",{staticClass:"settings-form mt-2"},[s("label",{staticClass:"block pb-3"},[s("span",{staticClass:"text-gray-700"},[s("span",{domProps:{textContent:t._s(t.__("SMTP_SENDER"))}})]),s("input",{staticClass:"h-10 mt-3 rounded w-full border px-3 text-gray-400 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{name:"params[smtp_sender]",type:"email",placeholder:t.__("SMTP_SENDER")},domProps:{value:t.content.setting.smtp_sender}})]),s("label",{staticClass:"block py-3"},[s("span",{staticClass:"text-gray-700"},[s("span",{domProps:{textContent:t._s(t.__("SMTP_USER"))}})]),s("input",{staticClass:"h-10 mt-3 rounded w-full border px-3 text-gray-400 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{name:"params[smtp_user]",type:"text",placeholder:t.__("SMTP_USER")},domProps:{value:t.content.setting.smtp_user}})]),s("label",{staticClass:"block py-3"},[s("span",{staticClass:"text-gray-700"},[s("span",{domProps:{textContent:t._s(t.__("SMTP_PASSWORD"))}})]),s("input",{staticClass:"h-10 mt-3 rounded w-full border px-3 text-gray-400 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{name:"params[smtp_password]",type:"text",placeholder:t.__("SMTP_PASSWORD")}})])])])]),s("div",{staticClass:"w-full"},[s("div",{staticClass:"card"},[t._m(0),s("div",{staticClass:"card-body pt-0"},[s("div",{staticClass:"settings-form"},[s("label",{staticClass:"block py-3"},[s("span",{staticClass:"text-gray-700"},[s("span",{domProps:{textContent:t._s(t.__("SMTP_HOST"))}})]),s("input",{staticClass:"h-10 mt-3 rounded w-full border px-3 text-gray-400 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{name:"params[smtp_host]",type:"text",placeholder:t.__("SMTP_HOST")},domProps:{value:t.content.setting.smtp_host}})]),s("label",{staticClass:"block py-3"},[s("span",{staticClass:"text-gray-700"},[s("span",{domProps:{textContent:t._s(t.__("SMTP_PORT"))}})]),s("input",{staticClass:"h-10 mt-3 rounded w-full border px-3 text-gray-400 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{name:"params[smtp_port]",type:"number",placeholder:t.__("SMTP_USER")},domProps:{value:t.content.setting.smtp_port}})]),s("label",{staticClass:"block py-3"},[s("span",{staticClass:"text-gray-700"},[t._v(t._s(t.__("SMTP_AUTH"))+" ")]),s("select",{staticClass:"select h-10 mt-3 rounded w-full border px-3 text-gray-400 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{name:"params[smtp_auth]"},domProps:{value:t.content.setting.smtp_auth}},[s("option",{attrs:{value:"1"}},[t._v("True")]),s("option",{attrs:{value:"0"}},[t._v("False")])])])])])])])]):t._e(),"google"==t.activeTab?s("div",{staticClass:"w-full flex gap-4"},[s("div",{staticClass:"card w-full"},[s("div",{staticClass:"card-header pt-0"},[s("span",{staticClass:"text-gray-700 font-semibold"},[s("span",{domProps:{textContent:t._s(t.__("GOOGLE_AUTH"))}})])]),s("div",{staticClass:"card-body pt-0"},[s("div",{staticClass:"settings-form"},[s("div",{staticClass:"form-group"},[s("label",{staticClass:"block py-3"},[s("span",{staticClass:"text-gray-700"},[s("span",{domProps:{textContent:t._s(t.__("google_login_api_key"))}})]),s("input",{staticClass:"h-10 mt-3 rounded w-full border px-3 text-gray-400 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{name:"params[google_login_key]",type:"text",placeholder:t.__("google_login_api_key")},domProps:{value:t.content.setting.google_login_key}})]),s("label",{staticClass:"block py-3"},[s("span",{staticClass:"text-gray-700"},[s("span",{domProps:{textContent:t._s(t.__("google_login_api_secret"))}})]),s("input",{staticClass:"h-10 mt-3 rounded w-full border px-3 text-gray-400 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{name:"params[google_login_secret]",type:"text",placeholder:t.__("google_login_api_secret")},domProps:{value:t.content.setting.google_login_secret}})])])])])])]):t._e(),"site_content"==t.activeTab?s("div",{staticClass:"w-full flex gap-4"},[s("div",{staticClass:"card w-full"},[s("div",{staticClass:"card-header pt-0"},[s("span",{staticClass:"text-gray-700 font-semibold"},[s("span",{domProps:{textContent:t._s(t.__("site_content"))}})])]),s("div",{staticClass:"card-body py-6"},[s("a",{staticClass:"pt-2 text-center block uppercase h-12 mt-3 text-white w-40 mx-auto rounded bg-red-700 hover:bg-red-800",attrs:{href:"/admin/editor",target:"_blank"}},[t._v(t._s(t.__("Open editor")))]),s("hr",{staticClass:"my-4"}),s("div",{staticClass:"w-full text-base"},[s("p",{staticClass:"my-2 py-2 px-2 flex gap-2 rounded-lg bg-blue-50"},[s("i",{staticClass:"fa fa-bell mt-1"}),s("span",{domProps:{textContent:t._s(t.__("editor_help"))}})]),s("p",{staticClass:"my-2 py-2 px-2 flex gap-2 rounded-lg bg-red-50"},[s("i",{staticClass:"fa fa-bell mt-1"}),s("span",{domProps:{textContent:t._s(t.__("editor_notes"))}})])])])])]):t._e(),"payment_methods"==t.activeTab?s("div",{staticClass:"w-full flex gap-4"},[s("div",{staticClass:"card w-full"},[s("div",{staticClass:"card-header flex gap-6 pt-0"},[s("svg",{attrs:{width:"30px",height:"30px",viewBox:"-3.5 0 48 48",version:"1.1",xmlns:"http://www.w3.org/2000/svg","xmlns:xlink":"http://www.w3.org/1999/xlink"}},[s("defs"),s("g",{attrs:{id:"Icons",stroke:"none","stroke-width":"1",fill:"none","fill-rule":"evenodd"}},[s("g",{attrs:{id:"Color-",transform:"translate(-804.000000, -660.000000)",fill:"#022B87"}},[s("path",{attrs:{d:"M838.91167,663.619443 C836.67088,661.085983 832.621734,660 827.440097,660 L812.404732,660 C811.344818,660 810.443663,660.764988 810.277343,661.801472 L804.016136,701.193856 C803.892151,701.970844 804.498465,702.674333 805.292267,702.674333 L814.574458,702.674333 L816.905967,688.004562 L816.833391,688.463555 C816.999712,687.427071 817.894818,686.662083 818.95322,686.662083 L823.363735,686.662083 C832.030541,686.662083 838.814901,683.170138 840.797138,673.069296 C840.856106,672.7693 840.951363,672.194809 840.951363,672.194809 C841.513828,668.456868 840.946827,665.920407 838.91167,663.619443 Z M843.301017,674.10803 C841.144899,684.052874 834.27133,689.316292 823.363735,689.316292 L819.408334,689.316292 L816.458414,708 L822.873846,708 C823.800704,708 824.588458,707.33101 824.733611,706.423525 L824.809211,706.027531 L826.284927,696.754676 L826.380183,696.243184 C826.523823,695.335698 827.313089,694.666708 828.238435,694.666708 L829.410238,694.666708 C836.989913,694.666708 842.92604,691.611256 844.660308,682.776394 C845.35583,679.23045 845.021677,676.257496 843.301017,674.10803 Z",id:"Paypal"}})])])]),s("span",{staticClass:"text-gray-700 font-semibold"},[s("span",{domProps:{textContent:t._s(t.__("PAYPAL_API"))}})])]),s("div",{staticClass:"card-body p-0 px-6"},[s("div",{staticClass:"settings-form"},[s("div",{staticClass:"form-group"},[s("label",{staticClass:"block py-3"},[s("span",{staticClass:"text-gray-700"},[t._v(t._s(t.__("paypal_mode"))+" "),s("span",{staticClass:"star-red"},[t._v("*")])]),s("select",{staticClass:"select h-10 mt-3 rounded w-full border px-3 text-gray-400 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{name:"params[paypal_mode]"},domProps:{value:t.content.setting.paypal_mode}},[s("option",{attrs:{value:"SANDBOX"}},[t._v("SANDBOX")]),s("option",{attrs:{value:"LIVE"}},[t._v("LIVE")])])]),s("label",{staticClass:"block py-3"},[s("span",{staticClass:"text-gray-700"},[s("span",{domProps:{textContent:t._s(t.__("PayPal_API_KEY"))}})]),s("input",{staticClass:"h-10 mt-3 rounded w-full border px-3 text-gray-400 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{name:"params[paypal_api_key]",type:"text",placeholder:t.__("paypal_api_key")},domProps:{value:t.content.setting.paypal_api_key}})]),s("label",{staticClass:"block py-3"},[s("span",{staticClass:"text-gray-700"},[s("span",{domProps:{textContent:t._s(t.__("PayPal_api_secret"))}})]),s("input",{staticClass:"h-10 mt-3 rounded w-full border px-3 text-gray-400 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{name:"params[paypal_api_secret]",type:"text",placeholder:t.__("paypal_api_secret")},domProps:{value:t.content.setting.paypal_api_secret}})])])])])])]):t._e(),"site_content"!=t.activeTab?s("button",{staticClass:"uppercase h-12 mt-3 text-white w-40 mx-auto rounded bg-red-700 hover:bg-red-800"},[t._v(t._s(t.__("Save")))]):t._e()]):t._e()]),s("div",{staticClass:"col-md-3"},[s("ul",{staticClass:"bg-white p-4 rounded-lg"},t._l(t.setting_tabs,(function(e,a){return s("li",{key:a,staticClass:"cursor-pointer py-2 px-1 border-b border-gray-200 py-2",class:e.link==t.activeTab?"font-bold":"",domProps:{textContent:t._s(e.title)},on:{click:function(s){return t.switchTab(e)}}})})),0)])])]):t._e()])])},o=[function(){var t=this,s=t._self._c;return s("div",{staticClass:"card-header pt-0"},[s("span",{staticClass:"text-gray-700 font-semibold"},[s("span")])])}],r={name:"Settings",data:function(){return{url:this.conf.url+this.path+"?load=json",content:{setting:{}},setting_tabs:[{title:this.__("Basic Details"),link:"basic"},{title:this.__("Notifications"),link:"notifications"},{title:this.__("SMTP setting"),link:"smtp"},{title:this.__("site content"),link:"site_content"},{title:this.__("payment methods"),link:"payment_methods"},{title:this.__("GOOGLE_AUTH"),link:"google"}],activeItem:null,activeTab:"basic",showAddSide:!1,showEditSide:!1,showLoader:!1,showForm:!0}},props:["path","lang","conf","auth"],mounted:function(){this.load()},methods:{switchTab:function(t){this.showForm=!1,this.activeTab=t.link,this.showForm=!0},load:function(){var t=this;this.showLoader=!0,this.$parent.handleGetRequest(this.url).then((function(s){t.setValues(s),t.showLoader=!1}))},setValues:function(t){return this.content=JSON.parse(JSON.stringify(t)),this},__:function(t){return this.$root.$children[0].__(t)}}},l=r,n=(e("d5df"),e("2877")),i=Object(n["a"])(l,a,o,!1,null,null,null);s["default"]=i.exports},f376:function(t,s,e){}}]);
//# sourceMappingURL=chunk-d81b96d6.chunk.js.map