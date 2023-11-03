(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-72a28c8f","chunk-2d229846","chunk-2d0aecad","chunk-2d0d3de9"],{"0c26":function(e,t,a){"use strict";a.r(t);var s=function(){var e=this,t=e._self._c;return t("div",{staticClass:"sidebar-create-form"},[t("div",{staticClass:"mb-6 p-4 rounded-lg shadow-lg bg-white dark:bg-gray-700"},[t("form",{staticClass:"action py-0 m-auto rounded-lg max-w-xl pb-10",attrs:{action:"/api/create",method:"POST","data-refresh":"1",id:"add-device-form"}},[t("div",{staticClass:"w-full flex"},[t("h1",{staticClass:"w-full m-auto max-w-xl text-base mb-10",domProps:{textContent:e._s(e.$parent.__("ADD_new"))}}),t("span",{staticClass:"cursor-pointer py-1 px-2",on:{click:function(t){e.$parent.showAddSide=!1}}},[t("close_icon")],1)]),t("input",{attrs:{name:"type",type:"hidden"},domProps:{value:e.model}}),t("input",{attrs:{name:"params[active]",type:"hidden",value:"1"}}),e.model_id&&e.column&&"hidden"==e.column.column_type?t("input",{directives:[{name:"model",rawName:"v-model",value:e.column.default,expression:"column.default"}],attrs:{name:"params["+e.column.key+"]",type:"hidden"},domProps:{value:e.column.default},on:{input:function(t){t.target.composing||e.$set(e.column,"default",t.target.value)}}}):e._e(),e._l(e.columns,(function(a){return e.columns?t("div",{staticClass:"py-1 w-full"},[e.isInput(a.column_type)?t("input",{staticClass:"h-12 mt-3 rounded w-full border px-3 text-gray-700 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{name:"params["+a.key+"]",autocomplete:"off",type:a.column_type,placeholder:a.title}}):e._e(),"password"==a.column_type?t("input",{staticClass:"h-12 mb-3 rounded w-full border px-3 text-gray-700 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{autocomplete:"off",name:"params["+a.key+"]",type:a.column_type,placeholder:a.title}}):e._e(),a.data&&"select"==a.column_type?t("select",{staticClass:"h-12 mt-3 rounded w-full border px-3 text-gray-700 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{name:"params["+a.key+"]",type:a.column_type,placeholder:a.title}},[a.required?e._e():t("option",{domProps:{textContent:e._s(e.$parent.__("-- Choose")+" "+a.title)}}),e._l(a.data,(function(s){return t("option",{domProps:{value:s[a.column_key?a.column_key:a.key],textContent:e._s(s[a.text_key])}})}))],2):e._e(),"file"==a.column_type?t("vue-medialibrary-field",{key:"upload-file",attrs:{name:"params["+a.key+"]",api_url:e.conf.url},model:{value:e.file,callback:function(t){e.file=t},expression:"file"}}):e._e()],1):e._e()})),t("button",{staticClass:"uppercase h-12 mt-3 text-white w-full rounded bg-red-700 hover:bg-red-800",domProps:{textContent:e._s(e.$parent.__("save"))}})],2)])])},i=[],o={props:["conf","columns","model"],data:function(){return{file:""}},methods:{isInput:function(e){switch(e){case"text":case"number":case"email":case"time":case"date":case"phone":case"":return!0}return!1}}},l=o,n=a("2877"),r=Object(n["a"])(l,s,i,!1,null,null,null);t["default"]=r.exports},"5f35":function(e,t,a){"use strict";a.r(t);var s=function(){var e=this,t=e._self._c;return t("div",{staticClass:"sidebar-create-form"},[t("div",{staticClass:"mb-6 p-4 rounded-lg shadow-lg bg-white dark:bg-gray-700"},[t("form",{staticClass:"action py-0 m-auto rounded-lg max-w-xl pb-10",attrs:{action:"/api/update",method:"POST","data-refresh":"1",id:"add-device-form"}},[t("div",{staticClass:"w-full flex"},[t("h1",{staticClass:"w-full m-auto max-w-xl text-base mb-10",domProps:{textContent:e._s(e.$parent.__("update"))}}),t("span",{staticClass:"cursor-pointer py-1 px-2",on:{click:function(t){e.$parent.showEditSide=!1}}},[t("close_icon")],1)]),t("input",{attrs:{name:"type",type:"hidden"},domProps:{value:e.model}}),e._l(e.columns,(function(a){return e.columns?t("div",{staticClass:"py-1 w-full"},[e.model_id&&a&&"hidden"==a.column_type?t("input",{directives:[{name:"model",rawName:"v-model",value:e.item[a.key],expression:"item[column.key]"}],attrs:{name:"params["+a.key+"]",type:"hidden"},domProps:{value:e.item[a.key]},on:{input:function(t){t.target.composing||e.$set(e.item,a.key,t.target.value)}}}):e._e(),a?t("div",{staticClass:"w-full"},["hidden"!=a.column_type?t("span",{staticClass:"block mb-2",domProps:{textContent:e._s(a.title)}}):e._e(),"checkbox"===a.column_type&&e.isInput(a.column_type)?t("input",{directives:[{name:"model",rawName:"v-model",value:e.item[a.key],expression:"item[column.key]"}],staticClass:"h-12 mb-3 rounded w-full border px-3 text-gray-700 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{autocomplete:"off",name:"params["+a.key+"]",placeholder:a.title,type:"checkbox"},domProps:{checked:Array.isArray(e.item[a.key])?e._i(e.item[a.key],null)>-1:e.item[a.key]},on:{change:function(t){var s=e.item[a.key],i=t.target,o=!!i.checked;if(Array.isArray(s)){var l=null,n=e._i(s,l);i.checked?n<0&&e.$set(e.item,a.key,s.concat([l])):n>-1&&e.$set(e.item,a.key,s.slice(0,n).concat(s.slice(n+1)))}else e.$set(e.item,a.key,o)}}}):"radio"===a.column_type&&e.isInput(a.column_type)?t("input",{directives:[{name:"model",rawName:"v-model",value:e.item[a.key],expression:"item[column.key]"}],staticClass:"h-12 mb-3 rounded w-full border px-3 text-gray-700 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{autocomplete:"off",name:"params["+a.key+"]",placeholder:a.title,type:"radio"},domProps:{checked:e._q(e.item[a.key],null)},on:{change:function(t){return e.$set(e.item,a.key,null)}}}):e.isInput(a.column_type)?t("input",{directives:[{name:"model",rawName:"v-model",value:e.item[a.key],expression:"item[column.key]"}],staticClass:"h-12 mb-3 rounded w-full border px-3 text-gray-700 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{autocomplete:"off",name:"params["+a.key+"]",placeholder:a.title,type:a.column_type},domProps:{value:e.item[a.key]},on:{input:function(t){t.target.composing||e.$set(e.item,a.key,t.target.value)}}}):e._e(),"password"==a.column_type?t("input",{staticClass:"h-12 mb-3 rounded w-full border px-3 text-gray-700 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{autocomplete:"off",name:"params["+a.key+"]",type:a.column_type,placeholder:a.title}}):e._e(),"checkbox"==a.column_type?t("input",{directives:[{name:"model",rawName:"v-model",value:e.item[a.key],expression:"item[column.key]"}],attrs:{type:"checkbox",name:"params["+a.key+"]"},domProps:{checked:Array.isArray(e.item[a.key])?e._i(e.item[a.key],null)>-1:e.item[a.key]},on:{change:function(t){var s=e.item[a.key],i=t.target,o=!!i.checked;if(Array.isArray(s)){var l=null,n=e._i(s,l);i.checked?n<0&&e.$set(e.item,a.key,s.concat([l])):n>-1&&e.$set(e.item,a.key,s.slice(0,n).concat(s.slice(n+1)))}else e.$set(e.item,a.key,o)}}}):e._e(),a.data&&"select"==a.column_type?t("select",{directives:[{name:"model",rawName:"v-model",value:e.item[a.key],expression:"item[column.key]"}],staticClass:"h-12 mb-3 rounded w-full border px-3 text-gray-700 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{name:"params["+a.key+"]",type:a.column_type,placeholder:a.title},on:{change:function(t){var s=Array.prototype.filter.call(t.target.options,(function(e){return e.selected})).map((function(e){var t="_value"in e?e._value:e.value;return t}));e.$set(e.item,a.key,t.target.multiple?s:s[0])}}},[a.required?e._e():t("option",{domProps:{textContent:e._s(e.$parent.__("select")+" "+a.title)}}),e._l(a.data,(function(s){return t("option",{domProps:{value:s[a.column_key?a.column_key:a.key],textContent:e._s(s[a.text_key])}})}))],2):e._e(),"file"==a.column_type?t("vue-medialibrary-field",{key:"upload-file",attrs:{name:"params["+a.key+"]",api_url:e.conf.url},model:{value:e.item.picture,callback:function(t){e.$set(e.item,"picture",t)},expression:"item.picture"}}):e._e()],1):e._e()]):e._e()})),t("button",{staticClass:"uppercase h-12 mt-3 text-white w-full rounded bg-red-700 hover:bg-red-800",domProps:{textContent:e._s(e.$parent.__("save"))}})],2)])])},i=[],o={props:["columns","model","model_id","item","index","conf"],data:function(){return{file:""}},methods:{isInput:function(e){switch(e){case"text":case"number":case"email":case"time":case"date":case"phone":case"number":case"":return!0}return!1}}},l=o,n=a("2877"),r=Object(n["a"])(l,s,i,!1,null,null,null);t["default"]=r.exports},"7e59":function(e,t,a){"use strict";a.r(t);var s=function(){var e=this,t=e._self._c;return t("div",{staticClass:"w-full flex overflow-auto",staticStyle:{height:"85vh","z-index":"9999"}},[e.content&&!e.showLoader?t("div",{staticClass:"w-full relative"},[t("maps",{key:e.locations,attrs:{waypoints:e.locations,showroute:!1},on:{"update-marker":e.updateMarker}}),t("div",{staticClass:"h-full absolute top-4 rounded-lg p-4 w-96 bg-white rounded-xl flex-col justify-start items-start inline-flex",staticStyle:{"max-height":"calc(100vh - 140px)"}},[t("div",{staticClass:"self-stretch py-4 flex-col justify-center items-start flex"},[t("div",{staticClass:"text-black text-lg font-semibold",domProps:{textContent:e._s(e.__("Routes"))}}),t("div",{staticClass:"py-2 self-stretch text-zinc-600 text-base tracking-wide",domProps:{textContent:e._s(e.__("Routes description"))}})]),t("div",{staticClass:"w-full self-stretch pt-2 flex-col justify-center items-start flex"},[t("input",{directives:[{name:"model",rawName:"v-model",value:e.searchText,expression:"searchText"}],staticClass:"w-full bg-gray-100 rounded-lg px-4 py-2",attrs:{placeholder:e.__("find by name and address")},domProps:{value:e.searchText},on:{change:e.searchTextChanged,input:[function(t){t.target.composing||(e.searchText=t.target.value)},e.searchTextChanged],keydown:e.searchTextChanged}})]),e.content.items?t("div",{staticClass:"max-h-[400px] overflow-auto my-4 w-full self-stretch py-4"},e._l(e.content.items,(function(a,s){return t("div",{key:a.active,staticClass:"w-full"},[e.showList&&a.active?t("div",{staticClass:"mb-4 w-full rounded-lg justify-start items-center inline-flex",class:a.selected?"text-fuchsia-600":"bg-gray-50"},[t("div",{staticClass:"w-full grow shrink basis-0 px-6 py-4 flex-col justify-center items-start gap-4 inline-flex"},[t("div",{staticClass:"w-full self-stretch justify-start items-start inline-flex cursor-pointer"},[t("div",{staticClass:"w-full grow shrink basis-0 flex-col justify-start items-start inline-flex",on:{click:function(t){return e.setLocationsMarkers(a,s)}}},[t("div",{staticClass:"self-stretch text-base font-semibold tracking-tight",class:a.selected?"text-fuchsia-600":"text-gray-800",domProps:{textContent:e._s(a.route_name)}}),t("div",{staticClass:"py-1 self-stretch text-slate-500 text-sm font-semibold leading-relaxed tracking-wide",domProps:{textContent:e._s(a.description)}})]),t("div",{staticClass:"gap-2 py-2 flex justify-start items-start gap-2.5 inline-flex"},[t("div",{staticClass:"px-3 py-2 bg-purple-800 rounded-full justify-center items-center flex cursor-pointer",on:{click:function(t){return e.setLocationsMarkers(a,s)}}},[e._m(0,!0)]),t("div",{staticClass:"px-3 py-2 bg-purple-800 rounded justify-center items-center flex cursor-pointer",on:{click:function(t){return e.handleAction("edit",a)}}},[e._m(1,!0)])])]),t("hr",{staticClass:"w-full"}),t("div",{staticClass:"w-full h-8 relative flex"},[e._l(a.pickup_locations,(function(e,a){return t("img",{staticClass:"rounded-full w-8 h-8 left-0 top-0 absolute rounded-[50px] border-2 border-purple-800",style:"left: "+20*a+"px",attrs:{src:e.student&&e.student.picture?e.student.picture:"https://via.placeholder.com/37x37"}})})),t("span",{staticClass:"absolute pt-2",style:"left: "+(20*a.pickup_locations.length+20)+"px"},[t("i",{staticClass:"fa fa-location-dot text-sm"}),a.pickup_locations?t("span",{staticClass:"font-semibold px-1",domProps:{textContent:e._s(a.pickup_locations.length)}}):e._e()]),t("div",{staticClass:"right-0 absolute self-stretch text-slate-500 text-base font-normal"},[t("i",{staticClass:"fa fa-car px-2"}),a.vehicle?t("span",{staticClass:"font-semibold text-sm",domProps:{textContent:e._s(a.vehicle.plate_number)}}):e._e()])],2)])]):e._e()])})),0):e._e(),t("div",{staticClass:"self-stretch grow shrink basis-0 justify-between items-center inline-flex"},[t("div",{staticClass:"menu-dark rounded-lg text-white text-xs font-medium px-4 py-3 uppercase cursor-pointer",domProps:{textContent:e._s(e.__("add new"))},on:{click:function(t){e.showLoader=!0,e.showAddSide=!0,e.activeItem={},e.showLoader=!1}}})])]),t("hr",{staticClass:"mt-2"}),t("main",{staticClass:"flex-1 overflow-x-hidden overflow-y-auto w-full relative"},[t("div",{staticClass:"px-4 mb-6 py-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 flex w-full"},[t("h1",{staticClass:"font-bold text-lg w-full",domProps:{textContent:e._s(e.content.title)}}),t("a",{staticClass:"uppercase p-2 mx-2 text-center text-white w-32 rounded-lg menu-dark hover:bg-purple-800",attrs:{href:"javascript:;"},on:{click:function(t){e.showLoader=!0,e.showAddSide=!0,e.activeItem={},e.showLoader=!1}}},[e._v(e._s(e.__("add_new")))])]),t("hr",{staticClass:"mt-2"}),t("div",{staticClass:"w-full flex gap gap-6"},[t("data-table",e._b({ref:"devices_orders",on:{actionTriggered:e.handleAction}},"data-table",e.bindings,!1)),e.showAddSide&&e.content&&e.content.fillable?t("side-form-create",{staticClass:"col-md-3",attrs:{conf:e.conf,model:"Routes.create",columns:e.content.fillable}}):e._e(),e.showEditSide&&!e.showAddSide?t("side-form-update",{staticClass:"col-md-3",attrs:{conf:e.conf,model:"Routes.update",item:e.activeItem,model_id:e.activeItem.route_id,index:"route_id",columns:e.content.fillable}}):e._e()],1)])],1):e._e()])},i=[function(){var e=this,t=e._self._c;return t("div",{staticClass:"text-center text-xs text-white uppercase tracking-tight"},[t("i",{staticClass:"fa fa-location-dot"})])},function(){var e=this,t=e._self._c;return t("div",{staticClass:"text-center text-xs text-white uppercase tracking-tight"},[t("i",{staticClass:"fa fa-edit"})])}],o=(a("6762"),a("2fdb"),a("de7f")),l=a("0c26"),n=a("5f35"),r={components:{dataTableActions:o["default"],sideFormCreate:l["default"],sideFormUpdate:n["default"]},name:"Students",data:function(){return{url:this.conf.url+this.path+"?load=json",content:{title:"",items:[],columns:[]},activeItem:{},showAddSide:!1,showEditSide:!1,showLoader:!0,locations:[],showList:!0,searchText:""}},computed:{bindings:function(){return this.content.columns.push({key:this.__("actions"),component:o["default"],sortable:!1}),{columns:this.content.columns,fillable:this.content.fillable,data:this.content.items}}},props:["path","lang","setting","conf","auth"],mounted:function(){this.load()},methods:{searchTextChanged:function(){this.showList=!1;for(var e=0;e<this.content.items.length;e++)this.content.items[e].active=this.searchText.trim()?this.checkSimilar(this.content.items[e]):1;this.showList=!0},checkSimilar:function(e){var t=!!e.route_name.toLowerCase().includes(this.searchText.toLowerCase());return t||!!e.description.toLowerCase().includes(this.searchText.toLowerCase())},setLocationsMarkers:function(e,t){for(var a=0;a<this.content.items.length;a++)this.content.items[a].selected=!1;this.content.items[t].selected=!0,this.locations=this.setLocationsPickups(e)},updateMarker:function(e,t){console.log(e),console.log(t)},setLocationsPickups:function(e){for(var t,a=[],s=0;s<e.pickup_locations.length;s++)t=e.pickup_locations[s],a[s]={icon:this.conf.url+"uploads/images/blue_pin.gif",origin:{lat:parseFloat(t.latitude),lng:parseFloat(t.longitude)},destination:{lat:parseFloat(t.latitude),lng:parseFloat(t.longitude)}};return a[a.length]={icon:this.conf.url+"uploads/images/car.svg",origin:{lat:parseFloat(e.vehicle.last_latitude),lng:parseFloat(e.vehicle.last_longitude)},destination:{lat:parseFloat(e.vehicle.last_latitude),lng:parseFloat(e.vehicle.last_longitude)}},a.push({drag:!0,icon:this.conf.url+"uploads/images/pin.png",origin:{lat:parseFloat(e.vehicle.last_latitude),lng:parseFloat(e.vehicle.last_longitude)},destination:{lat:parseFloat(e.vehicle.last_latitude),lng:parseFloat(e.vehicle.last_longitude)}}),a},handleAction:function(e,t){switch(e){case"view":break;case"edit":this.showEditSide=!0,this.showAddSide=!1,this.activeItem=t;break;case"delete":this.$parent.deleteByKey("route_id",t.route_id,"Routes.delete");break}},load:function(){var e=this;this.showLoader=!0,this.$parent.handleGetRequest(this.url).then((function(t){e.setValues(t),e.showLoader=!1,e.searchTextChanged()}))},setValues:function(e){return this.content=JSON.parse(JSON.stringify(e)),this},__:function(e){return this.$root.$children[0].__(e)}}},c=r,d=a("2877"),u=Object(d["a"])(c,s,i,!1,null,null,null);t["default"]=u.exports},de7f:function(e,t,a){"use strict";a.r(t);var s=function(){var e=this,t=e._self._c;return t("div",{staticClass:"action-buttons flex gap-6 gap text-base"},[e.data.not_editable?e._e():t("button",{staticClass:"hover:text-gray-600 text-purple",on:{click:function(t){return e.handleAction("edit")}}},[t("i",{staticClass:"fa fa-edit"})]),e.data.not_removeable?e._e():t("button",{staticClass:"hover:text-red-400 text-red-600",on:{click:function(t){return e.handleAction("delete")}}},[t("i",{staticClass:"fa fa-trash"})])])},i=[],o={name:"ActionButtons",methods:{handleAction:function(e){this.$root.$children[0].$refs.activeTab.$refs.data_table?this.$root.$children[0].$refs.activeTab.$refs.data_table.handleAction(e,this.data):this.$root.$children[0].$refs.activeTab.handleAction(e,this.data)}},props:{data:{type:Object,required:!0}}},l=o,n=a("2877"),r=Object(n["a"])(l,s,i,!1,null,null,null);t["default"]=r.exports}}]);
//# sourceMappingURL=chunk-72a28c8f.chunk.js.map