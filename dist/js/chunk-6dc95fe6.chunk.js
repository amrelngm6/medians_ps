(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-6dc95fe6"],{"08ce":function(t,e,n){"use strict";n.r(e);var i,o,a=function(){var t=this,e=t._self._c;return e("div",{staticClass:"w-full overflow-auto",staticStyle:{height:"85vh","z-index":"9999"}},[e("GmapMap",{key:t.reload,ref:"gmap",staticStyle:{width:"100%",height:"calc(100vh -  100px)"},attrs:{center:t.center,options:{zoomControl:!0,mapTypeControl:!0,scaleControl:!0,streetViewControl:!0,rotateControl:!0,fullscreenControl:!0},zoom:t.zoom}},[t.showroute&&t.directionPoints?e("DirectionsRenderer",{key:t.directionPoints,attrs:{destination:t.directionPoints.destination,origin:t.directionPoints.origin,travelMode:t.travelMode}}):t._e(),t._l(t.waypoints,(function(n,i){return e("GmapMarker",{key:t.waypoints,attrs:{position:n.destination,clickable:!0,draggable:!!n.drag,icon:n.icon?n.icon:null},on:{click:function(e){return t.checkMarker(i,this)},drag:function(e){t.activeMarkerIndex=i},dragend:t.updateMarker}})}))],2),e("select",{directives:[{name:"model",rawName:"v-model",value:t.travelMode,expression:"travelMode"}],attrs:{change:t.calculateAndDisplayRoute},on:{change:function(e){var n=Array.prototype.filter.call(e.target.options,(function(t){return t.selected})).map((function(t){var e="_value"in t?t._value:t.value;return e}));t.travelMode=e.target.multiple?n:n[0]}}},t._l(t.modes,(function(n){return e("option",{domProps:{value:n,textContent:t._s(n)}})})),0)],1)},r=[],s=(n("96cf"),n("1da1")),c=(n("55dd"),n("5ca1"),n("755e")),l=Object(c["MapElementFactory"])({name:"directionsRenderer",ctr:function(){return window.google.maps.DirectionsRenderer},events:[],mappedProps:{},props:{origin:{type:Object},destination:{type:Object},travelMode:{type:String}},afterCreate:function(t){var e=this,n=new window.google.maps.DirectionsService;this.$watch((function(){return[e.origin,e.destination,e.travelMode]}),(function(){var i=e.origin,o=e.destination,a=e.travelMode;i&&o&&a&&n.route({origin:i,destination:o,travelMode:a},(function(e,n){"OK"===n&&t.setDirections(e)}))}))}}),u=l,d=n("2877"),p=Object(d["a"])(u,i,o,!1,null,null,null),g=p.exports,h={components:{DirectionsRenderer:g},name:"Vehicles",data:function(){return{modes:["DRIVING","WALKING"],activeMarkerIndex:0,reload:!0,render:!0,travelMode:"DRIVING",origin:{lat:0,lng:0},destination:{lat:0,lng:0},zoom:14,markers:[],polylineCoordinates:[],directionPoints:{},activeDestination:{}}},computed:{},props:["path","lang","setting","conf","auth","waypoints","showroute","center"],mounted:function(){var t=this;setTimeout((function(){t.onMapReady()}),1e3)},methods:{onMapReady:function(){var t=this,e=this;e.directionsService=new window.google.maps.DirectionsService,e.directionsDisplay=new window.google.maps.DirectionsRenderer;var n=this.$refs.gmap.$mapObject;this.directionsDisplay.setMap(n),setInterval((function(){e.waypoints!=t.$parent.locations&&t.$parent.locations&&(e.waypoints=t.$parent.locations,e.calculateAndDisplayRoute())}),2e3)},calculateDistance:function(t,e){var n=6371,i=t.lat,o=t.lng,a=e.lat,r=e.lng,s=(a-i)*(Math.PI/180),c=(r-o)*(Math.PI/180),l=Math.sin(s/2)*Math.sin(s/2)+Math.cos(i*(Math.PI/180))*Math.cos(a*(Math.PI/180))*Math.sin(c/2)*Math.sin(c/2),u=2*Math.atan2(Math.sqrt(l),Math.sqrt(1-l)),d=n*u;return d},addPoint:function(t,e){var n=this;"waiting"==e&&this.polylineCoordinates.push(t),this.polylineCoordinates.sort((function(t,e){var i=n.waypoints[0],o=n.calculateDistance(i,t),a=n.calculateDistance(i,e);return o-a}))},setMarker:function(t){this.activeMarkerIndex=t},updateDestination:function(t){this.destination={lat:t.latLng.lat(),lng:t.latLng.lng()}},updateOrigin:function(t){this.origin={lat:t.latLng.lat(),lng:t.latLng.lng()}},updateMarker:function(t){this.waypoints[this.activeMarkerIndex].destination={lat:t.latLng.lat(),lng:t.latLng.lng()},this.$emit("update-marker",this.waypoints[this.activeMarkerIndex],t)},checkMarker:function(t,e){this.activeDestination=this.waypoints[t].destination,this.$emit("click-marker",this.waypoints[t],t,handlePositionToPlaceId(e.destination.latitude,e.destination.longitude)),this.calculateAndDisplayRoute()},addMarker:function(){this.markers[this.markers.length]={position:{lat:this.markers[this.markers.length-1].position.lat+.005,lng:this.markers[this.markers.length-1].position.lat+.05}},this.sortWaypointsByDistance(),this.calculateAndDisplayRoute()},setMode:function(){this.travelMode},calculateAndDisplayRoute:function(){var t=this;if(window.google&&this.waypoints.length){t.directionPoints={origin:t.waypoints[0].destination,destination:t.waypoints[1].destination};var e=t.directionPoints,n=e.origin,i=e.destination;t.directionsService.route({origin:new window.google.maps.LatLng(n.lat,n.lng),destination:this.activeDestination?this.activeDestination:new window.google.maps.LatLng(i.lat,i.lng),travelMode:"DRIVING"},(function(e,n){"OK"===n?t.directionsDisplay.setDirections(e):console.warn("Directions request failed due to "+n)}))}},calculateAndDisplayRoute2:function(){var t=Object(s["a"])(regeneratorRuntime.mark((function t(){var e,n,i;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:window.google&&(this.render=!1,e=new window.google.maps.DirectionsService,n=new window.google.maps.DirectionsRenderer,i=this.$refs.gmap.$mapObject,n.setMap(i),e.route({origin:this.origin,destination:this.destination,travelMode:this.travelMode,waypoints:this.waypoints.map((function(t){return{location:t}}))},(function(t,e){"OK"===e?n.setDirections(t):console.error("Directions request failed due to "+e)})),this.render=!0);case 1:case"end":return t.stop()}}),t,this)})));function e(){return t.apply(this,arguments)}return e}(),sortWaypointsByDistance:function(){var t=this,e=this.waypoints.map((function(e){var n=new window.google.maps.LatLng(t.origin),i=new window.google.maps.LatLng(t.destination),o=new window.google.maps.LatLng(e.location),a=window.google.maps.geometry.spherical.computeDistanceBetween(n,o),r=window.google.maps.geometry.spherical.computeDistanceBetween(o,i);return{waypoint:e,distance:a+r}}));return e.sort((function(t,e){return t.distance-e.distance})),e.map((function(t){return t.waypoint}))},getPlaceIdFromPosition:function(){var t=Object(s["a"])(regeneratorRuntime.mark((function t(e,n){var i,o;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return i=new google.maps.Geocoder,o={lat:parseFloat(e),lng:parseFloat(n)},t.abrupt("return",new Promise((function(t,e){i.geocode({location:o},(function(n,i){"OK"===i?n[0]?t(n[0].place_id):e("No results found"):e("Geocoder failed due to: ".concat(i))}))})));case 3:case"end":return t.stop()}}),t)})));function e(e,n){return t.apply(this,arguments)}return e}(),handlePositionToPlaceId:function(){var t=Object(s["a"])(regeneratorRuntime.mark((function t(e,n){var i;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return t.prev=0,t.next=3,this.getPlaceIdFromPosition(e,n);case 3:return i=t.sent,console.log("Place ID:",i),t.abrupt("return",i);case 8:t.prev=8,t.t0=t["catch"](0),console.error(t.t0);case 11:case"end":return t.stop()}}),t,this,[[0,8]])})));function e(e,n){return t.apply(this,arguments)}return e}(),__:function(t){return this.$root.$children[0].__(t)}}},w=h,f=Object(d["a"])(w,a,r,!1,null,null,null);e["default"]=f.exports},"2f21":function(t,e,n){"use strict";var i=n("79e5");t.exports=function(t,e){return!!t&&i((function(){e?t.call(null,(function(){}),1):t.call(null)}))}},"55dd":function(t,e,n){"use strict";var i=n("5ca1"),o=n("d8e8"),a=n("4bf8"),r=n("79e5"),s=[].sort,c=[1,2,3];i(i.P+i.F*(r((function(){c.sort(void 0)}))||!r((function(){c.sort(null)}))||!n("2f21")(s)),"Array",{sort:function(t){return void 0===t?s.call(a(this)):s.call(a(this),o(t))}})}}]);
//# sourceMappingURL=chunk-6dc95fe6.chunk.js.map