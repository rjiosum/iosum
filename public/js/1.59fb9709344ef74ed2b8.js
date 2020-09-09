(window.webpackJsonp=window.webpackJsonp||[]).push([[1],{11:function(t,e,r){var a=r(36);"string"==typeof a&&(a=[[t.i,a,""]]);var s={hmr:!0,transform:void 0,insertInto:void 0};r(8)(a,s);a.locals&&(t.exports=a.locals)},16:function(t,e,r){"use strict";r.r(e);var a=r(3),s=r.n(a),i=r(22),o=r(13),n=r(2),l={name:"AppCard",props:{avatar:{type:String,default:""},color:{type:String,default:"secondary"},icon:{type:String,default:void 0},image:{type:Boolean,default:!1},text:{type:String,default:""},title:{type:String,default:""}}},c=(r(35),r(1)),u=Object(c.a)(l,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("v-card",t._b({staticClass:"v-card--base pa-3"},"v-card",t.$attrs,!1),[r("div",{staticClass:"d-flex grow flex-wrap"},[t.avatar?r("v-avatar",{staticClass:"mx-auto v-card--base__avatar elevation-6",attrs:{size:"128",color:"grey"}},[r("v-img",{attrs:{src:t.avatar}})],1):r("v-sheet",{staticClass:"text-start v-card--base__heading mb-n6",class:{"pa-7":!t.$slots.image},attrs:{color:t.color,"max-height":t.icon?90:void 0,width:t.icon?"auto":"100%",elevation:"6",dark:""}},[t.$slots.heading?t._t("heading"):t.$slots.image?t._t("image"):t.title&&!t.icon?r("div",{staticClass:"display-1 font-weight-light",domProps:{textContent:t._s(t.title)}}):t.icon?r("v-icon",{attrs:{size:"32"},domProps:{textContent:t._s(t.icon)}}):t._e(),t._v(" "),t.text?r("div",{staticClass:"headline font-weight-thin",domProps:{textContent:t._s(t.text)}}):t._e()],2),t._v(" "),t.$slots["after-heading"]?r("div",{staticClass:"ml-6"},[t._t("after-heading")],2):t.icon&&t.title?r("div",{staticClass:"ml-4"},[r("div",{staticClass:"card-title font-weight-light",domProps:{textContent:t._s(t.title)}})]):t._e()],1),t._v(" "),t._t("default"),t._v(" "),t.$slots.actions?[r("v-divider",{staticClass:"mt-2"}),t._v(" "),r("v-card-actions",{staticClass:"pb-0"},[t._t("actions")],2)]:t._e()],2)}),[],!1,null,"764009ae",null).exports;function d(t,e){var r=Object.keys(t);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(t);e&&(a=a.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),r.push.apply(r,a)}return r}function p(t){for(var e=1;e<arguments.length;e++){var r=null!=arguments[e]?arguments[e]:{};e%2?d(Object(r),!0).forEach((function(e){m(t,e,r[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(r)):d(Object(r)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(r,e))}))}return t}function m(t,e,r){return e in t?Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}):t[e]=r,t}function v(t,e,r,a,s,i,o){try{var n=t[i](o),l=n.value}catch(t){return void r(t)}n.done?e(l):Promise.resolve(l).then(a,s)}var f={name:"AppLogin",mixins:[i.validationMixin],validations:{form:{email:{required:o.required,email:o.email},password:{required:o.required}}},components:{AppCard:u},data:function(){return{showPassword:!1,form:{email:null,password:null,remember:!1},submitted:!1}},methods:{login:function(){var t,e=this;return(t=s.a.mark((function t(){return s.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:if(e.$v.$touch(),!e.$v.$invalid){t.next=3;break}return t.abrupt("return");case 3:return e.submitted=!0,t.prev=4,t.next=7,e.$store.dispatch("auth/login",e.form);case 7:if(!t.sent.data.status){t.next=17;break}return t.next=11,e.$store.dispatch("notify/setNotice",{msg:"Successfully logged in.",color:"success",icon:"mdi-check-circle"});case 11:if(!e.$route.query.redirect){t.next=15;break}return t.next=14,e.$router.replace(e.$route.query.redirect);case 14:return t.abrupt("return");case 15:return t.next=17,e.$router.replace({name:"dashboard"});case 17:t.next=22;break;case 19:t.prev=19,t.t0=t.catch(4),e.submitted=!1;case 22:case"end":return t.stop()}}),t,null,[[4,19]])})),function(){var e=this,r=arguments;return new Promise((function(a,s){var i=t.apply(e,r);function o(t){v(i,a,s,o,n,"next",t)}function n(t){v(i,a,s,o,n,"throw",t)}o(void 0)}))})()}},computed:p(p({},Object(n.c)({errors:"errors/errors"})),{},{emailErrors:function(){var t=[];return this.$v.form.email.$dirty?(!this.$v.form.email.email&&t.push("Must be valid e-mail"),!this.$v.form.email.required&&t.push("E-mail is required"),this.errors.email&&t.push(this.errors.email[0]),t):t},passwordErrors:function(){var t=[];return this.$v.form.password.$dirty?(!this.$v.form.password.required&&t.push("Password is required"),this.errors.password&&t.push(this.errors.password[0]),t):t}})},h=Object(c.a)(f,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("v-container",{staticClass:"fill-height",attrs:{fluid:""}},[r("v-row",{attrs:{"no-gutters":"",align:"center",justify:"center"}},[r("v-col",{attrs:{cols:"12",sm:"8",md:"4"}},[r("v-form",{on:{submit:function(e){return e.preventDefault(),t.login(e)}}},[r("AppCard",{staticClass:"px-5 py-3 mx-auto",attrs:{"max-width":"374"},scopedSlots:t._u([{key:"heading",fn:function(){return[r("div",{staticClass:"display-1 font-weight-bold text-center"},[t._v("\n                            Login\n                        ")]),t._v(" "),r("div",{staticClass:"subtitle-1 font-weight-light text-center"},[t._v("\n                            Please enter your credentials\n                        ")])]},proxy:!0},{key:"actions",fn:function(){return[r("v-spacer"),t._v(" "),r("v-btn",{staticClass:"tile blue white--text",attrs:{type:"submit",loading:t.submitted,disabled:t.submitted}},[t._v("Login\n                        ")])]},proxy:!0}])},[t._v(" "),r("v-card-text",[r("v-text-field",{staticClass:"pt-lg-10 pt-md-10 pt-sm-5",attrs:{color:"purple",label:"E-mail",placeholder:"Enter your e-mail",type:"email",name:"email","prepend-icon":"mdi-email-outline","error-messages":t.emailErrors},on:{input:function(e){return t.$v.form.email.$touch()},blur:function(e){return t.$v.form.email.$touch()}},model:{value:t.form.email,callback:function(e){t.$set(t.form,"email","string"==typeof e?e.trim():e)},expression:"form.email"}}),t._v(" "),r("v-text-field",{staticClass:"pt-lg-10 pt-md-10 pt-sm-5",attrs:{color:"purple",label:"Password",placeholder:"Enter your password",type:t.showPassword?"text":"password",name:"password","prepend-icon":"mdi-lock-open","append-icon":t.showPassword?"mdi-eye":"mdi-eye-off","error-messages":t.passwordErrors},on:{"click:append":function(e){t.showPassword=!t.showPassword},input:function(e){return t.$v.form.password.$touch()},blur:function(e){return t.$v.form.password.$touch()}},model:{value:t.form.password,callback:function(e){t.$set(t.form,"password","string"==typeof e?e.trim():e)},expression:"form.password"}}),t._v(" "),r("v-switch",{staticClass:"pt-5",attrs:{color:"purple",label:"Stay signed in"},model:{value:t.form.remember,callback:function(e){t.$set(t.form,"remember",e)},expression:"form.remember"}})],1)],1)],1)],1)],1)],1)}),[],!1,null,null,null);e.default=h.exports},35:function(t,e,r){"use strict";var a=r(11);r.n(a).a},36:function(t,e,r){(t.exports=r(7)(!1)).push([t.i,".v-card--base .v-sheet[data-v-764009ae]{border-radius:4px}.v-card--base__heading[data-v-764009ae]{position:relative;top:-40px;transition:.3s ease;z-index:1}.v-card--base__avatar[data-v-764009ae]{position:relative;top:-64px;margin-bottom:-32px}",""])}}]);