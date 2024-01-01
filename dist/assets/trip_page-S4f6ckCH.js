import{_ as S,f as j,s as k,q as h,r as v,o,c as l,a as t,t as s,b as g,k as w,d as u,n as x,F as C,i as I,j as z,l as D}from"./index-RbcDCGP0.js";import{h as F}from"./help-VXDQm9dB.js";import A from"./trip_map-nL5WZkfs.js";import"./index.es-EPPKvhAN.js";const B={components:{dashboard_card_white:j,help_icon:F,trip_map:A,translate:k},setup(d){const c=d.conf.url+d.path+"?load=json",n=h({});h({}),h({}),n.value=d.trip;const e=()=>{let r=[];r[0]=_(d.trip.vehicle,d.trip.route,"car.svg");let a,m;for(let i=0;i<n.value.pickup_locations.length;i++)a=n.value.pickup_locations[i].time?"yellow_pin.gif":"blue_pin.gif",m=n.value.destinations[i].time?"yellow_pin.gif":"blue_pin.gif",r.push(_(n.value.pickup_locations[i],n.value.destinations[i],a)),r.push(_(n.value.destinations[i],n.value.pickup_locations[i],m));r.push(_(n.value.route,n.value.vehicle,"destination.svg")),n.value.locations=r};e();const p=h("info"),y=h(!0),f=()=>{limitCount.value+=5,limitCount.value>n.value.last_trips.length&&(y.value=!1)},b=r=>{console.log(r),p.value=r};b("map");const _=(r,a,m)=>{let i={};return i.icon=d.conf.url+"uploads/images/"+m,i.origin={lat:parseFloat(r.latitude),lng:parseFloat(r.longitude)},i.destination={lat:parseFloat(a.latitude),lng:parseFloat(a.longitude)},i.drag=!1,i};return{url:c,activeItem:n,activeStatus:p,setActiveStatus:b,loadmore:f,handlePickup:_,setLocations:e,translate:k}},props:["path","lang","setting","conf","auth","trip"]},L={class:"w-full"},N={key:0,class:"grid xl:grid-cols-12 lg:grid-cols-12 grid-cols-1 gap-6"},P={class:"xl:col-span-3 lg:col-span-5"},T={class:"card px-4 py-6 mb-6"},V={key:0,class:"text-center"},M=["textContent"],R=["textContent"],q=t("hr",{class:"mt-5 dark:border-gray-600"},null,-1),E={class:"text-start mt-6 text-sm"},K={class:"space-y-7"},W={class:"text-zinc-400 dark:text-gray-400 flex gap-4"},G=["textContent"],H=["textContent"],J={class:"text-zinc-400 dark:text-gray-400 flex gap-4"},O=["textContent"],Q=["textContent"],U={class:"text-zinc-400 dark:text-gray-400 flex gap-4"},X=["textContent"],Y=["textContent"],Z={class:"text-zinc-400 dark:text-gray-400 flex gap-4"},$=["textContent"],tt=["textContent"],et=t("hr",{class:"my-5 dark:border-gray-600"},null,-1),st={class:"xl:col-span-9 lg:col-span-7"},nt={class:"card"},at={class:"p-6"},ot={class:"lg:flex items-center justify-around rounded-xl space-x-3 bg-gray-100 p-2 dark:bg-gray-900/30","aria-label":"Tabs",role:"tablist"},lt=["textContent"],it=["textContent"],rt=["textContent"],ct=["textContent"],dt={class:"mt-3 overflow-hidden"},_t={key:0,class:"grid grid-cols-1 lg:grid-cols-2 gap-6 w-full border-b border-gray-100"},ut={class:"w-full relative"},xt={class:"dark:border-border-dark dark:border-dashed border border-border-light border-dashed p-4 flex flex-col gap-5"},ht={class:"flex items-start justify-between"},gt={class:"border border-1 grid p-3 rounded-full sm:p-2 place-content-center"},bt=["textContent"],mt={class:"flex flex-col gap-2"},vt=["textContent"],pt=["textContent"],ft=["textContent"],yt={class:"mt-6 w-full"},kt={class:"grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6 mb-6"},wt={key:2,class:"w-full border-b border-gray-100"},Ct={class:"md:text-start lg:flex mb-5 mt-5"},It={class:"w-full"},St=["textContent"],jt=["textContent"],zt={class:"w-full"},Dt=["textContent"],Ft=["textContent"],At={class:"w-full"},Bt=["textContent"],Lt=["textContent"],Nt={class:"text-start"},Pt={class:"absolute start-7 mt-6"},Tt={class:"relative"},Vt={class:"w-9 h-9 flex justify-center items-center rounded-full bg-white text-info dark:bg-gray-800"},Mt=["src"],Rt=t("div",{class:"absolute top-4 -end-6 w-12 h-[2px] bg-gray-400 -z-10"},null,-1),qt={class:"grid grid-cols-1"},Et={class:"md:col-start-1 col-span-2"},Kt={class:"flex md:flex-nowrap items-center gap-6 ms-10 md:mt-0 mt-5"},Wt={class:"ms-10"},Gt=["textContent"],Ht={class:"relative me-5 md:ps-0 ps-10 overflow-auto"},Jt={class:"pt-3"},Ot=["textContent"],Qt=["textContent"],Ut={key:0,class:"text-center"};function Xt(d,c,n,e,p,y){const f=v("close_icon"),b=v("help_icon"),_=v("dashboard_card_white"),r=v("trip_map");return o(),l("div",L,[n.trip?(o(),l("div",N,[t("div",P,[t("div",T,[e.activeItem&&e.activeItem.driver?(o(),l("div",V,[t("h4",{class:"mb-1 mt-3 text-lg dark:text-gray-300",textContent:s(e.translate("Trip")+e.translate(" #")+e.activeItem.trip_id)},null,8,M),t("button",{type:"button",onClick:c[0]||(c[0]=(...a)=>d.close&&d.close(...a)),class:"hover:bg-primary mb-3 px-6 py-2 flex text-danger"},[g(f),w(),t("span",{textContent:s(e.translate("Back"))},null,8,R)])])):u("",!0),q,t("div",E,[t("div",K,[t("p",W,[t("strong",{textContent:s(e.translate("Duration"))},null,8,G),t("span",{class:"ms-2",textContent:s(e.activeItem.duration)},null,8,H)]),t("p",J,[t("strong",{textContent:s(e.translate("Pickup locations"))},null,8,O),w(),t("span",{class:"ms-2",textContent:s(e.activeItem.pickup_locations_count)},null,8,Q)]),t("p",U,[t("strong",{textContent:s(e.translate("Route"))},null,8,X),t("span",{class:"ms-2",textContent:s(e.activeItem.route?e.activeItem.route.route_name:"")},null,8,Y)]),t("p",Z,[t("strong",{textContent:s(e.translate("Driver"))},null,8,$),t("span",{class:"ms-2",textContent:s(e.activeItem.driver_name)},null,8,tt)])])]),et])]),t("div",st,[t("div",nt,[t("div",at,[(o(),l("div",{class:"w-full",key:e.activeStatus},[t("nav",ot,[t("button",{onClick:c[1]||(c[1]=a=>e.setActiveStatus("info")),type:"button",textContent:s(e.translate("Info")),class:x([e.activeStatus=="info"?"menu-dark text-white font-semibold":"text-gray-500","hover:bg-white hover:text-blue-800 hs-tab-active:font-semibold hs-tab-active:bg-white dark:hs-tab-active:bg-gray-700 w-full flex justify-center py-2 rounded items-center gap-2 border-b-2 border-transparent -mb-px transition-all text-sm whitespace-nowrap dark:text-white active"])},null,10,lt),t("button",{onClick:c[2]||(c[2]=a=>e.setActiveStatus("pickup_locations")),type:"button",textContent:s(e.translate("Pickup locations")),class:x([e.activeStatus=="pickup_locations"?"menu-dark text-white font-semibold":"text-gray-500","hover:bg-white hover:text-blue-800 hs-tab-active:font-semibold hs-tab-active:bg-white dark:hs-tab-active:bg-gray-700 w-full flex justify-center py-2 rounded items-center gap-2 border-b-2 border-transparent -mb-px transition-all text-sm whitespace-nowrap dark:text-white"])},null,10,it),t("button",{type:"button",onClick:c[3]||(c[3]=a=>e.setActiveStatus("map")),class:x([e.activeStatus=="map"?"menu-dark text-white font-semibold":"text-gray-500","hover:bg-white hover:text-blue-800 hs-tab-active:font-semibold hs-tab-active:bg-white dark:hs-tab-active:bg-gray-700 w-full flex justify-center py-2 rounded items-center gap-2 border-b-2 border-transparent -mb-px transition-all text-sm whitespace-nowrap dark:text-white"]),textContent:s(e.translate("Map"))},null,10,rt),t("button",{onClick:c[4]||(c[4]=a=>e.setActiveStatus("reviews")),type:"button",textContent:s(e.translate("Reviews")),class:x([e.activeStatus=="reviews"?"menu-dark text-white font-semibold":"text-gray-500","hover:bg-white hover:text-blue-800 hs-tab-active:font-semibold hs-tab-active:bg-white dark:hs-tab-active:bg-gray-700 w-full flex justify-center py-2 rounded items-center gap-2 border-b-2 border-transparent -mb-px transition-all text-sm whitespace-nowrap dark:text-white"])},null,10,ct)]),t("div",dt,[(o(),l("div",{key:e.activeStatus,id:"basic-tabs-1",class:"transition-all duration-300 transform"},[e.activeStatus=="help_messages"?(o(),l("div",_t,[(o(!0),l(C,null,I(e.activeItem.help_messages,a=>(o(),l("div",ut,[t("div",xt,[t("div",ht,[t("span",gt,[g(b,{class:"text-primary w-10 h-10"})]),t("span",{class:"text-content3 text-2xs text-muted p-3",textContent:s(a.date)},null,8,bt)]),t("div",mt,[t("div",null,[t("p",{class:"text-title text-sm font-semibold mb-1 dark:text-white",textContent:s(a.subject)},null,8,vt),t("p",{class:"text-content3 text-2xs truncate",textContent:s(a.message)},null,8,pt)]),t("div",{class:x([e.translate("lang")=="ar"?"left-0":"right-0","absolute flex items-center justify-between gap-1"])},[t("span",{class:"bg-blue-50 px-4 py-1 text-secondary badge-sm rounded-5",textContent:s(a.status)},null,8,ft)],2)])])]))),256))])):u("",!0),e.activeStatus=="info"?(o(),l("div",{class:"w-full border-b border-gray-100",key:e.activeStatus},[t("div",yt,[t("div",kt,[g(_,{icon:"/uploads/img/products_icome.png",classes:"bg-gradient-success",class:"border border-1",title:e.translate("Duration"),value:e.activeItem.duration?e.activeItem.duration:"0"},null,8,["title","value"]),g(_,{icon:"/uploads/img/products_icome.png",classes:"bg-gradient-info",class:"border border-1",title:e.translate("Pickup locations"),value:e.activeItem.pickup_locations_count},null,8,["title","value"]),g(_,{icon:"/uploads/img/products_icome.png",classes:"bg-gradient-danger",class:"border border-1",title:e.translate("Distance"),value:e.activeItem.distance},null,8,["title","value"])])])])):u("",!0),e.activeStatus=="pickup_locations"&&n.trip?(o(),l("div",wt,[t("div",{class:x([e.translate("lang")=="ar"?"right-4":"left-4","absolute border-s-2 border border-gray-300 h-full top-20 start-10 -z-10 dark:border-white/10"])},null,2),t("div",Ct,[t("div",It,[t("h5",{class:"font-semibold bg-white dark:bg-gray-700 dark:text-gray-300 inline rounded",textContent:s(e.translate("Trip number")+" #"+n.trip.trip_id)},null,8,St),t("p",{class:"text-muted text-sm",textContent:s(n.trip.trip_date)},null,8,jt)]),t("div",zt,[t("h5",{class:"font-semibold bg-white dark:bg-gray-700 dark:text-gray-300 inline rounded",textContent:s(n.trip.duration)},null,8,Dt),t("p",{class:"text-muted text-sm",textContent:s(e.translate("Duration"))},null,8,Ft)]),t("div",At,[t("h5",{class:"font-semibold bg-white dark:bg-gray-700 dark:text-gray-300 inline rounded",textContent:s(n.trip.distance+" KM")},null,8,Bt),t("p",{class:"text-muted text-sm",textContent:s(e.translate("Distance"))},null,8,Lt)])]),(o(!0),l(C,null,I(n.trip.pickup_locations,a=>(o(),l("div",{class:"space-y-4",key:n.trip},[t("div",Nt,[t("div",Pt,[t("div",Tt,[t("div",Vt,[a.model?(o(),l("img",{key:0,src:"/app/image.php?w=100&h=100&src="+a.model.picture,class:"rounded-full",alt:""},null,8,Mt)):u("",!0)]),Rt])]),t("div",qt,[t("div",Et,[t("div",Kt,[t("div",Wt,[t("h2",{class:x([e.translate("lang")=="ar"?"bg-gradient-to-l":"bg-gradient-to-r","font-semibold p-2 rounded text-primary flex items-center justify-center text-sm mx-16"]),textContent:s(a.boarding_time?a.time:e.translate("Waiting"))},null,10,Gt)]),t("div",Ht,[t("div",Jt,[a.model?(o(),l("h4",{key:0,class:"mb-1.5 text-base dark:text-gray-300",textContent:s(a.model.name)},null,8,Ot)):u("",!0),a.location?(o(),l("p",{key:1,style:D([{"white-space":"nowrap"},{"white-space":"nowrap"}]),class:"mb-4 text-gray-500 dark:text-gray-400",textContent:s(a.location.address)},null,8,Qt)):u("",!0)])])])])])])]))),128))])):u("",!0)]))])]))])]),e.activeStatus=="map"?(o(),l("p",Ut,[(o(),z(r,{trip:n.trip,conf:n.conf,key:e.activeItem.locations,waypoint:e.activeItem.locations,setting:n.setting,onIntervalCallback:d.callback},null,8,["trip","conf","waypoint","setting","onIntervalCallback"]))])):u("",!0)])])):u("",!0)])}const ee=S(B,[["render",Xt]]);export{ee as default};
