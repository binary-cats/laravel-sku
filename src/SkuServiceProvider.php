<?php

namespace BinaryCats\Sku;

use BinaryCats\Sku\Concerns\SkuMacro;
use BinaryCats\Sku\Concerns\SkuOptions;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class SkuServiceProvider extends ServiceProvider
{
    /**
     * Boot application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/laravel-sku.php' => config_path('laravel-sku.php'),
            ], 'config');
        }
        // Bind the Standard SKU Options
        $this->bindSkuOptions();
        // Extend Str with a sku() method
        Str::mixin(new SkuMacro);
    }

    /**
     * Register application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-sku.php', 'laravel-sku');
    }

    /**
     * Bind the SKU options.
     *
     * @return void
     */
    protected function bindSkuOptions()
    {
        $this->app->bind(
            SkuOptions::class,
            function ($app) {
                return new SkuOptions($app['config']->get('laravel-sku.default', []));
            }
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            SkuOptions::class,
        ];
    }
}
