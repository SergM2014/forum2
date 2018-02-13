<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Online;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('custom.partials.footer', function($view){
            $view->with('visitorsNumber', Online::countUnregisrteredVisitors());
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
