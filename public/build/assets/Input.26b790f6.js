import{_ as l}from"./_plugin-vue_export-helper.cdc0426e.js";import{C as p,o as s,e as a,r as y,l as x,v as $,a as _,t as o,g as c,f as n,D as f,c as m,w as v,E as g}from"./app.79716c88.js";const k=p({props:{type:{type:String,default:"submit"}}}),q=["type"];function C(e,r,t,i,d,u){return s(),a("button",{type:e.type,class:"inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"},[y(e.$slots,"default")],8,q)}const O=l(k,[["render",C]]),w=p({props:["message"]}),B={class:"text-xs text-red-600"};function V(e,r,t,i,d,u){return x((s(),a("div",null,[_("p",B,o(e.message),1)],512)),[[$,e.message]])}const I=l(w,[["render",V]]),N=p({props:{value:String,required:{type:Boolean,default:!1}}}),T={class:"block font-medium text-xs text-gray-700"},D={key:0},E={key:0,class:"text-xs text-red-600"},F={key:1},L={key:0,class:"text-xs text-red-600"};function P(e,r,t,i,d,u){return s(),a("label",T,[e.value?(s(),a("span",D,[c(o(e.value)+" ",1),e.required?(s(),a("span",E,"*")):n("",!0)])):(s(),a("span",F,[y(e.$slots,"default"),c(),e.required?(s(),a("span",L,"*")):n("",!0)]))])}const j=l(N,[["render",P]]),z={components:{InputError:I,FormLabel:j},props:{modelValue:{type:[Number,String],required:!1,default:""},type:{type:String,required:!0,default:"text"},name:{type:String,required:!1,default:""},placeholder:{type:String,required:!1,default:""},label:{type:String,required:!1,default:""},hint:{type:String,required:!1,default:"hint"},validation:{type:String,default:""},error:{type:Boolean,default:!1},errmsg:{type:String,default:""},helpText:{type:String,default:""},iclass:{type:String,required:!1,default:""},lableClass:{type:String,required:!1,default:""},inputStyle:{type:String,required:!1,default:""}},data(){return{show:!1}},methods:{inputChange(e){console.log(e),this.$emit("update:modelValue",e)}}},A={class:"control"},G=["value","type","name","placeholder"],H=["textContent"];function J(e,r,t,i,d,u){const h=f("form-label"),b=f("input-error");return s(),a("div",A,[t.label?(s(),m(h,g({key:0,class:t.lableClass},e.$attrs),{default:v(()=>[c(o(t.label),1)]),_:1},16,["class"])):n("",!0),_("input",g(e.$attrs,{value:t.modelValue,onInput:r[0]||(r[0]=S=>e.$emit("update:modelValue",S.target.value)),type:t.type,name:t.name,placeholder:t.placeholder,class:[t.iclass,"border-gray-300 focus:border-indigo-300 mt-1 w-full focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"],style:t.inputStyle}),null,16,G),t.helpText?(s(),a("span",{key:1,class:"text-gray-500",textContent:o(t.helpText)},null,8,H)):n("",!0),t.error||t.errmsg?(s(),m(b,{key:2,message:t.errmsg,class:"mt-2"},null,8,["message"])):n("",!0)])}const Q=l(z,[["render",J]]);export{j as F,I,O as S,Q as c};
