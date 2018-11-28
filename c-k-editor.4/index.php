<?php

if ($current = Config::get('page.editor') === basename(__DIR__)) {
    require __DIR__ . DS . 'lot' . DS . 'worker' . DS . 'worker' . DS . 'route.php';
}

Hook::set('on.ready', function() use($config, $current, $token, $url) {
    if ($current && Config::get('panel.desk.body.tab.file.field.page[type].value') === 'HTML') {
        require __DIR__ . DS . '_index.php';
    }
}, 2);

if (HTTP::get('CKEditor') && strpos($url->path . '/', Extend::state('panel', 'path') . '/::g::/asset/') === 0) {
    Hook::set('on.ready', function() use($language) {
        $i = HTTP::get('CKEditorFuncNum', false);
        Config::set('panel.nav', "");
        Config::set('panel.desk.header', "");
        Config::reset('panel.+.file.tool');
        Config::set('panel.+.file.tool.insert', [
            'if' => function($file) use($i): array {
                return [
                    'hidden' => !is_file($file),
                    'x' => strpos(',' . IMAGE_X . ',', ',' . Path::X($file) . ',') === false,
                    'link' => $i !== false ? 'javascript:void(window.opener.CKEDITOR.tools.callFunction(' . $i . ',\'' . To::URL($file) . '\'),window.close())' : null
                ];
            },
            'title' => false,
            'description' => $language->insert,
            'icon' => [['M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z']],
            'stack' => 10
        ]);
    });
}