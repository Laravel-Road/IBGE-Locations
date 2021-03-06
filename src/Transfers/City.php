<?php

namespace LaravelRoad\IBGELocaltions\Transfers;

use Illuminate\Support\Collection;

class City
{
    public int $code;
    public string $name;

    /**
     * City constructor.
     * @param Object $city
     */
    public function __construct(Object $city)
    {
        $this->code = (int) $city->id;
        $this->name = $city->nome;
    }

    /**
     * @param $resource
     * @return Collection
     */
    public static function collection($resource): Collection
    {
        return (new Collection($resource))->map(function ($item){
            return new City($item);
        });
    }
}
