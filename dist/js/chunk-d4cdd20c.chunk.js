(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-d4cdd20c","chunk-2d229846"],{de7f:function(t,e,i){"use strict";i.r(e);var n=function(){var t=this,e=t._self._c;return e("div",{staticClass:"action-buttons flex gap-6 gap text-base"},[t.data.not_editable?t._e():e("button",{staticClass:"hover:text-gray-600 text-purple",on:{click:function(e){return t.handleAction("edit")}}},[e("i",{staticClass:"fa fa-edit"})]),t.data.not_removeable?t._e():e("button",{staticClass:"hover:text-red-400 text-red-600",on:{click:function(e){return t.handleAction("delete")}}},[e("i",{staticClass:"fa fa-trash"})])])},a=[],s={name:"ActionButtons",methods:{handleAction:function(t){this.$root.$children[0].$refs.activeTab.handleAction(t,this.data)}},props:{data:{type:Object,required:!0}}},o=s,l=i("2877"),d=Object(l["a"])(o,n,a,!1,null,null,null);e["default"]=d.exports},e62b:function(t,e,i){"use strict";i.r(e);var n=function(){var t=this,e=t._self._c;return e("div",{staticClass:"w-full flex overflow-auto",staticStyle:{height:"85vh","z-index":"9999"}},[e("div",{staticClass:"w-full"},[t.content&&!t.showLoader?e("main",{staticClass:"flex-1 overflow-x-hidden overflow-y-auto w-full"},[e("div",{staticClass:"px-4 mb-6 py-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 flex w-full"},[e("h1",{staticClass:"font-bold text-lg w-full",domProps:{textContent:t._s(t.content.title)}}),e("a",{staticClass:"uppercase p-2 mx-2 text-center text-white w-32 rounded bg-gradient-purple hover:bg-red-800",attrs:{href:"javascript:;"},on:{click:function(e){t.showLoader=!0,t.showAddSide=!0,t.activeItem={},t.showLoader=!1}}},[t._v(t._s(t.__("add_new")))])]),e("hr",{staticClass:"mt-2"}),e("div",{staticClass:"w-full flex gap gap-6"},[e("data-table",t._b({ref:"devices_orders",on:{actionTriggered:t.handleAction}},"data-table",t.bindings,!1)),t.showAddSide&&t.content&&t.content.fillable?e("side-form-create",{staticClass:"col-md-3",attrs:{conf:t.conf,model:"Trip.create",columns:t.content.fillable}}):t._e(),t.showEditSide&&!t.showAddSide?e("side-form-update",{staticClass:"col-md-3",attrs:{conf:t.conf,model:"Trip.update",item:t.activeItem,model_id:t.activeItem.trip_id,index:"trip_id",columns:t.content.fillable}}):t._e()],1)]):t._e()])])},a=[],s=i("de7f"),o={components:{dataTableActions:s["default"]},name:"Trips",data:function(){return{url:this.conf.url+this.path+"?load=json",content:{title:"",items:[],columns:[]},activeItem:{},showAddSide:!1,showEditSide:!1,showLoader:!0}},computed:{bindings:function(){return this.content.columns.push({key:this.__("actions"),component:s["default"],sortable:!1}),{columns:this.content.columns,fillable:this.content.fillable,data:this.content.items}}},props:["path","lang","setting","conf","auth"],mounted:function(){this.load()},methods:{handleAction:function(t,e){switch(t){case"view":break;case"edit":this.showEditSide=!0,this.showAddSide=!1,this.activeItem=e;break;case"delete":this.$parent.deleteByKey("vehicle_id",e.vehicle_id,"Vehicle.delete");break}},load:function(){var t=this;this.showLoader=!0,this.$parent.handleGetRequest(this.url).then((function(e){t.setValues(e),t.showLoader=!1}))},setValues:function(t){return this.content=JSON.parse(JSON.stringify(t)),this},__:function(t){return this.$root.$children[0].__(t)}}},l=o,d=i("2877"),c=Object(d["a"])(l,n,a,!1,null,null,null);e["default"]=c.exports}}]);
//# sourceMappingURL=chunk-d4cdd20c.chunk.js.map