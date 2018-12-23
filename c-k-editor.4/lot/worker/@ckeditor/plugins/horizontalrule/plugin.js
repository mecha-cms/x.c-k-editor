/**
 * @license Copyright (c) 2003-2018, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license
 */
!function(){var n={canUndo:!1,exec:function(n){var e=n.document.createElement("hr");n.insertElement(e)},allowedContent:"hr",requiredContent:"hr"},e="horizontalrule";CKEDITOR.plugins.add(e,{lang:"en,id",icons:"horizontalrule",hidpi:!0,init:function(t){t.blockless||(t.addCommand(e,n),t.ui.addButton&&t.ui.addButton("HorizontalRule",{label:t.lang.horizontalrule.toolbar,command:e,toolbar:"insert,40"}))}})}();