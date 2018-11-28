<?php

$path = Extend::state('panel', 'path');
$r = __DIR__ . DS . '..' . DS . '..' . DS . '..';
Route::set($path . '/::g::/-/c-k-editor.js', function() use($path, $r) {
    extract(Lot::get(null, []));
    $i = 60 * 60 * 24 * 30 * 12; // 1 Year
    HTTP::type('application/javascript')->header([
        'Pragma' => 'private',
        'Cache-Control' => 'private, max-age=' . $i,
        'Expires' => gmdate('D, d M Y H:i:s', time() + $i) . ' GMT'
    ]);
    $script = file_get_contents($r . DS . 'lot' . DS . 'asset' . DS . 'js' . DS . 'c-k-editor.min.js');
    echo str_replace('{uiColor:', '{' . t(json_encode(extend([
        'language' => explode('-', $config->language, 2)[0],
        'filebrowserImageBrowseUrl' => $url . '/' . $path . '/::g::/asset' . ($user->status !== 1 ? '/' . $user->key : ""),
        'filebrowserImageUploadUrl' => null,
        'contentsCss' => To::URL($css = $r . DS . 'lot' . DS . 'asset' . DS . 'css' . DS . 'content.css') . '?' . dechex(filemtime($css))
    ], require $r . DS . 'lot' . DS . 'state' . DS . 'editor.php')), '{', '}') . ',uiColor:', $script);
    return;
});

// Image upload path
Route::set($path . '/::g::/-/c-k-editor/push', function() {
    
});