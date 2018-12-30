<?php

if ($active = Config::get('page.editor') === basename(__DIR__)) {
    require __DIR__ . DS . 'lot' . DS . 'worker' . DS . 'worker' . DS . 'route.php';
}

Hook::set('on.ready', function() use($active) {
    extract(Lot::get(), EXTR_SKIP);
    if ($active && (strpos($url->path, '/::s::/') !== false || (!empty($_page) && $_page->type === 'HTML'))) {
        require __DIR__ . DS . '_index.php';
    }
}, 2);