<?php

namespace App\Models\Properties;

use Illuminate\Database\Eloquent\{Model, Relations\HasMany};

class PropertyType extends Model
{
    public $timestamps = false;

    protected $fillable = ['display_name', 'name'];

    /** Relations */

    public function propertyCategories() : HasMany
    {
        return $this->hasMany(PropertyCategory::class);
    }
}
