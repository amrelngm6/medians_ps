(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-6dc95fe6"],{"08ce":function(t,n,e){"use strict";e.r(n);var i,o,a=function(){var t=this,n=t._self._c;return n("div",{staticClass:"w-full overflow-auto",staticStyle:{height:"85vh","z-index":"9999"}},[n("GmapMap",{key:t.reload,ref:"gmap",staticStyle:{width:"100%",height:"calc(100vh -  100px)"},attrs:{center:t.center,options:{zoomControl:!0,mapTypeControl:!0,scaleControl:!0,streetViewControl:!0,rotateControl:!0,fullscreenControl:!0},zoom:t.zoom}},[n("GmapPolyline",{attrs:{path:t.polylineCoordinates,index:t.polylineCoordinates,editable:!0}}),t._l(t.waypoints,(function(e,i){return t.showroute?n("DirectionsRenderer",{key:e,attrs:{origin:e.origin,destination:e.destination,travelMode:t.travelMode}}):t._e()})),t._l(t.waypoints,(function(e,i){return n("GmapMarker",{key:t.waypoints,attrs:{position:e.destination,clickable:!0,draggable:!!e.drag,icon:e.icon?e.icon:null},on:{click:function(n){return t.checkMarker(i)},drag:function(n){t.activeMarkerIndex=i},dragend:t.updateMarker}})}))],2),n("select",{directives:[{name:"model",rawName:"v-model",value:t.travelMode,expression:"travelMode"}],attrs:{change:t.calculateAndDisplayRoute},on:{change:function(n){var e=Array.prototype.filter.call(n.target.options,(function(t){return t.selected})).map((function(t){var n="_value"in t?t._value:t.value;return n}));t.travelMode=n.target.multiple?e:e[0]}}},t._l(t.modes,(function(e){return n("option",{domProps:{value:e,textContent:t._s(e)}})})),0)],1)},r=[],s=(e("96cf"),e("1da1")),l=(e("ac6a"),e("55dd"),e("755e")),c=Object(l["MapElementFactory"])({name:"directionsRenderer",ctr:function(){return window.google.maps.DirectionsRenderer},events:[],mappedProps:{},props:{origin:{type:Object},destination:{type:Object},travelMode:{type:String}},afterCreate:function(t){var n=this,e=new window.google.maps.DirectionsService;this.$watch((function(){return[n.origin,n.destination,n.travelMode]}),(function(){var i=n.origin,o=n.destination,a=n.travelMode;i&&o&&a&&e.route({origin:i,destination:o,travelMode:a},(function(n,e){"OK"===e&&t.setDirections(n)}))}))}}),u=c,d=e("2877"),p=Object(d["a"])(u,i,o,!1,null,null,null),g=p.exports,h={components:{DirectionsRenderer:g},name:"Vehicles",data:function(){return{imageUrl:"http://192.168.1.99:81/uploads/images/",modes:["DRIVING","WALKING"],activeMarkerIndex:0,reload:!0,render:!0,travelMode:"DRIVING",origin:{lat:30.093048,lng:31.15212},destination:{lat:30.073048,lng:31.14212},zoom:14,center:{lat:30.058122734715376,lng:31.219219598388676},markers:[{position:{lat:30.058122735715376,lng:31.21921983886761}},{position:{lat:30.058122734715376,lng:31.219219598388676}},{position:{lat:30.057544505767098,lng:31.22335947143557}},{position:{lat:30.062368086177194,lng:31.221097905273425}},{position:{lat:30.05930379083195,lng:31.22166653358458}}],polylineCoordinates:[]}},computed:{},props:["path","lang","setting","conf","auth","showroute","waypoints"],mounted:function(){var t=this,n=this;n.directionsService=new window.google.maps.DirectionsService,n.directionsDisplay=new window.google.maps.DirectionsRenderer,n.waypoints&&n.waypoints.length&&n.calculateAndDisplayRoute(),setInterval((function(){t.polylineCoordinates=[],n.calculateAndDisplayRoute()}),1e3),console.log(this.waypoints)},methods:{calculateDistance:function(t,n){var e=6371,i=t.lat,o=t.lng,a=n.lat,r=n.lng,s=(a-i)*(Math.PI/180),l=(r-o)*(Math.PI/180),c=Math.sin(s/2)*Math.sin(s/2)+Math.cos(i*(Math.PI/180))*Math.cos(a*(Math.PI/180))*Math.sin(l/2)*Math.sin(l/2),u=2*Math.atan2(Math.sqrt(c),Math.sqrt(1-c)),d=e*u;return d},addPoint:function(t,n){var e=this;console.log(n),"waiting"==n&&this.polylineCoordinates.push(t),this.polylineCoordinates.sort((function(t,n){var i=e.waypoints[0],o=e.calculateDistance(i,t),a=e.calculateDistance(i,n);return o-a})),console.log(this.polylineCoordinates)},setMarker:function(t){this.activeMarkerIndex=t},updateDestination:function(t){this.destination={lat:t.latLng.lat(),lng:t.latLng.lng()}},updateOrigin:function(t){this.origin={lat:t.latLng.lat(),lng:t.latLng.lng()}},updateMarker:function(t){this.waypoints[this.activeMarkerIndex].destination={lat:t.latLng.lat(),lng:t.latLng.lng()},this.$emit("update-marker",this.waypoints[this.activeMarkerIndex],this.activeMarkerIndex)},checkMarker:function(t){console.log(this.waypoints[t]),this.$emit("click-marker",this.waypoints[t],t)},addMarker:function(){this.markers[this.markers.length]={position:{lat:this.markers[this.markers.length-1].position.lat+.005,lng:this.markers[this.markers.length-1].position.lat+.05}},this.sortWaypointsByDistance(),this.calculateAndDisplayRoute()},setMode:function(){this.travelMode},calculateAndDisplayRoute:function(){var t=this;if(window.google&&this.waypoints.length){var n=this.$refs.gmap.$mapObject;this.directionsDisplay.setMap(n),this.showroute=!1,this.waypoints.forEach((function(n,e){var i=n.origin,o=n.destination,a=n.status,r=new window.google.maps.LatLng(o.lat,o.lng),s=new window.google.maps.LatLng(i.lat,i.lng);t.addPoint(o,a),console.log(r.lat(),r.lng(),s.lat(),s.lng()),t.directionsService.route({origin:s,destination:r,travelMode:"DRIVING"},(function(n,e){"OK"===e?(t.directionsDisplay.setDirections(n),console.log(t.directionsDisplay)):console.warn("Directions request failed due to "+e)}))})),this.showroute=!0}},calculateAndDisplayRoute2:function(){var t=Object(s["a"])(regeneratorRuntime.mark((function t(){var n,e,i;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:window.google&&(this.render=!1,n=new window.google.maps.DirectionsService,e=new window.google.maps.DirectionsRenderer,i=this.$refs.gmap.$mapObject,e.setMap(i),n.route({origin:this.origin,destination:this.destination,travelMode:this.travelMode,waypoints:this.waypoints.map((function(t){return{location:t}}))},(function(t,n){"OK"===n?e.setDirections(t):console.error("Directions request failed due to "+n)})),this.render=!0);case 1:case"end":return t.stop()}}),t,this)})));function n(){return t.apply(this,arguments)}return n}(),sortWaypointsByDistance:function(){var t=this,n=this.waypoints.map((function(n){var e=new window.google.maps.LatLng(t.origin),i=new window.google.maps.LatLng(t.destination),o=new window.google.maps.LatLng(n.location),a=window.google.maps.geometry.spherical.computeDistanceBetween(e,o),r=window.google.maps.geometry.spherical.computeDistanceBetween(o,i);return{waypoint:n,distance:a+r}}));return n.sort((function(t,n){return t.distance-n.distance})),n.map((function(t){return t.waypoint}))},__:function(t){return this.$root.$children[0].__(t)}}},w=h,f=Object(d["a"])(w,a,r,!1,null,null,null);n["default"]=f.exports},"2f21":function(t,n,e){"use strict";var i=e("79e5");t.exports=function(t,n){return!!t&&i((function(){n?t.call(null,(function(){}),1):t.call(null)}))}},"55dd":function(t,n,e){"use strict";var i=e("5ca1"),o=e("d8e8"),a=e("4bf8"),r=e("79e5"),s=[].sort,l=[1,2,3];i(i.P+i.F*(r((function(){l.sort(void 0)}))||!r((function(){l.sort(null)}))||!e("2f21")(s)),"Array",{sort:function(t){return void 0===t?s.call(a(this)):s.call(a(this),o(t))}})}}]);
//# sourceMappingURL=chunk-6dc95fe6.chunk.js.map