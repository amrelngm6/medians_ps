(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2d2163d7"],{c22d:function(t,s,e){"use strict";e.r(s);e("7f7f");var a=function(){var t=this,s=t._self._c;return s("div",{staticClass:"w-full"},[s("div",{staticClass:"container-fluid"},[s("div",{staticClass:"row"},[s("div",{staticClass:"col-lg-12"},[s("div",{staticClass:"card mt-n4 mx-n4 card-border-effect-none mb-n5 border-bottom-0 border-start-0 rounded-0"},[s("div",[s("div",{staticClass:"card-body pb-4 mb-5"},[s("div",{staticClass:"row"},[s("div",{staticClass:"col-md"},[s("div",{staticClass:"row align-items-center"},[s("div",{staticClass:"col-md-auto"},[s("div",{staticClass:"avatar-md mb-md-0 mb-4"},[s("div",{staticClass:"avatar-title bg-white rounded-circle"},[t.item?s("img",{staticClass:"avatar-sm",attrs:{src:t.item.user.picture,alt:""}}):t._e()])])]),s("div",{staticClass:"col-md"},[s("h4",{staticClass:"fw-semibold",attrs:{id:"ticket-title"},domProps:{textContent:t._s(t.item.subject)}}),s("div",{staticClass:"hstack gap-3 flex"},[s("div",{staticClass:"text-muted"},[s("i",{staticClass:"ri-building-line align-bottom me-1"}),s("span",{attrs:{id:"ticket-client"},domProps:{textContent:t._s(t.item.user.name)}})]),s("div",{staticClass:"vr"}),s("div",{staticClass:"text-muted"},[s("span",{domProps:{textContent:t._s(t.__("Created at"))}}),s("span",{staticClass:"fw-medium",attrs:{id:"create-date"},domProps:{textContent:t._s(t.item.created_at)}})]),s("div",{staticClass:"vr"}),t.item.status?s("div",{staticClass:"badge rounded-pill bg-info fs-12",attrs:{id:"ticket-status"},domProps:{textContent:t._s(t.item.status)}}):t._e(),t.item.priority?s("div",{staticClass:"badge rounded-pill bg-danger fs-12",attrs:{id:"ticket-priority"},domProps:{textContent:t._s(t.item.priority)}}):t._e()])])])]),s("div",{staticClass:"col-md-auto mt-md-0 mt-4"},[s("div",{staticClass:"hstack gap-1 flex-wrap"},[s("button",{staticClass:"btn py-0 fs-16 text-body",attrs:{type:"button",id:"settingDropdown","data-bs-toggle":"dropdown"},on:{click:function(s){t.showI=!1,t.showoptions=!t.showoptions,t.showI=!0}}},[s("i",{staticClass:"fa fa-ellipsis"})]),t.showI&&t.showoptions?s("ul",{staticClass:"dropdown-menu",attrs:{"aria-labelledby":"settingDropdown"}},[t._m(0),t._m(1),t._m(2)]):t._e()])])])])])])])]),s("div",{staticClass:"lg:flex gap-6"},[s("div",{staticClass:"col-xxl-9"},[s("div",{staticClass:"card"},[s("div",{staticClass:"card-body p-4"},[s("h6",{staticClass:"fw-semibold text-uppercase mb-3",domProps:{textContent:t._s(t.__("Ticket Discripation"))}}),s("p",{staticClass:"text-muted",domProps:{textContent:t._s(t.item.message)}})]),s("div",{staticClass:"card-body p-4"},[s("h5",{staticClass:"card-title mb-4"},[t._v("Comments")]),s("div",{staticClass:"px-3 mx-n3 overflow-y-auto",staticStyle:{"max-height":"300px"},attrs:{"data-simplebar":"init"}},[s("div",{staticClass:"simplebar-wrapper",staticStyle:{margin:"0px -16px"}},[t._m(3),s("div",{staticClass:"simplebar-mask"},[s("div",{staticClass:"simplebar-offset",staticStyle:{right:"0px",bottom:"0px"}},[s("div",{staticClass:"simplebar-content-wrapper",attrs:{tabindex:"0",role:"region","aria-label":"scrollable content"}},[s("div",{staticClass:"simplebar-content",staticStyle:{padding:"0px 16px"}},t._l(t.item.comments,(function(e){return s("div",{staticClass:"d-flex mb-4"},[e.user?s("div",{staticClass:"flex-shrink-0"},[s("img",{staticClass:"avatar-xs rounded-circle",attrs:{src:e.user.picture,alt:""}})]):t._e(),e.user?s("div",{staticClass:"flex-grow-1 ms-3"},[s("h5",{staticClass:"fs-13"},[s("span",{domProps:{textContent:t._s(e.user.name)}}),s("small",{staticClass:"text-muted",domProps:{textContent:t._s(e.time)}})]),s("p",{staticClass:"text-muted",domProps:{textContent:t._s(e.comment)}})]):t._e()])})),0)])])])])]),s("form",{staticClass:"mt-3",attrs:{action:"javascript:void(0);"}},[s("div",{staticClass:"row g-3"},[s("div",{staticClass:"col-lg-12"},[s("label",{staticClass:"form-label",attrs:{for:"exampleFormControlTextarea1"},domProps:{textContent:t._s(t.__("WRITE_COMMENT"))}}),s("textarea",{staticClass:"form-control bg-light border-light",attrs:{id:"exampleFormControlTextarea1",rows:"3",placeholder:"Enter comments"}})]),s("div",{staticClass:"col-lg-12 text-end mt-4"},[s("a",{staticClass:"btn btn-primary",attrs:{href:"javascript:void(0);"},domProps:{textContent:t._s(t.__("Comments"))}})])])])])])]),s("div",{staticClass:"col-xxl-3 w-full"},[s("div",{staticClass:"card"},[s("div",{staticClass:"card-header"},[s("h5",{staticClass:"card-title mb-0",domProps:{textContent:t._s(t.__("Ticket Details"))}})]),s("div",{staticClass:"card-body"},[s("div",{staticClass:"table-responsive table-card"},[s("table",{staticClass:"table table-borderless align-middle mb-0"},[s("tbody",[s("tr",[s("td",{staticClass:"fw-medium",domProps:{textContent:t._s(t.__("Ticket"))}}),s("td",[t._v("#"),s("span",{attrs:{id:"t-no"},domProps:{textContent:t._s(t.item.message_id)}})])]),s("tr",[s("td",{staticClass:"fw-medium",domProps:{textContent:t._s(t.__("User"))}}),s("td",{attrs:{id:"t-client"},domProps:{textContent:t._s(t.item.user.name)}})]),s("tr",[s("td",{staticClass:"fw-medium",domProps:{textContent:t._s(t.__("Status"))}}),t._m(4)]),s("tr",[s("td",{staticClass:"fw-medium",domProps:{textContent:t._s(t.__("Priority"))}}),s("td",[s("span",{staticClass:"badge bg-danger",attrs:{id:"t-priority"},domProps:{textContent:t._s(t.item.priority)}})])]),s("tr",[s("td",{staticClass:"fw-medium",domProps:{textContent:t._s(t.__("Created at"))}}),s("td",{attrs:{id:"c-date"},domProps:{textContent:t._s(t.item.date)}})]),s("tr",[s("td",{staticClass:"fw-medium",domProps:{textContent:t._s(t.__("Last update"))}}),s("td",{attrs:{id:"d-date"},domProps:{textContent:t._s(t.item.updated_at)}})])])])])])])])])])])},i=[function(){var t=this,s=t._self._c;return s("li",[s("a",{staticClass:"dropdown-item",attrs:{href:"#"}},[s("i",{staticClass:"ri-eye-fill align-bottom me-2 text-muted"}),t._v(" View")])])},function(){var t=this,s=t._self._c;return s("li",[s("a",{staticClass:"dropdown-item",attrs:{href:"#"}},[s("i",{staticClass:"ri-share-forward-fill align-bottom me-2 text-muted"}),t._v(" Share with")])])},function(){var t=this,s=t._self._c;return s("li",[s("a",{staticClass:"dropdown-item",attrs:{href:"#"}},[s("i",{staticClass:"ri-delete-bin-fill align-bottom me-2 text-muted"}),t._v(" Delete")])])},function(){var t=this,s=t._self._c;return s("div",{staticClass:"simplebar-height-auto-observer-wrapper"},[s("div",{staticClass:"simplebar-height-auto-observer"})])},function(){var t=this,s=t._self._c;return s("td",[s("div",{staticClass:"choices",attrs:{"data-type":"select-one",tabindex:"0",role:"listbox","aria-haspopup":"true","aria-expanded":"false"}},[s("div",{staticClass:"choices__inner"},[s("select",{staticClass:"form-select choices__input",attrs:{id:"t-status","data-choices":"","data-choices-search-false":"","aria-label":"Default select example",hidden:"",tabindex:"-1","data-choice":"active"}},[s("option",{attrs:{value:"New","data-custom-properties":"[object Object]"}},[t._v("New")])]),s("div",{staticClass:"choices__list choices__list--single"},[s("div",{staticClass:"choices__item choices__item--selectable",attrs:{"data-item":"","data-id":"1","data-value":"New","data-custom-properties":"[object Object]","aria-selected":"true"}},[t._v("New")])])]),s("div",{staticClass:"choices__list choices__list--dropdown",attrs:{"aria-expanded":"false"}},[s("div",{staticClass:"choices__list",attrs:{role:"listbox"}},[s("div",{staticClass:"choices__item choices__item--choice choices__placeholder choices__item--selectable is-highlighted",attrs:{id:"choices--t-status-item-choice-5",role:"option","data-choice":"","data-id":"5","data-value":"","data-select-text":"Press to select","data-choice-selectable":"","aria-selected":"true"}},[t._v("Status")]),s("div",{staticClass:"choices__item choices__item--choice choices__item--selectable",attrs:{id:"choices--t-status-item-choice-1",role:"option","data-choice":"","data-id":"1","data-value":"Closed","data-select-text":"Press to select","data-choice-selectable":""}},[t._v("Closed")]),s("div",{staticClass:"choices__item choices__item--choice choices__item--selectable",attrs:{id:"choices--t-status-item-choice-2",role:"option","data-choice":"","data-id":"2","data-value":"Inprogress","data-select-text":"Press to select","data-choice-selectable":""}},[t._v("Inprogress")]),s("div",{staticClass:"choices__item choices__item--choice is-selected choices__item--selectable",attrs:{id:"choices--t-status-item-choice-3",role:"option","data-choice":"","data-id":"3","data-value":"New","data-select-text":"Press to select","data-choice-selectable":""}},[t._v("New")]),s("div",{staticClass:"choices__item choices__item--choice choices__item--selectable",attrs:{id:"choices--t-status-item-choice-4",role:"option","data-choice":"","data-id":"4","data-value":"Open","data-select-text":"Press to select","data-choice-selectable":""}},[t._v("Open")])])])])])}],c={props:["path","lang","setting","conf","auth","item"],methods:{__:function(t){return this.$root.$children[0].__(t)}}},o=c,l=e("2877"),d=Object(l["a"])(o,a,i,!1,null,null,null);s["default"]=d.exports}}]);
//# sourceMappingURL=chunk-2d2163d7.chunk.js.map