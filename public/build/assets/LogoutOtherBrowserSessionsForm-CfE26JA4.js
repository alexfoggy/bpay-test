import{d as p,T as v,o as a,c as k,w as e,g as r,e as n,F as x,h as b,a as o,t as c,f as V,b as l,u as i,C as B,n as C}from"./app-S8s7hA22.js";import{_ as S}from"./ActionMessage-DQbdJu00.js";import{a as L,b as A}from"./DialogModal-O3UjEFHP.js";import{_ as O,a as $}from"./TextInput-BjWpfhaX.js";import{_ as w}from"./PrimaryButton-cdHXZaTG.js";import{_ as H}from"./SecondaryButton-FcYHK48B.js";import"./SectionTitle-DTL7y-IA.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const F=o("div",{class:"max-w-xl text-sm text-gray-600"}," If necessary, you may log out of all of your other browser sessions across all of your devices. Some of your recent sessions are listed below; however, this list may not be exhaustive. If you feel your account has been compromised, you should also update your password. ",-1),I={key:0,class:"mt-5 space-y-6"},M={key:0,class:"w-8 h-8 text-gray-500",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor"},N=o("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25"},null,-1),T=[N],U={key:1,class:"w-8 h-8 text-gray-500",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor"},j=o("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3"},null,-1),D=[j],E={class:"ms-3"},K={class:"text-sm text-gray-600"},P={class:"text-xs text-gray-500"},z={key:0,class:"text-green-500 font-semibold"},q={key:1},G={class:"flex items-center mt-5"},J={class:"mt-4"},ts={__name:"LogoutOtherBrowserSessionsForm",props:{sessions:Array},setup(_){const d=p(!1),u=p(null),t=v({password:""}),g=()=>{d.value=!0,setTimeout(()=>u.value.focus(),250)},f=()=>{t.delete(route("other-browser-sessions.destroy"),{preserveScroll:!0,onSuccess:()=>m(),onError:()=>u.value.focus(),onFinish:()=>t.reset()})},m=()=>{d.value=!1,t.reset()};return(Q,h)=>(a(),k(L,null,{title:e(()=>[r(" Browser Sessions ")]),description:e(()=>[r(" Manage and log out your active sessions on other browsers and devices. ")]),content:e(()=>[F,_.sessions.length>0?(a(),n("div",I,[(a(!0),n(x,null,b(_.sessions,(s,y)=>(a(),n("div",{key:y,class:"flex items-center"},[o("div",null,[s.agent.is_desktop?(a(),n("svg",M,T)):(a(),n("svg",U,D))]),o("div",E,[o("div",K,c(s.agent.platform?s.agent.platform:"Unknown")+" - "+c(s.agent.browser?s.agent.browser:"Unknown"),1),o("div",null,[o("div",P,[r(c(s.ip_address)+", ",1),s.is_current_device?(a(),n("span",z,"This device")):(a(),n("span",q,"Last active "+c(s.last_active),1))])])])]))),128))])):V("",!0),o("div",G,[l(w,{onClick:g},{default:e(()=>[r(" Log Out Other Browser Sessions ")]),_:1}),l(S,{on:i(t).recentlySuccessful,class:"ms-3"},{default:e(()=>[r(" Done. ")]),_:1},8,["on"])]),l(A,{show:d.value,onClose:m},{title:e(()=>[r(" Log Out Other Browser Sessions ")]),content:e(()=>[r(" Please enter your password to confirm you would like to log out of your other browser sessions across all of your devices. "),o("div",J,[l(O,{ref_key:"passwordInput",ref:u,modelValue:i(t).password,"onUpdate:modelValue":h[0]||(h[0]=s=>i(t).password=s),type:"password",class:"mt-1 block w-3/4",placeholder:"Password",autocomplete:"current-password",onKeyup:B(f,["enter"])},null,8,["modelValue"]),l($,{message:i(t).errors.password,class:"mt-2"},null,8,["message"])])]),footer:e(()=>[l(H,{onClick:m},{default:e(()=>[r(" Cancel ")]),_:1}),l(w,{class:C(["ms-3",{"opacity-25":i(t).processing}]),disabled:i(t).processing,onClick:f},{default:e(()=>[r(" Log Out Other Browser Sessions ")]),_:1},8,["class","disabled"])]),_:1},8,["show"])]),_:1}))}};export{ts as default};
