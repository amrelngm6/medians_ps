import{_ as H,D as Q,e as W,f as d,t as X,r as m,o as n,c as o,g as T,h as c,i as l,j as f,w as Y,y as Z,F as E,k as M,n as D,a as b,l as w,m as $,z as A,d as R,b as V,p as ee,s as te,u as le}from"./index-WdHXOiSD.js";import{c as se,r as ne}from"./car-sBhl1CCS.js";const oe=R(()=>V(()=>import("./map-DL9McEyi.js"),__vite__mapDeps([0,1,2,3]))),ae=R(()=>V(()=>import("./side-form-create-e9_YSth7.js"),__vite__mapDeps([4,2,3,5,6]))),ie=R(()=>V(()=>import("./side-form-update-wPCgoj71.js"),__vite__mapDeps([7,2,3,5,6]))),ce={components:{datatabble:Q,SideFormCreate:ae,SideFormUpdate:ie,maps:oe,delete_icon:W,car_icon:se,route_icon:ne},name:"Routes",setup(v){const a=v.conf.url+v.path+"?load=json",x=d(!1),e=d(!1),F=d(null),g=d({}),_=d({}),k=d({});d([]),d(!0);const p=d(""),j=d(null),I=d(!1),L=()=>{x.value=!1,e.value=!1};(()=>{ee(a).then(s=>{_.value=JSON.parse(JSON.stringify(s)),t()})})();const y=async()=>{navigator.geolocation?(console.log("position 1"),navigator.geolocation.getCurrentPosition(s=>{k.value={lat:s.coords.latitude,lng:s.coords.longitude}},s=>{te(s.message,5e3)})):j.value="Geolocation is not supported by this browser."};y();const t=()=>{for(let s=0;s<_.value.items.length;s++)_.value.items[s].active=p.value.trim()?h(_.value.items[s]):1},h=s=>{let i=!!s.route_name.toLowerCase().includes(p.value.toLowerCase());return i||!!s.description.toLowerCase().includes(p.toLowerCase())},u=(s,i)=>{g.value=s;for(let r=0;r<_.value.items.length;r++)_.value.items[r].selected=!1;_.value.items[i].selected=!0,z.value=N(s)},C=(s,i,r)=>{},O=(s,i,r)=>{console.log(s),console.log(i),console.log(r)},N=s=>{let i,r=[],G=v.conf.url+"uploads/images/blue_pin.gif",J=v.conf.url+"uploads/images/car.svg",K=v.conf.url+"uploads/images/destination.svg";for(let S=0;S<s.pickup_locations.length;S++)i=s.pickup_locations[S],r[S]={title:i.student_name,icon:G,origin:{lat:parseFloat(i.latitude),lng:parseFloat(i.longitude)},destination:{lat:parseFloat(i.latitude),lng:parseFloat(i.longitude)}};let B={icon:J,origin:{lat:parseFloat(s.vehicle.last_latitude),lng:parseFloat(s.vehicle.last_longitude)},destination:{lat:parseFloat(s.vehicle.last_latitude),lng:parseFloat(s.vehicle.last_longitude)}};r[r.length]=B;let q={drag:!0,icon:K,origin:B.origin,destination:{lat:parseFloat(s.latitude),lng:parseFloat(s.longitude)}};return r[r.length]=q,k.value=r[0].destination,r},U=(s,i)=>{switch(s){case"view":break;case"edit":g.value=i,x.value=!1,e.value=!0,F.value=!0;break;case"delete":le("driver_id",i,"Driver.delete");break;case"close":e.value=!1,x.value=!1,F.value=!1,g.value={};break}},z=d([]);return{showAddSide:x,waypoints:z,showEditSide:e,url:a,content:_,center:k,activeItem:g,translate:X,setLocationsPickups:N,clickMarker:O,updateMarker:C,setLocationsMarkers:u,checkSimilar:h,searchTextChanged:t,searchText:p,getUserLocation:y,collapsed:I,closeSide:L,handleAction:U}},props:["path","lang","setting","conf","auth"]},re={class:"w-full flex overflow-auto",style:{height:"85vh","z-index":"9999"}},de={key:0,class:"w-full relative"},ue={class:"self-stretch py-4 flex-col justify-center items-start flex"},fe=["textContent"],_e=["textContent"],he={key:0,class:"w-full self-stretch pt-2 flex-col justify-center items-start flex"},xe=["placeholder"],me={class:"w-full grow shrink basis-0 px-6 py-4 flex-col justify-center items-start gap-4 inline-flex"},pe={class:"w-full self-stretch justify-start items-start inline-flex cursor-pointer"},ve=["onClick"],ge=["textContent"],ke=["textContent"],be={class:"gap-2 py-2 flex justify-start items-start gap-2.5 inline-flex"},we=["onClick"],ye={class:"text-center text-white uppercase tracking-tight text-sm"},Ce=l("hr",{class:"w-full"},null,-1),Se={class:"w-full h-8 relative flex"},Te=["src"],Ae=["textContent"],Fe={class:"right-0 absolute flex self-stretch text-slate-500 text-base font-normal"},je=["textContent"],Ie={class:"flex self-stretch grow shrink basis-0 justify-between items-center inline-flex"},Le=["textContent"],Ee=["textContent"],Me=l("hr",{class:"mt-2"},null,-1),De={class:"flex-1 overflow-x-hidden overflow-y-auto w-full relative"},Re={class:"px-4 mb-6 py-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 flex w-full"},Ve=["textContent"],Pe=l("hr",{class:"mt-2"},null,-1),Ne={class:"w-full"},ze=["src"],Be={class:"w-full h-8 relative flex"},Oe=["src"],Ue=["textContent"],Ge=["onClick"],Je=l("i",{class:"fa fa-edit"},null,-1),Ke=[Je],qe=["onClick"];function He(v,a,x,e,F,g){const _=m("maps"),k=m("vue-feather"),p=m("route_icon"),j=m("car_icon"),I=m("delete_icon"),L=m("datatabble"),P=m("side-form-create"),y=m("side-form-update");return n(),o("div",re,[e.content?(n(),o("div",de,[e.center?(n(),T(_,{conf:x.conf,setting:x.setting,key:e.center,center:e.center,onClickMarker:e.clickMarker,waypoints:e.waypoints,showroute:!1},null,8,["conf","setting","center","onClickMarker","waypoints"])):c("",!0),l("div",{style:w(e.collapsed?"max-height:240px":"max-height:calc(100vh - 140px)"),class:"mx-16 h-full absolute top-4 rounded-lg p-4 bg-white rounded-xl flex-col justify-start items-start inline-flex"},[l("div",ue,[l("div",{class:"text-black text-lg font-semibold",textContent:f(e.translate("Routes"))},null,8,fe),l("div",{class:"py-2 self-stretch text-zinc-600 text-base tracking-wide",textContent:f(e.translate("Routes description"))},null,8,_e)]),e.collapsed?c("",!0):(n(),o("div",he,[Y(l("input",{class:"w-full bg-gray-100 rounded-lg px-4 py-2",placeholder:e.translate("find by name and address"),"onUpdate:modelValue":a[0]||(a[0]=t=>e.searchText=t),onChange:a[1]||(a[1]=(...t)=>e.searchTextChanged&&e.searchTextChanged(...t)),onInput:a[2]||(a[2]=(...t)=>e.searchTextChanged&&e.searchTextChanged(...t)),onKeydown:a[3]||(a[3]=(...t)=>e.searchTextChanged&&e.searchTextChanged(...t))},null,40,xe),[[Z,e.searchText]])])),!e.collapsed&&e.content.items?(n(),o("div",{key:e.collapsed,class:"max-h-[400px] overflow-auto my-4 w-full self-stretch py-4"},[(n(!0),o(E,null,M(e.content.items,(t,h)=>(n(),o("div",{key:t.active,class:"w-full"},[t.active?(n(),o("div",{key:0,class:D([t.selected?"text-fuchsia-600":"bg-gray-50","mb-4 w-full rounded-lg justify-start items-center inline-flex"])},[l("div",me,[l("div",pe,[l("div",{onClick:u=>e.setLocationsMarkers(t,h),class:"w-full grow shrink basis-0 flex-col justify-start items-start inline-flex"},[l("div",{class:D([t.selected?"text-fuchsia-600":"text-gray-800","self-stretch text-base font-semibold tracking-tight"]),textContent:f(t.route_name)},null,10,ge),l("div",{class:"py-1 self-stretch text-slate-500 text-sm font-semibold leading-relaxed tracking-wide",textContent:f(t.description)},null,8,ke)],8,ve),l("div",be,[l("div",{class:"px-3 py-2 bg-purple-800 rounded justify-center items-center flex cursor-pointer",onClick:u=>e.handleAction("edit",t)},[l("div",ye,[b(k,{type:"edit"})])],8,we)])]),Ce,l("div",Se,[(n(!0),o(E,null,M(t.pickup_locations,(u,C)=>(n(),o("div",{class:"rounded-full left-0 top-0 absolute",style:w("left: "+20*C+"px")},[C<3?(n(),o("img",{key:0,class:"rounded-full w-8 h-8 rounded-[50px] border-2 border-purple-800",src:u.student&&u.student.picture?u.student.picture:"https://via.placeholder.com/37x37"},null,8,Te)):c("",!0)],4))),256)),l("span",{class:"absolute pt-2 flex",style:w("left: "+(20*(t.pickup_locations.length<3?t.pickup_locations.length:3)+20)+"px")},[b(p),$(),t.pickup_locations?(n(),o("span",{key:0,class:"font-semibold px-1",textContent:f(t.pickup_locations.length)},null,8,Ae)):c("",!0)],4),l("div",Fe,[b(j,{class:"w-8"}),t.vehicle?(n(),o("span",{key:0,class:"font-semibold text-sm p-2",textContent:f(t.vehicle.plate_number)},null,8,je)):c("",!0)])])])],2)):c("",!0)]))),128))])):c("",!0),l("div",Ie,[l("div",{class:"menu-dark rounded-lg text-white text-xs font-medium px-4 py-3 uppercase cursor-pointer",onClick:a[4]||(a[4]=t=>{e.showAddSide=!0,e.activeItem={}}),textContent:f(e.translate("add new"))},null,8,Le),l("div",{onClick:a[5]||(a[5]=t=>e.collapsed=!e.collapsed),class:"cursor-pointer p-2 block text-center"},[l("i",{class:D(["fa",e.collapsed?"fa-circle-down":"fa-circle-up"])},null,2),l("p",{class:"font-semibold",textContent:f(e.collapsed?e.translate("Expand"):e.translate("Collapse"))},null,8,Ee)])])],4),Me,l("main",De,[l("div",Re,[l("h1",{class:"font-bold text-lg w-full",textContent:f(e.content.title)},null,8,Ve),l("a",{href:"javascript:;",class:"uppercase p-2 mx-2 text-center text-white w-32 rounded-lg menu-dark hover:bg-purple-800",onClick:a[6]||(a[6]=t=>{e.showAddSide=!0,e.activeItem={}})},f(e.translate("add_new")),1)]),Pe,l("div",Ne,[e.content.columns?(n(),T(L,{key:0,"body-text-direction":e.translate("lang")=="ar"?"right":"left","fixed-checkbox":"",headers:e.content.columns,items:e.content.items},{"item-picture":A(t=>[l("img",{src:t.picture,class:"w-8 h-8 rounded-full"},null,8,ze)]),"item-pickup_locations":A(t=>[l("div",Be,[(n(!0),o(E,null,M(t.pickup_locations,(h,u)=>(n(),o("div",{style:w("left: "+20*u+"px"),class:"rounded-full w-8 h-8 left-0 top-0 absolute"},[u<3?(n(),o("img",{key:u,class:"rounded-full w-8 h-8 rounded-[50px] border-2 border-purple-800",src:h.student&&h.student.picture?h.student.picture:"https://via.placeholder.com/37x37"},null,8,Oe)):c("",!0)],4))),256)),l("span",{class:"flex absolute pt-2",style:w("left: "+(20*(t.pickup_locations.length<3?t.pickup_locations.length:3)+20)+"px")},[b(p),t.pickup_locations?(n(),o("span",{key:0,class:"font-semibold px-1",textContent:f(t.pickup_locations.length)},null,8,Ue)):c("",!0)],4)])]),"item-edit":A(t=>[t.not_editable?c("",!0):(n(),o("button",{key:0,class:"p-2 hover:text-gray-600 text-purple",onClick:h=>e.handleAction("edit",t)},Ke,8,Ge))]),"item-delete":A(t=>[t.not_removeable?c("",!0):(n(),o("button",{key:0,class:"p-2 hover:text-gray-600 text-purple",onClick:h=>e.handleAction("delete",t)},[b(I,{class:"w-4"})],8,qe))]),_:1},8,["body-text-direction","headers","items"])):c("",!0),e.showAddSide&&e.content&&e.content.fillable?(n(),T(P,{key:1,onCallback:e.closeSide,conf:x.conf,model:"Routes.create",columns:e.content.fillable,class:"col-md-3"},null,8,["onCallback","conf","columns"])):c("",!0),e.showEditSide&&!e.showAddSide?(n(),T(y,{onCallback:e.closeSide,key:e.activeItem,conf:x.conf,model:"Routes.update",item:e.activeItem,model_id:e.activeItem.route_id,index:"route_id",columns:e.content.fillable,class:"col-md-3"},null,8,["onCallback","conf","item","model_id","columns"])):c("",!0)])])])):c("",!0)])}const Xe=H(ce,[["render",He]]);export{Xe as default};
function __vite__mapDeps(indexes) {
  if (!__vite__mapDeps.viteFileDeps) {
    __vite__mapDeps.viteFileDeps = ["assets/map-DL9McEyi.js","assets/index.es-DPY7McIL.js","assets/index-WdHXOiSD.js","assets/index-2HpYNNBE.css","assets/side-form-create-e9_YSth7.js","assets/Field-08VenbdU.js","assets/Field-Cgf44v6b.css","assets/side-form-update-wPCgoj71.js"]
  }
  return indexes.map((i) => __vite__mapDeps.viteFileDeps[i])
}