<?php

namespace App\Models\Businesses;

use App\Models\User;
use App\Models\Concerns\{CanBeReported, HasLocation, HasUuid, Interestable, Publishable, SerializeTimestamps};
use Illuminate\Database\Eloquent\{Builder, Model, Relations\BelongsTo, Factories\HasFactory};

class Business extends Model
{
    use HasUuid,
        HasFactory,
        HasLocation,
        Publishable,
        Interestable,
        CanBeReported,
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

    /* Mutators */

    public function setCategoriesAttribute($categories)
    {
        return $this->attributes['categories'] = json_encode($categories);
    }

    /* Helpers */

    public function profile() : string
    {
        return route('web.businesses.show', $this);
    }

    public static function getReportingCauses() : array
    {
        return array_merge([
            'non-existent' => 'Negocio/Empresa inexistente',
        ], config('houseify.reporting_causes'));
    }
}
