<?php

namespace App\Models\Properties;

use App\Models\Concerns\{HasLocation, HasSlug, HasUuid, Locationable, Sluggable};
use Illuminate\Database\Eloquent\{Builder, Factories\HasFactory, Model, Relations\BelongsTo};

class Property extends Model implements Sluggable, Locationable
{
    use HasFactory, HasUuid, HasSlug, HasLocation;

    protected $casts = ['price' => 'integer', 'status' => 'boolean', 'seller_id' => 'integer'];
    protected $fillable = ['property_category_id', 'business_type', 'title', 'price', 'comments'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /** Relations */

    public function propertyCategory() : BelongsTo
    {
        return $this->belongsTo(PropertyCategory::class);
    }

    /* Scopes */

    public function scopeIsPublished(Builder $query)
    {
        return $query->whereStatus(true);
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

    public function getSluggableValue () : string
    {
        return $this->title . '-' . $this->uuid;
    }
}
