<?php

namespace App\Models\Forum\Threads;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ThreadChannel extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function getRouteKeyName () : string
    {
        return 'slug';
    }

    /* Relations */

    public function threads() : HasMany
    {
        return $this->hasMany(
            Thread::class,
            'channel_id'
        )->latest();
    }
}
