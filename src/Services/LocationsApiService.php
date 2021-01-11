<?php

namespace LaravelRoad\IBGELocaltions\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use LaravelRoad\IBGELocaltions\Transfers\City;
use LaravelRoad\IBGELocaltions\Transfers\State;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class LocationsService implements LocationsServiceInterface
{
    /**
     * @var PendingRequest
     */
    private PendingRequest $client;

    /**
     * LocationsService constructor.
     */
    public function __construct()
    {
        $this->client = Http::baseUrl(Config::get('ibge-locations.baseUrl'));
    }

    /**
     * @return Collection
     */
    public function getStates(): Collection
    {
        if (! Cache::has( 'states')) {
            Cache::put('states', State::collection($this->fetchStates()->object()), 3600);
        }

        return Cache::get('states');
    }

    /**
     * @param string $state
     * @return Collection
     */
    public function getCities(string $state): Collection
    {
        if (! Cache::has( $state . '_cities')) {
            Cache::put($state . '_cities', City::collection($this->fetchCities($state)->object()), 3600);
        }

        return Cache::get($state . '_cities');
    }

    /**
     * @return Response
     */
    private function fetchStates(): Response
    {
        return $this->client->get('/estados', ['orderBy' => Config::get('ibge-locations.states.orderBy')]);
    }

    /**
     * @param string $state
     * @return Response
     */
    private function fetchCities(string $state): Response
    {
        return $this->client->get("/estados/{$state}/municipios");
    }
}
