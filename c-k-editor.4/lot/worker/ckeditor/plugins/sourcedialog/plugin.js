/**
 * @license Copyright (c) 2003-2018, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license
 */
CKEDITOR.plugins.add("sourcedialog",{lang:"en,id",requires:"dialog",icons:"sourcedialog,sourcedialog-rtl",hidpi:!0,init:function(e){e.addCommand("sourcedialog",new CKEDITOR.dialogCommand("sourcedialog")),CKEDITOR.dialog.add("sourcedialog",this.path+"dialogs/sourcedialog.js"),e.ui.addButton&&e.ui.addButton("Sourcedialog",{label:e.lang.sourcedialog.toolbar,command:"sourcedialog",toolbar:"mode,10"})}});