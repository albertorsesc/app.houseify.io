<?php

namespace App\Models;

use App\Models\Concerns\SerializeTimestamps;
use Illuminate\Database\{Eloquent\Model, Eloquent\Factories\HasFactory, Eloquent\Relations\BelongsTo};

class Location extends Model
{
    use HasFactory, SerializeTimestamps;

    protected $casts = ['coordinates' => 'array'];
    protected $fillable = ['locationable_id', 'locationable_type', 'address', 'neighborhood', 'city', 'state_id', 'zip_code', 'coordinates'];

    /* Relations */

    public function locationable()
    {
        return $this->morphTo();
    }

    /**
     * @todo: Test State relationship without dependencies.
     */
    public function state() : BelongsTo
    {
        return $this->belongsTo(State::class);
    }
}
