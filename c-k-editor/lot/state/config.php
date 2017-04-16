<?php

return [
    'language' => explode('-', Config::get('language', 'en-us'))[0],
    'toolbarGroups' => [
        [
            'name' => 'mecha',
            'groups' => [
                'styles',
                'cleanup',
                'basicstyles',
                'links',
                'insert',
                'blocks',
                'list',
                'mode',
                'undo',
            ]
        ]
    ],
    'height' => '30em',
    'removePlugins' => 'resize',
    'removeButtons' => 'Font,FontSize,CopyFormatting,Underline,Strike,Smiley,PageBreak,Iframe,Flash,CreateDiv',
    'removeDialogTabs' => 'image:advanced;link:advanced;table:advanced'
];