import{L as x,Y as G,Z as j,q as v,$ as I,a0 as R,N as E,a1 as P,a2 as U,O as re,o as C,c as L,a as q,R as V,a3 as le,a4 as ce,a5 as oe,m as ie,d as T,_ as ue,r as D,j as A,u as W,F as de,i as pe}from"./index-nd9VVSjE.js";(function(){try{if(typeof document<"u"){var t=document.createElement("style");t.appendChild(document.createTextNode(".mapdiv[data-v-174b771e]{width:100%;height:100%}.info-window-wrapper[data-v-90174664]{display:none}.mapdiv .info-window-wrapper[data-v-90174664]{display:inline-block}.custom-marker-wrapper[data-v-2d2d343a]{display:none}.mapdiv .custom-marker-wrapper[data-v-2d2d343a]{display:inline-block}")),document.head.appendChild(t)}}catch(e){console.error("vite-plugin-css-injected-by-js",e)}})();var he=Object.defineProperty,me=(t,e,r)=>e in t?he(t,e,{enumerable:!0,configurable:!0,writable:!0,value:r}):t[e]=r,H=(t,e,r)=>(me(t,typeof e!="symbol"?e+"":e,r),r);const F=Symbol("map"),K=Symbol("api"),ae=Symbol("marker"),ge=Symbol("markerCluster"),B=Symbol("CustomMarker"),ve=Symbol("mapTilesLoaded"),N=["click","dblclick","drag","dragend","dragstart","mousedown","mousemove","mouseout","mouseover","mouseup","rightclick"];/*! *****************************************************************************
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
***************************************************************************** */function ye(t,e,r,i){function o(a){return a instanceof r?a:new r(function(n){n(a)})}return new(r||(r=Promise))(function(a,n){function p(h){try{d(i.next(h))}catch(l){n(l)}}function g(h){try{d(i.throw(h))}catch(l){n(l)}}function d(h){h.done?a(h.value):o(h.value).then(p,g)}d((i=i.apply(t,e||[])).next())})}var fe=function t(e,r){if(e===r)return!0;if(e&&r&&typeof e=="object"&&typeof r=="object"){if(e.constructor!==r.constructor)return!1;var i,o,a;if(Array.isArray(e)){if(i=e.length,i!=r.length)return!1;for(o=i;o--!==0;)if(!t(e[o],r[o]))return!1;return!0}if(e.constructor===RegExp)return e.source===r.source&&e.flags===r.flags;if(e.valueOf!==Object.prototype.valueOf)return e.valueOf()===r.valueOf();if(e.toString!==Object.prototype.toString)return e.toString()===r.toString();if(a=Object.keys(e),i=a.length,i!==Object.keys(r).length)return!1;for(o=i;o--!==0;)if(!Object.prototype.hasOwnProperty.call(r,a[o]))return!1;for(o=i;o--!==0;){var n=a[o];if(!t(e[n],r[n]))return!1}return!0}return e!==e&&r!==r};const Y="__googleMapsScriptId";var _;(function(t){t[t.INITIALIZED=0]="INITIALIZED",t[t.LOADING=1]="LOADING",t[t.SUCCESS=2]="SUCCESS",t[t.FAILURE=3]="FAILURE"})(_||(_={}));class O{constructor({apiKey:e,authReferrerPolicy:r,channel:i,client:o,id:a=Y,language:n,libraries:p=[],mapIds:g,nonce:d,region:h,retries:l=3,url:m="https://maps.googleapis.com/maps/api/js",version:u}){if(this.callbacks=[],this.done=!1,this.loading=!1,this.errors=[],this.apiKey=e,this.authReferrerPolicy=r,this.channel=i,this.client=o,this.id=a||Y,this.language=n,this.libraries=p,this.mapIds=g,this.nonce=d,this.region=h,this.retries=l,this.url=m,this.version=u,O.instance){if(!fe(this.options,O.instance.options))throw new Error(`Loader must not be called again with different options. ${JSON.stringify(this.options)} !== ${JSON.stringify(O.instance.options)}`);return O.instance}O.instance=this}get options(){return{version:this.version,apiKey:this.apiKey,channel:this.channel,client:this.client,id:this.id,libraries:this.libraries,language:this.language,region:this.region,mapIds:this.mapIds,nonce:this.nonce,url:this.url,authReferrerPolicy:this.authReferrerPolicy}}get status(){return this.errors.length?_.FAILURE:this.done?_.SUCCESS:this.loading?_.LOADING:_.INITIALIZED}get failed(){return this.done&&!this.loading&&this.errors.length>=this.retries+1}createUrl(){let e=this.url;return e+="?callback=__googleMapsCallback",this.apiKey&&(e+=`&key=${this.apiKey}`),this.channel&&(e+=`&channel=${this.channel}`),this.client&&(e+=`&client=${this.client}`),this.libraries.length>0&&(e+=`&libraries=${this.libraries.join(",")}`),this.language&&(e+=`&language=${this.language}`),this.region&&(e+=`&region=${this.region}`),this.version&&(e+=`&v=${this.version}`),this.mapIds&&(e+=`&map_ids=${this.mapIds.join(",")}`),this.authReferrerPolicy&&(e+=`&auth_referrer_policy=${this.authReferrerPolicy}`),e}deleteScript(){const e=document.getElementById(this.id);e&&e.remove()}load(){return this.loadPromise()}loadPromise(){return new Promise((e,r)=>{this.loadCallback(i=>{i?r(i.error):e(window.google)})})}importLibrary(e){return this.execute(),google.maps.importLibrary(e)}loadCallback(e){this.callbacks.push(e),this.execute()}setScript(){var e,r;if(document.getElementById(this.id)){this.callback();return}const i={key:this.apiKey,channel:this.channel,client:this.client,libraries:this.libraries.length&&this.libraries,v:this.version,mapIds:this.mapIds,language:this.language,region:this.region,authReferrerPolicy:this.authReferrerPolicy};Object.keys(i).forEach(a=>!i[a]&&delete i[a]),!((r=(e=window==null?void 0:window.google)===null||e===void 0?void 0:e.maps)===null||r===void 0)&&r.importLibrary||(a=>{let n,p,g,d="The Google Maps JavaScript API",h="google",l="importLibrary",m="__ib__",u=document,s=window;s=s[h]||(s[h]={});const c=s.maps||(s.maps={}),y=new Set,f=new URLSearchParams,k=()=>n||(n=new Promise((b,w)=>ye(this,void 0,void 0,function*(){var S;yield p=u.createElement("script"),p.id=this.id,f.set("libraries",[...y]+"");for(g in a)f.set(g.replace(/[A-Z]/g,M=>"_"+M[0].toLowerCase()),a[g]);f.set("callback",h+".maps."+m),p.src=this.url+"?"+f,c[m]=b,p.onerror=()=>n=w(Error(d+" could not load.")),p.nonce=this.nonce||((S=u.querySelector("script[nonce]"))===null||S===void 0?void 0:S.nonce)||"",u.head.append(p)})));c[l]?console.warn(d+" only loads once. Ignoring:",a):c[l]=(b,...w)=>y.add(b)&&k().then(()=>c[l](b,...w))})(i);const o=this.libraries.map(a=>this.importLibrary(a));o.length||o.push(this.importLibrary("core")),Promise.all(o).then(()=>this.callback(),a=>{const n=new ErrorEvent("error",{error:a});this.loadErrorCallback(n)})}reset(){this.deleteScript(),this.done=!1,this.loading=!1,this.errors=[],this.onerrorEvent=null}resetIfRetryingFailed(){this.failed&&this.reset()}loadErrorCallback(e){if(this.errors.push(e),this.errors.length<=this.retries){const r=this.errors.length*Math.pow(2,this.errors.length);console.error(`Failed to load Google Maps script, retrying in ${r} ms.`),setTimeout(()=>{this.deleteScript(),this.setScript()},r)}else this.onerrorEvent=e,this.callback()}callback(){this.done=!0,this.loading=!1,this.callbacks.forEach(e=>{e(this.onerrorEvent)}),this.callbacks=[]}execute(){if(this.resetIfRetryingFailed(),this.done)this.callback();else{if(window.google&&window.google.maps&&window.google.maps.version){console.warn("Google Maps already loaded outside @googlemaps/js-api-loader.This may result in undesirable behavior as options and script parameters may not match."),this.callback();return}this.loading||(this.loading=!0,this.setScript())}}}function be(t){return class extends t.OverlayView{constructor(e){super(),H(this,"element"),H(this,"opts");const{element:r,...i}=e;this.element=r,this.opts=i,this.opts.map&&this.setMap(this.opts.map)}getPosition(){return this.opts.position?this.opts.position instanceof t.LatLng?this.opts.position:new t.LatLng(this.opts.position):null}getVisible(){if(!this.element)return!1;const e=this.element;return e.style.display!=="none"&&e.style.visibility!=="hidden"&&(e.style.opacity===""||Number(e.style.opacity)>.01)}onAdd(){if(!this.element)return;const e=this.getPanes();e&&e.overlayMouseTarget.appendChild(this.element)}draw(){if(!this.element)return;const e=this.getProjection(),r=e==null?void 0:e.fromLatLngToDivPixel(this.getPosition());if(r){this.element.style.position="absolute";const i=this.element.offsetHeight,o=this.element.offsetWidth;let a,n;switch(this.opts.anchorPoint){case"TOP_CENTER":a=r.x-o/2,n=r.y;break;case"BOTTOM_CENTER":a=r.x-o/2,n=r.y-i;break;case"LEFT_CENTER":a=r.x,n=r.y-i/2;break;case"RIGHT_CENTER":a=r.x-o,n=r.y-i/2;break;case"TOP_LEFT":a=r.x,n=r.y;break;case"TOP_RIGHT":a=r.x-o,n=r.y;break;case"BOTTOM_LEFT":a=r.x,n=r.y-i;break;case"BOTTOM_RIGHT":a=r.x-o,n=r.y-i;break;default:a=r.x-o/2,n=r.y-i/2}this.element.style.left=a+"px",this.element.style.top=n+"px",this.element.style.transform=`translateX(${this.opts.offsetX||0}px) translateY(${this.opts.offsetY||0}px)`,this.opts.zIndex&&(this.element.style.zIndex=this.opts.zIndex.toString())}}onRemove(){this.element&&this.element.remove()}setOptions(e){const{element:r,...i}=e;this.element=r,this.opts=i,this.draw()}}}let X;const Q=["bounds_changed","center_changed","click","dblclick","drag","dragend","dragstart","heading_changed","idle","maptypeid_changed","mousemove","mouseout","mouseover","projection_changed","resize","rightclick","tilesloaded","tilt_changed","zoom_changed"],ke=x({props:{apiPromise:{type:Promise},apiKey:{type:String,default:""},version:{type:String,default:"weekly"},libraries:{type:Array,default:()=>["places"]},region:{type:String,required:!1},language:{type:String,required:!1},backgroundColor:{type:String,required:!1},center:{type:Object,default:()=>({lat:0,lng:0})},clickableIcons:{type:Boolean,required:!1,default:void 0},controlSize:{type:Number,required:!1},disableDefaultUi:{type:Boolean,required:!1,default:void 0},disableDoubleClickZoom:{type:Boolean,required:!1,default:void 0},draggable:{type:Boolean,required:!1,default:void 0},draggableCursor:{type:String,required:!1},draggingCursor:{type:String,required:!1},fullscreenControl:{type:Boolean,required:!1,default:void 0},fullscreenControlPosition:{type:String,required:!1},gestureHandling:{type:String,required:!1},heading:{type:Number,required:!1},keyboardShortcuts:{type:Boolean,required:!1,default:void 0},mapTypeControl:{type:Boolean,required:!1,default:void 0},mapTypeControlOptions:{type:Object,required:!1},mapTypeId:{type:[Number,String],required:!1},mapId:{type:String,required:!1},maxZoom:{type:Number,required:!1},minZoom:{type:Number,required:!1},noClear:{type:Boolean,required:!1,default:void 0},panControl:{type:Boolean,required:!1,default:void 0},panControlPosition:{type:String,required:!1},restriction:{type:Object,required:!1},rotateControl:{type:Boolean,required:!1,default:void 0},rotateControlPosition:{type:String,required:!1},scaleControl:{type:Boolean,required:!1,default:void 0},scaleControlStyle:{type:Number,required:!1},scrollwheel:{type:Boolean,required:!1,default:void 0},streetView:{type:Object,required:!1},streetViewControl:{type:Boolean,required:!1,default:void 0},streetViewControlPosition:{type:String,required:!1},styles:{type:Array,required:!1},tilt:{type:Number,required:!1},zoom:{type:Number,required:!1},zoomControl:{type:Boolean,required:!1,default:void 0},zoomControlPosition:{type:String,required:!1}},emits:Q,setup(t,{emit:e}){const r=v(),i=v(!1),o=v(),a=v(),n=v(!1);j(F,o),j(K,a),j(ve,n);const p=()=>{const l={...t};Object.keys(l).forEach(s=>{l[s]===void 0&&delete l[s]});const m=s=>{var c;return s?{position:(c=a.value)==null?void 0:c.ControlPosition[s]}:{}},u={scaleControlOptions:t.scaleControlStyle?{style:t.scaleControlStyle}:{},panControlOptions:m(t.panControlPosition),zoomControlOptions:m(t.zoomControlPosition),rotateControlOptions:m(t.rotateControlPosition),streetViewControlOptions:m(t.streetViewControlPosition),fullscreenControlOptions:m(t.fullscreenControlPosition),disableDefaultUI:t.disableDefaultUi};return{...l,...u}},g=E([a,o],([l,m])=>{const u=l,s=m;u&&s&&(u.event.addListenerOnce(s,"tilesloaded",()=>{n.value=!0}),setTimeout(g,0))},{immediate:!0}),d=()=>{try{const{apiKey:l,region:m,version:u,language:s,libraries:c}=t;X=new O({apiKey:l,region:m,version:u,language:s,libraries:c})}catch(l){console.error(l)}},h=l=>{a.value=P(l.maps),o.value=P(new l.maps.Map(r.value,p()));const m=be(a.value);a.value[B]=m,Q.forEach(s=>{var c;(c=o.value)==null||c.addListener(s,y=>e(s,y))}),i.value=!0;const u=Object.keys(t).filter(s=>!["apiPromise","apiKey","version","libraries","region","language","center","zoom"].includes(s)).map(s=>G(t,s));E([()=>t.center,()=>t.zoom,...u],([s,c],[y,f])=>{var k,b,w;const{center:S,zoom:M,...z}=p();(k=o.value)==null||k.setOptions(z),c!==void 0&&c!==f&&((b=o.value)==null||b.setZoom(c));const se=!y||s.lng!==y.lng||s.lat!==y.lat;s&&se&&((w=o.value)==null||w.panTo(s))})};return re(()=>{t.apiPromise&&t.apiPromise instanceof Promise?t.apiPromise.then(h):(d(),X.load().then(h))}),U(()=>{var l;n.value=!1,o.value&&((l=a.value)==null||l.event.clearInstanceListeners(o.value))}),{mapRef:r,ready:i,map:o,api:a,mapTilesLoaded:n}}}),Z=(t,e)=>{const r=t.__vccOpts||t;for(const[i,o]of e)r[i]=o;return r},we={ref:"mapRef",class:"mapdiv"};function Ce(t,e,r,i,o,a){return C(),L("div",null,[q("div",we,null,512),V(t.$slots,"default",le(ce({ready:t.ready,map:t.map,api:t.api,mapTilesLoaded:t.mapTilesLoaded})),void 0,!0)])}const Se=Z(ke,[["render",Ce],["__scopeId","data-v-174b771e"]]);function Oe(t){return t&&t.__esModule&&Object.prototype.hasOwnProperty.call(t,"default")?t.default:t}var _e=function t(e,r){if(e===r)return!0;if(e&&r&&typeof e=="object"&&typeof r=="object"){if(e.constructor!==r.constructor)return!1;var i,o,a;if(Array.isArray(e)){if(i=e.length,i!=r.length)return!1;for(o=i;o--!==0;)if(!t(e[o],r[o]))return!1;return!0}if(e.constructor===RegExp)return e.source===r.source&&e.flags===r.flags;if(e.valueOf!==Object.prototype.valueOf)return e.valueOf()===r.valueOf();if(e.toString!==Object.prototype.toString)return e.toString()===r.toString();if(a=Object.keys(e),i=a.length,i!==Object.keys(r).length)return!1;for(o=i;o--!==0;)if(!Object.prototype.hasOwnProperty.call(r,a[o]))return!1;for(o=i;o--!==0;){var n=a[o];if(!t(e[n],r[n]))return!1}return!0}return e!==e&&r!==r};const ne=Oe(_e),Ie=t=>t==="Marker",Pe=t=>t===B,J=(t,e,r,i)=>{const o=v(),a=I(F,v()),n=I(K,v()),p=I(ge,v()),g=R(()=>!!(p.value&&n.value&&(o.value instanceof n.value.Marker||o.value instanceof n.value[B])));return E([a,r],(d,[h,l])=>{var m,u,s;const c=!ne(r.value,l)||a.value!==h;!a.value||!n.value||!c||(o.value?(o.value.setOptions(r.value),g.value&&((m=p.value)==null||m.removeMarker(o.value),(u=p.value)==null||u.addMarker(o.value))):(Ie(t)?o.value=P(new n.value[t](r.value)):Pe(t)?o.value=P(new n.value[t](r.value)):o.value=P(new n.value[t]({...r.value,map:a.value})),g.value?(s=p.value)==null||s.addMarker(o.value):o.value.setMap(a.value),e.forEach(y=>{var f;(f=o.value)==null||f.addListener(y,k=>i(y,k))})))},{immediate:!0}),U(()=>{var d,h;o.value&&((d=n.value)==null||d.event.clearInstanceListeners(o.value),g.value?(h=p.value)==null||h.removeMarker(o.value):o.value.setMap(null))}),o},ee=["animation_changed","click","dblclick","rightclick","dragstart","dragend","drag","mouseover","mousedown","mouseout","mouseup","draggable_changed","clickable_changed","contextmenu","cursor_changed","flat_changed","rightclick","zindex_changed","icon_changed","position_changed","shape_changed","title_changed","visible_changed"],Me=x({name:"Marker",props:{options:{type:Object,required:!0}},emits:ee,setup(t,{emit:e,expose:r,slots:i}){const o=G(t,"options"),a=J("Marker",ee,o,e);return j(ae,a),r({marker:a}),()=>{var n;return(n=i.default)==null?void 0:n.call(i)}}}),Ee=x({name:"Polyline",props:{options:{type:Object,required:!0}},emits:N,setup(t,{emit:e}){const r=G(t,"options");return{polyline:J("Polyline",N,r,e)}},render:()=>null});N.concat(["bounds_changed"]);N.concat(["center_changed","radius_changed"]);const te=["closeclick","content_changed","domready","position_changed","visible","zindex_changed"],Le=x({inheritAttrs:!1,props:{options:{type:Object,default:()=>({})},modelValue:{type:Boolean}},emits:[...te,"update:modelValue"],setup(t,{slots:e,emit:r,expose:i}){const o=v(),a=v(),n=I(F,v()),p=I(K,v()),g=I(ae,v());let d,h=t.modelValue;const l=R(()=>{var c;return(c=e.default)==null?void 0:c.call(e).some(y=>y.type!==oe)}),m=c=>{h=c,r("update:modelValue",c)},u=c=>{o.value&&(o.value.open({map:n.value,anchor:g.value,...c}),m(!0))},s=()=>{o.value&&(o.value.close(),m(!1))};return re(()=>{E([n,()=>t.options],([c,y],[f,k])=>{var b;const w=!ne(y,k)||n.value!==f;n.value&&p.value&&w&&(o.value?(o.value.setOptions({...y,content:l.value?a.value:y.content}),g.value||u()):(o.value=P(new p.value.InfoWindow({...y,content:l.value?a.value:y.content})),g.value&&(d=g.value.addListener("click",()=>{u()})),(!g.value||h)&&u(),te.forEach(S=>{var M;(M=o.value)==null||M.addListener(S,z=>r(S,z))}),(b=o.value)==null||b.addListener("closeclick",()=>m(!1))))},{immediate:!0}),E(()=>t.modelValue,c=>{c!==h&&(c?u():s())})}),U(()=>{var c;d&&d.remove(),o.value&&((c=p.value)==null||c.event.clearInstanceListeners(o.value),s())}),i({infoWindow:o,open:u,close:s}),{infoWindow:o,infoWindowRef:a,hasSlotContent:l,open:u,close:s}}}),qe={key:0,class:"info-window-wrapper"};function xe(t,e,r,i,o,a){return t.hasSlotContent?(C(),L("div",qe,[q("div",ie({ref:"infoWindowRef"},t.$attrs),[V(t.$slots,"default",{},void 0,!0)],16)])):T("",!0)}const je=Z(Le,[["render",xe],["__scopeId","data-v-90174664"]]);var $;(function(t){t.CLUSTERING_BEGIN="clusteringbegin",t.CLUSTERING_END="clusteringend",t.CLUSTER_CLICK="click"})($||($={}));Object.values($);const Re=x({inheritAttrs:!1,props:{options:{type:Object,required:!0}},setup(t,{slots:e,emit:r,expose:i}){const o=v(),a=R(()=>{var g;return(g=e.default)==null?void 0:g.call(e).some(d=>d.type!==oe)}),n=R(()=>({...t.options,element:o.value})),p=J(B,[],n,r);return i({customMarker:p}),{customMarkerRef:o,customMarker:p,hasSlotContent:a}}}),Te={key:0,class:"custom-marker-wrapper"};function Ne(t,e,r,i,o,a){return t.hasSlotContent?(C(),L("div",Te,[q("div",ie({ref:"customMarkerRef",style:{cursor:t.$attrs.onClick?"pointer":void 0}},t.$attrs),[V(t.$slots,"default",{},void 0,!0)],16)])):T("",!0)}const Be=Z(Re,[["render",Ne],["__scopeId","data-v-2d2d343a"]]),ze={components:{GoogleMap:Se,Marker:Me,Polyline:Ee,InfoWindow:je,CustomMarker:Be},name:"Map",emits:["click-marker","update-marker"],setup(t,{emit:e}){console.log(t.waypoints);const r=v(null),i=v(null),o=v("Driving"),a=v(14);v([]);const n=v([]),p=v({}),g=v({}),d=v({});return{checkMarker:async(m,u)=>{d.value=u,e("click-marker",t.waypoints[u],u,JSON.parse(JSON.stringify(m)))},updateMarker:async(m,u)=>{d.value=u,e("update-marker",t.waypoints[u],u,JSON.parse(JSON.stringify(m)))},flightPath,reload:r,render:i,travelMode:o,origin:{lat:0,lng:0},destination:{lat:0,lng:0},settings:t.setting,zoom:a,markers:t.waypoints,polylineCoordinates:n,activeMarkerIndex:d,directionPoints:p,activeDestination:g}},props:["path","lang","setting","conf","auth","waypoints","showroute","center"]},De={class:"w-full overflow-auto",style:{height:"85vh","z-index":"9999"}},Ae={style:{"text-align":"center"}},$e=["src"];function Ge(t,e,r,i,o,a){const n=D("CustomMarker"),p=D("Marker"),g=D("GoogleMap");return C(),L("div",De,[(C(),A(g,{"api-key":i.settings.google_map_api,ref:"gmap",center:r.center,key:i.reload,options:{zoomControl:!0,mapTypeControl:!0,scaleControl:!0,streetViewControl:!0,rotateControl:!0,fullscreenControl:!0},zoom:i.zoom,style:{width:"100%",height:"calc(100vh -  100px)"}},{default:W(()=>[t.marker.drag?T("",!0):(C(!0),L(de,{key:0},pe(r.waypoints,(d,h)=>(C(),A(n,{options:{draggable:!0,position:d.destination},key:d,draggable:!0,onClick:l=>i.checkMarker(d,h),onDrag:l=>i.activeMarkerIndex=h,onDragend:i.updateMarker},{default:W(()=>[q("div",Ae,[q("img",{src:d.icon,width:"40",class:"rouned-full",height:"40",style:{"margin-top":"8px"}},null,8,$e)])]),_:2},1032,["options","onClick","onDrag","onDragend"]))),128)),t.marker.drag?(C(),A(p,{options:{position:r.center,draggable:!0},key:t.marker,draggable:!0,onClick:e[0]||(e[0]=d=>i.checkMarker(t.marker,t.index)),onDrag:e[1]||(e[1]=d=>i.activeMarkerIndex=t.index),onDragend:i.updateMarker},null,8,["options","onDragend"])):T("",!0)]),_:1},8,["api-key","center","zoom"]))])}const Ve=ue(ze,[["render",Ge]]);export{Ve as default};
