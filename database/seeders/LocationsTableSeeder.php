<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use LaravelRoad\IBGELocaltions\Models\City;
use LaravelRoad\IBGELocaltions\Models\State;
use LaravelRoad\IBGELocaltions\Services\LocationsApiService;

class LocationsTableSeeder extends Seeder
{
    private $service;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
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
