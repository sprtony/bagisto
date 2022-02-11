<?php

use Illuminate\Support\Facades\Route;



Route::group(['middleware' => ['web']], function () {
  Route::prefix(config('app.admin_url'))->group(function () {
    Route::group(['middleware' => ['admin']], function () {
      Route::prefix('contactos')->group(function () {
        Route::get('/', 'Quimaira\Contactos\Http\Controllers\ContactosController@index')->defaults('_config', [
          'view' => 'contactos::admin.customers.contactos.index',
        ])->name('admin.customers.contactos.index');

        Route::get('/{id}', 'Quimaira\Contactos\Http\Controllers\ContactosController@view')->defaults('_config', [
          'view' => 'contactos::admin.customers.contactos.view',
        ])->name('admin.customers.contactos.view');
      });
    });
  });
  Route::get('contactos/download', 'Quimaira\Contactos\Http\Controllers\ContactosController@download')->defaults('_config', [
    'fileName' => 'contactos.xlsx',
  ])->name('admin.customers.contactos.download');

  Route::group(['middleware' => ['locale', 'theme', 'currency']], function () {
    Route::get('contacto', 'Quimaira\Contactos\Http\Controllers\ContactosController@index')->defaults('_config', [
      'view' => 'shop::pages.contacto.index'
    ])->name('shop.contacto.index');

    Route::post('create', 'Quimaira\Contactos\Http\Controllers\ContactosController@store')->defaults('_config', [
      'redirect' => 'shop.contactos.index',
    ])->name('admin.customers.contactos.store');
  });
});
