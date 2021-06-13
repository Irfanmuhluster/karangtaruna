/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

// CKEDITOR.editorConfig = function( config ) {
//  // Define changes to default configuration here. For example:
//  // config.language = 'fr';
//  // config.uiColor = '#AADC6E';
// };

window.CKEDITOR.editorConfig = function (config) {
  config.toolbarGroups = [
    { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
    { name: 'forms', groups: [ 'forms' ] },
    '/',
    { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
    { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
    '/',
    { name: 'styles', groups: [ 'styles' ] },
    { name: 'colors', groups: [ 'colors' ] },
    { name: 'links', groups: [ 'links' ] },
    { name: 'insert', groups: [ 'insert' ] },
    { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
    { name: 'tools', groups: [ 'tools' ] },
    { name: 'others', groups: [ 'others' ] },
    { name: 'about', groups: [ 'about' ] }
  ]

  config.removeButtons = 'Templates,Print,Preview,NewPage,Save,Cut,Copy,Paste,PasteText,PasteFromWord,Replace,Find,SelectAll,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Language,RemoveFormat,CopyFormatting,CreateDiv,About,ShowBlocks,Maximize,Iframe,PageBreak,SpecialChar,HorizontalRule,Smiley,BidiLtr,BidiRtl,FontSize,Font'
  config.allowedContent = true
}
