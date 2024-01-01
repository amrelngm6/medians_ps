import{M as f,L as u}from"./Manager-FhIT0IWy.js";import{_ as m,k as d,r as y,o as t,c as r,a as l,d as n,t as _,j as p}from"./index-IHeQRtxj.js";const c={name:"vue-medialibrary-field",components:{"vue-medialibrary-manager":f,"app-medialibrary-loader":u},props:{name:{type:String,required:!1},api_url:{type:String,required:!1},filepath:{type:Object|String,required:!1,default:()=>({})},types:{type:Object,required:!1,default:()=>({images:!0,files:!0})},filetypes:{type:Array,required:!1,default:()=>[]},helper:{type:String,required:!1}},setup(e){console.log(e.filepath),d(),d(),d()}},b={class:"media-library-field"},g=["name","value"],v={key:1,class:"media-library-field__selector"},h={class:"media-library-field__selected__inner"},w={class:"w-full"},k=["src"],S={class:"block w-full"},q={class:"w-full flex",style:{margin:"2rem -0.5rem 0 -0.5rem"}},C={style:{"flex-grow":"1",padding:"0 0.5rem"}},L={style:{"flex-grow":"1",padding:"0 0.5rem"}};function M(e,i,a,B,F,j){const o=y("vue-medialibrary-manager");return t(),r("div",null,[l("div",b,[e.file?(t(),r("input",{key:e.file,name:a.name,type:"hidden",value:e.file},null,8,g)):n("",!0),e.content==null?(t(),r("div",v,[l("span",{onClick:i[0]||(i[0]=(...s)=>e.showLibrary&&e.showLibrary(...s)),class:"media-library-field__selector__button"},"Attach "+_(a.types.images&&a.types.files?"file":a.types.images&&!a.types.files?"image":"file"),1)])):n("",!0),e.file&&e.content?(t(),r("div",{key:e.file,class:"media-library-field__selected"},[l("div",h,[l("div",w,[l("div",null,[l("img",{src:e.file,style:{width:"auto",height:"auto","max-width":"180px"}},null,8,k)]),l("div",S,[l("div",q,[l("div",C,[l("span",{class:"media-library-field__selected__inner__details__button font-semibold",onClick:i[1]||(i[1]=(...s)=>e.showLibrary&&e.showLibrary(...s))},"Edit")]),l("div",L,[l("button",{onClick:i[2]||(i[2]=(...s)=>e.clear&&e.clear(...s)),class:"media-library-field__selected__inner__details__button media-library-field__selected__inner__details__button--delete"},"Remove")])])])])])])):n("",!0)]),e.showManager?(t(),p(o,{key:e.showManager,api_url:a.api_url,filetypes:a.filetypes,types:a.types,selected:e.value,selectable:!0,onClose:i[3]||(i[3]=s=>(e.showManager=!1,e.file=e.content=e.value)),onSelect:e.insert,onFailToFind:e.clear},null,8,["api_url","filetypes","types","selected","onSelect","onFailToFind"])):n("",!0)])}const N=m(c,[["render",M]]);export{N as f};
