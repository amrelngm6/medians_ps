(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2d0c96fc"],{"58ad":function(t,s,e){"use strict";e.r(s);e("7f7f");var a=function(){var t=this,s=t._self._c;return s("div",{staticClass:"w-full"},[t.showEditSide?s("help_message_details",{ref:t.activeItem,attrs:{item:t.activeItem},on:{callback:t.closeMessage}}):t._e(),t.showEditSide?t._e():s("div",{staticClass:"container-fluid"},[s("div",{staticClass:"row"},[s("div",{staticClass:"col-lg-12"},[s("div",{staticClass:"card mt-n4 mx-n4 card-border-effect-none"},[t.showLoader?t._e():s("div",{staticClass:"bg-primary-subtle"},[s("div",{staticClass:"card-body pb-0 px-4"},[s("span",{staticClass:"text-lg font-semibold",domProps:{textContent:t._s(t.content.title)}})])])])])]),s("div",{staticClass:"row"},[s("div",{staticClass:"col-lg-12"},[s("div",{staticClass:"tab-content text-muted"},[s("div",{staticClass:"w-full"},[s("div",{staticClass:"lg:flex g-4 mb-3"},[s("div",{staticClass:"w-full"},[s("ul",{staticClass:"pt-2 gap-6 flex nav nav-tabs-custom border-bottom-0",attrs:{role:"tablist"}},t._l(t.statusList,(function(e){return s("li",{staticClass:"nav-item",attrs:{role:"presentation"},on:{click:function(s){return t.switchStatus(e)}}},[s("span",{staticClass:"nav-link fw-semibold cursor-pointer",class:e.status==t.activeStatus?"font-bold":"",domProps:{textContent:t._s(e.text)}})])})),0)]),t._m(0)]),t._l(t.content.items,(function(e){return s("div",{staticClass:"team-list list-view-filter"},[t.showLoader||"all"!=t.activeStatus&&e.status!=t.activeStatus?t._e():s("div",{staticClass:"card team-box"},[s("div",{staticClass:"card-body px-4"},[s("div",{staticClass:"row align-items-center team-row"},[s("div",{staticClass:"col-lg-4 col"},[s("div",{staticClass:"team-profile-img gap-4 flex"},[s("div",{staticClass:"avatar-lg img-thumbnail rounded-circle"},[e.user?s("img",{staticClass:"img-fluid d-block rounded-circle",attrs:{src:e.user.picture,alt:""}}):t._e()]),s("div",{staticClass:"team-content"},[s("a",{staticClass:"d-block",attrs:{href:"#"}},[e.user?s("h5",{staticClass:"fs-16 mb-1 font-semibold",domProps:{textContent:t._s(e.user.name)}}):t._e()]),s("p",{staticClass:"text-muted mb-0",domProps:{textContent:t._s(e.message)}})])])]),s("div",{staticClass:"col-lg-6 col"},[s("div",{staticClass:"row text-muted text-center"},[s("div",{staticClass:"col-4 border-end border-end-dashed"},[s("h5",{staticClass:"mb-1 font-semibold",domProps:{textContent:t._s(t.__("Created at"))}}),s("p",{staticClass:"text-muted mb-0",domProps:{textContent:t._s(e.date)}})]),s("div",{staticClass:"col-4"},[s("h5",{staticClass:"mb-1 font-semibold",domProps:{textContent:t._s(t.__("Updated at"))}}),s("p",{staticClass:"text-muted mb-0",domProps:{textContent:t._s(e.last_update)}})]),s("div",{staticClass:"col-4"},[s("h5",{staticClass:"mb-1 font-semibold",domProps:{textContent:t._s(t.__("Status"))}}),s("p",{staticClass:"text-muted mb-0",domProps:{textContent:t._s(e.status)}})])])]),s("div",{staticClass:"col-lg-2 col"},[s("div",{staticClass:"text-end"},[s("a",{staticClass:"menu-dark text-white px-4 py-2 rounded-lg",attrs:{href:"javascript:;"},domProps:{textContent:t._s(t.__("Details"))},on:{click:function(s){return t.showDetails(e)}}})])])])])])])}))],2)])])])])],1)},i=[function(){var t=this,s=t._self._c;return s("div",{staticClass:"w-auto"},[s("div",{staticClass:"d-flex"},[s("div",{staticClass:"search-box me-2"})])])}],o={data:function(){return{url:this.conf.url+this.path+"?load=json",content:{title:"",items:[],columns:[]},activeItem:{},showAddSide:!1,showEditSide:!1,showLoader:!0,activeStatus:"new",statusList:[{text:this.__("New"),status:"new"},{text:this.__("Active"),status:"active"},{text:this.__("Completed"),status:"completed"},{text:this.__("Closed"),status:"closed"}]}},props:["path","lang","setting","conf","auth"],mounted:function(){this.load()},methods:{closeMessage:function(){this.showLoader=!0,this.showEditSide=!1,this.activeItem=null,this.showLoader=!1},switchStatus:function(t){this.showLoader=!0,this.activeStatus=t.status,this.showLoader=!1},showDetails:function(t){this.showLoader=!0,this.showEditSide=!0,this.activeItem=t,this.showLoader=!1},handleAction:function(t,s){switch(t){case"view":break;case"edit":this.showEditSide=!0,this.showAddSide=!1,this.activeItem=s;break;case"delete":this.$root.$children[0].deleteByKey(this.object_key,s,this.object_name+".delete");break}},load:function(){var t=this;this.showLoader=!0,this.$root.$children[0].handleGetRequest(this.url).then((function(s){t.setValues(s),t.showLoader=!1}))},setValues:function(t){return this.content=JSON.parse(JSON.stringify(t)),this},__:function(t){return this.$root.$children[0].__(t)}}},l=o,c=e("2877"),d=Object(c["a"])(l,a,i,!1,null,null,null);s["default"]=d.exports}}]);
//# sourceMappingURL=chunk-2d0c96fc.chunk.js.map