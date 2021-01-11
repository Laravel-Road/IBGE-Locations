<?php

namespace LaravelRoad\IBGELocaltions\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class State extends Model
{
    /**
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * @return HasMany
     */
    public function cities(): HasMany
    {
        return $this->HasMany(City::class);
    }
}
