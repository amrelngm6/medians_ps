(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-6dc95fe6"],{"08ce":function(t,e,n){"use strict";n.r(e);var i,o,a=function(){var t=this,e=t._self._c;return e("div",{staticClass:"w-full overflow-auto",staticStyle:{height:"85vh","z-index":"9999"}},[e("GmapMap",{key:t.reload,ref:"gmap",staticStyle:{width:"100%",height:"calc(100vh -  100px)"},attrs:{center:t.center,options:{zoomControl:!0,mapTypeControl:!0,scaleControl:!0,streetViewControl:!0,rotateControl:!0,fullscreenControl:!0},zoom:t.zoom}},[t._l(t.waypoints,(function(n,i){return t.showroute?e("DirectionsRenderer",{key:n,attrs:{origin:n.origin,destination:n.destination,travelMode:t.travelMode}}):t._e()})),t._l(t.waypoints,(function(n,i){return e("GmapMarker",{key:t.waypoints,attrs:{position:n.destination,clickable:!0,draggable:!!n.drag,icon:n.icon?n.icon:null},on:{click:function(e){return t.checkMarker(i)},drag:function(e){t.activeMarkerIndex=i},dragend:t.updateMarker}})}))],2),e("select",{directives:[{name:"model",rawName:"v-model",value:t.travelMode,expression:"travelMode"}],attrs:{change:t.calculateAndDisplayRoute},on:{change:function(e){var n=Array.prototype.filter.call(e.target.options,(function(t){return t.selected})).map((function(t){var e="_value"in t?t._value:t.value;return e}));t.travelMode=e.target.multiple?n:n[0]}}},t._l(t.modes,(function(n){return e("option",{domProps:{value:n,textContent:t._s(n)}})})),0)],1)},r=[],s=(n("55dd"),n("96cf"),n("1da1")),l=(n("ac6a"),n("755e")),c=Object(l["MapElementFactory"])({name:"directionsRenderer",ctr:function(){return window.google.maps.DirectionsRenderer},events:[],mappedProps:{},props:{origin:{type:Object},destination:{type:Object},travelMode:{type:String}},afterCreate:function(t){var e=this,n=new window.google.maps.DirectionsService;this.$watch((function(){return[e.origin,e.destination,e.travelMode]}),(function(){var i=e.origin,o=e.destination,a=e.travelMode;i&&o&&a&&n.route({origin:i,destination:o,travelMode:a},(function(e,n){"OK"===n&&t.setDirections(e)}))}))}}),u=c,d=n("2877"),p=Object(d["a"])(u,i,o,!1,null,null,null),g=p.exports,w={components:{DirectionsRenderer:g},name:"Vehicles",data:function(){return{imageUrl:"http://192.168.1.99:81/uploads/images/",modes:["DRIVING","WALKING"],activeMarkerIndex:0,reload:!0,render:!0,travelMode:"DRIVING",origin:{lat:30.093048,lng:31.15212},destination:{lat:30.073048,lng:31.14212},zoom:14,center:{lat:30.058122734715376,lng:31.219219598388676},markers:[{position:{lat:30.058122735715376,lng:31.21921983886761}},{position:{lat:30.058122734715376,lng:31.219219598388676}},{position:{lat:30.057544505767098,lng:31.22335947143557}},{position:{lat:30.062368086177194,lng:31.221097905273425}},{position:{lat:30.05930379083195,lng:31.22166653358458}}]}},computed:{},props:["path","lang","setting","conf","auth","showroute","waypoints"],mounted:function(){var t=this;t.directionsService=new window.google.maps.DirectionsService,t.directionsDisplay=new window.google.maps.DirectionsRenderer,t.waypoints&&t.waypoints.length&&t.calculateAndDisplayRoute(),console.log(this.waypoints)},methods:{setMarker:function(t){this.activeMarkerIndex=t},updateDestination:function(t){this.destination={lat:t.latLng.lat(),lng:t.latLng.lng()}},updateOrigin:function(t){this.origin={lat:t.latLng.lat(),lng:t.latLng.lng()}},updateMarker:function(t){this.waypoints[this.activeMarkerIndex].destination={lat:t.latLng.lat(),lng:t.latLng.lng()},this.$emit("update-marker",this.waypoints[this.activeMarkerIndex],this.activeMarkerIndex)},checkMarker:function(t){console.log(this.waypoints[t]),this.$emit("click-marker",this.waypoints[t],t)},addMarker:function(){this.markers[this.markers.length]={position:{lat:this.markers[this.markers.length-1].position.lat+.005,lng:this.markers[this.markers.length-1].position.lat+.05}},this.sortWaypointsByDistance(),this.calculateAndDisplayRoute()},setMode:function(){this.travelMode},calculateAndDisplayRoute:function(){console.log(window.google);var t=this;if(window.google&&this.waypoints.length){console.log(this.waypoints);var e=this.$refs.gmap.$mapObject;this.directionsDisplay.setMap(e),this.showroute=!1,this.waypoints.forEach((function(e,n){var i=e.origin,o=e.destination,a=new window.google.maps.LatLng(o.lat,o.lng),r=new window.google.maps.LatLng(i.lat,i.lng);console.log(a.lat,a.lng,r.lat,r.lng),t.directionsService.route({origin:r,destination:a,travelMode:"DRIVING"},(function(e,n){"OK"===n?(t.directionsDisplay.setDirections(e),console.log(t.directionsDisplay)):console.warn("Directions request failed due to "+n)}))})),this.showroute=!0}},calculateAndDisplayRoute2:function(){var t=Object(s["a"])(regeneratorRuntime.mark((function t(){var e,n,i;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:window.google&&(this.render=!1,e=new window.google.maps.DirectionsService,n=new window.google.maps.DirectionsRenderer,i=this.$refs.gmap.$mapObject,n.setMap(i),e.route({origin:this.origin,destination:this.destination,travelMode:this.travelMode,waypoints:this.waypoints.map((function(t){return{location:t}}))},(function(t,e){"OK"===e?n.setDirections(t):console.error("Directions request failed due to "+e)})),this.render=!0);case 1:case"end":return t.stop()}}),t,this)})));function e(){return t.apply(this,arguments)}return e}(),sortWaypointsByDistance:function(){var t=this,e=this.waypoints.map((function(e){var n=new window.google.maps.LatLng(t.origin),i=new window.google.maps.LatLng(t.destination),o=new window.google.maps.LatLng(e.location),a=window.google.maps.geometry.spherical.computeDistanceBetween(n,o),r=window.google.maps.geometry.spherical.computeDistanceBetween(o,i);return{waypoint:e,distance:a+r}}));return e.sort((function(t,e){return t.distance-e.distance})),e.map((function(t){return t.waypoint}))},__:function(t){return this.$root.$children[0].__(t)}}},h=w,f=Object(d["a"])(h,a,r,!1,null,null,null);e["default"]=f.exports},"2f21":function(t,e,n){"use strict";var i=n("79e5");t.exports=function(t,e){return!!t&&i((function(){e?t.call(null,(function(){}),1):t.call(null)}))}},"55dd":function(t,e,n){"use strict";var i=n("5ca1"),o=n("d8e8"),a=n("4bf8"),r=n("79e5"),s=[].sort,l=[1,2,3];i(i.P+i.F*(r((function(){l.sort(void 0)}))||!r((function(){l.sort(null)}))||!n("2f21")(s)),"Array",{sort:function(t){return void 0===t?s.call(a(this)):s.call(a(this),o(t))}})}}]);
//# sourceMappingURL=chunk-6dc95fe6.chunk.js.map