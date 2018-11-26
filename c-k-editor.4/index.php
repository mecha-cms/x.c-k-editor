<?php

Hook::set('on.ready', function() {
    Asset::set(__DIR__ . DS . 'lot' . DS . 'worker' . DS . 'ckeditor' . DS . 'ckeditor.js', 10);
    Asset::set(__DIR__ . DS . 'lot' . DS . 'asset' . DS . 'js' . DS . 'c-k-editor.min.js', 10.1);
});