import{_ as V,D as B,p as F,q as r,s as O,r as g,o as l,c as u,a as n,j as w,d as c,l as z,t as f,w as N,v as U,F as R,i as q,n as J,u as C,x as L,y as K,z as G,A as H,b as Q,B as A}from"./index-KR6zh3KX.js";import{c as W,r as X}from"./car-PcubF7UT.js";const Y=L(()=>A(()=>import("./map-GbfikJwy.js"),__vite__mapDeps([0,1,2]))),Z=L(()=>A(()=>import("./side-form-create-DYTBryFo.js"),__vite__mapDeps([3,1,2,4,5,6]))),$=L(()=>A(()=>import("./side-form-update-IgMYTCGZ.js"),__vite__mapDeps([7,1,2,4,5,6]))),ee={components:{datatabble:B,SideFormCreate:Z,SideFormUpdate:$,maps:Y,delete_icon:F,car_icon:W,route_icon:X},name:"Locations",setup(h){const s=h.conf.url+h.path+"?load=json",m=r(!1),e=r(!1);r(null);const k=r({}),d=r({}),p=r({}),x=r([]);r(!0);const _=r("");r(null);const y=r(!1),b=()=>{m.value=!1,e.value=!1};(()=>{K(s).then(t=>{d.value=JSON.parse(JSON.stringify(t)),x.value=d.value.items,T()})})();const v=t=>{k.value=t;for(let a=0;a<d.value.items.length;a++)d.value.items[a].selected=!1;d.value.items[i].selected=!0,x.value=D(t)},S=async()=>{navigator.geolocation&&(console.log("position 1"),navigator.geolocation.getCurrentPosition(t=>{p.value={lat:t.coords.latitude,lng:t.coords.longitude}},t=>{G(t.message,5e3)}))};S();const T=()=>{for(let t=0;t<d.value.items.length;t++)d.value.items[t].active=_.value.trim()?j(d.value.items[t]):1},j=t=>{let a=!!t.student_name.toLowerCase().includes(_.value.toLowerCase());return a||!!t.location_name.toLowerCase().includes(_.toLowerCase())},P=(t,a,E)=>{t.latitude=t.destination.lat,t.longitude=t.destination.lng,M("edit",t)},I=(t,a,E)=>{console.log(t),console.log(a),console.log(E)},D=t=>(t.icon=this.conf.url+"uploads/images/blue_pin.gif",t.origin=t.destination={lat:parseFloat(t.latitude),lng:parseFloat(t.longitude)},t.drag=!0,t),M=(t,a)=>{switch(t){case"view":break;case"edit":e=!0,m=!1,k.value=a;break;case"delete":H("pickup_id",a,"PickupLocation.delete");break}};return{locations:x,showAddSide:m,showEditSide:e,url:s,content:d,center:p,activeItem:k,translate:O,clickMarker:I,updateMarker:P,setLocationsMarkers:v,checkSimilar:j,searchTextChanged:T,searchText:_,getUserLocation:S,collapsed:y,closeSide:b,handleAction:M}},props:["path","lang","setting","conf","auth"]},te={class:"w-full flex overflow-auto",style:{height:"85vh","z-index":"9999"}},oe={class:"w-full"},ne={key:0,class:"relative flex-1 overflow-x-hidden overflow-y-auto w-full"},se={class:"self-stretch py-4 flex-col justify-center items-start flex"},le=["textContent"],ae=["textContent"],ie={key:0,class:"w-full self-stretch pt-2 flex-col justify-center items-start flex"},ce=["placeholder"],re={key:0,class:"grow shrink basis-0 gap-4 justify-start items-center flex"},de={class:"justify-start items-center flex"},ue=["src"],he=["onClick"],fe=["textContent"],me=["textContent"],_e={class:"justify-center items-center flex"},xe=["onClick"],ve=n("div",{class:"text-center text-xs text-white uppercase tracking-tight"},[n("i",{class:"fa fa-edit"})],-1),ge=[ve],ke={class:"flex self-stretch grow shrink basis-0 justify-between items-center inline-flex"},pe=["textContent"],we=["textContent"],ye={class:"px-4 mb-6 py-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 flex w-full"},be=["textContent"],Ce=n("hr",{class:"mt-2"},null,-1),Le={class:"w-full"},Ae=["src"],Se=["onClick"],Te=n("i",{class:"fa fa-edit"},null,-1),je=[Te],Me=["onClick"];function Ee(h,s,m,e,k,d){const p=g("maps"),x=g("delete_icon"),_=g("datatabble"),y=g("side-form-create"),b=g("side-form-update");return l(),u("div",te,[n("div",oe,[e.content?(l(),u("main",ne,[e.locations.length?(l(),w(p,{onUpdateMarker:e.updateMarker,onClickMarker:e.clickMarker,setting:m.setting,key:e.center,center:e.center,waypoints:e.locations},null,8,["onUpdateMarker","onClickMarker","setting","center","waypoints"])):c("",!0),e.content.items?(l(),u("div",{key:e.content.items,style:z(e.collapsed?"max-height:240px":"max-height:calc(100vh - 140px)"),class:"mx-16 h-full absolute top-4 rounded-lg p-4 w-96 bg-white rounded-xl flex-col justify-start items-start inline-flex"},[n("div",se,[n("div",{class:"text-black text-lg font-semibold",textContent:f(e.translate("Pickup locations"))},null,8,le),n("div",{class:"py-2 self-stretch text-zinc-600 text-base tracking-wide",textContent:f(e.translate("Pickup locations description"))},null,8,ae)]),e.collapsed?c("",!0):(l(),u("div",ie,[N(n("input",{class:"w-full bg-gray-100 rounded-lg px-4 py-2",placeholder:e.translate("find by name and address"),"onUpdate:modelValue":s[0]||(s[0]=o=>e.searchText=o),onChange:s[1]||(s[1]=(...o)=>e.searchTextChanged&&e.searchTextChanged(...o)),onInput:s[2]||(s[2]=(...o)=>e.searchTextChanged&&e.searchTextChanged(...o)),onKeydown:s[3]||(s[3]=(...o)=>e.searchTextChanged&&e.searchTextChanged(...o))},null,40,ce),[[U,e.searchText]])])),e.collapsed?c("",!0):(l(),u("div",{key:e.collapsed,class:"max-h-[400px] overflow-auto my-4 w-full self-stretch py-4"},[h.showList&&h.location.active?(l(!0),u(R,{key:0},q(e.content.items,o=>(l(),u("div",{key:o.active,class:"pt-2 w-full self-stretch justify-start items-center inline-flex"},[o.active?(l(),u("div",re,[n("div",de,[n("img",{class:"w-10 h-10 rounded-full shadow-inner border-2 border-black",src:o.student&&o.student.picture?o.student.picture:"https://via.placeholder.com/60x6"},null,8,ue)]),n("div",{onClick:v=>e.setLocationsMarkers(o),class:"grow shrink basis-0 flex-col justify-center items-start gap-[3px] inline-flex cursor-pointer"},[n("div",{class:"text-black font-semibold text-base",textContent:f(o.student_name)},null,8,fe),n("div",{class:"self-stretch text-slate-500 text-sm font-normal",textContent:f(o.location_name+" - "+o.address)},null,8,me)],8,he)])):c("",!0),n("div",_e,[n("div",{class:"px-3 py-2 bg-purple-800 rounded justify-center items-center flex mr-2 cursor-pointer",onClick:v=>e.handleAction("edit",o)},ge,8,xe)])]))),128)):c("",!0)])),n("div",ke,[n("div",{class:"menu-dark rounded-lg text-white text-xs font-medium px-4 py-3 uppercase cursor-pointer",onClick:s[4]||(s[4]=o=>{h.showLoader=!0,e.showAddSide=!0,e.activeItem={},h.showLoader=!1}),textContent:f(e.translate("add new"))},null,8,pe),n("div",{onClick:s[5]||(s[5]=o=>e.collapsed=!e.collapsed),class:"cursor-pointer p-2 block text-center"},[n("i",{class:J(["fa",e.collapsed?"fa-circle-down":"fa-circle-up"])},null,2),n("p",{class:"font-semibold",textContent:f(e.collapsed?e.translate("Expand"):e.translate("Collapse"))},null,8,we)])])],4)):c("",!0),n("div",ye,[n("h1",{class:"font-bold text-lg w-full",textContent:f(e.content.title)},null,8,be),n("a",{href:"javascript:;",class:"uppercase p-2 mx-2 text-center text-white w-32 rounded-lg menu-dark hover:bg-purple-800",onClick:s[6]||(s[6]=o=>{h.showLoader=!0,e.showAddSide=!0,e.activeItem={},h.showLoader=!1})},f(e.translate("add_new")),1)]),Ce,n("div",Le,[e.content.columns?(l(),w(_,{key:0,"body-text-direction":e.translate("lang")=="ar"?"right":"left","fixed-checkbox":"",headers:e.content.columns,items:e.content.items},{"item-picture":C(o=>[n("img",{src:o.picture,class:"w-8 h-8 rounded-full"},null,8,Ae)]),"item-edit":C(o=>[o.not_editable?c("",!0):(l(),u("button",{key:0,class:"p-2 hover:text-gray-600 text-purple",onClick:v=>e.handleAction("edit",o)},je,8,Se))]),"item-delete":C(o=>[o.not_removeable?c("",!0):(l(),u("button",{key:0,class:"p-2 hover:text-gray-600 text-purple",onClick:v=>e.handleAction("delete",o)},[Q(x,{class:"w-4"})],8,Me))]),_:1},8,["body-text-direction","headers","items"])):c("",!0),e.showAddSide&&e.content&&e.content.fillable?(l(),w(y,{key:1,conf:m.conf,model:"PickupLocation.create",columns:e.content.fillable,class:"col-md-3"},null,8,["conf","columns"])):c("",!0),e.showEditSide&&!e.showAddSide?(l(),w(b,{key:2,conf:m.conf,model:"PickupLocation.update",item:e.activeItem,model_id:e.activeItem.pickup_id,index:"pickup_id",columns:e.content.fillable,class:"col-md-3"},null,8,["conf","item","model_id","columns"])):c("",!0)])])):c("",!0)])])}const De=V(ee,[["render",Ee]]);export{De as default};
function __vite__mapDeps(indexes) {
  if (!__vite__mapDeps.viteFileDeps) {
    __vite__mapDeps.viteFileDeps = ["assets/map-GbfikJwy.js","assets/index-KR6zh3KX.js","assets/index-OY3wY1QZ.css","assets/side-form-create-DYTBryFo.js","assets/Field-L3Ero0Ka.js","assets/Manager-eGpPW14E.js","assets/Manager-Cgf44v6b.css","assets/side-form-update-IgMYTCGZ.js"]
  }
  return indexes.map((i) => __vite__mapDeps.viteFileDeps[i])
}