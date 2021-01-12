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

class LocationsApiService implements LocationsServiceInterface
{
    private const FIELD_MAPPER = [
        'code' => 'id',
        'name' => 'nome',
        'initials' => 'sigla',
    ];

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
        if (! Cache::has( 'states_api')) {
            Cache::put('states_api', State::collection($this->fetchStates()->object()), 3600);
        }

        return Cache::get('states_api');
    }

    /**
     * @param string $stateInitials
     * @return Collection
     */
    public function getCities(string $stateInitials): Collection
    {
        if (! Cache::has( $stateInitials . '_cities_api')) {
            Cache::put($stateInitials . '_cities_api', City::collection($this->fetchCities($stateInitials)->object()), 3600);
        }

        return Cache::get($stateInitials . '_cities_api');
    }

    /**
     * @return Response
     */
    private function fetchStates(): Response
    {
        return $this->client->get('/estados', ['orderBy' => self::FIELD_MAPPER[Config::get('ibge-locations.states.orderBy')]]);
    }

    /**
     * @param string $stateInitials
     * @return Response
     */
    private function fetchCities(string $stateInitials): Response
    {
        return $this->client->get("/estados/{$stateInitials}/municipios");
    }
}
