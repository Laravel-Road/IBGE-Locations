# Laravel Road IBGE Locations

## Install
```shell script
composer require laravel-road/ibge-locations
```

## How to use
```php

$states = Locations::getStates();

$cities = Locations::getStates($states->first()->initials);

```
