(function($, CKE) {
    if (!$) return;
    var form = $.__form__,
        lot = form.$,
        CM = form.CM || {},
        src = (document.currentScript || {}).src || "",
        config = src ? {
            customConfig: src.replace(/\/[^/?]*(\?.*)?$/g, '/config.min.js$1'),
            stylesSet: 'common:' + src.replace(/\/[^/?]*(\?.*)?$/g, '/styles.min.js$1')
        } : {},
        i, j, k, l;
    for (i in CM) {
        for (j in CM[i]) {
            k = CM[i][j];
            if (!k.getTextArea) continue;
            l = k.getTextArea();
            if (l.nodeName.toLowerCase() === 'textarea' && l.classList.contains('editor') && l.getAttribute('data-type') === 'HTML') {
                k.toTextArea(); // destroy `CodeMirror`
            }
        }
    }
    form.CKE = {};
    for (i in lot) {
        form.CKE[i] = {};
        for (j in lot[i]) {
            k = lot[i][j];
            if (k.nodeName.toLowerCase() === 'textarea' && k.classList.contains('editor') && k.getAttribute('data-type') === 'HTML') {
                form.CKE[i][j] = CKE.replace(k, config);
            }
        }
    }
})(window.PANEL, window.CKEDITOR);