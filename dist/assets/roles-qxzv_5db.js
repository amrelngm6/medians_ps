import{_ as C,q as d,s as A,r as g,o as a,c as r,j as p,d as h,a as t,t as c,F as S,i as E,k as I,x as b,B as w,y as R,A as B,C as D,z as L}from"./index-t5813cdR.js";const P=b(()=>w(()=>import("./side-form-create-N5BX_7H8.js"),__vite__mapDeps([0,1,2,3,4,5]))),j=b(()=>w(()=>import("./side-form-update-BclTC9_l.js"),__vite__mapDeps([6,1,2,3,4,5]))),O=b(()=>w(()=>import("./permissions-7GHFBG9B.js"),__vite__mapDeps([7,1,2]))),T={components:{SideFormCreate:P,SideFormUpdate:j,permissions:O},setup(u){const x=u.conf.url+u.path+"?load=json",s=d(!1),e=d(!1),l=d(null),f=d({}),_=d({title:"",items:[],columns:[]});(()=>{R(x).then(i=>{_.value=JSON.parse(JSON.stringify(i))})})();const v=()=>{s.value=!1,e.value=!1},o=i=>{console.log(i);var n=new URLSearchParams;n.append("type","Role.updatePermissions"),n.append("params",JSON.stringify(i)),D(n,"/api/update").then(y=>{L(y.result)})};return{showAddSide:s,showEditSide:e,url:x,content:_,activeItem:f,showDetails:l,closeSide:v,translate:A,handleAction:(i,n)=>{switch(console.log(i),i){case"view":e.value=!1,s.value=!1,l.value=!0,f.value=n;break;case"save":e.value=!1,s.value=!1,l.value=!0,o(n);break;case"edit":e.value=!0,l.value=!1,s.value=!1,f.value=n;break;case"delete":B("id",n,"Role.delete");break;case"close":e.value=!1,s.value=!1,l.value=!1;break}}}},props:["path","lang","setting","conf","auth"]},V={class:"w-full pb-20"},N={key:0,class:"relative w-full"},F={key:1,class:"px-4 flex-1 overflow-x-hidden overflow-y-auto w-full mb-20"},q={class:"px-4 mb-6 py-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 flex w-full"},J=["textContent"],U={class:"relative card ribbon-box border shadow-none mb-lg-0"},H={class:"card-body"},M=["textContent"],z=["textContent"],G={class:"ribbon-content mt-4 text-muted"},K=["innerHTML"],Q={class:"sm:grid sm:space-y-0 space-y-6 xl:!grid-cols-3 md:grid-cols-2 gap-6"},W={class:"box mb-0 overflow-hidden p-4 bg-white rounded-xl"},X={class:"box-body space-y-5"},Y={class:"flex"},Z={class:"sm:flex sm:space-x-3 sm:space-y-0 space-y-4 rtl:space-x-reverse"},$={class:"space-y-1 my-auto"},ee=["onClick","textContent"],te=["textContent"],se={class:"box-footer mt-6"},oe={class:"grid grid-cols-12 gap-x-3"},ne={class:"sm:col-span-2 col-span-4"},ae=["onClick"],ie=t("i",{class:"fa fa-eye py-1 px-2"},null,-1),le=[ie],ce=["onClick"],de={class:"cursor-pointer inline-flex !p-1 flex-shrink-0 justify-center items-center gap-2 w-full rounded-sm border font-medium bg-white text-gray-500 shadow-sm align-middle focus:outline-none focus:ring-0 focus:ring-offset-0 focus:ring-offset-white focus:ring-primary transition-all text-xs dark:bg-bgdark dark:border-white/10 dark:text-white/70 dark:focus:ring-offset-white/10"},re=t("i",{class:"fa fa-edit py-1"},null,-1),fe=["textContent"],_e={class:"sm:col-span-2 col-span-4"},me={class:"hs-dropdown ti-dropdown flex justify-end"},he=["onClick"],ue=t("i",{class:"fa fa-trash text-danger py-1 px-2"},null,-1),xe=[ue];function ve(u,x,s,e,l,f){const _=g("permissions"),k=g("side-form-update"),v=g("side-form-create");return a(),r("div",V,[e.showDetails?(a(),r("div",N,[(a(),p(_,{key:e.activeItem,item:e.activeItem,onSave:e.handleAction,onClose:e.handleAction,conf:s.conf},null,8,["item","onSave","onClose","conf"]))])):h("",!0),e.content&&!e.showDetails?(a(),r("main",F,[t("div",q,[t("h1",{class:"font-bold text-lg w-full",textContent:c(e.content.title)},null,8,J)]),t("div",U,[t("div",H,[t("div",{class:"ribbon ribbon-primary round-shape",textContent:c(e.translate("Important"))},null,8,M),t("h5",{class:"fs-14 text-end ml-20",textContent:c(e.translate("Before Create Account"))},null,8,z),t("div",G,[t("div",{class:"mb-0",innerHTML:e.translate("Before Create role note")},null,8,K)])])]),t("div",Q,[(a(!0),r(S,null,E(e.content.items,o=>(a(),r("div",W,[t("div",X,[t("div",Y,[t("div",Z,[t("div",$,[t("h5",{onClick:m=>e.handleAction("view",o),class:"cursor-pointer font-semibold text-base leading-none",textContent:c(o.name)},null,8,ee),t("p",{class:"text-gray-500 dark:text-white/70 font-semibold text-xs truncate max-w-[9rem]",textContent:c(e.translate("Users count")+o.users_count)},null,8,te)])])])]),t("div",se,[t("div",oe,[t("div",ne,[t("span",{onClick:m=>e.handleAction("view",o),class:"cursor-pointer inline-flex !p-1 flex-shrink-0 justify-center items-center gap-2 rounded-sm border font-medium bg-white text-gray-500 shadow-sm align-middle focus:outline-none focus:ring-0 focus:ring-offset-0 focus:ring-offset-white focus:ring-primary transition-all text-xs dark:bg-bgdark dark:border-white/10 dark:text-white/70 dark:focus:ring-offset-white/10"},le,8,ae)]),t("div",{onClick:m=>e.handleAction("edit",o),class:"sm:col-span-8 col-span-4"},[t("span",de,[re,I(),t("span",{class:"text-base",textContent:c(e.translate("Edit"))},null,8,fe)])],8,ce),t("div",_e,[t("div",me,[t("span",{onClick:m=>e.handleAction("delete",o),class:"cursor-pointer hs-dropdown-toggle ti-dropdown-toggle inline-flex !p-1 flex-shrink-0 justify-center items-center gap-2 rounded-sm border font-medium bg-white text-gray-500 shadow-sm align-middle focus:outline-none focus:ring-0 focus:ring-offset-0 focus:ring-offset-white focus:ring-primary transition-all text-xs dark:bg-bgdark dark:border-white/10 dark:text-white/70 dark:focus:ring-offset-white/10"},xe,8,he)])])])])]))),256))])])):h("",!0),e.showEditSide&&!e.showAddSide?(a(),p(k,{key:2,conf:s.conf,model:"Role.update",item:e.activeItem,model_id:e.activeItem.id,index:e.activeItem.id,columns:e.content.fillable,class:"col-md-3"},null,8,["conf","item","model_id","index","columns"])):h("",!0),e.showAddSide&&e.content&&e.content.fillable?(a(),p(v,{key:3,conf:s.conf,model:"Role.create",columns:e.content.fillable,class:"col-md-3"},null,8,["conf","columns"])):h("",!0)])}const pe=C(T,[["render",ve]]);export{pe as default};
function __vite__mapDeps(indexes) {
  if (!__vite__mapDeps.viteFileDeps) {
    __vite__mapDeps.viteFileDeps = ["assets/side-form-create-N5BX_7H8.js","assets/index-t5813cdR.js","assets/index-OY3wY1QZ.css","assets/Field-WZz81xnN.js","assets/Manager-tAowIZHr.js","assets/Manager-Cgf44v6b.css","assets/side-form-update-BclTC9_l.js","assets/permissions-7GHFBG9B.js"]
  }
  return indexes.map((i) => __vite__mapDeps.viteFileDeps[i])
}