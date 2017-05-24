<?php

Hook::set('on.panel.ready', function() {
    $__id = Path::B(__DIR__);
    $__state = Config::get('page.editor', "");
    Config::set('panel.f.page.editors.' . $__id, 'CKEditor');
    if ($__state === $__id) {
        Hook::set('panel.js', function($__content) {
            return $__content . '!function($){$.CKE=' . json_encode(Extend::state(__DIR__, [])) . '}(window.PANEL);';
        });
        Asset::set(__DIR__ . DS . 'lot' . DS . 'worker' . DS . 'ckeditor' . DS . 'ckeditor.js', 20);
        if ($__s = Extend::state('panel', 'shield')) {
            Asset::set(__DIR__ . DS . 'lot' . DS . 'asset' . DS . 'css' . DS . $__s . '.min.css', 40);
        }
        Asset::set(__DIR__ . DS . 'lot' . DS . 'asset' . DS . 'js' . DS . $__id . '.fire.min.js', 40);
    }
});