(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2d22fdaf"],{ea96:function(t,e,s){"use strict";s.r(e);s("7f7f");var i=function(){var t=this,e=t._self._c;return e("div",{staticClass:"w-full pb-20"},[t.showProfile&&!t.showLoader?e("div",{staticClass:"relative w-full"},[e("driver_profile",{key:t.activeItem,attrs:{item:t.activeItem},on:{edit:t.handleAction,close:t.handleAction}})],1):t._e(),!t.content||t.showProfile||t.showLoader?t._e():e("main",{staticClass:"px-4 flex-1 overflow-x-hidden overflow-y-auto w-full mb-20"},[e("div",{staticClass:"px-4 mb-6 py-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 flex w-full"},[e("h1",{staticClass:"font-bold text-lg w-full",domProps:{textContent:t._s(t.content.title)}}),e("a",{staticClass:"uppercase p-2 mx-2 text-center text-white w-32 rounded-lg menu-dark hover:bg-purple-800",attrs:{href:"javascript:;"},on:{click:function(e){t.showLoader=!0,t.showAddSide=!0,t.activeItem={},t.showLoader=!1}}},[t._v(t._s(t.__("add_new")))])]),e("div",{staticClass:"relative card ribbon-box border shadow-none mb-lg-0"},[e("div",{staticClass:"card-body"},[e("div",{staticClass:"ribbon ribbon-primary round-shape",domProps:{textContent:t._s(t.__("Important"))}}),e("h5",{staticClass:"fs-14 text-end ml-20",domProps:{textContent:t._s(t.__("Before Create Account"))}}),e("div",{staticClass:"ribbon-content mt-4 text-muted"},[e("div",{staticClass:"mb-0",domProps:{innerHTML:t._s(t.__("Before Create driver note"))}})])])]),t.showLoader?t._e():e("div",{staticClass:"sm:grid sm:space-y-0 space-y-6 xl:!grid-cols-3 md:grid-cols-2 gap-6"},t._l(t.content.items,(function(s){return e("div",{staticClass:"box mb-0 overflow-hidden p-4 bg-white rounded-xl"},[e("div",{staticClass:"box-body space-y-5"},[e("div",{staticClass:"flex"},[e("div",{staticClass:"sm:flex sm:space-x-3 sm:space-y-0 space-y-4 rtl:space-x-reverse"},[e("img",{staticClass:"avatar avatar-lg rounded-sm",attrs:{src:s.picture,alt:"Image Description"}}),e("div",{staticClass:"space-y-1 my-auto"},[e("h5",{staticClass:"cursor-pointer font-semibold text-base leading-none",domProps:{textContent:t._s(s.name)},on:{click:function(e){return t.handleAction("view",s)}}}),e("p",{staticClass:"text-gray-500 dark:text-white/70 font-semibold text-xs truncate max-w-[9rem]",domProps:{textContent:t._s(s.email)}}),e("p",{staticClass:"text-primary dark:text-primary text-xs font-semibold",domProps:{textContent:t._s(s.contact_number)}})])])])]),e("div",{staticClass:"box-footer mt-6"},[e("div",{staticClass:"grid grid-cols-12 gap-x-3"},[e("div",{staticClass:"sm:col-span-2 col-span-4"},[e("span",{staticClass:"cursor-pointer inline-flex !p-1 flex-shrink-0 justify-center items-center gap-2 rounded-sm border font-medium bg-white text-gray-500 shadow-sm align-middle focus:outline-none focus:ring-0 focus:ring-offset-0 focus:ring-offset-white focus:ring-primary transition-all text-xs dark:bg-bgdark dark:border-white/10 dark:text-white/70 dark:focus:ring-offset-white/10",on:{click:function(e){return t.handleAction("view",s)}}},[e("i",{staticClass:"fa fa-eye py-1 px-2"})])]),e("div",{staticClass:"sm:col-span-8 col-span-4",on:{click:function(e){return t.handleAction("edit",s)}}},[e("span",{staticClass:"cursor-pointer inline-flex !p-1 flex-shrink-0 justify-center items-center gap-2 w-full rounded-sm border font-medium bg-white text-gray-500 shadow-sm align-middle focus:outline-none focus:ring-0 focus:ring-offset-0 focus:ring-offset-white focus:ring-primary transition-all text-xs dark:bg-bgdark dark:border-white/10 dark:text-white/70 dark:focus:ring-offset-white/10"},[e("i",{staticClass:"fa fa-edit py-1"}),e("span",{staticClass:"text-base",domProps:{textContent:t._s(t.__("Edit"))}})])]),e("div",{staticClass:"sm:col-span-2 col-span-4"},[e("div",{staticClass:"hs-dropdown ti-dropdown flex justify-end"},[e("span",{staticClass:"cursor-pointer hs-dropdown-toggle ti-dropdown-toggle inline-flex !p-1 flex-shrink-0 justify-center items-center gap-2 rounded-sm border font-medium bg-white text-gray-500 shadow-sm align-middle focus:outline-none focus:ring-0 focus:ring-offset-0 focus:ring-offset-white focus:ring-primary transition-all text-xs dark:bg-bgdark dark:border-white/10 dark:text-white/70 dark:focus:ring-offset-white/10",on:{click:function(e){return t.handleAction("delete",s)}}},[e("i",{staticClass:"fa fa-trash text-danger py-1 px-2"})])])])])])])})),0)]),t.showEditSide&&!t.showAddSide?e("side-form-update",{staticClass:"col-md-3",attrs:{conf:t.conf,model:"Driver.update",item:t.activeItem,model_id:t.activeItem.driver_id,index:t.activeItem.driver_id,columns:t.content.fillable}}):t._e(),t.showAddSide&&t.content&&t.content.fillable?e("side-form-create",{staticClass:"col-md-3",attrs:{conf:t.conf,model:"Driver.create",columns:t.content.fillable}}):t._e()],1)},o=[],a={data:function(){return{url:this.conf.url+this.path+"?load=json",content:{items:[]},activeItem:{},showAddSide:!1,showProfile:!1,showEditSide:!1,showLoader:!0}},props:["path","lang","setting","conf","auth"],mounted:function(){this.load()},methods:{handleAction:function(t,e){switch(console.log(t),this.showLoader=!0,t){case"view":this.showEditSide=!1,this.showAddSide=!1,this.showProfile=!0,this.activeItem=e;break;case"edit":this.showEditSide=!0,this.showProfile=!1,this.showAddSide=!1,this.activeItem=e;break;case"delete":this.$root.$children[0].deleteByKey("driver_id",e,"Driver.delete");break;case"close":this.showEditSide=!1,this.showAddSide=!1,this.showProfile=!1;break}this.showLoader=!1},load:function(){var t=this;this.showLoader=!0,this.$root.$children[0].handleGetRequest(this.url).then((function(e){t.setValues(e),t.showLoader=!1}))},setValues:function(t){return this.content=JSON.parse(JSON.stringify(t)),this},__:function(t){return this.$root.$children[0].__(t)}}},r=a,n=s("2877"),d=Object(n["a"])(r,i,o,!1,null,null,null);e["default"]=d.exports}}]);
//# sourceMappingURL=chunk-2d22fdaf.chunk.js.map