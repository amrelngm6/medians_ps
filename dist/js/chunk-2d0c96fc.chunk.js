(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2d0c96fc"],{"58ad":function(t,s,a){"use strict";a.r(s);a("7f7f");var e=function(){var t=this,s=t._self._c;return s("div",{staticClass:"w-full"},[s("div",{staticClass:"container-fluid"},[s("div",{staticClass:"row"},[s("div",{staticClass:"col-lg-12"},[s("div",{staticClass:"card mt-n4 mx-n4 card-border-effect-none"},[s("div",{staticClass:"bg-primary-subtle"},[s("div",{staticClass:"card-body pb-0 px-4"},[s("ul",{staticClass:"gap-6 flex nav nav-tabs-custom border-bottom-0",attrs:{role:"tablist"}},t._l(t.statusList,(function(a){return s("li",{staticClass:"nav-item",attrs:{role:"presentation"}},[s("a",{staticClass:"nav-link fw-semibold",class:a.status==t.activeStatus?"font-bold":"",attrs:{"data-bs-toggle":"tab",href:"#project-overview",role:"tab","aria-selected":"false",tabindex:"-1"},domProps:{textContent:t._s(a.text)},on:{click:function(s){return t.switchStatus(a)}}})])})),0)])])])])]),s("div",{staticClass:"row"},[s("div",{staticClass:"col-lg-12"},[s("div",{staticClass:"tab-content text-muted"},[s("div",{staticClass:"w-full"},[t._m(0),t._l(t.content.items,(function(a){return s("div",{staticClass:"team-list list-view-filter"},[s("div",{staticClass:"card team-box"},[s("div",{staticClass:"card-body px-4"},[s("div",{staticClass:"row align-items-center team-row"},[t._m(1,!0),s("div",{staticClass:"col-lg-4 col"},[s("div",{staticClass:"team-profile-img"},[s("div",{staticClass:"avatar-lg img-thumbnail rounded-circle"},[a.user?s("img",{staticClass:"img-fluid d-block rounded-circle",attrs:{src:a.user.picture,alt:""}}):t._e()]),s("div",{staticClass:"team-content"},[s("a",{staticClass:"d-block",attrs:{href:"#"}},[a.user?s("h5",{staticClass:"fs-16 mb-1",domProps:{textContent:t._s(a.user.name)}}):t._e()]),s("p",{staticClass:"text-muted mb-0",domProps:{textContent:t._s(a.message)}})])])]),s("div",{staticClass:"col-lg-4 col"},[s("div",{staticClass:"row text-muted text-center"},[s("div",{staticClass:"col-6 border-end border-end-dashed"},[s("h5",{staticClass:"mb-1",domProps:{textContent:t._s(t.__("Created at"))}}),s("p",{staticClass:"text-muted mb-0",domProps:{textContent:t._s(a.date)}})]),s("div",{staticClass:"col-6"},[s("h5",{staticClass:"mb-1",domProps:{textContent:t._s(t.__("Updated at"))}}),s("p",{staticClass:"text-muted mb-0",domProps:{textContent:t._s(a.updated_at)}})])])]),s("div",{staticClass:"col-lg-2 col"},[s("div",{staticClass:"text-end"},[s("a",{staticClass:"menu-dark text-white px-4 py-2 rounded-lg",attrs:{href:"javascript:;"},domProps:{textContent:t._s(t.__("Details"))},on:{click:function(s){return t.showDetails(a)}}})])])])])])])}))],2)])])])])])},i=[function(){var t=this,s=t._self._c;return s("div",{staticClass:"row g-4 mb-3"},[s("div",{staticClass:"col-sm"},[s("div",{staticClass:"d-flex"},[s("div",{staticClass:"search-box me-2"},[s("input",{staticClass:"form-control",attrs:{type:"text",placeholder:"Search member..."}}),s("i",{staticClass:"ri-search-line search-icon"})])])]),s("div",{staticClass:"col-sm-auto"},[s("div",[s("button",{staticClass:"btn btn-danger",attrs:{type:"button","data-bs-toggle":"modal","data-bs-target":"#inviteMembersModal"}},[s("i",{staticClass:"ri-share-line me-1 align-bottom"}),t._v(" Invite Member")])])])])},function(){var t=this,s=t._self._c;return s("div",{staticClass:"col team-settings"},[s("div",{staticClass:"row align-items-center"},[s("div",{staticClass:"col"},[s("div",{staticClass:"flex-shrink-0 me-2"},[s("button",{staticClass:"btn fs-16 p-0 favourite-btn",attrs:{type:"button"}},[s("i",{staticClass:"ri-star-fill"})])])]),s("div",{staticClass:"col text-end dropdown"},[s("a",{attrs:{href:"javascript:void(0);","data-bs-toggle":"dropdown","aria-expanded":"false"}},[s("i",{staticClass:"ri-more-fill fs-17"})])])])])}],l={data:function(){return{url:this.conf.url+this.path+"?load=json",content:{title:"",items:[],columns:[]},activeItem:{},showAddSide:!1,showEditSide:!1,showLoader:!0,activeStatus:!0,statusList:[{text:this.__("New"),status:"new"},{text:this.__("Active"),status:"active"},{text:this.__("Completed"),status:"completed"},{text:this.__("Closed"),status:"closed"}]}},props:["path","lang","setting","conf","auth"],mounted:function(){this.load()},methods:{showDetails:function(t){this.showEditSide=!0,this.activeItem=t},handleAction:function(t,s){switch(t){case"view":break;case"edit":this.showEditSide=!0,this.showAddSide=!1,this.activeItem=s;break;case"delete":this.$root.$children[0].deleteByKey(this.object_key,s,this.object_name+".delete");break}},load:function(){var t=this;this.showLoader=!0,this.$root.$children[0].handleGetRequest(this.url).then((function(s){t.setValues(s),t.showLoader=!1}))},setValues:function(t){return this.content=JSON.parse(JSON.stringify(t)),this},__:function(t){return this.$root.$children[0].__(t)}}},o=l,c=a("2877"),n=Object(c["a"])(o,e,i,!1,null,null,null);s["default"]=n.exports}}]);
//# sourceMappingURL=chunk-2d0c96fc.chunk.js.map