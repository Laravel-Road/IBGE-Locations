<?php

namespace LaravelRoad\IBGELocaltions\Providers;

use Illuminate\Support\ServiceProvider;
use LaravelRoad\IBGELocaltions\Services\LocationsService;

class LocationsServiceProvider extends ServiceProvider
{
    /**
     * Relative path to the root
     */
    const ROOT_PATH = __DIR__ . '/../..';

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            self::ROOT_PATH . '/config/ibge-locations.php', 'ibge-locations'
        );

        $this->app->bind(LocationsService::class, function () {
            return new LocationsService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            self::ROOT_PATH . '/config/ibge-locations.php' => config_path('ibge-locations.php'),
        ], 'ibge-locations');
    }
}
