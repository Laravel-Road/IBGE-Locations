<?php

namespace LaravelRoad\IBGELocaltions\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use LaravelRoad\IBGELocaltions\Models\State;

class LocationsDbService implements LocationsServiceInterface
{
    /**
     * @return Collection
     */
    public function getStates(): Collection
    {
        if (! Cache::has( 'states_db')) {
            Cache::put('states_db', State::orderBy(Config::get('ibge-locations.states.orderBy'))->get(), 3600);
        }

        return Cache::get('states_db');
    }

    /**
     * @param string $state
     * @return Collection
     */
    public function getCities(string $state): Collection
    {
        if (! Cache::has( $state . '_cities_db')) {
            Cache::put($state . '_cities_db', State::firstWhere('initials', $state)->cities, 3600);
        }

        return Cache::get($state . '_cities_db');
    }
}
