(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-b85eab12"],{"91f4":function(t,e,i){"use strict";i.r(e);i("7f7f");var s=function(){var t=this,e=t._self._c;return e("div",{staticClass:"w-full"},[t.showLoader?t._e():e("div",{staticClass:"grid xl:grid-cols-12 lg:grid-cols-12 grid-cols-1 gap-6"},[e("div",{staticClass:"xl:col-span-3 lg:col-span-5"},[e("div",{staticClass:"card px-4 py-6 mb-6"},[e("div",{staticClass:"text-center pb-4"},[e("h4",{staticClass:"mb-1 mt-3 text-lg dark:text-gray-300",domProps:{textContent:t._s(t.activeItem.name)}}),e("button",{staticClass:"bg-gray-50 border border-1 hover:bg-primary mb-3 px-6 py-2 rounded-lg text-primary",attrs:{type:"button"},domProps:{textContent:t._s(t.__("Edit"))},on:{click:t.update}}),e("button",{staticClass:"hover:bg-primary mb-3 px-6 py-2 text-danger",attrs:{type:"button"},on:{click:t.close}},[e("i",{staticClass:"fa fa-close px-2"}),e("span",{domProps:{textContent:t._s(t.__("Back"))}})])]),e("hr",{staticClass:"mt-5 dark:border-gray-600"})])]),e("div",{staticClass:"xl:col-span-9 lg:col-span-7"},[e("div",{staticClass:"card"},[e("div",{staticClass:"p-6"},[e("div",{staticClass:"w-full"},[e("nav",{staticClass:"lg:flex items-center justify-around rounded-xl space-x-3 bg-gray-100 p-2 dark:bg-gray-900/30",attrs:{"aria-label":"Tabs",role:"tablist"}},t._l(t.content.items,(function(i){return e("button",{staticClass:"hover:bg-white hover:text-blue-800 hs-tab-active:font-semibold hs-tab-active:bg-white dark:hs-tab-active:bg-gray-700 w-full flex justify-center py-2 rounded items-center gap-2 border-b-2 border-transparent -mb-px transition-all text-sm whitespace-nowrap dark:text-white active",class:t.activeStatus==i.name?"menu-dark text-white font-semibold":"text-gray-500",attrs:{type:"button"},domProps:{textContent:t._s(t.__(i.name))},on:{click:function(e){return t.setActiveStatus(i.name)}}})})),0),e("div",{staticClass:"mt-3 overflow-hidden"},[e("div",{staticClass:"transition-all duration-300 transform",attrs:{id:"basic-tabs-1"}},t._l(t.content.items,(function(i){return t.activeStatus==i.name?e("div",{staticClass:"w-full border-b border-gray-100"},[e("div",{staticClass:"mt-6 w-full"},[e("div",{staticClass:"grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6 mb-6"},[t._v("\n                                            "+t._s(i)+"\n                                        ")])])]):t._e()})),0)])])])])])])])},r=[],o=i("b536"),n=i("cae8"),a={components:{dashboard_card_white:o["a"],help_icon:n["a"]},data:function(){return{content:{items:[]},activeItem:{},showAddSide:!1,showEditSide:!1,showLoader:!1,showLoadMore:!0,limitCount:3,activeStatus:"info"}},props:["path","lang","setting","conf","auth","item"],mounted:function(){this.activeItem=this.item,console.log(this.activeItem)},methods:{update:function(){this.$emit("edit","edit",this.activeItem)},close:function(){this.$emit("close","close",this.activeItem)},loadmore:function(){this.showLoader=!0,this.limitCount+=5,this.limitCount>this.activeItem.last_trips.length&&(this.showLoadMore=!1),this.showLoader=!1},setActiveStatus:function(t){this.showLoader=!0,this.activeStatus=t,this.showLoader=!1},handleAction:function(t,e){switch(t){case"view":break;case"edit":this.showEditSide=!0,this.showAddSide=!1,this.activeItem=e;break;case"delete":this.$root.$children[0].deleteByKey("driver_id",e,"Driver.delete");break}},load:function(){var t=this;this.showLoader=!0,this.$root.$children[0].handleGetRequest(this.url).then((function(e){t.setValues(e),t.showLoader=!1}))},setValues:function(t){return this.content=JSON.parse(JSON.stringify(t)),this},__:function(t){return this.$root.$children[0].__(t)}}},l=a,c=i("2877"),d=Object(c["a"])(l,s,r,!1,null,null,null);e["default"]=d.exports},b536:function(t,e,i){"use strict";var s=function(){var t=this,e=t._self._c;return e("div",{staticClass:"widget-item bg-white p-6 flex justify-between rounded-md"},[e("div",[e("h4",{staticClass:"text-xl font-semibold text-slate-700 mb-1 leading-none",domProps:{textContent:t._s(t.value)}}),e("p",{staticClass:"text-tiny leading-4",domProps:{textContent:t._s(t.title)}})]),e("div",[e("span",{staticClass:"text-lg text-purple-300 rounded-full flex items-center justify-center h-12 w-12 shrink-0",class:t.classes},[e("img",{staticClass:"mx-auto",attrs:{width:"25",height:"25",src:t.icon}})])])])},r=[],o={props:["title","value","classes","icon"]},n=o,a=i("2877"),l=Object(a["a"])(n,s,r,!1,null,null,null);e["a"]=l.exports},cae8:function(t,e,i){"use strict";var s=function(){var t=this,e=t._self._c;return e("svg",{attrs:{width:"800px",height:"800px",viewBox:"0 0 32 32","enable-background":"new 0 0 32 32",id:"_x3C_Layer_x3E_",version:"1.1","xml:space":"preserve",xmlns:"http://www.w3.org/2000/svg","xmlns:xlink":"http://www.w3.org/1999/xlink"}},[e("g",{attrs:{id:"help_x2C__message_x2C__question_x2C__question_mark"}},[e("g",{attrs:{id:"XMLID_2695_"}},[e("g",{attrs:{id:"XMLID_2696_"}},[e("path",{attrs:{d:"     M21.5,18.5h-11c-1.66,0-3-1.34-3-3v-11c0-1.66,1.34-3,3-3h11c1.66,0,3,1.34,3,3v11C24.5,17.16,23.16,18.5,21.5,18.5z",fill:"none",id:"XMLID_2704_",stroke:"currentColor","stroke-linecap":"round","stroke-linejoin":"round","stroke-miterlimit":"10"}}),e("path",{attrs:{d:"     M26.5,5.521L26.5,5.521c1.657,0,3,1.343,3,3v15c0,1.657-1.343,3-3,3H23l-3.5,4v-4h-14c-1.657,0-3-1.343-3-3v-15     c0-1.657,1.343-3,3-3h0",fill:"none",id:"XMLID_2703_",stroke:"currentColor","stroke-linecap":"round","stroke-linejoin":"round","stroke-miterlimit":"10"}}),e("path",{attrs:{d:"     M16,13v-0.542c0-0.904,0.475-1.743,1.25-2.208l0,0c0.775-0.465,1.25-1.304,1.25-2.208V8c0-1.381-1.119-2.5-2.5-2.5l0,0     c-1.381,0-2.5,1.119-2.5,2.5l0,0",fill:"none",id:"XMLID_2702_",stroke:"currentColor","stroke-linecap":"round","stroke-linejoin":"round","stroke-miterlimit":"10"}}),e("line",{attrs:{fill:"#FFFFFF",id:"XMLID_2700_",stroke:"#455A64","stroke-linecap":"round","stroke-linejoin":"round","stroke-miterlimit":"10",x1:"16",x2:"16",y1:"15",y2:"14.867"}}),e("line",{attrs:{fill:"none",id:"XMLID_2699_",stroke:"currentColor","stroke-linecap":"round","stroke-linejoin":"round","stroke-miterlimit":"10",x1:"18.6",x2:"18.5",y1:"22.5",y2:"22.5"}}),e("line",{attrs:{fill:"none",id:"XMLID_2698_",stroke:"#455A64","stroke-linecap":"round","stroke-linejoin":"round","stroke-miterlimit":"10",x1:"16.1",x2:"16",y1:"22.5",y2:"22.5"}}),e("line",{attrs:{fill:"none",id:"XMLID_2697_",stroke:"#455A64","stroke-linecap":"round","stroke-linejoin":"round","stroke-miterlimit":"10",x1:"13.6",x2:"13.5",y1:"22.5",y2:"22.5"}})])]),e("g",{attrs:{id:"XMLID_1026_"}},[e("g",{attrs:{id:"XMLID_1052_"}},[e("path",{attrs:{d:"     M21.5,18.5h-11c-1.66,0-3-1.34-3-3v-11c0-1.66,1.34-3,3-3h11c1.66,0,3,1.34,3,3v11C24.5,17.16,23.16,18.5,21.5,18.5z",fill:"none",id:"XMLID_2694_",stroke:"currentColor","stroke-linecap":"round","stroke-linejoin":"round","stroke-miterlimit":"10"}}),e("path",{attrs:{d:"     M26.5,5.521L26.5,5.521c1.657,0,3,1.343,3,3v15c0,1.657-1.343,3-3,3H23l-3.5,4v-4h-14c-1.657,0-3-1.343-3-3v-15     c0-1.657,1.343-3,3-3h0",fill:"none",id:"XMLID_2621_",stroke:"currentColor","stroke-linecap":"round","stroke-linejoin":"round","stroke-miterlimit":"10"}}),e("path",{attrs:{d:"     M16,13v-0.542c0-0.904,0.475-1.743,1.25-2.208l0,0c0.775-0.465,1.25-1.304,1.25-2.208V8c0-1.381-1.119-2.5-2.5-2.5l0,0     c-1.381,0-2.5,1.119-2.5,2.5l0,0",fill:"none",id:"XMLID_2559_",stroke:"currentColor","stroke-linecap":"round","stroke-linejoin":"round","stroke-miterlimit":"10"}}),e("line",{attrs:{fill:"none",id:"XMLID_2558_",stroke:"currentColor","stroke-linecap":"round","stroke-linejoin":"round","stroke-miterlimit":"10",x1:"16",x2:"16",y1:"15",y2:"14.867"}}),e("line",{attrs:{fill:"none",id:"XMLID_2557_",stroke:"currentColor","stroke-linecap":"round","stroke-linejoin":"round","stroke-miterlimit":"10",x1:"18.6",x2:"18.5",y1:"22.5",y2:"22.5"}}),e("line",{attrs:{fill:"none",id:"XMLID_2556_",stroke:"currentColor","stroke-linecap":"round","stroke-linejoin":"round","stroke-miterlimit":"10",x1:"16.1",x2:"16",y1:"22.5",y2:"22.5"}}),e("line",{attrs:{fill:"none",id:"XMLID_1073_",stroke:"currentColor","stroke-linecap":"round","stroke-linejoin":"round","stroke-miterlimit":"10",x1:"13.6",x2:"13.5",y1:"22.5",y2:"22.5"}})])])])])},r=[],o=i("2877"),n={},a=Object(o["a"])(n,s,r,!1,null,null,null);e["a"]=a.exports}}]);
//# sourceMappingURL=chunk-b85eab12.chunk.js.map