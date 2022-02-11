<?php

namespace Quimaira\Conekta\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * HelloWorldServiceProvider
 *
 * @copyright 2020 Webkul Software Pvt. Ltd. (http://www.webkul.com)
 */
class ConektaServiceProvider extends ServiceProvider
{
  /**
   * Bootstrap services.
   *
   * @return void
   */
  public function boot()
  {
    /* $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations'); */
    $this->loadRoutesFrom(__DIR__ . '/../Http/shop.php');
    $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'conekta');

    $this->app->register(EventServiceProvider::class);
  }

  /**
   * Register services.
   *
   * @return void
   */
  public function register()
  {
    $this->mergeConfigFrom(
      dirname(__DIR__) . '/Config/paymentmethods.php',
      'paymentmethods'
    );

    $this->mergeConfigFrom(
      dirname(__DIR__) . '/Config/system.php',
      'core'
    );
  }
}
