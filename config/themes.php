<?php

return [
    'default' => 'default',

    'themes' => [
        'default' => [
            'views_path' => 'resources/themes/default/views',
            'assets_path' => 'public/themes/default/assets',
            'name' => 'Default'
        ],

        'quimashop' => [
            'views_path' => 'resources/themes/quimashop/views',
            'assets_path' => 'public/themes/quimashop/assets',
            'name' => 'Quimashop',
            'parent' => 'default'
        ],

    ],

    'admin-default' => 'adminLTE',

    'admin-themes' => [
        'default' => [
            'views_path' => 'resources/admin-themes/default/views',
            'assets_path' => 'public/admin-themes/default/assets',
            'name' => 'Default'
        ],

        'adminLTE' => [
            'views_path' => 'packages/Sprtony/AdminLTE/src/Resources/views',
            'assets_path' => 'public/admin-themes/adminLTE/assets',
            'name' => 'adminLTE',
            'parent' => 'default'
        ]
    ]
];
