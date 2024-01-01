import{_ as I,f as j,s as k,q as g,r as v,o as l,c as i,a as t,t as a,b as m,k as w,d as _,n as h,F as C,i as S,j as z,l as D}from"./index-OKa2ORMT.js";import{h as F}from"./help-_WQAsLHo.js";import A from"./trip_map-Un37qSHJ.js";import"./index.es-ZH0-KlMc.js";const B={components:{dashboard_card_white:j,help_icon:F,trip_map:A,translate:k},setup(o){const r=o.conf.url+o.path+"?load=json",s=g({});g({}),g({}),s.value=o.trip;const e=()=>{s.value.locations=[u(s.value.vehicle,s.value.route,"car.svg")];let c,n;for(let d=0;d<s.value.pickup_locations.length;d++)c=s.value.pickup_locations[d].time?"yellow_pin.gif":"blue_pin.gif",n=s.value.destinations[d].time?"yellow_pin.gif":"blue_pin.gif",s.value.locations.push(u(s.value.pickup_locations[d],s.value.destinations[d],c)),s.value.locations.push(u(s.value.destinations[d],s.value.pickup_locations[d],n));s.value.locations.push(u(s.value.route,s.value.vehicle,"destination.svg"))},f=g("info"),y=g(!0),p=()=>{limitCount.value+=5,limitCount.value>s.value.last_trips.length&&(y.value=!1)},x=c=>{console.log(c),f.value=c};x("info");const u=(c,n,d)=>{let b={};return b.icon=o.conf.url+"uploads/images/"+d,b.origin={lat:parseFloat(c.latitude),lng:parseFloat(c.longitude)},b.destination={lat:parseFloat(n.latitude),lng:parseFloat(n.longitude)},b.drag=!1,b};return{url:r,activeItem:s,setActiveStatus:x,loadmore:p,handlePickup:u,setLocations:e,translate:k}},props:["path","lang","setting","conf","auth","trip"]},L={class:"w-full"},N={key:0,class:"grid xl:grid-cols-12 lg:grid-cols-12 grid-cols-1 gap-6"},P={class:"xl:col-span-3 lg:col-span-5"},T={class:"card px-4 py-6 mb-6"},V={key:0,class:"text-center"},M=["textContent"],R=["textContent"],q=t("hr",{class:"mt-5 dark:border-gray-600"},null,-1),E={class:"text-start mt-6 text-sm"},K={class:"space-y-7"},W={class:"text-zinc-400 dark:text-gray-400 flex gap-4"},G=["textContent"],H=["textContent"],J={class:"text-zinc-400 dark:text-gray-400 flex gap-4"},O=["textContent"],Q=["textContent"],U={class:"text-zinc-400 dark:text-gray-400 flex gap-4"},X=["textContent"],Y=["textContent"],Z={class:"text-zinc-400 dark:text-gray-400 flex gap-4"},$=["textContent"],tt=["textContent"],et=t("hr",{class:"my-5 dark:border-gray-600"},null,-1),st={class:"xl:col-span-9 lg:col-span-7"},at={class:"card"},nt={class:"p-6"},ot={class:"lg:flex items-center justify-around rounded-xl space-x-3 bg-gray-100 p-2 dark:bg-gray-900/30","aria-label":"Tabs",role:"tablist"},lt=["textContent"],it=["textContent"],rt=["textContent"],ct=["textContent"],dt={class:"mt-3 overflow-hidden"},ut={key:0,class:"grid grid-cols-1 lg:grid-cols-2 gap-6 w-full border-b border-gray-100"},_t={class:"w-full relative"},ht={class:"dark:border-border-dark dark:border-dashed border border-border-light border-dashed p-4 flex flex-col gap-5"},bt={class:"flex items-start justify-between"},gt={class:"border border-1 grid p-3 rounded-full sm:p-2 place-content-center"},mt=["textContent"],xt={class:"flex flex-col gap-2"},vt=["textContent"],pt=["textContent"],ft=["textContent"],yt={key:1,class:"w-full border-b border-gray-100"},kt={class:"mt-6 w-full"},wt={class:"grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6 mb-6"},Ct={key:2,class:"w-full border-b border-gray-100"},St={class:"md:text-start lg:flex mb-5 mt-5"},It={class:"w-full"},jt=["textContent"],zt=["textContent"],Dt={class:"w-full"},Ft=["textContent"],At=["textContent"],Bt={class:"w-full"},Lt=["textContent"],Nt=["textContent"],Pt={class:"text-start"},Tt={class:"absolute start-7 mt-6"},Vt={class:"relative"},Mt={class:"w-9 h-9 flex justify-center items-center rounded-full bg-white text-info dark:bg-gray-800"},Rt=["src"],qt=t("div",{class:"absolute top-4 -end-6 w-12 h-[2px] bg-gray-400 -z-10"},null,-1),Et={class:"grid grid-cols-1"},Kt={class:"md:col-start-1 col-span-2"},Wt={class:"flex md:flex-nowrap items-center gap-6 ms-10 md:mt-0 mt-5"},Gt={class:"ms-10"},Ht=["textContent"],Jt={class:"relative me-5 md:ps-0 ps-10 overflow-auto"},Ot={class:"pt-3"},Qt=["textContent"],Ut=["textContent"],Xt={key:0,class:"text-center"};function Yt(o,r,s,e,f,y){const p=v("close_icon"),x=v("help_icon"),u=v("dashboard_card_white"),c=v("trip_map");return l(),i("div",L,[!o.showLoader&&s.trip?(l(),i("div",N,[t("div",P,[t("div",T,[e.activeItem&&e.activeItem.driver?(l(),i("div",V,[t("h4",{class:"mb-1 mt-3 text-lg dark:text-gray-300",textContent:a(e.translate("Trip")+e.translate(" #")+e.activeItem.trip_id)},null,8,M),t("button",{type:"button",onClick:r[0]||(r[0]=(...n)=>o.close&&o.close(...n)),class:"hover:bg-primary mb-3 px-6 py-2 flex text-danger"},[m(p),w(),t("span",{textContent:a(e.translate("Back"))},null,8,R)])])):_("",!0),q,t("div",E,[t("div",K,[t("p",W,[t("strong",{textContent:a(e.translate("Duration"))},null,8,G),t("span",{class:"ms-2",textContent:a(e.activeItem.duration)},null,8,H)]),t("p",J,[t("strong",{textContent:a(e.translate("Pickup locations"))},null,8,O),w(),t("span",{class:"ms-2",textContent:a(e.activeItem.pickup_locations_count)},null,8,Q)]),t("p",U,[t("strong",{textContent:a(e.translate("Route"))},null,8,X),t("span",{class:"ms-2",textContent:a(e.activeItem.route?e.activeItem.route.route_name:"")},null,8,Y)]),t("p",Z,[t("strong",{textContent:a(e.translate("Driver"))},null,8,$),t("span",{class:"ms-2",textContent:a(e.activeItem.driver_name)},null,8,tt)])])]),et])]),t("div",st,[t("div",at,[t("div",nt,[(l(),i("div",{class:"w-full",key:o.activeStatus},[t("nav",ot,[t("button",{onClick:r[1]||(r[1]=n=>e.setActiveStatus("info")),type:"button",textContent:a(e.translate("Info")),class:h([o.activeStatus=="info"?"menu-dark text-white font-semibold":"text-gray-500","hover:bg-white hover:text-blue-800 hs-tab-active:font-semibold hs-tab-active:bg-white dark:hs-tab-active:bg-gray-700 w-full flex justify-center py-2 rounded items-center gap-2 border-b-2 border-transparent -mb-px transition-all text-sm whitespace-nowrap dark:text-white active"])},null,10,lt),t("button",{onClick:r[2]||(r[2]=n=>e.setActiveStatus("pickup_locations")),type:"button",textContent:a(e.translate("Pickup locations")),class:h([o.activeStatus=="pickup_locations"?"menu-dark text-white font-semibold":"text-gray-500","hover:bg-white hover:text-blue-800 hs-tab-active:font-semibold hs-tab-active:bg-white dark:hs-tab-active:bg-gray-700 w-full flex justify-center py-2 rounded items-center gap-2 border-b-2 border-transparent -mb-px transition-all text-sm whitespace-nowrap dark:text-white"])},null,10,it),t("button",{type:"button",onClick:r[3]||(r[3]=n=>e.setActiveStatus("map")),class:h([o.activeStatus=="map"?"menu-dark text-white font-semibold":"text-gray-500","hover:bg-white hover:text-blue-800 hs-tab-active:font-semibold hs-tab-active:bg-white dark:hs-tab-active:bg-gray-700 w-full flex justify-center py-2 rounded items-center gap-2 border-b-2 border-transparent -mb-px transition-all text-sm whitespace-nowrap dark:text-white"]),textContent:a(e.translate("Map"))},null,10,rt),t("button",{onClick:r[4]||(r[4]=n=>e.setActiveStatus("reviews")),type:"button",textContent:a(e.translate("Reviews")),class:h([o.activeStatus=="reviews"?"menu-dark text-white font-semibold":"text-gray-500","hover:bg-white hover:text-blue-800 hs-tab-active:font-semibold hs-tab-active:bg-white dark:hs-tab-active:bg-gray-700 w-full flex justify-center py-2 rounded items-center gap-2 border-b-2 border-transparent -mb-px transition-all text-sm whitespace-nowrap dark:text-white"])},null,10,ct)]),t("div",dt,[(l(),i("div",{key:o.activeStatus,id:"basic-tabs-1",class:"transition-all duration-300 transform"},[o.activeStatus=="help_messages"?(l(),i("div",ut,[(l(!0),i(C,null,S(e.activeItem.help_messages,n=>(l(),i("div",_t,[t("div",ht,[t("div",bt,[t("span",gt,[m(x,{class:"text-primary w-10 h-10"})]),t("span",{class:"text-content3 text-2xs text-muted p-3",textContent:a(n.date)},null,8,mt)]),t("div",xt,[t("div",null,[t("p",{class:"text-title text-sm font-semibold mb-1 dark:text-white",textContent:a(n.subject)},null,8,vt),t("p",{class:"text-content3 text-2xs truncate",textContent:a(n.message)},null,8,pt)]),t("div",{class:h([e.translate("lang")=="ar"?"left-0":"right-0","absolute flex items-center justify-between gap-1"])},[t("span",{class:"bg-blue-50 px-4 py-1 text-secondary badge-sm rounded-5",textContent:a(n.status)},null,8,ft)],2)])])]))),256))])):_("",!0),o.activeStatus=="info"?(l(),i("div",yt,[t("div",kt,[t("div",wt,[m(u,{icon:"/uploads/img/products_icome.png",classes:"bg-gradient-success",class:"border border-1",title:e.translate("Duration"),value:e.activeItem.duration?e.activeItem.duration:"0"},null,8,["title","value"]),m(u,{icon:"/uploads/img/products_icome.png",classes:"bg-gradient-info",class:"border border-1",title:e.translate("Pickup locations"),value:e.activeItem.pickup_locations_count},null,8,["title","value"]),m(u,{icon:"/uploads/img/products_icome.png",classes:"bg-gradient-danger",class:"border border-1",title:e.translate("Distance"),value:e.activeItem.distance},null,8,["title","value"])])])])):_("",!0),o.activeStatus=="pickup_locations"&&s.trip?(l(),i("div",Ct,[t("div",{class:h([e.translate("lang")=="ar"?"right-4":"left-4","absolute border-s-2 border border-gray-300 h-full top-20 start-10 -z-10 dark:border-white/10"])},null,2),t("div",St,[t("div",It,[t("h5",{class:"font-semibold bg-white dark:bg-gray-700 dark:text-gray-300 inline rounded",textContent:a(e.translate("Trip number")+" #"+s.trip.trip_id)},null,8,jt),t("p",{class:"text-muted text-sm",textContent:a(s.trip.trip_date)},null,8,zt)]),t("div",Dt,[t("h5",{class:"font-semibold bg-white dark:bg-gray-700 dark:text-gray-300 inline rounded",textContent:a(s.trip.duration)},null,8,Ft),t("p",{class:"text-muted text-sm",textContent:a(e.translate("Duration"))},null,8,At)]),t("div",Bt,[t("h5",{class:"font-semibold bg-white dark:bg-gray-700 dark:text-gray-300 inline rounded",textContent:a(s.trip.distance+" KM")},null,8,Lt),t("p",{class:"text-muted text-sm",textContent:a(e.translate("Distance"))},null,8,Nt)])]),(l(!0),i(C,null,S(s.trip.pickup_locations,n=>(l(),i("div",{class:"space-y-4",key:s.trip},[t("div",Pt,[t("div",Tt,[t("div",Vt,[t("div",Mt,[n.model?(l(),i("img",{key:0,src:"/app/image.php?w=100&h=100&src="+n.model.picture,class:"rounded-full",alt:""},null,8,Rt)):_("",!0)]),qt])]),t("div",Et,[t("div",Kt,[t("div",Wt,[t("div",Gt,[t("h2",{class:h([e.translate("lang")=="ar"?"bg-gradient-to-l":"bg-gradient-to-r","font-semibold p-2 rounded text-primary flex items-center justify-center text-sm mx-16"]),textContent:a(n.boarding_time?n.time:e.translate("Waiting"))},null,10,Ht)]),t("div",Jt,[t("div",Ot,[n.model?(l(),i("h4",{key:0,class:"mb-1.5 text-base dark:text-gray-300",textContent:a(n.model.name)},null,8,Qt)):_("",!0),n.location?(l(),i("p",{key:1,style:D([{"white-space":"nowrap"},{"white-space":"nowrap"}]),class:"mb-4 text-gray-500 dark:text-gray-400",textContent:a(n.location.address)},null,8,Ut)):_("",!0)])])])])])])]))),128))])):_("",!0)]))])]))])]),o.activeStatus=="map"?(l(),i("p",Xt,[(l(),z(c,{key:s.trip,trip:s.trip,conf:s.conf,onIntervalCallback:o.callback},null,8,["trip","conf","onIntervalCallback"]))])):_("",!0)])])):_("",!0)])}const se=I(B,[["render",Yt]]);export{se as default};
