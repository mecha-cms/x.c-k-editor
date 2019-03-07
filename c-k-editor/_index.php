<?php

$t  = filemtime(__FILE__);
$t += filemtime(__DIR__ . DS . 'lot' . DS . 'state' . DS . 'editor.php');
$t += filemtime(__DIR__ . DS . 'lot' . DS . 'worker' . DS . 'worker' . DS . 'route.php');
$state = Extend::state('panel');
Asset::set(__DIR__ . DS . 'lot' . DS . 'asset' . DS . 'css' . DS . 'content.min.css', 10);
Asset::set(__DIR__ . DS . 'lot' . DS . 'worker' . DS . '@ckeditor' . DS . 'ckeditor.js', 10);
Asset::set($url . '/' . $state['path'] . '/::g::/-/c-k-editor.min.js', 10.2, [
    'src' => function($src) use($config, $t, $user) {
        $t += filemtime(__DIR__ . DS . 'lot' . DS . 'asset' . DS . 'js' . DS . basename($src));
        return $src . '?v=' . abs(crc32($t . $user->token . $config->language));
    }
]);

if ($f = File::exist(__DIR__ . DS . 'lot' . DS . 'worker' . DS . '@ckeditor' . DS . 'translations' . DS . explode('-', $config->language)[0] . '.js')) {
    Asset::set($f, 10.1);
}