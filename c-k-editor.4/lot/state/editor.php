<?php

return [
    'filebrowserWindowWidth' => 600,
    'filebrowserWindowHeight' => 300,
    'toolbar' => [
        ['Format'],
        ['Bold', 'Italic' /* , 'Code', 'Underline', 'Strike', 'Subscript', 'Superscript' */ ],
        ['Link', 'Unlink'],
        ['NumberedList', 'BulletedList'],
        ['Blockquote'],
        ['CreatePlaceholder', 'Image', 'Table' /* , 'HorizontalRule' */ ],
        ['Undo', 'Redo'],
        ['Sourcedialog']
    ],
    // For semantic HTML structure, we use `<h3>` as the largest heading level
    // because we already have `<h1>` as the site title and `<h2>` as the page title
    'format_tags' => 'p;h3;h4;h5;h6;pre',
    'image2_alignClasses' => ['align-left', 'align-center', 'align-right'],
    'image2_captionedClass' => 'image',
    'linkShowAdvancedTab' => false,
    'removeDialogFields' => 'table:info:txtBorder;table:info:cmbAlign;table:info:txtCellSpace;table:info:txtCellPad',
    'disallowedContent' => 'article aside base body footer head header hgroup html iframe link main nav noscript script style title',
    'extraPlugins' => 'codetag,confighelper,horizontalrule,sourcedialog'
];