<?php

namespace Manirul\CrudPackage;

use Illuminate\Support\ServiceProvider;

class CrudPackageServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // routes, views, migrations load হবে এখানে
        // routes
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');

        // views
        $this->loadViewsFrom(__DIR__.'/resources/views', 'crudpackage');

        // migrations
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        // publish views
        $this->publishes([
            __DIR__.'/resources/views' => resource_path('views/vendor/crudpackage'),
        ], 'crudpackage-views');
        
    }

    public function register()
    {
        

    }
}
