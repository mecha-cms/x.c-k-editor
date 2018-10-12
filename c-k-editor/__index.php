<?php

$__c_k_editor = Extend::state(__DIR__, []);
$__asset_P = explode('?', $__c_k_editor['filebrowserImageBrowseUrl'])[0];
$__asset_B = Path::B($__asset_P);

Hook::set('on.panel.ready', function() use($__c_k_editor) {
    $__id = Path::B(__DIR__);
    $__state = Config::get('page.editor', "");
    if ($__state === $__id) {
        Config::set('panel.o.js.CKE', $__c_k_editor);
        Asset::set(__DIR__ . DS . 'lot' . DS . 'worker' . DS . 'ckeditor' . DS . 'ckeditor.js', 20);
        $__s = __DIR__ . DS . 'lot' . DS . 'asset' . DS;
        if ($__ss = Extend::state('panel', 'shield')) {
            Asset::set($__s . 'css' . DS . $__ss . '.min.css', 20.1);
        }
        Asset::set($__s . 'js' . DS . $__id . '.fire.js', 20.1);
    }
});

if ($__asset_P && strpos('/' . $url->path . '/', '/' . trim($__asset_P, '/') . '/') !== false) {
    if (($__i = HTTP::get('CKEditor')) && ($__fn = HTTP::get('CKEditorFuncNum', "")) !== "") {
        Config::set('panel.layout', 0);
        $__id = uniqid();
        Hook::set('panel.a.' . $__asset_B . 's', function() {
            return [];
        }, 10.1);
        Hook::set('panel.a.' . $__asset_B, function($__a, $__v) use($language, $__id) {
            $__u = $__v[1]->url;
            $__x = Path::X($__u);
            if (!$__x || strpos(',' . IMAGE_X . ',', ',' . $__x . ',') === false) {
                return [];
            }
            return [
                'insert' => [$language->insert, $__u, false, ['onclick' => 'return CKE_' . $__id . '(this);']]
            ];
        }, 10.1);
        Hook::set('panel.js', function($__content) use($__fn, $__id) {
            return $__content . 'function CKE_' . $__id . '($){var w=window.opener;return w.focus(),w.CKEDITOR.tools.callFunction(' . $__fn . ',$.href),window.close(),false}';
        }, 10.1);
    }
}