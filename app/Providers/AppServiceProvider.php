<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Blade::directive('shorten', function ($expression) {
            return "<?php 
                if(strlen($expression) > 20)
                    echo substr($expression,0,100).'...';
                else echo $expression; ?>";
        });

    }
}
