<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Builder;

/**
 * @method static isPublished
 */
trait Publishable
{

    /**
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeIsPublished(Builder $query) : Builder
    {
        return $query->where('status', 1);
    }

    public function toggle()
    {
        tap($this, fn($model) => $model->status = ! $model->status)->update();
    }
}
