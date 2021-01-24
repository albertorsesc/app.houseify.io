<?php

namespace App\Models\Concerns;

use Illuminate\Support\Str;

trait HasSlug
{
    public static function bootHasSlug()
    {
        static::creating(function (Sluggable $model) {
            $model->slug = Str::slug($model->getSluggableValue());
        });
    }
}
