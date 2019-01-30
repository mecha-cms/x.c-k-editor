<?php

if ($active = Config::get('page.editor') === basename(__DIR__)) {
    require __DIR__ . DS . 'lot' . DS . 'worker' . DS . 'worker' . DS . 'route.php';
}

Hook::set('on.ready', function() use($active) {
    extract(Lot::get(), EXTR_SKIP);
    if ($active && (strpos($url->path, '/::s::/') !== false || (!empty($_page) && $_page->type === 'HTML'))) {
        require __DIR__ . DS . '_index.php';
    }
}, 2.1);

if ($active && HTTP::get('CKEditor') && strpos($url->path . '/', Extend::state('panel', 'path') . '/::g::/asset/') === 0) {
    Hook::set('on.ready', function() use($language, $url) {
        $i = HTTP::get('CKEditorFuncNum', false);
        Asset::script('function insert(u){var w=window,o=w.opener;o.focus(),o.CKEDITOR.tools.callFunction(' . $i . ',u),w.close()}');
        Config::set('panel.nav', "");
        Config::set('panel.desk.header', "");
        Config::reset('panel.+.file.tool');
        Config::set('panel.+.file.tool.insert', [
            'if' => function($file) use($i, $url): array {
                return [
                    'hidden' => !is_file($file),
                    'x' => strpos(',' . IMAGE_X . ',', ',' . Path::X($file) . ',') === false,
                    'link' => $i !== false ? 'javascript:insert(' . json_encode(To::URL($file)) . ')' : null
                ];
            },
            'title' => false,
            'description' => $language->insert,
            'icon' => [['M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z']],
            'stack' => 10
        ]);
    });
}