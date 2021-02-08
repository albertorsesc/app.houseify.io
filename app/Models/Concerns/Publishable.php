<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Builder;

trait Publishable
{
    public function scopeIsPublished(Builder $query)
    {
        return $query->whereStatus(true);
    }

    public function toggle()
    {
        tap($this, fn($model) => $model->status = ! $model->status)->save();
    }
}
