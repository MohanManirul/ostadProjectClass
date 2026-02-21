<?php

namespace Manirul\CrudPackage;

use Illuminate\Support\ServiceProvider;

class CrudPackageServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'crudpackage');

        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'migrations');
    }

    public function register()
    {
        //
    }
}