(function($) {
    CKEDITOR.editorConfig = function(config) {
        config.contentsCss = CKEDITOR.getUrl('../../asset/css/content.min.css');
        for (var i in $.CKE) {
            config[i] = $.CKE[i];
        }
    };
})(Panel);