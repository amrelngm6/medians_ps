import{_ as H,D as Q,e as W,f as u,t as X,r as m,o as n,c as o,g as C,h as c,i as l,j as f,w as Y,y as Z,F as L,k as E,n as M,l as b,a as S,m as $,z as T,d as D,b as R,p as ee,s as te,u as le}from"./index-_fe7tIxw.js";import{c as se,r as ne}from"./car-3qv8u0CS.js";const oe=D(()=>R(()=>import("./map-qxqQmv5H.js"),__vite__mapDeps([0,1,2,3]))),ae=D(()=>R(()=>import("./side-form-create-3Y7UWXQg.js"),__vite__mapDeps([4,2,3,5,6]))),ie=D(()=>R(()=>import("./side-form-update-7vw56Erk.js"),__vite__mapDeps([7,2,3,5,6]))),ce={components:{datatabble:Q,SideFormCreate:ae,SideFormUpdate:ie,maps:oe,delete_icon:W,car_icon:se,route_icon:ne},name:"Routes",setup(p){const a=p.conf.url+p.path+"?load=json",x=u(!1),e=u(!1),A=u(null),k=u({}),_=u({}),g=u({});u([]),u(!0);const v=u(""),F=u(null),j=u(!1),I=()=>{x.value=!1,e.value=!1};(()=>{ee(a).then(s=>{_.value=JSON.parse(JSON.stringify(s)),h()})})();const t=async()=>{navigator.geolocation?(console.log("position 1"),navigator.geolocation.getCurrentPosition(s=>{g.value={lat:s.coords.latitude,lng:s.coords.longitude}},s=>{te(s.message,5e3)})):F.value="Geolocation is not supported by this browser."};t();const h=()=>{for(let s=0;s<_.value.items.length;s++)_.value.items[s].active=v.value.trim()?d(_.value.items[s]):1},d=s=>{let i=!!s.route_name.toLowerCase().includes(v.value.toLowerCase());return i||!!s.description.toLowerCase().includes(v.toLowerCase())},w=(s,i)=>{k.value=s;for(let r=0;r<_.value.items.length;r++)_.value.items[r].selected=!1;_.value.items[i].selected=!0,N.value=P(s)},B=(s,i,r)=>{},O=(s,i,r)=>{console.log(s),console.log(i),console.log(r)},P=s=>{let i,r=[],G=p.conf.url+"uploads/images/blue_pin.gif",J=p.conf.url+"uploads/images/car.svg",K=p.conf.url+"uploads/images/destination.svg";for(let y=0;y<s.pickup_locations.length;y++)i=s.pickup_locations[y],r[y]={title:i.student_name,icon:G,origin:{lat:parseFloat(i.latitude),lng:parseFloat(i.longitude)},destination:{lat:parseFloat(i.latitude),lng:parseFloat(i.longitude)}};let z={icon:J,origin:{lat:parseFloat(s.vehicle.last_latitude),lng:parseFloat(s.vehicle.last_longitude)},destination:{lat:parseFloat(s.vehicle.last_latitude),lng:parseFloat(s.vehicle.last_longitude)}};r[r.length]=z;let q={drag:!0,icon:K,origin:z.origin,destination:{lat:parseFloat(s.latitude),lng:parseFloat(s.longitude)}};return r[r.length]=q,g.value=r[0].destination,r},U=(s,i)=>{switch(s){case"view":break;case"edit":k.value=i,x.value=!1,e.value=!0,A.value=!0;break;case"delete":le("driver_id",i,"Driver.delete");break;case"close":e.value=!1,x.value=!1,A.value=!1,k.value={};break}},N=u([]);return{showAddSide:x,waypoints:N,showEditSide:e,url:a,content:_,center:g,activeItem:k,translate:X,setLocationsPickups:P,clickMarker:O,updateMarker:B,setLocationsMarkers:w,checkSimilar:d,searchTextChanged:h,searchText:v,getUserLocation:t,collapsed:j,closeSide:I,handleAction:U}},props:["path","lang","setting","conf","auth"]},re={class:"w-full flex overflow-auto",style:{height:"85vh","z-index":"9999"}},de={key:0,class:"w-full relative"},ue={class:"self-stretch py-4 flex-col justify-center items-start flex"},fe=["textContent"],_e=["textContent"],he={key:0,class:"w-full self-stretch pt-2 flex-col justify-center items-start flex"},xe=["placeholder"],me={class:"w-full grow shrink basis-0 px-6 py-4 flex-col justify-center items-start gap-4 inline-flex"},pe={class:"w-full self-stretch justify-start items-start inline-flex cursor-pointer"},ge=["onClick"],ve=["textContent"],ke=["textContent"],be={class:"gap-2 py-2 flex justify-start items-start gap-2.5 inline-flex"},we=["onClick"],ye=l("div",{class:"text-center text-white uppercase tracking-tight text-sm"},[l("i",{class:"fa fa-edit"})],-1),Ce=[ye],Se=l("hr",{class:"w-full"},null,-1),Te={class:"w-full h-8 relative flex"},Ae=["src"],Fe=["textContent"],je={class:"right-0 absolute flex self-stretch text-slate-500 text-base font-normal"},Ie=["textContent"],Le={class:"flex self-stretch grow shrink basis-0 justify-between items-center inline-flex"},Ee=["textContent"],Me=["textContent"],De=l("hr",{class:"mt-2"},null,-1),Re={class:"flex-1 overflow-x-hidden overflow-y-auto w-full relative"},Ve={class:"px-4 mb-6 py-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 flex w-full"},Pe=["textContent"],Ne=l("hr",{class:"mt-2"},null,-1),ze={class:"w-full"},Be=["src"],Oe={class:"w-full h-8 relative flex"},Ue=["src"],Ge=["textContent"],Je=["onClick"],Ke=l("i",{class:"fa fa-edit"},null,-1),qe=[Ke],He=["onClick"];function Qe(p,a,x,e,A,k){const _=m("maps"),g=m("route_icon"),v=m("car_icon"),F=m("delete_icon"),j=m("datatabble"),I=m("side-form-create"),V=m("side-form-update");return n(),o("div",re,[e.content?(n(),o("div",de,[e.center?(n(),C(_,{conf:x.conf,setting:x.setting,key:e.center,center:e.center,onClickMarker:e.clickMarker,waypoints:e.waypoints,showroute:!1},null,8,["conf","setting","center","onClickMarker","waypoints"])):c("",!0),l("div",{style:b(e.collapsed?"max-height:240px":"max-height:calc(100vh - 140px)"),class:"mx-16 h-full absolute top-4 rounded-lg p-4 bg-white rounded-xl flex-col justify-start items-start inline-flex"},[l("div",ue,[l("div",{class:"text-black text-lg font-semibold",textContent:f(e.translate("Routes"))},null,8,fe),l("div",{class:"py-2 self-stretch text-zinc-600 text-base tracking-wide",textContent:f(e.translate("Routes description"))},null,8,_e)]),e.collapsed?c("",!0):(n(),o("div",he,[Y(l("input",{class:"w-full bg-gray-100 rounded-lg px-4 py-2",placeholder:e.translate("find by name and address"),"onUpdate:modelValue":a[0]||(a[0]=t=>e.searchText=t),onChange:a[1]||(a[1]=(...t)=>e.searchTextChanged&&e.searchTextChanged(...t)),onInput:a[2]||(a[2]=(...t)=>e.searchTextChanged&&e.searchTextChanged(...t)),onKeydown:a[3]||(a[3]=(...t)=>e.searchTextChanged&&e.searchTextChanged(...t))},null,40,xe),[[Z,e.searchText]])])),!e.collapsed&&e.content.items?(n(),o("div",{key:e.collapsed,class:"max-h-[400px] overflow-auto my-4 w-full self-stretch py-4"},[(n(!0),o(L,null,E(e.content.items,(t,h)=>(n(),o("div",{key:t.active,class:"w-full"},[t.active?(n(),o("div",{key:0,class:M([t.selected?"text-fuchsia-600":"bg-gray-50","mb-4 w-full rounded-lg justify-start items-center inline-flex"])},[l("div",me,[l("div",pe,[l("div",{onClick:d=>e.setLocationsMarkers(t,h),class:"w-full grow shrink basis-0 flex-col justify-start items-start inline-flex"},[l("div",{class:M([t.selected?"text-fuchsia-600":"text-gray-800","self-stretch text-base font-semibold tracking-tight"]),textContent:f(t.route_name)},null,10,ve),l("div",{class:"py-1 self-stretch text-slate-500 text-sm font-semibold leading-relaxed tracking-wide",textContent:f(t.description)},null,8,ke)],8,ge),l("div",be,[l("div",{class:"px-3 py-2 bg-purple-800 rounded justify-center items-center flex cursor-pointer",onClick:d=>e.handleAction("edit",t)},Ce,8,we)])]),Se,l("div",Te,[(n(!0),o(L,null,E(t.pickup_locations,(d,w)=>(n(),o("div",{class:"rounded-full left-0 top-0 absolute",style:b("left: "+20*w+"px")},[w<3?(n(),o("img",{key:0,class:"rounded-full w-8 h-8 rounded-[50px] border-2 border-purple-800",src:d.student&&d.student.picture?d.student.picture:"https://via.placeholder.com/37x37"},null,8,Ae)):c("",!0)],4))),256)),l("span",{class:"absolute pt-2 flex",style:b("left: "+(20*(t.pickup_locations.length<3?t.pickup_locations.length:3)+20)+"px")},[S(g),$(),t.pickup_locations?(n(),o("span",{key:0,class:"font-semibold px-1",textContent:f(t.pickup_locations.length)},null,8,Fe)):c("",!0)],4),l("div",je,[S(v,{class:"w-8"}),t.vehicle?(n(),o("span",{key:0,class:"font-semibold text-sm p-2",textContent:f(t.vehicle.plate_number)},null,8,Ie)):c("",!0)])])])],2)):c("",!0)]))),128))])):c("",!0),l("div",Le,[l("div",{class:"menu-dark rounded-lg text-white text-xs font-medium px-4 py-3 uppercase cursor-pointer",onClick:a[4]||(a[4]=t=>{e.showAddSide=!0,e.activeItem={}}),textContent:f(e.translate("add new"))},null,8,Ee),l("div",{onClick:a[5]||(a[5]=t=>e.collapsed=!e.collapsed),class:"cursor-pointer p-2 block text-center"},[l("i",{class:M(["fa",e.collapsed?"fa-circle-down":"fa-circle-up"])},null,2),l("p",{class:"font-semibold",textContent:f(e.collapsed?e.translate("Expand"):e.translate("Collapse"))},null,8,Me)])])],4),De,l("main",Re,[l("div",Ve,[l("h1",{class:"font-bold text-lg w-full",textContent:f(e.content.title)},null,8,Pe),l("a",{href:"javascript:;",class:"uppercase p-2 mx-2 text-center text-white w-32 rounded-lg menu-dark hover:bg-purple-800",onClick:a[6]||(a[6]=t=>{e.showAddSide=!0,e.activeItem={}})},f(e.translate("add_new")),1)]),Ne,l("div",ze,[e.content.columns?(n(),C(j,{key:0,"body-text-direction":e.translate("lang")=="ar"?"right":"left","fixed-checkbox":"",headers:e.content.columns,items:e.content.items},{"item-picture":T(t=>[l("img",{src:t.picture,class:"w-8 h-8 rounded-full"},null,8,Be)]),"item-pickup_locations":T(t=>[l("div",Oe,[(n(!0),o(L,null,E(t.pickup_locations,(h,d)=>(n(),o("div",{style:b("left: "+20*d+"px"),class:"rounded-full w-8 h-8 left-0 top-0 absolute"},[d<3?(n(),o("img",{key:d,class:"rounded-full w-8 h-8 rounded-[50px] border-2 border-purple-800",src:h.student&&h.student.picture?h.student.picture:"https://via.placeholder.com/37x37"},null,8,Ue)):c("",!0)],4))),256)),l("span",{class:"flex absolute pt-2",style:b("left: "+(20*(t.pickup_locations.length<3?t.pickup_locations.length:3)+20)+"px")},[S(g),t.pickup_locations?(n(),o("span",{key:0,class:"font-semibold px-1",textContent:f(t.pickup_locations.length)},null,8,Ge)):c("",!0)],4)])]),"item-edit":T(t=>[t.not_editable?c("",!0):(n(),o("button",{key:0,class:"p-2 hover:text-gray-600 text-purple",onClick:h=>e.handleAction("edit",t)},qe,8,Je))]),"item-delete":T(t=>[t.not_removeable?c("",!0):(n(),o("button",{key:0,class:"p-2 hover:text-gray-600 text-purple",onClick:h=>e.handleAction("delete",t)},[S(F,{class:"w-4"})],8,He))]),_:1},8,["body-text-direction","headers","items"])):c("",!0),e.showAddSide&&e.content&&e.content.fillable?(n(),C(I,{key:1,onCallback:e.closeSide,conf:x.conf,model:"Routes.create",columns:e.content.fillable,class:"col-md-3"},null,8,["onCallback","conf","columns"])):c("",!0),e.showEditSide&&!e.showAddSide?(n(),C(V,{onCallback:e.closeSide,key:e.activeItem,conf:x.conf,model:"Routes.update",item:e.activeItem,model_id:e.activeItem.route_id,index:"route_id",columns:e.content.fillable,class:"col-md-3"},null,8,["onCallback","conf","item","model_id","columns"])):c("",!0)])])])):c("",!0)])}const Ye=H(ce,[["render",Qe]]);export{Ye as default};
function __vite__mapDeps(indexes) {
  if (!__vite__mapDeps.viteFileDeps) {
    __vite__mapDeps.viteFileDeps = ["assets/map-qxqQmv5H.js","assets/index.es-2GtxnZSs.js","assets/index-_fe7tIxw.js","assets/index-2HpYNNBE.css","assets/side-form-create-3Y7UWXQg.js","assets/Field-2A1T5rQk.js","assets/Field-Cgf44v6b.css","assets/side-form-update-7vw56Erk.js"]
  }
  return indexes.map((i) => __vite__mapDeps.viteFileDeps[i])
}