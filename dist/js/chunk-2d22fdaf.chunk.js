(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2d22fdaf"],{ea96:function(t,s,e){"use strict";e.r(s);e("7f7f");var i=function(){var t=this,s=t._self._c;return s("div",{staticClass:"w-full"},[s("div",{staticClass:"relative card ribbon-box border shadow-none mb-lg-0"},[s("div",{staticClass:"card-body"},[s("div",{staticClass:"ribbon ribbon-primary round-shape",domProps:{textContent:t._s(t.__("Important"))}}),s("h5",{staticClass:"fs-14 text-end",domProps:{textContent:t._s(t.__("Before Create Account"))}}),s("div",{staticClass:"ribbon-content mt-4 text-muted"},[s("div",{staticClass:"mb-0",domProps:{innerHTML:t._s(t.__("Before Create driver note"))}})])])]),s("div",{staticClass:"sm:grid sm:space-y-0 space-y-6 xl:!grid-cols-3 md:grid-cols-2 gap-6"},t._l(t.content.items,(function(e){return s("div",{staticClass:"box mb-0 overflow-hidden p-4 bg-white rounded-xl"},[s("div",{staticClass:"box-body space-y-5"},[s("div",{staticClass:"flex"},[s("div",{staticClass:"sm:flex sm:space-x-3 sm:space-y-0 space-y-4 rtl:space-x-reverse"},[s("img",{staticClass:"avatar avatar-lg rounded-sm",attrs:{src:e.picture,alt:"Image Description"}}),s("div",{staticClass:"space-y-1 my-auto"},[s("h5",{staticClass:"font-semibold text-base leading-none",domProps:{textContent:t._s(e.name)}}),s("p",{staticClass:"text-gray-500 dark:text-white/70 font-semibold text-xs truncate max-w-[9rem]",domProps:{textContent:t._s(e.email)}}),s("p",{staticClass:"text-primary dark:text-primary text-xs font-semibold",domProps:{textContent:t._s(e.mobile)}})])]),s("div",{staticClass:"ltr:ml-auto rtl:mr-auto"},[s("span",{staticClass:"cursor-pointer",on:{click:function(s){return t.handleAction("delete",e)}}},[s("i",{staticClass:"fa fa-trash text-danger"})])])])]),s("div",{staticClass:"box-footer mt-2"},[s("div",{staticClass:"grid grid-cols-12 gap-x-3"},[t._m(0,!0),s("div",{staticClass:"sm:col-span-8 col-span-4",on:{click:function(s){return t.handleAction("edit",e)}}},[s("span",{staticClass:"cursor-pointer inline-flex !p-1 flex-shrink-0 justify-center items-center gap-2 w-full rounded-sm border font-medium bg-white text-gray-500 shadow-sm align-middle focus:outline-none focus:ring-0 focus:ring-offset-0 focus:ring-offset-white focus:ring-primary transition-all text-xs dark:bg-bgdark dark:border-white/10 dark:text-white/70 dark:focus:ring-offset-white/10"},[s("i",{staticClass:"fa fa-edit py-1"}),s("span",{staticClass:"text-base",domProps:{textContent:t._s(t.__("Edit"))}})])]),t._m(1,!0)])])])})),0),t.showAddSide&&t.content&&t.content.fillable?s("side-form-create",{staticClass:"col-md-3",attrs:{conf:t.conf,model:"Driver.create",columns:t.content.fillable}}):t._e(),t.showEditSide&&!t.showAddSide?s("side-form-update",{staticClass:"col-md-3",attrs:{conf:t.conf,model:"Driver.update",item:t.activeItem,model_id:t.activeItem.driver_id,index:t.activeItem.driver_id,columns:t.content.fillable}}):t._e()],1)},a=[function(){var t=this,s=t._self._c;return s("div",{staticClass:"sm:col-span-2 col-span-4"},[s("span",{staticClass:"cursor-pointer inline-flex !p-1 flex-shrink-0 justify-center items-center gap-2 rounded-sm border font-medium bg-white text-gray-500 shadow-sm align-middle focus:outline-none focus:ring-0 focus:ring-offset-0 focus:ring-offset-white focus:ring-primary transition-all text-xs dark:bg-bgdark dark:border-white/10 dark:text-white/70 dark:focus:ring-offset-white/10"},[s("i",{staticClass:"fa fa-phone py-1"})])])},function(){var t=this,s=t._self._c;return s("div",{staticClass:"sm:col-span-2 col-span-4"},[s("div",{staticClass:"hs-dropdown ti-dropdown flex justify-end"},[s("span",{staticClass:"cursor-pointer hs-dropdown-toggle ti-dropdown-toggle inline-flex !p-1 flex-shrink-0 justify-center items-center gap-2 rounded-sm border font-medium bg-white text-gray-500 shadow-sm align-middle focus:outline-none focus:ring-0 focus:ring-offset-0 focus:ring-offset-white focus:ring-primary transition-all text-xs dark:bg-bgdark dark:border-white/10 dark:text-white/70 dark:focus:ring-offset-white/10"},[s("i",{staticClass:"fa fa-ellipsis py-1"})])])])}],o={data:function(){return{url:this.conf.url+this.path+"?load=json",content:{items:[]},activeItem:{}}},props:["path","lang","setting","conf","auth"],mounted:function(){this.load()},methods:{handleAction:function(t,s){switch(t){case"view":break;case"edit":this.showEditSide=!0,this.showAddSide=!1,this.activeItem=s;break;case"delete":this.$root.$children[0].deleteByKey("driver_id",s,"Driver.delete");break}},load:function(){var t=this;this.showLoader=!0,this.$root.$children[0].handleGetRequest(this.url).then((function(s){t.setValues(s),t.showLoader=!1}))},setValues:function(t){return this.content=JSON.parse(JSON.stringify(t)),this},__:function(t){return this.$root.$children[0].__(t)}}},r=o,n=e("2877"),d=Object(n["a"])(r,i,a,!1,null,null,null);s["default"]=d.exports}}]);
//# sourceMappingURL=chunk-2d22fdaf.chunk.js.map