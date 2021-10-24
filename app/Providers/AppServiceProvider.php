<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use AhmadMayahi\Vision\Vision;
use AhmadMayahi\Vision\Config;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton(Vision::class, function ($app) {
            $config = (new Config())
                ->setCredentialsPathname('PATH_TO_JSON_KEY');
        
            return Vision::new($config);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Paginator::useBootstrap();
    }
}
