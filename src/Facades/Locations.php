<?php

namespace LaravelRoad\IBGELocaltions\Facades;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade;
use LaravelRoad\IBGELocaltions\Services\LocationsServiceInterface;

/**
 * @method static Collection getStates()
 * @method static Collection getCities(string $stateInitials)
 *
 * @see \LaravelRoad\IBGELocaltions\Services\LocationsApiService
 */
class Locations extends Facade
{
    protected static function getFacadeAccessor()
    {
        return LocationsServiceInterface::class;
    }
}
