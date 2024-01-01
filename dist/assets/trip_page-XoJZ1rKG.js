import{_ as k,f as w,r as p,o as r,c,a as t,t as s,k as x,d,n as _,F as b,i as g,b as u,j as y,l as C}from"./index-6ZrvwJ4A.js";import{h as I}from"./help-3KtbX0Fo.js";const S={components:{dashboard_card_white:w,help_icon:I},data(){return{content:{items:[]},locations:[],activeItem:{},showAddSide:!1,showEditSide:!1,showLoader:!1,showLoadMore:!0,limitCount:3,activeStatus:"info"}},props:["path","lang","setting","conf","auth","trip"],mounted(){this.activeItem=this.trip,this.trip&&this.setLocations()},methods:{update(){this.$emit("edit","edit",this.activeItem)},close(){this.$emit("close","close",this.activeItem,!1)},loadmore(){this.showLoader=!0,this.limitCount+=5,this.limitCount>this.activeItem.last_trips.length&&(this.showLoadMore=!1),this.showLoader=!1},setActiveStatus(o){this.showLoader=!0,this.activeStatus=o,this.showLoader=!1},handleAction(o,a){switch(o){case"view":break;case"edit":this.showEditSide=!0,this.showAddSide=!1,this.activeItem=a;break;case"delete":this.$root.$children[0].deleteByKey("driver_id",a,"Driver.delete");break}},load(){this.showLoader=!0,this.$root.$children[0].handleGetRequest(this.url).then(o=>{this.setValues(o),this.showLoader=!1})},setValues(o){return this.content=JSON.parse(JSON.stringify(o)),this},setLocations(){this.activeItem.locations=[this.handlePickup(this.activeItem.vehicle,this.activeItem.route,"car.svg")],this.activeItem.pickup_locations.length;let o,a;for(let i=0;i<this.activeItem.pickup_locations.length;i++)o=this.activeItem.pickup_locations[i].time?"yellow_pin.gif":"blue_pin.gif",a=this.activeItem.destinations[i].time?"yellow_pin.gif":"blue_pin.gif",this.activeItem.locations.push(this.handlePickup(this.activeItem.pickup_locations[i],this.activeItem.destinations[i],o)),this.activeItem.locations.push(this.handlePickup(this.activeItem.destinations[i],this.activeItem.pickup_locations[i],a));return this.activeItem.locations.push(this.handlePickup(this.activeItem.route,this.activeItem.vehicle,"destination.svg")),this},handlePickup(o,a,i){let h={};return h.icon=this.conf.url+"uploads/images/"+i,h.origin={lat:parseFloat(o.latitude),lng:parseFloat(o.longitude)},h.destination={lat:parseFloat(a.latitude),lng:parseFloat(a.longitude)},h.drag=!1,h},__(o){return this.$root.$children[0].__(o)}}},L={class:"w-full"},j={key:0,class:"grid xl:grid-cols-12 lg:grid-cols-12 grid-cols-1 gap-6"},M={class:"xl:col-span-3 lg:col-span-5"},z={class:"card px-4 py-6 mb-6"},A={key:0,class:"text-center"},D=["textContent"],P=t("i",{class:"fa fa-close px-2"},null,-1),B=["textContent"],F=t("hr",{class:"mt-5 dark:border-gray-600"},null,-1),N={class:"text-start mt-6 text-sm"},V={class:"space-y-7"},T={class:"text-zinc-400 dark:text-gray-400 flex gap-4"},E=["textContent"],R=["textContent"],J={class:"text-zinc-400 dark:text-gray-400 flex gap-4"},K=["textContent"],O=["textContent"],U={class:"text-zinc-400 dark:text-gray-400 flex gap-4"},q=["textContent"],G=["textContent"],W={class:"text-zinc-400 dark:text-gray-400 flex gap-4"},H=["textContent"],Q=["textContent"],X=t("hr",{class:"my-5 dark:border-gray-600"},null,-1),Y={class:"xl:col-span-9 lg:col-span-7"},Z={class:"card"},$={class:"p-6"},tt={class:"w-full"},et={class:"lg:flex items-center justify-around rounded-xl space-x-3 bg-gray-100 p-2 dark:bg-gray-900/30","aria-label":"Tabs",role:"tablist"},st=["textContent"],it=["textContent"],nt=["textContent"],ot=["textContent"],at={class:"mt-3 overflow-hidden"},lt={id:"basic-tabs-1",class:"transition-all duration-300 transform"},rt={key:0,class:"grid grid-cols-1 lg:grid-cols-2 gap-6 w-full border-b border-gray-100"},ct={class:"w-full relative"},dt={class:"dark:border-border-dark dark:border-dashed border border-border-light border-dashed p-4 flex flex-col gap-5"},_t={class:"flex items-start justify-between"},ht={class:"border border-1 grid p-3 rounded-full sm:p-2 place-content-center"},ut=["textContent"],mt={class:"flex flex-col gap-2"},pt=["textContent"],xt=["textContent"],bt=["textContent"],gt={key:1,class:"w-full border-b border-gray-100"},vt={class:"mt-6 w-full"},ft={class:"grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6 mb-6"},kt={key:2,class:"w-full border-b border-gray-100"},wt={class:"md:text-start lg:flex mb-5 mt-5"},yt={class:"w-full"},Ct=["textContent"],It=["textContent"],St={class:"w-full"},Lt=["textContent"],jt=["textContent"],Mt={class:"w-full"},zt=["textContent"],At=["textContent"],Dt={class:"text-start"},Pt={class:"absolute start-7 mt-6"},Bt={class:"relative"},Ft={class:"w-9 h-9 flex justify-center items-center rounded-full bg-white text-info dark:bg-gray-800"},Nt=["src"],Vt=t("div",{class:"absolute top-4 -end-6 w-12 h-[2px] bg-gray-400 -z-10"},null,-1),Tt={class:"grid grid-cols-1"},Et={class:"md:col-start-1 col-span-2"},Rt={class:"flex md:flex-nowrap items-center gap-6 ms-10 md:mt-0 mt-5"},Jt={class:"ms-10"},Kt=["textContent"],Ot={class:"relative me-5 md:ps-0 ps-10 overflow-auto"},Ut={class:"pt-3"},qt=["textContent"],Gt=["textContent"],Wt={key:0,class:"text-center"};function Ht(o,a,i,h,n,e){const v=p("help_icon"),m=p("dashboard_card_white"),f=p("trip_map");return r(),c("div",L,[!n.showLoader&&i.trip?(r(),c("div",j,[t("div",M,[t("div",z,[n.activeItem&&n.activeItem.driver?(r(),c("div",A,[t("h4",{class:"mb-1 mt-3 text-lg dark:text-gray-300",textContent:s(e.__("Trip")+e.__(" #")+n.activeItem.trip_id)},null,8,D),t("button",{type:"button",onClick:a[0]||(a[0]=(...l)=>e.close&&e.close(...l)),class:"hover:bg-primary mb-3 px-6 py-2 text-danger"},[P,x(),t("span",{textContent:s(e.__("Back"))},null,8,B)])])):d("",!0),F,t("div",N,[t("div",V,[t("p",T,[t("strong",{textContent:s(e.__("Duration"))},null,8,E),t("span",{class:"ms-2",textContent:s(n.activeItem.duration)},null,8,R)]),t("p",J,[t("strong",{textContent:s(e.__("Pickup locations"))},null,8,K),x(),t("span",{class:"ms-2",textContent:s(n.activeItem.pickup_locations_count)},null,8,O)]),t("p",U,[t("strong",{textContent:s(e.__("Route"))},null,8,q),t("span",{class:"ms-2",textContent:s(n.activeItem.route?n.activeItem.route.route_name:"")},null,8,G)]),t("p",W,[t("strong",{textContent:s(e.__("Driver"))},null,8,H),t("span",{class:"ms-2",textContent:s(n.activeItem.driver_name)},null,8,Q)])])]),X])]),t("div",Y,[t("div",Z,[t("div",$,[t("div",tt,[t("nav",et,[t("button",{onClick:a[1]||(a[1]=l=>e.setActiveStatus("info")),type:"button",textContent:s(e.__("Info")),class:_([n.activeStatus=="info"?"menu-dark text-white font-semibold":"text-gray-500","hover:bg-white hover:text-blue-800 hs-tab-active:font-semibold hs-tab-active:bg-white dark:hs-tab-active:bg-gray-700 w-full flex justify-center py-2 rounded items-center gap-2 border-b-2 border-transparent -mb-px transition-all text-sm whitespace-nowrap dark:text-white active"])},null,10,st),t("button",{onClick:a[2]||(a[2]=l=>e.setActiveStatus("pickup_locations")),type:"button",textContent:s(e.__("Pickup locations")),class:_([n.activeStatus=="pickup_locations"?"menu-dark text-white font-semibold":"text-gray-500","hover:bg-white hover:text-blue-800 hs-tab-active:font-semibold hs-tab-active:bg-white dark:hs-tab-active:bg-gray-700 w-full flex justify-center py-2 rounded items-center gap-2 border-b-2 border-transparent -mb-px transition-all text-sm whitespace-nowrap dark:text-white"])},null,10,it),t("button",{type:"button",onClick:a[3]||(a[3]=l=>e.setActiveStatus("map")),class:_([n.activeStatus=="map"?"menu-dark text-white font-semibold":"text-gray-500","hover:bg-white hover:text-blue-800 hs-tab-active:font-semibold hs-tab-active:bg-white dark:hs-tab-active:bg-gray-700 w-full flex justify-center py-2 rounded items-center gap-2 border-b-2 border-transparent -mb-px transition-all text-sm whitespace-nowrap dark:text-white"]),textContent:s(e.__("Map"))},null,10,nt),t("button",{onClick:a[4]||(a[4]=l=>e.setActiveStatus("reviews")),type:"button",textContent:s(e.__("Reviews")),class:_([n.activeStatus=="reviews"?"menu-dark text-white font-semibold":"text-gray-500","hover:bg-white hover:text-blue-800 hs-tab-active:font-semibold hs-tab-active:bg-white dark:hs-tab-active:bg-gray-700 w-full flex justify-center py-2 rounded items-center gap-2 border-b-2 border-transparent -mb-px transition-all text-sm whitespace-nowrap dark:text-white"])},null,10,ot)]),t("div",at,[t("div",lt,[n.activeStatus=="help_messages"?(r(),c("div",rt,[(r(!0),c(b,null,g(n.activeItem.help_messages,l=>(r(),c("div",ct,[t("div",dt,[t("div",_t,[t("span",ht,[u(v,{class:"text-primary w-10 h-10"})]),t("span",{class:"text-content3 text-2xs text-muted p-3",textContent:s(l.date)},null,8,ut)]),t("div",mt,[t("div",null,[t("p",{class:"text-title text-sm font-semibold mb-1 dark:text-white",textContent:s(l.subject)},null,8,pt),t("p",{class:"text-content3 text-2xs truncate",textContent:s(l.message)},null,8,xt)]),t("div",{class:_([e.__("lang")=="ar"?"left-0":"right-0","absolute flex items-center justify-between gap-1"])},[t("span",{class:"bg-blue-50 px-4 py-1 text-secondary badge-sm rounded-5",textContent:s(l.status)},null,8,bt)],2)])])]))),256))])):d("",!0),n.activeStatus=="info"?(r(),c("div",gt,[t("div",vt,[t("div",ft,[u(m,{icon:"/uploads/img/products_icome.png",classes:"bg-gradient-success",class:"border border-1",title:e.__("Duration"),value:n.activeItem.duration?n.activeItem.duration:"0"},null,8,["title","value"]),u(m,{icon:"/uploads/img/products_icome.png",classes:"bg-gradient-info",class:"border border-1",title:e.__("Pickup locations"),value:n.activeItem.pickup_locations_count},null,8,["title","value"]),u(m,{icon:"/uploads/img/products_icome.png",classes:"bg-gradient-danger",class:"border border-1",title:e.__("Distance"),value:n.activeItem.distance},null,8,["title","value"])])])])):d("",!0),n.activeStatus=="pickup_locations"&&i.trip?(r(),c("div",kt,[t("div",{class:_([e.__("lang")=="ar"?"right-4":"left-4","absolute border-s-2 border border-gray-300 h-full top-20 start-10 -z-10 dark:border-white/10"])},null,2),t("div",wt,[t("div",yt,[t("h5",{class:"font-semibold bg-white dark:bg-gray-700 dark:text-gray-300 inline rounded",textContent:s(e.__("Trip number")+" #"+i.trip.trip_id)},null,8,Ct),t("p",{class:"text-muted text-sm",textContent:s(i.trip.trip_date)},null,8,It)]),t("div",St,[t("h5",{class:"font-semibold bg-white dark:bg-gray-700 dark:text-gray-300 inline rounded",textContent:s(i.trip.duration)},null,8,Lt),t("p",{class:"text-muted text-sm",textContent:s(e.__("Duration"))},null,8,jt)]),t("div",Mt,[t("h5",{class:"font-semibold bg-white dark:bg-gray-700 dark:text-gray-300 inline rounded",textContent:s(i.trip.distance+" KM")},null,8,zt),t("p",{class:"text-muted text-sm",textContent:s(e.__("Distance"))},null,8,At)])]),(r(!0),c(b,null,g(i.trip.pickup_locations,l=>(r(),c("div",{class:"space-y-4",key:i.trip},[t("div",Dt,[t("div",Pt,[t("div",Bt,[t("div",Ft,[l.model?(r(),c("img",{key:0,src:"/app/image.php?w=100&h=100&src="+l.model.picture,class:"rounded-full",alt:""},null,8,Nt)):d("",!0)]),Vt])]),t("div",Tt,[t("div",Et,[t("div",Rt,[t("div",Jt,[t("h2",{class:_([e.__("lang")=="ar"?"bg-gradient-to-l":"bg-gradient-to-r","font-semibold p-2 rounded text-primary flex items-center justify-center text-sm mx-16"]),textContent:s(l.boarding_time?l.time:e.__("Waiting"))},null,10,Kt)]),t("div",Ot,[t("div",Ut,[l.model?(r(),c("h4",{key:0,class:"mb-1.5 text-base dark:text-gray-300",textContent:s(l.model.name)},null,8,qt)):d("",!0),l.location?(r(),c("p",{key:1,style:C([{"white-space":"nowrap"},{"white-space":"nowrap"}]),class:"mb-4 text-gray-500 dark:text-gray-400",textContent:s(l.location.address)},null,8,Gt)):d("",!0)])])])])])])]))),128))])):d("",!0)])])])])]),n.activeStatus=="map"?(r(),c("p",Wt,[(r(),y(f,{key:i.trip,trip:i.trip,conf:i.conf,showroute:!0,onClickMarker:o.clickMarker,onUpdateMarker:o.updateMarker,onIntervalCallback:o.callback},null,8,["trip","conf","onClickMarker","onUpdateMarker","onIntervalCallback"]))])):d("",!0)])])):d("",!0)])}const Yt=k(S,[["render",Ht]]);export{Yt as default};