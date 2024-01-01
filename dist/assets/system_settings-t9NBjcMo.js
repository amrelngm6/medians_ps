import{_ as x,l as r,k as u,r as f,o as n,c as l,a as t,t as s,x as _,b as v,d as c,w as d,H as k,v as h,F as w,i as C,n as S,q as T}from"./index-cv99Z1-V.js";import{f as P}from"./Field-OnJldh3T.js";import"./Manager-NzmN857K.js";const M={components:{"vue-medialibrary-field":P,translate:r},name:"Settings",setup(g){const a=g.conf.url+g.path+"?load=json",i=u({title:"",settings:[]}),e=[{title:r("Basic Details"),link:"basic"},{title:r("Notifications"),link:"notifications"},{title:r("SMTP setting"),link:"smtp"},{title:r("Google Map API"),link:"map"}];(()=>{T(a).then(o=>{i.value=JSON.parse(JSON.stringify(o))})})();const b=u("basic");return{url:a,content:i,switchTab:o=>{console.log(o),console.log(o.link),b.value=o.link},activeTab:b,translate:r,setting_tabs:e}},props:["path","lang","setting","conf","auth"]},E={class:"w-full flex overflow-auto",style:{height:"85vh","z-index":"9999"}},N={class:"w-full"},O={key:0,class:"flex-1 overflow-x-hidden overflow-y-auto w-full"},R={class:"px-4 mb-6 py-4 rounded-lg shadow-lg bg-white dark:bg-gray-700 flex w-full"},U=["textContent"],V=t("hr",{class:"mt-2"},null,-1),D={class:"w-full lg:flex gap gap-6"},j={class:"w-full mb-6"},A={key:0,action:"/api/update",method:"POST","data-refresh":"1",id:"add-device-form",class:"action py-0 m-auto rounded-lg pb-10"},B=t("input",{name:"type",type:"hidden",value:"SystemSettings.update"},null,-1),F={key:0,class:"w-full"},G={class:"card w-full"},H={class:"card-body pt-0"},I={class:"settings-form"},q={class:"block py-3"},L=["value"],z={class:"w-full block cursor-pointer"},J={class:"text-gray-700 w-20"},W=t("span",{class:"star-red"},"*",-1),K={class:"block py-3"},Q={class:"text-gray-700"},X=t("span",{class:"star-red"},"*",-1),Y=["placeholder","value"],Z={class:"block py-3"},$={class:"text-gray-700"},tt=t("span",{class:"star-red"},"*",-1),et=["value"],st=t("option",{value:"english"},"English",-1),ot=t("option",{value:"arabic"},"العربية",-1),at=[st,ot],nt={class:"w-full"},lt={class:"card"},rt={class:"card-body pt-0"},ct={class:"settings-form"},dt={class:"block py-3"},it=t("span",{class:"star-red"},"*",-1),_t=["value"],ht=["textContent"],gt=["textContent"],bt={key:1,class:"w-full"},pt={class:"card w-full"},ut={class:"card-header pt-0"},mt={class:"text-gray-700 font-semibold"},yt=["textContent"],xt={class:"card-body pt-0"},ft={class:"settings-form mt-2"},vt={class:"block pb-3"},kt={class:"text-gray-700"},wt=["textContent"],Ct=t("hr",null,null,-1),St={class:"block py-3"},Tt={class:"text-gray-700"},Pt=["textContent"],Mt=["placeholder"],Et={class:"block py-3"},Nt={class:"text-gray-700"},Ot=["textContent"],Rt=["placeholder"],Ut={class:"block py-3"},Vt={class:"text-gray-700"},Dt=["textContent"],jt=["placeholder"],At={key:2,class:"w-full"},Bt={class:"card w-full"},Ft={class:"card-header pt-0"},Gt={class:"text-gray-700 font-semibold"},Ht=["textContent"],It={class:"card-body pt-0"},qt={class:"settings-form mt-2"},Lt={class:"block pb-3"},zt={class:"text-gray-700"},Jt=["textContent"],Wt=["placeholder"],Kt=t("hr",null,null,-1),Qt={key:3,class:"w-full lg:flex gap-4"},Xt={class:"card w-full"},Yt={class:"card-header pt-0"},Zt={class:"text-gray-700 font-semibold"},$t=["textContent"],te={class:"card-body pt-0"},ee={class:"settings-form mt-2"},se={class:"block pb-3"},oe={class:"text-gray-700"},ae=["textContent"],ne=["placeholder","value"],le={class:"block py-3"},re={class:"text-gray-700"},ce=["textContent"],de=["placeholder","value"],ie={class:"block py-3"},_e={class:"text-gray-700"},he=["textContent"],ge=["placeholder"],be={class:"w-full"},pe={class:"card"},ue=t("div",{class:"card-header pt-0"},[t("span",{class:"text-gray-700 font-semibold"},[t("span")])],-1),me={class:"card-body pt-0"},ye={class:"settings-form"},xe={class:"block py-3"},fe={class:"text-gray-700"},ve=["textContent"],ke=["placeholder","value"],we={class:"block py-3"},Ce={class:"text-gray-700"},Se=["textContent"],Te=["placeholder","value"],Pe={class:"block py-3"},Me={class:"text-gray-700"},Ee=["value"],Ne=t("option",{value:"1"},"True",-1),Oe=t("option",{value:"0"},"False",-1),Re=[Ne,Oe],Ue={class:"uppercase mt-3 text-white mx-auto rounded-lg bg-purple-800 hover:bg-red-800 px-4 py-2"},Ve={class:"col-md-3"},De={class:"bg-white p-4 rounded-lg"},je=["onClick","textContent"];function Ae(g,a,i,e,m,b){const p=f("vue-medialibrary-field");return n(),l("div",E,[t("div",N,[e.content?(n(),l("main",O,[t("div",R,[t("h1",{class:"font-bold text-lg w-full",textContent:s(e.translate("settings"))},null,8,U)]),V,t("div",D,[t("div",j,[e.content.setting?(n(),l("form",A,[B,e.activeTab=="basic"?(n(),l("div",F,[t("div",G,[t("div",H,[t("div",I,[t("label",q,[t("input",{name:"params[logo]",type:"hidden",value:e.content.setting.logo},null,8,L),t("div",z,[t("span",J,[_(s(e.translate("Logo"))+" ",1),W]),v(p,{name:"params[logo]",api_url:i.conf.url,filepath:e.content.setting.logo},null,8,["api_url","filepath"])])]),t("label",K,[t("span",Q,[_(s(e.translate("Sitename"))+" ",1),X]),t("input",{name:"params[sitename]",type:"text",class:"h-10 mt-3 rounded w-full border px-3 text-gray-400 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",required:"",placeholder:e.translate("Sitename"),value:e.content.setting.sitename},null,8,Y)]),t("label",Z,[t("span",$,[_(s(e.translate("Language"))+" ",1),tt]),t("select",{class:"select h-10 mt-3 rounded w-full border px-3 text-gray-400 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",name:"params[lang]",value:e.content.setting.lang},at,8,et)])])])]),t("div",nt,[t("div",lt,[t("div",rt,[t("div",ct,[t("label",dt,[t("label",null,[_(s(e.translate("Enable debugging"))+" ",1),it]),t("select",{class:"select h-10 mt-3 rounded w-full border px-3 text-gray-400 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",name:"params[enable_debug]",value:e.content.setting.enable_debug},[t("option",{value:"1",textContent:s(e.translate("enabled"))},null,8,ht),t("option",{value:"0",textContent:s(e.translate("disabled"))},null,8,gt)],8,_t)])])])])])])):c("",!0),e.activeTab=="notifications"?(n(),l("div",bt,[t("div",pt,[t("div",ut,[t("span",mt,[t("span",{textContent:s(e.translate("notifications"))},null,8,yt)])]),t("div",xt,[t("div",ft,[t("label",vt,[t("span",kt,[t("span",{textContent:s(e.translate("enable_notifications"))},null,8,wt)]),d(t("input",{name:"params[enable_notifications]",type:"checkbox",class:"h-4 w-4 mx-4 p-2 rounded border px-3 text-gray-400 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",value:"1","onUpdate:modelValue":a[0]||(a[0]=o=>e.content.setting.enable_notifications=o)},null,512),[[k,e.content.setting.enable_notifications]])]),Ct,t("label",St,[t("span",Tt,[t("span",{textContent:s(e.translate("welcome_message_subject"))},null,8,Pt)]),d(t("input",{name:"params[welcome_message_subject]",type:"text",class:"h-10 mt-3 rounded w-full border px-3 text-gray-400 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",placeholder:e.translate("welcome_message_subject"),"onUpdate:modelValue":a[1]||(a[1]=o=>e.content.setting.welcome_message_subject=o)},null,8,Mt),[[h,e.content.setting.welcome_message_subject]])]),t("label",Et,[t("span",Nt,[t("span",{textContent:s(e.translate("welcome_message_icon"))},null,8,Ot)]),d(t("input",{name:"params[welcome_message_icon]",type:"text",class:"h-10 mt-3 rounded w-full border px-3 text-gray-400 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",placeholder:e.translate("welcome_message_icon"),"onUpdate:modelValue":a[2]||(a[2]=o=>e.content.setting.welcome_message_icon=o)},null,8,Rt),[[h,e.content.setting.welcome_message_icon]])]),t("label",Ut,[t("span",Vt,[t("span",{textContent:s(e.translate("welcome_message"))},null,8,Dt)]),d(t("textarea",{name:"params[notifications_welcome_message]",rows:"3",class:"mt-3 rounded w-full border px-3 text-gray-700 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",placeholder:e.translate("welcome_message"),"onUpdate:modelValue":a[3]||(a[3]=o=>e.content.setting.notifications_welcome_message=o)},null,8,jt),[[h,e.content.setting.notifications_welcome_message]])])])])])])):c("",!0),e.activeTab=="map"?(n(),l("div",At,[t("div",Bt,[t("div",Ft,[t("span",Gt,[t("span",{textContent:s(e.translate("Map"))},null,8,Ht)])]),t("div",It,[t("div",qt,[t("label",Lt,[t("span",zt,[t("span",{textContent:s(e.translate("Google Map API"))},null,8,Jt)]),d(t("input",{name:"params[google_map_api]",type:"text",class:"h-10 mt-3 rounded w-full border px-3 text-gray-400 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",placeholder:e.translate("Google Map API"),"onUpdate:modelValue":a[4]||(a[4]=o=>e.content.setting.google_map_api=o)},null,8,Wt),[[h,e.content.setting.google_map_api]])]),Kt])])])])):c("",!0),e.activeTab=="smtp"?(n(),l("div",Qt,[t("div",Xt,[t("div",Yt,[t("span",Zt,[t("span",{textContent:s(e.translate("SMTP_INFO"))},null,8,$t)])]),t("div",te,[t("div",ee,[t("label",se,[t("span",oe,[t("span",{textContent:s(e.translate("SMTP_SENDER"))},null,8,ae)]),t("input",{name:"params[smtp_sender]",type:"email",class:"h-10 mt-3 rounded w-full border px-3 text-gray-400 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",placeholder:e.translate("SMTP_SENDER"),value:e.content.setting.smtp_sender},null,8,ne)]),t("label",le,[t("span",re,[t("span",{textContent:s(e.translate("SMTP_USER"))},null,8,ce)]),t("input",{name:"params[smtp_user]",type:"text",class:"h-10 mt-3 rounded w-full border px-3 text-gray-400 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",placeholder:e.translate("SMTP_USER"),value:e.content.setting.smtp_user},null,8,de)]),t("label",ie,[t("span",_e,[t("span",{textContent:s(e.translate("SMTP_PASSWORD"))},null,8,he)]),t("input",{name:"params[smtp_password]",type:"text",class:"h-10 mt-3 rounded w-full border px-3 text-gray-400 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",placeholder:e.translate("SMTP_PASSWORD")},null,8,ge)])])])]),t("div",be,[t("div",pe,[ue,t("div",me,[t("div",ye,[t("label",xe,[t("span",fe,[t("span",{textContent:s(e.translate("SMTP_HOST"))},null,8,ve)]),t("input",{name:"params[smtp_host]",type:"text",class:"h-10 mt-3 rounded w-full border px-3 text-gray-400 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",placeholder:e.translate("SMTP_HOST"),value:e.content.setting.smtp_host},null,8,ke)]),t("label",we,[t("span",Ce,[t("span",{textContent:s(e.translate("SMTP_PORT"))},null,8,Se)]),t("input",{name:"params[smtp_port]",type:"number",class:"h-10 mt-3 rounded w-full border px-3 text-gray-400 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",placeholder:e.translate("SMTP_USER"),value:e.content.setting.smtp_port},null,8,Te)]),t("label",Pe,[t("span",Me,s(e.translate("SMTP_AUTH")),1),t("select",{class:"select h-10 mt-3 rounded w-full border px-3 text-gray-400 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600",name:"params[smtp_auth]",value:e.content.setting.smtp_auth},Re,8,Ee)])])])])])])):c("",!0),t("button",Ue,s(e.translate("Save")),1)])):c("",!0)]),t("div",Ve,[t("ul",De,[(n(!0),l(w,null,C(e.setting_tabs,(o,y)=>(n(),l("li",{class:S([o.link==e.activeTab?"font-bold":"","cursor-pointer py-2 px-1 border-b border-gray-200 py-2"]),key:y,onClick:Be=>e.switchTab(o),textContent:s(o.title)},null,10,je))),128))])])])])):c("",!0)])])}const Ie=x(M,[["render",Ae]]);export{Ie as default};
