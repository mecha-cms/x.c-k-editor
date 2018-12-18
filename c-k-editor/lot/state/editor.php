<?php

return [
    'toolbar' => ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'imageUpload', 'blockQuote', 'insertTable', 'mediaEmbed', 'undo', 'redo'],
    // <http://ckeditor.github.io/editor-recommendations/features/headings.html>
    'heading' => [
        'options' => [
            [
                'model' => 'paragraph',
                'title' => 'Paragraph',
                'class' => 'ck-heading_paragraph'
            ], [
                'model' => 'heading2',
                'view' => 'h2',
                'title' => 'Heading 2',
                'class' => 'ck-heading_heading1'
            ], [
                'model' => 'heading3',
                'view' => 'h3',
                'title' => 'Heading 3',
                'class' => 'ck-heading_heading2'
            ], [
                'model' => 'heading4',
                'view' => 'h4',
                'title' => 'Heading 4',
                'class' => 'ck-heading_heading3'
            ], [
                'model' => 'heading5',
                'view' => 'h5',
                'title' => 'Heading 5',
                'class' => 'ck-heading_heading4'
            ], [
                'model' => 'heading6',
                'view' => 'h6',
                'title' => 'Heading 6',
                'class' => 'ck-heading_heading5'
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
    ]
];