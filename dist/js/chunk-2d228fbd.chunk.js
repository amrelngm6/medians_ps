(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2d228fbd"],{dc08:function(e,t,n){"use strict";n.r(t);var a=n("e39d"),i=(n("c1df"),{props:["event","total","index","overlaps","column_index"],mounted:function(){var e=this;e.status=e.event.status,setTimeout((function(){jQuery("#event-"+e.index+" > .animated").css("opacity",1)}),this.column_index*this.medians_calendar_options.animation_speed)},inject:["medians_calendar_options"],data:function(){return{opacity:0,inspecting:!1,editing:!1,status:""}},computed:{isPast:function(){var e=Object(a["k"])((new Date).toISOString());return Object(a["l"])(this.event.start.value,e)},width_value:function(){return"calc(100% - 20px)"},left_offset:function(){return"10px"},top_offset:function(){var e=Object(a["i"])(this.event.from,this.medians_calendar_options.hourlySelection);return e>0?"".concat(e/10*this.medians_calendar_options.cell_height,"px"):"0px"},distance:function(){if(this.event){var e=this.medians_calendar_options.cell_height/10;return"".concat(this.event.distance*e-.2*e,"px")}},status:function(){return this.event&&this.event.status||this.editing},information:function(){var e=this.event,t=e.start,n=e.end,i=e.data,s=e.id,o=e.key,r={start_time:Object(a["n"])(t),end_time:Object(a["n"])(n),medians_calendar_id:s,key:o,data:i};return r},editEvent:function(){this.$medians_calendar.closePopups(),this.editing=!0},closeEventPopup:function(){this.editing=!1}},methods:{dragStart:function(e){if("canceled"==this.event.status)return this.$alert(this.$root.$children[0].__("this_is_canceled_event")),!1;this.$parent.dragEvent=e,this.$emit("dragStart",e)},mouseUp:function(){"canceled"==this.event.status?this.$alert(this.$root.$children[0].__("this_is_canceled_event")):this.$parent.show_modal(this.event)},log:function(e){this.$parent.log(e)}}}),s=i,o=function(){var e=this,t=e.$createElement,n=e._self._c||t;return e.event?n("div",{ref:"medians_calendarEventRef-"+e.event.id,staticClass:"animated right-0 left-0 mx-auto event-card cursor-pointer",class:{"bg-gray-200":"canceled"==e.event.status,"text-gray-500":"canceled"==e.event.status,canceled:"canceled"==e.event.status,new:"new"==e.event.status,active:"active"==e.event.status,completed:"completed"==e.event.status,paid:"paid"==e.event.status,"is-past":e.isPast,overlaps:e.overlaps>0,"two-in-one":e.total>1,inspecting:!!e.inspecting,"event-card__mini":e.event.distance<=10,"event-card__small":e.event.distance>10&&e.event.distance<40||e.overlaps>1},style:"\n      height: "+e.distance+"; \n      width: "+e.width_value+"; \n      top: "+e.top_offset+";\n    ",attrs:{id:"event-"+e.index,draggable:""},on:{mouseup:e.mouseUp,dragstart:function(t){return e.dragStart(e.event)}}},[n("div",{key:"opacity"+e.opacity,staticClass:"animated fadeIn rounded-lg px-2 py-3",class:"canceled"!=e.event.status?e.event.classes:"",style:"opacity:"+e.opacity},[n("div",{staticClass:"absolute top-4 right-2 flex gap gap-2 font-semibold text-xs"},[n("span",{domProps:{textContent:e._s(e.event.start_time)}}),e._v(" "),n("span",{domProps:{textContent:e._s(e.event.end_time)}})]),e._v(" "),n("div",[n("span",{staticClass:"w-full block pb-2 text-left",staticStyle:{direction:"ltr"}},[e.event.game?n("img",{staticClass:"rounded-full w-8 h-8 mb-2",attrs:{src:e.event.game.picture}}):e._e(),e._v(" "),n("span",{staticClass:"font-xxs font-semibold text-left w-full",domProps:{textContent:e._s(e.event.title)}})])])])]):e._e()},r=[],d=function(e){e&&(e("data-v-73317010_0",{source:".event-card{display:flex;flex-direction:column;height:100%;width:100%;position:absolute;top:0;left:0;right:0;bottom:0;color:#fff;user-select:none;will-change:height}.event-card h4,.event-card p,.event-card span{margin:0}.event-card>*{flex:1;position:relative}.event-card.creating{z-index:-1}.event-card.overlaps>*{border:solid 1px #fff!important}.event-card.inspecting{z-index:11!important}.event-card.inspecting .created-event{box-shadow:0 6px 10px 0 rgba(0,0,0,.14),0 1px 18px 0 rgba(0,0,0,.12),0 3px 5px -1px rgba(0,0,0,.2);transition:opacity .1s linear}.event-card__mini .created-event>.details-card>*{display:none}.event-card__mini .appointment-title,.event-card__mini .time{display:block!important;position:absolute;top:0;font-size:9px;z-index:1;overflow:visible;height:100%}.event-card__small .appointment-title{font-size:80%}.event-card__small .time{font-size:70%}.event-card.two-in-one .details-card>*{font-size:60%}.event-card h1,.event-card h2,.event-card h3,.event-card h4,.event-card h5,.event-card h6,.event-card p{margin:0}.time{position:absolute;bottom:0;right:0;font-size:11px}.popup-wrapper{text-shadow:none;color:#000;z-index:10;position:absolute;top:0;left:calc(100% + 5px);display:flex;flex-direction:column;pointer-events:all;user-select:none;background-color:#fff;border:solid 1px rgba(0,0,0,.08);border-radius:4px;box-shadow:0 2px 12px -3px rgba(0,0,0,.3);padding:10px}.popup-wrapper h4{color:#000;font-weight:400}.popup-wrapper input,.popup-wrapper textarea{border:none;background-color:#ebebeb;color:#030303;border-radius:4px;padding:5px 8px;margin-bottom:5px}.created-event{pointer-events:all;position:relative}.created-event>.details-card{max-width:100%;width:100%;overflow:hidden;position:relative;white-space:nowrap;text-overflow:ellipsis;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical}.created-event>.details-card h2,.created-event>.details-card h3,.created-event>.details-card h4,.created-event>.details-card p,.created-event>.details-card small,.created-event>.details-card span,.created-event>.details-card strong,.created-event>.details-card>h1{text-overflow:ellipsis;overflow:hidden;display:block}ul:last-child .popup-wrapper{left:auto;right:100%;margin-right:10px}.day-view ul .popup-wrapper{left:auto;right:auto;width:calc(100% - 10px);top:10px}",map:void 0,media:void 0}),e("data-v-73317010_1",{source:".animated{opacity:0;transition:all .5s ease-in-out}",map:void 0,media:void 0}))},c=void 0,l=void 0,p=!1,v=Object(a["e"])({render:o,staticRenderFns:r},d,s,c,p,l,!1,a["f"],void 0,void 0);t["default"]=v}}]);
//# sourceMappingURL=chunk-2d228fbd.chunk.js.map