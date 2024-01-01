import{_ as z,f as D,C as F,s as C,q as g,r as f,o,c as i,a as t,t as s,b,k as S,d as _,n as u,F as I,i as j,j as A,l as B}from"./index-yvds15tN.js";import{h as L}from"./help-GT7COFfO.js";import N from"./trip_map-BMgAeZ2N.js";import"./index.es-Wf7DiHtN.js";const P={components:{dashboard_card_white:D,help_icon:L,trip_map:N,close_icon:F,translate:C},setup(a){const c=a.conf.url+a.path+"?load=json",l=g({}),e=g({}),y=g([]),k=g("info"),w=g(!0),m=()=>{l.value=a.trip;let d=[];d[0]=n(a.trip.vehicle,a.trip.route,"car.svg"),e.value=d[0];let h,p;for(let r=0;r<a.trippickup_locations.length;r++)h=a.trippickup_locations[r].time?"yellow_pin.gif":"blue_pin.gif",p=a.tripdestinations[r].time?"yellow_pin.gif":"blue_pin.gif",d.push(n(a.trippickup_locations[r],a.tripdestinations[r],h)),d.push(n(a.tripdestinations[r],a.trippickup_locations[r],p));d.push(n(a.triproute,a.tripvehicle,"destination.svg")),y.value=d},x=()=>{limitCount.value+=5,limitCount.value>l.value.last_trips.length&&(w.value=!1)},v=d=>{console.log(d),k.value=d};v("map");const n=(d,h,p)=>{let r={};return r.icon=a.conf.url+"uploads/images/"+p,r.origin={lat:parseFloat(d.latitude),lng:parseFloat(d.longitude)},r.destination={lat:parseFloat(h.latitude),lng:parseFloat(h.longitude)},r.drag=!1,r};return m(),{url:c,locations:y,center:e,activeItem:l,activeStatus:k,setActiveStatus:v,loadmore:x,handlePickup:n,setLocations:m,translate:C}},props:["path","lang","setting","conf","auth","trip"]},T={class:"w-full"},V={key:0,class:"grid xl:grid-cols-12 lg:grid-cols-12 grid-cols-1 gap-6"},M={class:"xl:col-span-3 lg:col-span-5"},R={class:"card px-4 py-6 mb-6"},q={key:0,class:"text-center"},E=["textContent"],K=["textContent"],W=t("hr",{class:"mt-5 dark:border-gray-600"},null,-1),G={class:"text-start mt-6 text-sm"},H={class:"space-y-7"},J={class:"text-zinc-400 dark:text-gray-400 flex gap-4"},O=["textContent"],Q=["textContent"],U={class:"text-zinc-400 dark:text-gray-400 flex gap-4"},X=["textContent"],Y=["textContent"],Z={class:"text-zinc-400 dark:text-gray-400 flex gap-4"},$=["textContent"],tt=["textContent"],et={class:"text-zinc-400 dark:text-gray-400 flex gap-4"},st=["textContent"],nt=["textContent"],at=t("hr",{class:"my-5 dark:border-gray-600"},null,-1),ot={class:"xl:col-span-9 lg:col-span-7"},it={class:"card"},lt={class:"p-6"},rt={class:"lg:flex items-center justify-around rounded-xl space-x-3 bg-gray-100 p-2 dark:bg-gray-900/30","aria-label":"Tabs",role:"tablist"},ct=["textContent"],dt=["textContent"],_t=["textContent"],ut=["textContent"],xt={class:"mt-3 overflow-hidden"},ht={key:0,class:"grid grid-cols-1 lg:grid-cols-2 gap-6 w-full border-b border-gray-100"},gt={class:"w-full relative"},bt={class:"dark:border-border-dark dark:border-dashed border border-border-light border-dashed p-4 flex flex-col gap-5"},mt={class:"flex items-start justify-between"},vt={class:"border border-1 grid p-3 rounded-full sm:p-2 place-content-center"},pt=["textContent"],ft={class:"flex flex-col gap-2"},yt=["textContent"],kt=["textContent"],wt=["textContent"],Ct={class:"mt-6 w-full"},St={class:"grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6 mb-6"},It={key:2,class:"w-full border-b border-gray-100"},jt={class:"md:text-start lg:flex mb-5 mt-5"},zt={class:"w-full"},Dt=["textContent"],Ft=["textContent"],At={class:"w-full"},Bt=["textContent"],Lt=["textContent"],Nt={class:"w-full"},Pt=["textContent"],Tt=["textContent"],Vt={class:"text-start"},Mt={class:"absolute start-7 mt-6"},Rt={class:"relative"},qt={class:"w-9 h-9 flex justify-center items-center rounded-full bg-white text-info dark:bg-gray-800"},Et=["src"],Kt=t("div",{class:"absolute top-4 -end-6 w-12 h-[2px] bg-gray-400 -z-10"},null,-1),Wt={class:"grid grid-cols-1"},Gt={class:"md:col-start-1 col-span-2"},Ht={class:"flex md:flex-nowrap items-center gap-6 ms-10 md:mt-0 mt-5"},Jt={class:"ms-10"},Ot=["textContent"],Qt={class:"relative me-5 md:ps-0 ps-10 overflow-auto"},Ut={class:"pt-3"},Xt=["textContent"],Yt=["textContent"],Zt={key:0,class:"text-center"};function $t(a,c,l,e,y,k){const w=f("close_icon"),m=f("help_icon"),x=f("dashboard_card_white"),v=f("trip_map");return o(),i("div",T,[l.trip?(o(),i("div",V,[t("div",M,[t("div",R,[e.activeItem&&e.activeItem.driver?(o(),i("div",q,[t("h4",{class:"mb-1 mt-3 text-lg dark:text-gray-300",textContent:s(e.translate("Trip")+e.translate(" #")+e.activeItem.trip_id)},null,8,E),t("button",{type:"button",onClick:c[0]||(c[0]=(...n)=>a.close&&a.close(...n)),class:"hover:bg-primary mb-3 px-6 py-2 flex text-danger"},[b(w),S(),t("span",{textContent:s(e.translate("Back"))},null,8,K)])])):_("",!0),W,t("div",G,[t("div",H,[t("p",J,[t("strong",{textContent:s(e.translate("Duration"))},null,8,O),t("span",{class:"ms-2",textContent:s(e.activeItem.duration)},null,8,Q)]),t("p",U,[t("strong",{textContent:s(e.translate("Pickup locations"))},null,8,X),S(),t("span",{class:"ms-2",textContent:s(e.activeItem.pickup_locations_count)},null,8,Y)]),t("p",Z,[t("strong",{textContent:s(e.translate("Route"))},null,8,$),t("span",{class:"ms-2",textContent:s(e.activeItem.route?e.activeItem.route.route_name:"")},null,8,tt)]),t("p",et,[t("strong",{textContent:s(e.translate("Driver"))},null,8,st),t("span",{class:"ms-2",textContent:s(e.activeItem.driver_name)},null,8,nt)])])]),at])]),t("div",ot,[t("div",it,[t("div",lt,[(o(),i("div",{class:"w-full",key:e.activeStatus},[t("nav",rt,[t("button",{onClick:c[1]||(c[1]=n=>e.setActiveStatus("info")),type:"button",textContent:s(e.translate("Info")),class:u([e.activeStatus=="info"?"menu-dark text-white font-semibold":"text-gray-500","hover:bg-white hover:text-blue-800 hs-tab-active:font-semibold hs-tab-active:bg-white dark:hs-tab-active:bg-gray-700 w-full flex justify-center py-2 rounded items-center gap-2 border-b-2 border-transparent -mb-px transition-all text-sm whitespace-nowrap dark:text-white active"])},null,10,ct),t("button",{onClick:c[2]||(c[2]=n=>e.setActiveStatus("pickup_locations")),type:"button",textContent:s(e.translate("Pickup locations")),class:u([e.activeStatus=="pickup_locations"?"menu-dark text-white font-semibold":"text-gray-500","hover:bg-white hover:text-blue-800 hs-tab-active:font-semibold hs-tab-active:bg-white dark:hs-tab-active:bg-gray-700 w-full flex justify-center py-2 rounded items-center gap-2 border-b-2 border-transparent -mb-px transition-all text-sm whitespace-nowrap dark:text-white"])},null,10,dt),t("button",{type:"button",onClick:c[3]||(c[3]=n=>e.setActiveStatus("map")),class:u([e.activeStatus=="map"?"menu-dark text-white font-semibold":"text-gray-500","hover:bg-white hover:text-blue-800 hs-tab-active:font-semibold hs-tab-active:bg-white dark:hs-tab-active:bg-gray-700 w-full flex justify-center py-2 rounded items-center gap-2 border-b-2 border-transparent -mb-px transition-all text-sm whitespace-nowrap dark:text-white"]),textContent:s(e.translate("Map"))},null,10,_t),t("button",{onClick:c[4]||(c[4]=n=>e.setActiveStatus("reviews")),type:"button",textContent:s(e.translate("Reviews")),class:u([e.activeStatus=="reviews"?"menu-dark text-white font-semibold":"text-gray-500","hover:bg-white hover:text-blue-800 hs-tab-active:font-semibold hs-tab-active:bg-white dark:hs-tab-active:bg-gray-700 w-full flex justify-center py-2 rounded items-center gap-2 border-b-2 border-transparent -mb-px transition-all text-sm whitespace-nowrap dark:text-white"])},null,10,ut)]),t("div",xt,[(o(),i("div",{key:e.activeStatus,id:"basic-tabs-1",class:"transition-all duration-300 transform"},[e.activeStatus=="help_messages"?(o(),i("div",ht,[(o(!0),i(I,null,j(e.activeItem.help_messages,n=>(o(),i("div",gt,[t("div",bt,[t("div",mt,[t("span",vt,[b(m,{class:"text-primary w-10 h-10"})]),t("span",{class:"text-content3 text-2xs text-muted p-3",textContent:s(n.date)},null,8,pt)]),t("div",ft,[t("div",null,[t("p",{class:"text-title text-sm font-semibold mb-1 dark:text-white",textContent:s(n.subject)},null,8,yt),t("p",{class:"text-content3 text-2xs truncate",textContent:s(n.message)},null,8,kt)]),t("div",{class:u([e.translate("lang")=="ar"?"left-0":"right-0","absolute flex items-center justify-between gap-1"])},[t("span",{class:"bg-blue-50 px-4 py-1 text-secondary badge-sm rounded-5",textContent:s(n.status)},null,8,wt)],2)])])]))),256))])):_("",!0),e.activeStatus=="info"?(o(),i("div",{class:"w-full border-b border-gray-100",key:e.activeStatus},[t("div",Ct,[t("div",St,[b(x,{icon:"/uploads/img/products_icome.png",classes:"bg-gradient-success",class:"border border-1",title:e.translate("Duration"),value:e.activeItem.duration?e.activeItem.duration:"0"},null,8,["title","value"]),b(x,{icon:"/uploads/img/products_icome.png",classes:"bg-gradient-info",class:"border border-1",title:e.translate("Pickup locations"),value:e.activeItem.pickup_locations_count},null,8,["title","value"]),b(x,{icon:"/uploads/img/products_icome.png",classes:"bg-gradient-danger",class:"border border-1",title:e.translate("Distance"),value:e.activeItem.distance},null,8,["title","value"])])])])):_("",!0),e.activeStatus=="pickup_locations"&&l.trip?(o(),i("div",It,[t("div",{class:u([e.translate("lang")=="ar"?"right-4":"left-4","absolute border-s-2 border border-gray-300 h-full top-20 start-10 -z-10 dark:border-white/10"])},null,2),t("div",jt,[t("div",zt,[t("h5",{class:"font-semibold bg-white dark:bg-gray-700 dark:text-gray-300 inline rounded",textContent:s(e.translate("Trip number")+" #"+l.trip.trip_id)},null,8,Dt),t("p",{class:"text-muted text-sm",textContent:s(l.trip.trip_date)},null,8,Ft)]),t("div",At,[t("h5",{class:"font-semibold bg-white dark:bg-gray-700 dark:text-gray-300 inline rounded",textContent:s(l.trip.duration)},null,8,Bt),t("p",{class:"text-muted text-sm",textContent:s(e.translate("Duration"))},null,8,Lt)]),t("div",Nt,[t("h5",{class:"font-semibold bg-white dark:bg-gray-700 dark:text-gray-300 inline rounded",textContent:s(l.trip.distance+" KM")},null,8,Pt),t("p",{class:"text-muted text-sm",textContent:s(e.translate("Distance"))},null,8,Tt)])]),(o(!0),i(I,null,j(l.trip.pickup_locations,n=>(o(),i("div",{class:"space-y-4",key:l.trip},[t("div",Vt,[t("div",Mt,[t("div",Rt,[t("div",qt,[n.model?(o(),i("img",{key:0,src:"/app/image.php?w=100&h=100&src="+n.model.picture,class:"rounded-full",alt:""},null,8,Et)):_("",!0)]),Kt])]),t("div",Wt,[t("div",Gt,[t("div",Ht,[t("div",Jt,[t("h2",{class:u([e.translate("lang")=="ar"?"bg-gradient-to-l":"bg-gradient-to-r","font-semibold p-2 rounded text-primary flex items-center justify-center text-sm mx-16"]),textContent:s(n.boarding_time?n.time:e.translate("Waiting"))},null,10,Ot)]),t("div",Qt,[t("div",Ut,[n.model?(o(),i("h4",{key:0,class:"mb-1.5 text-base dark:text-gray-300",textContent:s(n.model.name)},null,8,Xt)):_("",!0),n.location?(o(),i("p",{key:1,style:B([{"white-space":"nowrap"},{"white-space":"nowrap"}]),class:"mb-4 text-gray-500 dark:text-gray-400",textContent:s(n.location.address)},null,8,Yt)):_("",!0)])])])])])])]))),128))])):_("",!0)]))])]))])]),e.activeStatus=="map"?(o(),i("p",Zt,[(o(),A(v,{conf:l.conf,setting:l.setting,trip:l.trip,center:e.center,key:e.locations,waypoints:e.locations,onIntervalCallback:a.callback},null,8,["conf","setting","trip","center","waypoints","onIntervalCallback"]))])):_("",!0)])])):_("",!0)])}const ae=z(P,[["render",$t]]);export{ae as default};
