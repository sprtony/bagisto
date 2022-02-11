<?php

namespace Quimaira\Conekta\Payment;


class Checkout extends Conekta
{
  protected $code  = 'conektaCheckout';

  public function __construct()
  {
    $this->initialize();
  }

  public function getRedirectUrl()
  {
  }
}
