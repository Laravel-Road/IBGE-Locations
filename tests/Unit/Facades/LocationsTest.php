<?php

namespace LaravelRoad\IBGELocaltions\Tests\Unit\Facades;

use Illuminate\Support\Facades\Config;
use LaravelRoad\IBGELocaltions\Exceptions\DriverUnsupportedException;
use LaravelRoad\IBGELocaltions\Facades\Locations;
use LaravelRoad\IBGELocaltions\Services\LocationsServiceFactory;
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

    /**
     * @group cities
     *
     * @test
     */
    public function verifyUnsuportedDriver()
    {
        Config::set('ibge-locations.driver', 'verifyUnsuportedDriver');

        $this->expectException(DriverUnsupportedException::class);
        LocationsServiceFactory::create();
    }
}
