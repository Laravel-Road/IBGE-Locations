<?php

namespace LaravelRoad\IBGELocaltions\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use LaravelRoad\IBGELocaltions\Facades\Locations;
use LaravelRoad\IBGELocaltions\Models\City;
use LaravelRoad\IBGELocaltions\Models\State;
use LaravelRoad\IBGELocaltions\Services\LocationsApiService;
use LaravelRoad\IBGELocaltions\Tests\TestCase;

/**
 * @group locations
 */
class LocationsDbTest extends TestCase
{
    use RefreshDatabase;

    private $service;

    /**
     * @group api
     * @group cities
     *
     * @test
     */
    public function canGetCitiesByStateFromDb()
    {
        $this->populateDatabase();

        Config::set('ibge-locations.driver', 'db');

        $states = Locations::getStates();

        $this->assertCount(27, $states);
    }

    /**
     * @group api
     * @group cities
     *
     * @test
     */
    public function canGetCitiesByStateFromApi()
    {
        $this->populateDatabase();

        Config::set('ibge-locations.driver', 'db');

        $states = Locations::getStates();

        $cities = Locations::getCities($states->first()->initials);

        $this->assertEquals('Acrelândia', $cities[0]->name);
    }

    /**
     * @return void
     */
    private function populateDatabase()
    {
        $this->service = new LocationsApiService();

        foreach ($this->service->getStates() as $state) {
            $state = State::updateOrCreate(['code' => $state->code], [
                'code' =>  $state->code,
                'name' =>  $state->name,
                'initials' =>  $state->initials,
            ]);

            $this->runCities($state);
        }
    }

    /**
     * @param State $state
     */
    private function runCities(State $state)
    {
        foreach ($this->service->getCities($state->initials) as $city) {
            City::updateOrCreate(['code' => $city->code, 'state_id' => $state->id], [
                'code' =>  $city->code,
                'name' =>  $city->name,
                'state_id' => $state->id,
            ]);
        }
    }
}
