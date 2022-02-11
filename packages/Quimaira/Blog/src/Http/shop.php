<?php


use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'locale', 'theme', 'currency']], function () {


    //custom routes
    Route::prefix('cotizacion')->group(function () {
        Route::get('/', 'Quimaira\Quimashop\Http\Controllers\CotizacionesController@index')->defaults('_config', [
            'view' => 'shop::checkout.cotizaciones.index'
        ])->name('shop.pedidos.index');
        Route::get('add/{slug}', 'Quimaira\Quimashop\Http\Controllers\CotizacionesController@add')
            ->name('shop.cotizacion.add');
        Route::get('trash', 'Quimaira\Quimashop\Http\Controllers\CotizacionesController@trash')
            ->name('shop.cotizacion.trash');
        Route::get('remove/{slug}', 'Quimaira\Quimashop\Http\Controllers\CotizacionesController@remove')
            ->name('shop.cotizacion.remove');
        Route::post('/create', 'Quimaira\Quimashop\Http\Controllers\CotizacionesController@save')->defaults('_config', [
            'redirect' => 'shop.pedidos.index',
        ])->name('shop.pedidos.store');
    });

    Route::get('contacto', 'Quimaira\Quimashop\Http\Controllers\PagesController@pages')->defaults('_config', [
        'view' => 'shop::pages.contacto.index'
    ])->name('shop.contacto.index');

    Route::get('facturacion', 'Quimaira\Quimashop\Http\Controllers\PagesController@pages')->defaults('_config', [
        'view' => 'shop::pages.facturacion.index'
    ])->name('shop.facturacion.index');

    Route::get('ubicaciones', 'Quimaira\Quimashop\Http\Controllers\PagesController@ubicaciones')->defaults('_config', [
        'view' => 'shop::pages.ubicacion.index'
    ])->name('shop.ubicaciones.index');

    Route::get('productos', \Webkul\Shop\Http\Controllers\ProductsCategoriesProxyController::class . '@all')
        ->defaults('_config', [
            'category_view' => 'shop::products.all'
        ])
        ->name('shop.productos.index');

    Route::get('promociones', \Webkul\Shop\Http\Controllers\ProductsCategoriesProxyController::class . '@all')
        ->defaults('_config', [
            'category_view' => 'shop::promociones.all'
        ])
        ->name('shop.promociones.index');

    Route::prefix('blog')->group(function () {
        Route::get('/', '\Quimaira\Quimashop\Http\Controllers\BlogController@index')->name('shop.blog.index');
        Route::get('{slug}', '\Quimaira\Quimashop\Http\Controllers\BlogController@search')->name('shop.blog.search');
    });





    Route::prefix('customer')->group(function () {
        Route::group(['middleware' => ['customer']], function () {
            Route::prefix('account')->group(function () {
                Route::prefix('facturacion')->group(function () {

                    //Customer Address Show
                    Route::get('/', 'Quimaira\Quimashop\Http\Controllers\FacturacionController@index')
                        ->defaults('_config', [
                            'view' => 'shop::customers.account.facturacion.index'
                        ])
                        ->name('customer.facturacion.index');
                    //Customer Address Create Form Show
                    Route::get('create', 'Quimaira\Quimashop\Http\Controllers\FacturacionController@create')
                        ->defaults('_config', [
                            'view' => 'shop::customers.account.facturacion.create'
                        ])
                        ->name('customer.facturacion.create');

                    //Customer Address Create Form Store
                    Route::post('create', 'Quimaira\Quimashop\Http\Controllers\FacturacionController@store')
                        ->defaults('_config', [
                            'view' => 'shop::customers.account.facturacion.address',
                            'redirect' => 'customer.address.index'
                        ])
                        ->name('customer.facturacion.store');

                    //Customer Address Edit Form Show
                    Route::get('edit/{id}', 'Quimaira\Quimashop\Http\Controllers\FacturacionController@edit')
                        ->defaults('_config', [
                            'view' => 'shop::customers.account.facturacion.edit'
                        ])
                        ->name('customer.facturacion.edit');

                    //Customer Address Edit Form Store
                    Route::put('edit/{id}', 'Quimaira\Quimashop\Http\Controllers\FacturacionController@update')
                        ->defaults('_config', [
                            'redirect' => 'customer.facturarcion.index'
                        ])
                        ->name('customer.facturacion.update');

                    //Customer Address Delete
                    Route::get('delete/{id}', 'Quimaira\Quimashop\Http\Controllers\FacturacionController@destroy')
                        ->name('customer.facturacion.delete');
                });
            });
        });
    });
});




//METODOS DE PAGOS

//RUTAS DE STRIPE
Route::group(['middleware' => ['web']], function () {
    Route::prefix('stripe')->group(function () {
        Route::get('/redirect', 'Quimaira\Quimashop\Http\Controllers\StripeController@redirect')->name('stripe.redirect');
        Route::get('/success', 'Quimaira\Quimashop\Http\Controllers\StripeController@success')->name('stripe.success');
        Route::get('/cancel', 'Quimaira\Quimashop\Http\Controllers\StripeController@cancel')->name('stripe.cancel');
    });
});

//RUTAS DE Conekta
Route::group(['middleware' => ['web']], function () {
    Route::prefix('conekta')->group(function () {
        Route::get('/redirect', 'Quimaira\Quimashop\Http\Controllers\ConektaController@redirect')->name('conekta.redirect');
        Route::get('/webhook', 'Quimaira\Quimashop\Http\Controllers\ConektaController@hook')->name('conekta.hook');
        Route::get('/vaucher/{id}', 'Quimaira\Quimashop\Http\Controllers\ConektaController@vaucher')->name('conekta.vaucher');
        Route::get('/success', 'Quimaira\Quimashop\Http\Controllers\ConektaController@success')->name('conekta.success');
    });
});
