(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2ae3d60b"],{"12e0":function(t,e,s){"use strict";var a=function(){var t=this,e=t._self._c;return e("div",{staticClass:""},[e("div",{staticClass:"card card-img-holder text-white h-100",class:t.classes},[e("div",{staticClass:"card-body"},[e("img",{staticClass:"card-img-absolute",attrs:{src:"/uploads/img/circle.png",alt:"circle-image"}}),e("h4",{staticClass:"font-weight-normal mb-3 relative",domProps:{textContent:t._s(t.title)}}),e("span",{staticClass:"text-2xl",domProps:{textContent:t._s(t.value)}})])])])},r=[],i={props:["title","classes","value"]},o=i,n=s("2877"),l=Object(n["a"])(o,a,r,!1,null,null,null);e["a"]=l.exports},"18bd":function(t,e,s){"use strict";s.r(e);s("7f7f");var a=function(){var t=this,e=t._self._c;return e("div",{staticClass:"w-full"},[t.showLoader?t._e():e("div",{staticClass:"grid xl:grid-cols-12 lg:grid-cols-12 grid-cols-1 gap-6"},[e("div",{staticClass:"xl:col-span-3 lg:col-span-5"},[e("div",{staticClass:"card px-4 py-6 mb-6"},[e("div",{staticClass:"text-center"},[e("img",{staticClass:"rounded-full p-1 bg-gray-100 dark:bg-gray-700 mx-auto",attrs:{src:t.activeItem.picture,alt:""}}),e("h4",{staticClass:"mb-1 mt-3 text-lg dark:text-gray-300",domProps:{textContent:t._s(t.activeItem.name)}}),e("p",{staticClass:"text-gray-400 mb-4 dark:text-gray-400",domProps:{textContent:t._s(t.activeItem.email)}}),e("button",{staticClass:"bg-gray-50 border border-1 hover:bg-primary mb-3 px-6 py-2 rounded-lg text-primary",attrs:{type:"button"},domProps:{textContent:t._s(t.__("Edit"))},on:{click:t.update}}),e("button",{staticClass:"hover:bg-primary mb-3 px-6 py-2 text-danger",attrs:{type:"button"},on:{click:t.close}},[e("i",{staticClass:"fa fa-close px-2"}),e("span",{domProps:{textContent:t._s(t.__("Back"))}})])]),e("hr",{staticClass:"mt-5 dark:border-gray-600"}),e("div",{staticClass:"text-start mt-6 text-sm"},[e("div",{staticClass:"space-y-7"},[e("p",{staticClass:"text-zinc-400 dark:text-gray-400 flex gap-4"},[e("strong",{domProps:{textContent:t._s(t.__("First name"))}}),e("span",{staticClass:"ms-2",domProps:{textContent:t._s(t.activeItem.first_name)}})]),e("p",{staticClass:"text-zinc-400 dark:text-gray-400 flex gap-4"},[e("strong",{domProps:{textContent:t._s(t.__("Last name"))}}),e("span",{staticClass:"ms-2",domProps:{textContent:t._s(t.activeItem.last_name)}})]),e("p",{staticClass:"text-zinc-400 dark:text-gray-400 flex gap-4"},[e("strong",{domProps:{textContent:t._s(t.__("Email"))}}),e("span",{staticClass:"ms-2",domProps:{textContent:t._s(t.activeItem.email)}})]),e("p",{staticClass:"text-zinc-400 dark:text-gray-400 flex gap-4"},[e("strong",{domProps:{textContent:t._s(t.__("Phone"))}}),e("span",{staticClass:"ms-2",domProps:{textContent:t._s(t.activeItem.contact_number)}})]),e("p",{staticClass:"text-zinc-400 dark:text-gray-400 flex gap-4"},[e("strong",{domProps:{textContent:t._s(t.__("License number"))}}),e("span",{staticClass:"ms-2",domProps:{textContent:t._s(t.activeItem.driver_license_number)}})]),e("p",{staticClass:"text-zinc-400 dark:text-gray-400 flex gap-4 items-start"},[e("strong",{staticClass:"flex-shrink",domProps:{textContent:t._s(t.__("address"))}}),e("span",{staticClass:"ms-2",domProps:{textContent:t._s(t.activeItem.address)}})])])]),e("hr",{staticClass:"my-5 dark:border-gray-600"})])]),e("div",{staticClass:"xl:col-span-9 lg:col-span-7"},[e("div",{staticClass:"card"},[e("div",{staticClass:"p-6"},[e("div",{staticClass:"w-full"},[e("nav",{staticClass:"lg:flex items-center justify-around rounded-xl space-x-3 bg-gray-100 p-2 dark:bg-gray-900/30",attrs:{"aria-label":"Tabs",role:"tablist"}},[e("button",{staticClass:"hover:bg-white hover:text-blue-800 hs-tab-active:font-semibold hs-tab-active:bg-white dark:hs-tab-active:bg-gray-700 w-full flex justify-center py-2 rounded items-center gap-2 border-b-2 border-transparent -mb-px transition-all text-sm whitespace-nowrap dark:text-white active",class:"info"==t.activeStatus?"menu-dark text-white font-semibold":"text-gray-500",attrs:{type:"button"},domProps:{textContent:t._s(t.__("Info"))},on:{click:function(e){return t.setActiveStatus("info")}}}),e("button",{staticClass:"hover:bg-white hover:text-blue-800 hs-tab-active:font-semibold hs-tab-active:bg-white dark:hs-tab-active:bg-gray-700 w-full flex justify-center py-2 rounded items-center gap-2 border-b-2 border-transparent -mb-px transition-all text-sm whitespace-nowrap dark:text-white",class:"trips"==t.activeStatus?"menu-dark text-white font-semibold":"text-gray-500",attrs:{type:"button"},domProps:{textContent:t._s(t.__("Trips"))},on:{click:function(e){return t.setActiveStatus("trips")}}}),e("button",{staticClass:"hover:bg-white hover:text-blue-800 hs-tab-active:font-semibold hs-tab-active:bg-white dark:hs-tab-active:bg-gray-700 w-full flex justify-center py-2 rounded items-center gap-2 border-b-2 border-transparent -mb-px transition-all text-sm whitespace-nowrap dark:text-white",class:"help_messages"==t.activeStatus?"menu-dark text-white font-semibold":"text-gray-500",attrs:{type:"button"},domProps:{textContent:t._s(t.__("Help messages"))},on:{click:function(e){return t.setActiveStatus("help_messages")}}}),e("button",{staticClass:"hover:bg-white hover:text-blue-800 hs-tab-active:font-semibold hs-tab-active:bg-white dark:hs-tab-active:bg-gray-700 w-full flex justify-center py-2 rounded items-center gap-2 border-b-2 border-transparent -mb-px transition-all text-sm whitespace-nowrap dark:text-white",class:"reviews"==t.activeStatus?"menu-dark text-white font-semibold":"text-gray-500",attrs:{type:"button"},domProps:{textContent:t._s(t.__("Reviews"))},on:{click:function(e){return t.setActiveStatus("reviews")}}})]),e("div",{staticClass:"mt-3 overflow-hidden"},[e("div",{staticClass:"transition-all duration-300 transform",attrs:{id:"basic-tabs-1"}},["help_messages"==t.activeStatus?e("div",{staticClass:"grid grid-cols-1 lg:grid-cols-2 gap-6 w-full border-b border-gray-100"},t._l(t.activeItem.help_messages,(function(s){return e("div",{staticClass:"w-full relative"},[e("div",{staticClass:"dark:border-border-dark dark:border-dashed border border-border-light border-dashed p-4 flex flex-col gap-5"},[e("div",{staticClass:"flex items-start justify-between"},[e("span",{staticClass:"border border-1 grid p-3 rounded-full sm:p-2 place-content-center"},[e("help_icon",{staticClass:"text-primary w-10 h-10"})],1),e("span",{staticClass:"text-content3 text-2xs text-muted p-3",domProps:{textContent:t._s(s.date)}})]),e("div",{staticClass:"flex flex-col gap-2"},[e("div",[e("p",{staticClass:"text-title text-sm font-semibold mb-1 dark:text-white",domProps:{textContent:t._s(s.subject)}}),e("p",{staticClass:"text-content3 text-2xs truncate",domProps:{textContent:t._s(s.message)}})]),e("div",{staticClass:"absolute flex items-center justify-between gap-1",class:"ar"==t.__("lang")?"left-0":"right-0"},[e("span",{staticClass:"bg-blue-50 px-4 py-1 text-secondary badge-sm rounded-5",domProps:{textContent:t._s(s.status)}})])])])])})),0):t._e(),"info"==t.activeStatus?e("div",{staticClass:"w-full border-b border-gray-100"},[e("div",{staticClass:"mt-6 w-full"},[e("div",{staticClass:"grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6 mb-6"},[e("dashboard_card_white",{staticClass:"border border-1",attrs:{icon:"/uploads/img/products_icome.png",classes:"bg-gradient-success",title:t.__("Completed trips"),value:t.activeItem.last_trips.length}}),e("dashboard_card_white",{staticClass:"border border-1",attrs:{icon:"/uploads/img/products_icome.png",classes:"bg-gradient-info",title:t.__("Pickup locations"),value:t.activeItem.total_pickups_count}}),e("dashboard_card_white",{staticClass:"border border-1",attrs:{icon:"/uploads/img/products_icome.png",classes:"bg-gradient-danger",title:t.__("Reviews"),value:"0"}})],1)])]):t._e(),"trips"==t.activeStatus&&t.activeItem.last_trips?e("div",{staticClass:"w-full border-b border-gray-100"},t._l(t.activeItem.last_trips,(function(s,a){return a<=t.limitCount?e("div",{staticClass:"relative overflow-hidden"},[e("div",{staticClass:"absolute border-s-2 border border-gray-300 h-full top-20 start-10 -z-10 dark:border-white/10"}),e("div",{staticClass:"md:text-start mb-5 mt-5"},[e("h5",{staticClass:"font-semibold bg-white dark:bg-gray-700 dark:text-gray-300 inline rounded",domProps:{textContent:t._s(t.__("Trip number")+" #"+s.trip_id)}}),e("p",{staticClass:"text-muted text-sm",domProps:{textContent:t._s(s.trip_date)}})]),t._l(s.pickup_locations,(function(s){return e("div",{staticClass:"space-y-4"},[e("div",{staticClass:"text-start"},[e("div",{staticClass:"absolute start-7 mt-6"},[e("div",{staticClass:"relative"},[e("div",{staticClass:"w-8 h-8 flex justify-center items-center rounded-full bg-white text-info dark:bg-gray-800"},[e("img",{staticClass:"rounded-full",attrs:{src:s.model.picture,alt:""}})]),e("div",{staticClass:"absolute top-4 -end-6 w-12 h-[2px] bg-gray-400 -z-10"})])]),e("div",{staticClass:"grid grid-cols-1"},[e("div",{staticClass:"md:col-start-1 col-span-2"},[e("div",{staticClass:"flex md:flex-nowrap flex-wrap items-center gap-6 ms-10 md:mt-0 mt-5"},[e("div",{staticClass:"ms-10"},[e("h2",{staticClass:"p-2 rounded text-primary flex items-center justify-center text-sm mx-16",class:"ar"==t.__("lang")?"bg-gradient-to-l":"bg-gradient-to-r",domProps:{textContent:t._s(s.boarding_time)}})]),e("div",{staticClass:"relative me-5 md:ps-0 ps-10"},[e("div",{staticClass:"pt-3"},[s.model?e("h4",{staticClass:"mb-1.5 text-base dark:text-gray-300",domProps:{textContent:t._s(s.model.name)}}):t._e(),s.location?e("p",{staticClass:"mb-4 text-gray-500 dark:text-gray-400",domProps:{textContent:t._s(s.location.address)}}):t._e()])])])])])])])}))],2):t._e()})),0):t._e()])])])])]),t.showLoadMore&&"trips"==t.activeStatus?e("p",{staticClass:"text-center"},[e("span",{staticClass:"mx-auto menu-dark px-4 py-3 rounded-xl text-white cursor-pointer text-white rounded-lg",domProps:{textContent:t._s(t.__("Load more"))},on:{click:function(e){return t.loadmore()}}})]):t._e()])])])},r=[],i=s("12e0"),o=s("b536"),n=s("682e"),l=function(){var t=this,e=t._self._c;return e("svg",{attrs:{width:"800px",height:"800px",viewBox:"0 0 32 32","enable-background":"new 0 0 32 32",id:"_x3C_Layer_x3E_",version:"1.1","xml:space":"preserve",xmlns:"http://www.w3.org/2000/svg","xmlns:xlink":"http://www.w3.org/1999/xlink"}},[e("g",{attrs:{id:"help_x2C__message_x2C__question_x2C__question_mark"}},[e("g",{attrs:{id:"XMLID_2695_"}},[e("g",{attrs:{id:"XMLID_2696_"}},[e("path",{attrs:{d:"     M21.5,18.5h-11c-1.66,0-3-1.34-3-3v-11c0-1.66,1.34-3,3-3h11c1.66,0,3,1.34,3,3v11C24.5,17.16,23.16,18.5,21.5,18.5z",fill:"none",id:"XMLID_2704_",stroke:"currentColor","stroke-linecap":"round","stroke-linejoin":"round","stroke-miterlimit":"10"}}),e("path",{attrs:{d:"     M26.5,5.521L26.5,5.521c1.657,0,3,1.343,3,3v15c0,1.657-1.343,3-3,3H23l-3.5,4v-4h-14c-1.657,0-3-1.343-3-3v-15     c0-1.657,1.343-3,3-3h0",fill:"none",id:"XMLID_2703_",stroke:"currentColor","stroke-linecap":"round","stroke-linejoin":"round","stroke-miterlimit":"10"}}),e("path",{attrs:{d:"     M16,13v-0.542c0-0.904,0.475-1.743,1.25-2.208l0,0c0.775-0.465,1.25-1.304,1.25-2.208V8c0-1.381-1.119-2.5-2.5-2.5l0,0     c-1.381,0-2.5,1.119-2.5,2.5l0,0",fill:"none",id:"XMLID_2702_",stroke:"currentColor","stroke-linecap":"round","stroke-linejoin":"round","stroke-miterlimit":"10"}}),e("line",{attrs:{fill:"#FFFFFF",id:"XMLID_2700_",stroke:"#455A64","stroke-linecap":"round","stroke-linejoin":"round","stroke-miterlimit":"10",x1:"16",x2:"16",y1:"15",y2:"14.867"}}),e("line",{attrs:{fill:"none",id:"XMLID_2699_",stroke:"currentColor","stroke-linecap":"round","stroke-linejoin":"round","stroke-miterlimit":"10",x1:"18.6",x2:"18.5",y1:"22.5",y2:"22.5"}}),e("line",{attrs:{fill:"none",id:"XMLID_2698_",stroke:"#455A64","stroke-linecap":"round","stroke-linejoin":"round","stroke-miterlimit":"10",x1:"16.1",x2:"16",y1:"22.5",y2:"22.5"}}),e("line",{attrs:{fill:"none",id:"XMLID_2697_",stroke:"#455A64","stroke-linecap":"round","stroke-linejoin":"round","stroke-miterlimit":"10",x1:"13.6",x2:"13.5",y1:"22.5",y2:"22.5"}})])]),e("g",{attrs:{id:"XMLID_1026_"}},[e("g",{attrs:{id:"XMLID_1052_"}},[e("path",{attrs:{d:"     M21.5,18.5h-11c-1.66,0-3-1.34-3-3v-11c0-1.66,1.34-3,3-3h11c1.66,0,3,1.34,3,3v11C24.5,17.16,23.16,18.5,21.5,18.5z",fill:"none",id:"XMLID_2694_",stroke:"currentColor","stroke-linecap":"round","stroke-linejoin":"round","stroke-miterlimit":"10"}}),e("path",{attrs:{d:"     M26.5,5.521L26.5,5.521c1.657,0,3,1.343,3,3v15c0,1.657-1.343,3-3,3H23l-3.5,4v-4h-14c-1.657,0-3-1.343-3-3v-15     c0-1.657,1.343-3,3-3h0",fill:"none",id:"XMLID_2621_",stroke:"currentColor","stroke-linecap":"round","stroke-linejoin":"round","stroke-miterlimit":"10"}}),e("path",{attrs:{d:"     M16,13v-0.542c0-0.904,0.475-1.743,1.25-2.208l0,0c0.775-0.465,1.25-1.304,1.25-2.208V8c0-1.381-1.119-2.5-2.5-2.5l0,0     c-1.381,0-2.5,1.119-2.5,2.5l0,0",fill:"none",id:"XMLID_2559_",stroke:"currentColor","stroke-linecap":"round","stroke-linejoin":"round","stroke-miterlimit":"10"}}),e("line",{attrs:{fill:"none",id:"XMLID_2558_",stroke:"currentColor","stroke-linecap":"round","stroke-linejoin":"round","stroke-miterlimit":"10",x1:"16",x2:"16",y1:"15",y2:"14.867"}}),e("line",{attrs:{fill:"none",id:"XMLID_2557_",stroke:"currentColor","stroke-linecap":"round","stroke-linejoin":"round","stroke-miterlimit":"10",x1:"18.6",x2:"18.5",y1:"22.5",y2:"22.5"}}),e("line",{attrs:{fill:"none",id:"XMLID_2556_",stroke:"currentColor","stroke-linecap":"round","stroke-linejoin":"round","stroke-miterlimit":"10",x1:"16.1",x2:"16",y1:"22.5",y2:"22.5"}}),e("line",{attrs:{fill:"none",id:"XMLID_1073_",stroke:"currentColor","stroke-linecap":"round","stroke-linejoin":"round","stroke-miterlimit":"10",x1:"13.6",x2:"13.5",y1:"22.5",y2:"22.5"}})])])])])},d=[],c=s("2877"),m={},p=Object(c["a"])(m,l,d,!1,null,null,null),u=p.exports,g={components:{dashboard_center_squares:n["a"],dashboard_card_white:o["a"],dashboard_card:i["a"],help_icon:u},data:function(){return{content:{items:[]},activeItem:{},showAddSide:!1,showEditSide:!1,showLoader:!1,showLoadMore:!0,limitCount:3,activeStatus:"info"}},props:["path","lang","setting","conf","auth","item"],mounted:function(){this.activeItem=this.item,console.log(this.activeItem)},methods:{update:function(){this.$emit("edit",this.activeItem)},close:function(){this.$emit("close")},loadmore:function(){this.showLoader=!0,this.limitCount+=5,this.limitCount>this.activeItem.last_trips.length&&(this.showLoadMore=!1),this.showLoader=!1},setActiveStatus:function(t){this.showLoader=!0,this.activeStatus=t,this.showLoader=!1},handleAction:function(t,e){switch(t){case"view":break;case"edit":this.showEditSide=!0,this.showAddSide=!1,this.activeItem=e;break;case"delete":this.$root.$children[0].deleteByKey("driver_id",e,"Driver.delete");break}},load:function(){var t=this;this.showLoader=!0,this.$root.$children[0].handleGetRequest(this.url).then((function(e){t.setValues(e),t.showLoader=!1}))},setValues:function(t){return this.content=JSON.parse(JSON.stringify(t)),this},__:function(t){return this.$root.$children[0].__(t)}}},x=g,h=Object(c["a"])(x,a,r,!1,null,null,null);e["default"]=h.exports},"682e":function(t,e,s){"use strict";var a=function(){var t=this,e=t._self._c;return t.content?e("div",{staticClass:"border-muted-200 dark:border-muted-700 dark:bg-muted-800 relative w-full border bg-white transition-all duration-300 rounded-md p-6"},[e("div",{staticClass:"mb-10 pb-6"},[e("h3",{staticClass:"font-heading text-base font-semibold leading-tight text-muted-800 dark:text-white",domProps:{textContent:t._s(t.$parent.__("Some important Stats"))}}),e("p",{staticClass:"py-2 text-gray-400 mb-10",domProps:{textContent:t._s(t.$parent.__("some important stats about the performance"))}})]),e("div",{staticClass:"grid gap-4 md:grid-cols-2 mt-10 pt-6"},[e("div",{staticClass:"bg-gray-50 flex items-center gap-2 rounded-md p-4"},[e("div",{staticClass:"relative inline-flex shrink-0 items-center justify-center h-12 w-12 rounded-full bg-primary-100 text-primary-500 dark:bg-primary-500/20 dark:text-primary-400 dark:border-primary-500 dark:border-2"},[e("svg",{staticClass:"icon h-5 w-5",attrs:{"data-v-cd102a71":"",xmlns:"http://www.w3.org/2000/svg","xmlns:xlink":"http://www.w3.org/1999/xlink","aria-hidden":"true",role:"img",width:"1em",height:"1em",viewBox:"0 0 256 256"}},[e("g",{attrs:{fill:"currentColor"}},[e("path",{attrs:{d:"m219.84 73.16l-88-48.16a8 8 0 0 0-7.68 0l-88 48.18a8 8 0 0 0-4.16 7v95.64a8 8 0 0 0 4.16 7l88 48.18a8 8 0 0 0 7.68 0l88-48.18a8 8 0 0 0 4.16-7V80.18a8 8 0 0 0-4.16-7.02ZM128 168a40 40 0 1 1 40-40a40 40 0 0 1-40 40Z",opacity:".2"}}),e("path",{attrs:{d:"M128 80a48 48 0 1 0 48 48a48.06 48.06 0 0 0-48-48Zm0 80a32 32 0 1 1 32-32a32 32 0 0 1-32 32Zm95.68-93.85l-88-48.15a15.88 15.88 0 0 0-15.36 0l-88 48.17a16 16 0 0 0-8.32 14v95.64a16 16 0 0 0 8.32 14l88 48.17a15.88 15.88 0 0 0 15.36 0l88-48.17a16 16 0 0 0 8.32-14V80.18a16 16 0 0 0-8.32-14.03ZM128 224l-88-48.18V80.18L128 32l88 48.17v95.63Z"}})])])]),e("div",[e("h2",{staticClass:"font-heading text-base font-semibold leading-tight text-muted-800 dark:text-white",domProps:{textContent:t._s(t.setting.currency+t.content.avg_sales)}}),e("p",{staticClass:"font-alt text-sm font-normal leading-normal leading-normal"},[e("span",{staticClass:"text-muted-500 dark:text-muted-400",domProps:{textContent:t._s(t.$parent.__("Sales average"))}})])])]),e("div",{staticClass:"bg-gray-50 flex items-center gap-2 rounded-md p-4"},[e("div",{staticClass:"relative inline-flex shrink-0 items-center justify-center h-12 w-12 rounded-full bg-amber-100 text-amber-500 dark:border-2 dark:border-amber-500 dark:bg-amber-500/20 dark:text-amber-400"},[e("svg",{staticClass:"icon h-5 w-5",attrs:{"data-v-cd102a71":"",xmlns:"http://www.w3.org/2000/svg","xmlns:xlink":"http://www.w3.org/1999/xlink","aria-hidden":"true",role:"img",width:"1em",height:"1em",viewBox:"0 0 256 256"}},[e("g",{attrs:{fill:"currentColor"}},[e("path",{attrs:{d:"m200 152l-40 40l-64-16l-56-40l32-64l56-16l56 16h-40l-45.66 44.29a8 8 0 0 0 1.38 12.42C117.23 139.9 141 139.13 160 120Z",opacity:".2"}}),e("path",{attrs:{d:"M119.76 217.94A8 8 0 0 1 112 224a8.13 8.13 0 0 1-2-.24l-32-8a8 8 0 0 1-2.5-1.11l-24-16a8 8 0 1 1 8.88-13.31l22.84 15.23l30.66 7.67a8 8 0 0 1 5.88 9.7Zm132.69-96.46a15.89 15.89 0 0 1-8 9.25l-23.68 11.84l-55.08 55.09a8 8 0 0 1-7.6 2.1l-64-16a8.06 8.06 0 0 1-2.71-1.25l-55.52-39.64l-24.28-12.14a16 16 0 0 1-7.16-21.46l24.85-49.69a16 16 0 0 1 21.46-7.16l22.06 11l53-15.14a8 8 0 0 1 4.4 0l53 15.14l22.06-11a16 16 0 0 1 21.46 7.16l24.85 49.69a15.9 15.9 0 0 1 .89 12.21Zm-46.18 12.94L179.06 80h-31.82L104 122c12.66 8.09 32.51 10.32 50.32-7.63a8 8 0 0 1 10.68-.61l34.41 27.57Zm-187.54-18l17.69 8.85l24.85-49.69l-17.69-8.85ZM188 152.66l-27.71-22.19c-19.54 16-44.35 18.11-64.91 5a16 16 0 0 1-2.72-24.82a.6.6 0 0 1 .08-.08l44.86-43.51l-9.6-2.74l-50.42 14.41l-27.37 54.73l49.2 35.15l58.14 14.53Zm49.24-36.24l-24.82-49.69l-17.69 8.85l24.85 49.69Z"}})])])]),e("div",[e("h2",{staticClass:"font-heading text-base font-semibold leading-tight text-muted-800 dark:text-white",domProps:{textContent:t._s(t.setting.currency+t.content.avg_bookings)}}),e("p",{staticClass:"font-alt text-sm font-normal leading-normal leading-normal"},[e("span",{staticClass:"text-muted-500 dark:text-muted-400",domProps:{textContent:t._s(t.$parent.__("Bookings average"))}})])])]),e("div",{staticClass:"bg-gray-50 flex items-center gap-2 rounded-md p-4"},[e("div",{staticClass:"relative inline-flex shrink-0 items-center justify-center h-12 w-12 rounded-full bg-green-100 text-green-500 dark:border-2 dark:border-green-500 dark:bg-green-500/20 dark:text-green-400"},[e("svg",{staticClass:"icon h-5 w-5",attrs:{"data-v-cd102a71":"",xmlns:"http://www.w3.org/2000/svg","xmlns:xlink":"http://www.w3.org/1999/xlink","aria-hidden":"true",role:"img",width:"1em",height:"1em",viewBox:"0 0 256 256"}},[e("g",{attrs:{fill:"currentColor"}},[e("path",{attrs:{d:"M240 104L128 224L80 104l48-64h56Z",opacity:".2"}}),e("path",{attrs:{d:"m246 98.73l-56-64a8 8 0 0 0-6-2.73H72a8 8 0 0 0-6 2.73l-56 64a8 8 0 0 0 .17 10.73l112 120a8 8 0 0 0 11.7 0l112-120a8 8 0 0 0 .13-10.73ZM222.37 96H180l-36-48h36.37ZM74.58 112l30.13 75.33L34.41 112Zm89.6 0L128 202.46L91.82 112ZM96 96l32-42.67L160 96Zm85.42 16h40.17l-70.3 75.33ZM75.63 48H112L76 96H33.63Z"}})])])]),e("div",[e("h2",{staticClass:"font-heading text-base font-semibold leading-tight text-muted-800 dark:text-white",domProps:{textContent:t._s(t.content.avg_bookings_count)}}),e("p",{staticClass:"font-alt text-sm font-normal leading-normal leading-normal"},[e("span",{staticClass:"text-muted-500 dark:text-muted-400",domProps:{textContent:t._s(t.$parent.__("AVG_daily_bookings_count"))}})])])]),e("div",{staticClass:"bg-gray-50 flex items-center gap-2 rounded-md p-4"},[e("div",{staticClass:"relative inline-flex shrink-0 items-center justify-center h-12 w-12 rounded-full bg-indigo-100 text-indigo-500 dark:border-2 dark:border-indigo-500 dark:bg-indigo-500/20 dark:text-indigo-400"},[e("svg",{staticClass:"icon h-5 w-5",attrs:{"data-v-cd102a71":"",xmlns:"http://www.w3.org/2000/svg","xmlns:xlink":"http://www.w3.org/1999/xlink","aria-hidden":"true",role:"img",width:"1em",height:"1em",viewBox:"0 0 256 256"}},[e("g",{attrs:{fill:"currentColor"}},[e("path",{attrs:{d:"M232 96H24l104-64Z",opacity:".2"}}),e("path",{attrs:{d:"M24 104h24v64H32a8 8 0 0 0 0 16h192a8 8 0 0 0 0-16h-16v-64h24a8 8 0 0 0 4.19-14.81l-104-64a8 8 0 0 0-8.38 0l-104 64A8 8 0 0 0 24 104Zm40 0h32v64H64Zm80 0v64h-32v-64Zm48 64h-32v-64h32ZM128 41.39L203.74 88H52.26ZM248 208a8 8 0 0 1-8 8H16a8 8 0 0 1 0-16h224a8 8 0 0 1 8 8Z"}})])])]),e("div",[e("h2",{staticClass:"font-heading text-base font-semibold leading-tight text-muted-800 dark:text-white",domProps:{textContent:t._s(t.content.avg_products_count)}}),e("p",{staticClass:"font-alt text-sm font-normal leading-normal leading-normal"},[e("span",{staticClass:"text-muted-500 dark:text-muted-400",domProps:{textContent:t._s(t.$parent.__("AVG_daily_products_sales"))}})])])])])]):t._e()},r=[],i={props:["content","setting"]},o=i,n=s("2877"),l=Object(n["a"])(o,a,r,!1,null,null,null);e["a"]=l.exports},b536:function(t,e,s){"use strict";var a=function(){var t=this,e=t._self._c;return e("div",{staticClass:"widget-item bg-white p-6 flex justify-between rounded-md"},[e("div",[e("h4",{staticClass:"text-xl font-semibold text-slate-700 mb-1 leading-none",domProps:{textContent:t._s(t.value)}}),e("p",{staticClass:"text-tiny leading-4",domProps:{textContent:t._s(t.title)}})]),e("div",[e("span",{staticClass:"text-lg text-purple-300 rounded-full flex items-center justify-center h-12 w-12 shrink-0",class:t.classes},[e("img",{staticClass:"mx-auto",attrs:{width:"25",height:"25",src:t.icon}})])])])},r=[],i={props:["title","value","classes","icon"]},o=i,n=s("2877"),l=Object(n["a"])(o,a,r,!1,null,null,null);e["a"]=l.exports}}]);
//# sourceMappingURL=chunk-2ae3d60b.chunk.js.map