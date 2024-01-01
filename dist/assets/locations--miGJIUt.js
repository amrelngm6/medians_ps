import{_ as D,D as V,p as B,q as a,s as F,r as g,o as l,c as d,a as o,j as y,d as i,l as O,t as u,w as z,v as N,F as U,i as R,n as q,u as L,x as A,y as J,z as K,A as G,b as H,B as S}from"./index-w-6AEFoM.js";import{c as Q,r as W}from"./car-l5uZXfN2.js";const X=A(()=>S(()=>import("./map-BJsBYScb.js"),__vite__mapDeps([0,1,2]))),Y=A(()=>S(()=>import("./side-form-create-PXdwRsvk.js"),__vite__mapDeps([3,1,2,4,5,6]))),Z=A(()=>S(()=>import("./side-form-update-jTAh0_Qv.js"),__vite__mapDeps([7,1,2,4,5,6]))),$={components:{datatabble:V,SideFormCreate:Y,SideFormUpdate:Z,maps:X,delete_icon:B,car_icon:Q,route_icon:W},name:"Locations",setup(f){const s=f.conf.url+f.path+"?load=json",h=a(!1),e=a(!1);a(null);const k=a({}),c=a({}),p=a({}),x=a([]);a(!0);const m=a("");a(null);const b=a(!1),C=()=>{h.value=!1,e.value=!1};(()=>{J(s).then(t=>{c.value=JSON.parse(JSON.stringify(t)),x.value=c.value.items,T()})})();const v=(t,r)=>{k.value=t;for(let _=0;_<c.value.items.length;_++)c.value.items[_].selected=!1;c.value.items[r].selected=!0,x.value=I(t)},w=async()=>{navigator.geolocation&&(console.log("position 1"),navigator.geolocation.getCurrentPosition(t=>{p.value={lat:t.coords.latitude,lng:t.coords.longitude}},t=>{K(t.message,5e3)}))};w();const T=()=>{for(let t=0;t<c.value.items.length;t++)c.value.items[t].active=m.value.trim()?j(c.value.items[t]):1},j=t=>{let r=!!t.student_name.toLowerCase().includes(m.value.toLowerCase());return r||!!t.location_name.toLowerCase().includes(m.toLowerCase())},E=(t,r,_)=>{t.latitude=t.destination.lat,t.longitude=t.destination.lng,M("edit",t)},P=(t,r,_)=>{console.log(t),console.log(r),console.log(_)},I=t=>(t.icon=this.conf.url+"uploads/images/blue_pin.gif",t.origin=t.destination={lat:parseFloat(t.latitude),lng:parseFloat(t.longitude)},t.drag=!0,t),M=(t,r)=>{switch(t){case"view":break;case"edit":e=!0,h=!1,k.value=r;break;case"delete":G("pickup_id",r,"PickupLocation.delete");break}};return{locations:x,showAddSide:h,showEditSide:e,url:s,content:c,center:p,activeItem:k,translate:F,clickMarker:P,updateMarker:E,setLocationsMarkers:v,checkSimilar:j,searchTextChanged:T,searchText:m,getUserLocation:w,collapsed:b,closeSide:C,handleAction:M}},props:["path","lang","setting","conf","auth"]},ee={class:"w-full flex overflow-auto",style:{height:"85vh","z-index":"9999"}},te={class:"w-full"},ne={key:0,class:"relative flex-1 overflow-x-hidden overflow-y-auto w-full"},oe={class:"self-stretch py-4 flex-col justify-center items-start flex"},se=["textContent"],le=["textContent"],ae={key:0,class:"w-full self-stretch pt-2 flex-col justify-center items-start flex"},ie=["placeholder"],ce={key:0,class:"grow shrink basis-0 gap-4 justify-start items-center flex"},re={class:"justify-start items-center flex"},de=["src"],ue=["onClick"],fe=["textContent"],he=["textContent"],me={class:"justify-center items-center flex"},_e=["onClick"],xe=o("div",{class:"text-center text-xs text-white uppercase tracking-tight"},[o("i",{class:"fa fa-edit"})],-1),ve=[xe],ge={class:"flex self-stretch grow shrink basis-0 justify-between items-center inline-flex"},ke=["textContent"],pe=["textContent"],we={class:"px-4 mb-6 py-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 flex w-full"},ye=["textContent"],be=o("hr",{class:"mt-2"},null,-1),Ce={class:"w-full"},Le=["src"],Ae=["onClick"],Se=o("i",{class:"fa fa-edit"},null,-1),Te=[Se],je=["onClick"];function Me(f,s,h,e,k,c){const p=g("maps"),x=g("delete_icon"),m=g("datatabble"),b=g("side-form-create"),C=g("side-form-update");return l(),d("div",ee,[o("div",te,[e.content?(l(),d("main",ne,[e.locations.length?(l(),y(p,{onUpdateMarker:e.updateMarker,onClickMarker:e.clickMarker,setting:h.setting,key:e.center,center:e.center,waypoints:e.locations},null,8,["onUpdateMarker","onClickMarker","setting","center","waypoints"])):i("",!0),e.content.items?(l(),d("div",{key:e.content.items,style:O(e.collapsed?"max-height:240px":"max-height:calc(100vh - 140px)"),class:"mx-16 h-full absolute top-4 rounded-lg p-4 w-96 bg-white rounded-xl flex-col justify-start items-start inline-flex"},[o("div",oe,[o("div",{class:"text-black text-lg font-semibold",textContent:u(e.translate("Pickup locations"))},null,8,se),o("div",{class:"py-2 self-stretch text-zinc-600 text-base tracking-wide",textContent:u(e.translate("Pickup locations description"))},null,8,le)]),e.collapsed?i("",!0):(l(),d("div",ae,[z(o("input",{class:"w-full bg-gray-100 rounded-lg px-4 py-2",placeholder:e.translate("find by name and address"),"onUpdate:modelValue":s[0]||(s[0]=n=>e.searchText=n),onChange:s[1]||(s[1]=(...n)=>e.searchTextChanged&&e.searchTextChanged(...n)),onInput:s[2]||(s[2]=(...n)=>e.searchTextChanged&&e.searchTextChanged(...n)),onKeydown:s[3]||(s[3]=(...n)=>e.searchTextChanged&&e.searchTextChanged(...n))},null,40,ie),[[N,e.searchText]])])),e.collapsed?i("",!0):(l(),d("div",{key:e.collapsed,class:"max-h-[400px] overflow-auto my-4 w-full self-stretch py-4"},[(l(!0),d(U,null,R(e.content.items,(n,v)=>(l(),d("div",{key:n,class:"pt-2 w-full self-stretch justify-start items-center inline-flex"},[n.active?(l(),d("div",ce,[o("div",re,[o("img",{class:"w-10 h-10 rounded-full shadow-inner border-2 border-black",src:n.student&&n.student.picture?n.student.picture:"https://via.placeholder.com/60x6"},null,8,de)]),o("div",{onClick:w=>e.setLocationsMarkers(n,v),class:"grow shrink basis-0 flex-col justify-center items-start gap-[3px] inline-flex cursor-pointer"},[o("div",{class:"text-black font-semibold text-base",textContent:u(n.student_name)},null,8,fe),o("div",{class:"self-stretch text-slate-500 text-sm font-normal",textContent:u(n.location_name+" - "+n.address)},null,8,he)],8,ue)])):i("",!0),o("div",me,[o("div",{class:"px-3 py-2 bg-purple-800 rounded justify-center items-center flex mr-2 cursor-pointer",onClick:w=>e.handleAction("edit",n)},ve,8,_e)])]))),128))])),o("div",ge,[o("div",{class:"menu-dark rounded-lg text-white text-xs font-medium px-4 py-3 uppercase cursor-pointer",onClick:s[4]||(s[4]=n=>{f.showLoader=!0,e.showAddSide=!0,e.activeItem={},f.showLoader=!1}),textContent:u(e.translate("add new"))},null,8,ke),o("div",{onClick:s[5]||(s[5]=n=>e.collapsed=!e.collapsed),class:"cursor-pointer p-2 block text-center"},[o("i",{class:q(["fa",e.collapsed?"fa-circle-down":"fa-circle-up"])},null,2),o("p",{class:"font-semibold",textContent:u(e.collapsed?e.translate("Expand"):e.translate("Collapse"))},null,8,pe)])])],4)):i("",!0),o("div",we,[o("h1",{class:"font-bold text-lg w-full",textContent:u(e.content.title)},null,8,ye),o("a",{href:"javascript:;",class:"uppercase p-2 mx-2 text-center text-white w-32 rounded-lg menu-dark hover:bg-purple-800",onClick:s[6]||(s[6]=n=>{f.showLoader=!0,e.showAddSide=!0,e.activeItem={},f.showLoader=!1})},u(e.translate("add_new")),1)]),be,o("div",Ce,[e.content.columns?(l(),y(m,{key:0,"body-text-direction":e.translate("lang")=="ar"?"right":"left","fixed-checkbox":"",headers:e.content.columns,items:e.content.items},{"item-picture":L(n=>[o("img",{src:n.picture,class:"w-8 h-8 rounded-full"},null,8,Le)]),"item-edit":L(n=>[n.not_editable?i("",!0):(l(),d("button",{key:0,class:"p-2 hover:text-gray-600 text-purple",onClick:v=>e.handleAction("edit",n)},Te,8,Ae))]),"item-delete":L(n=>[n.not_removeable?i("",!0):(l(),d("button",{key:0,class:"p-2 hover:text-gray-600 text-purple",onClick:v=>e.handleAction("delete",n)},[H(x,{class:"w-4"})],8,je))]),_:1},8,["body-text-direction","headers","items"])):i("",!0),e.showAddSide&&e.content&&e.content.fillable?(l(),y(b,{key:1,conf:h.conf,model:"PickupLocation.create",columns:e.content.fillable,class:"col-md-3"},null,8,["conf","columns"])):i("",!0),e.showEditSide&&!e.showAddSide?(l(),y(C,{key:2,conf:h.conf,model:"PickupLocation.update",item:e.activeItem,model_id:e.activeItem.pickup_id,index:"pickup_id",columns:e.content.fillable,class:"col-md-3"},null,8,["conf","item","model_id","columns"])):i("",!0)])])):i("",!0)])])}const Ie=D($,[["render",Me]]);export{Ie as default};
function __vite__mapDeps(indexes) {
  if (!__vite__mapDeps.viteFileDeps) {
    __vite__mapDeps.viteFileDeps = ["assets/map-BJsBYScb.js","assets/index-w-6AEFoM.js","assets/index-OY3wY1QZ.css","assets/side-form-create-PXdwRsvk.js","assets/Field-2WvHGT3u.js","assets/Manager-gvCQgiAB.js","assets/Manager-Cgf44v6b.css","assets/side-form-update-jTAh0_Qv.js"]
  }
  return indexes.map((i) => __vite__mapDeps.viteFileDeps[i])
}