CKEDITOR.editorConfig = function(config) {
    config.language = 'en-us';
    config.toolbarGroups = [
        {
            name: 'mecha',
            groups: [
                'styles',
                'cleanup',
                'basicstyles',
                'links',
                'insert',
                'blocks',
                'list',
                'mode',
                'undo',
            ]
        }
    ];
    config.height = '30em';
    config.contentsCss = CKEDITOR.getUrl('../../asset/css/content.min.css');
    config.removePlugins = 'resize';
    config.removeButtons = 'Font,FontSize,CopyFormatting,Underline,Strike,Smiley,PageBreak,Iframe,Flash,CreateDiv';
    config.removeDialogTabs = 'image:advanced;link:advanced;table:advanced';
};