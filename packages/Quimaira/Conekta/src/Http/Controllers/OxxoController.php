<?php

namespace Quimaira\Conekta\Http\Controllers;

use Quimaira\Conekta\Payment\Oxxo;
use Webkul\Checkout\Facades\Cart;
use Webkul\Sales\Repositories\OrderRepository;
use Webkul\Sales\Repositories\InvoiceRepository;
use Quimaira\Conekta\Mail\OrderOxxo;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use function response;

class OxxoController extends Controller
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

  public function redirect()
  {
    $payment = new Oxxo;
    $order_oxxo = $payment->setOrder('oxxo');

    //Apartar producto
    $order = $this->orderRepository->create(array_merge(Cart::prepareDataForOrder(), ['external_payment_id' => $order_oxxo->charges[0]->payment_method->reference]));
    session()->flash('order', $order);

    Cart::deActivateCart();
    Mail::to($order->customer->email)
      ->bcc('grupoquimaira@gmail.com')
      ->send(new OrderOxxo($order));

    return redirect()->route('shop.checkout.success');
  }

  public function success()
  {
    if (!$order = session('order')) {
      return redirect()->route('shop.checkout.cart.index');
    }
    return view('quimashop::checkout.oxxo_success', compact('order'));
  }

  public function hook(Request $request)
  {
    $order = $this->orderRepository->findOneByField(['external_payment_id' => $request->data['object']['charges']['data'][0]['payment_method']['reference']]);

    if ($request->type == 'order.paid') {
      //Actualiza y valida el pago
      $this->orderRepository->update(['status' => 'processing'], $order->id);
      if ($order->canInvoice()) {
        $invoice = $this->invoiceRepository->create($this->prepareInvoiceData($order));
      }
    } elseif ('charge.fail') {
      //Cancelar pedido
      $this->orderRepository->cancel($order->id);
    }
    return response($order, 200)
      ->header('Content-Type', 'application/json');
  }

  public function vaucher($id)
  {
    $order = $this->orderRepository->findOneByField(['id' => $id]);
    return view('quimashop::shop.conekta-ficha-deposito', ['order' => $order]);
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

  public function prueba()
  {
    $order = $this->orderRepository->findOneByField(['increment_id' => 67]);
    return view('shop::emails.sales.new-order', compact('order'));
  }
}
