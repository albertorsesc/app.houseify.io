<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Model, Builder};

class Country extends Model
{
    public $timestamps = false;

    /* Scopes */

    public function scopeIsSupported(Builder $query) : Builder
    {
        return $query->where('is_supported', true);
    }
}
