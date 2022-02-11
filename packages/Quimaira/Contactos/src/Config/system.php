<?php

return [
  [
    'key' => 'contactos',
    'name' => 'Mensajes de Contacto',
    'sort' => 6
  ],

  [
    'key'  => 'contactos.general',
    'name' => 'Mensajes de Contacto',
    'sort' => 1,
  ],

  [
    'key'  => 'contactos.general.settings',
    'name' => 'Mensajes de Contacto',
    'sort' => 1,
    'fields' => [
      [
        'name'          => 'email',
        'title'         => 'Correo de Contacto',
        'type'          => 'text',
        'channel_based' => false,
        'locale_based' => false
      ], [
        'name'          => 'bcc',
        'title'         => 'BCC',
        'type'          => 'text',
        'channel_based' => false,
        'locale_based' => false
      ]
    ]
  ]
];
