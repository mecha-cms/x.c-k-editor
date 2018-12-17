<?php

$path = Extend::state('panel', 'path');
$r = __DIR__ . DS . '..' . DS . '..' . DS . '..';

// Dynamic resource
Route::set($path . '/::g::/-/c-k-editor.js', function() use($path, $r) {
    extract(Lot::get());
    $i = 60 * 60 * 24 * 30 * 12; // 1 Year
    HTTP::type('application/javascript')->header([
        'Pragma' => 'private',
        'Cache-Control' => 'private, max-age=' . $i,
        'Expires' => gmdate('D, d M Y H:i:s', time() + $i) . ' GMT'
    ]);
    $state = extend([
        'language' => explode('-', $config->language, 2)[0],
        'uploadUrl' => $url . '/' . $path . '/::s::/-/c-k-editor/push/' . $user->token
    ], require $r . DS . 'lot' . DS . 'state' . DS . 'editor.php');
    $script = file_get_contents($r . DS . 'lot' . DS . 'asset' . DS . 'js' . DS . 'c-k-editor.min.js');
    // TODO
    echo str_replace('{}).then(', '{' . t(json_encode($state), '{', '}') . '}).then(', $script);
    return;
});

// Image upload path
Route::set($path . '/::s::/-/c-k-editor/push/%s%', function($token) use($language, $user) {
    HTTP::status(200);
    $out = ['uploaded' => false];
    if ($token !== $user->token) {
        $out['error']['message'] = $language->message_error_token;
    }
    $blob = HTTP::files('upload');
    if (!empty($blob['type']) && strpos($blob['type'], 'image/') !== 0) {
        $out['error']['message'] = $language->message_error_page_image_blob;
    } else {
        $name = To::file($blob['name']);
        $state = Extend::state('panel', 'page');
        $candy = [
            'date' => new Date,
            'extension' => Path::X($name),
            'hash' => Guardian::hash(),
            'id' => sprintf('%u', time()),
            'name' => Path::N($name),
            'uid' => uniqid()
        ];
        $blob['name'] = $name = candy($state['image']['name'] ?? $name, $candy);
        $directory = candy(strtr($state['image']['directory'] ?? "", '/', DS), $candy);
        $response = File::push($blob, $path = rtrim(ASSET . ($user->status !== 1 ? DS . $user->key : "") . DS . $directory, DS));
        if ($response === false) {
            // $out['uploaded'] = true;
            $out['error']['message'] = $language->message_error_file_exist($path . DS . $name);
            // $out['url'] = To::URL($path . DS . $name);
        } else if (is_int($response)) {
            $out['error']['code'] = $response;
            $out['error']['message'] = $language->message_info_file_push[$response] ?? $language->error . ': ' . $response;
        } else {
            $out['uploaded'] = true;
            $out['url'] = To::URL($response);
        }
    }
    HTTP::type('application/json');
    echo json_encode($out);
    return;
});