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
     * @group states
     *
     * @test
     */
    public function canGetAllDistricts()
    {
        $states = Locations::getStates();

        $this->assertCount(27, $states);
    }

    /**
     * @group cities
     *
     * @test
     */
    public function canGetCitiesByState()
    {
        $states = Locations::getStates();

        $cities = Locations::getCities($states->first()->initials);

        $this->assertEquals('Acrelândia', $cities[0]->name);
    }
}
