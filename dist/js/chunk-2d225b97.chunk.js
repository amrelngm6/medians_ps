(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2d225b97"],{e62b:function(t,e,s){"use strict";s.r(e);s("7f7f");var i=function(){var t=this,e=t._self._c;return e("div",{staticClass:"w-full flex overflow-auto",staticStyle:{height:"85vh","z-index":"9999"}},[t.showTrip?e("div",{staticClass:"w-full relative"},[e("trip_page",{attrs:{trip:t.activeItem},on:{close:t.callback}})],1):t._e(),t.content&&!t.showTrip?e("div",{staticClass:"w-full relative"},[e("maps",{key:t.locations,attrs:{conf:t.conf,center:t.locations.length>0?t.locations[0].destination:{lat:0,lng:0},showroute:!1,waypoints:t.locations},on:{"click-marker":t.clickMarker,"update-marker":t.updateMarker,"interval-callback":t.callback}}),e("div",{staticClass:"h-full absolute top-4 rounded-lg p-4 bg-white rounded-xl flex-col justify-start items-start inline-flex",staticStyle:{"max-height":"calc(100vh - 140px)"}},[e("div",{staticClass:"self-stretch py-4 flex-col justify-center items-start flex"},[e("div",{staticClass:"text-black text-lg font-semibold",domProps:{textContent:t._s(t.__("Trips"))}}),e("div",{staticClass:"py-2 self-stretch text-zinc-600 text-base tracking-wide",domProps:{textContent:t._s(t.__("Trips description"))}})]),e("div",{staticClass:"w-full self-stretch pt-2 flex-col justify-center items-start flex"},[e("input",{directives:[{name:"model",rawName:"v-model",value:t.searchText,expression:"searchText"}],staticClass:"w-full bg-gray-100 rounded-lg px-4 py-2",attrs:{placeholder:t.__("find by name and address")},domProps:{value:t.searchText},on:{change:t.searchTextChanged,input:[function(e){e.target.composing||(t.searchText=e.target.value)},t.searchTextChanged],keydown:t.searchTextChanged}})]),t.content.items?e("div",{staticClass:"max-h-[400px] overflow-auto my-4 w-full self-stretch py-4"},t._l(t.content.items,(function(s,i){return e("div",{key:s.active,staticClass:"w-full"},[t.showList&&s.active&&"Scheduled"==s.trip_status?e("div",{staticClass:"mb-4 w-full rounded-lg justify-start items-center inline-flex",class:s.selected?"text-gray-600":"bg-gray-50"},[s.vehicle?e("div",{staticClass:"w-full grow shrink basis-0 px-6 py-4 flex-col justify-center items-start gap-4 inline-flex"},[e("div",{staticClass:"w-full self-stretch justify-start items-start inline-flex cursor-pointer"},[e("div",{staticClass:"w-full grow shrink basis-0 justify-start items-start flex gap-4",on:{click:function(e){return t.setLocationsMarkers(s,i)}}},[e("img",{staticClass:"w-10 h-10",attrs:{src:s.driver.picture}}),s.driver.name?e("div",{staticClass:"self-stretch text-base font-semibold tracking-tight",class:s.selected?"text-purple-600":"text-gray-800"},[e("span",{domProps:{textContent:t._s(s.driver.name)}}),e("div",{staticClass:"self-stretch text-slate-500 text-base font-normal"},[e("i",{staticClass:"fa fa-car"}),s.vehicle?e("span",{staticClass:"font-semibold text-sm px-2",domProps:{textContent:t._s(s.vehicle.plate_number)}}):t._e()]),e("div",{staticClass:"self-stretch text-slate-500 text-sm text-muted"},[e("i",{staticClass:"fa fa-map-location"}),s.route?e("span",{staticClass:"font-semibold text-sm px-2",domProps:{textContent:t._s(s.route.route_name)}}):t._e()])]):t._e()]),e("div",{staticClass:"gap-2 py-2 flex justify-start items-start gap-2.5 inline-flex"},[e("div",{staticClass:"px-3 py-2 bg-primary rounded-full justify-center items-center flex cursor-pointer",on:{click:function(e){return t.setLocationsMarkers(s,i)}}},[t._m(0,!0)])])]),e("hr",{staticClass:"w-full"}),e("div",{staticClass:"w-full relative flex"},[e("div",{staticClass:"w-full relative"},[e("h3",{staticClass:"py-2 text-sm mb-10",domProps:{textContent:t._s(t.__("Waiting pickups"))}}),t._l(t.filterLocations(s.pickup_locations,"waiting"),(function(s,i){return"waiting"==s.status?e("img",{staticClass:"rounded-full w-8 h-8 left-0 bottom-1 absolute rounded-[50px] border-2 border-purple-800",style:("en"==t.lang.lang?"left: ":"right: ")+20*i+"px",attrs:{src:s&&s.location&&s.location.picture?s.location.picture:"https://via.placeholder.com/37x37"}}):t._e()})),e("span",{staticClass:"bottom-2 absolute pt-2",style:("en"==t.lang.lang?"left: ":"right: ")+(20*s.waiting_locations.length+20)+"px"},[e("i",{staticClass:"fa fa-location-dot text-sm"}),s.pickup_locations?e("span",{staticClass:"font-semibold px-1",domProps:{textContent:t._s(s.waiting_locations.length)}}):t._e()])],2),e("div",{staticClass:"w-full relative"},[e("h3",{staticClass:"py-2 text-sm mb-10",domProps:{textContent:t._s(t.__("Active pickups"))}}),t._l(t.filterLocations(s.pickup_locations,"moving"),(function(s,i){return"moving"==s.status?e("img",{staticClass:"rounded-full w-8 h-8 left-0 bottom-1 absolute rounded-[50px] border-2 border-purple-800",style:("en"==t.lang.lang?"left: ":"right: ")+20*i+"px",attrs:{src:s&&s.location&&s.location.picture?s.location.picture:"https://via.placeholder.com/37x37"}}):t._e()})),e("span",{staticClass:"bottom-2 absolute pt-2",style:("en"==t.lang.lang?"left: ":"right: ")+(20*s.moving_locations_count+20)+"px"},[e("i",{staticClass:"fa fa-location-dot text-sm"}),s.pickup_locations?e("span",{staticClass:"font-semibold px-1",domProps:{textContent:t._s(s.moving_locations_count)}}):t._e()])],2)])]):t._e()]):t._e()])})),0):t._e()]),e("hr",{staticClass:"mt-2"}),t.content?e("main",{key:t.content.items,staticClass:"flex-1 overflow-x-hidden overflow-y-auto w-full"},[e("div",{staticClass:"px-4 mb-6 py-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 flex w-full"},[e("h1",{staticClass:"font-bold text-lg w-full",domProps:{textContent:t._s(t.content.title)}})]),e("hr",{staticClass:"mt-2"}),e("div",{staticClass:"w-full flex gap gap-6"},[e("data-table",t._b({ref:"devices_orders",on:{actionTriggered:t.handleAction}},"data-table",t.bindings,!1))],1)]):t._e()],1):t._e()])},a=[function(){var t=this,e=t._self._c;return e("div",{staticClass:"text-center text-xs text-white uppercase tracking-tight"},[e("i",{staticClass:"fa fa-location-dot"})])}],n=(s("ac6a"),s("456d"),s("6762"),s("2fdb"),function(){var t=this,e=t._self._c;return e("div",{staticClass:"action-buttons flex gap-6 gap text-base"},[e("a",{staticClass:"text-gray-400 hover:text-gray-100 mx-2",attrs:{href:"javascript:;"},on:{click:function(e){return t.handleAction()}}},[e("i",{staticClass:"material-icons-outlined text-base"},[t._v("edit")])])])}),l=[],o={name:"ActionButtons",methods:{handleAction:function(){this.$root.$children[0].$refs.activeTab.editFields(this.data)}},props:{data:{type:Object,required:!0}}},c=o,r=s("2877"),u=Object(r["a"])(c,n,l,!1,null,null,null),d=u.exports,p={components:{dataTableSideActions:d},name:"Trips",data:function(){return{url:this.conf.url+this.path+"?load=json",content:{title:"",items:[],columns:[]},activeItem:{},activeTrip:null,showAddSide:!1,showEditSide:!1,showLoader:!0,locations:[],showList:!0,showMap:!0,showTrip:!1,searchText:""}},computed:{bindings:function(){return this.content.columns.push({key:this.__("actions"),component:d,sortable:!1}),{columns:this.content.columns,fillable:this.content.fillable,data:this.content.items}}},props:["path","lang","setting","conf","auth"],mounted:function(){this.load(),setInterval((function(){}),1e4)},methods:{editFields:function(t){var e=!(arguments.length>1&&void 0!==arguments[1])||arguments[1];this.showTrip=e,this.activeItem=t},callback:function(){console.log(this.locations)},filterLocations:function(t,e){for(var s=[],i=0;i<t.length;i++)t[i].status==e&&s.push(t[i]);return s},searchTextChanged:function(){this.showList=!1;for(var t=0;t<this.content.items.length;t++)this.content.items[t].active=this.searchText.trim()?this.checkSimilar(this.content.items[t]):1;this.showList=!0},checkSimilar:function(t){var e=!!t.driver.name.toLowerCase().includes(this.searchText.toLowerCase());return e||!!t.vehicle.plate_number.toLowerCase().includes(this.searchText.toLowerCase())},setLocationsMarkers:function(t,e){for(var s=0;s<this.content.items.length;s++)this.content.items[s].selected=!1;this.content.items[e].selected=!0,this.locations=this.setLocationsPickups(t)},clickMarker:function(t,e){},updateMarker:function(t,e){var s=this,i=new URLSearchParams;i.append("type","Vehicle.update"),i.append("params[vehicle_id]",this.activeTrip.vehicle_id),i.append("params[last_latitude]",t.destination.lat),i.append("params[last_longitude]",t.destination.lng),this.$parent.handleRequest(i,"/api/update").then((function(t){s.$alert(t.result)}))},setLocationsPickups:function(t){var e,s;this.activeTrip=t,this.locations=[],this.locations[this.locations.length]={drag:!0,status:"waiting",icon:this.conf.url+"uploads/images/car.svg",origin:{lat:parseFloat(t.vehicle.last_latitude),lng:parseFloat(t.vehicle.last_longitude)},destination:{lat:parseFloat(t.vehicle.last_latitude),lng:parseFloat(t.vehicle.last_longitude)}};for(var i=0;i<t.pickup_locations.length;i++)e=t.pickup_locations[i].location,s=i?t.pickup_locations[i-1].location:t.pickup_locations[i].location,this.locations[i+1]={status:t.pickup_locations[i].status,icon:this.conf.url+"uploads/images/"+("waiting"==t.pickup_locations[i].status?"blue_pin.gif":"yellow_pin.gif"),origin:{lat:parseFloat(s.latitude),lng:parseFloat(s.longitude)},destination:{lat:parseFloat(e.latitude),lng:parseFloat(e.longitude)}};return this.locations[this.locations.length]={drag:!0,icon:this.conf.url+"uploads/images/destination.svg",origin:{lat:0,lng:0},destination:{lat:parseFloat(t.route.latitude),lng:parseFloat(t.route.longitude)}},this.showMap=!this.showMap,this.locations},handleAction:function(t,e){switch(t){case"view":break;case"edit":this.showEditSide=!0,this.showAddSide=!1,this.activeItem=e;break;case"delete":this.$parent.deleteByKey("vehicle_id",e.vehicle_id,"Vehicle.delete");break}},load:function(){var t=this;this.$parent.handleGetRequest(this.url).then((function(e){t.setValues(e),t.searchTextChanged()}))},filterKeys:function(t){var e=Object.keys(t).reduce((function(e,s){return t[s]&&(e[s]=t[s]),e}),{});return e},setValues:function(t){if(this.content=JSON.parse(JSON.stringify(t)),this.activeTrip)for(var e=0;e<this.content.items.length;e++){var s=this.content.items[e];s.trip_id==this.activeTrip.trip_id&&this.setLocationsPickups(s)}return this},__:function(t){return this.$root.$children[0].__(t)}}},h=p,f=Object(r["a"])(h,i,a,!1,null,null,null);e["default"]=f.exports}}]);
//# sourceMappingURL=chunk-2d225b97.chunk.js.map