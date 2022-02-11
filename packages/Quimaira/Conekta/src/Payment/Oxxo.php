<?php

namespace Quimaira\Conekta\Payment;

class Oxxo extends Conekta
{
  protected $code  = 'oxxo';

  public function getRedirectUrl()
  {
    return route('conekta.oxxo.redirect');
  }

  public function __construct()
  {
    $this->initialize();
  }
}
