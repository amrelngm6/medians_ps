(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-dd9c0268"],{"25bb":function(t,s,e){"use strict";e.r(s);e("7f7f");var a=function(){var t=this,s=t._self._c;return s("div",{staticClass:"w-full overflow-auto",staticStyle:{height:"85vh","z-index":"9999"}},[s("test"),s("div",{staticClass:"top-0 py-2 w-full px-2 bg-gray-100 mt-0 sticky",staticStyle:{"z-index":"9"}},[s("div",{staticClass:"w-full flex gap-6"},[s("h3",{staticClass:"text-base lg:text-lg whitespace-nowrap",domProps:{textContent:t._s(t.__("Dashboard Reports"))}}),s("ul",{staticClass:"w-full flex gap-4"},t._l(t.dates_filters,(function(e){return e?s("li",{staticClass:"cursor-pointer",class:t.activeDate==e.value?"font-semibold":"",domProps:{textContent:t._s(t.__(e.title))},on:{click:function(s){return t.switchDate(e.value)}}}):t._e()})),0)])]),s("div",{staticClass:"block w-full overflow-x-auto py-2"},[t.lang&&!t.showLoader&&t.setting?s("div",{staticClass:"w-full overflow-y-auto overflow-x-hidden px-2 mt-6"},[s("div",{},[s("div",{staticClass:"grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-6"},[s("dashboard_card_white",{attrs:{icon:"/uploads/img/booking-unpaid.png",classes:"bg-gradient-danger",title:t.__("active_bookings"),value:t.content.active_order_devices_count}}),s("dashboard_card_white",{attrs:{icon:"/uploads/img/booking-paid.png",classes:"bg-gradient-info",title:t.__("bookings"),value:t.content.order_devices_count}}),s("dashboard_card_white",{attrs:{icon:"/uploads/img/products_icome.png",classes:"bg-gradient-warning",title:t.__("sold_products"),value:t.setting.currency+""+t.content.order_products_revenue}}),s("dashboard_card_white",{attrs:{icon:"/uploads/img/booking_income.png",classes:"bg-gradient-success",title:t.__("bookings_income"),value:t.setting.currency+""+t.content.bookings_income}})],1),t.content.orders_charts.length?s("div",{staticClass:"w-full bg-white p-4 mb-4 rounded-lg"},[t.showCharts&&t.content.orders_charts.length?s("CanvasJSChart",{key:t.line_options,attrs:{options:t.line_options}}):t._e()],1):t._e(),s("div",{staticClass:"row mt-6"},[s("dashboard_card",{attrs:{classes:"bg-gradient-success",title:t.__("income"),value:t.setting.currency+""+t.content.income}}),s("dashboard_card",{attrs:{classes:"bg-gradient-danger",title:t.__("expenses"),value:t.setting.currency+""+t.content.expenses}}),s("dashboard_card",{attrs:{classes:"bg-gradient-primary",title:t.__("tax"),value:t.setting.currency+""+t.content.tax}}),s("dashboard_card",{attrs:{classes:"bg-gradient-purple",title:t.__("revenue"),value:t.setting.currency+""+t.content.revenue}})],1)]),s("div",{staticClass:"w-full lg:flex gap gap-6 pb-6"},[s("dashboard_center_squares",{attrs:{content:t.content,setting:t.setting}}),s("div",{staticClass:"card mb-0 w-full"},[s("h4",{staticClass:"p-4 ml-4",domProps:{textContent:t._s(t.__("most_played_games"))}}),s("p",{staticClass:"text-sm text-gray-500 px-4 mb-6",domProps:{textContent:t._s(t.__("top_5_games_used_for_playing"))}}),s("div",{staticClass:"card-body w-full"},[s("div",{staticClass:"w-full"},[t.showCharts&&t.content.most_played_games.length?s("CanvasJSChart",{key:t.pie_options,attrs:{options:t.pie_options}}):t._e()],1)])])],1),s("div",{staticClass:"w-full lg:flex gap gap-6 pb-6"},[s("div",{staticClass:"card mb-0 w-2/3"},[s("h4",{staticClass:"p-4 ml-4",domProps:{textContent:t._s(t.__("most_played_devices"))}}),s("p",{staticClass:"text-sm text-gray-500 px-4 mb-6",domProps:{textContent:t._s(t.__("top_5_devices_used_for_playing"))}}),s("div",{staticClass:"card-body w-full"},[s("div",{staticClass:"w-full"},[t.showCharts&&t.content.most_played_devices.length?s("CanvasJSChart",{key:t.column_options,attrs:{options:t.column_options}}):t._e()],1)])]),s("div",{staticClass:"card w-1/3 lg:w-1/3 lg:mb-0"},[s("h4",{staticClass:"p-4 ml-4",domProps:{textContent:t._s(t.__("latest_paid_order_devices"))}}),s("p",{staticClass:"text-sm text-gray-500 px-4 mb-6",domProps:{textContent:t._s(t.__("latest_5_bookings_has_been_paid"))}}),s("div",{staticClass:"card-body w-full"},[s("div",{staticClass:"w-full"},[s("div",{staticClass:"table-responsive w-full"},[s("table",{staticClass:"w-full table table-striped table-nowrap custom-table mb-0 datatable"},[s("thead",[s("tr",[s("th",{domProps:{textContent:t._s(t.__("name"))}}),s("th",{domProps:{textContent:t._s(t.__("duration"))}}),s("th",{domProps:{textContent:t._s(t.__("total_amount"))}})])]),t.content.latest_paid_order_devices?s("tbody",t._l(t.content.latest_paid_order_devices,(function(e,a){return s("tr",{key:a,staticClass:"text-center"},[s("td",{domProps:{textContent:t._s(e.device?e.device.name:"")}}),s("td",{staticStyle:{direction:"ltr"}},[t._v(t._s(e.duration_time))]),s("td",{domProps:{textContent:t._s((e.total_cost?e.total_cost:"")+t.setting.currency)}})])})),0):t._e()])])])])])]),s("div",{staticClass:"w-full lg:flex gap gap-6 pb-6"},[s("div",{staticClass:"card w-full no-mobile"},[s("h4",{staticClass:"p-4 ml-4",domProps:{textContent:t._s(t.__("latest_sold_products"))}}),s("hr"),s("div",{staticClass:"card-body w-full"},[s("div",{staticClass:"w-full"},[s("div",{staticClass:"table-responsive w-full"},[s("table",{staticClass:"w-full table table-striped table-nowrap custom-table mb-0 datatable"},[s("thead",[s("tr",[s("th",{domProps:{textContent:t._s(t.__("name"))}}),s("th",{domProps:{textContent:t._s(t.__("price"))}}),s("th",{domProps:{textContent:t._s(t.__("date"))}}),s("th",{domProps:{textContent:t._s(t.__("invoice"))}}),s("th",{domProps:{textContent:t._s(t.__("by"))}})])]),s("tbody",t._l(t.content.latest_order_products,(function(e,a){return s("tr",{key:a,staticClass:"text-center"},[s("td",[s("a",{attrs:{href:"/admin/products/edit/"+e.product.id}},[t._v(t._s(e.product.name))])]),s("td",{staticClass:"text-red-500"},[t._v(t._s(e.product.price)+" "+t._s(t.setting.currency))]),s("td",{domProps:{textContent:t._s(t.dateTimeFormat(e.created_at))}}),s("td",[s("a",{attrs:{target:"_blank",href:"/admin/invoices/show/"+e.invoice.code}},[t._v(t._s(e.invoice.code))])]),s("td",{domProps:{textContent:t._s(e.user?e.user.name:"")}})])})),0)])])])])])])]):t._e()])],1)},o=[],i=e("12e0"),n=e("b536"),r=e("682e"),l=e("c1df"),d=e.n(l),c=e("3249"),_={components:{dashboard_center_squares:r["a"],dashboard_card_white:n["a"],dashboard_card:i["a"],CanvasJSChart:c["a"]},name:"categories",data:function(){return{url:"/dashboard?load=json",content:{pie_options:{},column_options:{},line_options:{},most_played_devices:[],latest_paid_order_devices:[],latest_order_products:[],revenue:0,most_played_games:[],latest_paid_bookings:0,latest_sold_products:0},dates_filters:[{title:this.__("Today"),value:"today"},{title:this.__("Yesterday"),value:"yesterday"},{title:this.__("Last week"),value:"-7days"},{title:this.__("Last month"),value:"-30days"},{title:this.__("Last year"),value:"-365days"}],activeDate:"today",date:null,filters:null,showLoader:!1,showCharts:!1,charts_options:{animationEnabled:!0,exportEnabled:!0,axisX:{labelTextAlign:"right"},axisY:{title:this.__("bookings_count"),suffix:""},data:[{}]}}},props:["lang","setting","conf","auth"],mounted:function(){this.load(this.url)},methods:{switchDate:function(t){this.filters="&",this.filters+="start="+t,this.filters+="&end=",this.filters+="yesterday"==t?"yesterday":"today",this.activeDate=t,this.load(this.url+this.filters)},dateFormat:function(t){return d()(t).format("YYYY-MM-DD")},dateTimeFormat:function(t){return d()(t).format("YYYY-MM-DD HH:mm a")},changeLoad:function(){console.log("changed")},load:function(t){var s=this;this.$parent.handleGetRequest(t).then((function(t){s.setValues(t).setCharts(t)}))},setValues:function(t){return this.content=JSON.parse(JSON.stringify(t)),this},setCharts:function(t){this.showCharts=!1,this.pie_options=JSON.parse(JSON.stringify(this.charts_options)),this.pie_options.data[0]={type:"pie",yValueFormatString:"#,### "+this.__("booking"),dataPoints:this.content.most_played_games},this.column_options=JSON.parse(JSON.stringify(this.charts_options)),this.column_options.axisY.title=this.__("bookings_count"),this.column_options.data[0]={type:"column",yValueFormatString:"#,### "+this.__("booking"),dataPoints:this.content.most_played_devices},this.line_options=JSON.parse(JSON.stringify(this.charts_options)),this.line_options.theme="light2",this.line_options.axisY.suffix=this.setting.currency,this.line_options.axisY.title=this.__("sales"),this.line_options.toolTip={shared:!0},this.line_options.data[0]={type:"line",color:"#003c58",showInLegend:!0,yValueFormatString:this.setting.currency+"#,### "+this.__("sales"),dataPoints:this.content.orders_charts},this.showCharts=!0},__:function(t){return this.$parent.__(t)}}},p=_,u=(e("dd7c"),e("2877")),h=Object(u["a"])(p,a,o,!1,null,null,null);s["default"]=h.exports},"981d":function(t,s,e){},dd7c:function(t,s,e){"use strict";e("981d")}}]);
//# sourceMappingURL=chunk-dd9c0268.chunk.js.map