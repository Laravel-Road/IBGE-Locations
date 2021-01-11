<?php

namespace LaravelRoad\IBGELocaltions\Transfers;

use Illuminate\Support\Collection;

class State
{
    public int $code;
    public string $name;
    public string $initials;

    /**
     * State constructor.
     * @param Object $state
     */
    public function __construct(Object $state)
    {
        $this->code = (int) $state->id;
        $this->name = $state->nome;
        $this->initials = $state->sigla;
    }

    /**
     * @param $resource
     * @return Collection
     */
    public static function collection($resource): Collection
    {
        return (new Collection($resource))->map(function ($item){
            return new State($item);
        });
    }
}
