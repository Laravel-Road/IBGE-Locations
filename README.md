# Laravel Road IBGE Locations

## Install
```shell script
composer require laravel-road/ibge-locations

php artisan ibge-locations:install // optional, but necessary to use the db driver
```

## How to use
```php
$states = Locations::getStates();

$cities = Locations::getStates($states->first()->initials);
```

## Supported Drivers
* api (default)
* db

## Env
* IBGE_LOCATIONS_DRIVER=api
* IBGE_LOCATIONS_BASEURL=https://servicodados.ibge.gov.br/api/v1/localidades
* IBGE_LOCATIONS_STATES_ORDERBY=name
