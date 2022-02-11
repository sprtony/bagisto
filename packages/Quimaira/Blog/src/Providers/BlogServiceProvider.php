<?php

namespace Quimaira\Blog\Providers;

use Illuminate\Support\ServiceProvider;

class BlogServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadRoutesFrom(__DIR__ . '/../Http/admin.php');
        $this->loadRoutesFrom(__DIR__ . '/../Http/shop.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'blog');
    }

    public function register()
    {
        $this->mergeConfigFrom(dirname(__DIR__) . '/Config/admin-menu.php', 'menu.admin');
        $this->mergeConfigFrom(dirname(__DIR__) . '/Config/acl.php', 'acl');
    }
}
