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
        $f = candy($__c_k_editor['filebrowserImageUploadPath'], [
            'date' => new Date,
            'extension' => Path::X($n),
            'hash' => Guardian::hash(),
            'id' => uniqid(),
            'name' => Path::N($n)
        ]);
        if (file_exists($f)) {
            $m = $language->message_error_file_exist($n);
        } else if (!empty($_FILES['upload']['error'])) {
            $m = $language->message_info_file_upload[$_FILES['upload']['error']];
        }
        if (!$m) {
            if (!is_dir($d = dirname($f))) {
                mkdir($d, 0777, true);
            }
            move_uploaded_file($_FILES['upload']['tmp_name'], $f);
            $u = To::URL($f);
        }
    } else {
        $m = To::sentence($language->error);
    }
    HTTP::status(302);
    echo '<script>window.parent.CKEDITOR.tools.callFunction(' . HTTP::get('CKEditorFuncNum') . ',\'' . $u . '\'' . ($m ? ',\'' . $m . '\'' : "") . ');</script>';
    exit;
}, 1);