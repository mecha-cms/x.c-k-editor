(function($, CKE) {
    var lang = typeof $.languages.$.__.panel.CKE.stylesSet !== "undefined" ? $.languages.$.__.panel.CKE.stylesSet : {},
        format = (CKE.lang[$.language.split('-')[0] || 'en']).format || {},
        formats = [],
        formats_tags = [
            // Block Style(s)
            'p', /* 'h1', 'h2', */ 'h3', 'h4', 'h5', 'h6', 'pre',
            // Inline Style(s)
            'sub', 'sup', 'mark', 'small', 'code', 'kbd', 'var', 'del', 'ins',
            // Object Style(s)
            {
                name: lang.image_left,
                element: 'img',
                attributes: {'class': 'align-left'}
            }, {
                name: lang.image_center,
                element: 'img',
                attributes: {'class': 'align-center'}
            }, {
                name: lang.image_right,
                element: 'img',
                attributes: {'class': 'align-right'}
            }, {
                name: lang.table_border,
                element: 'table',
                attributes: {'class': 'border'}
            }
        ], i, j;
    for (i in formats_tags) {
        j = formats_tags[i];
        formats.push(typeof j === "string" ? {
            name: format['tag_' + j] || '&lt;' + j + '&gt;',
            element: j
        } : j);
    }
    CKE.stylesSet.add('common', formats);
})(window.PANEL, window.CKEDITOR);