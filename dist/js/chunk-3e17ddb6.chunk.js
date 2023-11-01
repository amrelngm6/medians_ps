(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-3e17ddb6"],{"1cf0":function(t,s,e){"use strict";e("4be2")},"25bb":function(t,s,e){"use strict";e.r(s);e("7f7f");var a=function(){var t=this,s=t._self._c;return s("div",{staticClass:"w-full overflow-auto",staticStyle:{height:"85vh","z-index":"9999"}},[s("div",{staticClass:"top-0 py-2 w-full px-2 bg-gray-100 mt-0 sticky",staticStyle:{"z-index":"9"}},[s("div",{staticClass:"w-full flex gap-6"},[s("h3",{staticClass:"text-base lg:text-lg whitespace-nowrap",domProps:{textContent:t._s(t.__("Dashboard Reports"))}}),s("ul",{staticClass:"w-full flex gap-4"},t._l(t.dates_filters,(function(e){return e?s("li",{staticClass:"cursor-pointer",class:t.activeDate==e.value?"font-semibold":"",domProps:{textContent:t._s(t.__(e.title))},on:{click:function(s){return t.switchDate(e.value)}}}):t._e()})),0)])]),s("div",{staticClass:"block w-full overflow-x-auto py-2"},[t.lang&&!t.showLoader&&t.setting?s("div",{staticClass:"w-full overflow-y-auto overflow-x-hidden px-2 mt-6"},[s("div",{},[s("div",{staticClass:"grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-6"},[s("dashboard_card_white",{attrs:{icon:"/uploads/img/booking-unpaid.png",classes:"bg-gradient-danger",title:t.__("active_trips"),value:t.content.active_trips_count}}),s("dashboard_card_white",{attrs:{icon:"/uploads/img/booking-paid.png",classes:"bg-gradient-info",title:t.__("completed_trips"),value:t.content.completed_trips_count}}),s("dashboard_card_white",{attrs:{icon:"/uploads/img/booking_income.png",classes:"bg-gradient-success",title:t.__("total_trips"),value:t.content.total_trips_count}}),s("dashboard_card_white",{attrs:{icon:"/uploads/img/products_icome.png",classes:"bg-gradient-warning",title:t.__("help_messages"),value:t.content.help_messages_count}})],1),t.content.trips_charts&&t.content.trips_charts.length?s("div",{staticClass:"w-full bg-white p-4 mb-4 rounded-lg"},[t.showCharts&&t.content.trips_charts.length?s("CanvasJSChart",{key:t.line_options,attrs:{options:t.line_options}}):t._e()],1):t._e(),s("div",{staticClass:"row mt-6"},[s("dashboard_card",{attrs:{classes:"bg-gradient-success",title:t.__("Vehciles"),value:t.content.vehicles_count}}),s("dashboard_card",{attrs:{classes:"bg-gradient-danger",title:t.__("Drivers"),value:t.content.drivers_count}}),s("dashboard_card",{attrs:{classes:"bg-gradient-primary",title:t.__("Routes"),value:t.content.routes_count}}),s("dashboard_card",{attrs:{classes:"bg-gradient-purple",title:t.__("Pickup locations"),value:t.content.pickup_locations_count}})],1)]),s("div",{staticClass:"w-full lg:flex gap gap-6 pb-6"},[s("div",{staticClass:"card mb-0 w-2/3"},[s("h4",{staticClass:"p-4 ml-4",domProps:{textContent:t._s(t.__("Top drivers"))}}),s("p",{staticClass:"text-sm text-gray-500 px-4 mb-6",domProps:{textContent:t._s(t.__("top_drivers_who_have_most_trips"))}}),s("div",{staticClass:"card-body w-full"},[s("div",{staticClass:"w-full"},[t.showCharts&&t.content.top_drivers&&t.content.top_drivers.length?s("CanvasJSChart",{key:t.column_options,attrs:{options:t.column_options}}):t._e()],1)])]),s("div",{staticClass:"card w-1/3 lg:w-1/3 lg:mb-0"},[s("h4",{staticClass:"p-4 ml-4",domProps:{textContent:t._s(t.__("Latest students"))}}),s("p",{staticClass:"text-sm text-gray-500 px-4 mb-6",domProps:{textContent:t._s(t.__("latest_students_has_been_added"))}}),s("div",{staticClass:"card-body w-full"},[s("div",{staticClass:"w-full"},[s("div",{staticClass:"table-responsive w-full"},[s("table",{staticClass:"w-full table table-striped table-nowrap custom-table mb-0 datatable"},[s("thead",[s("tr",[s("th",{attrs:{colspan:"2"},domProps:{textContent:t._s(t.__("Student"))}}),s("th",{domProps:{textContent:t._s(t.__("Contact"))}})])]),t.content.latest_students?s("tbody",t._l(t.content.latest_students,(function(e,a){return e?s("tr",{key:a,staticClass:"text-center"},[s("td",[s("img",{staticClass:"rounded",attrs:{width:"48",height:"48",src:e.picture}})]),s("td",{domProps:{textContent:t._s(e.first_name)}}),s("td",{domProps:{textContent:t._s(e.contact_number)}})]):t._e()})),0):t._e()])])])])])]),s("div",{staticClass:"w-full lg:flex gap gap-6 pb-6"},[s("div",{staticClass:"card w-full no-mobile"},[s("div",{staticClass:"w-full flex p-4"},[s("h4",{staticClass:"w-full",domProps:{textContent:t._s(t.__("Latest help messages"))}}),s("a",{staticClass:"w-20",attrs:{href:"/admin/help_messages"},domProps:{textContent:t._s(t.__("View all"))}})]),s("div",{staticClass:"card-body w-full"},[s("div",{staticClass:"w-full"},[s("div",{staticClass:"table-responsive w-full"},[s("table",{staticClass:"w-full table table-striped table-nowrap custom-table mb-0 datatable"},[s("thead",[s("tr",[s("th",{domProps:{textContent:t._s(t.__("name"))}}),s("th",{domProps:{textContent:t._s(t.__("subject"))}}),s("th",{domProps:{textContent:t._s(t.__("message"))}}),s("th",{domProps:{textContent:t._s(t.__("date"))}}),s("th",{domProps:{textContent:t._s(t.__("status"))}})])]),s("tbody",t._l(t.content.latest_help_messages,(function(e,a){return s("tr",{key:a,staticClass:"text-center"},[s("td",{staticClass:"flex gap-2"},[e.user?s("img",{staticClass:"rounded",attrs:{src:e.user.picture,width:"24",height:"24"}}):t._e(),e.user?s("span",{domProps:{textContent:t._s(e.user.name)}}):t._e()]),s("td",{domProps:{textContent:t._s(e.subject)}}),s("td",{staticClass:"text-red-500",domProps:{textContent:t._s(e.message)}}),s("td",{domProps:{textContent:t._s(t.dateTimeFormat(e.created_at))}}),s("td",{domProps:{textContent:t._s(e.date)}}),s("td",{domProps:{textContent:t._s(e.status)}})])})),0)])])])])])])]):t._e()])])},i=[],o=e("12e0"),n=e("b536"),l=e("682e"),r=e("c1df"),d=e.n(r),_=e("3249"),c={components:{dashboard_center_squares:l["a"],dashboard_card_white:n["a"],dashboard_card:o["a"],CanvasJSChart:_["a"]},name:"categories",data:function(){return{url:"/dashboard?load=json",content:{pie_options:{},column_options:{},line_options:{},most_played_devices:[],latest_paid_order_devices:[],latest_order_products:[],trips_charts:[],revenue:0,most_played_games:[],latest_paid_bookings:0,latest_sold_products:0},dates_filters:[{title:this.__("Today"),value:"today"},{title:this.__("Yesterday"),value:"yesterday"},{title:this.__("Last week"),value:"-7days"},{title:this.__("Last month"),value:"-30days"},{title:this.__("Last year"),value:"-365days"}],activeDate:"today",date:null,filters:null,showLoader:!1,showCharts:!1,charts_options:{animationEnabled:!0,exportEnabled:!0,axisX:{labelTextAlign:"right"},axisY:{title:this.__("trips_count"),suffix:""},data:[{}]}}},props:["lang","setting","conf","auth"],mounted:function(){this.load(this.url)},methods:{switchDate:function(t){this.filters="&",this.filters+="start="+t,this.filters+="&end=",this.filters+="yesterday"==t?"yesterday":"today",this.activeDate=t,this.load(this.url+this.filters)},dateFormat:function(t){return d()(t).format("YYYY-MM-DD")},dateTimeFormat:function(t){return d()(t).format("YYYY-MM-DD HH:mm a")},changeLoad:function(){console.log("changed")},load:function(t){var s=this;this.$parent.handleGetRequest(t).then((function(t){s.setValues(t).setCharts(t)}))},setValues:function(t){return this.content=JSON.parse(JSON.stringify(t)),this},setCharts:function(t){this.showCharts=!1,this.pie_options=JSON.parse(JSON.stringify(this.charts_options)),this.pie_options.data[0]={type:"pie",yValueFormatString:"#,### "+this.__("booking"),dataPoints:this.content.most_played_games},this.column_options=JSON.parse(JSON.stringify(this.charts_options)),this.column_options.axisY.title=this.__("Trips count"),this.column_options.data[0]={type:"column",yValueFormatString:"#,### "+this.__("Trips count"),dataPoints:this.content.top_drivers},this.line_options=JSON.parse(JSON.stringify(this.charts_options)),this.line_options.theme="light2",this.line_options.axisY.suffix=this.setting.currency,this.line_options.axisY.title=this.__("Trips"),this.line_options.toolTip={shared:!0},this.line_options.data[0]={type:"line",color:"#003c58",showInLegend:!0,yValueFormatString:"#,### "+this.__("Trips"),dataPoints:this.content.trips_charts},this.showCharts=!0},__:function(t){return this.$parent.__(t)}}},p=c,u=(e("1cf0"),e("2877")),h=Object(u["a"])(p,a,i,!1,null,null,null);s["default"]=h.exports},"4be2":function(t,s,e){}}]);
//# sourceMappingURL=chunk-3e17ddb6.chunk.js.map