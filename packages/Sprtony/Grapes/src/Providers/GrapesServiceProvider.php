<?php

namespace Quimaira\Grapes\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class GrapesServiceProvider extends ServiceProvider
{
  public $routeFilePath = '/routes/grapesjs.php';

  public function register()
  {
  }

  public function boot()
  {
    $this->loadViewsFrom(realpath(__DIR__ . '/../Resources/views/'), 'grapes');
    $this->mergeConfigFrom(__DIR__ . '/../Config/grapes.php', 'grapes');
    $this->loadRoutesFrom(__DIR__ . '/../Http/routes.php');
  }
}
