(function($, CKE, win, doc) {
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
        var language = 'en-us', i;
        for (i in $.language) {
            if ($.language[i]) {
                language = i;
                break;
            }
        }
        config.language = language.split('-')[0];
        config.removeDialogTabs = 'link:advanced;image:advanced;table:advanced';
        config.removeFormatTags = 'a,b,big,code,del,dfn,em,font,i,ins,kbd,q,samp,small,span,strike,strong,sub,sup,tt,u,var';
        config.extraAllowedContent = 'abbr[title];blockquote(*);code(*);dfn[title];dl;dt;dd;figure(*);img(*);figcaption;p(*);pre(*);table(*);td(*);th(*);tr(*)';
        config.filebrowserImageBrowseUrl = '/' + $url.path.split('/')[0] + '/::g::/asset?layout=0';
        config.filebrowserImageBrowseLinkUrl = false;
        config.filebrowserImageUploadUrl = '/-u/c-k-editor/image?token=' + $token;
        config.filebrowserWindowWidth = '50%';
        config.filebrowserWindowHeight = '50%';
        config.dialog_magnetDistance = 0;
        config.disableObjectResizing = true;
        // `lot\extend\c-k-editor\lot\worker\ckeditor`
        config.contentsCss = CKE.getUrl('../../asset/css/content.min.css');
        for (i in $config.CKE) {
            config[i] = $config.CKE[i];
        }
    };
})(window.PANEL, window.CKEDITOR);