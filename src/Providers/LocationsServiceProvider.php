<?php

namespace LaravelRoad\IBGELocaltions\Providers;

use Illuminate\Support\ServiceProvider;
use LaravelRoad\IBGELocaltions\Services\LocationsApiService;
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
            return new LocationsApiService();
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
        ], 'ibge-locations-config');

        $this->publishes([
            self::ROOT_PATH.'/database/migrations/2020_01_11_000000_create_states_table.php' => database_path('migrations/20020_01_11_000000_create_states_table.php'),
            self::ROOT_PATH.'/database/migrations/2020_01_11_100000_create_cities_table.php' => database_path('migrations/2020_01_11_100000_create_cities_table.php'),
        ], 'ibge-locations-migrations');

        $this->publishes([
            self::ROOT_PATH . '/database/seeds/StatesTableSeeder' => database_path('seeds/StatesTableSeeder'),
            self::ROOT_PATH . '/database/seeds/CitiesTableSeeder' => database_path('seeds/CitiesTableSeeder'),
        ], 'ibge-locations-seeds');
    }
}
