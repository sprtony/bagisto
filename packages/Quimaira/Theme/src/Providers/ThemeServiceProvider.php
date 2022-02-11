<?php

namespace Quimaira\Theme\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * HelloWorldServiceProvider
 *
 * @copyright 2020 Webkul Software Pvt. Ltd. (http://www.webkul.com)
 */
class ThemeServiceProvider extends ServiceProvider
{
  /**
   * Bootstrap services.
   *
   * @return void
   */
  public function boot()
  {
    $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'theme');
    $this->loadRoutesFrom(__DIR__ . '/../Http/shop.php');
    $this->loadRoutesFrom(__DIR__ . '/../Http/admin.php');
  }

  /**
   * Register services.
   *
   * @return void
   */
  public function register()
  {
    $this->mergeConfigFrom(
      dirname(__DIR__) . '/Config/admin.php',
      'menu.admin'
    );
    $this->mergeConfigFrom(
      dirname(__DIR__) . '/Config/acl.php',
      'acl'
    );
    $this->mergeConfigFrom(
      dirname(__DIR__) . '/Config/system.php',
      'core'
    );
    $this->mergeConfigFrom(
        dirname(__DIR__) . '/Config/carriers.php', 'carriers'
    );
  }
}
