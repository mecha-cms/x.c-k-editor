/**
 * @license Copyright (c) 2003-2018, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license
 */
"use strict";CKEDITOR.dialog.add("placeholder",function(t){var e=t.lang.placeholder,i=t.lang.common.generalTab,a=/^[^\[\]<>]+$/;return{title:e.title,minWidth:300,minHeight:80,contents:[{id:"info",label:i,title:i,elements:[{id:"name",type:"text",style:"width: 100%;",label:e.name,"default":"",required:!0,validate:CKEDITOR.dialog.validate.regex(a,e.invalidName),setup:function(t){this.setValue(t.data.name)},commit:function(t){t.setData("name",this.getValue())}}]}]}});