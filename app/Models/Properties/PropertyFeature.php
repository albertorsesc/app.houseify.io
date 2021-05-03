<?php

namespace App\Models\Properties;

use Illuminate\Database\Eloquent\{Model, Factories\HasFactory, Relations\BelongsTo};

class PropertyFeature extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $casts = ['features' => 'array'];
    protected $fillable = ['features'];

    /* Relations */

    public function property() : BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}
