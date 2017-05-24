(function($) {
    if (!$) return;
    var forms = $.forms,
        lot = forms.$,
        CM = forms.CM || {},
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
    forms.CKE = {};
    for (i in lot) {
        forms.CKE[i] = {};
        for (j in lot[i]) {
            k = lot[i][j];
            if (k.nodeName.toLowerCase() === 'textarea' && k.classList.contains('editor') && k.getAttribute('data-type') === 'HTML') {
                forms.CKE[i][j] = CKEDITOR.replace(k);
            }
        }
    }
})(window.PANEL);