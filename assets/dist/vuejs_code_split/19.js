(window.webpackJsonp=window.webpackJsonp||[]).push([[19],{55:function(e,t,n){"use strict";n.r(t);var s=n(9),i={props:["device","constructedEvents","temporaryEvent"],inject:["medians_calendar_options"],components:{MediansCalendarEvent:function(){return n.e(0).then(n.bind(null,32))}},computed:{cell_events:function(){var e=[];if(this.constructedEvents&&this.constructedEvents.length)for(var t=this.constructedEvents.length-1;t>=0;t--)this.constructedEvents[t]&&this.constructedEvents[t].start==this.cellData.time&&(e[t]=this.constructedEvents[t]);return e},completed_events:function(){return this.constructedEvents&&this.constructedEvents.hasOwnProperty(this.cellData.value)&&this.constructedEvents[this.cellData.value]},overlappingEvents:function(){var e=this;return!this.constructedEvents||this.cell_events.length<1?[]:Object.values(this.constructedEvents).flat().filter((function(t){var n=new Date(e.cellData.value),s=new Date(t.start),i=new Date(t.end);return s<n&&i>n}))},overlapValue:function(){var e=this.overlappingEvents.length;return e>2?2:e},selected:function(){return this.cell_events&&this.cell_events.length>0},hasPopups:function(){return this.selected&&!!this.cell_events.find((function(e){return e&&"active"===e.status}))}},methods:{mouseUp:function(){this.log("Mouse up")},resetCreator:function(){this.$emit("reset")},isAnHour:function(e){return!!this.medians_calendar_options.hourlySelection||(e+1)%6==0},show_modal:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;this.$parent.show_modal(e)},log:function(e){this.$parent.log(e)}}},l=function(e){e&&e("data-v-ec707dba_0",{source:"li{font-size:13px;position:relative}.created-events{height:100%}ul.building-blocks li{z-index:0;border-bottom:dotted 1px var(--odd-cell-border-color)}ul.building-blocks li.first_of_appointment{z-index:1;opacity:1}ul.building-blocks li.is-an-hour{border-bottom:solid 1px var(--table-cell-border-color)}ul.building-blocks li.has-events{z-index:unset}ul.building-blocks li.being-created{z-index:11}",map:void 0,media:void 0})},o=Object(s.e)({render:function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{staticClass:"medians-calendar-cell rounded relative",class:{selected:e.selected,"is-an-hour":e.isAnHour(e.index),"has-events":e.cell_events&&e.cell_events.length>0,"being-created":!!e.being_created||e.hasPopups},style:"\n  height: "+e.medians_calendar_options.cell_height+"px;\n"},[n("div",e._l(e.cell_events,(function(t,s){return e.cell_events&&e.cell_events.length&&t?n("MediansCalendarEvent",{key:s,style:"z-index: 10",attrs:{event:t,total:e.cell_events.length,index:s,overlaps:e.overlapValue}}):e._e()})),1)])},staticRenderFns:[]},l,i,void 0,!1,void 0,!1,s.f,void 0,void 0);t.default=o}}]);