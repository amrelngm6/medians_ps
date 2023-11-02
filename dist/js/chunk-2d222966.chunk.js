(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2d222966"],{cef4:function(t,s,a){"use strict";a.r(s);a("7f7f");var e=function(){var t=this,s=t._self._c;return s("div",{staticClass:"w-full"},[s("div",{staticClass:"container-fluid"},[s("div",{staticClass:"row"},[s("div",{staticClass:"col-lg-12"},[s("div",{staticClass:"card mt-n4 mx-n4 card-border-effect-none mb-n5 border-bottom-0 border-start-0 rounded-0"},[s("div",{staticClass:"card-body pb-4 mb-0"},[s("div",{staticClass:"row"},[s("div",{staticClass:"col-md"},[s("div",{staticClass:"row align-items-center"},[s("div",{staticClass:"px-1 pt-1"},[t.item?s("img",{staticClass:"rounded",attrs:{src:t.item.user.photo,alt:"",width:"36",height:"36"}}):t._e()]),s("div",{staticClass:"col-md"},[s("h4",{staticClass:"fw-semibold",attrs:{id:"ticket-title"},domProps:{textContent:t._s(t.item.subject)}}),s("div",{staticClass:"hstack gap-3 flex"},[s("div",{staticClass:"text-muted"},[s("i",{staticClass:"ri-building-line align-bottom me-1"}),s("span",{attrs:{id:"ticket-client"},domProps:{textContent:t._s(t.item.user.name)}})]),s("div",{staticClass:"vr"}),s("div",{staticClass:"text-muted"},[s("span",{domProps:{textContent:t._s(t.__("Created at"))}}),t._v(" : "),s("span",{staticClass:"fw-medium",attrs:{id:"create-date"},domProps:{textContent:t._s(t.item.date)}})]),s("div",{staticClass:"vr"}),s("div",{staticClass:"text-muted"},[s("span",{domProps:{textContent:t._s(t.__("Last update"))}}),t._v(" : "),s("span",{staticClass:"fw-medium",attrs:{id:"update-date"},domProps:{textContent:t._s(t.item.last_update)}})]),s("div",{staticClass:"vr"}),t.item.status?s("div",{staticClass:"badge rounded-pill bg-info fs-12",attrs:{id:"ticket-status"},domProps:{textContent:t._s(t.item.status)}}):t._e(),t.item.priority?s("div",{staticClass:"badge rounded-pill bg-danger fs-12",attrs:{id:"ticket-priority"},domProps:{textContent:t._s(t.item.priority)}}):t._e()])]),s("span",{staticClass:"w-auto py-2 px-4 cursor-pointer text-lg",on:{click:function(s){return t.$emit("callback")}}},[s("i",{staticClass:"fa fa-close"})])])])])])])])]),s("div",{staticClass:"lg:flex gap-6"},[s("div",{staticClass:"col-xxl-9 w-full"},[s("div",{staticClass:"card"},[s("div",{staticClass:"card-body p-4"},[s("h6",{staticClass:"fw-semibold text-uppercase mb-3",domProps:{textContent:t._s(t.__("Ticket Discripation"))}}),s("p",{staticClass:"text-muted",domProps:{textContent:t._s(t.item.message)}})]),s("div",{staticClass:"card-body p-4"},[s("h5",{staticClass:"card-title text-sm font-semibold mb-4",domProps:{textContent:t._s(t.__("Comments"))}}),s("div",{staticClass:"overflow-y-auto",staticStyle:{"max-height":"300px"},attrs:{"data-simplebar":"init"}},[s("div",{staticClass:"simplebar-wrapper"},[t._m(0),s("div",{staticClass:"simplebar-mask"},[s("div",{staticClass:"simplebar-offset"},[s("div",{staticClass:"simplebar-content-wrapper",attrs:{tabindex:"0",role:"region","aria-label":"scrollable content"}},[s("div",{staticClass:"simplebar-content"},t._l(t.item.comments,(function(a){return s("div",{staticClass:"flex gap-2 mb-4"},[a.user?s("div",{staticClass:"flex-shrink-0"},[s("img",{staticClass:"mt-2 avatar-xs rounded-circle",attrs:{src:a.user.photo,alt:""}})]):t._e(),a.user?s("div",{staticClass:"flex-grow-1 ms-3"},[s("h5",{staticClass:"fs-13 flex gap-2"},[s("span",{domProps:{textContent:t._s(a.user.name)}}),s("small",{staticClass:"text-muted",domProps:{textContent:t._s(a.date)}})]),s("p",{staticClass:"text-muted",domProps:{textContent:t._s(a.comment)}})]):t._e()])})),0)])])])])]),s("form",{staticClass:"action my-2 rounded-lg pb-2",attrs:{action:"/api/create",method:"POST","data-refresh":"1",id:"add-device-form"}},[s("input",{attrs:{name:"type",type:"hidden",value:"HelpMessageComment.create"}}),s("input",{attrs:{name:"params[message_id]",type:"hidden"},domProps:{value:t.item.message_id}}),t.model_id&&t.column&&"hidden"==t.column.column_type?s("input",{directives:[{name:"model",rawName:"v-model",value:t.column.default,expression:"column.default"}],attrs:{name:"params["+t.column.key+"]",type:"hidden"},domProps:{value:t.column.default},on:{input:function(s){s.target.composing||t.$set(t.column,"default",s.target.value)}}}):t._e(),s("div",{staticClass:"row g-3"},[s("div",{staticClass:"col-lg-12"},[s("label",{staticClass:"form-label",attrs:{for:"exampleFormControlTextarea1"},domProps:{textContent:t._s(t.__("WRITE_COMMENT"))}}),s("textarea",{staticClass:"form-control bg-light border-light",attrs:{name:"params[comment]",id:"exampleFormControlTextarea1",rows:"3",placeholder:"Enter comments"}})]),s("div",{staticClass:"col-lg-12 text-end mt-4"},[s("button",{staticClass:"btn btn-primary",attrs:{type:"submit",href:"javascript:void(0);"},domProps:{textContent:t._s(t.__("Send"))}})])])])])])]),s("div",{staticClass:"col-xxl-3"},[s("div",{staticClass:"card"},[s("div",{staticClass:"card-header"},[s("h5",{staticClass:"card-title mb-0",domProps:{textContent:t._s(t.__("Ticket Details"))}})]),s("div",{staticClass:"card-body"},[s("div",{staticClass:"table-responsive table-card"},[s("table",{staticClass:"table table-borderless align-middle mb-0"},[s("tbody",[s("tr",[s("td",{staticClass:"fw-medium",domProps:{textContent:t._s(t.__("Ticket"))}}),s("td",[t._v("#"),s("span",{attrs:{id:"t-no"},domProps:{textContent:t._s(t.item.message_id)}})])]),s("tr",[s("td",{staticClass:"fw-medium",domProps:{textContent:t._s(t.__("User"))}}),s("td",{attrs:{id:"t-client"},domProps:{textContent:t._s(t.item.user.name)}})]),s("tr",[s("td",{staticClass:"fw-medium",domProps:{textContent:t._s(t.__("Status"))}}),s("td",[s("span",{staticClass:"font-bold",attrs:{id:"t-status"},domProps:{textContent:t._s(t.item.status)}})])]),s("tr",[s("td",{staticClass:"fw-medium",domProps:{textContent:t._s(t.__("Priority"))}}),s("td",[s("span",{staticClass:"badge bg-danger",attrs:{id:"t-priority"},domProps:{textContent:t._s(t.item.priority)}})])]),s("tr",[s("td",{staticClass:"fw-medium",domProps:{textContent:t._s(t.__("Created at"))}}),s("td",{attrs:{id:"c-date"},domProps:{textContent:t._s(t.item.date)}})]),s("tr",[s("td",{staticClass:"fw-medium",domProps:{textContent:t._s(t.__("Last update"))}}),s("td",{attrs:{id:"d-date"},domProps:{textContent:t._s(t.item.last_update)}})])])])])])])])])])])},i=[function(){var t=this,s=t._self._c;return s("div",{staticClass:"simplebar-height-auto-observer-wrapper"},[s("div",{staticClass:"simplebar-height-auto-observer"})])}],o={props:["path","lang","setting","conf","auth","item"],methods:{__:function(t){return this.$root.$children[0].__(t)}}},d=o,r=a("2877"),l=Object(r["a"])(d,e,i,!1,null,null,null);s["default"]=l.exports}}]);
//# sourceMappingURL=chunk-2d222966.chunk.js.map