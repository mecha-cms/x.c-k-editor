<?php

$__c_k_editor = Extend::state(__DIR__, []);
$__asset_P = explode('?', $__c_k_editor['filebrowserImageBrowseUrl'])[0];
$__asset_B = Path::B($__asset_P);

Hook::set('on.panel.ready', function() use($__c_k_editor) {
    $__id = Path::B(__DIR__);
    $__state = Config::get('page.editor', "");
    if ($__state === $__id) {
        Hook::set('panel.js', function($__content) use($__c_k_editor) {
            return $__content . '!function($){$.CKE=' . json_encode($__c_k_editor) . '}(window.PANEL);';
        });
        Asset::set(__DIR__ . DS . 'lot' . DS . 'worker' . DS . 'ckeditor' . DS . 'ckeditor.js', 20);
        $__s = __DIR__ . DS . 'lot' . DS . 'asset' . DS;
        if ($__ss = Extend::state('panel', 'shield')) {
            Asset::set($__s . 'css' . DS . $__ss . '.min.css', 20.1);
        }
        Asset::set($__s . 'js' . DS . $__id . '.fire.min.js', 20.1);
    }
});

if ($__asset_P && strpos('/' . $url->path . '/', '/' . trim($__asset_P, '/') . '/') !== false) {
    if (Request::get('CKEditor') && ($__fn = Request::get('CKEditorFuncNum', "")) !== "") {
        Hook::set('on.panel.ready', function() {
            Config::set('panel.layout', 0);
        });
        Hook::set('shield.enter', function() use($language, $__asset_B, $__fn) {
            $__id = uniqid();
            Hook::set('panel.a.' . $__asset_B . 's', function() {
                return [];
            });
            Hook::set('panel.a.' . $__asset_B, function($__a, $__v) use($language, $__id) {
                $__u = $__v[1]->url;
                if (strpos(',' . IMAGE_X . ',', ',' . Path::X($__u) . ',') === false) {
                    return [];
                }
                return [
                    'insert' => [$language->insert, $__u, false, ['onclick' => 'return CKE_' . $__id . '(this);']]
                ];
            });
            Hook::set('panel.js', function($__content) use($__fn, $__id) {
                return $__content . 'function CKE_' . $__id . '($){var w=window.opener;return w.focus(),w.CKEDITOR.tools.callFunction(' . $__fn . ',$.href),window.close(),false}';
            });
        }, 0);
    }
}