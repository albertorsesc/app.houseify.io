<?php

namespace App\Models\Businesses;

use App\Models\User;
use App\Models\Concerns\{HasLocation, HasUuid, Interestable, Publishable, SerializeTimestamps};
use Illuminate\Database\Eloquent\{Builder, Model, Relations\BelongsTo, Factories\HasFactory};

class Business extends Model
{
    use HasUuid,
        HasFactory,
        HasLocation,
        Publishable,
        Interestable,
        SerializeTimestamps;

    protected $casts = ['status' => 'boolean', 'categories' => 'array'];
    protected $fillable = ['name', 'categories', 'email', 'phone', 'site', 'comments'];

    public function getRouteKeyName() : string
    {
        return 'slug';
    }

    /* Relations */

    public function owner() : BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /* Scopes */

    public function scopeIsPublished(Builder $query)
    {
        return $query->whereStatus(true);
    }

    /* Helpers */

    public function profile() : string
    {
        return route('web.businesses.show', $this);
    }
}
