<?php

namespace Quimaira\Contactos\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

use Illuminate\Validation\ValidationException;

class ContactoRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'nombre'      => 'required',
      'telefono'    => 'required',
      'empresa'    => 'required',
      'email'       => 'required',
      'estado'       => 'required',
      'ciudad'       => 'required',
      'mensaje'       => 'required',
      'g-recaptcha-response' => 'required'
    ];
  }

  public function messages()
  {
    return [
      'g-recaptcha-response.required' => 'El recaptcha es obligatorio.'
    ];
  }

  protected function failedValidation(Validator $validator)
  {
    $mensaje = '';
    foreach ($validator->errors()->all() as $error) {
      $mensaje = $mensaje . $error . '\n';
    }
    $response = redirect()
      ->route('shop.contacto.index')
      ->with('error', $mensaje)
      ->withInput();

    throw (new ValidationException($validator, $response))
      ->errorBag($this->errorBag)
      ->redirectTo($this->getRedirectUrl());
  }
}
