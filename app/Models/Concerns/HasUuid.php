<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasUuid
{
    public static function bootHasUuid()
    {
        static::saving(function (Model $model) {
            $model->uuid = (string) Str::uuid();
        });
    }
}
