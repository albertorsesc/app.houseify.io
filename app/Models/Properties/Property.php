<?php

namespace App\Models\Properties;

use App\Models\User;
use App\Models\Concerns\{CanBeReported, HasLocation, HasUuid, Interestable, Locationable, Publishable};
use Illuminate\Database\Eloquent\{Factories\HasFactory, Model, Relations\BelongsTo, Relations\HasOne};

class Property extends Model implements Locationable
{
    use HasUuid,
        HasFactory,
        Publishable,
        HasLocation,
        Interestable,
        CanBeReported;

    protected $casts = ['price' => 'integer', 'status' => 'boolean', 'seller_id' => 'integer'];
    protected $fillable = ['property_category_id', 'business_type', 'title', 'price', 'comments'];

    public function getRouteKeyName() : string
    {
        return 'slug';
    }

    /** Relations */

    public function seller() : BelongsTo
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function propertyCategory() : BelongsTo
    {
        return $this->belongsTo(PropertyCategory::class);
    }

    public function propertyFeature() : HasOne
    {
        return $this->hasOne(PropertyFeature::class);
    }

    /* Helpers */

    public function profile() : string
    {
        return route('web.properties.show', $this);
    }

    public function formattedPrice() : string
    {
        return '$' . number_format($this->price);
    }

    public function getReportingCauses()
    {
        return config('properties.reporting_causes');
    }
}
