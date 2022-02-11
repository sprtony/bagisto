<?php

namespace Quimaira\Contactos\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * HelloWorldServiceProvider
 *
 * @copyright 2020 Webkul Software Pvt. Ltd. (http://www.webkul.com)
 */
class ContactosServiceProvider extends ServiceProvider
{
  /**
   * Bootstrap services.
   *
   * @return void
   */
  public function boot()
  {
    $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'contactos');
    $this->loadRoutesFrom(__DIR__ . '/../Http/routes.php');
  }

  /**
   * Register services.
   *
   * @return void
   */
  public function register()
  {
    $this->mergeConfigFrom(
      dirname(__DIR__) . '/Config/admin-menu.php',
      'menu.admin'
    );
    $this->mergeConfigFrom(
      dirname(__DIR__) . '/Config/system.php',
      'core'
    );
    $this->mergeConfigFrom(
      dirname(__DIR__) . '/Config/acl.php',
      'acl'
    );
  }
}
