<?php

$__c_k_editor = Extend::state(__DIR__, []);

Route::set('-u/c-k-editor/%s%', function($s = "") use($language, $url, $__c_k_editor) {
    HTTP::status(404);
    $m = $u = "";
    if (!empty($_FILES['upload'])) {
        $n = To::file($_FILES['upload']['name']);
        $x = Path::X($n);
        $c = get_defined_constants(true)['user'];
        if (!$x) {
            $m = To::sentence($language->error);
        } else if (isset($c[u($s) . '_X']) && strpos(',' . $c[u($s) . '_X'] . ',', ',' . $x . ',') === false) {
            $m = $language->message_error_file_x($x);
        }
        $f = __replace__($__c_k_editor['filebrowserImageUploadPath'], [
            'date' => new Date,
            'extension' => Path::X($n),
            'hash' => Guardian::hash(),
            'id' => uniqid(),
            'name' => Path::N($n)
        ]);
        if (file_exists($f)) {
            $m = $language->message_error_file_exist($n);
        }
        if (!$m) {
            move_uploaded_file($_FILES['upload']['tmp_name'], $f);
            $u = To::url($f);
        }
    } else {
        $m = To::sentence($language->error);
    }
    echo '<script>window.parent.CKEDITOR.tools.callFunction(' . Request::get('CKEditorFuncNum') . ',\'' . $u . '\'' . ($m ? ',\'' . $m . '\'' : "") . ');</script>';
    exit;
}, 1);