import{_ as F,D as z,e as B,f as c,t as N,r as g,o as s,c as u,i as o,g as b,h as r,l as U,j as m,w as R,y as J,F as K,k as q,a as j,n as G,z as A,d as T,b as M,p as H,s as Q,u as W}from"./index-XViUBfli.js";import{c as X,r as Y}from"./car-2pV-xyie.js";const Z=T(()=>M(()=>import("./map-7CRy-bEv.js"),__vite__mapDeps([0,1,2,3]))),$=T(()=>M(()=>import("./side-form-create-tHJd69DT.js"),__vite__mapDeps([4,2,3,5,6]))),ee=T(()=>M(()=>import("./side-form-update-YXmVECoA.js"),__vite__mapDeps([7,2,3,5,6]))),te={components:{datatabble:z,SideFormCreate:$,SideFormUpdate:ee,maps:Z,delete_icon:B,car_icon:X,route_icon:Y},name:"Locations",setup(f){const l=f.conf.url+f.path+"?load=json",_=c(!1),e=c(!1);c(null);const h=c({}),d=c({}),k=c({}),x=c([]);c(!0);const v=c("");c(null);const y=c(!1),C=()=>{_.value=!1,e.value=!1};(()=>{H(l).then(t=>{d.value=JSON.parse(JSON.stringify(t)),n(d.value.items),I()})})();const n=t=>{let a=[];for(let i=0;i<t.length;i++)a[i]=D(t[i]);x.value=a},w=(t,a)=>{h.value=t;for(let S=0;S<d.value.items.length;S++)d.value.items[S].selected=!1;d.value.items[a].selected=!0;let i=D(t);x.value=[i],k.value=i.destination},p=async()=>{navigator.geolocation&&(console.log("position 1"),navigator.geolocation.getCurrentPosition(t=>{k.value={lat:t.coords.latitude,lng:t.coords.longitude}},t=>{Q(t.message,5e3)}))};p();const I=()=>{for(let t=0;t<d.value.items.length;t++)d.value.items[t].active=v.value.trim()?P(d.value.items[t]):1},P=t=>{let a=!!t.student_name.toLowerCase().includes(v.value.toLowerCase());return a||!!t.location_name.toLowerCase().includes(v.toLowerCase())},O=t=>{console.log("updated"),h.value=t,L("edit",t)},V=(t,a,i)=>{h.value=i,h.value.latitude=i.destination.lat,h.value.longitude=i.destination.lng,L("edit",h.value)},D=t=>(t.icon=f.conf.url+"uploads/images/blue_pin.gif",t.origin=t.destination={lat:parseFloat(t.latitude),lng:parseFloat(t.longitude)},t.drag=!0,t),L=(t,a)=>{switch(t){case"view":break;case"edit":e.value=!0,_.value=!1,h.value=a;break;case"delete":W("pickup_id",a,"PickupLocation.delete");break}};return{locations:x,showAddSide:_,showEditSide:e,url:l,content:d,center:k,activeItem:h,translate:N,clickMarker:V,updateMarker:O,setLocationsMarkers:w,checkSimilar:P,searchTextChanged:I,searchText:v,getUserLocation:p,collapsed:y,closeSide:C,handleAction:L}},props:["path","lang","setting","conf","auth"]},ne={class:"w-full flex overflow-auto",style:{height:"85vh","z-index":"9999"}},oe={class:"w-full"},le={key:0,class:"relative flex-1 overflow-x-hidden overflow-y-auto w-full"},se={class:"self-stretch py-4 flex-col justify-center items-start flex"},ae=["textContent"],ie=["textContent"],ce={key:0,class:"w-full self-stretch pt-2 flex-col justify-center items-start flex"},re=["placeholder"],de={key:0,class:"grow shrink basis-0 gap-4 justify-start items-center flex"},ue={class:"justify-start items-center flex"},he=["src"],fe=["onClick"],me=["textContent"],_e=["textContent"],xe={class:"justify-center items-center flex"},ve=["onClick"],ge={class:"text-center text-xs text-white uppercase tracking-tight"},ke={class:"flex self-stretch grow shrink basis-0 justify-between items-center inline-flex"},we=["textContent"],pe=["textContent"],be={class:"px-4 mb-6 py-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 flex w-full"},ye=["textContent"],Ce=o("hr",{class:"mt-2"},null,-1),Le={class:"w-full"},Se=["src"],je=["onClick"],Ae=["onClick"];function Te(f,l,_,e,h,d){const k=g("maps"),x=g("vue-feather"),v=g("delete_icon"),y=g("datatabble"),C=g("side-form-create"),E=g("side-form-update");return s(),u("div",ne,[o("div",oe,[e.content?(s(),u("main",le,[e.locations.length?(s(),b(k,{onUpdateMarker:e.updateMarker,onClickMarker:e.clickMarker,setting:_.setting,key:e.center,center:e.center,waypoints:e.locations,draggable:!0,showroute:!!e.activeItem},null,8,["onUpdateMarker","onClickMarker","setting","center","waypoints","showroute"])):r("",!0),e.content.items?(s(),u("div",{key:e.content.items,style:U(e.collapsed?"max-height:240px":"max-height:calc(100vh - 140px)"),class:"mx-16 h-full absolute top-4 rounded-lg p-4 w-96 bg-white rounded-xl flex-col justify-start items-start inline-flex"},[o("div",se,[o("div",{class:"text-black text-lg font-semibold",textContent:m(e.translate("Pickup locations"))},null,8,ae),o("div",{class:"py-2 self-stretch text-zinc-600 text-base tracking-wide",textContent:m(e.translate("Pickup locations description"))},null,8,ie)]),e.collapsed?r("",!0):(s(),u("div",ce,[R(o("input",{class:"w-full bg-gray-100 rounded-lg px-4 py-2",placeholder:e.translate("find by name and address"),"onUpdate:modelValue":l[0]||(l[0]=n=>e.searchText=n),onChange:l[1]||(l[1]=(...n)=>e.searchTextChanged&&e.searchTextChanged(...n)),onInput:l[2]||(l[2]=(...n)=>e.searchTextChanged&&e.searchTextChanged(...n)),onKeydown:l[3]||(l[3]=(...n)=>e.searchTextChanged&&e.searchTextChanged(...n))},null,40,re),[[J,e.searchText]])])),e.collapsed?r("",!0):(s(),u("div",{key:e.collapsed,class:"max-h-[400px] overflow-auto my-4 w-full self-stretch py-4"},[(s(!0),u(K,null,q(e.content.items,(n,w)=>(s(),u("div",{key:n,class:"pt-2 w-full self-stretch justify-start items-center inline-flex"},[n.active?(s(),u("div",de,[o("div",ue,[o("img",{class:"w-10 h-10 rounded-full shadow-inner border-2 border-black",src:n.student&&n.student.picture?n.student.picture:"https://via.placeholder.com/60x6"},null,8,he)]),o("div",{onClick:p=>e.setLocationsMarkers(n,w),class:"grow shrink basis-0 flex-col justify-center items-start gap-[3px] inline-flex cursor-pointer"},[o("div",{class:"text-black font-semibold text-base",textContent:m(n.student_name)},null,8,me),o("div",{class:"self-stretch text-slate-500 text-sm font-normal",textContent:m(n.location_name+" - "+n.address)},null,8,_e)],8,fe)])):r("",!0),o("div",xe,[o("div",{class:"px-3 py-2 bg-purple-800 rounded justify-center items-center flex mr-2 cursor-pointer",onClick:p=>e.handleAction("edit",n)},[o("div",ge,[j(x,{type:"edit"})])],8,ve)])]))),128))])),o("div",ke,[o("div",{class:"menu-dark rounded-lg text-white text-xs font-medium px-4 py-3 uppercase cursor-pointer",onClick:l[4]||(l[4]=n=>{f.showLoader=!0,e.showAddSide=!0,e.activeItem={},f.showLoader=!1}),textContent:m(e.translate("add new"))},null,8,we),o("div",{onClick:l[5]||(l[5]=n=>e.collapsed=!e.collapsed),class:"cursor-pointer p-2 block text-center"},[o("i",{class:G(["fa",e.collapsed?"fa-circle-down":"fa-circle-up"])},null,2),o("p",{class:"font-semibold",textContent:m(e.collapsed?e.translate("Expand"):e.translate("Collapse"))},null,8,pe)])])],4)):r("",!0),o("div",be,[o("h1",{class:"font-bold text-lg w-full",textContent:m(e.content.title)},null,8,ye),o("a",{href:"javascript:;",class:"uppercase p-2 mx-2 text-center text-white w-32 rounded-lg menu-dark hover:bg-purple-800",onClick:l[6]||(l[6]=n=>{f.showLoader=!0,e.showAddSide=!0,e.activeItem={},f.showLoader=!1})},m(e.translate("add_new")),1)]),Ce,o("div",Le,[e.content.columns?(s(),b(y,{key:0,"body-text-direction":e.translate("lang")=="ar"?"right":"left","fixed-checkbox":"",headers:e.content.columns,items:e.content.items},{"item-picture":A(n=>[o("img",{src:n.picture,class:"w-8 h-8 rounded-full"},null,8,Se)]),"item-edit":A(n=>[n.not_editable?r("",!0):(s(),u("button",{key:0,class:"p-2 hover:text-gray-600 text-purple",onClick:w=>e.handleAction("edit",n)},[j(x,{type:"edit"})],8,je))]),"item-delete":A(n=>[n.not_removeable?r("",!0):(s(),u("button",{key:0,class:"p-2 hover:text-gray-600 text-purple",onClick:w=>e.handleAction("delete",n)},[j(v,{class:"w-4"})],8,Ae))]),_:1},8,["body-text-direction","headers","items"])):r("",!0),e.showAddSide&&e.content&&e.content.fillable?(s(),b(C,{key:1,onCallback:e.closeSide,conf:_.conf,model:"PickupLocation.create",columns:e.content.fillable,class:"col-md-3"},null,8,["onCallback","conf","columns"])):r("",!0),e.showEditSide&&!e.showAddSide?(s(),b(E,{key:2,onCallback:e.closeSide,conf:_.conf,model:"PickupLocation.update",item:e.activeItem,model_id:e.activeItem.pickup_id,index:"pickup_id",columns:e.content.fillable,class:"col-md-3"},null,8,["onCallback","conf","item","model_id","columns"])):r("",!0)])])):r("",!0)])])}const Ie=F(te,[["render",Te]]);export{Ie as default};
function __vite__mapDeps(indexes) {
  if (!__vite__mapDeps.viteFileDeps) {
    __vite__mapDeps.viteFileDeps = ["assets/map-7CRy-bEv.js","assets/index.es-IRGPZQkN.js","assets/index-XViUBfli.js","assets/index-2HpYNNBE.css","assets/side-form-create-tHJd69DT.js","assets/Field-pL4rT6Zp.js","assets/Field-Cgf44v6b.css","assets/side-form-update-YXmVECoA.js"]
  }
  return indexes.map((i) => __vite__mapDeps.viteFileDeps[i])
}