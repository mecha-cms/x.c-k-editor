<?php

Hook::set('shield.before', function() use($url) {
    Asset::set(__DIR__ . DS . 'lot' . DS . 'worker' . DS . 'ckeditor' . DS . 'ckeditor.js', 100);
    Asset::set(__DIR__ . DS . 'lot' . DS . 'asset' . DS . 'css' . DS . Extend::state('panel', 'shield', "") . '.min.css', 200);
    Asset::set(__DIR__ . DS . 'lot' . DS . 'asset' . DS . 'js' . DS . 'c-k-editor.fire.min.js', 200);
});