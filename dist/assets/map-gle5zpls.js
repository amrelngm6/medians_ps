import{L as x,Y as G,Z as j,q as v,$ as I,a0 as R,N as M,a1 as P,a2 as U,O as ie,o as k,c as E,a as q,R as V,a3 as ue,a4 as de,a5 as ae,m as ne,d as T,_ as pe,r as z,j as A,u as H,F as J,i as Y}from"./index-vn5E2vYX.js";(function(){try{if(typeof document<"u"){var r=document.createElement("style");r.appendChild(document.createTextNode(".mapdiv[data-v-174b771e]{width:100%;height:100%}.info-window-wrapper[data-v-90174664]{display:none}.mapdiv .info-window-wrapper[data-v-90174664]{display:inline-block}.custom-marker-wrapper[data-v-2d2d343a]{display:none}.mapdiv .custom-marker-wrapper[data-v-2d2d343a]{display:inline-block}")),document.head.appendChild(r)}}catch(e){console.error("vite-plugin-css-injected-by-js",e)}})();var he=Object.defineProperty,me=(r,e,t)=>e in r?he(r,e,{enumerable:!0,configurable:!0,writable:!0,value:t}):r[e]=t,X=(r,e,t)=>(me(r,typeof e!="symbol"?e+"":e,t),t);const F=Symbol("map"),K=Symbol("api"),se=Symbol("marker"),ge=Symbol("markerCluster"),B=Symbol("CustomMarker"),ve=Symbol("mapTilesLoaded"),N=["click","dblclick","drag","dragend","dragstart","mousedown","mousemove","mouseout","mouseover","mouseup","rightclick"];/*! *****************************************************************************
Copyright (c) Microsoft Corporation.

Permission to use, copy, modify, and/or distribute this software for any
purpose with or without fee is hereby granted.

THE SOFTWARE IS PROVIDED "AS IS" AND THE AUTHOR DISCLAIMS ALL WARRANTIES WITH
REGARD TO THIS SOFTWARE INCLUDING ALL IMPLIED WARRANTIES OF MERCHANTABILITY
AND FITNESS. IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY SPECIAL, DIRECT,
INDIRECT, OR CONSEQUENTIAL DAMAGES OR ANY DAMAGES WHATSOEVER RESULTING FROM
LOSS OF USE, DATA OR PROFITS, WHETHER IN AN ACTION OF CONTRACT, NEGLIGENCE OR
OTHER TORTIOUS ACTION, ARISING OUT OF OR IN CONNECTION WITH THE USE OR
PERFORMANCE OF THIS SOFTWARE.
***************************************************************************** */function ye(r,e,t,i){function o(a){return a instanceof t?a:new t(function(n){n(a)})}return new(t||(t=Promise))(function(a,n){function d(u){try{p(i.next(u))}catch(c){n(c)}}function m(u){try{p(i.throw(u))}catch(c){n(c)}}function p(u){u.done?a(u.value):o(u.value).then(d,m)}p((i=i.apply(r,e||[])).next())})}var fe=function r(e,t){if(e===t)return!0;if(e&&t&&typeof e=="object"&&typeof t=="object"){if(e.constructor!==t.constructor)return!1;var i,o,a;if(Array.isArray(e)){if(i=e.length,i!=t.length)return!1;for(o=i;o--!==0;)if(!r(e[o],t[o]))return!1;return!0}if(e.constructor===RegExp)return e.source===t.source&&e.flags===t.flags;if(e.valueOf!==Object.prototype.valueOf)return e.valueOf()===t.valueOf();if(e.toString!==Object.prototype.toString)return e.toString()===t.toString();if(a=Object.keys(e),i=a.length,i!==Object.keys(t).length)return!1;for(o=i;o--!==0;)if(!Object.prototype.hasOwnProperty.call(t,a[o]))return!1;for(o=i;o--!==0;){var n=a[o];if(!r(e[n],t[n]))return!1}return!0}return e!==e&&t!==t};const Q="__googleMapsScriptId";var O;(function(r){r[r.INITIALIZED=0]="INITIALIZED",r[r.LOADING=1]="LOADING",r[r.SUCCESS=2]="SUCCESS",r[r.FAILURE=3]="FAILURE"})(O||(O={}));class S{constructor({apiKey:e,authReferrerPolicy:t,channel:i,client:o,id:a=Q,language:n,libraries:d=[],mapIds:m,nonce:p,region:u,retries:c=3,url:h="https://maps.googleapis.com/maps/api/js",version:g}){if(this.callbacks=[],this.done=!1,this.loading=!1,this.errors=[],this.apiKey=e,this.authReferrerPolicy=t,this.channel=i,this.client=o,this.id=a||Q,this.language=n,this.libraries=d,this.mapIds=m,this.nonce=p,this.region=u,this.retries=c,this.url=h,this.version=g,S.instance){if(!fe(this.options,S.instance.options))throw new Error(`Loader must not be called again with different options. ${JSON.stringify(this.options)} !== ${JSON.stringify(S.instance.options)}`);return S.instance}S.instance=this}get options(){return{version:this.version,apiKey:this.apiKey,channel:this.channel,client:this.client,id:this.id,libraries:this.libraries,language:this.language,region:this.region,mapIds:this.mapIds,nonce:this.nonce,url:this.url,authReferrerPolicy:this.authReferrerPolicy}}get status(){return this.errors.length?O.FAILURE:this.done?O.SUCCESS:this.loading?O.LOADING:O.INITIALIZED}get failed(){return this.done&&!this.loading&&this.errors.length>=this.retries+1}createUrl(){let e=this.url;return e+="?callback=__googleMapsCallback",this.apiKey&&(e+=`&key=${this.apiKey}`),this.channel&&(e+=`&channel=${this.channel}`),this.client&&(e+=`&client=${this.client}`),this.libraries.length>0&&(e+=`&libraries=${this.libraries.join(",")}`),this.language&&(e+=`&language=${this.language}`),this.region&&(e+=`&region=${this.region}`),this.version&&(e+=`&v=${this.version}`),this.mapIds&&(e+=`&map_ids=${this.mapIds.join(",")}`),this.authReferrerPolicy&&(e+=`&auth_referrer_policy=${this.authReferrerPolicy}`),e}deleteScript(){const e=document.getElementById(this.id);e&&e.remove()}load(){return this.loadPromise()}loadPromise(){return new Promise((e,t)=>{this.loadCallback(i=>{i?t(i.error):e(window.google)})})}importLibrary(e){return this.execute(),google.maps.importLibrary(e)}loadCallback(e){this.callbacks.push(e),this.execute()}setScript(){var e,t;if(document.getElementById(this.id)){this.callback();return}const i={key:this.apiKey,channel:this.channel,client:this.client,libraries:this.libraries.length&&this.libraries,v:this.version,mapIds:this.mapIds,language:this.language,region:this.region,authReferrerPolicy:this.authReferrerPolicy};Object.keys(i).forEach(a=>!i[a]&&delete i[a]),!((t=(e=window==null?void 0:window.google)===null||e===void 0?void 0:e.maps)===null||t===void 0)&&t.importLibrary||(a=>{let n,d,m,p="The Google Maps JavaScript API",u="google",c="importLibrary",h="__ib__",g=document,s=window;s=s[u]||(s[u]={});const l=s.maps||(s.maps={}),y=new Set,f=new URLSearchParams,w=()=>n||(n=new Promise((b,C)=>ye(this,void 0,void 0,function*(){var _;yield d=g.createElement("script"),d.id=this.id,f.set("libraries",[...y]+"");for(m in a)f.set(m.replace(/[A-Z]/g,L=>"_"+L[0].toLowerCase()),a[m]);f.set("callback",u+".maps."+h),d.src=this.url+"?"+f,l[h]=b,d.onerror=()=>n=C(Error(p+" could not load.")),d.nonce=this.nonce||((_=g.querySelector("script[nonce]"))===null||_===void 0?void 0:_.nonce)||"",g.head.append(d)})));l[c]?console.warn(p+" only loads once. Ignoring:",a):l[c]=(b,...C)=>y.add(b)&&w().then(()=>l[c](b,...C))})(i);const o=this.libraries.map(a=>this.importLibrary(a));o.length||o.push(this.importLibrary("core")),Promise.all(o).then(()=>this.callback(),a=>{const n=new ErrorEvent("error",{error:a});this.loadErrorCallback(n)})}reset(){this.deleteScript(),this.done=!1,this.loading=!1,this.errors=[],this.onerrorEvent=null}resetIfRetryingFailed(){this.failed&&this.reset()}loadErrorCallback(e){if(this.errors.push(e),this.errors.length<=this.retries){const t=this.errors.length*Math.pow(2,this.errors.length);console.error(`Failed to load Google Maps script, retrying in ${t} ms.`),setTimeout(()=>{this.deleteScript(),this.setScript()},t)}else this.onerrorEvent=e,this.callback()}callback(){this.done=!0,this.loading=!1,this.callbacks.forEach(e=>{e(this.onerrorEvent)}),this.callbacks=[]}execute(){if(this.resetIfRetryingFailed(),this.done)this.callback();else{if(window.google&&window.google.maps&&window.google.maps.version){console.warn("Google Maps already loaded outside @googlemaps/js-api-loader.This may result in undesirable behavior as options and script parameters may not match."),this.callback();return}this.loading||(this.loading=!0,this.setScript())}}}function be(r){return class extends r.OverlayView{constructor(e){super(),X(this,"element"),X(this,"opts");const{element:t,...i}=e;this.element=t,this.opts=i,this.opts.map&&this.setMap(this.opts.map)}getPosition(){return this.opts.position?this.opts.position instanceof r.LatLng?this.opts.position:new r.LatLng(this.opts.position):null}getVisible(){if(!this.element)return!1;const e=this.element;return e.style.display!=="none"&&e.style.visibility!=="hidden"&&(e.style.opacity===""||Number(e.style.opacity)>.01)}onAdd(){if(!this.element)return;const e=this.getPanes();e&&e.overlayMouseTarget.appendChild(this.element)}draw(){if(!this.element)return;const e=this.getProjection(),t=e==null?void 0:e.fromLatLngToDivPixel(this.getPosition());if(t){this.element.style.position="absolute";const i=this.element.offsetHeight,o=this.element.offsetWidth;let a,n;switch(this.opts.anchorPoint){case"TOP_CENTER":a=t.x-o/2,n=t.y;break;case"BOTTOM_CENTER":a=t.x-o/2,n=t.y-i;break;case"LEFT_CENTER":a=t.x,n=t.y-i/2;break;case"RIGHT_CENTER":a=t.x-o,n=t.y-i/2;break;case"TOP_LEFT":a=t.x,n=t.y;break;case"TOP_RIGHT":a=t.x-o,n=t.y;break;case"BOTTOM_LEFT":a=t.x,n=t.y-i;break;case"BOTTOM_RIGHT":a=t.x-o,n=t.y-i;break;default:a=t.x-o/2,n=t.y-i/2}this.element.style.left=a+"px",this.element.style.top=n+"px",this.element.style.transform=`translateX(${this.opts.offsetX||0}px) translateY(${this.opts.offsetY||0}px)`,this.opts.zIndex&&(this.element.style.zIndex=this.opts.zIndex.toString())}}onRemove(){this.element&&this.element.remove()}setOptions(e){const{element:t,...i}=e;this.element=t,this.opts=i,this.draw()}}}let ee;const te=["bounds_changed","center_changed","click","dblclick","drag","dragend","dragstart","heading_changed","idle","maptypeid_changed","mousemove","mouseout","mouseover","projection_changed","resize","rightclick","tilesloaded","tilt_changed","zoom_changed"],ke=x({props:{apiPromise:{type:Promise},apiKey:{type:String,default:""},version:{type:String,default:"weekly"},libraries:{type:Array,default:()=>["places"]},region:{type:String,required:!1},language:{type:String,required:!1},backgroundColor:{type:String,required:!1},center:{type:Object,default:()=>({lat:0,lng:0})},clickableIcons:{type:Boolean,required:!1,default:void 0},controlSize:{type:Number,required:!1},disableDefaultUi:{type:Boolean,required:!1,default:void 0},disableDoubleClickZoom:{type:Boolean,required:!1,default:void 0},draggable:{type:Boolean,required:!1,default:void 0},draggableCursor:{type:String,required:!1},draggingCursor:{type:String,required:!1},fullscreenControl:{type:Boolean,required:!1,default:void 0},fullscreenControlPosition:{type:String,required:!1},gestureHandling:{type:String,required:!1},heading:{type:Number,required:!1},keyboardShortcuts:{type:Boolean,required:!1,default:void 0},mapTypeControl:{type:Boolean,required:!1,default:void 0},mapTypeControlOptions:{type:Object,required:!1},mapTypeId:{type:[Number,String],required:!1},mapId:{type:String,required:!1},maxZoom:{type:Number,required:!1},minZoom:{type:Number,required:!1},noClear:{type:Boolean,required:!1,default:void 0},panControl:{type:Boolean,required:!1,default:void 0},panControlPosition:{type:String,required:!1},restriction:{type:Object,required:!1},rotateControl:{type:Boolean,required:!1,default:void 0},rotateControlPosition:{type:String,required:!1},scaleControl:{type:Boolean,required:!1,default:void 0},scaleControlStyle:{type:Number,required:!1},scrollwheel:{type:Boolean,required:!1,default:void 0},streetView:{type:Object,required:!1},streetViewControl:{type:Boolean,required:!1,default:void 0},streetViewControlPosition:{type:String,required:!1},styles:{type:Array,required:!1},tilt:{type:Number,required:!1},zoom:{type:Number,required:!1},zoomControl:{type:Boolean,required:!1,default:void 0},zoomControlPosition:{type:String,required:!1}},emits:te,setup(r,{emit:e}){const t=v(),i=v(!1),o=v(),a=v(),n=v(!1);j(F,o),j(K,a),j(ve,n);const d=()=>{const c={...r};Object.keys(c).forEach(s=>{c[s]===void 0&&delete c[s]});const h=s=>{var l;return s?{position:(l=a.value)==null?void 0:l.ControlPosition[s]}:{}},g={scaleControlOptions:r.scaleControlStyle?{style:r.scaleControlStyle}:{},panControlOptions:h(r.panControlPosition),zoomControlOptions:h(r.zoomControlPosition),rotateControlOptions:h(r.rotateControlPosition),streetViewControlOptions:h(r.streetViewControlPosition),fullscreenControlOptions:h(r.fullscreenControlPosition),disableDefaultUI:r.disableDefaultUi};return{...c,...g}},m=M([a,o],([c,h])=>{const g=c,s=h;g&&s&&(g.event.addListenerOnce(s,"tilesloaded",()=>{n.value=!0}),setTimeout(m,0))},{immediate:!0}),p=()=>{try{const{apiKey:c,region:h,version:g,language:s,libraries:l}=r;ee=new S({apiKey:c,region:h,version:g,language:s,libraries:l})}catch(c){console.error(c)}},u=c=>{a.value=P(c.maps),o.value=P(new c.maps.Map(t.value,d()));const h=be(a.value);a.value[B]=h,te.forEach(s=>{var l;(l=o.value)==null||l.addListener(s,y=>e(s,y))}),i.value=!0;const g=Object.keys(r).filter(s=>!["apiPromise","apiKey","version","libraries","region","language","center","zoom"].includes(s)).map(s=>G(r,s));M([()=>r.center,()=>r.zoom,...g],([s,l],[y,f])=>{var w,b,C;const{center:_,zoom:L,...D}=d();(w=o.value)==null||w.setOptions(D),l!==void 0&&l!==f&&((b=o.value)==null||b.setZoom(l));const ce=!y||s.lng!==y.lng||s.lat!==y.lat;s&&ce&&((C=o.value)==null||C.panTo(s))})};return ie(()=>{r.apiPromise&&r.apiPromise instanceof Promise?r.apiPromise.then(u):(p(),ee.load().then(u))}),U(()=>{var c;n.value=!1,o.value&&((c=a.value)==null||c.event.clearInstanceListeners(o.value))}),{mapRef:t,ready:i,map:o,api:a,mapTilesLoaded:n}}}),Z=(r,e)=>{const t=r.__vccOpts||r;for(const[i,o]of e)t[i]=o;return t},we={ref:"mapRef",class:"mapdiv"};function Ce(r,e,t,i,o,a){return k(),E("div",null,[q("div",we,null,512),V(r.$slots,"default",ue(de({ready:r.ready,map:r.map,api:r.api,mapTilesLoaded:r.mapTilesLoaded})),void 0,!0)])}const _e=Z(ke,[["render",Ce],["__scopeId","data-v-174b771e"]]);function Se(r){return r&&r.__esModule&&Object.prototype.hasOwnProperty.call(r,"default")?r.default:r}var Oe=function r(e,t){if(e===t)return!0;if(e&&t&&typeof e=="object"&&typeof t=="object"){if(e.constructor!==t.constructor)return!1;var i,o,a;if(Array.isArray(e)){if(i=e.length,i!=t.length)return!1;for(o=i;o--!==0;)if(!r(e[o],t[o]))return!1;return!0}if(e.constructor===RegExp)return e.source===t.source&&e.flags===t.flags;if(e.valueOf!==Object.prototype.valueOf)return e.valueOf()===t.valueOf();if(e.toString!==Object.prototype.toString)return e.toString()===t.toString();if(a=Object.keys(e),i=a.length,i!==Object.keys(t).length)return!1;for(o=i;o--!==0;)if(!Object.prototype.hasOwnProperty.call(t,a[o]))return!1;for(o=i;o--!==0;){var n=a[o];if(!r(e[n],t[n]))return!1}return!0}return e!==e&&t!==t};const le=Se(Oe),Ie=r=>r==="Marker",Pe=r=>r===B,W=(r,e,t,i)=>{const o=v(),a=I(F,v()),n=I(K,v()),d=I(ge,v()),m=R(()=>!!(d.value&&n.value&&(o.value instanceof n.value.Marker||o.value instanceof n.value[B])));return M([a,t],(p,[u,c])=>{var h,g,s;const l=!le(t.value,c)||a.value!==u;!a.value||!n.value||!l||(o.value?(o.value.setOptions(t.value),m.value&&((h=d.value)==null||h.removeMarker(o.value),(g=d.value)==null||g.addMarker(o.value))):(Ie(r)?o.value=P(new n.value[r](t.value)):Pe(r)?o.value=P(new n.value[r](t.value)):o.value=P(new n.value[r]({...t.value,map:a.value})),m.value?(s=d.value)==null||s.addMarker(o.value):o.value.setMap(a.value),e.forEach(y=>{var f;(f=o.value)==null||f.addListener(y,w=>i(y,w))})))},{immediate:!0}),U(()=>{var p,u;o.value&&((p=n.value)==null||p.event.clearInstanceListeners(o.value),m.value?(u=d.value)==null||u.removeMarker(o.value):o.value.setMap(null))}),o},re=["animation_changed","click","dblclick","rightclick","dragstart","dragend","drag","mouseover","mousedown","mouseout","mouseup","draggable_changed","clickable_changed","contextmenu","cursor_changed","flat_changed","rightclick","zindex_changed","icon_changed","position_changed","shape_changed","title_changed","visible_changed"],Ee=x({name:"Marker",props:{options:{type:Object,required:!0}},emits:re,setup(r,{emit:e,expose:t,slots:i}){const o=G(r,"options"),a=W("Marker",re,o,e);return j(se,a),t({marker:a}),()=>{var n;return(n=i.default)==null?void 0:n.call(i)}}}),Le=x({name:"Polyline",props:{options:{type:Object,required:!0}},emits:N,setup(r,{emit:e}){const t=G(r,"options");return{polyline:W("Polyline",N,t,e)}},render:()=>null});N.concat(["bounds_changed"]);N.concat(["center_changed","radius_changed"]);const oe=["closeclick","content_changed","domready","position_changed","visible","zindex_changed"],Me=x({inheritAttrs:!1,props:{options:{type:Object,default:()=>({})},modelValue:{type:Boolean}},emits:[...oe,"update:modelValue"],setup(r,{slots:e,emit:t,expose:i}){const o=v(),a=v(),n=I(F,v()),d=I(K,v()),m=I(se,v());let p,u=r.modelValue;const c=R(()=>{var l;return(l=e.default)==null?void 0:l.call(e).some(y=>y.type!==ae)}),h=l=>{u=l,t("update:modelValue",l)},g=l=>{o.value&&(o.value.open({map:n.value,anchor:m.value,...l}),h(!0))},s=()=>{o.value&&(o.value.close(),h(!1))};return ie(()=>{M([n,()=>r.options],([l,y],[f,w])=>{var b;const C=!le(y,w)||n.value!==f;n.value&&d.value&&C&&(o.value?(o.value.setOptions({...y,content:c.value?a.value:y.content}),m.value||g()):(o.value=P(new d.value.InfoWindow({...y,content:c.value?a.value:y.content})),m.value&&(p=m.value.addListener("click",()=>{g()})),(!m.value||u)&&g(),oe.forEach(_=>{var L;(L=o.value)==null||L.addListener(_,D=>t(_,D))}),(b=o.value)==null||b.addListener("closeclick",()=>h(!1))))},{immediate:!0}),M(()=>r.modelValue,l=>{l!==u&&(l?g():s())})}),U(()=>{var l;p&&p.remove(),o.value&&((l=d.value)==null||l.event.clearInstanceListeners(o.value),s())}),i({infoWindow:o,open:g,close:s}),{infoWindow:o,infoWindowRef:a,hasSlotContent:c,open:g,close:s}}}),qe={key:0,class:"info-window-wrapper"};function xe(r,e,t,i,o,a){return r.hasSlotContent?(k(),E("div",qe,[q("div",ne({ref:"infoWindowRef"},r.$attrs),[V(r.$slots,"default",{},void 0,!0)],16)])):T("",!0)}const je=Z(Me,[["render",xe],["__scopeId","data-v-90174664"]]);var $;(function(r){r.CLUSTERING_BEGIN="clusteringbegin",r.CLUSTERING_END="clusteringend",r.CLUSTER_CLICK="click"})($||($={}));Object.values($);const Re=x({inheritAttrs:!1,props:{options:{type:Object,required:!0}},setup(r,{slots:e,emit:t,expose:i}){const o=v(),a=R(()=>{var m;return(m=e.default)==null?void 0:m.call(e).some(p=>p.type!==ae)}),n=R(()=>({...r.options,element:o.value})),d=W(B,[],n,t);return i({customMarker:d}),{customMarkerRef:o,customMarker:d,hasSlotContent:a}}}),Te={key:0,class:"custom-marker-wrapper"};function Ne(r,e,t,i,o,a){return r.hasSlotContent?(k(),E("div",Te,[q("div",ne({ref:"customMarkerRef",style:{cursor:r.$attrs.onClick?"pointer":void 0}},r.$attrs),[V(r.$slots,"default",{},void 0,!0)],16)])):T("",!0)}const Be=Z(Re,[["render",Ne],["__scopeId","data-v-2d2d343a"]]),De={components:{GoogleMap:_e,Marker:Ee,Polyline:Le,InfoWindow:je,CustomMarker:Be},name:"Map",emits:["click-marker","update-marker"],setup(r,{emit:e}){console.log(r.waypoints);const t=v(null),i=v(null),o=v(null),a=v("Driving"),n=v(14);v([]);const d=v([]),m=v({}),p=v({}),u=v({}),c=(s,l)=>{o.value=!0,h(s,l)},h=async(s,l)=>{u.value=l,e("click-marker",r.waypoints[l],l,JSON.parse(JSON.stringify(s)))};return{checkMarker:h,enableDrag:c,updateMarker:async(s,l)=>{h(s,l)},reload:t,render:i,showDrag:o,travelMode:a,origin:{lat:0,lng:0},destination:{lat:0,lng:0},zoom:n,markers:r.waypoints,polylineCoordinates:d,activeMarkerIndex:u,directionPoints:m,activeDestination:p}},props:["path","lang","setting","conf","auth","waypoints","showroute","center"]},ze={class:"w-full overflow-auto",style:{height:"85vh","z-index":"9999"}},Ae={style:{"text-align":"center"}},$e=["src"];function Ge(r,e,t,i,o,a){const n=z("CustomMarker"),d=z("Marker"),m=z("GoogleMap");return k(),E("div",ze,[(k(),A(m,{"api-key":t.setting.google_map_api,ref:"gmap",center:t.center,key:i.reload,options:{zoomControl:!0,mapTypeControl:!0,scaleControl:!0,streetViewControl:!0,rotateControl:!0,fullscreenControl:!0},zoom:i.zoom,style:{width:"100%",height:"calc(100vh -  100px)"}},{default:H(()=>[i.showDrag?T("",!0):(k(!0),E(J,{key:0},Y(t.waypoints,(p,u)=>(k(),A(n,{options:{draggable:!0,position:p.destination},key:i.showDrag,draggable:!0,onClick:c=>i.enableDrag(p,u)},{default:H(()=>[q("div",Ae,[q("img",{src:p.icon,width:"40",class:"rouned-full",height:"40",style:{"margin-top":"8px"}},null,8,$e)])]),_:2},1032,["options","onClick"]))),128)),i.showDrag?(k(!0),E(J,{key:1},Y(t.waypoints,(p,u)=>(k(),A(d,{options:{position:p.destination,draggable:!0},key:i.showDrag,draggable:!0,onClick:c=>i.checkMarker(p,u),onDrag:c=>i.activeMarkerIndex=u,onDragend:c=>i.updateMarker(p,u)},null,8,["options","onClick","onDrag","onDragend"]))),128)):T("",!0)]),_:1},8,["api-key","center","zoom"]))])}const Ve=pe(De,[["render",Ge]]);export{Ve as default};
