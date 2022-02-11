<?php

use Illuminate\Support\Facades\Route;
// Marcas Routes
Route::group(['middleware' => ['web', 'admin']], function () {

    Route::prefix(config('app.admin_url'))->group(function () {
        Route::group(['middleware' => ['admin']], function () {
            Route::prefix('instagram')->group(function () {
                Route::get('/', 'Quimaira\Instagram\Http\Controllers\InstagramController@index')->defaults('_config', [
                    'view' => 'instagram::admin.diseno.instagram.index',
                ])->name('admin.diseno.instagram.index');

                Route::get('/create', 'Quimaira\Instagram\Http\Controllers\InstagramController@create')->defaults('_config', [
                    'view' => 'instagram::admin.diseno.instagram.create',
                ])->name('admin.diseno.instagram.create');

                Route::post('/create', 'Quimaira\Instagram\Http\Controllers\InstagramController@store')->defaults('_config', [
                    'redirect' => 'admin.diseno.instagram.index',
                ])->name('admin.diseno.instagram.store');

                Route::get('/edit/{id}', 'Quimaira\Instagram\Http\Controllers\InstagramController@edit')->defaults('_config', [
                    'view' => 'instagram::admin.diseno.instagram.edit',
                ])->name('admin.diseno.instagram.edit');

                Route::put('/edit/{id}', 'Quimaira\Instagram\Http\Controllers\InstagramController@update')->defaults('_config', [
                    'redirect' => 'admin.diseno.instagram.index',
                ])->name('admin.diseno.instagram.update');

                Route::post('/delete/{id}', 'Quimaira\Instagram\Http\Controllers\InstagramController@destroy')->name('admin.diseno.instagram.delete');
            });
        });
    });
});
