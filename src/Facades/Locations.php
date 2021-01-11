<?php

namespace LaravelRoad\IBGELocaltions\Facades;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * @method static Collection getStates()
 * @method static Collection getCities(string $stateInitials)
 *
 * @see \LaravelRoad\IBGELocaltions\Services\LocationsServiceInterface
 */
class Locations extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'IBGELocations';
    }
}
