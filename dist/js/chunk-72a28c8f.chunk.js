(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-72a28c8f","chunk-2d229846","chunk-2d0aecad","chunk-2d0d3de9"],{"0c26":function(e,t,a){"use strict";a.r(t);var s=function(){var e=this,t=e._self._c;return t("div",{staticClass:"sidebar-create-form"},[t("div",{staticClass:"mb-6 p-4 rounded-lg shadow-lg bg-white dark:bg-gray-700"},[t("form",{staticClass:"action py-0 m-auto rounded-lg max-w-xl pb-10",attrs:{action:"/api/create",method:"POST","data-refresh":"1",id:"add-device-form"}},[t("div",{staticClass:"w-full flex"},[t("h1",{staticClass:"w-full m-auto max-w-xl text-base mb-10",domProps:{textContent:e._s(e.$parent.__("ADD_new"))}}),t("span",{staticClass:"cursor-pointer py-1 px-2",on:{click:function(t){e.$parent.showAddSide=!1}}},[t("close_icon")],1)]),t("input",{attrs:{name:"type",type:"hidden"},domProps:{value:e.model}}),t("input",{attrs:{name:"params[active]",type:"hidden",value:"1"}}),e._l(e.columns,(function(a){return e.columns?t("div",{staticClass:"py-1 w-full"},[e.isInput(a.column_type)?t("input",{staticClass:"h-12 mt-3 rounded w-full border px-3 text-gray-700 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{name:"params["+a.key+"]",type:a.column_type,placeholder:a.title}}):e._e(),"password"==a.column_type?t("input",{staticClass:"h-12 mb-3 rounded w-full border px-3 text-gray-700 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{autocomplete:"false",name:"params["+a.key+"]",type:a.column_type,placeholder:a.title}}):e._e(),a.data&&"select"==a.column_type?t("select",{staticClass:"h-12 mt-3 rounded w-full border px-3 text-gray-700 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{name:"params["+a.key+"]",type:a.column_type,placeholder:a.title}},[a.required?e._e():t("option",{domProps:{textContent:e._s(e.$parent.__("select"))}}),e._l(a.data,(function(s){return t("option",{domProps:{value:s[a.key],textContent:e._s(s[a.text_key])}})}))],2):e._e(),t("vue-medialibrary-field",{key:"upload-file",attrs:{name:"params["+a.key+"]",api_url:e.conf.url},model:{value:e.file,callback:function(t){e.file=t},expression:"file"}})],1):e._e()})),t("button",{staticClass:"uppercase h-12 mt-3 text-white w-full rounded bg-red-700 hover:bg-red-800",domProps:{textContent:e._s(e.$parent.__("save"))}})],2)])])},r=[],o={props:["conf","columns","model"],data:function(){return{file:""}},methods:{isInput:function(e){switch(e){case"text":case"number":case"email":case"time":case"date":case"phone":case"":return!0}return!1}}},n=o,l=a("2877"),i=Object(l["a"])(n,s,r,!1,null,null,null);t["default"]=i.exports},"5f35":function(e,t,a){"use strict";a.r(t);var s=function(){var e=this,t=e._self._c;return t("div",{staticClass:"sidebar-create-form"},[t("div",{staticClass:"mb-6 p-4 rounded-lg shadow-lg bg-white dark:bg-gray-700"},[t("form",{staticClass:"action py-0 m-auto rounded-lg max-w-xl pb-10",attrs:{action:"/api/update",method:"POST","data-refresh":"1",id:"add-device-form"}},[t("div",{staticClass:"w-full flex"},[t("h1",{staticClass:"w-full m-auto max-w-xl text-base mb-10",domProps:{textContent:e._s(e.$parent.__("update"))}}),t("span",{staticClass:"cursor-pointer py-1 px-2",on:{click:function(t){e.$parent.showEditSide=!1}}},[t("close_icon")],1)]),t("input",{attrs:{name:"type",type:"hidden"},domProps:{value:e.model}}),t("input",{attrs:{name:"params[active]",type:"hidden",value:"1"}}),e.model_id?t("input",{directives:[{name:"model",rawName:"v-model",value:e.model_id,expression:"model_id"}],attrs:{name:"params["+e.index+"]",type:"hidden"},domProps:{value:e.model_id},on:{input:function(t){t.target.composing||(e.model_id=t.target.value)}}}):e._e(),e._l(e.columns,(function(a){return e.columns?t("div",{staticClass:"py-1 w-full"},[a&&a.fillable?t("div",{staticClass:"w-full"},[t("span",{staticClass:"block mb-2",domProps:{textContent:e._s(a.title)}}),"checkbox"===a.column_type&&e.isInput(a.column_type)?t("input",{directives:[{name:"model",rawName:"v-model",value:e.item[a.key],expression:"item[column.key]"}],staticClass:"h-12 mb-3 rounded w-full border px-3 text-gray-700 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{name:"params["+a.key+"]",placeholder:a.title,type:"checkbox"},domProps:{checked:Array.isArray(e.item[a.key])?e._i(e.item[a.key],null)>-1:e.item[a.key]},on:{change:function(t){var s=e.item[a.key],r=t.target,o=!!r.checked;if(Array.isArray(s)){var n=null,l=e._i(s,n);r.checked?l<0&&e.$set(e.item,a.key,s.concat([n])):l>-1&&e.$set(e.item,a.key,s.slice(0,l).concat(s.slice(l+1)))}else e.$set(e.item,a.key,o)}}}):"radio"===a.column_type&&e.isInput(a.column_type)?t("input",{directives:[{name:"model",rawName:"v-model",value:e.item[a.key],expression:"item[column.key]"}],staticClass:"h-12 mb-3 rounded w-full border px-3 text-gray-700 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{name:"params["+a.key+"]",placeholder:a.title,type:"radio"},domProps:{checked:e._q(e.item[a.key],null)},on:{change:function(t){return e.$set(e.item,a.key,null)}}}):e.isInput(a.column_type)?t("input",{directives:[{name:"model",rawName:"v-model",value:e.item[a.key],expression:"item[column.key]"}],staticClass:"h-12 mb-3 rounded w-full border px-3 text-gray-700 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{name:"params["+a.key+"]",placeholder:a.title,type:a.column_type},domProps:{value:e.item[a.key]},on:{input:function(t){t.target.composing||e.$set(e.item,a.key,t.target.value)}}}):e._e(),"password"==a.column_type?t("input",{staticClass:"h-12 mb-3 rounded w-full border px-3 text-gray-700 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{name:"params["+a.key+"]",type:a.column_type,placeholder:a.title}}):e._e(),a.data&&"select"==a.column_type?t("select",{directives:[{name:"model",rawName:"v-model",value:e.item[a.key],expression:"item[column.key]"}],staticClass:"h-12 mb-3 rounded w-full border px-3 text-gray-700 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{name:"params["+a.key+"]",type:a.column_type,placeholder:a.title},on:{change:function(t){var s=Array.prototype.filter.call(t.target.options,(function(e){return e.selected})).map((function(e){var t="_value"in e?e._value:e.value;return t}));e.$set(e.item,a.key,t.target.multiple?s:s[0])}}},[a.required?e._e():t("option",{domProps:{textContent:e._s(e.$parent.__("select"))}}),e._l(a.data,(function(s){return t("option",{domProps:{value:s[a.key],textContent:e._s(s[a.text_key])}})}))],2):e._e(),"file"==a.column_type?t("vue-medialibrary-field",{key:"upload-file",attrs:{name:"params["+a.key+"]",api_url:e.conf.url},model:{value:e.item.picture,callback:function(t){e.$set(e.item,"picture",t)},expression:"item.picture"}}):e._e()],1):e._e()]):e._e()})),t("button",{staticClass:"uppercase h-12 mt-3 text-white w-full rounded bg-red-700 hover:bg-red-800",domProps:{textContent:e._s(e.$parent.__("save"))}})],2)])])},r=[],o={props:["columns","model","model_id","item","index","conf"],data:function(){return{file:""}},methods:{isInput:function(e){switch(e){case"text":case"number":case"email":case"time":case"date":case"phone":case"":return!0}return!1}}},n=o,l=a("2877"),i=Object(l["a"])(n,s,r,!1,null,null,null);t["default"]=i.exports},"7e59":function(e,t,a){"use strict";a.r(t);var s=function(){var e=this,t=e._self._c;return t("div",{staticClass:"w-full flex overflow-auto",staticStyle:{height:"85vh","z-index":"9999"}},[t("div",{staticClass:"w-full"},[e.content&&!e.showLoader?t("main",{staticClass:"flex-1 overflow-x-hidden overflow-y-auto w-full"},[t("div",{staticClass:"px-4 mb-6 py-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 flex w-full"},[t("h1",{staticClass:"font-bold text-lg w-full",domProps:{textContent:e._s(e.content.title)}}),t("a",{staticClass:"uppercase p-2 mx-2 text-center text-white w-32 rounded bg-gradient-purple hover:bg-red-800",attrs:{href:"javascript:;"},on:{click:function(t){e.showLoader=!0,e.showAddSide=!0,e.activeItem={},e.showLoader=!1}}},[e._v(e._s(e.__("add_new")))])]),t("hr",{staticClass:"mt-2"}),t("div",{staticClass:"w-full flex gap gap-6"},[t("data-table",e._b({ref:"devices_orders",on:{actionTriggered:e.handleAction}},"data-table",e.bindings,!1)),e.showAddSide&&e.content&&e.content.fillable?t("side-form-create",{staticClass:"col-md-3",attrs:{conf:e.conf,model:"Routes.create",columns:e.content.fillable}}):e._e(),e.showEditSide&&!e.showAddSide?t("side-form-update",{staticClass:"col-md-3",attrs:{conf:e.conf,model:"Routes.update",item:e.activeItem,model_id:e.activeItem.route_id,index:"route_id",columns:e.content.fillable}}):e._e()],1)]):e._e()])])},r=[],o=a("de7f"),n=a("0c26"),l=a("5f35"),i={components:{dataTableActions:o["default"],sideFormCreate:n["default"],sideFormUpdate:l["default"]},name:"Students",data:function(){return{url:this.conf.url+this.path+"?load=json",content:{title:"",items:[],columns:[]},activeItem:{},showAddSide:!1,showEditSide:!1,showLoader:!0}},computed:{bindings:function(){return this.content.columns.push({key:this.__("actions"),component:o["default"],sortable:!1}),{columns:this.content.columns,fillable:this.content.fillable,data:this.content.items}}},props:["path","lang","setting","conf","auth"],mounted:function(){this.load()},methods:{handleAction:function(e,t){switch(e){case"view":break;case"edit":this.showEditSide=!0,this.showAddSide=!1,this.activeItem=t;break;case"delete":this.$parent.deleteByKey("route_id",t.route_id,"Routes.delete");break}},load:function(){var e=this;this.showLoader=!0,this.$parent.handleGetRequest(this.url).then((function(t){e.setValues(t),e.showLoader=!1}))},setValues:function(e){return this.content=JSON.parse(JSON.stringify(e)),this},__:function(e){return this.$root.$children[0].__(e)}}},d=i,c=a("2877"),u=Object(c["a"])(d,s,r,!1,null,null,null);t["default"]=u.exports},de7f:function(e,t,a){"use strict";a.r(t);var s=function(){var e=this,t=e._self._c;return t("div",{staticClass:"action-buttons flex gap-6 gap text-base"},[e.data.not_editable?e._e():t("button",{staticClass:"hover:text-gray-600 text-purple",on:{click:function(t){return e.handleAction("edit")}}},[t("i",{staticClass:"fa fa-edit"})]),e.data.not_removeable?e._e():t("button",{staticClass:"hover:text-red-400 text-red-600",on:{click:function(t){return e.handleAction("delete")}}},[t("i",{staticClass:"fa fa-trash"})])])},r=[],o={name:"ActionButtons",methods:{handleAction:function(e){this.$root.$children[0].$refs.activeTab.handleAction(e,this.data)}},props:{data:{type:Object,required:!0}}},n=o,l=a("2877"),i=Object(l["a"])(n,s,r,!1,null,null,null);t["default"]=i.exports}}]);
//# sourceMappingURL=chunk-72a28c8f.chunk.js.map