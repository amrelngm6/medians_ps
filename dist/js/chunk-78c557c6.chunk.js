(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-78c557c6"],{"37df":function(t,s,e){},5013:function(t,s,e){},"90f3":function(t,s,e){"use strict";e("5013")},"93cf":function(t,s,e){"use strict";e("37df")},"9d8d":function(t,s,e){"use strict";e.r(s);e("7f7f");var n=function(){var t=this,s=t._self._c;return s("nav",{staticClass:"rounded-lg px-4 flex w-auto bg-white shadow-lg border-b border-gray-300 relative",attrs:{id:"header"}},[s("div",{staticClass:"w-full flex items-center justify-between mt-0 px-6"},[s("div",{staticClass:"md:flex flex lg:flex md:w-auto w-full order-3 md:order-1",attrs:{id:"menu"}},[s("div",{staticClass:"inline-flex mx-4"},[s("div",{staticClass:"mx-auto h-16 py-2 w-auto"},[s("img",{staticStyle:{"max-height":"100%"},attrs:{src:t.setting.logo?t.setting.logo:"/uploads/img/logo.png",height:"40"}})])]),s("div",{staticClass:"lg:inline-flex no-mobile"},[s("ul",{staticClass:"md:flex items-center justify-center text-base text-gray-400 py-4 md:pt-0 lg:pt-0"},[s("li",[s("a",{attrs:{href:t.conf.url},domProps:{textContent:t._s(t.setting.sitename)}})])])])])]),s("ul",{staticClass:"nav user-menu flex relative"},[t.auth&&t.auth.role_id>1?s("li",[s("notifications_popup",{attrs:{auth:t.auth,conf:t.conf,lang:t.lang,setting:t.setting}})],1):t._e(),t.auth&&t.lang?s("li",{staticClass:"nav-item has-arrow main-drop relative"},[s("span",{staticClass:"py-4 text-gray-600 flex w-14 gap gap-2 cursor-pointer",attrs:{onclick:"$('.dropped2').toggleClass('hidden'); $('.dropped').addClass('hidden')"}},[s("svg",{attrs:{fill:"#666",height:"25px",width:"25px",version:"1.1",id:"XMLID_275_",xmlns:"http://www.w3.org/2000/svg","xmlns:xlink":"http://www.w3.org/1999/xlink",viewBox:"0 0 24 24","xml:space":"preserve"}},[s("g",{attrs:{id:"language"}},[s("g",[s("path",{attrs:{d:"M12,24C5.4,24,0,18.6,0,12S5.4,0,12,0s12,5.4,12,12S18.6,24,12,24z M9.5,17c0.6,3.1,1.7,5,2.5,5s1.9-1.9,2.5-5H9.5zM16.6,17c-0.3,1.7-0.8,3.3-1.4,4.5c2.3-0.8,4.3-2.4,5.5-4.5H16.6z M3.3,17c1.2,2.1,3.2,3.7,5.5,4.5c-0.6-1.2-1.1-2.8-1.4-4.5H3.3z M16.9,15h4.7c0.2-0.9,0.4-2,0.4-3s-0.2-2.1-0.5-3h-4.7c0.2,1,0.2,2,0.2,3S17,14,16.9,15z M9.2,15h5.7c0.1-0.9,0.2-1.9,0.2-3 S15,9.9,14.9,9H9.2C9.1,9.9,9,10.9,9,12C9,13.1,9.1,14.1,9.2,15z M2.5,15h4.7c-0.1-1-0.1-2-0.1-3s0-2,0.1-3H2.5C2.2,9.9,2,11,2,12 S2.2,14.1,2.5,15z M16.6,7h4.1c-1.2-2.1-3.2-3.7-5.5-4.5C15.8,3.7,16.3,5.3,16.6,7z M9.5,7h5.1c-0.6-3.1-1.7-5-2.5-5 C11.3,2,10.1,3.9,9.5,7z M3.3,7h4.1c0.3-1.7,0.8-3.3,1.4-4.5C6.5,3.3,4.6,4.9,3.3,7z"}})])])])]),s("ul",{staticClass:"absolute bg-white border border-gray-300 drop-ul hidden dropped2 flex gap-4 left-1 px-2 py-4 rounded-lg top-14 w- w-32 w-full w-sm",staticStyle:{"z-index":"9999"}},[s("li",{staticClass:"py-2",class:"ar"==t.lang.lang?"font-semibold":""},[s("a",{attrs:{href:"/switch-lang/arabic"}},[t._v("Arabic")])]),s("li",{staticClass:"py-2",class:"en"==t.lang.lang?"font-semibold border-b border-gray-300":""},[s("a",{attrs:{href:"/switch-lang/english"}},[t._v("English")])])])]):t._e(),t.auth&&t.lang?s("li",{staticClass:"nav-item has-arrow main-drop"},[s("span",{staticClass:"cursor-pointer flex gap gap-2 mt-1",attrs:{onclick:"$('.dropped1').toggleClass('hidden'); $('.dropped2').addClass('hidden')"}},[s("span",{staticClass:"user-img mt-3"},[s("img",{attrs:{src:t.auth.photo,width:"25",height:"25",alt:""}}),s("span",{staticClass:"status online absolute top-0 right-0"})]),s("span",{staticClass:"mt-4 no-mobile",domProps:{textContent:t._s(t.auth.name)}})]),s("ul",{staticClass:"drop-ul py-4 px-2 w-full bg-white border border-gray-300 rounded-lg absolute top-14 left-1 hidden dropped1",staticStyle:{"z-index":"9999",top:"60px"}},[s("li",{staticClass:"py-2 border-b border-gray-300"},[s("a",{attrs:{href:"/admin/"+t.auth.role_id==3?"settings":"system_settings"},domProps:{textContent:t._s(t.lang.setting)}})]),s("li",{staticClass:"py-2"},[s("a",{attrs:{href:"/logout"},domProps:{textContent:t._s(t.lang.logout)}})])])]):t._e()])])},a=[],o=function(){var t=this,s=t._self._c;return s("div",{staticClass:"w-full relative"},[s("div",{staticClass:"cursor-pointer relative px-4",on:{click:t.switchMenu}},[t.content.new_count?s("span",{staticClass:"absolute top-0 bg-red-400 text-white text-center w-4 h-4 text-xs rounded-full mt-2",domProps:{textContent:t._s(t.content.new_count)}}):t._e(),s("notification_icon",{staticClass:"mt-4 mx-2"})],1),t.showPopup&&t.content.items?s("div",{staticClass:"drop-ul overflow-y-auto h-80 w-80 mx-auto bg-white px-4 py-6 absolute mt-4"},[t.content.items&&t.content.items.length?s("span",{directives:[{name:"if",rawName:"v-if",value:t.content.items&&t.content.items.length,expression:"content.items && content.items.length"}],staticClass:"font-semibold pb-4 block",domProps:{textContent:t._s(t.__("New notifications"))}}):t._e(),t._l(t.content.items,(function(e,n){return e&&"new"==e.status?s("div",{key:n,staticClass:"w-full hover:bg-gray-50"},[e?s("div",{staticClass:"hover:text-purple-600"},[s("div",{staticClass:"cursor-pointer w-full flex gap-6",class:"new"==e.status?"":"text-gray-400",on:{click:function(s){return t.setRead(e)}}},[s("span",{staticClass:"border border-gray-100 block w-10 h-10 pt-1 text-center bg-white shadow-lg rounded hover:bg-blue-100"},[e.model_short_name?s(e.model_short_name?e.model_short_name:t.notification_icon,{tag:"component",staticClass:"h-auto mx-auto pt-2 w-4"}):t._e()],1),s("p",{staticClass:"block overflow-hidden w-56",attrs:{title:e.body}},[s("span",{staticClass:"block text-sm w-full font-semibold",domProps:{textContent:t._s(e.subject)}}),s("span",{staticClass:"text-sm whitespace-nowrap",domProps:{textContent:t._s(e.body)}})])]),s("div",{staticClass:"relative"},[s("small",{staticClass:"left-0 mx-1 my-0 right-0 top-2 absolute",class:"new"==e.status?"":"text-gray-400",domProps:{textContent:t._s(e.date)}}),t._m(0,!0)])]):t._e()]):t._e()})),t.content.items&&t.content.items.length?s("span",{staticClass:"font-semibold pb-4 block",domProps:{textContent:t._s(t.__("Read notifications"))}}):t._e(),t._l(t.content.items,(function(e,n){return s("div",{key:n,staticClass:"w-full hover:bg-gray-50"},[e&&"new"!=e.status?s("div",{staticClass:"hover:text-purple-600"},[s("div",{staticClass:"cursor-pointer w-full flex gap-6 text-gray-400",on:{click:function(s){return t.setRead(e)}}},[s("span",{staticClass:"border border-gray-100 block w-10 h-10 pt-1 text-center bg-white shadow-lg rounded hover:bg-blue-100"},[e.model_short_name?s(e.model_short_name?e.model_short_name:t.notification_icon,{tag:"component",staticClass:"h-auto mx-auto pt-2 w-4"}):t._e()],1),s("p",{staticClass:"block overflow-hidden w-56",attrs:{title:e.body}},[s("span",{staticClass:"block text-sm w-full font-semibold",domProps:{textContent:t._s(e.subject)}}),s("span",{staticClass:"text-sm whitespace-nowrap",domProps:{textContent:t._s(e.body)}})])]),s("div",{staticClass:"relative"},[s("small",{staticClass:"text-gray-400 left-0 mx-1 my-0 right-0 top-2 absolute",domProps:{textContent:t._s(e.date)}}),t._m(1,!0)])]):t._e()])}))],2):t._e()])},i=[function(){var t=this,s=t._self._c;return s("span",{staticClass:"block w-10 h-8 text-center"},[s("span",{staticClass:"border-l mb-2 mx-auto w-1 h-12"})])},function(){var t=this,s=t._self._c;return s("span",{staticClass:"block w-10 h-8 text-center"},[s("span",{staticClass:"border-l mb-2 mx-auto w-1 h-12"})])}],l=function(){var t=this,s=t._self._c;return s("svg",{attrs:{width:"25px",height:"25px",viewBox:"-1.5 0 20 20",version:"1.1",xmlns:"http://www.w3.org/2000/svg","xmlns:xlink":"http://www.w3.org/1999/xlink"}},[s("g",{attrs:{id:"Page-1",stroke:"none","stroke-width":"1",fill:"none","fill-rule":"evenodd"}},[s("g",{attrs:{id:"Dribbble-Light-Preview",transform:"translate(-141.000000, -720.000000)",fill:"#666"}},[s("g",{attrs:{id:"icons",transform:"translate(56.000000, 160.000000)"}},[s("path",{attrs:{d:"M97.75,574 L89.25,574 L89.25,568 C89.25,565.334 91.375,564 93.4989375,564 L93.5010625,564 C95.625,564 97.75,565.334 97.75,568 L97.75,574 Z M94.5625,577 C94.5625,577.552 94.0865,578 93.5,578 C92.9135,578 92.4375,577.552 92.4375,577 L92.4375,576 L94.5625,576 L94.5625,577 Z M100.9375,574 L99.875,574 L99.875,568 C99.875,564.447 97.359,562.475 94.5625,562.079 L94.5625,560 L92.4375,560 L92.4375,562.079 C89.641,562.475 87.125,564.447 87.125,568 L87.125,574 L86.0625,574 C85.476,574 85,574.448 85,575 C85,575.552 85.476,576 86.0625,576 L90.3125,576 L90.3125,577 C90.3125,578.657 91.7394375,580 93.5,580 C95.2605625,580 96.6875,578.657 96.6875,577 L96.6875,576 L100.9375,576 C101.524,576 102,575.552 102,575 C102,574.448 101.524,574 100.9375,574 L100.9375,574 Z",id:"notification_bell-[#1398]"}})])])])])},r=[],c=e("2877"),d={},h=Object(c["a"])(d,l,r,!1,null,null,null),u=h.exports,p=function(){var t=this,s=t._self._c;return s("svg",{attrs:{xmlns:"http://www.w3.org/2000/svg",fill:"#000000",width:"50px",height:"50px",viewBox:"0 0 24 24"}},[s("path",{attrs:{d:"M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"}})])},f=[],g={},m=Object(c["a"])(g,p,f,!1,null,null,null),w=m.exports,v=function(){var t=this,s=t._self._c;return s("svg",{attrs:{width:"50px",height:"50px",viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg"}},[s("path",{attrs:{"fill-rule":"evenodd","clip-rule":"evenodd",d:"M1 4.85714C1 3.21069 2.41423 2 4 2H20C21.5858 2 23 3.21069 23 4.85714V14.1429C23 15.7893 21.5858 17 20 17H13V20H16.5C17.0523 20 17.5 20.4477 17.5 21C17.5 21.5523 17.0523 22 16.5 22H7.5C6.94772 22 6.5 21.5523 6.5 21C6.5 20.4477 6.94772 20 7.5 20H11V17H4C2.41423 17 1 15.7893 1 14.1429V4.85714ZM4 4C3.37663 4 3 4.45225 3 4.85714V14.1429C3 14.5477 3.37663 15 4 15H20C20.6234 15 21 14.5477 21 14.1429V4.85714C21 4.45225 20.6234 4 20 4H4Z",fill:"#000000"}})])},x=[],C={},b=Object(c["a"])(C,v,x,!1,null,null,null),_=b.exports,y=function(){var t=this,s=t._self._c;return s("svg",{attrs:{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 1024 1024"}},[s("path",{attrs:{d:"M749.7 548.7l-164.6 91.4V823l164.6 91.4L914.3 823V640.1l-164.6-91.4zM841.1 780l-91.4 50.8-91.4-50.8v-96.8l91.4-50.8 91.4 50.8V780z",fill:"#0F1F3C"}}),s("path",{attrs:{d:"M713.600831 737.455926a36.6 36.6 0 1 0 72.255718-11.719698 36.6 36.6 0 1 0-72.255718 11.719698Z",fill:"#0F1F3C"}}),s("path",{attrs:{d:"M688.7 479.8c-12.7-6.2-25.7-11.8-38.9-16.6 49.8-40.3 81.6-101.8 81.6-170.6 0-121-98.4-219.4-219.4-219.4s-219.4 98.4-219.4 219.4c0 68.9 31.9 130.5 81.7 170.7-154.2 56.4-264.6 204.5-264.6 378h73.1c0-181.5 147.7-329.1 329.1-329.1 50.7 0 99.3 11.2 144.5 33.3l32.3-65.7zM512 146.3c80.7 0 146.3 65.6 146.3 146.3S592.7 438.9 512 438.9s-146.3-65.6-146.3-146.3S431.4 146.3 512 146.3z",fill:"#0F1F3C"}})])},M=[],k={},z=Object(c["a"])(k,y,M,!1,null,null,null),L=z.exports,P=function(){var t=this,s=t._self._c;return s("svg",{attrs:{width:"800px",height:"800px",viewBox:"0 0 32 32",fill:"none",xmlns:"http://www.w3.org/2000/svg"}},[s("path",{attrs:{d:"M9.74 21c-0.001-1.721-1.396-3.115-3.116-3.115s-3.116 1.395-3.116 3.116 1.395 3.116 3.116 3.116v0c1.721-0.002 3.115-1.397 3.116-3.117v-0zM5.008 21c0.001-0.892 0.724-1.615 1.616-1.615s1.616 0.724 1.616 1.616-0.724 1.616-1.616 1.616c0 0 0 0-0 0v0c-0.893-0.001-1.616-0.724-1.616-1.617v-0zM19.117 21c-0-1.721-1.396-3.116-3.117-3.116s-3.117 1.395-3.117 3.117c0 1.721 1.395 3.116 3.116 3.117h0c1.721-0.002 3.115-1.396 3.117-3.117v-0zM14.384 21c0-0.893 0.724-1.616 1.617-1.616s1.617 0.724 1.617 1.617-0.724 1.617-1.617 1.617c-0 0-0 0-0.001 0h0c-0.893-0.001-1.616-0.724-1.616-1.617v-0zM28.492 21c-0.001-1.721-1.396-3.115-3.116-3.115s-3.116 1.395-3.116 3.116 1.395 3.116 3.116 3.116c0 0 0.001 0 0.001 0h-0c1.72-0.003 3.113-1.397 3.115-3.117v-0zM23.76 21c0.001-0.892 0.724-1.615 1.616-1.615s1.616 0.724 1.616 1.616c0 0.892-0.723 1.616-1.615 1.616h-0c-0.893-0-1.617-0.724-1.617-1.617v-0zM25.377 25.531c-1.979 0.011-3.71 1.061-4.675 2.633l-0.014 0.024c-0.972-1.603-2.707-2.657-4.688-2.657s-3.717 1.055-4.675 2.633l-0.014 0.024c-0.974-1.603-2.711-2.657-4.695-2.657-2.611 0-4.794 1.827-5.343 4.272l-0.007 0.037c-0.011 0.048-0.017 0.103-0.017 0.16 0 0.414 0.336 0.75 0.75 0.75 0.357 0 0.656-0.25 0.731-0.585l0.001-0.005c0.406-1.803 1.994-3.129 3.891-3.129s3.485 1.326 3.886 3.102l0.005 0.027c0.076 0.339 0.375 0.589 0.731 0.59h0c0.021 0 0.044-0.005 0.065-0.007 0.022 0.002 0.044 0.007 0.065 0.007 0 0 0 0 0 0 0.357 0 0.656-0.25 0.73-0.585l0.001-0.005c0.406-1.803 1.994-3.129 3.891-3.129s3.485 1.326 3.886 3.102l0.005 0.027c0.115 0.337 0.428 0.574 0.797 0.574s0.682-0.238 0.795-0.568l0.002-0.006c0.407-1.803 1.994-3.129 3.892-3.129s3.485 1.326 3.887 3.102l0.005 0.027c0.076 0.34 0.374 0.59 0.732 0.59 0 0 0.001 0 0.001 0h-0c0.057-0 0.112-0.007 0.165-0.019l-0.005 0.001c0.34-0.076 0.59-0.375 0.59-0.733 0-0.057-0.006-0.112-0.018-0.165l0.001 0.005c-0.568-2.476-2.747-4.297-5.354-4.309h-0.001zM30 1.25h-28c-0.414 0-0.75 0.336-0.75 0.75v0 14c0 0.414 0.336 0.75 0.75 0.75s0.75-0.336 0.75-0.75v0-13.25h26.5v13.25c0 0.414 0.336 0.75 0.75 0.75s0.75-0.336 0.75-0.75v0-14c-0-0.414-0.336-0.75-0.75-0.75v0z"}})])},j=[],S={},V=Object(c["a"])(S,P,j,!1,null,null,null),H=V.exports,O={components:{orderdevice:H,notification_icon:u,customer:L,device:_,expense:w},name:"plans",data:function(){return{url:this.conf.url+"admin/latest_notifications?load=json",content:{title:"",new_count:0,last_id:0,items:[],new_items:[]},activeItem:{},showPopup:!1,showAddSide:!1,showEditSide:!1,showLoader:!0}},props:["path","lang","setting","conf","auth"],mounted:function(){this.load();var t=this;setInterval((function(s){t.checkNew()}),2e4)},methods:{handleNotifications:function(t){if(t&&t.items)for(var s=t.items.length-1;s>=0;s--)this.notify(t.items[s].subject,t.items[s].body,t.items[s])},checkNew:function(){var t=this,s=new URLSearchParams;s.append("params[last_id]",this.content.last_id),this.$root.$children[0].handleRequest(s,"/admin/check_notification").then((function(s){s&&t.setValues(s).handleNotifications(s)}))},setRead:function(t){var s=this,e=new URLSearchParams;e.append("params[id]",t.id),this.$root.$children[0].handleRequest(e,"/admin/read_notification").then((function(e){e&&s.load(),e&&t.url&&window.open(t.url)}))},switchMenu:function(){this.showPopup?(this.showPopup=!1,this.checkNew()):(this.showPopup=!0,this.load())},load:function(){var t=this;this.$root.$children[0].handleGetRequest(this.url).then((function(s){t.setValues(s)}))},notify:function(t,s){var e=arguments.length>2&&void 0!==arguments[2]?arguments[2]:{};if("granted"===Notification.permission){var n=new Notification(t,{body:s,data:e,tag:e.id+e.status,icon:this.setting.logo});n.onclick=function(t){var s=t.currentTarget.data?t.currentTarget.data:{};window.location.href="/dashboard",console.log("notificationData"),console.log(s)},n.onclose=function(t){console.log("notification onclose"),console.log(t)}}},setValues:function(t){return this.content=JSON.parse(JSON.stringify(t)),this},__:function(t){return this.$root.$children[0].__(t)}}},$=O,N=(e("90f3"),Object(c["a"])($,o,i,!1,null,null,null)),R=N.exports,B={name:"navbar",components:{notifications_popup:R},props:{auth:[Object,null],lang:[Object,null],setting:[Object,null],conf:[Object,null]}},F=B,Z=(e("93cf"),Object(c["a"])(F,n,a,!1,null,null,null));s["default"]=Z.exports}}]);
//# sourceMappingURL=chunk-78c557c6.chunk.js.map