(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-4038b958","chunk-2d229846"],{"8b7a":function(t,e,a){"use strict";a.r(e);var s=a("ade3"),r=function(){var t=this,e=t._self._c;return e("div",{staticClass:"w-full flex overflow-auto",staticStyle:{height:"85vh","z-index":"9999"}},[e("div",{staticClass:"w-full"},[t.content&&!t.showLoader?e("main",{staticClass:"flex-1 overflow-x-hidden overflow-y-auto w-full"},[e("div",{staticClass:"px-4 mb-6 py-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 flex w-full"},[e("h1",{staticClass:"font-bold text-lg w-full",domProps:{textContent:t._s(t.content.title)}}),e("a",{staticClass:"uppercase p-2 mx-2 text-center text-white w-32 rounded-lg menu-dark hover:bg-purple-800",attrs:{href:"javascript:;"},on:{click:function(e){t.showLoader=!0,t.showAddSide=!0,t.activeItem={},t.showLoader=!1}}},[t._v(t._s(t.__("add_new")))])]),e("hr",{staticClass:"mt-2"}),e("div",{staticClass:"w-full flex gap gap-6"},[e("data-table",t._b({ref:"devices_orders",on:{actionTriggered:t.handleAction}},"data-table",t.bindings,!1)),t.showAddSide?e("div",{staticClass:"col-md-3 sidebar-create-form"},[e("div",{staticClass:"mb-6 p-4 rounded-lg shadow-lg bg-white dark:bg-gray-700"},[e("form",{staticClass:"action py-0 m-auto rounded-lg max-w-xl pb-10",attrs:{action:"/api/create",method:"POST","data-refresh":"1",id:"add-device-form"}},[e("div",{staticClass:"w-full flex"},[e("h1",{staticClass:"w-full m-auto max-w-xl text-base mb-10"},[t._v(t._s(t.__("ADD_new")))]),e("span",{staticClass:"cursor-pointer py-1 px-2",on:{click:function(e){t.showAddSide=!1}}},[e("close_icon")],1)]),e("input",{attrs:{name:"type",type:"hidden",value:"NotificationEvent.create"}}),e("input",{staticClass:"h-12 mt-3 rounded w-full border px-3 text-gray-700 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{name:"params[title]",required:"",type:"text",placeholder:t.__("event title")}}),e("input",{staticClass:"h-12 mt-3 rounded w-full border px-3 text-gray-700 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{name:"params[subject]",type:"text",placeholder:t.__("subject")}}),e("textarea",{staticClass:"mt-3 rounded-lg w-full border px-3 text-gray-700 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{name:"params[body]",type:"text",rows:"4",placeholder:t.__("body")}}),e("label",{staticClass:"block mt-3"},[e("span",{staticClass:"block mb-2",domProps:{textContent:t._s(t.__("model"))}}),e("select",{staticClass:"form-checkbox p-2 px-3 w-full text-orange-600 border border-1 border-gray-400 rounded-lg",attrs:{name:"params[model]"}},t._l(t.content.models,(function(a,s){return e("option",{domProps:{value:a,textContent:t._s(s)}})})),0)]),e("label",{staticClass:"block mt-3"},[e("span",{staticClass:"block mb-2",domProps:{textContent:t._s(t.__("action"))}}),e("select",{staticClass:"form-checkbox p-2 px-3 w-full text-orange-600 border border-1 border-gray-400 rounded-lg",attrs:{name:"params[action]"}},[e("option",{attrs:{value:"create"},domProps:{textContent:t._s(t.__("Create"))}}),e("option",{attrs:{value:"update"},domProps:{textContent:t._s(t.__("Update"))}}),e("option",{attrs:{value:"delete"},domProps:{textContent:t._s(t.__("Delete"))}})])]),e("input",{staticClass:"h-12 mt-3 rounded w-full border px-3 text-gray-700 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{name:"params[action_field]",type:"text",placeholder:t.__("action_field")}}),e("input",{staticClass:"h-12 mt-3 rounded w-full border px-3 text-gray-700 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{name:"params[action_value]",type:"text",placeholder:t.__("action_value")}}),e("label",{staticClass:"block mt-3"},[e("span",{staticClass:"block mb-2",domProps:{textContent:t._s(t.__("receiver_model"))}}),e("select",{staticClass:"form-checkbox p-2 px-3 w-full text-orange-600 border border-1 border-gray-400 rounded-lg",attrs:{name:"params[receiver_model]"}},[e("option",{attrs:{value:"Medians\\Drivers\\Domain\\Driver"},domProps:{textContent:t._s(t.__("Driver"))}}),e("option",{attrs:{value:"Medians\\Parents\\Domain\\Parents"},domProps:{textContent:t._s(t.__("Parent"))}}),e("option",{attrs:{value:"Medians\\Users\\Domain\\User"},domProps:{textContent:t._s(t.__("User"))}})])]),e("label",{staticClass:"flex gap gap-2 items-center mt-3"},[e("input",{directives:[{name:"model",rawName:"v-model",value:t.activeItem.status,expression:"activeItem.status"}],staticClass:"form-checkbox h-5 w-5 text-orange-600",attrs:{name:"params[status]",type:"checkbox"},domProps:Object(s["a"])({checked:t.activeItem.status>0},"checked",Array.isArray(t.activeItem.status)?t._i(t.activeItem.status,null)>-1:t.activeItem.status),on:{change:function(e){var a=t.activeItem.status,s=e.target,r=!!s.checked;if(Array.isArray(a)){var o=null,i=t._i(a,o);s.checked?i<0&&t.$set(t.activeItem,"status",a.concat([o])):i>-1&&t.$set(t.activeItem,"status",a.slice(0,i).concat(a.slice(i+1)))}else t.$set(t.activeItem,"status",r)}}}),e("span",{staticClass:"ml-2 mx-2 text-gray-700"},[t._v(t._s(t.__("Status")))])]),e("button",{staticClass:"uppercase h-12 mt-3 text-white w-full rounded bg-red-700 hover:bg-red-800",domProps:{textContent:t._s(t.__("save"))}})])])]):t._e(),t.showEditSide&&!t.showAddSide?e("div",{staticClass:"col-md-3 mb-6 p-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 sidebar-edit-form"},[e("div",{staticClass:"w-full"},[e("div",{staticClass:"w-full flex"},[e("h1",{staticClass:"w-full m-auto max-w-xl text-base mb-10",domProps:{textContent:t._s(t.__("update"))}}),e("span",{staticClass:"cursor-pointer py-1 px-2",on:{click:function(e){t.showEditSide=!1}}},[e("close_icon")],1)]),e("div",[e("form",{staticClass:"action py-0 m-auto rounded-lg max-w-xl pb-10",attrs:{action:"/api/update",method:"POST","data-refresh":"1",id:"add-device-form"}},[e("input",{attrs:{name:"type",type:"hidden",value:"NotificationEvent.update"}}),e("input",{directives:[{name:"model",rawName:"v-model",value:t.activeItem.id,expression:"activeItem.id"}],attrs:{name:"params[id]",type:"hidden"},domProps:{value:t.activeItem.id},on:{input:function(e){e.target.composing||t.$set(t.activeItem,"id",e.target.value)}}}),e("input",{directives:[{name:"model",rawName:"v-model",value:t.activeItem.title,expression:"activeItem.title"}],staticClass:"h-12 mt-3 rounded w-full border px-3 text-gray-700 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{name:"params[title]",required:"",type:"text",placeholder:t.__("event title")},domProps:{value:t.activeItem.title},on:{input:function(e){e.target.composing||t.$set(t.activeItem,"title",e.target.value)}}}),e("input",{directives:[{name:"model",rawName:"v-model",value:t.activeItem.subject,expression:"activeItem.subject"}],staticClass:"h-12 mt-3 rounded w-full border px-3 text-gray-700 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{name:"params[subject]",type:"text",placeholder:t.__("subject")},domProps:{value:t.activeItem.subject},on:{input:function(e){e.target.composing||t.$set(t.activeItem,"subject",e.target.value)}}}),e("textarea",{directives:[{name:"model",rawName:"v-model",value:t.activeItem.body,expression:"activeItem.body"}],staticClass:"mt-3 rounded-lg w-full border px-3 text-gray-700 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{name:"params[body]",type:"text",rows:"4",placeholder:t.__("body")},domProps:{value:t.activeItem.body},on:{input:function(e){e.target.composing||t.$set(t.activeItem,"body",e.target.value)}}}),e("label",{staticClass:"block mt-3"},[e("span",{staticClass:"block mb-2",domProps:{textContent:t._s(t.__("model"))}}),e("select",{directives:[{name:"model",rawName:"v-model",value:t.activeItem.model,expression:"activeItem.model"}],staticClass:"form-checkbox p-2 px-3 w-full text-orange-600 border border-1 border-gray-400 rounded-lg",attrs:{name:"params[model]"},on:{change:function(e){var a=Array.prototype.filter.call(e.target.options,(function(t){return t.selected})).map((function(t){var e="_value"in t?t._value:t.value;return e}));t.$set(t.activeItem,"model",e.target.multiple?a:a[0])}}},t._l(t.content.models,(function(a,s){return e("option",{domProps:{value:a,textContent:t._s(s)}})})),0)]),e("label",{staticClass:"block mt-3"},[e("span",{staticClass:"block mb-2",domProps:{textContent:t._s(t.__("action"))}}),e("select",{directives:[{name:"model",rawName:"v-model",value:t.activeItem.action,expression:"activeItem.action"}],staticClass:"form-checkbox p-2 px-3 w-full text-orange-600 border border-1 border-gray-400 rounded-lg",attrs:{name:"params[action]"},on:{change:function(e){var a=Array.prototype.filter.call(e.target.options,(function(t){return t.selected})).map((function(t){var e="_value"in t?t._value:t.value;return e}));t.$set(t.activeItem,"action",e.target.multiple?a:a[0])}}},[e("option",{attrs:{value:"create"},domProps:{textContent:t._s(t.__("Create"))}}),e("option",{attrs:{value:"update"},domProps:{textContent:t._s(t.__("Update"))}}),e("option",{attrs:{value:"delete"},domProps:{textContent:t._s(t.__("Delete"))}})])]),e("input",{directives:[{name:"model",rawName:"v-model",value:t.activeItem.action_field,expression:"activeItem.action_field"}],staticClass:"h-12 mt-3 rounded w-full border px-3 text-gray-700 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{name:"params[action_field]",type:"text",placeholder:t.__("action_field")},domProps:{value:t.activeItem.action_field},on:{input:function(e){e.target.composing||t.$set(t.activeItem,"action_field",e.target.value)}}}),e("input",{directives:[{name:"model",rawName:"v-model",value:t.activeItem.action_value,expression:"activeItem.action_value"}],staticClass:"h-12 mt-3 rounded w-full border px-3 text-gray-700 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{name:"params[action_value]",type:"text",placeholder:t.__("action_value")},domProps:{value:t.activeItem.action_value},on:{input:function(e){e.target.composing||t.$set(t.activeItem,"action_value",e.target.value)}}}),e("label",{staticClass:"block mt-3"},[e("span",{staticClass:"block mb-2",domProps:{textContent:t._s(t.__("receiver_model"))}}),e("select",{directives:[{name:"model",rawName:"v-model",value:t.activeItem.receiver_model,expression:"activeItem.receiver_model"}],staticClass:"form-checkbox p-2 px-3 w-full text-orange-600 border border-1 border-gray-400 rounded-lg",attrs:{name:"params[receiver_model]"},on:{change:function(e){var a=Array.prototype.filter.call(e.target.options,(function(t){return t.selected})).map((function(t){var e="_value"in t?t._value:t.value;return e}));t.$set(t.activeItem,"receiver_model",e.target.multiple?a:a[0])}}},[e("option",{attrs:{value:"Medians\\Drivers\\Domain\\Driver"},domProps:{textContent:t._s(t.__("Driver"))}}),e("option",{attrs:{value:"Medians\\Parents\\Domain\\Parents"},domProps:{textContent:t._s(t.__("Parent"))}}),e("option",{attrs:{value:"Medians\\Users\\Domain\\User"},domProps:{textContent:t._s(t.__("User"))}})])]),e("label",{staticClass:"flex gap gap-2 items-center mt-3"},[e("input",{directives:[{name:"model",rawName:"v-model",value:t.activeItem.status,expression:"activeItem.status"}],staticClass:"form-checkbox h-5 w-5 text-orange-600",attrs:{name:"params[status]",type:"checkbox"},domProps:Object(s["a"])({checked:1==t.activeItem.status},"checked",Array.isArray(t.activeItem.status)?t._i(t.activeItem.status,null)>-1:t.activeItem.status),on:{change:function(e){var a=t.activeItem.status,s=e.target,r=!!s.checked;if(Array.isArray(a)){var o=null,i=t._i(a,o);s.checked?i<0&&t.$set(t.activeItem,"status",a.concat([o])):i>-1&&t.$set(t.activeItem,"status",a.slice(0,i).concat(a.slice(i+1)))}else t.$set(t.activeItem,"status",r)}}}),e("span",{staticClass:"ml-2 mx-2 text-gray-700"},[t._v(t._s(t.__("Status")))])]),e("button",{staticClass:"uppercase h-10 mt-3 text-white w-full rounded bg-red-700 hover:bg-red-800"},[t._v(t._s(t.__("Update")))])])])])]):t._e()],1)]):t._e()])])},o=[],i=a("de7f"),n={components:{dataTableActions:i["default"]},name:"plans",data:function(){return{url:this.conf.url+this.path+"?load=json",content:{title:"",items:[],columns:[],models:[]},activeItem:{},showAddSide:!1,showEditSide:!1,showLoader:!0}},computed:{bindings:function(){return this.content.columns.push({key:this.__("actions"),component:i["default"],sortable:!1}),{columns:this.content.columns,data:this.content.items}}},props:["path","lang","setting","conf","auth"],mounted:function(){this.load()},methods:{handleAction:function(t,e){switch(t){case"view":break;case"edit":this.showEditSide=!0,this.showAddSide=!1,this.activeItem=e;break;case"delete":this.$parent.delete(e,"NotificationEvent.delete");break}},load:function(){var t=this;this.showLoader=!0,this.$parent.handleGetRequest(this.url).then((function(e){t.setValues(e),t.showLoader=!1}))},setValues:function(t){return this.content=JSON.parse(JSON.stringify(t)),this},__:function(t){return this.$root.$children[0].__(t)}}},l=n,c=(a("a180"),a("2877")),d=Object(c["a"])(l,r,o,!1,null,null,null);e["default"]=d.exports},a180:function(t,e,a){"use strict";a("d695")},d695:function(t,e,a){},de7f:function(t,e,a){"use strict";a.r(e);var s=function(){var t=this,e=t._self._c;return e("div",{staticClass:"action-buttons flex gap-6 gap text-base"},[t.data.not_editable?t._e():e("button",{staticClass:"hover:text-gray-600 text-purple",on:{click:function(e){return t.handleAction("edit")}}},[e("i",{staticClass:"fa fa-edit"})]),t.data.not_removeable?t._e():e("button",{staticClass:"hover:text-red-400 text-red-600",on:{click:function(e){return t.handleAction("delete")}}},[e("i",{staticClass:"fa fa-trash"})])])},r=[],o={name:"ActionButtons",methods:{handleAction:function(t){this.$root.$children[0].$refs.activeTab.$refs.data_table?this.$root.$children[0].$refs.activeTab.$refs.data_table.handleAction(t,this.data):this.$root.$children[0].$refs.activeTab.handleAction(t,this.data)}},props:{data:{type:Object,required:!0}}},i=o,n=a("2877"),l=Object(n["a"])(i,s,r,!1,null,null,null);e["default"]=l.exports}}]);
//# sourceMappingURL=chunk-4038b958.chunk.js.map