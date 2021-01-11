<?php

namespace LaravelRoad\IBGELocaltions\Services;

use Illuminate\Support\Facades\Config;
use LaravelRoad\IBGELocaltions\Exceptions\DriverUnsupportedException;

class LocationsServiceFactory
{
    public const DRIVERS = [
        'api' => LocationsApiService::class,
        'db' => LocationsDbService::class,
    ];

    /**
     * @return LocationsServiceInterface
     * @throws DriverUnsupportedException
     */
    public static function create(): LocationsServiceInterface
    {
        if(! key_exists(Config::get('ibge-locations.driver'),self::DRIVERS)) {
            throw new DriverUnsupportedException();
        }

        $class = self::DRIVERS[Config::get('ibge-locations.driver')];

        return new $class();
    }
}
