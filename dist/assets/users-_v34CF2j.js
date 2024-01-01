import{_ as k,k as m,l as S,r as x,o,c as l,a as t,t as s,F as g,i as p,d,j as w,p as b,q as A,s as E,u as I,x as U,n as N,y as O,z as y}from"./index-XNSx3kSo.js";const P=b(()=>y(()=>import("./side-form-create-v6VBTtoM.js"),__vite__mapDeps([0,1,2,3,4,5]))),R=b(()=>y(()=>import("./side-form-update-_rTDR2xC.js"),__vite__mapDeps([6,1,2,3,4,5]))),V={components:{SideFormCreate:P,SideFormUpdate:R},name:"Users",setup(c){const r=c.conf.url+c.path+"?load=json",a=m(!1),e=m(!1),f=m({}),u=m({});return(()=>{A(r).then(n=>{u.value=JSON.parse(JSON.stringify(n))})})(),{url:r,showAddSide:a,showEditSide:e,content:u,activeItem:f,setActiveStatus:n=>{n.active=!n.active;var _=new URLSearchParams;_.append("type","User.updateStatus"),_.append("params",JSON.stringify(n)),E(_,"/api/update").then(C=>{I(C.result)})},closeSide:()=>{a.value=!1,e.value=!1},translate:S}},props:["path","lang","setting","conf","auth"]},z={class:"w-full flex overflow-auto",style:{height:"85vh","z-index":"9999"}},B={class:"w-full"},F={key:0,class:"flex-1 overflow-x-hidden overflow-y-auto w-full"},L={class:"px-4 mb-6 py-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 flex w-full"},T=["textContent"],j=t("hr",{class:"mt-2"},null,-1),q={class:"w-full flex gap gap-6"},D={class:"w-full pb-4"},J={class:"pb-b flex gap-4"},G=["textContent"],H=["textContent"],K=t("hr",null,null,-1),M={class:"w-full grid lg:grid-cols-3 gap gap-6"},Q={class:"flex-shrink-0"},W={class:"relative"},X=t("div",{class:"absolute inset-0 rounded-full shadow-inner","aria-hidden":"true"},null,-1),Y=["src"],Z={class:"flex-grow w-full"},$={class:"text-lg font-medium text-gray-900"},ee=["textContent"],te=["textContent"],ne={class:"text-center"},oe=["onClick"],se=["textContent"],le=["textContent","onClick"];function ae(c,r,a,e,f,u){const h=x("side-form-create"),v=x("side-form-update");return o(),l("div",z,[t("div",B,[e.content?(o(),l("main",F,[t("div",L,[t("h1",{class:"font-bold text-lg w-full",textContent:s(e.content.title)},null,8,T),t("a",{href:"javascript:;",class:"menu-dark uppercase p-2 mx-2 text-center text-white w-32 rounded bg-gradient-purple hover:bg-red-800",onClick:r[0]||(r[0]=i=>{e.showAddSide=!0,e.activeItem={}})},s(e.translate("add_new")),1)]),j,t("div",q,[e.content&&e.content.users?(o(),l("div",{key:e.content.users,class:"w-full"},[(o(!0),l(g,null,p(e.content.roles,i=>(o(),l("div",D,[t("h3",J,[t("span",{textContent:s(i.name)},null,8,G),U(),t("span",{class:"pt-2 text-sm text-muted",textContent:s(i.id>1?e.translate("Theese users can manage your account only"):"")},null,8,H)]),K,t("div",M,[c.user&&i&&c.user.role_id==i.id?(o(!0),l(g,{key:0},p(e.content.users,n=>(o(),l("div",{key:n,class:"mb-2 rounded-lg flex items-center space-x-4 gap gap-4 bg-white p-4"},[t("div",Q,[t("div",W,[X,t("img",{class:"relative w-12 h-12 rounded-full",src:n.photo,alt:"User avatar"},null,8,Y)])]),t("div",Z,[t("div",$,s(n.first_name)+" "+s(n.last_name),1),t("div",{class:"text-sm font-medium text-gray-500",textContent:s(n.phone)},null,8,ee),t("div",{class:"text-sm font-medium text-gray-500",textContent:s(n.email)},null,8,te)]),t("div",ne,[t("div",{class:"flex gap gap-2 cursor-pointer",onClick:_=>e.setActiveStatus(n)},[t("span",{class:N([n.active?"":"bg-inverse-dark","mt-1 bg-red-400 block h-4 relative rounded-full w-8"]),style:{direction:"ltr"}},[t("a",{class:"absolute bg-white block h-4 relative right-0 rounded-full w-4",style:O({left:n.active?"16px":0})},null,4)],2),t("span",{textContent:s(n.active?e.translate("Active"):e.translate("Pending")),class:"font-semibold inline-flex items-center px-2 py-1 rounded-full text-xs font-medium"},null,8,se)],8,oe),n.id==a.auth.id||a.auth.role_id==1?(o(),l("span",{key:0,textContent:s(e.translate("edit")),class:"hover:bg-purple-800 hover:text-gray-100 my-2 inline-flex items-center px-6 py-1 rounded-full text-xs pb-2 font-medium bg-blue-100 text-blue-800 cursor-pointer",onClick:_=>{e.showEditSide=!0,e.showAddSide=!1,e.activeItem=n}},null,8,le)):d("",!0)])]))),128)):d("",!0)])]))),256))])):d("",!0),e.showAddSide&&e.content&&e.content.fillable?(o(),w(h,{key:1,onCallback:e.closeSide,conf:a.conf,model:"User.create",columns:e.content.fillable,class:"col-md-3"},null,8,["onCallback","conf","columns"])):d("",!0),e.showEditSide&&!e.showAddSide?(o(),w(v,{key:2,onCallback:e.closeSide,conf:a.conf,model:"User.update",item:e.activeItem,model_id:e.activeItem.id,index:"id",columns:e.content.fillable,class:"col-md-3"},null,8,["onCallback","conf","item","model_id","columns"])):d("",!0)])])):d("",!0)])])}const de=k(V,[["render",ae]]);export{de as default};
function __vite__mapDeps(indexes) {
  if (!__vite__mapDeps.viteFileDeps) {
    __vite__mapDeps.viteFileDeps = ["assets/side-form-create-v6VBTtoM.js","assets/index-XNSx3kSo.js","assets/index-OY3wY1QZ.css","assets/Field-5VAcoa3E.js","assets/Manager-qpORHTju.js","assets/Manager-Cgf44v6b.css","assets/side-form-update-_rTDR2xC.js"]
  }
  return indexes.map((i) => __vite__mapDeps.viteFileDeps[i])
}