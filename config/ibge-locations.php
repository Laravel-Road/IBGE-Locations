<?php

return [
    'driver' => env('IBGELOCATIONS_DRIVER', 'api'),
    'baseUrl' => env('IBGELOCATIONS_BASEURL', 'https://servicodados.ibge.gov.br/api/v1/localidades'),
    'states' => [
        'orderBy' => env('IBGELOCATIONS_STATES_ORDERBY','nome'),
    ],
];
