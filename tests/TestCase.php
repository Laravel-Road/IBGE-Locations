<?php

namespace LaravelRoad\IBGELocaltions\Tests;

use LaravelRoad\IBGELocaltions\Providers\LocationsServiceProvider;
use Illuminate\Foundation\Application;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{

    /**
     * add the package provider
     *
     * @param  Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            LocationsServiceProvider::class,
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  Application $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('ibge-locations.baseUrl', 'https://servicodados.ibge.gov.br/api/v1/localidades');
        $app['config']->set('ibge-locations.states.orderBy', 'nome');
    }
}
