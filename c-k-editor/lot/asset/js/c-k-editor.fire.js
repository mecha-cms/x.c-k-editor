(function($) {
    if (!$) return;
    var editors = $.forms.editor,
        forms = $.forms.lot, i, j, k, l;
    for (i in editors) {
        for (j in editors[i]) {
            k = editors[i][j];
            if (!k.getTextArea) continue;
            l = k.getTextArea();
            if ($(l).is('textarea.editor[data-type="HTML"]')) {
                k.toTextArea(); // destroy `CodeMirror`
            }
        }
    }
    for (i in forms) {
        for (j in forms[i]) {
            k = forms[i][j];
            if ($(k).is('textarea.editor[data-type="HTML"]')) {
                CKEDITOR.replace(k);
            }
        }
    }
})(Panel);