(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2d0b8a18"],{3005:function(t,e,s){"use strict";s.r(e);var i=function(){var t=this,e=t._self._c;return e("div",{staticClass:"w-full flex overflow-auto",staticStyle:{height:"85vh","z-index":"9999"}},[e("div",{staticClass:"w-full"},[t.content&&!t.showLoader?e("main",{staticClass:"flex-1 overflow-x-hidden overflow-y-auto w-full"},[e("div",{staticClass:"px-4 mb-6 py-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 flex w-full"},[e("h1",{staticClass:"font-bold text-lg w-full",domProps:{textContent:t._s(t.content.title)}}),e("a",{staticClass:"uppercase p-2 mx-2 text-center text-white w-32 rounded bg-gradient-purple hover:bg-red-800",attrs:{href:"javascript:;"},on:{click:function(e){t.showLoader=!0,t.showAddSide=!0,t.showLoader=!1,t.activeItem={}}}},[t._v(t._s(t.__("add_new")))])]),e("hr",{staticClass:"mt-2"}),e("div",{staticClass:"w-full flex gap gap-6"},[t.content.users?e("div",{staticClass:"w-full grid lg:grid-cols-3 gap gap-6"},t._l(t.content.users,(function(s){return e("div",{key:s,staticClass:"mb-2 rounded-lg flex items-center space-x-4 gap gap-4 bg-white p-4"},[e("div",{staticClass:"flex-shrink-0 w-20"},[e("div",{staticClass:"relative"},[e("div",{staticClass:"absolute inset-0 rounded-full shadow-inner",attrs:{"aria-hidden":"true"}}),e("img",{staticClass:"relative w-12 h-12 rounded-full",attrs:{src:s.photo,alt:"User avatar"}})])]),e("div",{staticClass:"flex-grow w-full"},[e("div",{staticClass:"text-lg font-medium text-gray-900"},[t._v(t._s(s.first_name)+" "+t._s(s.last_name))]),e("div",{staticClass:"text-sm font-medium text-gray-500",domProps:{textContent:t._s(s.phone)}}),e("div",{staticClass:"text-sm font-medium text-gray-500",domProps:{textContent:t._s(s.email)}})]),e("div",{staticClass:"flex-shrink-0 text-center"},[e("span",{staticClass:"inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800",domProps:{textContent:t._s(s.active?t.__("Active"):t.__("Pending"))}}),s.id==t.auth.id||1==t.auth.role_id?e("span",{staticClass:"my-2 inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 cursor-pointer",domProps:{textContent:t._s(t.__("edit"))},on:{click:function(e){t.showEditSide=!0,t.showAddSide=!1,t.activeItem=s}}}):t._e()])])})),0):t._e(),t.showAddSide&&t.content&&t.content.fillable?e("side-form-create",{staticClass:"col-md-3",attrs:{conf:t.conf,model:"User.create",columns:t.content.fillable}}):t._e(),t.showEditSide&&!t.showAddSide?e("side-form-update",{staticClass:"col-md-3",attrs:{conf:t.conf,model:"User.update",item:t.activeItem,model_id:t.activeItem.id,index:"id",columns:t.content.fillable}}):t._e()],1)]):t._e()])])},a=[],n={name:"Users",data:function(){return{url:this.conf.url+this.path+"?load=json",content:{title:this.__("users"),branches:[],users:[]},activeItem:null,showAddSide:!1,showEditSide:!1,showLoader:!1}},props:["path","lang","setting","conf","auth"],mounted:function(){this.load()},methods:{isMaster:function(){return this.auth&&1==this.auth.role_id},load:function(){var t=this;this.showLoader=!0,this.$parent.handleGetRequest(this.url).then((function(e){t.setValues(e),t.showLoader=!1}))},setValues:function(t){return this.content=JSON.parse(JSON.stringify(t)),this},__:function(t){return this.$root.$children[0].__(t)}}},l=n,o=s("2877"),d=Object(o["a"])(l,i,a,!1,null,null,null);e["default"]=d.exports}}]);
//# sourceMappingURL=chunk-2d0b8a18.chunk.js.map