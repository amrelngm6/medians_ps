import{_ as g,E as v,l as C,r as k,o as l,c as d,a as s,t as m,b as w,F as p,i as f,w as c,v as b,d as o,V,n as U,y as S,H as A,W as B,j as h}from"./index-u5rrQCNL.js";import{f as D}from"./Field-WjCoQn2J.js";import"./Manager-3d0CjzwP.js";const M={components:{"vue-medialibrary-field":D,close_icon:v},props:["columns","model","model_id","item","index","conf"],emits:["callback"],setup(y,{emit:n}){return console.log(y.item),{file:"",isInput:r=>{switch(r){case"text":case"number":case"email":case"time":case"date":case"phone":case"number":case"":return!0}return!1},setActiveStatus:(r,u)=>{r[u]=!r[u]},emitClose:r=>{r&&n("callback",r)},itemData:y.item,translate:C}}},F={class:"sidebar-create-form"},I={class:"p-4 rounded-lg shadow-lg bg-white dark:bg-gray-700"},N={action:"/api/update",method:"POST","data-refresh":"1",id:"add-device-form",class:"action py-0 m-auto rounded-lg max-w-xl pb-10"},z={class:"w-full flex"},E=["textContent"],P=["value"],T={class:"py-1 w-full"},j=["name","onUpdate:modelValue"],q={key:1,class:"w-full"},H=["textContent"],L=["name","type","placeholder","onUpdate:modelValue"],O=["name","type","placeholder"],W=["onClick"],G=["textContent"],J=["onUpdate:modelValue","name"],K=["name","placeholder","onUpdate:modelValue"],Q=["onUpdate:modelValue","name","type","placeholder"],R=["textContent"],X=["value","textContent"],Y=["textContent"];function Z(y,n,t,i,x,r){const u=k("close_icon"),_=k("vue-medialibrary-field");return l(),d("div",F,[s("div",I,[s("form",N,[s("div",z,[s("h1",{class:"w-full m-auto max-w-xl text-base mb-10",textContent:m(i.translate("update"))},null,8,E),s("span",{class:"cursor-pointer py-1 px-2",onClick:n[0]||(n[0]=(...e)=>i.emitClose&&i.emitClose(...e))},[w(u)])]),s("input",{name:"type",type:"hidden",value:t.model},null,8,P),t.columns?(l(!0),d(p,{key:0},f(t.columns,e=>(l(),d("div",T,[t.model_id&&e&&e.column_type=="hidden"?c((l(),d("input",{key:0,name:"params["+e.key+"]",type:"hidden","onUpdate:modelValue":a=>t.item[e.key]=a},null,8,j)),[[b,t.item[e.key]]]):o("",!0),e?(l(),d("div",q,[e.column_type!="hidden"?(l(),d("span",{key:0,class:"block mb-2",textContent:m(e.title)},null,8,H)):o("",!0),i.isInput(e.column_type)?c((l(),d("input",{key:1,autocomplete:"off",name:"params["+e.key+"]",type:e.column_type,class:"h-12 mb-3 rounded w-full border px-3 text-gray-700 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",placeholder:e.title,"onUpdate:modelValue":a=>t.item[e.key]=a},null,8,L)),[[V,t.item[e.key]]]):o("",!0),e.column_type=="password"?(l(),d("input",{key:2,autocomplete:"off",name:"params["+e.key+"]",type:e.column_type,class:"h-12 mb-3 rounded w-full border px-3 text-gray-700 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",placeholder:e.title},null,8,O)):o("",!0),e.column_type=="checkbox"?(l(),d("div",{key:3,class:"py-4 flex gap gap-2 cursor-pointer",onClick:a=>i.setActiveStatus(t.item,e.key)},[s("span",{class:U([t.item[e.key]?"":"bg-inverse-dark","mx-2 mt-1 bg-red-400 block h-4 relative rounded-full w-8"]),style:{direction:"ltr"}},[s("a",{class:"absolute bg-white block h-4 relative right-0 rounded-full w-4",style:S({left:t.item[e.key]?"16px":0})},null,4)],2),s("span",{textContent:m(t.item[e.key]?i.translate("Active"):i.translate("Pending")),class:"font-semibold inline-flex items-center px-2 py-1 rounded-full text-xs font-medium"},null,8,G),c(s("input",{"onUpdate:modelValue":a=>t.item[e.key]=a,type:"checkbox",class:"hidden",name:"params["+e.key+"]"},null,8,J),[[A,t.item[e.key]]])],8,W)):o("",!0),e.column_type=="textarea"?c((l(),d("textarea",{key:4,name:"params["+e.key+"]",type:"text",rows:"4",class:"mt-3 rounded-lg w-full border px-3 text-gray-700 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",placeholder:e.title,"onUpdate:modelValue":a=>t.item[e.key]=a},null,8,K)),[[b,t.item[e.key]]]):o("",!0),e.data&&e.column_type=="select"?c((l(),d("select",{key:5,"onUpdate:modelValue":a=>t.item[e.key]=a,name:"params["+e.key+"]",type:e.column_type,class:"h-12 mb-3 rounded w-full border px-3 text-gray-700 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",placeholder:e.title},[e.required?o("",!0):(l(),d("option",{key:0,value:"0",textContent:m(i.translate("select")+" "+e.title)},null,8,R)),(l(!0),d(p,null,f(e.data,a=>(l(),d("option",{value:a[e.column_key?e.column_key:e.key],textContent:m(a[e.text_key])},null,8,X))),256))],8,Q)),[[B,t.item[e.key]]]):o("",!0),e.column_type=="file"?(l(),h(_,{key:t.item,name:"params["+e.key+"]",modelValue:t.item.picture,"onUpdate:modelValue":n[1]||(n[1]=a=>t.item.picture=a),api_url:t.conf.url},null,8,["name","modelValue","api_url"])):o("",!0),e.column_type=="profile_image"?(l(),h(_,{key:t.item,name:"params["+e.key+"]",filepath:t.item.profile_image,modelValue:t.item.profile_image,"onUpdate:modelValue":n[2]||(n[2]=a=>t.item.profile_image=a),api_url:t.conf.url},null,8,["name","filepath","modelValue","api_url"])):o("",!0)])):o("",!0)]))),256)):o("",!0),s("button",{class:"uppercase h-12 mt-3 text-white w-full rounded bg-red-700 hover:bg-red-800",textContent:m(i.translate("save"))},null,8,Y)])])])}const ae=g(M,[["render",Z]]);export{ae as default};
