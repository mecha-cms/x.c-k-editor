<?php

Hook::set('on.panel.ready', function() {
    Hook::set('panel.js', function($content) {
        return $content . '!function($){$.CKE=' . json_encode(Extend::state(__DIR__, [])) . '}(Panel);';
    });
    Asset::set(__DIR__ . DS . 'lot' . DS . 'worker' . DS . 'ckeditor' . DS . 'ckeditor.js', 100);
    if ($__s = Extend::state('panel', 'shield')) {
        Asset::set(__DIR__ . DS . 'lot' . DS . 'asset' . DS . 'css' . DS . $__s . '.min.css', 200);
    }
    Asset::set(__DIR__ . DS . 'lot' . DS . 'asset' . DS . 'js' . DS . 'c-k-editor.fire.min.js', 200);
});