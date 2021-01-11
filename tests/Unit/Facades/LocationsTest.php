<?php

namespace LaravelRoad\IBGELocaltions\Tests\Unit\Facades;

use LaravelRoad\IBGELocaltions\Facades\Locations;
use LaravelRoad\IBGELocaltions\Tests\TestCase;

/**
 * @group locations
 */
class LocationsTest extends TestCase
{
    /**
     * @group api
     * @group states
     *
     * @test
     */
    public function canGetAllDistrictsFromApi()
    {
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
        $states = Locations::getStates();

        $cities = Locations::getCities($states->first()->initials);

        $this->assertEquals('Acrelândia', $cities[0]->name);
    }
}
