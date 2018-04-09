<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use App\Online;
use App\Response;
use App\Member;
use App\Background;
use App\Category;

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

        view()->composer('custom.partials.footer', function($view){
            $view->with('onlineMembersNumber', Online::countMembers());
        });

        view()->composer('custom.partials.footer', function($view){
            $view->with('responsesNumber', Response::count());
        });

        view()->composer('custom.partials.footer', function($view){
            $view->with('membersNumber', Response::count());
        });

        view()->composer('custom.partials.footer', function($view){
            $view->with('lastMember', Member::latest()->first());
        });

        view()->composer('custom.partials.footer', function($view){
            $view->with('visitsRecord', Background::first());
        });

        view()->composer('custom.partials.categories', function($view){
            $view->with('subCategories', Category::all());
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
