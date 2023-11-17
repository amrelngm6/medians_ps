(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2d0b8a18"],{3005:function(t,e,s){"use strict";s.r(e);s("7f7f");var a=function(){var t=this,e=t._self._c;return e("div",{staticClass:"w-full flex overflow-auto",staticStyle:{height:"85vh","z-index":"9999"}},[e("div",{staticClass:"w-full"},[t.content&&!t.showLoader?e("main",{staticClass:"flex-1 overflow-x-hidden overflow-y-auto w-full"},[e("div",{staticClass:"px-4 mb-6 py-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 flex w-full"},[e("h1",{staticClass:"font-bold text-lg w-full",domProps:{textContent:t._s(t.content.title)}}),e("a",{staticClass:"menu-dark uppercase p-2 mx-2 text-center text-white w-32 rounded bg-gradient-purple hover:bg-red-800",attrs:{href:"javascript:;"},on:{click:function(e){t.showLoader=!0,t.showAddSide=!0,t.showLoader=!1,t.activeItem={}}}},[t._v(t._s(t.__("add_new")))])]),e("hr",{staticClass:"mt-2"}),e("div",{staticClass:"w-full flex gap gap-6"},[t.content.users?e("div",{staticClass:"w-full"},t._l(t.content.roles,(function(s){return e("div",{staticClass:"w-full pb-4"},[e("h3",{staticClass:"pb-b flex gap-4"},[e("span",{domProps:{textContent:t._s(s.name)}}),e("span",{staticClass:"pt-2 text-sm text-muted",domProps:{textContent:t._s(s.id>1?t.__("Theese users can manage your account only"):"")}})]),e("hr"),e("div",{staticClass:"w-full grid lg:grid-cols-3 gap gap-6"},t._l(t.content.users,(function(a){return a&&a.role_id==s.id?e("div",{key:a,staticClass:"mb-2 rounded-lg flex items-center space-x-4 gap gap-4 bg-white p-4"},[e("div",{staticClass:"flex-shrink-0"},[e("div",{staticClass:"relative"},[e("div",{staticClass:"absolute inset-0 rounded-full shadow-inner",attrs:{"aria-hidden":"true"}}),e("img",{staticClass:"relative w-12 h-12 rounded-full",attrs:{src:a.photo,alt:"User avatar"}})])]),e("div",{staticClass:"flex-grow w-full"},[e("div",{staticClass:"text-lg font-medium text-gray-900"},[t._v(t._s(a.first_name)+" "+t._s(a.last_name))]),e("div",{staticClass:"text-sm font-medium text-gray-500",domProps:{textContent:t._s(a.phone)}}),e("div",{staticClass:"text-sm font-medium text-gray-500",domProps:{textContent:t._s(a.email)}})]),e("div",{staticClass:"text-center"},[e("div",{staticClass:"flex gap gap-2 cursor-pointer",on:{click:function(e){return t.setActiveStatus(a)}}},[e("span",{staticClass:"mt-1 bg-red-400 block h-4 relative rounded-full w-8",class:a.active?"":"bg-inverse-dark",staticStyle:{direction:"ltr"}},[e("a",{staticClass:"absolute bg-white block h-4 relative right-0 rounded-full w-4",style:{left:a.active?"16px":0}})]),e("span",{staticClass:"font-semibold inline-flex items-center px-2 py-1 rounded-full text-xs font-medium",domProps:{textContent:t._s(a.active?t.__("Active"):t.__("Pending"))}})]),a.id==t.auth.id||1==t.auth.role_id?e("span",{staticClass:"hover:bg-purple-800 hover:text-gray-100 my-2 inline-flex items-center px-6 py-1 rounded-full text-xs pb-2 font-medium bg-blue-100 text-blue-800 cursor-pointer",domProps:{textContent:t._s(t.__("edit"))},on:{click:function(e){t.showEditSide=!0,t.showAddSide=!1,t.activeItem=a}}}):t._e()])]):t._e()})),0)])})),0):t._e(),t.showAddSide&&t.content&&t.content.fillable?e("side-form-create",{staticClass:"col-md-3",attrs:{conf:t.conf,model:"User.create",columns:t.content.fillable}}):t._e(),t.showEditSide&&!t.showAddSide?e("side-form-update",{staticClass:"col-md-3",attrs:{conf:t.conf,model:"User.update",item:t.activeItem,model_id:t.activeItem.id,index:"id",columns:t.content.fillable}}):t._e()],1)]):t._e()])])},i=[],n={name:"Users",data:function(){return{url:this.conf.url+this.path+"?load=json",content:{title:this.__("users"),roles:[],users:[]},activeItem:null,showAddSide:!1,showEditSide:!1,showLoader:!1}},props:["path","lang","setting","conf","auth"],mounted:function(){this.load()},methods:{isMaster:function(){return this.auth&&1==this.auth.role_id},setActiveStatus:function(t){var e=this;this.showLoader=!0,t.active=!t.access,this.showLoader=!1;var s=new URLSearchParams;s.append("type","User.update"),s.append("params",JSON.stringify(t)),this.$root.$children[0].handleRequest(s,"/api/update").then((function(t){e.$alert(t.result).then((function(){}))}))},load:function(){var t=this;this.showLoader=!0,this.$parent.handleGetRequest(this.url).then((function(e){t.setValues(e),t.showLoader=!1}))},setValues:function(t){return this.content=JSON.parse(JSON.stringify(t)),this},__:function(t){return this.$root.$children[0].__(t)}}},l=n,o=s("2877"),r=Object(o["a"])(l,a,i,!1,null,null,null);e["default"]=r.exports}}]);
//# sourceMappingURL=chunk-2d0b8a18.chunk.js.map