<?php

namespace App\Models\Properties;

use Illuminate\Database\Eloquent\{Model, Relations\BelongsTo};

class PropertyCategory extends Model
{
    public $timestamps = false;

    protected $fillable = ['name', 'display_name', 'property_type_id'];

    /* Relations */

    public function propertyType() : BelongsTo
    {
        return $this->belongsTo(PropertyType::class);
    }
}
