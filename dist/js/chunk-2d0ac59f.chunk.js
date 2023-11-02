(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2d0ac59f"],{"18bd":function(t,s,e){"use strict";e.r(s);e("7f7f");var a=function(){var t=this,s=t._self._c;return s("div",{staticClass:"w-full"},[t.showLoader?t._e():s("div",{staticClass:"grid xl:grid-cols-12 lg:grid-cols-12 grid-cols-1 gap-6"},[s("div",{staticClass:"xl:col-span-3 lg:col-span-5"},[s("div",{staticClass:"card px-4 py-6 mb-6"},[s("div",{staticClass:"text-center"},[s("img",{staticClass:"rounded-full p-1 bg-gray-100 dark:bg-gray-700 mx-auto",attrs:{src:t.activeItem.picture,alt:""}}),s("h4",{staticClass:"mb-1 mt-3 text-lg dark:text-gray-300",domProps:{textContent:t._s(t.activeItem.name)}}),s("p",{staticClass:"text-gray-400 mb-4 dark:text-gray-400",domProps:{textContent:t._s(t.activeItem.email)}}),s("button",{staticClass:"btn bg-primary/90 hover:bg-primary rounded btn-sm text-white mb-3",attrs:{type:"button"},domProps:{textContent:t._s(t.__("Edit"))}})]),s("hr",{staticClass:"mt-5 dark:border-gray-600"}),s("div",{staticClass:"text-start mt-6"},[s("div",{staticClass:"space-y-7"},[s("p",{staticClass:"text-zinc-400 dark:text-gray-400 flex gap-4"},[s("strong",{domProps:{textContent:t._s(t.__("First name"))}}),s("span",{staticClass:"ms-2",domProps:{textContent:t._s(t.activeItem.first_name)}})]),s("p",{staticClass:"text-zinc-400 dark:text-gray-400 flex gap-4"},[s("strong",{domProps:{textContent:t._s(t.__("Last name"))}}),s("span",{staticClass:"ms-2",domProps:{textContent:t._s(t.activeItem.last_name)}})]),s("p",{staticClass:"text-zinc-400 dark:text-gray-400 flex gap-4"},[s("strong",{domProps:{textContent:t._s(t.__("Email"))}}),s("span",{staticClass:"ms-2",domProps:{textContent:t._s(t.activeItem.email)}})]),s("p",{staticClass:"text-zinc-400 dark:text-gray-400 flex gap-4"},[s("strong",{domProps:{textContent:t._s(t.__("Phone"))}}),s("span",{staticClass:"ms-2",domProps:{textContent:t._s(t.activeItem.contact_number)}})]),s("p",{staticClass:"text-zinc-400 dark:text-gray-400 flex gap-4"},[s("strong",{domProps:{textContent:t._s(t.__("License number"))}}),s("span",{staticClass:"ms-2",domProps:{textContent:t._s(t.activeItem.driver_license_number)}})]),s("p",{staticClass:"text-zinc-400 dark:text-gray-400 flex gap-4 items-start"},[s("strong",{staticClass:"flex-shrink",domProps:{textContent:t._s(t.__("address"))}}),s("span",{staticClass:"ms-2",domProps:{textContent:t._s(t.activeItem.address)}})])])]),s("hr",{staticClass:"my-5 dark:border-gray-600"})])]),s("div",{staticClass:"xl:col-span-9 lg:col-span-7"},[s("div",{staticClass:"card"},[s("div",{staticClass:"p-6"},[t._m(0),s("div",{staticClass:"pt-5"},[s("nav",{staticClass:"lg:flex items-center justify-around rounded-xl space-x-3 bg-gray-100 p-2 dark:bg-gray-900/30",attrs:{"aria-label":"Tabs",role:"tablist"}},[s("button",{staticClass:"hover:bg-white hs-tab-active:font-semibold hs-tab-active:bg-white dark:hs-tab-active:bg-gray-700 w-full flex justify-center py-2 rounded items-center gap-2 border-b-2 border-transparent -mb-px transition-all text-sm whitespace-nowrap text-gray-500 dark:text-white active",class:"info"==t.activeStatus?"bg-white":"",attrs:{type:"button"},on:{click:function(s){return t.setActiveStatus("info")}}},[t._v("\n                                        Info\n                                    ")]),s("button",{staticClass:"hover:bg-white hs-tab-active:font-semibold hs-tab-active:bg-white dark:hs-tab-active:bg-gray-700 w-full flex justify-center py-2 rounded items-center gap-2 border-b-2 border-transparent -mb-px transition-all text-sm whitespace-nowrap text-gray-500 dark:text-white",class:"trips"==t.activeStatus?"bg-white":"",attrs:{type:"button"},on:{click:function(s){return t.setActiveStatus("trips")}}},[t._v("\n                                        Trips\n                                    ")]),s("button",{staticClass:"hover:bg-white hs-tab-active:font-semibold hs-tab-active:bg-white dark:hs-tab-active:bg-gray-700 w-full flex justify-center py-2 rounded items-center gap-2 border-b-2 border-transparent -mb-px transition-all text-sm whitespace-nowrap text-gray-500 dark:text-white",attrs:{type:"button"}},[t._v("\n                                        Tasks\n                                    ")]),s("button",{staticClass:"hover:bg-white hs-tab-active:font-semibold hs-tab-active:bg-white dark:hs-tab-active:bg-gray-700 w-full flex justify-center py-2 rounded items-center gap-2 border-b-2 border-transparent -mb-px transition-all text-sm whitespace-nowrap text-gray-500 dark:text-white",attrs:{type:"button"}},[t._v("\n                                        Files\n                                    ")])]),s("div",{staticClass:"mt-3 overflow-hidden"},[s("div",{staticClass:"transition-all duration-300 transform",attrs:{id:"basic-tabs-1",role:"tabpanel","aria-labelledby":"basic-tabs-item-1"}},[t.activeItem.last_trips?s("div",{staticClass:"space-y-7"},t._l(t.activeItem.last_trips,(function(e,a){return a<=t.limitCount?s("div",{staticClass:"relative overflow-hidden border-b-1 border-gray-100"},[s("div",{staticClass:"absolute border-s-2 border border-gray-300 h-full top-20 start-10 -z-10 dark:border-white/10"}),s("div",{staticClass:"md:text-start mb-5 mt-5"},[s("h5",{staticClass:"bg-white dark:bg-gray-700 dark:text-gray-300 inline rounded",domProps:{textContent:t._s(t.__("Trip number")+" #"+e.trip_id)}}),s("p",{staticClass:"text-muted text-sm",domProps:{textContent:t._s(e.trip_date)}})]),t._l(e.pickup_locations,(function(e){return s("div",{staticClass:"space-y-4"},[s("div",{staticClass:"text-start"},[s("div",{staticClass:"absolute start-7 mt-6"},[s("div",{staticClass:"relative"},[s("div",{staticClass:"w-8 h-8 flex justify-center items-center rounded-full bg-white text-info dark:bg-gray-800"},[s("img",{staticClass:"rounded-full",attrs:{src:e.model.picture,alt:""}})]),s("div",{staticClass:"absolute top-4 -end-6 w-12 h-[2px] bg-gray-400 -z-10"})])]),s("div",{staticClass:"grid grid-cols-1"},[s("div",{staticClass:"md:col-start-1 col-span-2"},[s("div",{staticClass:"flex md:flex-nowrap flex-wrap items-center gap-6 ms-10 md:mt-0 mt-5"},[s("div",{staticClass:"ms-10"},[s("h2",{staticClass:"p-2 rounded bg-gradient-to-r text-primary flex items-center justify-center text-sm ml-16",domProps:{textContent:t._s(e.boarding_time)}})]),s("div",{staticClass:"relative me-5 md:ps-0 ps-10"},[s("div",{staticClass:"pt-3"},[e.model?s("h4",{staticClass:"mb-1.5 text-base dark:text-gray-300",domProps:{textContent:t._s(e.model.name)}}):t._e(),e.location?s("p",{staticClass:"mb-4 text-gray-500 dark:text-gray-400",domProps:{textContent:t._s(e.location.address)}}):t._e()])])])])])])])}))],2):t._e()})),0):t._e()])])])])]),t.showLoadMore?s("p",{staticClass:"text-center"},[s("span",{staticClass:"mx-auto menu-dark px-4 py-3 rounded-xl text-white cursor-pointer text-white rounded-lg",domProps:{textContent:t._s(t.__("Load more"))},on:{click:function(s){return t.loadmore()}}})]):t._e()])])])},i=[function(){var t=this,s=t._self._c;return s("div",{staticClass:"flex justify-between items-center"},[s("h4",{staticClass:"uppercase mb-1 dark:text-gray-300"},[t._v("Nav Pills")])])}],r={data:function(){return{content:{items:[]},activeItem:{},showAddSide:!1,showEditSide:!1,showLoader:!1,showLoadMore:!0,limitCount:3,activeStatus:"info"}},props:["path","lang","setting","conf","auth","item"],mounted:function(){this.activeItem=this.item,console.log(this.activeItem)},methods:{loadmore:function(){this.showLoader=!0,this.limitCount+=5,this.limitCount>this.activeItem.last_trips.length&&(this.showLoadMore=!1),this.showLoader=!1},setActiveStatus:function(t){this.showLoader=!0,this.activeStatus=t,this.showLoader=!1},handleAction:function(t,s){switch(t){case"view":break;case"edit":this.showEditSide=!0,this.showAddSide=!1,this.activeItem=s;break;case"delete":this.$root.$children[0].deleteByKey("driver_id",s,"Driver.delete");break}},load:function(){var t=this;this.showLoader=!0,this.$root.$children[0].handleGetRequest(this.url).then((function(s){t.setValues(s),t.showLoader=!1}))},setValues:function(t){return this.content=JSON.parse(JSON.stringify(t)),this},__:function(t){return this.$root.$children[0].__(t)}}},n=r,o=e("2877"),l=Object(o["a"])(n,a,i,!1,null,null,null);s["default"]=l.exports}}]);
//# sourceMappingURL=chunk-2d0ac59f.chunk.js.map