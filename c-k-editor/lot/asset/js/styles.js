(function($, CKE) {
    var lang = typeof $.languages.$.__.panel.CKE.stylesSet !== "undefined" ? $.languages.$.__.panel.CKE.stylesSet : {},
        formats = [],
        formats_tags = [
            // Block Style(s)
            'p', /* 'h1', 'h2', */ 'h3', 'h4', 'h5', 'h6', 'pre',
            // Inline Style(s)
            'sub', 'sup', 'mark', 'small', 'code', 'kbd', 'var', 'del', 'ins',
            // Object Style(s)
            {
                name: lang.img_left,
                element: 'img',
                attributes: {'class': 'left'}
            }, {
                name: lang.img_center,
                element: 'img',
                attributes: {'class': 'center'}
            }, {
                name: lang.img_right,
                element: 'img',
                attributes: {'class': 'right'}
            }, {
                name: lang.table_border,
                element: 'table',
                attributes: {'class': 'table'}
            }
        ], i, j;
    for (i in formats_tags) {
        j = formats_tags[i];
        formats.push(typeof j === "string" ? {
            name: lang[j] || j,
            element: j
        } : j);
    }
    CKE.stylesSet.add('common', formats);
})(window.PANEL, window.CKEDITOR);