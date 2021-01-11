<?php

namespace LaravelRoad\IBGELocaltions\Services;

use Illuminate\Support\Facades\Config;

class LocationsServiceFactory
{
    public const DRIVERS = [
        'api' => LocationsApiService::class
    ];

    public static function create()
    {
        $class = self::DRIVERS[Config::get('ibge-locations.driver')];

        return new $class();
    }
}
