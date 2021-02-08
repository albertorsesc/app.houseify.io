<?php

namespace App\Models\Concerns;

use Illuminate\Support\Str;

trait HasSlug
{
    public static function bootHasSlug()
    {
        /*static::creating(function (Sluggable $model) {
            $model->slug = Str::slug($model->title)  . '-' . $model->uuid;
        });
        static::updating(function (Sluggable $model) {
            $model->slug = Str::slug($model->title)  . '-' . $model->uuid;
        });*/
    }
}
