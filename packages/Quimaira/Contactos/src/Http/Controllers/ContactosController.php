<?php

namespace Quimaira\Contactos\Http\Controllers;

use Quimaira\Contactos\Mail\ContactoMail;
use Quimaira\Contactos\Models\Contacto;
use Quimaira\Contactos\Exports\ContactosExport;
use Quimaira\Contactos\Http\Requests\ContactoRequest;

use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class ContactosController extends Controller
{
  protected $_config;

  public function __construct()
  {
    $this->_config = request('_config');
  }


  public function index()
  {
    return view($this->_config['view']);
  }


  public function store(ContactoRequest $request)
  {
    $contacto = new Contacto;
    $contacto->nombre = $request->input('nombre');
    $contacto->telefono = $request->input('telefono');
    $contacto->email = $request->input('email');
    $contacto->estado = $request->input('estado');
    $contacto->empresa = $request->input('empresa');
    $contacto->ciudad = $request->input('ciudad');
    $contacto->mensaje = $request->input('mensaje');
    $contacto->save();

    try {
      Mail::queue(new ContactoMail($contacto));
    } catch (\Exception $e) {
      report($e);
    }

    return redirect()->back()->with('success', 'Hemos recibido tus datos, nos pondremos en contacto lo más pronto posible.');
  }

  public function download()
  {
    return Excel::download(new ContactosExport, $this->_config['fileName']);
  }


  public function view($id)
  {
    $pedido = Contacto::findOrFail($id);

    return view($this->_config['view'], compact('pedido'));
  }
}
