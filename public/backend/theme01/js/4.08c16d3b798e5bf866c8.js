(window.webpackJsonp=window.webpackJsonp||[]).push([[4],{u3wA:function(t,e,r){"use strict";r.r(e);var n=r("L2JU");function c(t,e){var r=Object.keys(t);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(t);e&&(n=n.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),r.push.apply(r,n)}return r}function i(t){for(var e=1;e<arguments.length;e++){var r=null!=arguments[e]?arguments[e]:{};e%2?c(Object(r),!0).forEach((function(e){s(t,e,r[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(r)):c(Object(r)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(r,e))}))}return t}function s(t,e,r){return e in t?Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}):t[e]=r,t}var o={name:"Dashboard",data:function(){return{}},computed:i({},Object(n.c)({user:"auth/user",isAuthenticated:"auth/isAuthenticated"})),methods:i({},Object(n.b)({getUser:"auth/getUser"}))},u=r("KHd+"),a=Object(u.a)(o,(function(){var t=this.$createElement,e=this._self._c||t;return e("v-container",{staticClass:"fill-height"},[e("v-row",[e("v-col",{attrs:{cols:"12",lg:"4"}},[this._v("\n        "+this._s(this.user)+"\n        "+this._s(this.isAuthenticated)+"\n    ")])],1)],1)}),[],!1,null,null,null);e.default=a.exports}}]);