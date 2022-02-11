<?php

use Illuminate\Support\Facades\Route;

$view = 'theme';
$controller = 'Quimaira\Theme\Http\Controllers\AdminPagesController';


Route::group(['middleware' => ['web']], function () use ($controller, $view) {
    Route::prefix(config('app.admin_url'))->group(function () use ($controller, $view) {
        Route::group(['middleware' => ['admin']], function () use ($controller, $view) {
            Route::prefix('diseno')->group(function () use ($controller, $view) {

                $prefix = 'diseno.home';
                Route::prefix('home')->group(function () use ($prefix, $controller, $view) {
                    Route::get('/', $controller . '@indexHome')
                        ->defaults('_config', [
                            'view' => $view . '::admin.diseno.cms.index',
                        ])
                        ->name('admin.diseno.home.index');
                });
                $prefix = 'diseno.cms';
                Route::prefix('cms')->group(function () use ($prefix, $controller) {
                    Route::post('/', $controller . '@update')
                        ->name('admin.' . $prefix . '.update');
                });
            });
        });
    });
});
