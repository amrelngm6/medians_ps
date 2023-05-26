(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2d22653c"],{e7d8:function(t,e,s){"use strict";s.r(e);s("7f7f");var a=function(){var t=this,e=t._self._c;return e("div",{},[t.activeItem&&t.show?e("div",[e("div",{staticClass:"w-full block gap-4 py-2 border-b border-gray-200"},[e("label",{staticClass:"w-full mt-10",domProps:{textContent:t._s(t.__("game"))}}),e("div",{staticClass:"w-full block gap-4 my-2 text-gray-600 overflow-x-auto"},[e("div",{staticClass:"overflow-x-auto w-full flex gap gap-6"},[e("label",{staticClass:"block cursor-pointer py-2 w-40 my-2 rounded-lg text-center font-semibold bg-purple-600 text-white"},[e("img",{staticClass:"mx-auto w-6 h-6 rounded-full my-2",attrs:{src:t.activeItem.game?t.activeItem.game.picture:""}}),e("span",{domProps:{textContent:t._s(t.activeItem.game?t.activeItem.game.name:"")}})]),e("div",{staticClass:"block cursor-pointer py-2 w-32 my-2 text-default",staticStyle:{direction:"ltr"}},[e("div",{staticClass:"block"},[e("span",{staticClass:"w-full block",domProps:{textContent:t._s(t.__("price"))}}),t.activeItem.device&&t.activeItem.device.price?e("div",{staticClass:"py-2 text-md text-purple-600 font-semibold"},["single"==t.activeItem.booking_type?e("span",{domProps:{textContent:t._s(t.activeItem.device.price.single_price)}}):t._e(),"multi"==t.activeItem.booking_type?e("span",{domProps:{textContent:t._s(t.activeItem.device.price.multi_price)}}):t._e(),e("span",[t._v("x")]),e("span",{domProps:{textContent:t._s(t.activeItem.duration_hours)}})]):t._e()])]),e("div",{staticClass:"block cursor-pointer py-2 w-32 my-2 text-default",staticStyle:{direction:"ltr"}},[e("div",{staticClass:"block"},[e("span",{staticClass:"w-full block",domProps:{textContent:t._s(t.__("duration"))}}),t.activeItem.duration_time?e("div",{staticClass:"py-2 text-md text-purple-600 font-semibold"},[e("span",{domProps:{textContent:t._s(t.activeItem.duration_time)}})]):t._e()])]),e("div",{staticClass:"cursor-pointer py-2 w-32 my-2 text-default",staticStyle:{direction:"ltr"}},[e("div",{staticClass:"block"},[e("span",{staticClass:"w-full block text",domProps:{textContent:t._s(t.__("cost"))}}),t.activeItem.subtotal?e("div",{staticClass:"py-2 text-lg text-purple-600 font-semibold"},[e("span",{domProps:{textContent:t._s(t.activeItem.subtotal)}}),e("span",{staticClass:"text-sm",domProps:{textContent:t._s(t.activeItem.currency)}})]):t._e()])])])])]),t.activeItem.products&&t.activeItem.products.length?e("div",{staticClass:"w-full block"},[e("calendar_products_selected",{ref:"selected_products",attrs:{item:t.activeItem}})],1):t._e(),e("span",{staticClass:"text-md font-semibold w-full block py-2",domProps:{textContent:t._s(t.__("duration"))}}),e("div",{staticClass:"w-full flex gap-4 gap text-md py-2"},[e("div",{staticClass:"w-full block pb-2 border-b border-gray-200"},[e("label",{staticClass:"w-full py-2 text-gray-400",domProps:{textContent:t._s(t.__("date"))}}),e("span",{staticClass:"w-full text-purple-600 block",domProps:{textContent:t._s(t.activeItem.date)}})]),e("div",{staticClass:"w-full block pb-2 border-b border-gray-200"},[e("label",{staticClass:"w-full py-2 text-gray-400",domProps:{textContent:t._s(t.__("start"))}}),e("span",{staticClass:"w-full text-md text-purple-600 block",domProps:{textContent:t._s(t.formatTime(t.activeItem.start_time))}})]),e("div",{staticClass:"w-full block pb-2 border-b border-gray-200"},[e("label",{staticClass:"w-full py-2 text-gray-400",domProps:{textContent:t._s(t.__("end"))}}),e("span",{staticClass:"w-full text-md text-purple-600 block",domProps:{textContent:t._s(t.formatTime(t.activeItem.end_time))}})])]),e("div",{staticClass:"w-full block pb-2 border-b border-gray-200"},[t.activeItem.extra_time&&t.activeItem.extra_time.value?e("p",{staticClass:"font-semibold flex"},[e("span",{domProps:{textContent:t._s(t.extraTimeText())}}),t.extraTimeText()?e("span",{staticClass:"text-purple-600 px-2",domProps:{textContent:t._s(t.activeItem.extra_time.text)}}):t._e()]):t._e()]),e("span",{staticClass:"text-md font-semibold w-full block py-2",domProps:{textContent:t._s(t.__("information"))}}),t.activeItem.customer?e("div",{staticClass:"w-full flex gap-4 py-1 border-b border-gray-200 mb-2"},[e("span",{staticClass:"text-md w-full block py-2",domProps:{textContent:t._s(t.__("Customer"))}}),e("span",{staticClass:"w-full text-md p-2 text-gray-600 font-semibold",domProps:{textContent:t._s(t.activeItem.customer.name+" - "+t.activeItem.customer.mobile)}})]):t._e(),e("div",{staticClass:"w-full flex gap-4 py-1 border-b border-gray-200"},[e("label",{staticClass:"w-full text-gray-400",domProps:{textContent:t._s(t.__("type"))}}),e("span",{staticClass:"w-full text-md p-2 text-gray-600 font-semibold",domProps:{textContent:t._s(t.activeItem.booking_type)}})]),e("div",{staticClass:"w-full flex gap-4 py-1 border-b border-gray-200"},[e("label",{staticClass:"w-full text-gray-400",domProps:{textContent:t._s(t.__("subtotal"))}}),e("span",{staticClass:"w-full text-lg pb-2 text-purple-600 gap gap-1"},[e("span",{domProps:{textContent:t._s(t.subtotal())}}),e("span",{domProps:{textContent:t._s(t.activeItem.currency)}})])])]):t._e()])},o=[],l=(s("c5f6"),s("c1df")),i=s.n(l),r={data:function(){return{show:!0}},props:["activeItem"],mounted:function(){},methods:{products_subtotal:function(){var t=0;if(this.activeItem.products&&this.activeItem.products.length)for(var e=this.activeItem.products.length-1;e>=0;e--)this.activeItem.products[e]&&(t=Number(this.activeItem.products[e].subtotal)+Number(t));return t?t.toFixed(2):0},formatTime:function(t){return i()(t).format("hh:mm a")},subtotal:function(){var t=Number(this.activeItem.subtotal),e=Number(this.products_subtotal());return e>0&&(t=e>0?t+e:t),t},extraTimeText:function(){return this.activeItem.extra_time.value>5?this.__("Extra time is"):this.activeItem.extra_time.value<-5?this.__("Missing time is"):void 0},__:function(t){return this.$parent.__(t)}}},c=r,n=s("2877"),m=Object(n["a"])(c,a,o,!1,null,null,null);e["default"]=m.exports}}]);
//# sourceMappingURL=chunk-2d22653c.chunk.js.map