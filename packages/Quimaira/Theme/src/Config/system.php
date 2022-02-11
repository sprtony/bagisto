<?php

return [
  [
    'key' => 'social',
    'name' => 'Redes Sociales',
    'sort' => 6
  ],
  [
    'key'  => 'social.general',
    'name' => 'Redes Sociales',
    'sort' => 1,
  ],
  [
    'key'  => 'social.general.settings',
    'name' => 'Redes Sociales',
    'sort' => 1,
    'fields' => [
      [
        'name'          => 'facebook_url',
        'title'         => 'Facebook',
        'type'          => 'text',
        'channel_based' => false,
        'locale_based' => false
      ], [
        'name'          => 'instagram_url',
        'title'         => 'Instagram',
        'type'          => 'text',
        'channel_based' => false,
        'locale_based' => false
      ], [
        'name'          => 'whatsapp_url',
        'title'         => 'Whatsapp',
        'type'          => 'text',
        'channel_based' => false,
        'locale_based' => false
      ], [
        'name'          => 'youtube_url',
        'title'         => 'Youtube',
        'type'          => 'text',
        'channel_based' => false,
        'locale_based' => false
      ], [
        'name'          => 'tiktok_url',
        'title'         => 'Tik Tok',
        'type'          => 'text',
        'channel_based' => false,
        'locale_based' => false
      ],[
        'name'          => 'pinterest_url',
        'title'         => 'Pinterest',
        'type'          => 'text',
        'channel_based' => false,
        'locale_based' => false
      ],
    ]
  ],
['key'    => 'sales.carriers.Express',
    'name'   => 'Express',
    'sort'   => 2,
   'fields' => [
            [
                'name'          => 'title',
                'title'         => 'admin::app.admin.system.title',
                'type'          => 'depends',
                'depend'        => 'active:1',
                'validation'    => 'required_if:active,1',
                'channel_based' => true,
                'locale_based'  => true,
            ], [
                'name'          => 'description',
                'title'         => 'admin::app.admin.system.description',
                'type'          => 'textarea',
                'channel_based' => true,
                'locale_based'  => false,
            ], [
                'name'          => 'default_rate',
                'title'         => 'admin::app.admin.system.rate',
                'type'          => 'depends',
                'depend'        => 'active:1',
                'validation'    => 'required_if:active,1',
                'channel_based' => true,
                'locale_based'  => false,
            ], [
                'name'       => 'type',
                'title'      => 'admin::app.admin.system.type',
                'type'       => 'depends',
                'depend'     => 'active:1',
                'options'    => [
                    [
                        'title' => 'Per Unit',
                        'value' => 'per_unit',
                    ], [
                        'title' => 'Per Order',
                        'value' => 'per_order',
                    ]
                ],
                'validation' => 'required_if:active,1'
            ], [
                'name'          => 'active',
                'title'         => 'admin::app.admin.system.status',
                'type'          => 'boolean',
                'validation'    => 'required',
                'channel_based' => false,
                'locale_based'  => true,
            ], [
                'name'          => 'is_calculate_tax',
                'title'         => 'admin::app.admin.system.calculate-tax',
                'type'          => 'boolean',
                'validation'    => 'required',
                'channel_based' => false,
                'locale_based'  => false,
            ]
        ] 
  ]
];
