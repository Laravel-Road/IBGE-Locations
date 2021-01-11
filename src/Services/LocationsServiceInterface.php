<?php

namespace LaravelRoad\IBGELocaltions\Services;

use Illuminate\Support\Collection;

interface LocationsServiceInterface
{
    /**
     * @return Collection
     */
    public function getStates(): Collection;

    /**
     * @param string $stateInitials
     * @return Collection
     */
    public function getCities(string $stateInitials): Collection;
}
