<?php

namespace Quimaira\Conekta\Payment;

use Webkul\Payment\Payment\Payment;

abstract class Conekta extends Payment
{

  public function createCustomer()
  {
    $customer_data = $this->getCustomerInfo();
    $validCustomer = [
      'name' => $customer_data['name'],
      'email' => $customer_data['email']
    ];

    $customer = \Conekta\Customer::create($validCustomer);
    return $customer;
  }

  public function setOrder($type)
  {
    $cart = $this->getCart();
    try {
      $data = [
        "line_items" => $this->getLineItems(),
        "shipping_lines" => [[
          'amount' => $cart->selected_shipping_rate->price * 100,
          'carrier' => $cart->selected_shipping_rate->carrier,
        ]],
        "currency" => "MXN",
        "customer_info" => [
          'customer_id' => $this->createCustomer()->id
        ],
        "shipping_contact" => [
          "address" => $this->getShippingContact()
        ],
      ];

      if ($type == 'oxxo') {
        $data['charges'] =
          [
            [
              "payment_method" => [
                "type" => "oxxo_cash",
                "expires_at" => (new \DateTime())->add(new \DateInterval('P1D'))->getTimestamp()
              ]
            ]
          ];
      } else if ($type == 'checkout') {
        $data['checkout'] = [
          'allowed_payment_methods' => ["card"],
          'monthly_installments_enabled' => false,
        ];
      }
      $order = \Conekta\Order::create(
        $data
      );
      return $order;
    } catch (\Conekta\ParameterValidationError $error) {
      echo $error->getMessage();
    } catch (\Conekta\Handler $error) {
      echo $error->getMessage();
    }
  }


  protected function getLineItems()
  {
    $line_items = [];
    $cartItems = $this->getCartItems();

    foreach ($cartItems as $item) {
      $line_item = [
        "name" => $item->name,
        "unit_price" => ceil($item->price * 100),
        "quantity" => $item->quantity
      ];
      $line_items[] = $line_item;
    }

    return $line_items;
  }

  protected function getCustomerInfo()
  {
    $cart = $this->getCart();
    $billingAddress = $cart->billing_address;

    return [
      "name" => $billingAddress->first_name . ' ' . $billingAddress->last_name,
      "email" => $billingAddress->email,
      "phone" => "+52" . $billingAddress->phone
    ];
  }

  protected function getShippingContact()
  {
    $cart = $this->getCart();
    $billingAddress = $cart->billing_address;

    return [
      "street1" => $billingAddress->address1,
      "postal_code" => $billingAddress->postcode,
      "country" => $billingAddress->country
    ];
  }


  protected function initialize()
  {
    \Conekta\Conekta::setApiKey($this->getConfigData('secret_key'));
    \Conekta\Conekta::setApiVersion("2.0.0");
  }
}
