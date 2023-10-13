(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-72a28c8f","chunk-2d229846","chunk-2d0aecad","chunk-2d0d3de9"],{"0c26":function(t,e,s){"use strict";s.r(e);var a=function(){var t=this,e=t._self._c;return e("div",{staticClass:"sidebar-create-form"},[e("div",{staticClass:"mb-6 p-4 rounded-lg shadow-lg bg-white dark:bg-gray-700"},[e("form",{staticClass:"action py-0 m-auto rounded-lg max-w-xl pb-10",attrs:{action:"/api/create",method:"POST","data-refresh":"1",id:"add-device-form"}},[e("div",{staticClass:"w-full flex"},[e("h1",{staticClass:"w-full m-auto max-w-xl text-base mb-10",domProps:{textContent:t._s(t.$parent.__("ADD_new"))}}),e("span",{staticClass:"cursor-pointer py-1 px-2",on:{click:function(e){t.$parent.showAddSide=!1}}},[e("close_icon")],1)]),e("input",{attrs:{name:"type",type:"hidden"},domProps:{value:t.model}}),e("input",{attrs:{name:"params[active]",type:"hidden",value:"1"}}),t.model_id&&t.column&&"hidden"==t.column.column_type?e("input",{directives:[{name:"model",rawName:"v-model",value:t.column.default,expression:"column.default"}],attrs:{name:"params["+t.column.key+"]",type:"hidden"},domProps:{value:t.column.default},on:{input:function(e){e.target.composing||t.$set(t.column,"default",e.target.value)}}}):t._e(),t._l(t.columns,(function(s){return t.columns?e("div",{staticClass:"py-1 w-full"},[t.isInput(s.column_type)?e("input",{staticClass:"h-12 mt-3 rounded w-full border px-3 text-gray-700 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{name:"params["+s.key+"]",type:s.column_type,placeholder:s.title}}):t._e(),"password"==s.column_type?e("input",{staticClass:"h-12 mb-3 rounded w-full border px-3 text-gray-700 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{autocomplete:"false",name:"params["+s.key+"]",type:s.column_type,placeholder:s.title}}):t._e(),s.data&&"select"==s.column_type?e("select",{staticClass:"h-12 mt-3 rounded w-full border px-3 text-gray-700 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{name:"params["+s.key+"]",type:s.column_type,placeholder:s.title}},[s.required?t._e():e("option",{domProps:{textContent:t._s(t.$parent.__("-- Choose")+" "+s.title)}}),t._l(s.data,(function(a){return e("option",{domProps:{value:a[s.column_key?s.column_key:s.key],textContent:t._s(a[s.text_key])}})}))],2):t._e(),"file"==s.column_type?e("vue-medialibrary-field",{key:"upload-file",attrs:{name:"params["+s.key+"]",api_url:t.conf.url},model:{value:t.file,callback:function(e){t.file=e},expression:"file"}}):t._e()],1):t._e()})),e("button",{staticClass:"uppercase h-12 mt-3 text-white w-full rounded bg-red-700 hover:bg-red-800",domProps:{textContent:t._s(t.$parent.__("save"))}})],2)])])},i=[],l={props:["conf","columns","model"],data:function(){return{file:""}},methods:{isInput:function(t){switch(t){case"text":case"number":case"email":case"time":case"date":case"phone":case"":return!0}return!1}}},n=l,o=s("2877"),r=Object(o["a"])(n,a,i,!1,null,null,null);e["default"]=r.exports},"5f35":function(t,e,s){"use strict";s.r(e);var a=function(){var t=this,e=t._self._c;return e("div",{staticClass:"sidebar-create-form"},[e("div",{staticClass:"mb-6 p-4 rounded-lg shadow-lg bg-white dark:bg-gray-700"},[e("form",{staticClass:"action py-0 m-auto rounded-lg max-w-xl pb-10",attrs:{action:"/api/update",method:"POST","data-refresh":"1",id:"add-device-form"}},[e("div",{staticClass:"w-full flex"},[e("h1",{staticClass:"w-full m-auto max-w-xl text-base mb-10",domProps:{textContent:t._s(t.$parent.__("update"))}}),e("span",{staticClass:"cursor-pointer py-1 px-2",on:{click:function(e){t.$parent.showEditSide=!1}}},[e("close_icon")],1)]),e("input",{attrs:{name:"type",type:"hidden"},domProps:{value:t.model}}),e("input",{attrs:{name:"params[active]",type:"hidden",value:"1"}}),t._l(t.columns,(function(s){return t.columns?e("div",{staticClass:"py-1 w-full"},[t.model_id&&s&&"hidden"==s.column_type?e("input",{directives:[{name:"model",rawName:"v-model",value:t.item[s.key],expression:"item[column.key]"}],attrs:{name:"params["+s.key+"]",type:"hidden"},domProps:{value:t.item[s.key]},on:{input:function(e){e.target.composing||t.$set(t.item,s.key,e.target.value)}}}):t._e(),s&&s.fillable?e("div",{staticClass:"w-full"},["hidden"!=s.column_type?e("span",{staticClass:"block mb-2",domProps:{textContent:t._s(s.title)}}):t._e(),"checkbox"===s.column_type&&t.isInput(s.column_type)?e("input",{directives:[{name:"model",rawName:"v-model",value:t.item[s.key],expression:"item[column.key]"}],staticClass:"h-12 mb-3 rounded w-full border px-3 text-gray-700 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{name:"params["+s.key+"]",placeholder:s.title,type:"checkbox"},domProps:{checked:Array.isArray(t.item[s.key])?t._i(t.item[s.key],null)>-1:t.item[s.key]},on:{change:function(e){var a=t.item[s.key],i=e.target,l=!!i.checked;if(Array.isArray(a)){var n=null,o=t._i(a,n);i.checked?o<0&&t.$set(t.item,s.key,a.concat([n])):o>-1&&t.$set(t.item,s.key,a.slice(0,o).concat(a.slice(o+1)))}else t.$set(t.item,s.key,l)}}}):"radio"===s.column_type&&t.isInput(s.column_type)?e("input",{directives:[{name:"model",rawName:"v-model",value:t.item[s.key],expression:"item[column.key]"}],staticClass:"h-12 mb-3 rounded w-full border px-3 text-gray-700 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{name:"params["+s.key+"]",placeholder:s.title,type:"radio"},domProps:{checked:t._q(t.item[s.key],null)},on:{change:function(e){return t.$set(t.item,s.key,null)}}}):t.isInput(s.column_type)?e("input",{directives:[{name:"model",rawName:"v-model",value:t.item[s.key],expression:"item[column.key]"}],staticClass:"h-12 mb-3 rounded w-full border px-3 text-gray-700 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{name:"params["+s.key+"]",placeholder:s.title,type:s.column_type},domProps:{value:t.item[s.key]},on:{input:function(e){e.target.composing||t.$set(t.item,s.key,e.target.value)}}}):t._e(),"password"==s.column_type?e("input",{staticClass:"h-12 mb-3 rounded w-full border px-3 text-gray-700 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{autocomplete:"false",name:"params["+s.key+"]",type:s.column_type,placeholder:s.title}}):t._e(),s.data&&"select"==s.column_type?e("select",{directives:[{name:"model",rawName:"v-model",value:t.item[s.key],expression:"item[column.key]"}],staticClass:"h-12 mb-3 rounded w-full border px-3 text-gray-700 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{name:"params["+s.key+"]",type:s.column_type,placeholder:s.title},on:{change:function(e){var a=Array.prototype.filter.call(e.target.options,(function(t){return t.selected})).map((function(t){var e="_value"in t?t._value:t.value;return e}));t.$set(t.item,s.key,e.target.multiple?a:a[0])}}},[s.required?t._e():e("option",{domProps:{textContent:t._s(t.$parent.__("select")+" "+s.title)}}),t._l(s.data,(function(a){return e("option",{domProps:{value:a[s.column_key?s.column_key:s.key],textContent:t._s(a[s.text_key])}})}))],2):t._e(),"file"==s.column_type?e("vue-medialibrary-field",{key:"upload-file",attrs:{name:"params["+s.key+"]",api_url:t.conf.url},model:{value:t.item.picture,callback:function(e){t.$set(t.item,"picture",e)},expression:"item.picture"}}):t._e()],1):t._e()]):t._e()})),e("button",{staticClass:"uppercase h-12 mt-3 text-white w-full rounded bg-red-700 hover:bg-red-800",domProps:{textContent:t._s(t.$parent.__("save"))}})],2)])])},i=[],l={props:["columns","model","model_id","item","index","conf"],data:function(){return{file:""}},methods:{isInput:function(t){switch(t){case"text":case"number":case"email":case"time":case"date":case"phone":case"":return!0}return!1}}},n=l,o=s("2877"),r=Object(o["a"])(n,a,i,!1,null,null,null);e["default"]=r.exports},"7e59":function(t,e,s){"use strict";s.r(e);var a=function(){var t=this,e=t._self._c;return e("div",{staticClass:"w-full flex overflow-auto",staticStyle:{height:"85vh","z-index":"9999"}},[t.content&&!t.showLoader?e("div",{staticClass:"w-full relative"},[e("maps",{key:t.locations,attrs:{waypoints:t.locations}}),e("div",{staticClass:"h-full absolute top-4 rounded-lg p-4 w-96 bg-white rounded-xl flex-col justify-start items-start inline-flex",staticStyle:{"max-height":"calc(100vh - 140px)"}},[e("div",{staticClass:"self-stretch p-10 flex-col justify-center items-start flex"},[e("div",{staticClass:"text-black text-lg font-semibold",domProps:{textContent:t._s(t.__("Routes"))}}),e("div",{staticClass:"py-2 self-stretch text-zinc-600 text-base tracking-wide",domProps:{textContent:t._s(t.__("Routes description"))}})]),e("div",{staticClass:"w-full self-stretch pt-2 flex-col justify-center items-start flex"},[e("input",{directives:[{name:"model",rawName:"v-model",value:t.searchText,expression:"searchText"}],staticClass:"w-full bg-gray-100 rounded-lg px-4 py-2",attrs:{placeholder:t.__("find by name and address")},domProps:{value:t.searchText},on:{change:t.searchTextChanged,input:[function(e){e.target.composing||(t.searchText=e.target.value)},t.searchTextChanged],keydown:t.searchTextChanged}})]),t.content.items?e("div",{staticClass:"max-h-[400px] overflow-auto my-4 w-full self-stretch p-10"},t._l(t.content.items,(function(s,a){return e("div",{key:s.active,staticClass:"w-full"},[t.showList&&s.active?e("div",{staticClass:"mb-4 w-full rounded-lg justify-start items-center inline-flex",class:s.selected?"text-fuchsia-600":"bg-gray-50"},[e("div",{staticClass:"w-full grow shrink basis-0 px-6 py-4 flex-col justify-center items-start gap-4 inline-flex"},[e("div",{staticClass:"w-full self-stretch justify-start items-start inline-flex cursor-pointer"},[e("div",{staticClass:"w-full grow shrink basis-0 flex-col justify-start items-start inline-flex",on:{click:function(e){return t.setLocationsMarkers(s,a)}}},[e("div",{staticClass:"self-stretch text-base font-semibold tracking-tight",class:s.selected?"text-fuchsia-600":"text-gray-800",domProps:{textContent:t._s(s.route_name)}}),e("div",{staticClass:"py-1 self-stretch text-slate-500 text-sm font-semibold leading-relaxed tracking-wide",domProps:{textContent:t._s(s.description)}})]),e("div",{staticClass:"gap-2 py-2 flex justify-start items-start gap-2.5 inline-flex"},[e("div",{staticClass:"px-3 py-2 bg-primary rounded-full justify-center items-center flex cursor-pointer",on:{click:function(e){return t.setLocationsMarkers(s,a)}}},[t._m(0,!0)]),e("div",{staticClass:"px-3 py-2 bg-purple-800 rounded justify-center items-center flex cursor-pointer",on:{click:function(e){return t.handleAction("edit",s)}}},[t._m(1,!0)])])]),e("hr",{staticClass:"w-full"}),e("div",{staticClass:"w-full h-8 relative flex"},[t._l(s.pickup_locations,(function(t,s){return e("img",{staticClass:"rounded-full w-8 h-8 left-0 top-0 absolute rounded-[50px] border-2 border-purple-800",style:"left: "+20*s+"px",attrs:{src:t.student&&t.student.picture?t.student.picture:"https://via.placeholder.com/37x37"}})})),e("span",{staticClass:"absolute pt-2",style:"left: "+(20*s.pickup_locations.length+20)+"px"},[e("i",{staticClass:"fa fa-location-dot text-sm"}),s.pickup_locations?e("span",{staticClass:"font-semibold px-1",domProps:{textContent:t._s(s.pickup_locations.length)}}):t._e()]),e("div",{staticClass:"right-0 absolute self-stretch text-slate-500 text-base font-normal"},[e("i",{staticClass:"fa fa-car px-2"}),s.vehicle?e("span",{staticClass:"font-semibold text-sm",domProps:{textContent:t._s(s.vehicle.plate_number)}}):t._e()])],2)])]):t._e()])})),0):t._e(),e("div",{staticClass:"self-stretch grow shrink basis-0 p-[25px] bg-neutral-50 justify-between items-center inline-flex"},[e("div",{staticClass:"bg-fuchsia-600 rounded-lg text-white text-xs font-medium px-3 py-2 uppercase cursor-pointer",domProps:{textContent:t._s(t.__("add new"))},on:{click:function(e){t.showLoader=!0,t.showAddSide=!0,t.activeItem={},t.showLoader=!1}}})])]),e("hr",{staticClass:"mt-2"}),e("main",{staticClass:"flex-1 overflow-x-hidden overflow-y-auto w-full relative"},[e("div",{staticClass:"px-4 mb-6 py-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 flex w-full"},[e("h1",{staticClass:"font-bold text-lg w-full",domProps:{textContent:t._s(t.content.title)}}),e("a",{staticClass:"uppercase p-2 mx-2 text-center text-white w-32 rounded bg-gradient-purple hover:bg-red-800",attrs:{href:"javascript:;"},on:{click:function(e){t.showLoader=!0,t.showAddSide=!0,t.activeItem={},t.showLoader=!1}}},[t._v(t._s(t.__("add_new")))])]),e("hr",{staticClass:"mt-2"}),e("div",{staticClass:"w-full flex gap gap-6"},[e("data-table",t._b({ref:"devices_orders",on:{actionTriggered:t.handleAction}},"data-table",t.bindings,!1)),t.showAddSide&&t.content&&t.content.fillable?e("side-form-create",{staticClass:"col-md-3",attrs:{conf:t.conf,model:"Routes.create",columns:t.content.fillable}}):t._e(),t.showEditSide&&!t.showAddSide?e("side-form-update",{staticClass:"col-md-3",attrs:{conf:t.conf,model:"Routes.update",item:t.activeItem,model_id:t.activeItem.route_id,index:"route_id",columns:t.content.fillable}}):t._e()],1)])],1):t._e()])},i=[function(){var t=this,e=t._self._c;return e("div",{staticClass:"text-center text-xs text-white uppercase tracking-tight"},[e("i",{staticClass:"fa fa-location-dot"})])},function(){var t=this,e=t._self._c;return e("div",{staticClass:"text-center text-xs text-white uppercase tracking-tight"},[e("i",{staticClass:"fa fa-edit"})])}],l=(s("6762"),s("2fdb"),s("de7f")),n=s("0c26"),o=s("5f35"),r={components:{dataTableActions:l["default"],sideFormCreate:n["default"],sideFormUpdate:o["default"]},name:"Students",data:function(){return{url:this.conf.url+this.path+"?load=json",content:{title:"",items:[],columns:[]},locations:[],activeItem:{},showAddSide:!1,showEditSide:!1,showLoader:!0,showList:!0,searchText:""}},computed:{bindings:function(){return this.content.columns.push({key:this.__("actions"),component:l["default"],sortable:!1}),{columns:this.content.columns,fillable:this.content.fillable,data:this.content.items}}},props:["path","lang","setting","conf","auth"],mounted:function(){this.load()},methods:{searchTextChanged:function(){this.showList=!1;for(var t=0;t<this.content.items.length;t++)this.content.items[t].active=this.searchText.trim()?this.checkSimilar(this.content.items[t]):1;this.showList=!0},checkSimilar:function(t){var e=!!t.route_name.toLowerCase().includes(this.searchText.toLowerCase());return e||!!t.description.toLowerCase().includes(this.searchText.toLowerCase())},setLocationsMarkers:function(t,e){for(var s=0;s<this.content.items.length;s++)this.content.items[s].selected=!1;this.content.items[e].selected=!0,this.locations=this.setLocationsPickups(t)},setLocationsPickups:function(t){for(var e,s=[],a=0;a<t.pickup_locations.length;a++)e=t.pickup_locations[a],s[a]={drag:!1,icon:this.conf.url+"uploads/images/blue_pin.gif",origin:{lat:parseFloat(e.latitude),lng:parseFloat(e.longitude)},destination:{lat:parseFloat(e.latitude),lng:parseFloat(e.longitude)}};return s[s.length]={icon:this.conf.url+"uploads/images/car.svg",origin:{lat:parseFloat(t.vehicle.last_latitude),lng:parseFloat(t.vehicle.last_longitude)},destination:{lat:parseFloat(t.vehicle.last_latitude),lng:parseFloat(t.vehicle.last_longitude)}},s},handleAction:function(t,e){switch(t){case"view":break;case"edit":this.showEditSide=!0,this.showAddSide=!1,this.activeItem=e;break;case"delete":this.$parent.deleteByKey("route_id",e.route_id,"Routes.delete");break}},load:function(){var t=this;this.showLoader=!0,this.$parent.handleGetRequest(this.url).then((function(e){t.setValues(e),t.showLoader=!1,t.searchTextChanged()}))},setValues:function(t){return this.content=JSON.parse(JSON.stringify(t)),this},__:function(t){return this.$root.$children[0].__(t)}}},c=r,d=s("2877"),u=Object(d["a"])(c,a,i,!1,null,null,null);e["default"]=u.exports},de7f:function(t,e,s){"use strict";s.r(e);var a=function(){var t=this,e=t._self._c;return e("div",{staticClass:"action-buttons flex gap-6 gap text-base"},[t.data.not_editable?t._e():e("button",{staticClass:"hover:text-gray-600 text-purple",on:{click:function(e){return t.handleAction("edit")}}},[e("i",{staticClass:"fa fa-edit"})]),t.data.not_removeable?t._e():e("button",{staticClass:"hover:text-red-400 text-red-600",on:{click:function(e){return t.handleAction("delete")}}},[e("i",{staticClass:"fa fa-trash"})])])},i=[],l={name:"ActionButtons",methods:{handleAction:function(t){this.$root.$children[0].$refs.activeTab.handleAction(t,this.data)}},props:{data:{type:Object,required:!0}}},n=l,o=s("2877"),r=Object(o["a"])(n,a,i,!1,null,null,null);e["default"]=r.exports}}]);
//# sourceMappingURL=chunk-72a28c8f.chunk.js.map