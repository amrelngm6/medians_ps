(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2d0e6c08"],{"99a3":function(t,e,i){"use strict";i.r(e);var a=function(){var t=this,e=t._self._c;return e("div",{staticClass:"container calendar"},[t.activeItem&&"active"==t.activeItem.status?e("div",{staticClass:"relative w-full h-full"},[e("div",{staticClass:"mt-10 relative mx-auto w-full bg-white px-6 rounded-lg overflow-y-auto",staticStyle:{"max-width":"600px","max-height":"500px"}},[e("div",{staticClass:"w-full mt-2 mb-4 pt-2 pb-6"},[e("calendar_booking_info",{key:t.activeItem,attrs:{"active-item":t.activeItem}}),e("div",{staticClass:"relative pb-2 mx-auto w-full bg-white px-6 rounded-lg",staticStyle:{"max-width":"600px","z-index":"99"}},[e("div",{staticClass:"bg-blue-200 rounded-md py-2 px-4",attrs:{role:"alert"}},[e("strong",{domProps:{textContent:t._s(t.__("confirm"))}}),e("span",{staticClass:"mx-2",domProps:{textContent:t._s(t.__("confirm_complete_booking"))}})]),e("div",{staticClass:"w-full flex mt-10"},[e("div",{staticClass:"mx-auto cursor-pointer block w-32 py-2",on:{click:function(e){t.activeItem.status="completed",t.$parent.submit("Event.update",t.activeItem),t.addToCart(t.activeItem)}}},[e("span",{staticClass:"cursor-pointer px-4 py-2 rounded-lg bg-red-600 hover:bg-purple-600 text-white",domProps:{textContent:t._s(t.__("confirm"))}})]),t.activeItem.id?e("div",{staticClass:"w-40 block mx-auto text-white text-center font-semibold py-2 border-b border-gray-200"},[e("label",{staticClass:"text-base font-semibold text-red-600 border-red-600 border rounded-lg py-1 px-4 hover:bg-purple-600 hover:text-white hover:border-purple-600",domProps:{textContent:t._s(t.__("Back"))},on:{click:function(e){return t.setHideConfirm()}}})]):t._e()])])],1)])]):t._e()])},s=[],r=(i("6b54"),i("96cf"),i("1da1")),n=(i("a481"),i("c1df")),o=i.n(n),c=i("bc3a").default,u={components:{},data:function(){return{showSelectedProducts:!0,showPopup:!0,showMoreProducts:!1,activeItem:{},products:[]}},props:["modal"],mounted:function(){this.modal&&(this.activeItem=JSON.parse(JSON.stringify(this.modal)),"active"==this.activeItem.status&&this.handleTimes())},methods:{setHideConfirm:function(){this.$parent.showConfirm=!1},handleTimes:function(){var t=o()(),e=o.a.duration(t.diff(o()(this.activeItem.start_time))),i=o()(t).diff(this.activeItem.start_time,"hours"),a=parseInt(e.asMinutes())%60,s=a>9?a:"0"+a,r=(i>9?i:"0"+i)+":"+s;"active"==this.activeItem.status&&e.asMinutes()>0&&(this.activeItem.extra_time=this.extraTime(),this.activeItem.end_time=t,this.activeItem.duration_hours=e.asHours().toFixed(2),this.activeItem.duration_time=r,this.activeItem.subtotal=(this.activeItem.duration_hours*this.activeItem.device_cost).toFixed(2),this.activeItem.duration=e.asMinutes(),this.activeItem.to=o()(this.activeItem.start_time).add(e.asMinutes(),"minutes").format("YYYY-MM-DD HH:mm:ss")),console.log(this.activeItem)},extraTime:function(){var t=o()(this.activeItem.date+" "+this.activeItem.end).diff(this.activeItem.start_time,"minutes"),e=(o()().diff(this.activeItem.start_time,"hours"),o()().diff(this.activeItem.start_time,"minutes"));parseInt((e-t).toFixed(2));return{text:this.toHoursAndMinutes((e-t).toFixed(0)),value:e-t}},toHoursAndMinutes:function(t){var e=t>59?Math.floor(t/60):0,i=t>59?t%60:t>0?t:t.replace("-","");return e>9?e:"0"+parseInt(e)+":"+(i>9?i:"0"+i)},hidePopup:function(){var t=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];this.$root.$refs.medians_calendar.hidePopup(t)},addToCart:function(t){this.$parent.addToCart(t)},handleRequest:function(){var t=Object(r["a"])(regeneratorRuntime.mark((function t(e){var i,a=arguments;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return i=a.length>1&&void 0!==a[1]?a[1]:"/",t.next=3,c.post(i,e.toString()).then((function(t){return t.data.status?t.data.result:t.data}));case 3:return t.abrupt("return",t.sent);case 4:case"end":return t.stop()}}),t)})));function e(e){return t.apply(this,arguments)}return e}(),__:function(t){return this.$parent.__(t)}}},d=u,m=i("2877"),l=Object(m["a"])(d,a,s,!1,null,null,null);e["default"]=l.exports}}]);
//# sourceMappingURL=chunk-2d0e6c08.chunk.js.map