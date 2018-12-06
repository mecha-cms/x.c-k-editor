<?php

$t = filemtime(__FILE__);
$state = Extend::state('panel');
Asset::set(__DIR__ . DS . 'lot' . DS . 'worker' . DS . 'ckeditor' . DS . 'ckeditor.js', 10);
Asset::set($url . '/' . $state['path'] . '/::g::/-/c-k-editor.js', 10.1, [
    'src' => function($src) use($config, $t, $user) {
        $t += filemtime(__DIR__ . DS . 'lot' . DS . 'worker' . DS . 'worker' . DS . 'route.php');
        $t += filemtime(__DIR__ . DS . 'lot' . DS . 'asset' . DS . 'js' . DS . 'c-k-editor.min.js');
        $t += filemtime(__DIR__ . DS . 'lot' . DS . 'state' . DS . 'editor.php');
        return candy($this->url, [$src, abs(crc32($t . $user->token . $config->language))]);
    }
]);

if (!empty($state['style']['fonts'][0])) {
    $s = '<style media="screen">.cke_reset_all,.cke_reset_all *,.cke_reset_all a,.cke_reset_all textarea{font-family:"' . $state['style']['fonts'][0] . '",serif!important}</style>';
    Hook::set('shield.yield', function($yield) use($s) {
        return str_replace('</head>', $s . '</head>', $yield);
    }, 0);
}