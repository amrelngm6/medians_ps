(window.webpackJsonp=window.webpackJsonp||[]).push([[20],{168:function(t,e,r){"use strict";function n(t,e,r,n,i,o,a,s){var c,u="function"==typeof t?t.options:t;if(e&&(u.render=e,u.staticRenderFns=r,u._compiled=!0),n&&(u.functional=!0),o&&(u._scopeId="data-v-"+o),a?(c=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),i&&i.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(a)},u._ssrRegister=c):i&&(c=s?function(){i.call(this,(u.functional?this.parent:this).$root.$options.shadowRoot)}:i),c)if(u.functional){u._injectStyles=c;var l=u.render;u.render=function(t,e){return c.call(e),l(t,e)}}else{var h=u.beforeCreate;u.beforeCreate=h?[].concat(h,c):[c]}return{exports:t,options:u}}r.d(e,"a",(function(){return n}))},204:function(t,e,r){"use strict";r.r(e);var n=function(){var t=this,e=t._self._c;return e("div",[e("medians-calendar",{ref:"medians_calendar",attrs:{configuration:t.calendar_settings,events:[],settings:t.settings,devices:t.devices},on:{"set-event":t.setEvent,"set-new-event":t.setNewItem,"set-active-event":t.setActiveItem,"update-event":t.updateEvent,"update-info":t.updateInfo,show_event:t.show_event,show_modal:t.show_modal}}),t._v(" "),t.showPopup?e("div",{staticClass:"relative",staticStyle:{"z-index":"999"}},[e("div",{staticClass:"fixed top-0 left-0 w-full h-full",staticStyle:{"z-index":"99"}},[e("div",{staticClass:"absolute top-0 left-0 w-full h-full",staticStyle:{background:"rgba(0,0,0,.6)"},on:{click:t.hidePopup}}),t._v(" "),t.activeItem?t._e():e("div",{staticClass:"absolute top-0 left-0 right-0 bottom-0 m-auto w-40 h-40"},[e("img",{attrs:{src:"/uploads/images/loader.gif"}})]),t._v(" "),t.activeItem?e("div",{staticClass:"left-0 right-0 fixed mx-auto w-full",staticStyle:{"max-width":"600px","z-index":"99"}},[t.showModal&&!t.activeItem.allow?e("div",{staticClass:"relative h-full"},[e("calendar_new_item",{attrs:{modal:t.activeItem,games:t.activeItem.device?t.activeItem.device.games:[]}})],1):t._e(),t._v(" "),t.showModal&&t.activeItem.id>0&&"active"==t.activeItem.status?e("div",{staticClass:"relative h-full"},[t.showConfirm?e("calendar_booking_confirm",{attrs:{modal:t.activeItem}}):t._e(),t._v(" "),e("calendar_active_item",{attrs:{modal:t.activeItem}})],1):t._e(),t._v(" "),!t.showBooking||"completed"!=t.activeItem.status&&"paid"!=t.activeItem.status?t._e():e("div",{staticClass:"relative h-full"},[e("calendar_modal",{attrs:{modal:t.activeItem}})],1)]):t._e()])]):t._e(),t._v(" "),t.showCart?e("div",{staticClass:"w-full h-full fixed top-0 left-0",staticStyle:{"z-index":"999"}},[t.showCart?e("div",{staticClass:"fixed h-full w-full top-0 left-0 bg-gray-800",staticStyle:{opacity:".6","z-index":"9"},on:{click:function(e){t.showCart=!1,t.hidePopup}}}):t._e(),t._v(" "),t.showCart?e("side_cart",{ref:"side_cart",attrs:{setting:t.settings,currency:t.settings.currency}}):t._e()],1):t._e()],1)};n._withStripped=!0;var i=r(0),o=r.n(i);function a(){/*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/facebook/regenerator/blob/main/LICENSE */a=function(){return t};var t={},e=Object.prototype,r=e.hasOwnProperty,n=Object.defineProperty||function(t,e,r){t[e]=r.value},i="function"==typeof Symbol?Symbol:{},o=i.iterator||"@@iterator",s=i.asyncIterator||"@@asyncIterator",c=i.toStringTag||"@@toStringTag";function u(t,e,r){return Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}),t[e]}try{u({},"")}catch(t){u=function(t,e,r){return t[e]=r}}function h(t,e,r,i){var o=e&&e.prototype instanceof v?e:v,a=Object.create(o.prototype),s=new C(i||[]);return n(a,"_invoke",{value:x(t,r,s)}),a}function d(t,e,r){try{return{type:"normal",arg:t.call(e,r)}}catch(t){return{type:"throw",arg:t}}}t.wrap=h;var f={};function v(){}function m(){}function p(){}var y={};u(y,o,(function(){return this}));var _=Object.getPrototypeOf,g=_&&_(_(L([])));g&&g!==e&&r.call(g,o)&&(y=g);var w=p.prototype=v.prototype=Object.create(y);function b(t){["next","throw","return"].forEach((function(e){u(t,e,(function(t){return this._invoke(e,t)}))}))}function I(t,e){var i;n(this,"_invoke",{value:function(n,o){function a(){return new e((function(i,a){!function n(i,o,a,s){var c=d(t[i],t,o);if("throw"!==c.type){var u=c.arg,h=u.value;return h&&"object"==l(h)&&r.call(h,"__await")?e.resolve(h.__await).then((function(t){n("next",t,a,s)}),(function(t){n("throw",t,a,s)})):e.resolve(h).then((function(t){u.value=t,a(u)}),(function(t){return n("throw",t,a,s)}))}s(c.arg)}(n,o,i,a)}))}return i=i?i.then(a,a):a()}})}function x(t,e,r){var n="suspendedStart";return function(i,o){if("executing"===n)throw new Error("Generator is already running");if("completed"===n){if("throw"===i)throw o;return O()}for(r.method=i,r.arg=o;;){var a=r.delegate;if(a){var s=S(a,r);if(s){if(s===f)continue;return s}}if("next"===r.method)r.sent=r._sent=r.arg;else if("throw"===r.method){if("suspendedStart"===n)throw n="completed",r.arg;r.dispatchException(r.arg)}else"return"===r.method&&r.abrupt("return",r.arg);n="executing";var c=d(t,e,r);if("normal"===c.type){if(n=r.done?"completed":"suspendedYield",c.arg===f)continue;return{value:c.arg,done:r.done}}"throw"===c.type&&(n="completed",r.method="throw",r.arg=c.arg)}}}function S(t,e){var r=t.iterator[e.method];if(void 0===r){if(e.delegate=null,"throw"===e.method){if(t.iterator.return&&(e.method="return",e.arg=void 0,S(t,e),"throw"===e.method))return f;e.method="throw",e.arg=new TypeError("The iterator does not provide a 'throw' method")}return f}var n=d(r,t.iterator,e.arg);if("throw"===n.type)return e.method="throw",e.arg=n.arg,e.delegate=null,f;var i=n.arg;return i?i.done?(e[t.resultName]=i.value,e.next=t.nextLoc,"return"!==e.method&&(e.method="next",e.arg=void 0),e.delegate=null,f):i:(e.method="throw",e.arg=new TypeError("iterator result is not an object"),e.delegate=null,f)}function Y(t){var e={tryLoc:t[0]};1 in t&&(e.catchLoc=t[1]),2 in t&&(e.finallyLoc=t[2],e.afterLoc=t[3]),this.tryEntries.push(e)}function E(t){var e=t.completion||{};e.type="normal",delete e.arg,t.completion=e}function C(t){this.tryEntries=[{tryLoc:"root"}],t.forEach(Y,this),this.reset(!0)}function L(t){if(t){var e=t[o];if(e)return e.call(t);if("function"==typeof t.next)return t;if(!isNaN(t.length)){var n=-1,i=function e(){for(;++n<t.length;)if(r.call(t,n))return e.value=t[n],e.done=!1,e;return e.value=void 0,e.done=!0,e};return i.next=i}}return{next:O}}function O(){return{value:void 0,done:!0}}return m.prototype=p,n(w,"constructor",{value:p,configurable:!0}),n(p,"constructor",{value:m,configurable:!0}),m.displayName=u(p,c,"GeneratorFunction"),t.isGeneratorFunction=function(t){var e="function"==typeof t&&t.constructor;return!!e&&(e===m||"GeneratorFunction"===(e.displayName||e.name))},t.mark=function(t){return Object.setPrototypeOf?Object.setPrototypeOf(t,p):(t.__proto__=p,u(t,c,"GeneratorFunction")),t.prototype=Object.create(w),t},t.awrap=function(t){return{__await:t}},b(I.prototype),u(I.prototype,s,(function(){return this})),t.AsyncIterator=I,t.async=function(e,r,n,i,o){void 0===o&&(o=Promise);var a=new I(h(e,r,n,i),o);return t.isGeneratorFunction(r)?a:a.next().then((function(t){return t.done?t.value:a.next()}))},b(w),u(w,c,"Generator"),u(w,o,(function(){return this})),u(w,"toString",(function(){return"[object Generator]"})),t.keys=function(t){var e=Object(t),r=[];for(var n in e)r.push(n);return r.reverse(),function t(){for(;r.length;){var n=r.pop();if(n in e)return t.value=n,t.done=!1,t}return t.done=!0,t}},t.values=L,C.prototype={constructor:C,reset:function(t){if(this.prev=0,this.next=0,this.sent=this._sent=void 0,this.done=!1,this.delegate=null,this.method="next",this.arg=void 0,this.tryEntries.forEach(E),!t)for(var e in this)"t"===e.charAt(0)&&r.call(this,e)&&!isNaN(+e.slice(1))&&(this[e]=void 0)},stop:function(){this.done=!0;var t=this.tryEntries[0].completion;if("throw"===t.type)throw t.arg;return this.rval},dispatchException:function(t){if(this.done)throw t;var e=this;function n(r,n){return a.type="throw",a.arg=t,e.next=r,n&&(e.method="next",e.arg=void 0),!!n}for(var i=this.tryEntries.length-1;i>=0;--i){var o=this.tryEntries[i],a=o.completion;if("root"===o.tryLoc)return n("end");if(o.tryLoc<=this.prev){var s=r.call(o,"catchLoc"),c=r.call(o,"finallyLoc");if(s&&c){if(this.prev<o.catchLoc)return n(o.catchLoc,!0);if(this.prev<o.finallyLoc)return n(o.finallyLoc)}else if(s){if(this.prev<o.catchLoc)return n(o.catchLoc,!0)}else{if(!c)throw new Error("try statement without catch or finally");if(this.prev<o.finallyLoc)return n(o.finallyLoc)}}}},abrupt:function(t,e){for(var n=this.tryEntries.length-1;n>=0;--n){var i=this.tryEntries[n];if(i.tryLoc<=this.prev&&r.call(i,"finallyLoc")&&this.prev<i.finallyLoc){var o=i;break}}o&&("break"===t||"continue"===t)&&o.tryLoc<=e&&e<=o.finallyLoc&&(o=null);var a=o?o.completion:{};return a.type=t,a.arg=e,o?(this.method="next",this.next=o.finallyLoc,f):this.complete(a)},complete:function(t,e){if("throw"===t.type)throw t.arg;return"break"===t.type||"continue"===t.type?this.next=t.arg:"return"===t.type?(this.rval=this.arg=t.arg,this.method="return",this.next="end"):"normal"===t.type&&e&&(this.next=e),f},finish:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.finallyLoc===t)return this.complete(r.completion,r.afterLoc),E(r),f}},catch:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.tryLoc===t){var n=r.completion;if("throw"===n.type){var i=n.arg;E(r)}return i}}throw new Error("illegal catch attempt")},delegateYield:function(t,e,r){return this.delegate={iterator:L(t),resultName:e,nextLoc:r},"next"===this.method&&(this.arg=void 0),f}},t}function s(t,e,r,n,i,o,a){try{var s=t[o](a),c=s.value}catch(t){return void r(t)}s.done?e(c):Promise.resolve(c).then(n,i)}function c(t){return function(){var e=this,r=arguments;return new Promise((function(n,i){var o=t.apply(e,r);function a(t){s(o,n,i,a,c,"next",t)}function c(t){s(o,n,i,a,c,"throw",t)}a(void 0)}))}}function u(t,e,r){return e in t?Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}):t[e]=r,t}function l(t){return(l="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}var h={components:{MediansCalendar:r(15).a},props:{devices:{required:!0,type:Array,validator:function(t){return Array.isArray(t)||"object"===l(t)}},settings:{required:!1,type:Array|Object}},data:function(){var t;return u(t={showCalendar:!0,showPopup:!1,showModal:!1,showCart:!1,showConfirm:!1,showBooking:!1,activeItem:{},events:[],current_day:o()().format("YYYY-MM-DD"),calendar_settings:{style:"material_design",view_type:"day",events_url:"/api/calendar_events",cell_height:20,column_minwidth:220,animation_speed:100,scrollToNow:!0,start_day:(new Date).toISOString(),read_only:!1,day_starts_at:0,day_ends_at:24,overlap:!1,hide_days:[],past_event_creation:!0}},"events",null),u(t,"new_appointment",{}),u(t,"scrollable",!0),t},computed:{},created:function(){this.current_day=this.calendar_settings.start_day},provide:function(){},methods:{addToCart:function(t){var e={};this.showCart=!0,t&&(e.id=t.id,e.device=t.device,e.price=t.price,e.duration_time=t.duration_time,e.duration_hours=t.duration_hours,e.subtotal=t.subtotal,e.game=t.game,e.products=t.products),this.hidePopup(!1);var r=this;setTimeout((function(){r.$refs.side_cart&&r.$refs.side_cart.addToCart(e)}),1e3)},updateInfo:function(t){return this.showPopup=!1,this.activeItem=t,this.showPopup=!0,this},log:function(t){this.$parent.log(t)},show_modal:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;this.showPopup=!1,t&&(t.id&&t.status&&"active"==t.status&&this.setActiveItem(t),t.status&&"completed"==t.status&&this.show_event(t),t.status&&"paid"==t.status&&this.show_event(t),t.id||this.setNewItem(t)),this.showPopup=!0},show_event:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;this.showModal=!1,this.setEvent(t),this.showBooking=!0},setNewItem:function(t){console.log(t);var e=o()(t.starting_cell.time),r=t.ending_cell.value===t.starting_cell.value?o()(t.ending_cell.time).add(60,"minutes"):o()(t.ending_cell.time);this.activeItem=JSON.parse(JSON.stringify(t)),this.games=t.device?t.device.games:[],this.activeItem.device_id=t.device?t.device.id:0,this.activeItem.start=e.format("HH:mm"),this.activeItem.start_time=e.format("YYYY-MM-DD HH:mm"),this.activeItem.end=r.format("HH:mm"),this.activeItem.end_time=r.format("YYYY-MM-DD HH:mm"),this.activeItem.date=r.format("YYYY-MM-DD"),this.showModal=!0},setActiveItem:function(t){return console.log(t),this.activeItem=JSON.parse(JSON.stringify(t)),this.games=t.device?t.device.games:[],this.activeItem.startStr=t.start,this.activeItem.start=o()(t.from).format("HH:mm"),this.activeItem.start_time=o()(t.from).format("YYYY-MM-DD HH:mm"),this.activeItem.end=o()(t.to).format("HH:mm"),this.activeItem.end_time=o()(t.to).format("YYYY-MM-DD HH:mm"),this.activeItem.date=o()(t.from).format("YYYY-MM-DD"),this.activeItem.subtotal=this.subtotal(),this.showModal=!0,this},setEvent:function(t){return this.activeItem=JSON.parse(JSON.stringify(t)),this.activeItem.startStr=t.start,this.activeItem.subtotal=this.subtotal(),this.showModal=!0,this},storeInfo:function(t){this.submit("Event.create",t)},updateEvent:function(t,e,r){var n=JSON.parse(JSON.stringify(t));n.from=o()(r.time).format("YYYY-MM-DD HH:mm"),n.to=o()(r.time).add(t.duration,"minutes").format("YYYY-MM-DD HH:mm"),n.device_id=e.id,this.submit("Event.update",n),this.log(n)},submit:function(t){var e=this,r=arguments.length>1&&void 0!==arguments[1]?arguments[1]:null,n=r||this.activeItem,i=t.includes("create")?"create":"update",o=new URLSearchParams([]);n.start_time=this.current_day+" "+n.start,n.end_time=this.current_day+" "+n.end,o.append("type",t),o.append("params[event]",JSON.stringify(n)),this.handleRequest(o,"/api/"+i).then((function(t){e.reloadEvents(),e.hidePopup()}))},subtotal:function(){var t=this.activeItem.device_cost;return(Number(t)*Number(this.activeItem.duration_hours)).toFixed(2)},hidePopup:function(){this.showBooking=!1,this.showModal=!1,this.showConfirm=!1,this.showPopup=!1},reloadEvents:function(){this.$refs.medians_calendar.reloadEvents()},handleGetRequest:function(t){var e=this;return c(a().mark((function r(){return a().wrap((function(r){for(;;)switch(r.prev=r.next){case 0:return r.next=2,e.$parent.handleGetRequest(t);case 2:return r.abrupt("return",r.sent);case 3:case"end":return r.stop()}}),r)})))()},handleRequest:function(t){var e=arguments,r=this;return c(a().mark((function n(){var i;return a().wrap((function(n){for(;;)switch(n.prev=n.next){case 0:return i=e.length>1&&void 0!==e[1]?e[1]:"/",n.next=3,r.$parent.handleRequest(t,i);case 3:return n.abrupt("return",n.sent);case 4:case"end":return n.stop()}}),n)})))()},__:function(t){return this.$parent.__(t)}}},d=r(168),f=Object(d.a)(h,n,[],!1,null,null,null);e.default=f.exports}}]);