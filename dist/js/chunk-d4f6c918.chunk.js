(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-d4f6c918","chunk-2d229846"],{8498:function(t,e,s){"use strict";s.r(e);var i=function(){var t=this,e=t._self._c;return e("div",{staticClass:"w-full flex overflow-auto",staticStyle:{height:"85vh","z-index":"9999"}},[e("div",{staticClass:"w-full"},[t.content&&!t.showLoader?e("main",{staticClass:"relative flex-1 overflow-x-hidden overflow-y-auto w-full"},[t.locations.length?e("maps",{key:t.locations,attrs:{waypoints:t.locations},on:{"update-marker":t.updatedLocation,"click-marker":t.updatedLocation}}):t._e(),e("div",{staticClass:"h-full absolute top-4 rounded-lg p-4 w-96 bg-white rounded-xl flex-col justify-start items-start inline-flex",staticStyle:{"max-height":"calc(100vh - 140px)"}},[e("div",{staticClass:"self-stretch p-10 flex-col justify-center items-start flex"},[e("div",{staticClass:"text-black text-lg font-semibold",domProps:{textContent:t._s(t.__("Pickup locations"))}}),e("div",{staticClass:"py-2 self-stretch text-zinc-600 text-base tracking-wide",domProps:{textContent:t._s(t.__("Pickup locations description"))}})]),e("div",{staticClass:"max-h-[400px] overflow-auto my-4 w-full self-stretch p-10"},t._l(t.content.items,(function(s){return e("div",{staticClass:"w-full self-stretch justify-start items-center inline-flex py-1"},[e("div",{staticClass:"grow shrink basis-0 gap-4 justify-start items-center flex"},[t._m(0,!0),e("div",{staticClass:"grow shrink basis-0 flex-col justify-center items-start gap-[3px] inline-flex cursor-pointer",on:{click:function(e){return t.setLocationsMarkers(s)}}},[e("div",{staticClass:"text-black font-semibold text-base",domProps:{textContent:t._s(s.student_name)}}),e("div",{staticClass:"self-stretch text-slate-500 text-sm font-normal",domProps:{textContent:t._s(s.location_name+" - "+s.address)}})])]),e("div",{staticClass:"justify-center items-center flex"},[e("div",{staticClass:"px-3 py-2 bg-fuchsia-600 rounded justify-center items-center flex mr-2 cursor-pointer",on:{click:function(e){return t.handleAction("edit",s)}}},[t._m(1,!0)])])])})),0),e("div",{staticClass:"self-stretch grow shrink basis-0 p-[25px] bg-neutral-50 justify-between items-center inline-flex"},[e("div",{staticClass:"bg-fuchsia-600 rounded-lg text-white text-xs font-medium px-3 py-2 uppercase cursor-pointer",on:{click:function(e){t.showAddSide=!0}}},[t._v("Add new student")])])]),e("div",{staticClass:"px-4 mb-6 py-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 flex w-full"},[e("h1",{staticClass:"font-bold text-lg w-full",domProps:{textContent:t._s(t.content.title)}}),e("a",{staticClass:"uppercase p-2 mx-2 text-center text-white w-32 rounded bg-gradient-purple hover:bg-red-800",attrs:{href:"javascript:;"},on:{click:function(e){t.showLoader=!0,t.showAddSide=!0,t.activeItem={},t.showLoader=!1}}},[t._v(t._s(t.__("add_new")))])]),e("hr",{staticClass:"mt-2"}),e("div",{staticClass:"w-full flex gap gap-6"},[e("data-table",t._b({ref:"devices_orders",on:{actionTriggered:t.handleAction}},"data-table",t.bindings,!1)),t.showAddSide&&t.content&&t.content.fillable?e("side-form-create",{staticClass:"col-md-3",attrs:{conf:t.conf,model:"PickupLocation.create",columns:t.content.fillable}}):t._e(),t.showEditSide&&!t.showAddSide?e("side-form-update",{staticClass:"col-md-3",attrs:{conf:t.conf,model:"PickupLocation.update",item:t.activeItem,model_id:t.activeItem.pickup_id,index:"pickup_id",columns:t.content.fillable}}):t._e()],1)],1):t._e()])])},n=[function(){var t=this,e=t._self._c;return e("div",{staticClass:"justify-start items-center flex"},[e("img",{staticClass:"w-10 h-10 rounded-full shadow-inner border-2 border-black",attrs:{src:"https://via.placeholder.com/60x60"}})])},function(){var t=this,e=t._self._c;return e("div",{staticClass:"text-center text-xs text-white uppercase tracking-tight"},[e("i",{staticClass:"fa fa-edit"})])}],a=s("de7f"),o={components:{dataTableActions:a["default"]},name:"Locations",data:function(){return{url:this.conf.url+this.path+"?load=json",content:{title:"",items:[],columns:[]},locations:[],activeItem:{},showAddSide:!1,showEditSide:!1,showLoader:!0}},computed:{bindings:function(){return this.content.columns.push({key:this.__("actions"),component:a["default"],sortable:!1}),{columns:this.content.columns,fillable:this.content.fillable,data:this.content.items}}},props:["path","lang","setting","conf","auth"],mounted:function(){this.load()},methods:{updatedLocation:function(t,e){t.latitude=t.destination.lat,t.longitude=t.destination.lng,this.handleAction("edit",t),console.log(t)},setLocationsMarkers:function(t){this.locations=[this.handleObject(t)]},handleAction:function(t,e){switch(t){case"view":break;case"edit":this.showEditSide=!0,this.showAddSide=!1,this.activeItem=e;break;case"delete":this.$parent.deleteByKey("vehicle_id",e.vehicle_id,"Vehicle.delete");break}},load:function(){var t=this;this.showLoader=!0,this.$parent.handleGetRequest(this.url).then((function(e){t.setValues(e),t.showLoader=!1}))},setValues:function(t){this.content=JSON.parse(JSON.stringify(t));for(var e=0;e<this.content.items.length;e++)this.locations[e]=this.handleObject(this.content.items[e]);return this},handleObject:function(t){return t.icon=this.conf.url+"uploads/images/blue_pin.gif",t.origin=t.destination={lat:parseFloat(t.latitude),lng:parseFloat(t.longitude)},t},__:function(t){return this.$root.$children[0].__(t)}}},l=o,c=s("2877"),r=Object(c["a"])(l,i,n,!1,null,null,null);e["default"]=r.exports},de7f:function(t,e,s){"use strict";s.r(e);var i=function(){var t=this,e=t._self._c;return e("div",{staticClass:"action-buttons flex gap-6 gap text-base"},[t.data.not_editable?t._e():e("button",{staticClass:"hover:text-gray-600 text-purple",on:{click:function(e){return t.handleAction("edit")}}},[e("i",{staticClass:"fa fa-edit"})]),t.data.not_removeable?t._e():e("button",{staticClass:"hover:text-red-400 text-red-600",on:{click:function(e){return t.handleAction("delete")}}},[e("i",{staticClass:"fa fa-trash"})])])},n=[],a={name:"ActionButtons",methods:{handleAction:function(t){this.$root.$children[0].$refs.activeTab.handleAction(t,this.data)}},props:{data:{type:Object,required:!0}}},o=a,l=s("2877"),c=Object(l["a"])(o,i,n,!1,null,null,null);e["default"]=c.exports}}]);
//# sourceMappingURL=chunk-d4f6c918.chunk.js.map