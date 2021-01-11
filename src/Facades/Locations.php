<?php

namespace LaravelRoad\IBGELocaltions\Facades;

use LaravelRoad\IBGELocaltions\Services\LocationsService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * @method static Collection getStates()
 * @method static Collection getCities(string $state)
 *
 * @see \LaravelRoad\IBGELocaltions\Services\LocationsService
 */
class Locations extends Facade
{
    protected static function getFacadeAccessor()
    {
        return LocationsService::class;
    }
}
