<?php
return [

  'oxxo' => [
    'code'             => 'oxxo',
    'title'            => 'Oxxo',
    'description'      => 'Deposito en Oxxo',
    'class'            => 'Quimaira\Conekta\Payment\Oxxo',
    'active'           => true,
    'sort'             => 5,
    'public_key'        => '',
    'secret_key'        => '',

  ],

  'conektaCheckout' => [
    'code'              => 'conektaCheckout',
    'title'             => 'Pago con Tarjeta',
    'description'       => 'Pago con Tarjeta',
    'class'             => 'Quimaira\Conekta\Payment\Checkout',
    'active'            => true,
    'sort'              => 6,
    'public_key'        => '',
    'secret_key'        => '',
  ],
];
