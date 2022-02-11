<?php
Route::group(['middleware' => ['web', 'locale', 'theme', 'currency']], function () {
  //Paginas estaticas
  Route::get('looks', 'Quimaira\Theme\Http\Controllers\PagesController@looks')->defaults('_config', [
    'view' => 'shop::pages.looks.index'
  ])->name('shop.looks.index');
});
