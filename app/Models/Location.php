<?php

namespace App\Models;

use App\Models\Concerns\UsesGMaps;
use App\Models\Concerns\SerializeTimestamps;
use Illuminate\Database\{Eloquent\Model, Eloquent\Factories\HasFactory, Eloquent\Relations\BelongsTo};

class Location extends Model
{
    use HasFactory, SerializeTimestamps, UsesGMaps;

    protected $touches = ['locationable'];
    protected $casts = ['coordinates' => 'array'];
    protected $fillable = ['locationable_id', 'locationable_type', 'address', 'neighborhood', 'city', 'state_id', 'zip_code', 'coordinates', 'google_map_url'];

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

    /* Mutators */

    /* Mutators */

    public function setCoordinatesAttribute()
    {
        return $this->attributes['coordinates'] = json_encode(
            $this->getCoordinates()
        );
    }

    /* Helpers */

    public function getFullAddress(bool $fromRequest = false) : string
    {
        if ($fromRequest) {
            $state = State::where('id', request()->state_id)->first();
            return trim(request()->address . ' ' .
                request()->neighborhood . ', ' .
                request()->city . ', ' .
                $state->name . ' ' .
                request()->zip_code);
        }
        $address = $this->address ?? '';
        $zipCode = isset($this->state->zip_code) ? "- $this->zip_code" : '';

        return "$address $this->neighborhood, $this->city, {$this->state->name} $zipCode";
    }
}
