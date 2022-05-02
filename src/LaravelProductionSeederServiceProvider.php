<?php

namespace ChrisDiCarlo\LaravelProductionSeeder;

use ChrisDiCarlo\LaravelProductionSeeder\EventServiceProvider;
use Illuminate\Support\ServiceProvider;

class LaravelProductionSeederServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'laravel-production-seeder');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-production-seeder');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('laravel-production-seeder.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/laravel-production-seeder'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/laravel-production-seeder'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/laravel-production-seeder'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'laravel-production-seeder');
        $this->app->register(EventServiceProvider::class);

        // Register the main class to use with the facade
        // $this->app->singleton('laravel-production-seeder', function () {
        //     return new LaravelProductionSeeder;
        // });
    }
}
