import{_ as V,D as B,p as F,q as c,s as z,r as w,o as s,c as u,a as o,j as p,d as r,l as N,t as h,w as U,v as R,F as q,i as J,n as K,u as A,x as j,y as G,z as H,A as Q,b as W,B as T}from"./index-AJTdRqJD.js";import{c as X,r as Y}from"./car-eA-BnWme.js";const Z=j(()=>T(()=>import("./map-SzoB5oDw.js"),__vite__mapDeps([0,1,2]))),$=j(()=>T(()=>import("./side-form-create-gve6dt9W.js"),__vite__mapDeps([3,1,2,4,5,6]))),ee=j(()=>T(()=>import("./side-form-update-i7W9vVsX.js"),__vite__mapDeps([7,1,2,4,5,6]))),te={components:{datatabble:B,SideFormCreate:$,SideFormUpdate:ee,maps:Z,delete_icon:F,car_icon:X,route_icon:Y},name:"Locations",setup(f){const l=f.conf.url+f.path+"?load=json",m=c(!1),e=c(!1);c(null);const _=c({}),d=c({}),v=c({}),g=c([]);c(!0);const x=c("");c(null);const b=c(!1),y=()=>{m.value=!1,e.value=!1};(()=>{G(l).then(t=>{d.value=JSON.parse(JSON.stringify(t)),k(d.value.items),E()})})();const k=t=>{let a=[];for(let i=0;i<t.length;i++)a[i]=I(t[i]);g.value=a},C=(t,a)=>{_.value=t;for(let S=0;S<d.value.items.length;S++)d.value.items[S].selected=!1;d.value.items[a].selected=!0;let i=I(t);g.value=[i],v.value=i.destination},M=async()=>{navigator.geolocation&&(console.log("position 1"),navigator.geolocation.getCurrentPosition(t=>{v.value={lat:t.coords.latitude,lng:t.coords.longitude}},t=>{H(t.message,5e3)}))};M();const E=()=>{for(let t=0;t<d.value.items.length;t++)d.value.items[t].active=x.value.trim()?P(d.value.items[t]):1},P=t=>{let a=!!t.student_name.toLowerCase().includes(x.value.toLowerCase());return a||!!t.location_name.toLowerCase().includes(x.toLowerCase())},D=(t,a,i)=>{t.latitude=t.destination.lat,t.longitude=t.destination.lng,L("edit",t)},O=(t,a,i)=>{console.log(t),console.log(a),console.log(i),_.value.latitude=i.latLng.lat(),_.value.longitude=i.latLng.lng(),L("edit",_.value)},I=t=>(t.icon=f.conf.url+"uploads/images/blue_pin.gif",t.origin=t.destination={lat:parseFloat(t.latitude),lng:parseFloat(t.longitude)},t.drag=!0,t),L=(t,a)=>{switch(t){case"view":break;case"edit":e.value=!0,m.value=!1,_.value=a;break;case"delete":Q("pickup_id",a,"PickupLocation.delete");break}};return{locations:g,showAddSide:m,showEditSide:e,url:l,content:d,center:v,activeItem:_,translate:z,clickMarker:O,updateMarker:D,setLocationsMarkers:C,checkSimilar:P,searchTextChanged:E,searchText:x,getUserLocation:M,collapsed:b,closeSide:y,handleAction:L}},props:["path","lang","setting","conf","auth"]},ne={class:"w-full flex overflow-auto",style:{height:"85vh","z-index":"9999"}},oe={class:"w-full"},le={key:0,class:"relative flex-1 overflow-x-hidden overflow-y-auto w-full"},se={class:"self-stretch py-4 flex-col justify-center items-start flex"},ae=["textContent"],ie=["textContent"],ce={key:0,class:"w-full self-stretch pt-2 flex-col justify-center items-start flex"},re=["placeholder"],de={key:0,class:"grow shrink basis-0 gap-4 justify-start items-center flex"},ue={class:"justify-start items-center flex"},fe=["src"],he=["onClick"],me=["textContent"],_e=["textContent"],xe={class:"justify-center items-center flex"},ve=["onClick"],ge=o("div",{class:"text-center text-xs text-white uppercase tracking-tight"},[o("i",{class:"fa fa-edit"})],-1),ke=[ge],we={class:"flex self-stretch grow shrink basis-0 justify-between items-center inline-flex"},pe=["textContent"],be=["textContent"],ye={class:"px-4 mb-6 py-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 flex w-full"},Ce=["textContent"],Le=o("hr",{class:"mt-2"},null,-1),Se={class:"w-full"},Ae=["src"],je=["onClick"],Te=o("i",{class:"fa fa-edit"},null,-1),Me=[Te],Ee=["onClick"];function Pe(f,l,m,e,_,d){const v=w("maps"),g=w("delete_icon"),x=w("datatabble"),b=w("side-form-create"),y=w("side-form-update");return s(),u("div",ne,[o("div",oe,[e.content?(s(),u("main",le,[e.locations.length?(s(),p(v,{onUpdateMarker:e.updateMarker,onClickMarker:e.clickMarker,setting:m.setting,key:e.center,center:e.center,waypoints:e.locations,showroute:!1},null,8,["onUpdateMarker","onClickMarker","setting","center","waypoints"])):r("",!0),e.content.items?(s(),u("div",{key:e.content.items,style:N(e.collapsed?"max-height:240px":"max-height:calc(100vh - 140px)"),class:"mx-16 h-full absolute top-4 rounded-lg p-4 w-96 bg-white rounded-xl flex-col justify-start items-start inline-flex"},[o("div",se,[o("div",{class:"text-black text-lg font-semibold",textContent:h(e.translate("Pickup locations"))},null,8,ae),o("div",{class:"py-2 self-stretch text-zinc-600 text-base tracking-wide",textContent:h(e.translate("Pickup locations description"))},null,8,ie)]),e.collapsed?r("",!0):(s(),u("div",ce,[U(o("input",{class:"w-full bg-gray-100 rounded-lg px-4 py-2",placeholder:e.translate("find by name and address"),"onUpdate:modelValue":l[0]||(l[0]=n=>e.searchText=n),onChange:l[1]||(l[1]=(...n)=>e.searchTextChanged&&e.searchTextChanged(...n)),onInput:l[2]||(l[2]=(...n)=>e.searchTextChanged&&e.searchTextChanged(...n)),onKeydown:l[3]||(l[3]=(...n)=>e.searchTextChanged&&e.searchTextChanged(...n))},null,40,re),[[R,e.searchText]])])),e.collapsed?r("",!0):(s(),u("div",{key:e.collapsed,class:"max-h-[400px] overflow-auto my-4 w-full self-stretch py-4"},[(s(!0),u(q,null,J(e.content.items,(n,k)=>(s(),u("div",{key:n,class:"pt-2 w-full self-stretch justify-start items-center inline-flex"},[n.active?(s(),u("div",de,[o("div",ue,[o("img",{class:"w-10 h-10 rounded-full shadow-inner border-2 border-black",src:n.student&&n.student.picture?n.student.picture:"https://via.placeholder.com/60x6"},null,8,fe)]),o("div",{onClick:C=>e.setLocationsMarkers(n,k),class:"grow shrink basis-0 flex-col justify-center items-start gap-[3px] inline-flex cursor-pointer"},[o("div",{class:"text-black font-semibold text-base",textContent:h(n.student_name)},null,8,me),o("div",{class:"self-stretch text-slate-500 text-sm font-normal",textContent:h(n.location_name+" - "+n.address)},null,8,_e)],8,he)])):r("",!0),o("div",xe,[o("div",{class:"px-3 py-2 bg-purple-800 rounded justify-center items-center flex mr-2 cursor-pointer",onClick:C=>e.handleAction("edit",n)},ke,8,ve)])]))),128))])),o("div",we,[o("div",{class:"menu-dark rounded-lg text-white text-xs font-medium px-4 py-3 uppercase cursor-pointer",onClick:l[4]||(l[4]=n=>{f.showLoader=!0,e.showAddSide=!0,e.activeItem={},f.showLoader=!1}),textContent:h(e.translate("add new"))},null,8,pe),o("div",{onClick:l[5]||(l[5]=n=>e.collapsed=!e.collapsed),class:"cursor-pointer p-2 block text-center"},[o("i",{class:K(["fa",e.collapsed?"fa-circle-down":"fa-circle-up"])},null,2),o("p",{class:"font-semibold",textContent:h(e.collapsed?e.translate("Expand"):e.translate("Collapse"))},null,8,be)])])],4)):r("",!0),o("div",ye,[o("h1",{class:"font-bold text-lg w-full",textContent:h(e.content.title)},null,8,Ce),o("a",{href:"javascript:;",class:"uppercase p-2 mx-2 text-center text-white w-32 rounded-lg menu-dark hover:bg-purple-800",onClick:l[6]||(l[6]=n=>{f.showLoader=!0,e.showAddSide=!0,e.activeItem={},f.showLoader=!1})},h(e.translate("add_new")),1)]),Le,o("div",Se,[e.content.columns?(s(),p(x,{key:0,"body-text-direction":e.translate("lang")=="ar"?"right":"left","fixed-checkbox":"",headers:e.content.columns,items:e.content.items},{"item-picture":A(n=>[o("img",{src:n.picture,class:"w-8 h-8 rounded-full"},null,8,Ae)]),"item-edit":A(n=>[n.not_editable?r("",!0):(s(),u("button",{key:0,class:"p-2 hover:text-gray-600 text-purple",onClick:k=>e.handleAction("edit",n)},Me,8,je))]),"item-delete":A(n=>[n.not_removeable?r("",!0):(s(),u("button",{key:0,class:"p-2 hover:text-gray-600 text-purple",onClick:k=>e.handleAction("delete",n)},[W(g,{class:"w-4"})],8,Ee))]),_:1},8,["body-text-direction","headers","items"])):r("",!0),e.showAddSide&&e.content&&e.content.fillable?(s(),p(b,{key:1,onCallback:e.closeSide,conf:m.conf,model:"PickupLocation.create",columns:e.content.fillable,class:"col-md-3"},null,8,["onCallback","conf","columns"])):r("",!0),e.showEditSide&&!e.showAddSide?(s(),p(y,{key:2,onCallback:e.closeSide,conf:m.conf,model:"PickupLocation.update",item:e.activeItem,model_id:e.activeItem.pickup_id,index:"pickup_id",columns:e.content.fillable,class:"col-md-3"},null,8,["onCallback","conf","item","model_id","columns"])):r("",!0)])])):r("",!0)])])}const Oe=V(te,[["render",Pe]]);export{Oe as default};
function __vite__mapDeps(indexes) {
  if (!__vite__mapDeps.viteFileDeps) {
    __vite__mapDeps.viteFileDeps = ["assets/map-SzoB5oDw.js","assets/index-AJTdRqJD.js","assets/index-OY3wY1QZ.css","assets/side-form-create-gve6dt9W.js","assets/Field-8McRTX_-.js","assets/Manager-RW5rTUO1.js","assets/Manager-Cgf44v6b.css","assets/side-form-update-i7W9vVsX.js"]
  }
  return indexes.map((i) => __vite__mapDeps.viteFileDeps[i])
}