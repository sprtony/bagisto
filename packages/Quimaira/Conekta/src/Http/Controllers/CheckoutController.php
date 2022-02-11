<?php

namespace Quimaira\Conekta\Http\Controllers;

use Quimaira\Conekta\Payment\Checkout;
use Webkul\Checkout\Facades\Cart;
use Webkul\Sales\Repositories\OrderRepository;
use Webkul\Sales\Repositories\InvoiceRepository;

class CheckoutController extends Controller
{

  protected $orderRepository;
  protected $invoiceRepository;

  protected $_config;

  public function __construct(
    OrderRepository $orderRepository,
    InvoiceRepository $invoiceRepository
  ) {
    $this->orderRepository = $orderRepository;
    $this->invoiceRepository = $invoiceRepository;
    $this->_config = request('_config');
  }

  public function createCheckout()
  {
    $checkout = new Checkout;
    $order = $checkout->setOrder('checkout');
    return $order->checkout->id;
  }


  public function success()
  {
    //crear la orden
    $order = $this->orderRepository->create(Cart::prepareDataForOrder());

    //Actualiza y valida el pago
    $this->orderRepository->update(['status' => 'processing'], $order->id);
    if ($order->canInvoice()) {
      $invoice = $this->invoiceRepository->create($this->prepareInvoiceData($order));
    }

    Cart::deActivateCart();

    session()->flash('order', $order);

    return redirect()->route('shop.checkout.success');
  }

  protected function prepareInvoiceData($order)
  {
    $invoiceData = [
      "order_id" => $order->id,
    ];

    foreach ($order->items as $item) {
      $invoiceData['invoice']['items'][$item->id] = $item->qty_to_invoice;
    }

    return $invoiceData;
  }
}
