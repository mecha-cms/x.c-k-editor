<?php

return [
    'customConfig' => false,
    'stylesSet' => false,
    'filebrowserWindowWidth' => 600,
    'filebrowserWindowHeight' => 300,
    'toolbarGroups' => [
        [
            'name' => 'styles',
            'groups' => ['styles']
        ], [
            'name' => 'basicstyles',
            'groups' => ['basicstyles']
        ], [
            'name' => 'paragraph',
            'groups' => ['list', 'blocks']
        ], [
            'name' => 'links',
            'groups' => ['links']
        ], [
            'name' => 'insert',
            'groups' => ['insert']
        ], [
            'name' => 'clipboard',
            'groups' => ['undo']
        ], [
            'name' => 'value',
            'groups' => $user->status === 1 ? ['mode'] : [] // Only user with status `1` can edit HTML source
        ]
	  ],
	  'removeButtons' => 'Outdent,Indent,Anchor,Strike,Underline,Paste,Copy,Cut',
    'format_tags' => 'p;h3;h4;h5;h6;pre',
    'image2_alignClasses' => ['align-left', 'align-center', 'align-right'],
    'image2_captionedClass' => 'image',
    'linkShowAdvancedTab' => false,
    'disallowedContent' => 'noscript script style',
    'extraPlugins' => 'sourcedialog' . (Extend::exist('block') ? ',placeholder' : "")
];