import{d as f}from"./data-table-actions-qdo5Klur.js";import{_ as w,A as v,y as k,s as b,r as d,o,c,a as n,j as h,d as r,l as y,t as a,w as C,v as T,F as j,i as L,n as S,b as A,m as D}from"./index-w-6AEFoM.js";const I={components:{dataTableActions:f},name:"Destinations",data(){return{url:this.conf.url+this.path+"?load=json",content:{title:"",items:[],columns:[]},destinations:[],activeItem:{},showAddSide:!1,showEditSide:!1,showLoader:!0,collapsed:!1,searchText:""}},computed:{bindings(){return this.content.columns.push({key:this.__("actions"),component:f,sortable:!1}),{columns:this.content.columns,fillable:this.content.fillable,data:this.content.items}}},props:["path","lang","setting","conf","auth"],mounted(){this.load()},methods:{searchTextChanged(){this.showList=!1;for(let e=0;e<this.content.items.length;e++)this.content.items[e].active=this.searchText.trim()?this.checkSimilar(this.content.items[e]):1;this.showList=!0},checkSimilar(e){let s=!!e.student_name.toLowerCase().includes(this.searchText.toLowerCase());return s||!!e.location_name.toLowerCase().includes(this.searchText.toLowerCase())},updatedDestination(e,s){e.latitude=e.destination.lat,e.longitude=e.destination.lng,this.handleAction("edit",e),console.log(e)},setDestinationsMarkers(e){this.destinations=[this.handleObject(e)],this.center=this.destinations[0].destination},handleAction(e,s){switch(e){case"view":break;case"edit":this.showEditSide=!0,this.showAddSide=!1,this.activeItem=s;break;case"delete":v("destination_id",s,"Destination.delete");break}},load(){this.showLoader=!0,k(this.url).then(e=>{this.setValues(e),this.showLoader=!1,this.searchTextChanged()})},setValues(e){this.content=JSON.parse(JSON.stringify(e));for(let s=0;s<this.content.items.length;s++)this.destinations[s]=this.handleObject(this.content.items[s]);return this.center=this.destinations[0]?this.destinations[0].destination:{lat:30,lng:31},this},handleObject(e){return e.icon=this.conf.url+"uploads/images/blue_pin.gif",e.origin=e.destination={lat:parseFloat(e.latitude),lng:parseFloat(e.longitude)},e.drag=!0,e},__(e){return b(e)}}},M={class:"w-full flex overflow-auto",style:{height:"85vh","z-index":"9999"}},V={class:"w-full"},B={key:0,class:"relative flex-1 overflow-x-hidden overflow-y-auto w-full"},E={class:"self-stretch py-4 flex-col justify-center items-start flex"},N=["textContent"],O=["textContent"],z={key:0,class:"w-full self-stretch pt-2 flex-col justify-center items-start flex"},F=["placeholder"],U={key:0,class:"grow shrink basis-0 gap-4 justify-start items-center flex"},J={class:"justify-start items-center flex"},K=["src"],q=["onClick"],G=["textContent"],P=["textContent"],R={class:"justify-center items-center flex"},H=["onClick"],Q=n("div",{class:"text-center text-xs text-white uppercase tracking-tight"},[n("i",{class:"fa fa-edit"})],-1),W=[Q],X={class:"flex self-stretch grow shrink basis-0 justify-between items-center inline-flex"},Y=["textContent"],Z=["textContent"],$={class:"px-4 mb-6 py-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 flex w-full"},ee=["textContent"],te=n("hr",{class:"mt-2"},null,-1),se={class:"w-full flex gap gap-6"};function ne(e,s,u,ie,t,l){const m=d("maps"),x=d("data-table"),_=d("side-form-create"),p=d("side-form-update");return o(),c("div",M,[n("div",V,[t.content&&!t.showLoader?(o(),c("main",B,[t.destinations.length?(o(),h(m,{showroute:!1,onUpdateMarker:l.updatedDestination,onClickMarker:l.updatedDestination,key:e.center,center:e.center,waypoints:t.destinations},null,8,["onUpdateMarker","onClickMarker","center","waypoints"])):r("",!0),t.destinations.length?(o(),c("div",{key:1,style:y(t.collapsed?"max-height:240px":"max-height:calc(100vh - 140px)"),class:"mx-16 h-full absolute top-4 rounded-lg p-4 w-96 bg-white rounded-xl flex-col justify-start items-start inline-flex"},[n("div",E,[n("div",{class:"text-black text-lg font-semibold",textContent:a(l.__("Destinations"))},null,8,N),n("div",{class:"py-2 self-stretch text-zinc-600 text-base tracking-wide",textContent:a(l.__("Destinations description"))},null,8,O)]),t.collapsed?r("",!0):(o(),c("div",z,[C(n("input",{class:"w-full bg-gray-100 rounded-lg px-4 py-2",placeholder:l.__("find by name and address"),"onUpdate:modelValue":s[0]||(s[0]=i=>t.searchText=i),onChange:s[1]||(s[1]=(...i)=>l.searchTextChanged&&l.searchTextChanged(...i)),onInput:s[2]||(s[2]=(...i)=>l.searchTextChanged&&l.searchTextChanged(...i)),onKeydown:s[3]||(s[3]=(...i)=>l.searchTextChanged&&l.searchTextChanged(...i))},null,40,F),[[T,t.searchText]])])),t.collapsed?r("",!0):(o(),c("div",{key:t.collapsed,class:"max-h-[400px] overflow-auto my-4 w-full self-stretch py-4"},[e.showList&&e.destination.active?(o(!0),c(j,{key:0},L(t.content.items,i=>(o(),c("div",{key:i.active,class:"pt-2 w-full self-stretch justify-start items-center inline-flex"},[i.active?(o(),c("div",U,[n("div",J,[n("img",{class:"w-10 h-10 rounded-full shadow-inner border-2 border-black",src:i.student&&i.student.picture?i.student.picture:"https://via.placeholder.com/60x6"},null,8,K)]),n("div",{onClick:g=>l.setDestinationsMarkers(i),class:"grow shrink basis-0 flex-col justify-center items-start gap-[3px] inline-flex cursor-pointer"},[n("div",{class:"text-black font-semibold text-base",textContent:a(i.student_name)},null,8,G),n("div",{class:"self-stretch text-slate-500 text-sm font-normal",textContent:a(i.location_name+" - "+i.address)},null,8,P)],8,q)])):r("",!0),n("div",R,[n("div",{class:"px-3 py-2 bg-purple-800 rounded justify-center items-center flex mr-2 cursor-pointer",onClick:g=>l.handleAction("edit",i)},W,8,H)])]))),128)):r("",!0)])),n("div",X,[n("div",{class:"menu-dark rounded-lg text-white text-xs font-medium px-4 py-3 uppercase cursor-pointer",onClick:s[4]||(s[4]=i=>{t.showLoader=!0,t.showAddSide=!0,t.activeItem={},t.showLoader=!1}),textContent:a(l.__("add new"))},null,8,Y),n("div",{onClick:s[5]||(s[5]=i=>t.collapsed=!t.collapsed),class:"cursor-pointer p-2 block text-center"},[n("i",{class:S(["fa",t.collapsed?"fa-circle-down":"fa-circle-up"])},null,2),n("p",{class:"font-semibold",textContent:a(t.collapsed?l.__("Expand"):l.__("Collapse"))},null,8,Z)])])],4)):r("",!0),n("div",$,[n("h1",{class:"font-bold text-lg w-full",textContent:a(t.content.title)},null,8,ee),n("a",{href:"javascript:;",class:"uppercase p-2 mx-2 text-center text-white w-32 rounded-lg menu-dark hover:bg-purple-800",onClick:s[6]||(s[6]=i=>{t.showLoader=!0,t.showAddSide=!0,t.activeItem={},t.showLoader=!1})},a(l.__("add_new")),1)]),te,n("div",se,[A(x,D({ref:"destinations",onActionTriggered:l.handleAction},l.bindings),null,16,["onActionTriggered"]),t.showAddSide&&t.content&&t.content.fillable?(o(),h(_,{key:0,conf:u.conf,model:"Destination.create",columns:t.content.fillable,class:"col-md-3"},null,8,["conf","columns"])):r("",!0),t.showEditSide&&!t.showAddSide?(o(),h(p,{key:1,conf:u.conf,model:"Destination.update",item:t.activeItem,model_id:t.activeItem.destination_id,index:"destination_id",columns:t.content.fillable,class:"col-md-3"},null,8,["conf","item","model_id","columns"])):r("",!0)])])):r("",!0)])])}const re=w(I,[["render",ne]]);export{re as default};