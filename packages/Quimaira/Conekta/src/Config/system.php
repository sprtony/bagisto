<?php
return [
  [
    'key'    => 'sales.paymentmethods.oxxo',
    'name'   => 'Oxxo Pay',
    'sort'   => 5,
    'fields' => [
      [
        'name'          => 'title',
        'title'         => 'admin::app.admin.system.title',
        'type'          => 'text',
        'validation'    => 'required',
        'channel_based' => false,
        'locale_based'  => true,
      ], [
        'name'          => 'description',
        'title'         => 'admin::app.admin.system.description',
        'type'          => 'textarea',
        'channel_based' => false,
        'locale_based'  => true,
      ],  [
        'name'       => 'public_key',
        'title'      => 'Clave publicable',
        'type'       => 'text',
        'validation' => 'required',
      ],  [
        'name'       => 'secret_key',
        'title'      => 'Clave secreta',
        'type'       => 'text',
        'validation' => 'required',
      ],
      [
        'name'      => 'days',
        'title'     => 'dias de vigencia',
        'type'      => 'text',
        'validation' => 'required'
      ],
      [
        'name'          => 'active',
        'title'         => 'admin::app.admin.system.status',
        'type'          => 'boolean',
        'validation'    => 'required',
        'channel_based' => false,
        'locale_based'  => true
      ], [
        'name'    => 'sort',
        'title'   => 'admin::app.admin.system.sort_order',
        'type'    => 'select',
        'options' => [
          [
            'title' => '1',
            'value' => 1,
          ], [
            'title' => '2',
            'value' => 2,
          ], [
            'title' => '3',
            'value' => 3,
          ], [
            'title' => '4',
            'value' => 4,
          ], [
            'title' => '5',
            'value' => 5,
          ],
        ],
      ]
    ]
  ],
  [
    'key'    => 'sales.paymentmethods.conektaCheckout',
    'name'   => 'Pago con Tarjeta (Conekta)',
    'sort'   => 5,
    'fields' => [
      [
        'name'          => 'title',
        'title'         => 'admin::app.admin.system.title',
        'type'          => 'text',
        'validation'    => 'required',
        'channel_based' => false,
        'locale_based'  => true,
      ], [
        'name'          => 'description',
        'title'         => 'admin::app.admin.system.description',
        'type'          => 'textarea',
        'channel_based' => false,
        'locale_based'  => true,
      ],  [
        'name'       => 'public_key',
        'title'      => 'Clave publicable',
        'type'       => 'text',
        'validation' => 'required',
      ],  [
        'name'       => 'secret_key',
        'title'      => 'Clave secreta',
        'type'       => 'text',
        'validation' => 'required',
      ],  [
        'name'          => 'active',
        'title'         => 'admin::app.admin.system.status',
        'type'          => 'boolean',
        'validation'    => 'required',
        'channel_based' => false,
        'locale_based'  => true
      ], [
        'name'    => 'sort',
        'title'   => 'admin::app.admin.system.sort_order',
        'type'    => 'select',
        'options' => [
          [
            'title' => '1',
            'value' => 1,
          ], [
            'title' => '2',
            'value' => 2,
          ], [
            'title' => '3',
            'value' => 3,
          ], [
            'title' => '4',
            'value' => 4,
          ], [
            'title' => '5',
            'value' => 5,
          ],
        ],
      ]
    ]
  ]
];
