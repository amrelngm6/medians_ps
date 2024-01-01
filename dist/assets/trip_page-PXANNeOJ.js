import{_ as I,f as j,s as k,q as b,r as v,o,c as l,a as t,t as a,b as g,k as C,d as _,n as x,F as w,i as S,j as z,l as D}from"./index-6wCDJkJU.js";import{h as F}from"./help-P_czhWQL.js";import A from"./trip_map-DKWKw-Vq.js";import"./index.es-MAsGq6SJ.js";const B={components:{dashboard_card_white:j,help_icon:F,trip_map:A,translate:k},setup(u){const i=u.conf.url+u.path+"?load=json",s=b({});b({}),b({}),s.value=u.trip;const e=()=>{s.value.locations=[d(s.value.vehicle,s.value.route,"car.svg")];let r,n;for(let c=0;c<s.value.pickup_locations.length;c++)r=s.value.pickup_locations[c].time?"yellow_pin.gif":"blue_pin.gif",n=s.value.destinations[c].time?"yellow_pin.gif":"blue_pin.gif",s.value.locations.push(d(s.value.pickup_locations[c],s.value.destinations[c],r)),s.value.locations.push(d(s.value.destinations[c],s.value.pickup_locations[c],n));s.value.locations.push(d(s.value.route,s.value.vehicle,"destination.svg"))},p=b("info"),y=b(!0),f=()=>{limitCount.value+=5,limitCount.value>s.value.last_trips.length&&(y.value=!1)},m=r=>{console.log(r),p.value=r};m("info");const d=(r,n,c)=>{let h={};return h.icon=u.conf.url+"uploads/images/"+c,h.origin={lat:parseFloat(r.latitude),lng:parseFloat(r.longitude)},h.destination={lat:parseFloat(n.latitude),lng:parseFloat(n.longitude)},h.drag=!1,h};return{url:i,activeItem:s,activeStatus:p,setActiveStatus:m,loadmore:f,handlePickup:d,setLocations:e,translate:k}},props:["path","lang","setting","conf","auth","trip"]},N={class:"w-full"},P={key:0,class:"grid xl:grid-cols-12 lg:grid-cols-12 grid-cols-1 gap-6"},T={class:"xl:col-span-3 lg:col-span-5"},V={class:"card px-4 py-6 mb-6"},L={key:0,class:"text-center"},M=["textContent"],R=["textContent"],q=t("hr",{class:"mt-5 dark:border-gray-600"},null,-1),E={class:"text-start mt-6 text-sm"},K={class:"space-y-7"},W={class:"text-zinc-400 dark:text-gray-400 flex gap-4"},G=["textContent"],H=["textContent"],J={class:"text-zinc-400 dark:text-gray-400 flex gap-4"},O=["textContent"],Q=["textContent"],U={class:"text-zinc-400 dark:text-gray-400 flex gap-4"},X=["textContent"],Y=["textContent"],Z={class:"text-zinc-400 dark:text-gray-400 flex gap-4"},$=["textContent"],tt=["textContent"],et=["textContent"],st=t("hr",{class:"my-5 dark:border-gray-600"},null,-1),at={class:"xl:col-span-9 lg:col-span-7"},nt={class:"card"},ot={class:"p-6"},lt={class:"lg:flex items-center justify-around rounded-xl space-x-3 bg-gray-100 p-2 dark:bg-gray-900/30","aria-label":"Tabs",role:"tablist"},it=["textContent"],rt=["textContent"],ct=["textContent"],dt=["textContent"],_t={class:"mt-3 overflow-hidden"},ut={key:0,class:"grid grid-cols-1 lg:grid-cols-2 gap-6 w-full border-b border-gray-100"},xt={class:"w-full relative"},ht={class:"dark:border-border-dark dark:border-dashed border border-border-light border-dashed p-4 flex flex-col gap-5"},bt={class:"flex items-start justify-between"},gt={class:"border border-1 grid p-3 rounded-full sm:p-2 place-content-center"},mt=["textContent"],vt={class:"flex flex-col gap-2"},pt=["textContent"],ft=["textContent"],yt=["textContent"],kt={class:"mt-6 w-full"},Ct={class:"grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6 mb-6"},wt={key:2,class:"w-full border-b border-gray-100"},St={class:"md:text-start lg:flex mb-5 mt-5"},It={class:"w-full"},jt=["textContent"],zt=["textContent"],Dt={class:"w-full"},Ft=["textContent"],At=["textContent"],Bt={class:"w-full"},Nt=["textContent"],Pt=["textContent"],Tt={class:"text-start"},Vt={class:"absolute start-7 mt-6"},Lt={class:"relative"},Mt={class:"w-9 h-9 flex justify-center items-center rounded-full bg-white text-info dark:bg-gray-800"},Rt=["src"],qt=t("div",{class:"absolute top-4 -end-6 w-12 h-[2px] bg-gray-400 -z-10"},null,-1),Et={class:"grid grid-cols-1"},Kt={class:"md:col-start-1 col-span-2"},Wt={class:"flex md:flex-nowrap items-center gap-6 ms-10 md:mt-0 mt-5"},Gt={class:"ms-10"},Ht=["textContent"],Jt={class:"relative me-5 md:ps-0 ps-10 overflow-auto"},Ot={class:"pt-3"},Qt=["textContent"],Ut=["textContent"],Xt={key:0,class:"text-center"};function Yt(u,i,s,e,p,y){const f=v("close_icon"),m=v("help_icon"),d=v("dashboard_card_white"),r=v("trip_map");return o(),l("div",N,[s.trip?(o(),l("div",P,[t("div",T,[t("div",V,[e.activeItem&&e.activeItem.driver?(o(),l("div",L,[t("h4",{class:"mb-1 mt-3 text-lg dark:text-gray-300",textContent:a(e.translate("Trip")+e.translate(" #")+e.activeItem.trip_id)},null,8,M),t("button",{type:"button",onClick:i[0]||(i[0]=(...n)=>u.close&&u.close(...n)),class:"hover:bg-primary mb-3 px-6 py-2 flex text-danger"},[g(f),C(),t("span",{textContent:a(e.translate("Back"))},null,8,R)])])):_("",!0),q,t("div",E,[t("div",K,[t("p",W,[t("strong",{textContent:a(e.translate("Duration"))},null,8,G),t("span",{class:"ms-2",textContent:a(e.activeItem.duration)},null,8,H)]),t("p",J,[t("strong",{textContent:a(e.translate("Pickup locations"))},null,8,O),C(),t("span",{class:"ms-2",textContent:a(e.activeItem.pickup_locations_count)},null,8,Q)]),t("p",U,[t("strong",{textContent:a(e.translate("Route"))},null,8,X),t("span",{class:"ms-2",textContent:a(e.activeItem.route?e.activeItem.route.route_name:"")},null,8,Y)]),t("p",Z,[t("strong",{textContent:a(e.translate("Driver"))},null,8,$),t("span",{class:"ms-2",textContent:a(e.activeItem.driver_name)},null,8,tt)])]),(o(),l("span",{key:e.activeStatus,textContent:a(e.activeStatus)},null,8,et))]),st])]),t("div",at,[t("div",nt,[t("div",ot,[(o(),l("div",{class:"w-full",key:e.activeStatus},[t("nav",lt,[t("button",{onClick:i[1]||(i[1]=n=>e.setActiveStatus("info")),type:"button",textContent:a(e.translate("Info")),class:x([e.activeStatus=="info"?"menu-dark text-white font-semibold":"text-gray-500","hover:bg-white hover:text-blue-800 hs-tab-active:font-semibold hs-tab-active:bg-white dark:hs-tab-active:bg-gray-700 w-full flex justify-center py-2 rounded items-center gap-2 border-b-2 border-transparent -mb-px transition-all text-sm whitespace-nowrap dark:text-white active"])},null,10,it),t("button",{onClick:i[2]||(i[2]=n=>e.setActiveStatus("pickup_locations")),type:"button",textContent:a(e.translate("Pickup locations")),class:x([e.activeStatus=="pickup_locations"?"menu-dark text-white font-semibold":"text-gray-500","hover:bg-white hover:text-blue-800 hs-tab-active:font-semibold hs-tab-active:bg-white dark:hs-tab-active:bg-gray-700 w-full flex justify-center py-2 rounded items-center gap-2 border-b-2 border-transparent -mb-px transition-all text-sm whitespace-nowrap dark:text-white"])},null,10,rt),t("button",{type:"button",onClick:i[3]||(i[3]=n=>e.setActiveStatus("map")),class:x([e.activeStatus=="map"?"menu-dark text-white font-semibold":"text-gray-500","hover:bg-white hover:text-blue-800 hs-tab-active:font-semibold hs-tab-active:bg-white dark:hs-tab-active:bg-gray-700 w-full flex justify-center py-2 rounded items-center gap-2 border-b-2 border-transparent -mb-px transition-all text-sm whitespace-nowrap dark:text-white"]),textContent:a(e.translate("Map"))},null,10,ct),t("button",{onClick:i[4]||(i[4]=n=>e.setActiveStatus("reviews")),type:"button",textContent:a(e.translate("Reviews")),class:x([e.activeStatus=="reviews"?"menu-dark text-white font-semibold":"text-gray-500","hover:bg-white hover:text-blue-800 hs-tab-active:font-semibold hs-tab-active:bg-white dark:hs-tab-active:bg-gray-700 w-full flex justify-center py-2 rounded items-center gap-2 border-b-2 border-transparent -mb-px transition-all text-sm whitespace-nowrap dark:text-white"])},null,10,dt)]),t("div",_t,[(o(),l("div",{key:e.activeStatus,id:"basic-tabs-1",class:"transition-all duration-300 transform"},[e.activeStatus=="help_messages"?(o(),l("div",ut,[(o(!0),l(w,null,S(e.activeItem.help_messages,n=>(o(),l("div",xt,[t("div",ht,[t("div",bt,[t("span",gt,[g(m,{class:"text-primary w-10 h-10"})]),t("span",{class:"text-content3 text-2xs text-muted p-3",textContent:a(n.date)},null,8,mt)]),t("div",vt,[t("div",null,[t("p",{class:"text-title text-sm font-semibold mb-1 dark:text-white",textContent:a(n.subject)},null,8,pt),t("p",{class:"text-content3 text-2xs truncate",textContent:a(n.message)},null,8,ft)]),t("div",{class:x([e.translate("lang")=="ar"?"left-0":"right-0","absolute flex items-center justify-between gap-1"])},[t("span",{class:"bg-blue-50 px-4 py-1 text-secondary badge-sm rounded-5",textContent:a(n.status)},null,8,yt)],2)])])]))),256))])):_("",!0),e.activeStatus=="info"?(o(),l("div",{class:"w-full border-b border-gray-100",key:e.activeStatus},[t("div",kt,[t("div",Ct,[g(d,{icon:"/uploads/img/products_icome.png",classes:"bg-gradient-success",class:"border border-1",title:e.translate("Duration"),value:e.activeItem.duration?e.activeItem.duration:"0"},null,8,["title","value"]),g(d,{icon:"/uploads/img/products_icome.png",classes:"bg-gradient-info",class:"border border-1",title:e.translate("Pickup locations"),value:e.activeItem.pickup_locations_count},null,8,["title","value"]),g(d,{icon:"/uploads/img/products_icome.png",classes:"bg-gradient-danger",class:"border border-1",title:e.translate("Distance"),value:e.activeItem.distance},null,8,["title","value"])])])])):_("",!0),e.activeStatus=="pickup_locations"&&s.trip?(o(),l("div",wt,[t("div",{class:x([e.translate("lang")=="ar"?"right-4":"left-4","absolute border-s-2 border border-gray-300 h-full top-20 start-10 -z-10 dark:border-white/10"])},null,2),t("div",St,[t("div",It,[t("h5",{class:"font-semibold bg-white dark:bg-gray-700 dark:text-gray-300 inline rounded",textContent:a(e.translate("Trip number")+" #"+s.trip.trip_id)},null,8,jt),t("p",{class:"text-muted text-sm",textContent:a(s.trip.trip_date)},null,8,zt)]),t("div",Dt,[t("h5",{class:"font-semibold bg-white dark:bg-gray-700 dark:text-gray-300 inline rounded",textContent:a(s.trip.duration)},null,8,Ft),t("p",{class:"text-muted text-sm",textContent:a(e.translate("Duration"))},null,8,At)]),t("div",Bt,[t("h5",{class:"font-semibold bg-white dark:bg-gray-700 dark:text-gray-300 inline rounded",textContent:a(s.trip.distance+" KM")},null,8,Nt),t("p",{class:"text-muted text-sm",textContent:a(e.translate("Distance"))},null,8,Pt)])]),(o(!0),l(w,null,S(s.trip.pickup_locations,n=>(o(),l("div",{class:"space-y-4",key:s.trip},[t("div",Tt,[t("div",Vt,[t("div",Lt,[t("div",Mt,[n.model?(o(),l("img",{key:0,src:"/app/image.php?w=100&h=100&src="+n.model.picture,class:"rounded-full",alt:""},null,8,Rt)):_("",!0)]),qt])]),t("div",Et,[t("div",Kt,[t("div",Wt,[t("div",Gt,[t("h2",{class:x([e.translate("lang")=="ar"?"bg-gradient-to-l":"bg-gradient-to-r","font-semibold p-2 rounded text-primary flex items-center justify-center text-sm mx-16"]),textContent:a(n.boarding_time?n.time:e.translate("Waiting"))},null,10,Ht)]),t("div",Jt,[t("div",Ot,[n.model?(o(),l("h4",{key:0,class:"mb-1.5 text-base dark:text-gray-300",textContent:a(n.model.name)},null,8,Qt)):_("",!0),n.location?(o(),l("p",{key:1,style:D([{"white-space":"nowrap"},{"white-space":"nowrap"}]),class:"mb-4 text-gray-500 dark:text-gray-400",textContent:a(n.location.address)},null,8,Ut)):_("",!0)])])])])])])]))),128))])):_("",!0)]))])]))])]),e.activeStatus=="map"?(o(),l("p",Xt,[(o(),z(r,{key:s.trip,trip:s.trip,conf:s.conf,onIntervalCallback:u.callback},null,8,["trip","conf","onIntervalCallback"]))])):_("",!0)])])):_("",!0)])}const se=I(B,[["render",Yt]]);export{se as default};
