<?php

namespace LaravelRoad\IBGELocaltions\Providers;

use Illuminate\Support\ServiceProvider;
use LaravelRoad\IBGELocaltions\Services\LocationsServiceFactory;
use LaravelRoad\IBGELocaltions\Services\LocationsServiceInterface;

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

        $this->app->bind(LocationsServiceInterface::class, function () {
            return LocationsServiceFactory::create();
        });

        $this->app->singleton('IBGELocations', LocationsServiceInterface::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(self::ROOT_PATH . '/database/migrations');

        $this->publishes([
            self::ROOT_PATH . '/config/ibge-locations.php' => config_path('ibge-locations.php'),
        ], 'ibge-locations-config');

        $this->publishes([
            self::ROOT_PATH.'/database/migrations/2021_01_11_000000_create_states_table.php' => database_path('migrations/2021_01_11_000000_create_states_table.php'),
            self::ROOT_PATH.'/database/migrations/2021_01_11_100000_create_cities_table.php' => database_path('migrations/2021_01_11_100000_create_cities_table.php'),
        ], 'ibge-locations-migrations');

        $this->publishes([
            self::ROOT_PATH . '/database/seeders/LocationsTableSeeder.php' => database_path('seeders/LocationsTableSeeder.php'),
        ], 'ibge-locations-seeders');
    }
}
