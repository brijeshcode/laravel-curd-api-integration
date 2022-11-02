import{C as h,D as n,o as u,c as P,w as i,k as w,b as a,a as o,g as m,e as p,i as k,F as v,t as s}from"./app.79716c88.js";import{_ as C}from"./Layout.cf0fad28.js";import{P as T,T as U,a as A}from"./TableHeader.353c5797.js";import{F as D,a as F}from"./FilterPanel.93a8f960.js";import{S as B,c as L}from"./Input.26b790f6.js";import{c as H,a as N,b as S}from"./Radio.87fd97ab.js";import{_ as $}from"./_plugin-vue_export-helper.cdc0426e.js";import"./ResponsiveNavLink.0c8e3015.js";const I=h({components:{AdminLayout:C,Pagination:T,THeader:U,TableActions:A,FilterPanel:D,FilterIcon:F,SimpleButton:B,cInput:L,cSelect:H,cRadio:N,cArea:S},props:["properties","propertyTypes"],data:()=>({edit:!1,tdkeys:["#","name","note","active"],breadcrums:[{name:"Api Properties"}],tableHeads:["#","County","Country","Town","Address","Postalcode","bedrooms","bathrooms","price","for","type"],actionsLinks:[{title:"Refresh",route:"admin.properties.api_refresh",icon:"add"}],filter:{property_type_id:null,county:null,country:null,postcode:null,town:null,description:null,address:null,num_bedrooms:null,num_bathrooms:null,price:null,for:"sale"}}),created(){route().params.filter==1&&(Object.keys(this.filter).forEach(t=>{this.filter[t]=route().params[t]}),this.filter.filter=route().params.filter)},methods:{filterData(){w.Inertia.get(route("admin.properties.api"),this.filter,{preserveState:!0,replace:!0})}}}),z=o("h2",{class:"font-semibold text-xl text-gray-800 leading-tight"}," Properties Populated By Api's ",-1),E={class:"filter-control p-4"},R={class:"py-2"},j={class:"bg-white overflow-hidden shadow-lg p-2 sm:rounded-lg"},q={class:"table-auto min-w-full divide-y divide-gray-200"},O={class:"bg-white divide-y divide-gray-200 text-xs text-gray-500"},G=["href"],J=["src"],K={class:"capitalize"},M={class:"capitalize"};function Q(t,l,W,X,Y,Z){const r=n("c-input"),d=n("c-select"),f=n("c-radio"),b=n("simple-button"),c=n("filterPanel"),y=n("t-header"),V=n("Pagination"),_=n("admin-layout");return u(),P(_,{title:"Properties",breadcrums:t.breadcrums,actionsLinks:t.actionsLinks},{header:i(()=>[z]),filtersData:i(()=>[a(c,{showFilter:"true"},{default:i(()=>[a(r,{type:"text",label:"County",modelValue:t.filter.county,"onUpdate:modelValue":l[0]||(l[0]=e=>t.filter.county=e)},null,8,["modelValue"]),a(r,{type:"text",label:"Country",modelValue:t.filter.country,"onUpdate:modelValue":l[1]||(l[1]=e=>t.filter.country=e)},null,8,["modelValue"]),a(r,{type:"text",label:"Town",modelValue:t.filter.town,"onUpdate:modelValue":l[2]||(l[2]=e=>t.filter.town=e)},null,8,["modelValue"]),a(r,{type:"text",label:"Postcode",modelValue:t.filter.postcode,"onUpdate:modelValue":l[3]||(l[3]=e=>t.filter.postcode=e)},null,8,["modelValue"]),a(r,{type:"text",label:"Address",modelValue:t.filter.address,"onUpdate:modelValue":l[4]||(l[4]=e=>t.filter.address=e)},null,8,["modelValue"]),a(d,{label:"Number of bedrooms",modelValue:t.filter.num_bedrooms,"onUpdate:modelValue":l[5]||(l[5]=e=>t.filter.num_bedrooms=e),options:["1","2","3","4","5","6"]},null,8,["modelValue"]),a(d,{label:"Number of bathrooms",modelValue:t.filter.num_bathrooms,"onUpdate:modelValue":l[6]||(l[6]=e=>t.filter.num_bathrooms=e),options:["1","2","3","4","5","6"]},null,8,["modelValue"]),a(r,{type:"number",label:"Price",modelValue:t.filter.price,"onUpdate:modelValue":l[7]||(l[7]=e=>t.filter.price=e)},null,8,["modelValue"]),a(d,{label:"Property Type",modelValue:t.filter.property_type_id,"onUpdate:modelValue":l[8]||(l[8]=e=>t.filter.property_type_id=e),queryData:"",dataText:"title",options:t.propertyTypes},null,8,["modelValue","options"]),a(f,{label:"For",modelValue:t.filter.for,"onUpdate:modelValue":l[9]||(l[9]=e=>t.filter.for=e),name:"for",radios:{sale:"sale",rent:"rent"}},null,8,["modelValue"]),o("div",E,[a(b,{onClick:t.filterData,class:"ml-4 hover:bg-indigo-800 bg-blue-500",type:"button"},{default:i(()=>[m("Filter")]),_:1},8,["onClick"])])]),_:1})]),default:i(()=>[o("div",R,[o("div",j,[o("table",q,[a(y,{tableHeads:t.tableHeads},null,8,["tableHeads"]),o("tbody",O,[(u(!0),p(v,null,k(t.properties.data,(e,g)=>(u(),p("tr",{key:e.uuid},[o("td",null,s(t.properties.from+g),1),o("td",null,[o("a",{href:e.image_full,target:"_blank"},[o("img",{src:e.image_thumbnail,class:"m-2 hover:cursor-zoom-in"},null,8,J)],8,G),m(" "+s(e.county),1)]),o("td",null,s(e.country),1),o("td",null,s(e.town),1),o("td",null,s(e.address),1),o("td",null,s(e.postcode),1),o("td",null,s(e.num_bedrooms),1),o("td",null,s(e.num_bathrooms),1),o("td",null,s(e.price),1),o("td",K,s(e.for),1),o("td",M,s(e.property_type.title),1)]))),128))])]),a(V,{pageData:t.properties,pageof:" Properties"},null,8,["pageData"])])])]),_:1},8,["breadcrums","actionsLinks"])}const re=$(I,[["render",Q]]);export{re as default};
