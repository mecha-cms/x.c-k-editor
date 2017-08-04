(function($, CKE) {
    CKE.editorConfig = function(config) {
        var CTRL = CKE.CTRL,
            SHIFT = CKE.SHIFT, i;
        config.keystrokes = [
            [CTRL + 71 /* G */, 'image'],
            [CTRL + 81 /* Q */, 'blockquote'],
            [CTRL + 82 /* R */, 'horizontalrule'],
            [CTRL + 84 /* T */, 'table'],
            [CTRL + SHIFT + 84 /* T */, 'table'],
            [CTRL + SHIFT + 88 /* X */, 'source']
        ];
        config.language = ($.language || 'en-us').split('-')[0];
        config.removeDialogTabs = 'link:advanced;image:advanced;table:advanced';
        config.removeFormatTags = 'a,b,big,code,del,dfn,em,font,i,ins,kbd,q,samp,small,span,strike,strong,sub,sup,tt,u,var';
        config.filebrowserImageBrowseUrl = '/' + $.url.path.split('/')[0] + '/::g::/asset?layout=0';
        config.filebrowserImageBrowseLinkUrl = false;
        config.filebrowserImageUploadUrl = '/-u/c-k-editor/image?token=' + $.token;
        config.filebrowserWindowWidth = '50%';
        config.filebrowserWindowHeight = '50%';
        // `lot\extend\c-k-editor\lot\worker\ckeditor`
        config.contentsCss = CKE.getUrl('../../asset/css/content.min.css');
        for (i in $.CKE) {
            config[i] = $.CKE[i];
        }
    };
})(window.PANEL, window.CKEDITOR);