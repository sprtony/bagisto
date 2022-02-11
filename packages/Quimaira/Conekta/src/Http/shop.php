<?php

use Illuminate\Support\Facades\Route;

//RUTAS DE Conekta
Route::group(['middleware' => ['web']], function () {
  Route::prefix('conekta')->group(function () {
    Route::prefix('oxxo')->group(function () {
      Route::get('redirect', 'Quimaira\Conekta\Http\Controllers\OxxoController@redirect')->name('conekta.oxxo.redirect');
      Route::post('webhook', 'Quimaira\Conekta\Http\Controllers\OxxoController@hook')->name('conekta.oxxo.hook');
      Route::get('vaucher/{id}', 'Quimaira\Conekta\Http\Controllers\OxxoController@vaucher')->name('conekta.oxxo.vaucher');
      Route::get('success', 'Quimaira\Conekta\Http\Controllers\OxxoController@success')->defaults('_config', [
        'view' => 'shop::checkout.oxxo'
      ])->name('conekta.oxxo.success');
    });
    Route::prefix('checkout')->group(function () {
      Route::get('create', 'Quimaira\Conekta\Http\Controllers\CheckoutController@createCheckout')->name('conekta.checkout.create');
      Route::get('success', 'Quimaira\Conekta\Http\Controllers\CheckoutController@success')->name('conekta.checkout.success');
    });
  });
});
