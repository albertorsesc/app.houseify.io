<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Builder;

trait Publishable
{
    public function scopeIsPublished(Builder $query)
    {
        return $query->where('status', 1);
    }

    public function toggle()
    {
        tap($this, fn($model) => $model->status = ! $model->status)->update();
    }
}
