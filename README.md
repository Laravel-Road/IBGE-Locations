# Laravel Road IBGE Locations

## Install
```shell script
composer require laravel-road/ibge-locations

php artisan vendor:publish --tag=ibge-locations-migrations
php artisan vendor:publish --tag=ibge-locations-seeders
php artisan migrate
php artisan db:seed --class LocationsTableSeeder
```

## How to use
```php

$states = Locations::getStates();

$cities = Locations::getStates($states->first()->initials);

```
