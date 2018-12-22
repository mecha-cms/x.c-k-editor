<?php

return [
    'toolbar' => ['heading', '|', 'bold', 'italic', 'code', 'link', 'bulletedList', 'numberedList', 'imageUpload', 'blockQuote', 'insertTable', 'mediaEmbed', 'undo', 'redo'],
    // <http://ckeditor.github.io/editor-recommendations/features/headings.html>
    'heading' => [
        // For semantic HTML structure, we use `<h3>` as the largest heading level
        // because we already have `<h1>` as the site title and `<h2>` as the page title
        'options' => [
            [
                'model' => 'paragraph',
                'title' => 'Paragraph',
                'class' => 'ck-heading_paragraph'
            ], [
                'model' => 'heading3',
                'view' => 'h3',
                'title' => 'Heading 3',
                'class' => 'ck-heading_heading1'
            ], [
                'model' => 'heading4',
                'view' => 'h4',
                'title' => 'Heading 4',
                'class' => 'ck-heading_heading2'
            ], [
                'model' => 'heading5',
                'view' => 'h5',
                'title' => 'Heading 5',
                'class' => 'ck-heading_heading3'
            ], [
                'model' => 'heading6',
                'view' => 'h6',
                'title' => 'Heading 6',
                'class' => 'ck-heading_heading4'
            ]
        ]
    ],
    'image' => [
        'toolbar' => ['imageTextAlternative', '|', 'imageStyle:full', 'imageStyle:alignLeft', 'imageStyle:alignCenter', 'imageStyle:alignRight'],
        'styles' => [
            [
                'name' => 'full',
                'icon' => 'full',
                'isDefault' => true
            ], [
                'name' => 'alignLeft',
                'icon' => 'left',
                'className' => 'align-left'
            ], [
                'name' => 'alignCenter',
                'icon' => 'center',
                'className' => 'align-center'
            ], [
                'name' => 'alignRight',
                'icon' => 'right',
                'className' => 'align-right'
            ]
        ]
    ],
    'table' => [
        'contentToolbar' => ['tableColumn', 'tableRow', 'mergeTableCells']
    ]
];