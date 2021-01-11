<?php

namespace LaravelRoad\IBGELocaltions\Tests\Unit\Services;

use Illuminate\Support\Facades\Config;
use LaravelRoad\IBGELocaltions\Exceptions\DriverUnsupportedException;
use LaravelRoad\IBGELocaltions\Services\LocationsServiceFactory;
use LaravelRoad\IBGELocaltions\Tests\TestCase;

/**
 * @group locations
 */
class LocationsTest extends TestCase
{
    /**
     * @group factory
     *
     * @test
     */
    public function verifyUnsuportedDriver()
    {
        Config::set('ibge-locations.driver', 'unsuportedDriver');

        $this->expectException(DriverUnsupportedException::class);
        LocationsServiceFactory::create();
    }
}
