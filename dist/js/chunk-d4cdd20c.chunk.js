(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-d4cdd20c","chunk-2d229846"],{de7f:function(t,e,s){"use strict";s.r(e);var i=function(){var t=this,e=t._self._c;return e("div",{staticClass:"action-buttons flex gap-6 gap text-base"},[t.data.not_editable?t._e():e("button",{staticClass:"hover:text-gray-600 text-purple",on:{click:function(e){return t.handleAction("edit")}}},[e("i",{staticClass:"fa fa-edit"})]),t.data.not_removeable?t._e():e("button",{staticClass:"hover:text-red-400 text-red-600",on:{click:function(e){return t.handleAction("delete")}}},[e("i",{staticClass:"fa fa-trash"})])])},a=[],n={name:"ActionButtons",methods:{handleAction:function(t){this.$root.$children[0].$refs.activeTab.handleAction(t,this.data)}},props:{data:{type:Object,required:!0}}},l=n,o=s("2877"),c=Object(o["a"])(l,i,a,!1,null,null,null);e["default"]=c.exports},e62b:function(t,e,s){"use strict";s.r(e);s("7f7f");var i=function(){var t=this,e=t._self._c;return e("div",{staticClass:"w-full flex overflow-auto",staticStyle:{height:"85vh","z-index":"9999"}},[t.content&&!t.showLoader?e("div",{staticClass:"w-full relative"},[e("maps",{key:t.locations,attrs:{waypoints:t.locations}}),e("div",{staticClass:"h-full absolute top-4 rounded-lg p-4 w-96 bg-white rounded-xl flex-col justify-start items-start inline-flex",staticStyle:{"max-height":"calc(100vh - 140px)"}},[e("div",{staticClass:"self-stretch p-10 flex-col justify-center items-start flex"},[e("div",{staticClass:"text-black text-lg font-semibold",domProps:{textContent:t._s(t.__("Trips"))}}),e("div",{staticClass:"py-2 self-stretch text-zinc-600 text-base tracking-wide",domProps:{textContent:t._s(t.__("Trips description"))}})]),e("div",{staticClass:"w-full self-stretch pt-2 flex-col justify-center items-start flex"},[e("input",{directives:[{name:"model",rawName:"v-model",value:t.searchText,expression:"searchText"}],staticClass:"w-full bg-gray-100 rounded-lg px-4 py-2",attrs:{placeholder:t.__("find by name and address")},domProps:{value:t.searchText},on:{change:t.searchTextChanged,input:[function(e){e.target.composing||(t.searchText=e.target.value)},t.searchTextChanged],keydown:t.searchTextChanged}})]),t.content.items?e("div",{staticClass:"max-h-[400px] overflow-auto my-4 w-full self-stretch p-10"},t._l(t.content.items,(function(s,i){return e("div",{key:s.active,staticClass:"w-full"},[t.showList&&s.active?e("div",{staticClass:"mb-4 w-full rounded-lg justify-start items-center inline-flex",class:s.selected?"text-fuchsia-600":"bg-gray-50"},[s.vehicle?e("div",{staticClass:"w-full grow shrink basis-0 px-6 py-4 flex-col justify-center items-start gap-4 inline-flex"},[e("div",{staticClass:"w-full self-stretch justify-start items-start inline-flex cursor-pointer"},[e("div",{staticClass:"w-full grow shrink basis-0 justify-start items-start flex gap-4",on:{click:function(e){return t.setLocationsMarkers(s,i)}}},[e("img",{staticClass:"w-10 h-10",attrs:{src:s.driver.picture}}),s.driver.name?e("div",{staticClass:"self-stretch text-base font-semibold tracking-tight",class:s.selected?"text-fuchsia-600":"text-gray-800"},[e("span",{domProps:{textContent:t._s(s.driver.name)}}),e("div",{staticClass:"self-stretch text-slate-500 text-base font-normal"},[e("i",{staticClass:"fa fa-car"}),s.vehicle?e("span",{staticClass:"font-semibold text-sm px-2",domProps:{textContent:t._s(s.vehicle.plate_number)}}):t._e()])]):t._e()]),e("div",{staticClass:"gap-2 py-2 flex justify-start items-start gap-2.5 inline-flex"},[e("div",{staticClass:"px-3 py-2 bg-primary rounded-full justify-center items-center flex cursor-pointer",on:{click:function(e){return t.setLocationsMarkers(s,i)}}},[t._m(0,!0)]),e("div",{staticClass:"px-3 py-2 bg-purple-800 rounded justify-center items-center flex cursor-pointer",on:{click:function(e){return t.handleAction("edit",s)}}},[t._m(1,!0)])])]),e("hr",{staticClass:"w-full"}),e("div",{staticClass:"w-full relative flex"},[e("div",{staticClass:"w-full relative"},[e("h3",{staticClass:"py-2 text-base mb-10",domProps:{textContent:t._s(t.__("Waiting pickups"))}}),t._l(t.filterLocations(s.pickup_locations,"waiting"),(function(s,i){return"waiting"==s.status?e("img",{staticClass:"rounded-full w-8 h-8 left-0 bottom-1 absolute rounded-[50px] border-2 border-purple-800",style:("en"==t.lang.lang?"left: ":"right: ")+20*i+"px",attrs:{src:s&&s.location&&s.location.picture?s.location.picture:"https://via.placeholder.com/37x37"}}):t._e()})),e("span",{staticClass:"bottom-2 absolute pt-2",style:("en"==t.lang.lang?"left: ":"right: ")+(20*s.pickup_locations.length+20)+"px"},[e("i",{staticClass:"fa fa-location-dot text-sm"}),s.pickup_locations?e("span",{staticClass:"font-semibold px-1",domProps:{textContent:t._s(s.pickup_locations.length)}}):t._e()])],2),e("div",{staticClass:"w-full relative"},[e("h3",{staticClass:"py-2 text-base mb-10",domProps:{textContent:t._s(t.__("Active pickups"))}}),t._l(t.filterLocations(s.pickup_locations,"moving"),(function(s,i){return"moving"==s.status?e("img",{staticClass:"rounded-full w-8 h-8 left-0 bottom-1 absolute rounded-[50px] border-2 border-purple-800",style:("en"==t.lang.lang?"left: ":"right: ")+20*i+"px",attrs:{src:s&&s.location&&s.location.picture?s.location.picture:"https://via.placeholder.com/37x37"}}):t._e()})),e("span",{staticClass:"bottom-2 absolute pt-2",style:("en"==t.lang.lang?"left: ":"right: ")+(20*s.pickup_locations.length+20)+"px"},[e("i",{staticClass:"fa fa-location-dot text-sm"}),s.pickup_locations?e("span",{staticClass:"font-semibold px-1",domProps:{textContent:t._s(s.pickup_locations.length)}}):t._e()])],2)])]):t._e()]):t._e()])})),0):t._e(),e("div",{staticClass:"self-stretch grow shrink basis-0 p-[25px] bg-neutral-50 justify-between items-center inline-flex"},[e("div",{staticClass:"bg-fuchsia-600 rounded-lg text-white text-xs font-medium px-3 py-2 uppercase cursor-pointer",domProps:{textContent:t._s(t.__("add new"))},on:{click:function(e){t.showLoader=!0,t.showAddSide=!0,t.activeItem={},t.showLoader=!1}}})])]),e("hr",{staticClass:"mt-2"}),t.content&&!t.showLoader?e("main",{staticClass:"flex-1 overflow-x-hidden overflow-y-auto w-full"},[e("div",{staticClass:"px-4 mb-6 py-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 flex w-full"},[e("h1",{staticClass:"font-bold text-lg w-full",domProps:{textContent:t._s(t.content.title)}}),e("a",{staticClass:"uppercase p-2 mx-2 text-center text-white w-32 rounded bg-gradient-purple hover:bg-red-800",attrs:{href:"javascript:;"},on:{click:function(e){t.showLoader=!0,t.showAddSide=!0,t.activeItem={},t.showLoader=!1}}},[t._v(t._s(t.__("add_new")))])]),e("hr",{staticClass:"mt-2"}),e("div",{staticClass:"w-full flex gap gap-6"},[e("data-table",t._b({ref:"devices_orders",on:{actionTriggered:t.handleAction}},"data-table",t.bindings,!1)),t.showAddSide&&t.content&&t.content.fillable?e("side-form-create",{staticClass:"col-md-3",attrs:{conf:t.conf,model:"Trip.create",columns:t.content.fillable}}):t._e(),t.showEditSide&&!t.showAddSide?e("side-form-update",{staticClass:"col-md-3",attrs:{conf:t.conf,model:"Trip.update",item:t.activeItem,model_id:t.activeItem.trip_id,index:"trip_id",columns:t.content.fillable}}):t._e()],1)]):t._e()],1):t._e()])},a=[function(){var t=this,e=t._self._c;return e("div",{staticClass:"text-center text-xs text-white uppercase tracking-tight"},[e("i",{staticClass:"fa fa-location-dot"})])},function(){var t=this,e=t._self._c;return e("div",{staticClass:"text-center text-xs text-white uppercase tracking-tight"},[e("i",{staticClass:"fa fa-edit"})])}],n=(s("ac6a"),s("456d"),s("6762"),s("2fdb"),s("de7f")),l={components:{dataTableActions:n["default"]},name:"Trips",data:function(){return{url:this.conf.url+this.path+"?load=json",content:{title:"",items:[],columns:[]},activeItem:{},showAddSide:!1,showEditSide:!1,showLoader:!0,locations:[],showList:!0,searchText:""}},computed:{bindings:function(){return this.content.columns.push({key:this.__("actions"),component:n["default"],sortable:!1}),{columns:this.content.columns,fillable:this.content.fillable,data:this.content.items}}},props:["path","lang","setting","conf","auth"],mounted:function(){this.load(),console.log(this.lang)},methods:{filterLocations:function(t,e){for(var s=[],i=0;i<t.length;i++)t[i].status==e&&s.push(t[i]);return s},searchTextChanged:function(){this.showList=!1;for(var t=0;t<this.content.items.length;t++)this.content.items[t].active=this.searchText.trim()?this.checkSimilar(this.content.items[t]):1;this.showList=!0},checkSimilar:function(t){var e=!!t.driver.name.toLowerCase().includes(this.searchText.toLowerCase());return e||!!t.vehicle.plate_number.toLowerCase().includes(this.searchText.toLowerCase())},setLocationsMarkers:function(t,e){for(var s=0;s<this.content.items.length;s++)this.content.items[s].selected=!1;this.content.items[e].selected=!0,this.locations=this.setLocationsPickups(t)},setLocationsPickups:function(t){for(var e,s=[],i=0;i<t.pickup_locations.length;i++)e=t.pickup_locations[i].location,s[i]={icon:this.conf.url+"uploads/images/blue_pin.gif",origin:{lat:parseFloat(e.latitude),lng:parseFloat(e.longitude)},destination:{lat:parseFloat(e.latitude),lng:parseFloat(e.longitude)}};return s[s.length]={icon:this.conf.url+"uploads/images/car.svg",origin:{lat:parseFloat(t.vehicle.last_latitude),lng:parseFloat(t.vehicle.last_longitude)},destination:{lat:parseFloat(t.vehicle.last_latitude),lng:parseFloat(t.vehicle.last_longitude)}},s},handleAction:function(t,e){switch(t){case"view":break;case"edit":this.showEditSide=!0,this.showAddSide=!1,this.activeItem=e;break;case"delete":this.$parent.deleteByKey("vehicle_id",e.vehicle_id,"Vehicle.delete");break}},load:function(){var t=this;this.showLoader=!0,this.$parent.handleGetRequest(this.url).then((function(e){t.setValues(e),t.showLoader=!1,t.searchTextChanged()}))},filterKeys:function(t){var e=Object.keys(t).reduce((function(e,s){return t[s]&&(e[s]=t[s]),e}),{});return e},setValues:function(t){return this.content=JSON.parse(JSON.stringify(t)),this},__:function(t){return this.$root.$children[0].__(t)}}},o=l,c=s("2877"),r=Object(c["a"])(o,i,a,!1,null,null,null);e["default"]=r.exports}}]);
//# sourceMappingURL=chunk-d4cdd20c.chunk.js.map