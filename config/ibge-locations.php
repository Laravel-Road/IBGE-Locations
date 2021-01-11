<?php

return [
    'driver' => env('IBGE_LOCATIONS_DRIVER', 'api'),
    'baseUrl' => env('IBGE_LOCATIONS_BASEURL', 'https://servicodados.ibge.gov.br/api/v1/localidades'),
    'states' => [
        'orderBy' => env('IBGE_LOCATIONS_STATES_ORDERBY','name'),
    ],
];
