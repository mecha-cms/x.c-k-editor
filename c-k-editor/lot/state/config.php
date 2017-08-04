<?php

return [
    'skin' => 'moono-lisa',
    'uiColor' => '#ffffaa',
    'toolbar' => [
        ['Undo', 'Redo'],
        ['Bold', 'Italic', 'Underline', 'RemoveFormat'],
        ['SpecialChar', 'Link', 'Image', 'Table', 'HorizontalRule'],
        ['NumberedList', 'BulletedList', 'Blockquote', 'Indent', 'Outdent'],
        ['Styles']
    ],
    'height' => '30em',
    'filebrowserImageBrowseUrl' => '/' . Extend::state('panel', 'path', 'panel') . '/::g::/asset?layout=0',
    'filebrowserImageUploadPath' => ASSET
];