(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-fecbf85c","chunk-2d229846"],{"5e23":function(t,e,a){"use strict";a.r(e);var s=function(){var t=this,e=t._self._c;return e("div",{staticClass:"w-full flex overflow-auto",staticStyle:{height:"85vh","z-index":"9999"}},[e("div",{staticClass:"w-full relative"},[t.showLoader?e("div",{staticClass:"mx-auto mt-10 absolute top-0 left-0 right-0 bottom-0 m-auto w-40 h-40"},[e("img",{attrs:{src:t.conf.url+"uploads/images/loader.gif"}})]):t._e(),t.content&&!t.showLoader?e("main",{staticClass:"flex-1 overflow-x-hidden overflow-y-auto w-full"},[e("div",{staticClass:"px-4 mb-6 py-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 flex w-full"},[e("h1",{staticClass:"font-bold text-lg w-full",domProps:{textContent:t._s(t.content.title)}}),e("a",{staticClass:"uppercase p-2 mx-2 text-center text-white w-32 rounded-lg menu-dark hover:bg-purple-800",attrs:{href:"javascript:;"},on:{click:function(e){t.showLoader=!0,t.showAddSide=!0,t.showLoader=!1}}},[t._v(t._s(t.__("add_new")))])]),e("hr",{staticClass:"mt-2"}),e("div",{staticClass:"w-full flex gap gap-6"},[e("data-table",t._b({ref:"pages",on:{actionTriggered:t.handleAction}},"data-table",t.bindings,!1)),t.showAddSide?e("div",{staticClass:"col-md-3 sidebar-create-form"},[e("div",{staticClass:"mb-6 p-4 rounded-lg shadow-lg bg-white dark:bg-gray-700"},[e("form",{staticClass:"action py-0 m-auto rounded-lg max-w-xl pb-10",attrs:{action:"/api/create",method:"POST","data-refresh":"1",id:"add-device-form"}},[e("div",{staticClass:"w-full flex"},[e("h1",{staticClass:"w-full m-auto max-w-xl text-base mb-10"},[t._v(t._s(t.__("ADD_NEW")))]),e("span",{staticClass:"cursor-pointer py-1 px-2",on:{click:function(e){t.showAddSide=!1,t.activeItem={}}}},[e("close_icon")],1)]),e("input",{attrs:{name:"type",type:"hidden",value:"Page.create"}}),e("input",{attrs:{name:"params[status]",type:"hidden",value:"1"}}),e("input",{directives:[{name:"model",rawName:"v-model",value:t.altTitle,expression:"altTitle"}],attrs:{name:"params[title]",type:"hidden"},domProps:{value:t.altTitle},on:{input:function(e){e.target.composing||(t.altTitle=e.target.value)}}}),e("span",{staticClass:"block my-2",domProps:{textContent:t._s(t.__("title")+" AR")}}),e("input",{directives:[{name:"model",rawName:"v-model",value:t.altTitle,expression:"altTitle"}],staticClass:"h-12 mt-3 rounded w-full border px-3 text-gray-700 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{name:"params[content][ar][title]",required:"",type:"text"},domProps:{value:t.altTitle},on:{input:function(e){e.target.composing||(t.altTitle=e.target.value)}}}),e("span",{staticClass:"block mb-2",domProps:{textContent:t._s(t.__("title")+" EN")}}),e("input",{staticClass:"h-12 mt-3 rounded w-full border px-3 text-gray-700 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",attrs:{name:"params[content][en][title]",required:"",type:"text",placeholder:t.__("Title")}}),e("button",{staticClass:"uppercase h-12 mt-3 text-white w-full rounded bg-red-700 hover:bg-red-800",domProps:{textContent:t._s(t.__("save"))}})])])]):t._e()],1)]):t._e()])])},n=[],o=a("de7f"),i={components:{dataTableActions:o["default"]},name:"pages",data:function(){return{url:this.conf.url+this.path+"?load=json",content:{title:"",items:[],columns:[]},activeItem:{},showAddSide:!1,showEditSide:!1,showLoader:!0}},computed:{bindings:function(){return this.content.columns.push({key:this.__("actions"),component:o["default"],sortable:!1}),{columns:this.content.columns,data:this.content.items}}},props:["path","lang","setting","conf","auth"],mounted:function(){this.load()},methods:{handleAction:function(t,e){switch(t){case"view":window.open(this.conf.url+e.content.prefix);break;case"edit":window.open(this.conf.url+"builder?prefix="+e.content.prefix);break;case"delete":this.$parent.delete(e,"Page.delete");break}console.log(t,e)},load:function(){var t=this;this.showLoader=!0,this.$parent.handleGetRequest(this.url).then((function(e){t.setValues(e),t.showLoader=!1}))},setValues:function(t){return this.content=JSON.parse(JSON.stringify(t)),this},__:function(t){return this.$root.$children[0].__(t)}}},l=i,r=(a("9e29"),a("2877")),d=Object(r["a"])(l,s,n,!1,null,null,null);e["default"]=d.exports},"9e29":function(t,e,a){"use strict";a("e885")},de7f:function(t,e,a){"use strict";a.r(e);var s=function(){var t=this,e=t._self._c;return e("div",{staticClass:"action-buttons flex gap-6 gap text-base"},[t.data.not_editable?t._e():e("button",{staticClass:"hover:text-gray-600 text-purple",on:{click:function(e){return t.handleAction("edit")}}},[e("i",{staticClass:"fa fa-edit"})]),t.data.not_removeable?t._e():e("button",{staticClass:"hover:text-red-400 text-red-600",on:{click:function(e){return t.handleAction("delete")}}},[e("i",{staticClass:"fa fa-trash"})])])},n=[],o={name:"ActionButtons",methods:{handleAction:function(t){this.$root.$children[0].$refs.activeTab.$refs.data_table.handleAction(t,this.data)}},props:{data:{type:Object,required:!0}}},i=o,l=a("2877"),r=Object(l["a"])(i,s,n,!1,null,null,null);e["default"]=r.exports},e885:function(t,e,a){}}]);
//# sourceMappingURL=chunk-fecbf85c.chunk.js.map