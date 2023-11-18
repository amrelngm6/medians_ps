(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-4318892a"],{"017e":function(t,e,s){"use strict";s.r(e);s("7f7f");var i=function(){var t=this,e=t._self._c;return e("div",{staticClass:"w-full"},[!t.showLoader&&t.trip?e("div",{staticClass:"grid xl:grid-cols-12 lg:grid-cols-12 grid-cols-1 gap-6"},[e("div",{staticClass:"xl:col-span-3 lg:col-span-5"},[e("div",{staticClass:"card px-4 py-6 mb-6"},[t.activeItem&&t.activeItem.driver?e("div",{staticClass:"text-center"},[e("p",{staticClass:"text-gray-400 mb-4 dark:text-gray-400",domProps:{textContent:t._s(t.__("Trip")+t.__(" #"))}}),e("h4",{staticClass:"mb-1 mt-3 text-lg dark:text-gray-300",domProps:{textContent:t._s(t.activeItem.trip_id)}}),e("button",{staticClass:"hover:bg-primary mb-3 px-6 py-2 text-danger",attrs:{type:"button"},on:{click:t.close}},[e("i",{staticClass:"fa fa-close px-2"}),e("span",{domProps:{textContent:t._s(t.__("Back"))}})])]):t._e(),e("hr",{staticClass:"mt-5 dark:border-gray-600"}),e("div",{staticClass:"text-start mt-6 text-sm"},[e("div",{staticClass:"space-y-7"},[e("p",{staticClass:"text-zinc-400 dark:text-gray-400 flex gap-4"},[e("strong",{domProps:{textContent:t._s(t.__("Duration"))}}),e("span",{staticClass:"ms-2",domProps:{textContent:t._s(t.activeItem.duration)}})]),e("p",{staticClass:"text-zinc-400 dark:text-gray-400 flex gap-4"},[e("strong",{domProps:{textContent:t._s(t.__("Pickup locations"))}}),e("span",{staticClass:"ms-2",domProps:{textContent:t._s(t.activeItem.pickup_locations_count)}})]),e("p",{staticClass:"text-zinc-400 dark:text-gray-400 flex gap-4"},[e("strong",{domProps:{textContent:t._s(t.__("Route"))}}),e("span",{staticClass:"ms-2",domProps:{textContent:t._s(t.activeItem.route?t.activeItem.route.route_name:"")}})]),e("p",{staticClass:"text-zinc-400 dark:text-gray-400 flex gap-4"},[e("strong",{domProps:{textContent:t._s(t.__("Driver"))}}),e("span",{staticClass:"ms-2",domProps:{textContent:t._s(t.activeItem.driver_name)}})])])]),e("hr",{staticClass:"my-5 dark:border-gray-600"})])]),e("div",{staticClass:"xl:col-span-9 lg:col-span-7"},[e("div",{staticClass:"card"},[e("div",{staticClass:"p-6"},[e("div",{staticClass:"w-full"},[e("nav",{staticClass:"lg:flex items-center justify-around rounded-xl space-x-3 bg-gray-100 p-2 dark:bg-gray-900/30",attrs:{"aria-label":"Tabs",role:"tablist"}},[e("button",{staticClass:"hover:bg-white hover:text-blue-800 hs-tab-active:font-semibold hs-tab-active:bg-white dark:hs-tab-active:bg-gray-700 w-full flex justify-center py-2 rounded items-center gap-2 border-b-2 border-transparent -mb-px transition-all text-sm whitespace-nowrap dark:text-white active",class:"info"==t.activeStatus?"menu-dark text-white font-semibold":"text-gray-500",attrs:{type:"button"},domProps:{textContent:t._s(t.__("Info"))},on:{click:function(e){return t.setActiveStatus("info")}}}),e("button",{staticClass:"hover:bg-white hover:text-blue-800 hs-tab-active:font-semibold hs-tab-active:bg-white dark:hs-tab-active:bg-gray-700 w-full flex justify-center py-2 rounded items-center gap-2 border-b-2 border-transparent -mb-px transition-all text-sm whitespace-nowrap dark:text-white",class:"pickup_locations"==t.activeStatus?"menu-dark text-white font-semibold":"text-gray-500",attrs:{type:"button"},domProps:{textContent:t._s(t.__("Pickup locations"))},on:{click:function(e){return t.setActiveStatus("pickup_locations")}}}),e("button",{staticClass:"hover:bg-white hover:text-blue-800 hs-tab-active:font-semibold hs-tab-active:bg-white dark:hs-tab-active:bg-gray-700 w-full flex justify-center py-2 rounded items-center gap-2 border-b-2 border-transparent -mb-px transition-all text-sm whitespace-nowrap dark:text-white",class:"map"==t.activeStatus?"menu-dark text-white font-semibold":"text-gray-500",attrs:{type:"button"},domProps:{textContent:t._s(t.__("Map"))},on:{click:function(e){return t.setActiveStatus("map")}}}),e("button",{staticClass:"hover:bg-white hover:text-blue-800 hs-tab-active:font-semibold hs-tab-active:bg-white dark:hs-tab-active:bg-gray-700 w-full flex justify-center py-2 rounded items-center gap-2 border-b-2 border-transparent -mb-px transition-all text-sm whitespace-nowrap dark:text-white",class:"reviews"==t.activeStatus?"menu-dark text-white font-semibold":"text-gray-500",attrs:{type:"button"},domProps:{textContent:t._s(t.__("Reviews"))},on:{click:function(e){return t.setActiveStatus("reviews")}}})]),e("div",{staticClass:"mt-3 overflow-hidden"},[e("div",{staticClass:"transition-all duration-300 transform",attrs:{id:"basic-tabs-1"}},["help_messages"==t.activeStatus?e("div",{staticClass:"grid grid-cols-1 lg:grid-cols-2 gap-6 w-full border-b border-gray-100"},t._l(t.activeItem.help_messages,(function(s){return e("div",{staticClass:"w-full relative"},[e("div",{staticClass:"dark:border-border-dark dark:border-dashed border border-border-light border-dashed p-4 flex flex-col gap-5"},[e("div",{staticClass:"flex items-start justify-between"},[e("span",{staticClass:"border border-1 grid p-3 rounded-full sm:p-2 place-content-center"},[e("help_icon",{staticClass:"text-primary w-10 h-10"})],1),e("span",{staticClass:"text-content3 text-2xs text-muted p-3",domProps:{textContent:t._s(s.date)}})]),e("div",{staticClass:"flex flex-col gap-2"},[e("div",[e("p",{staticClass:"text-title text-sm font-semibold mb-1 dark:text-white",domProps:{textContent:t._s(s.subject)}}),e("p",{staticClass:"text-content3 text-2xs truncate",domProps:{textContent:t._s(s.message)}})]),e("div",{staticClass:"absolute flex items-center justify-between gap-1",class:"ar"==t.__("lang")?"left-0":"right-0"},[e("span",{staticClass:"bg-blue-50 px-4 py-1 text-secondary badge-sm rounded-5",domProps:{textContent:t._s(s.status)}})])])])])})),0):t._e(),"info"==t.activeStatus?e("div",{staticClass:"w-full border-b border-gray-100"},[e("div",{staticClass:"mt-6 w-full"},[e("div",{staticClass:"grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6 mb-6"},[e("dashboard_card_white",{staticClass:"border border-1",attrs:{icon:"/uploads/img/products_icome.png",classes:"bg-gradient-success",title:t.__("Duration"),value:t.activeItem.duration?t.activeItem.duration:"0"}}),e("dashboard_card_white",{staticClass:"border border-1",attrs:{icon:"/uploads/img/products_icome.png",classes:"bg-gradient-info",title:t.__("Pickup locations"),value:t.activeItem.pickup_locations_count}}),e("dashboard_card_white",{staticClass:"border border-1",attrs:{icon:"/uploads/img/products_icome.png",classes:"bg-gradient-danger",title:t.__("Distance"),value:t.activeItem.distance}})],1)])]):t._e(),"pickup_locations"==t.activeStatus&&t.trip?e("div",{staticClass:"w-full border-b border-gray-100"},[e("div",{staticClass:"absolute border-s-2 border border-gray-300 h-full top-20 start-10 -z-10 dark:border-white/10",class:"ar"==t.__("lang")?"right-4":"left-4"}),e("div",{staticClass:"md:text-start lg:flex mb-5 mt-5"},[e("div",{staticClass:"w-full"},[e("h5",{staticClass:"font-semibold bg-white dark:bg-gray-700 dark:text-gray-300 inline rounded",domProps:{textContent:t._s(t.__("Trip number")+" #"+t.trip.trip_id)}}),e("p",{staticClass:"text-muted text-sm",domProps:{textContent:t._s(t.trip.trip_date)}})]),e("div",{staticClass:"w-full"},[e("h5",{staticClass:"font-semibold bg-white dark:bg-gray-700 dark:text-gray-300 inline rounded",domProps:{textContent:t._s(t.trip.duration)}}),e("p",{staticClass:"text-muted text-sm",domProps:{textContent:t._s(t.__("Duration"))}})]),e("div",{staticClass:"w-full"},[e("h5",{staticClass:"font-semibold bg-white dark:bg-gray-700 dark:text-gray-300 inline rounded",domProps:{textContent:t._s(t.trip.distance+" KM")}}),e("p",{staticClass:"text-muted text-sm",domProps:{textContent:t._s(t.__("Distance"))}})])]),t._l(t.trip.pickup_locations,(function(s){return e("div",{key:t.trip,staticClass:"space-y-4"},[e("div",{staticClass:"text-start"},[e("div",{staticClass:"absolute start-7 mt-6"},[e("div",{staticClass:"relative"},[e("div",{staticClass:"w-9 h-9 flex justify-center items-center rounded-full bg-white text-info dark:bg-gray-800"},[s.model?e("img",{staticClass:"rounded-full",attrs:{src:s.model.picture,alt:""}}):t._e()]),e("div",{staticClass:"absolute top-4 -end-6 w-12 h-[2px] bg-gray-400 -z-10"})])]),e("div",{staticClass:"grid grid-cols-1"},[e("div",{staticClass:"md:col-start-1 col-span-2"},[e("div",{staticClass:"flex md:flex-nowrap flex-wrap items-center gap-6 ms-10 md:mt-0 mt-5"},[e("div",{staticClass:"ms-10"},[e("h2",{staticClass:"p-2 rounded text-primary flex items-center justify-center text-sm mx-16",class:"ar"==t.__("lang")?"bg-gradient-to-l":"bg-gradient-to-r",domProps:{textContent:t._s(s.boarding_time)}})]),e("div",{staticClass:"relative me-5 md:ps-0 ps-10"},[e("div",{staticClass:"pt-3"},[s.model?e("h4",{staticClass:"mb-1.5 text-base dark:text-gray-300",domProps:{textContent:t._s(s.model.name)}}):t._e(),s.location?e("p",{staticClass:"mb-4 text-gray-500 dark:text-gray-400",domProps:{textContent:t._s(s.location.address)}}):t._e()])])])])])])])}))],2):t._e()])])])])]),"map"==t.activeStatus?e("p",{staticClass:"text-center"},[e("maps",{key:t.locations,attrs:{center:t.locations.length>0?t.locations[0].destination:{lat:0,lng:0},showroute:!1,waypoints:t.locations},on:{"click-marker":t.clickMarker,"update-marker":t.updateMarker,"interval-callback":t.callback}})],1):t._e()])]):t._e()])},a=[],r=s("b536"),o=s("cae8"),n={components:{dashboard_card_white:r["a"],help_icon:o["a"]},data:function(){return{content:{items:[]},locations:[],activeItem:{},showAddSide:!1,showEditSide:!1,showLoader:!1,showLoadMore:!0,limitCount:3,activeStatus:"info"}},props:["path","lang","setting","conf","auth","trip"],mounted:function(){this.activeItem=this.trip,console.log(this.activeItem),this.trip&&this.setLocations()},methods:{update:function(){this.$emit("edit","edit",this.activeItem)},close:function(){this.$emit("close","close",this.activeItem,!1)},loadmore:function(){this.showLoader=!0,this.limitCount+=5,this.limitCount>this.activeItem.last_trips.length&&(this.showLoadMore=!1),this.showLoader=!1},setActiveStatus:function(t){this.showLoader=!0,this.activeStatus=t,this.showLoader=!1},handleAction:function(t,e){switch(t){case"view":break;case"edit":this.showEditSide=!0,this.showAddSide=!1,this.activeItem=e;break;case"delete":this.$root.$children[0].deleteByKey("driver_id",e,"Driver.delete");break}},load:function(){var t=this;this.showLoader=!0,this.$root.$children[0].handleGetRequest(this.url).then((function(e){t.setValues(e),t.showLoader=!1}))},setValues:function(t){return this.content=JSON.parse(JSON.stringify(t)),this},setLocations:function(){for(var t=0;t<this.activeItem.pickup_locations.length;t++)this.locations[t]=this.handleObject(this.activeItem.pickup_locations[t]);return this},handleObject:function(t){return t.icon=this.conf?this.conf.url+"uploads/images/blue_pin.gif":"",t.origin=t.destination={lat:parseFloat(t.latitude),lng:parseFloat(t.longitude)},t.drag=!1,t},__:function(t){return this.$root.$children[0].__(t)}}},l=n,c=s("2877"),d=Object(c["a"])(l,i,a,!1,null,null,null);e["default"]=d.exports},b536:function(t,e,s){"use strict";var i=function(){var t=this,e=t._self._c;return e("div",{staticClass:"widget-item bg-white p-6 flex justify-between rounded-md"},[e("div",[e("h4",{staticClass:"text-xl font-semibold text-slate-700 mb-1 leading-none",domProps:{textContent:t._s(t.value)}}),e("p",{staticClass:"text-tiny leading-4",domProps:{textContent:t._s(t.title)}})]),e("div",[e("span",{staticClass:"text-lg text-purple-300 rounded-full flex items-center justify-center h-12 w-12 shrink-0",class:t.classes},[e("img",{staticClass:"mx-auto",attrs:{width:"25",height:"25",src:t.icon}})])])])},a=[],r={props:["title","value","classes","icon"]},o=r,n=s("2877"),l=Object(n["a"])(o,i,a,!1,null,null,null);e["a"]=l.exports},cae8:function(t,e,s){"use strict";var i=function(){var t=this,e=t._self._c;return e("svg",{attrs:{width:"800px",height:"800px",viewBox:"0 0 32 32","enable-background":"new 0 0 32 32",id:"_x3C_Layer_x3E_",version:"1.1","xml:space":"preserve",xmlns:"http://www.w3.org/2000/svg","xmlns:xlink":"http://www.w3.org/1999/xlink"}},[e("g",{attrs:{id:"help_x2C__message_x2C__question_x2C__question_mark"}},[e("g",{attrs:{id:"XMLID_2695_"}},[e("g",{attrs:{id:"XMLID_2696_"}},[e("path",{attrs:{d:"     M21.5,18.5h-11c-1.66,0-3-1.34-3-3v-11c0-1.66,1.34-3,3-3h11c1.66,0,3,1.34,3,3v11C24.5,17.16,23.16,18.5,21.5,18.5z",fill:"none",id:"XMLID_2704_",stroke:"currentColor","stroke-linecap":"round","stroke-linejoin":"round","stroke-miterlimit":"10"}}),e("path",{attrs:{d:"     M26.5,5.521L26.5,5.521c1.657,0,3,1.343,3,3v15c0,1.657-1.343,3-3,3H23l-3.5,4v-4h-14c-1.657,0-3-1.343-3-3v-15     c0-1.657,1.343-3,3-3h0",fill:"none",id:"XMLID_2703_",stroke:"currentColor","stroke-linecap":"round","stroke-linejoin":"round","stroke-miterlimit":"10"}}),e("path",{attrs:{d:"     M16,13v-0.542c0-0.904,0.475-1.743,1.25-2.208l0,0c0.775-0.465,1.25-1.304,1.25-2.208V8c0-1.381-1.119-2.5-2.5-2.5l0,0     c-1.381,0-2.5,1.119-2.5,2.5l0,0",fill:"none",id:"XMLID_2702_",stroke:"currentColor","stroke-linecap":"round","stroke-linejoin":"round","stroke-miterlimit":"10"}}),e("line",{attrs:{fill:"#FFFFFF",id:"XMLID_2700_",stroke:"#455A64","stroke-linecap":"round","stroke-linejoin":"round","stroke-miterlimit":"10",x1:"16",x2:"16",y1:"15",y2:"14.867"}}),e("line",{attrs:{fill:"none",id:"XMLID_2699_",stroke:"currentColor","stroke-linecap":"round","stroke-linejoin":"round","stroke-miterlimit":"10",x1:"18.6",x2:"18.5",y1:"22.5",y2:"22.5"}}),e("line",{attrs:{fill:"none",id:"XMLID_2698_",stroke:"#455A64","stroke-linecap":"round","stroke-linejoin":"round","stroke-miterlimit":"10",x1:"16.1",x2:"16",y1:"22.5",y2:"22.5"}}),e("line",{attrs:{fill:"none",id:"XMLID_2697_",stroke:"#455A64","stroke-linecap":"round","stroke-linejoin":"round","stroke-miterlimit":"10",x1:"13.6",x2:"13.5",y1:"22.5",y2:"22.5"}})])]),e("g",{attrs:{id:"XMLID_1026_"}},[e("g",{attrs:{id:"XMLID_1052_"}},[e("path",{attrs:{d:"     M21.5,18.5h-11c-1.66,0-3-1.34-3-3v-11c0-1.66,1.34-3,3-3h11c1.66,0,3,1.34,3,3v11C24.5,17.16,23.16,18.5,21.5,18.5z",fill:"none",id:"XMLID_2694_",stroke:"currentColor","stroke-linecap":"round","stroke-linejoin":"round","stroke-miterlimit":"10"}}),e("path",{attrs:{d:"     M26.5,5.521L26.5,5.521c1.657,0,3,1.343,3,3v15c0,1.657-1.343,3-3,3H23l-3.5,4v-4h-14c-1.657,0-3-1.343-3-3v-15     c0-1.657,1.343-3,3-3h0",fill:"none",id:"XMLID_2621_",stroke:"currentColor","stroke-linecap":"round","stroke-linejoin":"round","stroke-miterlimit":"10"}}),e("path",{attrs:{d:"     M16,13v-0.542c0-0.904,0.475-1.743,1.25-2.208l0,0c0.775-0.465,1.25-1.304,1.25-2.208V8c0-1.381-1.119-2.5-2.5-2.5l0,0     c-1.381,0-2.5,1.119-2.5,2.5l0,0",fill:"none",id:"XMLID_2559_",stroke:"currentColor","stroke-linecap":"round","stroke-linejoin":"round","stroke-miterlimit":"10"}}),e("line",{attrs:{fill:"none",id:"XMLID_2558_",stroke:"currentColor","stroke-linecap":"round","stroke-linejoin":"round","stroke-miterlimit":"10",x1:"16",x2:"16",y1:"15",y2:"14.867"}}),e("line",{attrs:{fill:"none",id:"XMLID_2557_",stroke:"currentColor","stroke-linecap":"round","stroke-linejoin":"round","stroke-miterlimit":"10",x1:"18.6",x2:"18.5",y1:"22.5",y2:"22.5"}}),e("line",{attrs:{fill:"none",id:"XMLID_2556_",stroke:"currentColor","stroke-linecap":"round","stroke-linejoin":"round","stroke-miterlimit":"10",x1:"16.1",x2:"16",y1:"22.5",y2:"22.5"}}),e("line",{attrs:{fill:"none",id:"XMLID_1073_",stroke:"currentColor","stroke-linecap":"round","stroke-linejoin":"round","stroke-miterlimit":"10",x1:"13.6",x2:"13.5",y1:"22.5",y2:"22.5"}})])])])])},a=[],r=s("2877"),o={},n=Object(r["a"])(o,i,a,!1,null,null,null);e["a"]=n.exports}}]);
//# sourceMappingURL=chunk-4318892a.chunk.js.map